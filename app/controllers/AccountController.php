<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 5/18/14
 * Time: 7:57 PM
 */

class AccountController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));

    }

    public function getCreate()
    {
        return View::make('account.create');
    }
    public function postCreate()
    {
        $validator=Validator::make(Input::all(),
            array(
                'email'=>'required|max:50|email|unique:users',
                'user'=>'required|max:50|unique:users',
                'first_name'=>'required|max:50|alpha',
                'last_name'=>'sometimes|max:50|alpha',
                'password'=>'required|min:4',
                'confirm_password'=>'required|same:password',
                'mobile'=>'required|numeric|digits:10',
                'phone'=>'numeric',

            )
        );
        $email=Input::get('email');
        $first_name=Input::get('first_name');
        $last_name=Input::get('last_name');
        $username=Input::get('user');
        $password=Hash::make(Input::get('password'));
        $mobile=Input::get('mobile');
        $phone=Input::get('phone');
        $profile='2';
        $code=str_random(60);
        if($validator->fails())
        {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        else{
            /*creating rows to multiple table so here use in transaction*/
               $id=DB::table('users')->insertGetId(array(
                   'DisplayName'=>$first_name.''.$last_name,
                   'user'=>$username,
                   'password'=>$password,
                   'email'=>$email,
                   'code'=>$code,
                   'mobile'=>$mobile,
                   'phone'=>$phone,
                   'profilesId'=>$profile,
                   'userIsActive'=>'N',
               ));


           if($id)
           {
                
               /*the following code for email confirmation to activate account*/
               Mail::send('emails.auth.activate',array('link'=>URL::to('account/activate',$code),'displayName'=>$first_name,'username'=>$username),function($message) use ($email,$first_name) {
                  $message->to($email,$first_name)->subject('Activation Code');
               });
               /* automatic activation*/
//               return $this->getActivate($code);
               /* after sending email it is redirect */
               return Redirect::to('account/login')->with('success','Account created successfully and activation link sent to mail');
           }
            else{
                return Redirect::back()->with('error','Your account not created please try again');
            }
        }

    }

    public function getLogin()
    {
        return View::make('account.login');
    }
    public function postLogin()
    {
        $data=Input::all();
        $validator=Validator::make($data,
            array(
           'username'=>'required',
            'password'=>'required'
        ));
        if($validator->fails())
        {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $remember=(Input::has('remember'))? true : false;
            $username=$data['username'];
            $password=$data['password'];
            $active='Y';
            $field=filter_var($username,FILTER_VALIDATE_EMAIL)?'email':'user';
            if(Auth::attempt(array($field=>$username,'password'=>$password,'userIsActive'=>$active),$remember))
            {
                return Redirect::intended('/');
            }
            else{
                return Redirect::back()->withInput()
                    ->withErrors(array('error'=>'Username or password incorrect'))
                    ->with('error','Username or password incorrect');
            }
        }

    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/')
            ->with('success','Your successfully logged out');
    }
    public function getActivate($code)
    {
        $data['id']=$code;
       $validator=Validator::make($data,array('id'=>'alpha_num|min:60|max:60'));
        if($validator->fails())
        {
            return Response::view('errors.missing', array(), 404);
        }

        $user=User::where('code','=',$code)->where('userIsActive','=','N');
        if($user->count()){
            $user=$user->first();
            //Update your user to active state
            $user->userIsActive='Y';
            $user->code='';
            if($user->save()){
                return Redirect::to('account/login')->with('success','Your account activated! you can login');
            }
        }
        return Redirect::to('/')->with('error','We could not activate your account. Try again');

    }
    public function getChangePassword()
    {
        if(Auth::check())
        {
            return View::make('account.ChangePassword');
        }
        else{
            return Redirect::to('account/login');
        }

    }

    public function postChangePassword()
    {
        $validator=Validator::make(Input::all(),
            array(
               'old_password'=>'required',
                'new_password'=>'required|min:6',
                'confirm_password'=>'required|same:new_password'
            ));
        if($validator->fails())
        {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }
        else{
            $user=User::find(Auth::user()->id);
            $old_password=Input::get('old_password');
            $new_password=Input::get('new_password');
            if(Hash::check($old_password,$user->getAuthPassword()))
            {
                $user->password=Hash::make($new_password);
                if($user->save())
                {
                    return Redirect::to('/')
                        ->with('success','Your password has been changed.');
                }
                else{
                    return Redirect::back()
                        ->with('error','Your password could not change');
                }
            }
            else{
                return Redirect::back()
                    ->with('error','Your old password incorrect');
            }
        }
        return Redirect::back()
            ->with('error','Your password could not change');
    }
    public function getCreatePassword()
    {
        return View::make('account.createPassword');
    }

    public function getForgetPassword()
    {
        return View::make('account.ForgetPassword');
    }
    public function postForgetPassword()
    {
        $validator=Validator::make(Input::all(),array(
            'email'=>'required|email'
        ));
        if($validator->fails())
        {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        else
        {
            $user=User::where('email','=',Input::get('email'));
            if($user->count())
            {
                $email=Input::get('email');
                $user=$user->first();
                $user_name=$user->user;
                $displayName=$user->DisplayName;
                $password=str_random(10);
                $user->code=str_random(60);
                $user->password_tmp=Hash::make($password);
                $code=$user->code.$password;
                if($user->save())
                {
                     Mail::send('emails.auth.ForgetPassword',array('link'=>URL::to('account/recover',$code),'displayName'=>$displayName,'username'=>$user_name,'password'=>$password),function($message) use($email,$user_name) {
                       $message->to($email,$user_name)->subject('Your new password');
                    });
                   
                    return Redirect::to('/')
                        ->with('success','Your new password sent to your mail ');
                }
            }
            else{
              return Redirect::back()
                  ->with('error','Email ID not found. Please enter registered Email ID');
            }
        }
    }

    public function getRecover($code)
    {
        $data['id']=substr($code,0,60);
        $password=substr($code,60,70);
        $data['password']=$password;
        $validator=Validator::make($data,array('id'=>'alpha_num|min:60|max:60','password'=>'alpha_num|min:10|max:10'));
        if($validator->fails())
        {
           App::abort(404);
        }

        $user=User::where('code','=',$data['id'])
            ->where('password_tmp','!=','');
        if($user->count())
        {
            $user=$user->first();
            $user->password=$user->password_tmp;
            $user->password_tmp='';
            $user->code='';
            if($user->save())
            {
                if(Auth::attempt(array('email'=>$user->email,'password'=>$data['password'])))
                {
                    Session::flash('password',$password);
                    return Redirect::to('account/create-password');
                }

            }
            else{
                return Redirect::back()
                    ->with('error','Could not request new password');
            }
        }
        else{
            return Redirect::back()
                ->with('error','Could not request new password');
        }
    }
    public function getPpt()
    {
        return View::make('ppt');
    }


}
