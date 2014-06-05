@extends('layout.accountMain')

@section('content')
<div class="col-sm-10 col-md-4 col-lg-4 col-sm-offset-4 light-login" >
<div id="signup-box" class="signup-box widget-box no-border">
    <div class="widget-body">
        <div class="widget-main">
            <h4 class="header green lighter bigger">
                <i class="ace-icon fa fa-users blue"></i>
                New User Registration
            </h4>

            <form name="reg" action="<?php echo URL::to('account/create'); ?>" method="post" onsubmit="return validation();">
                <label class="block clearfix">
                    <input type="text" name="first_name" class="form-control" placeholder="First Name" {{Input::old('first_name') ? 'value="'.Input::old('first_name').'"':'' }}/>
                    <span style="color: red">
                    @if($errors->has('first_name'))
                    {{$errors->first('first_name')}}
                    @endif
                    </span>
                </label>
                <label class="block clearfix">
                    <input type="text" name="last_name" placeholder="Last Name" class="form-control" {{Input::old('last_name') ? 'value="'.Input::old('last_name').'"':''}}/>
                    <span style="color: red">
                    @if($errors->has('last_name'))
                    {{$errors->first('last_name')}}
                    @endif
                    </span>
                </label>
                <label class="block clearfix">
                    <input type="text" name="user" class="form-control" placeholder="UserName" {{Input::old('user') ? 'value="'.Input::old('user').'"':''}}/>
                    <span style="color: red">
                    @if($errors->has('user'))
                    {{$errors->first('user')}}
                    @endif
                    </span>
                </label>
                <label class="block clearfix">
                    <input type="text" name="email" class="form-control" placeholder="email" {{Input::old('email') ? 'value="'.Input::old('email').'"':''}}/>
                    <span style="color: red">
                    @if($errors->has('email'))
                    {{$errors->first('email')}}
                    @endif
                    </span>
                </label>
                <label class="block clearfix">
                    <input type="password" name="password" class="form-control" placeholder="password"/>
                    <span style="color: red">
                    @if($errors->has('password'))
                    {{$errors->first('password')}}
                    @endif
                    </span>
                </label>
                <label class="block clearfix">
                    <input type="password" name="confirm_password" class="form-control" placeholder="confirm password"/>
                    <span style="color: red">
                    @if($errors->has('confirm_password'))
                    {{$errors->first('confirm_password')}}
                    @endif
                    </span>
                </label>
                <label class="block clearfix">
                    <input type="text" name="mobile" class="form-control" placeholder="mobile" {{(Input::old('mobile')) ? 'value="'.Input::old('mobile').'"':''}}/>
                    <span style="color: red">
                    @if($errors->has('mobile'))
                    {{$errors->first('mobile')}}
                    @endif
                    </span>
                </label>
                <label class="block clearfix">
                    <input type="text" name="phone" class="form-control" placeholder="Phone" {{(Input::old('phone')) ? 'value="'.Input::old('phone').'"':''}}/>
                    <span style="color: red">
                    @if($errors->has('phone'))
                    {{$errors->first('phone')}}
                    @endif
                    </span>
                </label>
                {{Form::token()}}
                <div class="space-24"></div>
                <div class="clearfix">
                    <button type="reset" class="width-30 pull-left btn btn-sm">
                        <i class="ace-icon fa fa-refresh"></i>
                        <span class="bigger-110">Reset</span>
                    </button>
                    <button type="submit" class="width-65 pull-right btn btn-sm btn-success">
                        <span class="bigger-110">Register</span>

                        <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="toolbar center">
            <a href="<?php echo URL::to( 'account/login' ); ?>"  class="back-to-login-link">
                <i class="ace-icon fa fa-arrow-left"></i>
                Back to login
            </a>
        </div>
    </div>
</div>
</div>
<script type="application/javascript">
    function validation()
    {

        var firstname=document.reg.first_name.value;
        var user=document.reg.user.value;
        var email=document.reg.email.value;
        var password=document.reg.password.value;
        var confirm=document.reg.confirm_password.value;
        var mobile=document.reg.mobile.value;
        var phone=document.reg.phone.value;
        var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
        var b=emailfilter.test(email);

        if(!firstname)
        {
            alert('Please enter First Name');
            document.reg.first_name.focus();
            return false;
        }
        if(!user)
        {
            alert('Please enter UserName');
            document.reg.user.focus();
            return false;
        }
        if(!email)
        {
            alert('Please enter Email');
            document.reg.email.focus();
            return false;
        }
        if(b==false)
        {
            alert("Please Enter a valid Mail ID");
            document.reg.email.focus();
            return false;
        }
        if(!password)
        {
            alert('Please enter password');
            document.reg.password.focus();
            return false;
        }
        if(!confirm)
        {
            alert('Please enter Confirm Password');
            document.reg.confirm_password.focus();
            return false;
        }
        if(password != confirm)
        {
            alert('Confirm password mismatch');
            document.reg.confirm_password.focus();
            return false;
        }
        if(!mobile)
        {
            alert('Please enter Mobile number');
            document.reg.mobile.focus();
            return false;
        }
        if(isNaN(mobile))
        {
            alert("Enter the valid Mobile Number(Like : 9566137117)");
            document.reg.mobile.focus();
            return false;
        }
        if(mobile.length != 10)
        {
            alert(" Your Mobile Number must be 10 Integers");
            document.reg.mobile.select();
            return false;
        }
        if(isNaN(phone))
        {
            alert("Phone must be numeric");
            document.reg.phone.focus();
            return false;
        }
    }
</script>
@stop