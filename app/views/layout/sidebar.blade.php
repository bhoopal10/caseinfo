<div id="sidebar" class="sidebar responsive" >
<div id="sidebar-shortcuts" class="sidebar-shortcuts">

</div><!-- sidebar-shortcuts-->

<ul class="nav nav-list" style="padding-left: 5px!important;">
    <?php use Illuminate\Support\Facades\Input;
        use libraries\libCase; $year=libCase::year();   ?>
    <li>
    <!-- {{Form::open(array('url'=>'cases/search','method'=>'post','id'=>'form','onsubmit'=>'return searchValidation()','name'=>'search'))}} -->
    <form id="form" action="<?php echo URL::to('cases/search'); ?>" method="post" onsubmit="return searchValidation()" name='seach'>
        <label>From:</label>
        <input type="text" name="fromdate" placeholder="dd/mm/yyyy" id="fromdate" style="width: 180px" {{Input::old('fromdate') ? 'value="'.Input::old('fromdate').'"':''}}> 
        <label>To:</label>
        <input type="text" name="todate" placeholder="dd/mm/yyyy" id="todate" style="width: 180px" {{Input::old('todate') ? 'value="'.Input::old('todate').'"':''}}>
        <label>Title / Parties Name:</label>
        <input type="text" name="partiesName" class="search" att="title" style="width: 180px" {{Input::old('partiesName') ? 'value="'.Input::old('partiesName').'"':''}}>
        <label>JudgeName:</label>
        <input type="text" name="judgeName" class="search" att="judgename" style="width: 180px"{{Input::old('judgeName') ? 'value="'.Input::old('judgeName').'"':''}}>
        <label>Enactment</label>
        <input type="text" name="enactment" placeholder="Words separates with space" style="width: 180px" {{Input::old('enactment') ? 'value="'.Input::old('enactment').'"':''}}>
        <label>Subject:</label>
        <input type="text" name="subject"  placeholder="Words separates with space" style="width: 180px" {{(Input::old('subject')? 'value="'.Input::old('subject').'"':'')}}>
        <label>Advocate Name:</label>
        <input type="text" name="advocateName" att="Adv Name" class="search" style="width: 180px" {{Input::old('advocateName') ? 'value="'.Input::old('advocateName').'"':''}} >
        <label>CaseNo:</label>
        <input type="text" name="caseNo" class="search" att="Case No" style="width: 180px" {{Input::old('caseNo') ? 'value="'.Input::old('caseNo').'"':''}}>
        <label>Category:</label>
        <input type="text" name="category" class="search" att="desc3" style="width: 180px" {{Input::old('category') ? 'value="'.Input::old('category').'"':''}}>
        <label>Reference:</label>
        <input type="text" name="reference" class="search" att="reference" style="width: 180px" {{Input::old('reference') ? 'value="'.Input::old('reference').'"':''}}>
        <label>Reference1:</label>
        <input type="text" name="reference1" class="search" att="reference1" style="width: 180px" {{Input::old('reference1') ? 'value="'.Input::old('reference1').'"':''}}>
           
    {{Form::token()}}
        <input type="submit" class="btn btn-primary" value="Search">
   
    <!-- {{Form::close()}} -->
    </form>
    </li>

</ul><!--/.nav-list-->

<div id="sidebar-collapse" class="sidebar-toggle sidebar-collapse">
    <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>
<script type="text/javascript">
                    try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
                </script>
</div>
<script type="text/javascript">
    function searchValidation(){
        var formdate=document.getElementById('fromdate').value;
        var todate=document.getElementById('todate').value;
        if(fromdate.value)
        {
            if(!todate){
                alert('Please select To date');
                return false;
            }
            else{
                var from=fromdate.value.split('/');
                var from=from[2]+'-'+from[1]+'-'+from[0];
                var to=todate.split('/');
                var to=to[2]+'-'+to[1]+'-'+to[0];
                if(new Date(from) > new Date(to))
                {
                    alert('Todate must greater than from date');
                }

            }

        }
        if(!fromdate.value){
            if(todate)
            {
                alert('Please select From date');
                return false;
            }
        }
        
        
    }
</script>
@section('sidebarjs')
<script type="text/javascript">
     $(function(){

        function split(val)
        {
            return val.split(/,\s*/);
        }
        function extractLast(term)
        {
            return split(term).pop();
        }
        $('input.search').each(function(){
            var cache = {};
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
                    var term=request.term;
                     if ( term in cache ) 
                     {
                        response( cache[ term ] );
                        return;
                    }
                    $.getJSON( "<?php echo URL::to('cases/auto-complete');?>/"+vals+"<?php echo "?all=all" ?>", {
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
                    this.value=terms.join(",");
                    return false;

                }
                 
            

            });
    });
    });
</script>

@stop

