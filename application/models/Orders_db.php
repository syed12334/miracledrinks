<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_db extends CI_Model{

	function getseaterwithout($type,$pid,$id){
		$sql = "select sname,ppage_url,sid from ".$type."_seater_view where pid='$pid' and (sid!=0 and sid!='$id') and selling_price !='' and stock>0 group by sid ";
		$q=$this->db->query($sql);
		if($q->num_rows()>0)
			return $q->result();
		else
			return 0;
	}
	
	function getnumberformat($num){
		return str_replace(".00", "", (string)number_format((float)$num, 2, '.', ','));
	}
	
	function countRec($fname,$tname,$where)
    {
		$sql = "SELECT $fname FROM $tname $where";
    	$q=$this->db->query($sql);
        return $q->num_rows();
    }
    
    function changeorderstatus($id){
    	$sql = "select status from orders where id='$id'";
    	$q=$this->db->query($sql);
    	if($q->num_rows()>0){
    		$res = $q->result();
    		if($res[0]->status == "1"){
    			$sql="update orders set status=2 WHERE id IN ('".$id."')";
    			
    			$this->db->query($sql);
    		}
    	}
    	
    }
    
   	
	function getuser_orders($db=array())	
	{
		
		$table='orders as o, users as u';
		$ordernuberquery="";
		if(!empty($db['orderno']))
		{
			$ordernuberquery.=" and orderid like '%".$db['orderno']."%'";
		}
		if(!empty($db['name']))
		{
			$ordernuberquery.=" and (u.name like '%".$db['name']."%')";
		}
		if(!empty($db['phone']))
		{
			$ordernuberquery.=" and (u.phone like '%".$db['phone']."%' or b.bphone like '%".$db['phone']."%' or b.sphone like '%".$db['phone']."%')";
		}
		if(!empty($db['fromdate']) && !empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(ordered_date) between '".date('Y-m-d',strtotime($db['fromdate']))."' and '".date('Y-m-d',strtotime($db['todate']))."' ";
		}
		else if(!empty($db['fromdate']) && empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(ordered_date) >= '".date('Y-m-d',strtotime($db['fromdate']))."' ";
		}
		else if(empty($db['fromdate']) && !empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(ordered_date) <= '".date('Y-m-d',strtotime($db['todate']))."' ";
		}
		$sortname = 'o.orderid';
		$sortorder = 'desc';
		$where =' WHERE o.status !=5 ';
		$sort = "ORDER BY $sortname $sortorder";
		$total = $this->countRec('o.id',$table,$where);
		$page = 1;
		$rp = 10;
		$start = (($page-1) * $rp);
		$limit = "LIMIT $start, $rp";
		$sql = "SELECT o.id,o.orderid, o.status,u.emailid,o.total_amt_paid,o.tot_qty,o.total_amt,u.name,u.phone,o.invoice_no,o.invoice_date,o.ordered_date,o.invoice_by,o.invoice_pdf,DATE_FORMAT(ordered_date,'%d-%m-%Y %h:%i %p') AS ordered_date FROM  $table $where  $sort $limit";	
		$q=$this->master_db->sqlExecute($sql);
		return $q;
	}
	
	function getwholesaler_user_orders($db=array())	
	{
		
		$table='orders as o, users as u, orders_bill_ship b';
		$ordernuberquery="";
		if(!empty($db['orderno']))
		{
			$ordernuberquery.=" and orderid like '%".$db['orderno']."%'";
		}
		if(!empty($db['name']))
		{
			$ordernuberquery.=" and (u.name like '%".$db['name']."%')";
		}
		if(!empty($db['phone']))
		{
			$ordernuberquery.=" and (u.phone like '%".$db['phone']."%' or b.bphone like '%".$db['phone']."%' or b.sphone like '%".$db['phone']."%')";
		}
		if(!empty($db['fromdate']) && !empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(ordered_date) between '".date('Y-m-d',strtotime($db['fromdate']))."' and '".date('Y-m-d',strtotime($db['todate']))."' ";
		}
		else if(!empty($db['fromdate']) && empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(ordered_date) >= '".date('Y-m-d',strtotime($db['fromdate']))."' ";
		}
		else if(empty($db['fromdate']) && !empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(ordered_date) <= '".date('Y-m-d',strtotime($db['todate']))."' ";
		}
		$sortname = 'o.ordered_date';
		$sortorder = 'desc';
		$where =' WHERE 1 and o.user_id=u.id and o.id=oid '.$ordernuberquery.' and u.user_type=2 ';
		$sort = "ORDER BY $sortname $sortorder";
		$total = $this->countRec('o.id',$table,$where);
		$page = 1;
		$rp = 10;
		$start = (($page-1) * $rp);
		$limit = "LIMIT $start, $rp";
		$sql = "SELECT o.id,o.orderid, o.status,u.emailid,o.total_amt_paid,o.invoice_no,o.invoice_date,o.invoice_by,o.invoice_pdf,o.tot_qty,u.name,u.phone,DATE_FORMAT(ordered_date,'%d-%m-%Y %h:%i %p') AS ordered_date FROM  $table $where  $sort $limit";	
		$q=$this->master_db->sqlExecute($sql);
		return $q;
	}
	
	
	
	function getexport($db=array())
	{
	
		$table='orders as o, users as u, orders_bill_ship b';
	
		$ordernuberquery="";
	
	if(!empty($db['orderno']))
		{
			$ordernuberquery.=" and orderid like '%".$db['orderno']."%'";
		}
		
		if(!empty($db['name']))
		{
			$ordernuberquery.=" and (u.name like '%".$db['name']."%')";
		}
		
		if(!empty($db['phone']))
		{
			$ordernuberquery.=" and (u.phone like '%".$db['phone']."%' or b.bphone like '%".$db['phone']."%' or b.sphone like '%".$db['phone']."%')";
		}
	
		if(!empty($db['email']))
		{
			$ordernuberquery.=" and (u.emailid like '%".$db['email']."%' or b.bemail like '%".$db['bemail']."%' or b.semail like '%".$db['bemail']."%')";
		}
	
		if($db['stat']=='-1' || $db['stat']=='1' || $db['stat']=='2' || $db['stat']=='3' || $db['stat']=='4')
		{
			$ordernuberquery.=" and o.status='".$db['stat']."' ";
		}	
		
		if(!empty($db['fromdate']) && !empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(ordered_date) between '".date('Y-m-d',strtotime($db['fromdate']))."' and '".date('Y-m-d',strtotime($db['todate']))."' ";
		}
	
		else if(!empty($db['fromdate']) && empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(ordered_date) >= '".date('Y-m-d',strtotime($db['fromdate']))."' ";
		}
	
		else if(empty($db['fromdate']) && !empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(ordered_date) <= '".date('Y-m-d',strtotime($db['todate']))."' ";
		}
	
		$sortname = 'o.id';
	
		$sortorder = 'asc';
	
		$where =' WHERE 1 and o.user_id=u.id and o.id=b.oid  '.$ordernuberquery.' ';
	
		$sort = "ORDER BY $sortname $sortorder";
	
		$sql = "SELECT b.*,o.*,u.name as ufname,u.emailid uemail,phone FROM  $table $where  $sort ";
	
		$result = $this->db->query($sql);
		return $result->result();
	
	}
	
	
	
	function orderStatus($table,$db=array())
	{
		$sql="";
		$this->db->where('order_id',$db['order_id']);
		$this->db->where('spec_id',$db['spec_id']);
		$q=$this->db->update($table,$db);
		$total = $this->db->affected_rows();
		header("Content-type: application/json");
		$json = "";
		$json .= "{";
		$json .= '"query": "'.$sql.'",';
		$json .= '"total": "'.$total.'"';
		$json .= "}";
		
		$st = $this->getorder_products($db['order_id'],'');
		$arra = array();
		foreach ($st as $s){
			$arra[] = $s->status;
		}
		$occurences = array_count_values($arra);
		if(array_key_exists(0,$occurences) && $occurences[0]==count($arra))
		{
			$status=0;
		}
		else if(array_key_exists(1,$occurences) && $occurences[1]==count($arra))
		{
			$status=1;
		}
		else if(array_key_exists(3,$occurences) && $occurences[3]==count($arra))
		{
			$status=3;
		}
		else
		{
			$status=2;
		}
		$ordid = $db['order_id'];
			$db=array(
    			'id'=>$ordid,
    			'status'=>$status,
    		);
			$this->report_db->reviewStatus('orders',$db);
		return $json;
	}
	
	function orderStatusnew($table,$db=array())
	{
		$this->db->where('order_id',$db['order_id']);
		$this->db->where('status ',3);
		$q=$this->db->update($table,$db);
	}
	
	
}

?>