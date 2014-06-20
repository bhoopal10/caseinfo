<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 5/21/14
 * Time: 11:44 AM
 */
use Illuminate\Database\MySqlConnection;
class CasesController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('csrf',array('on'=>'post'));
    }
    public function getList()
    {
        $cases=Cases::all();
        return View::make('cases.listCases')
            ->with('cases',$cases);
    }

    public function postSearch ()
    {
        $value=Input::all();
        $fromdate=Input::get('fromdate');
        $fromdate=implode('-',array_reverse(explode('/',$fromdate)));
        $todate=Input::get('todate');
        $todate=implode('-',array_reverse(explode('/',$todate)));

        $judgeName=Input::get('judgeName');
        $judgeName=explode(',', rtrim($judgeName,','));

        $category=Input::get('category');
        $category=explode(',',rtrim($category,','));

        $advocateName=Input::get('advocateName');
        $advocateName=explode(',', rtrim($advocateName,','));

        $subject=trim(Input::get('subject'));

        $partiesName=Input::get('partiesName');
        $partiesName=explode(',', rtrim($partiesName,','));

        $reference=Input::get('reference');
        $reference=explode(',', rtrim($reference,','));

        $reference1=Input::get('reference1');
        $reference1=explode(',', rtrim($reference1,','));

        $enactment=trim(Input::get('enactment'));

        $caseNo=Input::get('caseNo');
        $caseNo=explode(',', rtrim($caseNo,','));
        $sql="select * from `case`";
        $param=array();

        /* Begin date filter*/
        if(empty($fromdate) && empty($todate))
        {
            $sql.="where jdate like '%%'";
        }

        if(!empty($fromdate) && !empty($todate))
        {
            $sql.=(empty($param))?" where ":"";
            $sql.=" jdate between '$fromdate' AND '$todate' ";
        }
        if(!empty($fromdate) && empty($todate))
        {
            $sql.=(empty($param))?" where ":"";
            $fromdate="'%$fromdate%'";
            $sql.=" jdate like $fromdate ";
        }
         if(empty($fromdate) && !empty($todate))
        {
            $sql.=(empty($param))?" where ":"";
            $todate="'%$todate%'";
            $sql.=" jdate like $todate";
        }
        /* End date filter */
        if(!empty($judgeName) && is_array($judgeName))
        {
           
            foreach($judgeName as $values)
            {
                if(!empty($values))
                {
                     $sql.=(empty($param))?" AND ( ":"";
                $sql.=(!empty($param))?" OR ":"";
                $sql.=" judgename like ? ";
                $param[].="%$values%";
                }
            }
        }
        if(!empty($category) && is_array($category))
        {
            
            foreach($category as $values)
            {
                if(!empty($values))
                {
                    $sql.=(empty($param))?" AND (":"";
                $sql.=(!empty($param))?" OR ":"";
                $sql.=" desc3 like ? ";
                $param[].="%$values%";
                }
            }
        }
        if(!empty($advocateName) && is_array($advocateName))
        {
            
            foreach($advocateName as $values)
            {
                if(!empty($values))
                {
                    $sql.=(empty($param))?" AND ( ":"";
                $sql.=(!empty($param))?" OR ":"";
                $sql.=" `Adv Name` like ? ";
                $param[].="%$values%";
                }
            }
        }
        if(!empty($partiesName) && is_array($partiesName))
        {
      
            foreach($partiesName as $values)
            {
                if(!empty($values))
                {
                          $sql.=(empty($param))?" AND (":"";
                $sql.=(!empty($param))?" OR ":"";
                $sql.=" title like ? ";
                $param[].="%$values%";
                }
            }
        }
        if(!empty($reference) && is_array($reference))
        {
            
            foreach($reference as $values)
            {
                if(!empty($values))
                {
                    $sql.=(empty($param))?" AND ( ":"";
                $sql.=(!empty($param))?" OR ":"";
                $sql.=" reference like ? ";
                $param[].="%$values%";
                }
            }
        }
        if(!empty($reference1) && is_array($reference1))
        {
            
            foreach($reference as $values)
            {
                if(!empty($values))
                {
                    $sql.=(empty($param))?" AND ( ":"";
                $sql.=(!empty($param))?" OR ":"";
                $sql.=" reference1 like ?";
                $param[].="%$values%";
                }
            }
        }
        if(!empty($caseNo) && is_array($caseNo))
        {
           
            foreach($caseNo as $values)
            {
                if(!empty($values))
                {
                     $sql.=(empty($param))?" AND ( ":"";
                $sql.=(!empty($param))?" OR ":"";
                $sql.=" `Case No` like ? ";
                $param[].="%$values%";
                }
            }
        }
        if(!empty($subject))
        {
            $sub=["hnote","desc","enactment"];
            foreach($sub as $subj)
            {

                $sql.=(empty($param))?" AND ( ":"";
                $sql.=(!empty($param))?" OR ":"";
                $word=str_replace(' ','|',$subject);
                $param[].=$word;
                $sql.=" `$subj` REGEXP ?";
            }

        }
        if(!empty($enactment))
        {
            $sub=["hnote","desc","enactment"];
            foreach($sub as $subj)
            {
                $sql.=(empty($param))?" AND ( ":"";
                $sql.=(!empty($param))?" OR ":"";
                $word=str_replace(' ','|',$enactment);
                $param[].=$word;
                $sql.=" `$subj` REGEXP ?";
            }

        }
        $sql.=(!empty($param))? " )":"";
// echo $sql;print_r($param);exit;
      $cases=DB::select("$sql",$param);
        return View::make('cases.listCases')
            ->with('cases',$cases)
            ->withInput(Input::flash());
    }

    public function postFilter ()
    {
        $values=Input::all();
        $judgeName=rtrim($values['judgename'],',');
        $category=rtrim($values['desc3'],',');
        $reference=rtrim($values['references'],',');
        $reference1=rtrim($values['references1'],',');
        $advocate=rtrim($values['AdvName'],',');
        $ids=$values['ids'];
        $sql="select * from `case` ";
        $param=array();
         $sql.=(!empty($ids))?" where SNo IN($ids) ":" where SNo IN(0) ";
        if(!empty($judgeName))
        {
            foreach(explode(',,',$judgeName) as $values)
            {
                if(!empty($values))
                {
            $sql.=(!empty($param))?" OR":" AND (";
            $sql.=" judgename like ? ";
            $param[].="%$values%";
                }
            }
        }
        if(!empty($category))
        {
            foreach(explode(',,',$category) as $values)
            {
                if(!empty($values))
                {
                    $sql.=(!empty($param))?" OR":" AND (";
                    $sql.=" desc3 like ? ";
                    $param[].="%$values%";
                }

            }
        }
        if(!empty($reference))
        {
            foreach(explode(',,',$reference) as $values)
            {
                if(!empty($values))
                {
                    $sql.=(!empty($param))?" OR":" AND (";
                    $sql.=" reference like ? ";
                    $param[].="%$values%";
                }

            }
        }
        if(!empty($reference1))
        {
            foreach(explode(',,',$reference1) as $values)
            {
                if(!empty($values))
                {
                    $sql.=(!empty($param))?" OR":" AND (";
                    $sql.=" reference1 like ? ";
                    $param[].="%$values%";
                }

            }
        }
        if(!empty($advocate))
        {
            foreach(explode(',,',$advocate) as $values)
            {
                if(!empty($values))
                {
                    $sql.=(!empty($param))?" OR":" AND (";
                    $sql.=" `Adv Name` like ? ";
                    $param[].="%$values%";
                }

            }
        }
        $sql.=(!empty($param))? " )":"";

        $cases=DB::select("$sql",$param);
        return View::make('cases.listCases')
            ->with('cases',$cases)
            ->withInput(Input::flash());
    }
    public function getAutoComplete($column)
    {
        if(isset($_GET['ids'])  && isset($_GET['term']))
        {
            $ids=$_GET['ids'];
            $term=$_GET['term'];
            $columns="`$column`";
            $values=DB::select("select distinct $columns from `case` where $columns is not null and $columns LIKE ? and SNo IN($ids)",array("%$term%"));
            $values=array_pluck($values,$column);
            if($values)
            {
                echo json_encode($values);
            }
        }
        if(isset($_GET['all'])  && isset($_GET['term']))
        {
            $term=$_GET['term'];
            $columns="`$column`";
            $values=DB::select("select distinct $columns from `case` where $columns is not null and $columns LIKE ? ",array("%$term%"));
            $values=array_pluck($values,$column);
            if($values)
            {
                echo json_encode($values);
            }
        }

    }
    public function getView($id)
    {
        $values=Cases::firstOrCreate(array('SNo'=>$id))->toArray();
        if($values){
            echo json_encode($values);
        }
        else{
            return false;
        }
    }
    public function getPopup($id)
    {
        $values=Cases::firstOrCreate(array('SNo'=>$id))->toArray();
        if($values){
            return View::make('cases.popupCaseDetail')->with('data',$values);
        }
        else{
            return false;
        }
    }
    public function getTest()
    {
        $data=User::findorFail(54);
        print_r($data->logs->log_history);
    }

} 