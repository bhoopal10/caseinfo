@extends('layout.main')
@section('sidebar')
@include('layout.sidebar')
@stop
@section('breadcrumbs')
<div id="breadcrumbs" class="breadcrumbs">
</div>
@stop
@section('content')
<div class="row">
    <?php $ids=array_pluck($cases,'SNo');
        if(!$ids)
        {
            $ids=array('0');
        }
        $ids=implode($ids,',');
    ?>
    <div class="col-xs-12 col-md-12  col-sm-12">
    <form class="form-inline" name="filter" action="<?php echo URL::to('cases/filter'); ?>" method="post">
        <label>
          <span>JudgeName:</span>
          <input id="judge" class="input-medium filter" type="text" id="judgeName" att="judgename" name="judgename" {{(Input::old('judgename')? 'value="'.Input::old('judgename').'"':'')}}>
        </label>
        <label>
            <span>Category:</span>
            <input class="input-medium filter " type="text" att="desc3" name="desc3" {{(Input::old('desc3')? 'value="'.Input::old('desc3').'"':'')}}>
        </label>
        <label>
            <span>Reference:</span>
            <input class="input-medium filter" type="text" att="reference" name="references" {{(Input::old('references')? 'value="'.Input::old('references').'"':'')}}>
        </label>
        <label>
            <span>Reference1:</span>
            <input class="input-medium filter" type="text" att="reference1" name="references1" {{(Input::old('references1')? 'value="'.Input::old('references1').'"':'')}}>
        </label>
        <label>
            <span>AdvocateName:</span>
            <input class="input-medium filter" type="text" att="Adv Name" name="AdvName" {{(Input::old('AdvName')? 'value="'.Input::old('AdvName').'"':'')}}>
        </label>
        <input type="hidden" name="ids" value="<?php echo $ids; ?>"{{(Input::old('ids')? 'value="'.Input::old('ids').'"':'')}}>
        <?php echo Form::token(); ?>

        <input type="submit" class="btn btn-primary form-control" style="border-radius: 3px;font-weight: bold" value="Search">
    </form>
        </div>

    <div class="col-xs-12 col-md-12  col-sm-12">
          <table id="grid-table"  class="table table-striped table-bordered table-hover dataTable">
        <thead>
        <tr>
            <th>SNo</th>
            <th>Title</th>
            <th>JudgeName</th>
            <th>JDate</th>
            <th>Enactment</th>
            <th>Reference</th>
            <th>Reference1</th>
          <th>View</th>
        </tr>
        </thead>
        <tbody>

        <?php if($cases) $i=1;{ foreach($cases as $case){ ?>
        <tr att="<?php echo $case->SNo; ?>">
            <td><?php echo $i; $i++; ?></td>
            <td><?php echo $case->title ?></td>
            <td><?php echo $case->judgename ?></td>
            <td><?php echo date('d/m/Y',strtotime($case->jdate)); ?></td>
            <td class="enactment" ><?php echo substr($case->enactment,0,50).'....'; ?></td>
            <td><?php echo $case->reference; ?></td>
            <td><?php echo $case->reference1; ?></td>
            <td style="cursor:pointer" onclick="window.open('<?php echo URL::to('cases/popup',$case->SNo).'?e='.Input::old('enactment').'&s='.Input::old('subject'); ?>','name','status=1,width=800,height=500,scrollbars=1')"><i class="ace-icon fa fa-hand-o-right"></i>View</td>

        </tr>
        <?php } }?>

        </tbody>
    </table>
        
        </div>
</div>
<!--<div class="dataTables_paginate paging_bootstrap pagination">-->
<!--    --><?php //echo $cases->links(); ?>
<!--</div>-->

<!-- Dialog Box -->
<div id="viewDialog" title="Case Info" class="disableSelection">

    <div class="row">
        <div class="col-md-12 heading">
            <div class="col-md-12">
                <div class="col-md-6 col-xs-12 col-sm-12 hl-content">
                    <p><h4><u>JudgeName:&nbsp;</u></h4><span class="judge"></span></p>
                    <p><h4><u>Title:&nbsp;</u></h4><span class="title"></span></p>
                    <p><h4><u>Category:&nbsp;</u></h4><span class="category"></span></p>

                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 hr-content">
                    <p><h4><u>JudgementDate:&nbsp;</u></h4><span class="jdate"></span></p>
                    <p><h4><u>Reference:&nbsp;</u></h4><span class="reference"></span></p>
                    <p><h4><u>Reference1:&nbsp;</u></h4><span class="reference1"></span></p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-12 ls-content ">
                    <h2><u>H-Note:</u></h2>
                </div>
                <div class="col-md-12 rs-content enactment">
                    <h2><u>Description:</u></h2>
                </div>
            </div>
        </div>

    </div>

</div>

<span id="enactment" att="<?php echo Input::old('enactment'); ?>"></span>
<span id="subject" att="<?php echo Input::old('subject'); ?>"></span>
<!-- End Dialog Box -->

@stop
@section('js')

<!--<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
{{HTML::script('public/js/jquery-ui-1.10.4.custom.min.js')}}
<script type="application/javascript">
    $("tbody tr2").on('click',function(){
        var id=$(this).attr('att');
        var url="<?php echo URL::to('cases/view'); ?>";
        var res= $.getJSON(url+'/'+id,function(data){
            $('#viewDialog .row .ls-content p,#viewDialog .row .rs-content p,#viewDialog .row .judge b,#viewDialog .row .jdate b,#viewDialog .row .category b,#viewDialog .row .title b,#viewDialog .row .reference b,#viewDialog .row .reference1 b').remove();
            $('.hl-content .judge').append("<b>"+data.judgename+"</b>");
            $('.hl-content .title').append("<b>"+data.title+"</b>");
            $('.hl-content .category').append("<b>"+data.desc3+"</b>");
            $('.hr-content .jdate').append("<b>"+data.jdate+"</b>");
            $('.hr-content .reference').append("<b>"+data.reference+"</b>");
            $('.hr-content .reference1').append("<b>"+data.reference1+"</b>");
            $('.ls-content').append("<p class='enactment' tyle='text-align:justify'>"+data.hnote+"</p>");
            $('.rs-content').append("<p class='enactment' style='text-align:justify'>"+data.desc+"</p>");
                var enact= $('#enactment').attr('att');
                var sub=$('#subject').attr('att');
                var multisub=sub.split(' ');
                var multienact=enact.split(' ');
                $.each(multienact,function(i,val){
                    $('.enactment').highlight(val); 
                });
                $.each(multisub,function(i,val){
                    $('.enactment').highlight(val);
                });
                    $('#viewDialog').dialog("open");
                })
    });
</script>
<script>
    $(function() {
        $( "#viewDialog" ).dialog({
            autoOpen: false,
            width:1000,

            maxHeight:500,
            show: {
                effect: "blind",
                duration: 1000
            },
            hide: {
                effect: "explode",
                duration: 1000
            },
            buttons: [
                {
                    text: "OK",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }
            ]
        });

    });
    
     
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
<script type="application/javascript">
    $(function(){

        function split(val)
        {
            return val.split(/,\s*/);
        }
        function extractLast(term)
        {
            return split(term).pop();
        }
        $('input.filter').each(function(){
            var el=$(this);
            var vals=el.attr('att');
            el.bind("keydown",function(event){
                if(event.keyCode == $.ui.keyCode.TAB &&
                    $(this).data("ui-autocomplete").menu.active)
                {
                    event.preventDefault();
                }
        })
            el.autocomplete({
                minLength:0,
                source:function(request,response,ui)
                {
                    $.getJSON( "<?php echo URL::to('cases/auto-complete');?>/"+vals+"<?php echo "?ids=$ids" ?>", {
                        term: extractLast( request.term )
                    }, response );
                },
                search: function() {
// custom minLength
                    var term = extractLast( this.value );
                    if ( term.length < 2 ) {
                        return false;
                    }
                },
                focus:function(){
                    return false;
                },

                select:function(event,ui){
                    var terms=split(this.value);
                    terms.pop();
                    terms.push(ui.item.value);
                    terms.push("");
                    this.value=terms.join(",,");
                    return false;

                }

            });
    });
    });
</script>
@stop
@section('css')
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">-->
{{HTML::style('public/css/jquery-ui-1.10.4.custom.min.css')}}
<style>
    .ui-autocomplete {
        max-height: 100px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
    }
    /* IE 6 doesn't support max-height
    * we use height instead, but this forces the menu to always be this tall
    */
    * html .ui-autocomplete {
        height: 500px;
    }
    /*.disableSelection{
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        outline: 0;
    }*/
</style>
@stop