@extends('layout.accountMain')
@section('content')
<div class="col-sm-10 col-md-4 col-lg-4 col-sm-offset-4 light-login" >
    <div class="widget-box no-border visible login-box" id="login-box">
        <div class="widget-body">
            <div class="widget-main">
                <h3 class="header green lighter bigger center" >
                    <i class="ace-icon fa fa-unlock  blue"></i>
                    Login
                </h3>
                <form name="login" action="<?php echo URL::to('account/login'); ?>" method="post" onsubmit="return validation();">
                    <label class="block clearfix">
                        <span class="block">
                            <input type="text" name="username" class="form-control" placeholder="Username" {{Input::old('username') ? 'value="'.Input::old('username').'"':''}}/>
                        </span>
                         <span style="color: red">
                            @if($errors->has('username'))
                            {{$errors->first('username')}}
                            @endif
                         </span>
                    </label>
                    <label class="block clearfix">
                        <span class="block">
                             <input type="password" name="password" placeholder="Password" class="form-control"/>
                        </span>
                          <span style="color: red">
                            @if($errors->has('password'))
                            {{$errors->first('password')}}
                            @endif
                          </span>
                    </label>
                    {{Form::token()}}
                    <div class="space"></div>
                    <div class="clearfix">
                        <label class="inline">
                            <input type="checkbox"  name="remember" />
                            <span class="lbl"> Remember Me</span>
                        </label>
                        <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                            <i class="ace-icon fa fa-key"></i>
                            <span class="bigger-110">Login</span>
                        </button>
                    </div>
                </form>
            </div><!--end Widget main-->
                <div class="toolbar clearfix">
                    <div>
                        <a href="<?php echo URL::to('account/forget-password'); ?>"  class="forgot-password-link">
                            <i class="ace-icon fa fa-arrow-left"></i>
                            I forgot my password
                        </a>
                    </div>

                    <div>
                        <a href="<?php echo URL::to( 'account/create' ); ?>"  class="user-signup-link">
                            I want to register
                            <i class="ace-icon fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
        </div><!--End Widget body-->
    </div>
</div>
<script type="application/javascript">
    function validation()
    {
        var username=document.login.username.value;
        var password=document.login.password.value;
        if(!username)
        {
            alert('Please enter Username');
            document.login.username.focus();
            return false;
        }
        if(!password)
        {
            alert('Please enter password');
            document.login.password.focus();
            return false;
        }
    }
</script>
@stop