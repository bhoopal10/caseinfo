<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title></title>
    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    {{HTML::style('public/css/bootstrap.min.css')}}
<!--    {{HTML::style('public/css/bootstrap-responsive.min.css')}}-->
    {{HTML::style('public/css/font-awesome.min.css')}}
    <!-- text fonts -->


    {{HTML::style('public/css/ace.min.css')}}
<!--    {{HTML::style('public/css/ace-responsive.min.css')}}-->
    {{HTML::style('public/css/ace-skins.min.css')}}

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo URL::to('/'); ?>/public/css/ace-part2.min.css" />
    <![endif]-->
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo URL::to('/'); ?>/public/css/ace-ie.min.css" />
    <![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
{{HTML::script('public/js/ace-extra.min.js')}}
    <!--[if lte IE 8]>
    <script src="<?php echo URL::to('/'); ?>/public/js/html5shiv.js"></script>
    <script src="<?php echo URL::to('/'); ?>/public/js/respond.min.js"></script>
    <![endif]-->
    <style>
        label{
            font-family:"Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-weight: bold;
        }
        .highlight { background-color: yellow }

    </style>
    @yield('css')
</head>
<body class="no-skin">
@include('layout.navigation')
<div class="main-container" id="main-container">
    <!--If user athenticated then side bar wiill display -->
    @if(Auth::check())
    @yield('sidebar')

    <div class="main-content">
            @yield('breadcrumbs')
            @if(Session::has('success'))
                <div class="alert alert-success">
                {{Session::get('success')}}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-success">
                 {{Session::get('error')}}
                </div>
            @endif
        <div class="page-content">
            <div class="row">
                <div class="col-xs-12">
                     @yield('content')
                </div>
            </div>
        </div>
    </div>
    <!-- if user guest then only content -->
    @elseif(Auth::guest())
    <div id="main-content" class="clearfix">
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger">
            {{Session::get('error')}}
        </div>
        @endif
        <div id="page-content">
            @yield('content')
        <div>
        @endif

    </div>
</div>
<!--[if !IE]> -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<![endif]-->

<!--[if !IE]> -->
<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo URL::to('/'); ?>/public/js/jquery.min.js'>"+"<"+"/script>");
</script>
<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo URL::to('/'); ?>/public/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo URL::to('/'); ?>/public/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
{{HTML::script('public/js/bootstrap.min.js')}}

{{ HTML::script('public/js/jquery.dataTables.min.js')}}
{{ HTML::script('public/js/jquery.dataTables.bootstrap.js')}}

{{HTML::script('public/js/ace-elements.min.js')}}
{{HTML::script('public/js/ace.min.js')}}


<!--[if lte IE 8]>
{{HTML::script('public/js/excanvas.min.js')}}
<![endif]-->
{{HTML::script('public/js/highlight.js')}}
@yield('js')
@yield('sidebarjs')
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(600, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
</script>
<script type="text/javascript">
    $(function() {
        var oTable1 = $('#grid-table').dataTable( {
            "aoColumns": [
                { "bSortable": true },
                null, null,null, null, null,null,
                { "bSortable": false }
            ] } );
    });

</script>
<style>

    .menu-min .nav-list > li >form{
        visibility: hidden;
    }
    .menu-min .nav-list > li >input{
        visibility: hidden;
    }

</style>
<script type="text/javascript">
    $(function() {
            $("#fromdate").datepicker({
                changeMonth: true,
                changeYear: true,

                dateFormat:'dd/mm/yy',
                 onClose: function( selectedDate ) {
            $( "#todate" ).datepicker( "option", "minDate", selectedDate );
        }
        });
              $("#todate").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat:'dd/mm/yy',
                 onClose: function( selectedDate ) {
            $( "#fromdate" ).datepicker( "option", "maxDate", selectedDate );
        }
        });
    });
</script>
</body>
</html>