@extends('layout.main')
@section('content')
<div class="col-sm-10 col-md-4 col-lg-4 col-sm-offset-4 light-login" >
    <div class="widget-box no-border visible login-box" id="login-box">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header green lighter biggern center">
                    <i class="ace-icon fa fa-cog  blue"></i>
                    Change Password
                </h4>
                <form name="changePassword" action="<?php echo URL::to('account/change-password') ?>" method="post" onsubmit="return validation();">
                    <label class="block clearfix">
                        <span class="block">
                            <input type="password" name="old_password" class="form-control" placeholder="Old Password"/>
                        </span>
                        <span style="color:red">
                        @if($errors->has('old_password'))
                        {{$errors->first('old_password')}}
                        @endif
                        </span>
                    </label>
                    <label class="block clearfix">
                        <span class="block">
                            <input type="password" name="new_password" class="form-control" placeholder="New Password"/>
                        </span>
                        <span style="color: red">
                            @if($errors->has('new_password'))
                            {{$errors->first('new_password')}}
                            @endif
                        </span>
                    </label>
                    <label class="block clearfix">
                        <span class="block">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password"/>
                        </span>
                        <span style="color: red">
                        @if($errors->has('confirm_password'))
                        {{$errors->first('confirm_password')}}
                        @endif
                        </span>
                    </label>
                        {{Form::token()}}
                    <div class="space"></div>
                    <div class="clearfix">
                        <input type="submit" value="Change Password" class="btn btn-info btn-block"/>
                     </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    function validation()
    {
        var oldPassword=document.changePassword.old_password.value;
        var newPassword=document.changePassword.new_password.value;
        var confirmPassword=document.changePassword.confirm_password.value;
        if(!oldPassword)
        {
            alert('Please enter old password');
            document.changePassword.old_password.focus();
            return false;
        }
        if(!newPassword)
        {
            alert('Please enter new password');
            document.changePassword.new_password.focus();
            return false;
        }
        if(!confirmPassword)
        {
            alert('Please enter confirm password');
            document.changePassword.confirm_password.focus();
            return false;
        }
        if(newPassword != confirmPassword)
        {
            alert('Confirm password mismatch');
            document.changePassword.confirm_password.focus();
            return false;
        }
    }
</script>
@stop