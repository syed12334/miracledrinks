<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_db extends CI_Model{

	function getcount($table,$status)
	{
		if(!empty($status)){
			$this->db->where('status',$status);
		}
		$q=$this->db->get($table);
		return $q->num_rows();
	}
	

	function convertNumberToWordsForIndia($number){
		$words = array(
				'0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five',
				'6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten',
				'11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen',
				'16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty',
				'30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy',
				'80' => 'eighty','90' => 'ninty');
	
		//First find the length of the number
		$number_length = strlen($number);
		//Initialize an empty array
		$number_array = array(0,0,0,0,0,0,0,0,0);
		$received_number_array = array();
	
		//Store all received numbers into an array
		for($i=0;$i<$number_length;$i++){    $received_number_array[$i] = substr($number,$i,1);    }
	
		//Populate the empty array with the numbers received - most critical operation
		for($i=9-$number_length,$j=0;$i<9;$i++,$j++){ $number_array[$i] = $received_number_array[$j]; }
		$number_to_words_string = "";
		//Finding out whether it is teen ? and then multiplying by 10, example 17 is seventeen, so if 1 is preceeded with 7 multiply 1 by 10 and add 7 to it.
		for($i=0,$j=1;$i<9;$i++,$j++){
			if($i==0 || $i==2 || $i==4 || $i==7){
				if($number_array[$i]=="1"){
					$number_array[$j] = 10+$number_array[$j];
					$number_array[$i] = 0;
				}
			}
		}
	
		$value = "";
		for($i=0;$i<9;$i++){
			if($i==0 || $i==2 || $i==4 || $i==7){    $value = $number_array[$i]*10; }
			else{ $value = $number_array[$i];    }
			if($value!=0){ $number_to_words_string.= $words["$value"]." "; }
			if($i==1 && $value!=0){    $number_to_words_string.= "Crores "; }
			if($i==3 && $value!=0){    $number_to_words_string.= "Lakhs ";    }
			if($i==5 && $value!=0){    $number_to_words_string.= "Thousand "; }
			if($i==6 && $value!=0){    $number_to_words_string.= "Hundred &amp; "; }
		}
		if($number_length>9){ $number_to_words_string = "Sorry This does not support more than 99 Crores"; }
		return ucwords(strtolower("Rupees ".$number_to_words_string)." Only.");
	}
	

	
	function countRec($fname,$tname,$where)
    {
		$sql = "SELECT $fname FROM $tname $where";
    	$q=$this->db->query($sql);
        return $q->num_rows();
    }
	

	
	function getcustomercontent($id){
		$sql = "SELECT *,DATE_FORMAT(created_at,'%d-%m-%Y %h:%i %p') AS credate FROM  users WHERE id=$id ";
		$q=$this->db->query($sql);
		if($q->num_rows()>0)
		{
			return $q->result();
		}
		else{
			return 0;
		}
	}

    function getcategory(){
        $sql = "SELECT * from category where status = 0";
        $q=$this->db->query($sql);
        if($q->num_rows()>0)
        {
            return $q->result();
        }
        else{
            return 0;
        }
    }


	function getcustomers($db=array())
	{

		$table='users';

		$page = $db['page'];

		$rp = $db['rp'];

		$sortname = $db['sortname'];

		$sortorder = $db['sortorder'];

		$ordernuberquery="";

		if(!empty($db['name']))
		{
			$ordernuberquery.=" and (name like '%".$db['name']."%' or name like '%".$db['name']."%')";
		}

		if(!empty($db['email']))
		{
			$ordernuberquery.=" and emailid like '%".$db['email']."%' ";
		}

		if(!empty($db['contact']))
		{
			$ordernuberquery.=" and phone like '%".$db['contact']."%' ";
		}

		if(!empty($db['country']))
		{
			$ordernuberquery.=" and country like '%".$db['country']."%' ";
		}

		if(!empty($db['town']))
		{
			$ordernuberquery.=" and town_name like '%".$db['town']."%' ";
		}

		if(!empty($db['state']))
		{
			$ordernuberquery.=" and state_name like '%".$db['state']."%' ";
		}

		if(!empty($db['zip']))
		{
			$ordernuberquery.=" and zip like '%".$db['zip']."%' ";
		}



		if(!empty($db['fromdate']) && !empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(created_date) between '".date('Y-m-d',strtotime($db['fromdate']))."' and '".date('Y-m-d',strtotime($db['todate']))."' ";
		}

		else if(!empty($db['fromdate']) && empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(created_date) >= '".date('Y-m-d',strtotime($db['fromdate']))."' ";
		}

		else if(empty($db['fromdate']) && !empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(created_date) <= '".date('Y-m-d',strtotime($db['todate']))."' ";
		}

		if (!$sortname) $sortname = 'id';

		if (!$sortorder) $sortorder = 'desc';

		if($db['query']!=''){

			$where = ' WHERE 1 '.$ordernuberquery.' and  '.$db['qtype'].' LIKE "%'.$db['query'].'%"';
		}
		else {

			$where =' WHERE 1 '.$ordernuberquery.' ';

		}

		$sort = "ORDER BY $sortname $sortorder";

		$total = $this->countRec('id',$table,$where);

		if (!$page) $page = 1;

		if (!$rp) $rp = 10;

		$start = (($page-1) * $rp);

		$limit = "LIMIT $start, $rp";

		$sql = "SELECT *,DATE_FORMAT(created_date,'%d-%m-%Y %h:%i %p') AS credate FROM  $table $where  $sort $limit";

		$q=$this->master_db->sqlExecute($sql);
		return $q;

		/*header("Content-type: application/json");

		$json = '';

		$json .= '{';

		$json .= '"page": '.$page.',';

		$json .= '"total": '.$total.',';

		$json .= '"rows": [';

		$rc = false;

		$counter123=1;

		foreach($result->result() as $row) {


			$edit="<button class='btn btn-primary btn-sm btn-grad' onclick='view(".$row->id.")'><i class='icon-eye-open'></i> View </button>";

			if ($rc) $json .= ',';

			$json .= '{';

			$json .= '"id":"'.$row->id.'","';
			$json .= 'cell":["'.$counter123.'","'.addslashes($row->name).'","'.addslashes($row->emailid).'","'.addslashes($row->phone).'","'.addslashes($row->town_name).'","'.addslashes($row->zip).'","'.addslashes($row->state_name).'","'.addslashes($row->country).'","'.$row->credate.'"';

			$json .= ',"'.$edit.'"]';

			$json .= "}";

			$rc = true;

			$counter123++;

		}

		$json .= "]";

		$json .= "}";


		return $json;*/

	}

	function getexportcust($db=array())
	{

		$table='users';
		$ordernuberquery="";

		if(!empty($db['name']))
		{
			$ordernuberquery.=" and (first_name like '%".$db['name']."%' or last_name like '%".$db['name']."%')";
		}

		if(!empty($db['email']))
		{
			$ordernuberquery.=" and emailid like '%".$db['email']."%' ";
		}

		if(!empty($db['contact']))
		{
			$ordernuberquery.=" and phone like '%".$db['contact']."%' ";
		}

		if(!empty($db['country']))
		{
			$ordernuberquery.=" and country like '%".$db['country']."%' ";
		}

		if(!empty($db['town']))
		{
			$ordernuberquery.=" and town like '%".$db['town']."%' ";
		}

		if(!empty($db['state']))
		{
			$ordernuberquery.=" and state like '%".$db['state']."%' ";
		}

		if(!empty($db['zip']))
		{
			$ordernuberquery.=" and zip like '%".$db['zip']."%' ";
		}

		if(!empty($db['company']))
		{
			$ordernuberquery.=" and company_name like '%".$db['company']."%' ";
		}

		if(!empty($db['fromdate']) && !empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(created_date) between '".date('Y-m-d',strtotime($db['fromdate']))."' and '".date('Y-m-d',strtotime($db['todate']))."' ";
		}

		else if(!empty($db['fromdate']) && empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(created_date) >= '".date('Y-m-d',strtotime($db['fromdate']))."' ";
		}

		else if(empty($db['fromdate']) && !empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(created_date) <= '".date('Y-m-d',strtotime($db['todate']))."' ";
		}

		$sortname = 'id';

		$sortorder = 'desc';
		$where =' WHERE 1 '.$ordernuberquery.' ';

		$sort = "ORDER BY $sortname $sortorder";


		$sql = "SELECT *,DATE_FORMAT(created_date,'%d-%m-%Y %h:%i %p') AS credate FROM  $table $where  $sort ";

		$result = $this->db->query($sql);

		return $result->result();
	}

	function getreviews($db=array())
	{
		$table='products as p, reviews as r, product_images as i, category as c';
	
		$ordernuberquery="";
		if(!empty($db['cat']))
		{
			$ordernuberquery.=" and c.id='".$db['cat']."'";
		}
		if(!empty($db['name']))
		{
			$ordernuberquery.=" and (r.name like '%".$db['name']."%' or r.name like '%".$db['name']."%')";
		}
		if(!empty($db['pname']))
		{
			$ordernuberquery.=" and p.name like '%".$db['pname']."%'";
		}
		if(!empty($db['fromdate']) && !empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(r.created_date) between '".date('Y-m-d',strtotime($db['fromdate']))."' and '".date('Y-m-d',strtotime($db['todate']))."' ";
		}
		else if(!empty($db['fromdate']) && empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(r.created_date) >= '".date('Y-m-d',strtotime($db['fromdate']))."' ";
		}
		else if(empty($db['fromdate']) && !empty($db['todate']))
		{
			$ordernuberquery.=" and DATE(r.created_date) <= '".date('Y-m-d',strtotime($db['todate']))."' ";
		}
		$sortname = 'r.id';
		$sortorder = 'desc';
		$where =' WHERE r.psid = p.id and p.id = i.pid and p.cat_id = c.id '.$ordernuberquery.' ';
		
		$sort = "group by r.id ORDER BY $sortname $sortorder";
		$page = 1;
		$rp = 10;
		$start = (($page-1) * $rp);
		$limit = "LIMIT $start, $rp";
		/*$sql = "SELECT r.*,DATE_FORMAT(r.created_date,'%d-%m-%Y %h:%i %p') AS created_date,p.name pname,i.image_path path,c.name cname FROM  $table $where $sort ";

		$result = $this->db->query($sql);
		$total = count($result->result());*/
		$sql = "SELECT r.*,DATE_FORMAT(r.created_date,'%d-%m-%Y %h:%i %p') AS created_date,p.name pname,i.image_path path,c.name cname FROM  $table $where $sort $limit";
		//echo $sql;exit;
		$q=$this->master_db->sqlExecute($sql);
		return $q;
	}

	function getexport($db=array())

	{

        $table=' products as p, reviews as r, product_images as i, category as c';


        $sortname = "r.id";

        $sortorder = "DESC";

        $ordernuberquery="";




        if(!empty($db['cat']))
        {
            $ordernuberquery.=" and c.id='".$db['cat']."'";
        }





        if($db['stat']=='0' || $db['stat']=='1' || $db['stat']=='3' || $db['stat']=='2' || $db['stat']=='4')
        {
            $ordernuberquery.=" and r.status='".$db['stat']."' ";
        }





        if(!empty($db['name']))
        {
            $ordernuberquery.=" and (r.name like '%".$db['name']."%' or r.name like '%".$db['name']."%')";
        }

        if(!empty($db['pname']))
        {
            $ordernuberquery.=" and p.name like '%".$db['pname']."%'";
        }



        if(!empty($db['fromdate']) && !empty($db['todate']))
        {
            $ordernuberquery.=" and DATE(r.created_date) between '".date('Y-m-d',strtotime($db['fromdate']))."' and '".date('Y-m-d',strtotime($db['todate']))."' ";
        }

        else if(!empty($db['fromdate']) && empty($db['todate']))
        {
            $ordernuberquery.=" and DATE(r.created_date) >= '".date('Y-m-d',strtotime($db['fromdate']))."' ";
        }

        else if(empty($db['fromdate']) && !empty($db['todate']))
        {
            $ordernuberquery.=" and DATE(r.created_date) <= '".date('Y-m-d',strtotime($db['todate']))."' ";
        }

        if (!$sortname) $sortname = 'r.id';

        if (!$sortorder) $sortorder = 'desc';

        if(false){

            $where = ' WHERE r.psid = p.id and p.id = i.pid and p.cat_id = c.id  '.$ordernuberquery.' and  '.$db['qtype'].' LIKE "%'.$db['query'].'%"';
        }
        else {

            $where =' WHERE r.psid = p.id and p.id = i.pid and p.cat_id = c.id '.$ordernuberquery.' ';
        }

        $sort = "group by r.id ORDER BY $sortname $sortorder";






        $sql = "SELECT r.*,DATE_FORMAT(r.created_date,'%d-%m-%Y %h:%i %p') AS created_date,p.name pname,i.image_path path,c.name cname FROM  $table $where $sort";

        //echo $sql;
        //echo "with limit";
        $result = $this->db->query($sql);
		$row = $result->result();
		return $row;

	}

	function reviewStatus($table,$db=array())
	{
		/*$sql="";
		$this->db->where('id',$db['id']);
		$q=$this->db->update($table,$db);
		$total = $this->db->affected_rows();
		header("Content-type: application/json");
		$json = "";
		$json .= "{";
		$json .= '"query": "'.$sql.'",';
		$json .= '"total": "'.$total.'"';
		$json .= "}";
		return $json;*/
		$sql="update $table set status=".$db['status']." WHERE id IN ('".$db['id']."')";
        $q=$this->db->query($sql);
        return 1;
	}

	function getreviewcontent($id,$categ){
        $table='products as p, reviews as r, product_images as i, category as c';

        $where =" WHERE p.id = {$id} and r.psid = i.id and p.cat_id = c.id ";
        $sql = "select r.*,DATE_FORMAT(r.created_date,'%d-%m-%Y %h:%i %p') AS created_date,p.name pname,i.image_path path,c.name cname from products p left join category c on p.cat_id = c.id left join productpackage pp on pp.pid=p.id left join product_images i on i.pid = pp.id left join reviews as r on r.psid =i.id where r.id=".$id."";


		$q=$this->db->query($sql);
		if($q->num_rows()>0)
		{
			return $q->result();
		}
		else{
			return $sql;
		}
	}


}

?>