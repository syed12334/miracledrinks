<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voucher_db extends CI_Model{

		
		
    
    function gettable($db=array())
    {
    	$table = "vouchers";
    	$page = $db['page'];
    	$ordernuberquery="";
    	$rp = $db['rp'];
    
    	$sortname = $db['sortname'];
    
    	$sortorder = $db['sortorder'];
    
    	if(!empty($db['type']))
    	{
    		$ordernuberquery.=" and type='".$db['type']."'";
    	}
    	 
    	if(!empty($db['title']))
    	{
    		$ordernuberquery.=" and title like '%".$db['title']."%'";
    	}
    	
    	if(!empty($db['code']))
    	{
    		$sql = "select cid from voucher_code where code like '%".$db['code']."%'";
    		$ordernuberquery.=" and id in($sql)";
    	}
    	 
    	if($db['stat']=='0' || $db['stat']=='1')
    	{
    		$ordernuberquery.=" and status='".$db['stat']."' ";
    	}
    	
    	if(!empty($db['fromdate']))
    	{
    		$ordernuberquery.=" and DATE(from_date)='".date('Y-m-d',strtotime($db['fromdate']))."'";
    	}
    	 
    	if(!empty($db['todate']))
    	{
    		$ordernuberquery.=" and DATE(to_date) >= '".date('Y-m-d',strtotime($db['todate']))."' ";
    	}
    	 
    
    	if($db['query']!=''){
    
    		$where = " WHERE 1 $ordernuberquery and ".$db['qtype']." LIKE '%".$db['query']."%'";
    
    	} else {
    
    		$where =" WHERE 1 $ordernuberquery";
    
    	}
    
    	$sort = "ORDER BY $sortname $sortorder";
    
    	if (!$page) $page = 1;
    
    	if (!$rp) $rp = 10;
    
    	$start = (($page-1) * $rp);
    
    	$limit = "LIMIT $start, $rp";
    
    	$sql = "SELECT * FROM  $table $where $sort $limit";
		echo $sql;exit;
    	$result = $this->db->query($sql);
    
    	$tempsql=" ".$table." ".$where." ".$sort." ".$limit;    
    
    	$total = $this->countRec('id',$table,$where);   
        
    	header("Content-type: application/json");       
    
    	$json = '';
    
    	$json .= '{';
    
    	$json .= '"page": '.$page.',';
    
    	$json .= '"total": '.$total.',';
    
    	$json .= '"rows": [';
    
    	$rc = false;
    
    	$counter123=1;   
   	    $arr = array("Single Usage", "Multiple Usage");
    
    	foreach($result->result() as $row) {    
    
    
    		if($row->status=='0')    
    		{
    
    			$status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";
    
    			$chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";
    
    		}    
    		else    
    		{
    
    			$status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";
    
    			$chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";
    
    		}
    
    		$edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";
    		$view="<button class='btn btn-primary btn-sm btn-grad' onclick='viewRecord(".$row->id.")'><i class='icon-eye-open'></i> View </button>";
    		$export="<button class='btn btn-warning btn-sm btn-grad' onclick='exportexcel(".$row->id.")'><i class='icon-eye-open'></i> Export Excel </button>";
    		
    		$finalquery=str_replace(" ","~",$tempsql);
    
    		if ($rc) $json .= ',';
    
    		$json .= '{';
    
    		$json .= '"id":"'.$row->id.'","';
    
    		$json .= 'cell":["'.$counter123.'","'.$arr[$row->type].'","'.addslashes(str_replace("'","`",$row->title)).'","'.date_format(date_create($row->from_date), 'd-m-Y').'","'.date_format(date_create($row->to_date), 'd-m-Y').'","'.$row->no_of_coupons.'","'.$row->discount.'"';
    
    		$json .= ',"'.$status.'","'.$chng.'&nbsp;'.$edit.'&nbsp;'.$view.'&nbsp;'.$export.'"]';
    
    		 
    		$json .= "}";
    
    		$rc = true;
    		 
    
    		$counter123++;
    
    	}
    
    	$json .= "]";
    
    	$json .= "}";
    
    	return $json;
    
    }
    
	function countRec($fname,$tname,$where)
    {

        $sql = "SELECT * FROM $tname $where";

        $q=$this->db->query($sql);

        return $q->num_rows();

    }
    
    function getvoucherdetails($id){
    	$sql = "select type, title, from_date, to_date, discount, code, v.status vstatus, c.status cstatus, used_count from vouchers v, voucher_code c where v.id=c.cid and v.id=$id";
    	$q=$this->db->query($sql);
    	if($q->num_rows() > 0){
    		return $q->result();
    	}
    	else{
    		return 0;
    	}
    }
    
   

}

?>