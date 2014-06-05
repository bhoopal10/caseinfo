<!DOCTYPE html>
<html>
<head>
	<title>CaseInfo</title>
	{{HTML::style('public/css/bootstrap.min.css')}}
   {{HTML::style('public/css/font-awesome.min.css')}}
   <style type="text/css">
	   html {
	  overflow-x: hidden;
	  overflow-y: auto;
	}	
	 .highlight { background-color: yellow }
	</style>
</head>
<body>
<div id="viewDialog" title="Case Info" class="disableSelection">

    <div class="row">
        <div class="col-md-12 heading">
            <div class="col-md-12">
                <div class="col-md-6 col-xs-12 col-sm-12 hl-content">
                    <p><h4><u>JudgeName:&nbsp;</u></h4><span class="judge">{{$data['judgename']}}</span></p>
                    <p><h4><u>Title:&nbsp;</u></h4><span class="title">{{$data['title']}}</span></p>
                    <p><h4><u>Category:&nbsp;</u></h4><span class="category">{{$data['desc3']}}</span></p>

                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 hr-content">
                    <p><h4><u>JudgementDate:&nbsp;</u></h4><span class="jdate">{{$data['jdate']}}</span></p>
                    <p><h4><u>Reference:&nbsp;</u></h4><span class="reference">{{$data['reference']}}</span></p>
                    <p><h4><u>Reference1:&nbsp;</u></h4><span class="reference1">{{$data['reference1']}}</span></p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-12 ls-content enactment ">
                    <h2><u>H-Note:</u></h2>
                   <p style="text-align:justify"> {{$data['hnote']}}</p>
                </div>
                <div class="col-md-12 rs-content enactment">
                    <h2><u>Description:</u></h2>
                   <p style="text-align:justify"> {{$data['desc']}}</p>
                </div>
            </div>
        </div>

    </div>
<span id="enactment" att="<?php echo $_GET['e']; ?>"></span>
<span id="subject" att="<?php echo $_GET['s']; ?>"></span>
</div>
<!--[if IE]>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<![endif]-->

<!--[if !IE]> -->
<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo URL::to('/'); ?>/public/js/jquery.min.js'>"+"<"+"/script>");
</script>
<!-- <![endif]-->
{{HTML::script('public/js/highlight.js')}}
	<script type="text/javascript">
	 $(function(){

        var enact= $('#enactment').attr('att');
        var sub=$('#subject').attr('att');
        var multisub=sub.split(' ');
        var multienact=enact.split(' ');
        $.each(multienact,function(i,val){

            $('.enactment').highlight(val); 
        });
        $.each(multisub,function(i,val){
            $('.enactment').highlight(val);
        })
        
    });
	</script>
</body
