@extends('layout.accountMain')
@section('content')
<div class="col-sm-10 col-md-4 col-lg-4 col-sm-offset-4 light-login" >
<div id="forgot-box" class="forgot-box widget-box no-border">
    <div class="widget-body">
        <div class="widget-main">
            <h4 class="header red lighter bigger">
                <i class="ace-icon fa fa-key"></i>
                Retrieve Password
            </h4>
            <form name="forgetPassword" action="<?php echo URL::to( 'account/forget-password'); ?>" method="post" onsubmit="return validation();">
                <fieldset>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="email" name="email" class="form-control" placeholder="Email" {{(Input::old('email'))? 'value="'.Input::old('email').'"':'' }} />
                            <i class="ace-icon fa fa-envelope"></i>
                        </span>
                        <span style="color: red">
                            @if($errors->has('email'))
                            {{$errors->first('email')}}
                            @endif
                        </span>
                    </label>
                    {{Form::token()}}
                    <div class="clearfix">
                        <button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
                            <i class="ace-icon fa fa-lightbulb-o"></i>
                            <span class="bigger-110">Send Me!</span>
                        </button>
                    </div>
                </fieldset>
            </form>
        </div><!-- /.widget-main -->

        <div class="toolbar center">
            <a href="<?php echo URL::to( 'account/login' ); ?>" data-target="#login-box" class="back-to-login-link">
                Back to login
                <i class="ace-icon fa fa-arrow-right"></i>
            </a>
        </div>
    </div><!-- /.widget-body -->
</div><!-- /.forgot-box -->
</div>
<script type="application/javascript">
    function validation()
    {
        var email=document.forgetPassword.email.value;
        var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
        var b=emailfilter.test(email);
        if(!email)
        {
            alert('please enter email ID');
            document.forgetPassword.email.focus();
            return false;
        }
        if(b==false)
        {
            alert("Please Enter a valid Mail ID");
            document.forgetPassword.email.focus();
            return false;
        }
    }
</script>
@stop