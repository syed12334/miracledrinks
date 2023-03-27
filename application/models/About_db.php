<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About_db extends CI_Model{

    function gettable($table,$db=array())
    {
    	$page = $db['page'];
    
    	$rp = $db['rp'];
    
    	$sortname = $db['sortname'];
    
    	$sortorder = $db['sortorder'];
    
    
    
    	if($db['query']!=''){
    
    		$where = ' WHERE   '.$db['qtype'].' LIKE "%'.$db['query'].'%"';
    
    	} else {
    
    		$where ='';
    
    	}
    
    	if($db['letter_pressed']!=''){
    
    		$where = ' WHERE   '.$db['qtype'].' LIKE "'.$db['letter_pressed'].'%"';
    
    	}
    
    	if($db['letter_pressed']=='#'){
    
    		$where = ' WHERE   '.$db['qtype'].' REGEXP "[[:digit:]]" ';
    
    	}
    
    	$sort = "ORDER BY $sortname $sortorder";
    
    
    
    	if (!$page) $page = 1;
    
    	if (!$rp) $rp = 10;
    
    
    
    	$start = (($page-1) * $rp);
    
    
    
    	$limit = "LIMIT $start, $rp";
    
    
    
    	$sql = "SELECT * FROM  $table $where $sort $limit";
    
    
    
    
    
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
    		$image="<img src='".str_replace('/artii_manage','',base_url())."".$row->image_path."' width='100px'>";
    		$finalquery=str_replace(" ","~",$tempsql);
    
    		if ($rc) $json .= ',';
    
    		$json .= '{';
    
    		$json .= '"id":"'.$row->id.'","';
    
    		$json .= 'cell":["'.$counter123.'","'.$row->order_no.'","'.addslashes(str_replace("'","`",$row->title)).'","'.$image.'"';
    
    		$json .= ',"'.$status.'","'.$chng.' '.$edit.'"]';
    
    		 
    		$json .= "}";
    
    		$rc = true;
    		 
    
    		$counter123++;
    
    	}
    
    	$json .= "]";
    
    	$json .= "}";
    
    	return $json;
    
    }
    
    function gettable_stories($db=array())
    {
    	$table = "stories";
    	$page = $db['page'];
    
    	$rp = $db['rp'];
    
    	$sortname = $db['sortname'];
    
    	$sortorder = $db['sortorder'];
    
    
    
    	if($db['query']!=''){
    
    		$where = ' WHERE  '.$db['qtype'].' LIKE "%'.$db['query'].'%"';
    
    	} else {
    
    		$where ='  ';
    
    	}
    
    	if($db['letter_pressed']!=''){
    
    		$where = ' WHERE  '.$db['qtype'].' LIKE "'.$db['letter_pressed'].'%"';
    
    	}
    
    	if($db['letter_pressed']=='#'){
    
    		$where = ' WHERE  '.$db['qtype'].' REGEXP "[[:digit:]]" ';
    
    	}
    
    	$sort = "ORDER BY $sortname $sortorder";
    
    	if (!$page) $page = 1;
    
    	if (!$rp) $rp = 10;
    
    	$start = (($page-1) * $rp);
    
    	$limit = "LIMIT $start, $rp";
    
    	$sql = "SELECT * FROM  $table $where $sort $limit";
                
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
    		$image="<img src='".str_replace('/artii_manage','',base_url())."".$row->image_path."' >";
    		
    		
    		$finalquery=str_replace(" ","~",$tempsql);
    
    		if ($rc) $json .= ',';
    
    		$json .= '{';
    
    		$json .= '"id":"'.$row->id.'","';
    
    		$json .= 'cell":["'.$counter123.'","'.$row->order_no.'","'.addslashes(str_replace("'","`",$row->name)).'","'.addslashes(str_replace("'","`",$row->location)).'","'.$image.'"';
    
    		$json .= ',"'.$status.'","'.$chng.'&nbsp;'.$edit.'"]';
    
    		 
    		$json .= "}";
    
    		$rc = true;
    		 
    
    		$counter123++;
    
    	}
    
    	$json .= "]";
    
    	$json .= "}";
    
    	return $json;
    
    }


    function gettable_testimonials($db=array())
    {
        $table = "testimonials";
        $page = $db['page'];

        $rp = $db['rp'];

        $sortname = $db['sortname'];

        $sortorder = $db['sortorder'];



        if($db['query']!=''){

            $where = ' WHERE  '.$db['qtype'].' LIKE "%'.$db['query'].'%"';

        } else {

            $where ='  ';

        }

        if($db['letter_pressed']!=''){

            $where = ' WHERE  '.$db['qtype'].' LIKE "'.$db['letter_pressed'].'%"';

        }

        if($db['letter_pressed']=='#'){

            $where = ' WHERE  '.$db['qtype'].' REGEXP "[[:digit:]]" ';

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

            $image="<img src='".front_url()."".$row->image_path."' width='100' width='100'>";


            $finalquery=str_replace(" ","~",$tempsql);

            if ($rc) $json .= ',';

            $json .= '{';

            $json .= '"id":"'.$row->id.'","';

            $json .= 'cell":["'.$counter123.'","'.$row->order_no.'","'.addslashes(str_replace("'","`",$row->name)).'","'.addslashes(str_replace("'","`",$row->location)).'","'.$image.'"';

            $json .= ',"'.$status.'","'.$chng.'&nbsp;'.$edit.'"]';


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
	
    function gettable_freebies($db=array())
    {
    	$table = "blogposts_post";
    	$page = $db['page'];
    
    	$rp = $db['rp'];
    
    	$sortname = $db['sortname'];
    
    	$sortorder = $db['sortorder'];
    
    	if($db['query']!=''){
    
    		$where = ' WHERE   '.$db['qtype'].' LIKE "%'.$db['query'].'%"';
    
    	} else {
    
    		$where ='';
    
    	}
    
    	$sort = "ORDER BY $sortname $sortorder";
    
    	if (!$page) $page = 1;
    
    	if (!$rp) $rp = 10;
    
    	$start = (($page-1) * $rp);
    
    	$limit = "LIMIT $start, $rp";
    
    	$sql = "SELECT * FROM  $table $where $sort $limit";
    
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
    		$image="<img src='".str_replace('/artii_manage','',base_url())."".$row->image_path."' width='100px'>";
    		$finalquery=str_replace(" ","~",$tempsql);
    
    		if ($rc) $json .= ',';
    
    		$json .= '{';
    
    		$json .= '"id":"'.$row->id.'","';
    
    		$json .= 'cell":["'.$counter123.'","'.addslashes(str_replace("'","`",$row->title)).'","'.$image.'","'.date_format(date_create($row->created_date), 'd-m-Y g:i A').'","'.addslashes(str_replace("'","`",$row->post_by)).'"';
    
    		$json .= ',"'.$status.'","'.$chng.' '.$edit.'"]';
    
    		 
    		$json .= "}";
    
    		$rc = true;
    		 
    
    		$counter123++;
    
    	}
    
    	$json .= "]";
    
    	$json .= "}";
    
    	return $json;
    
    }
    
    
    function gettable_comments($db=array())
    {
    	$table = "blogposts_post f, blogposts_comments c";
    	$page = $db['page'];
    
    	$rp = $db['rp'];
    
    	$sortname = $db['sortname'];
    
    	$sortorder = $db['sortorder'];
    	
    	$ordernuberquery="";
    
    	
    	
    	
    	if(!empty($db['name']))
    	{
    		$ordernuberquery.=" and name like '%".$db['name']."%'";
    	}
    	
    	if(!empty($db['title']))
    	{
    		$ordernuberquery.=" and title like '%".$db['title']."%'";
    	}
    	
    	if($db['stat']=='0' || $db['stat']=='1' || $db['stat']=='3' || $db['stat']=='2' || $db['stat']=='4')
    	{
    		$ordernuberquery.=" and c.status='".$db['stat']."' ";
    	}
    	
    	if(!empty($db['fromdate']) && !empty($db['todate']))
    	{
    		$ordernuberquery.=" and DATE(c.created_date) between '".date('Y-m-d',strtotime($db['fromdate']))."' and '".date('Y-m-d',strtotime($db['todate']))."' ";
    	}
    	
    	else if(!empty($db['fromdate']) && empty($db['todate']))
    	{
    		$ordernuberquery.=" and DATE(c.created_date) >= '".date('Y-m-d',strtotime($db['fromdate']))."' ";
    	}
    	
    	else if(empty($db['fromdate']) && !empty($db['todate']))
    	{
    		$ordernuberquery.=" and DATE(c.created_date) <= '".date('Y-m-d',strtotime($db['todate']))."' ";
    	}
    
    
    		$where ='where f.id=c.fid  '.$ordernuberquery;
    
    	
    	$sort = "ORDER BY $sortname $sortorder";
    
    	if (!$page) $page = 1;
    
    	if (!$rp) $rp = 10;
    
    	$start = (($page-1) * $rp);
    
    	$limit = "LIMIT $start, $rp";
    
    	$sql = "SELECT f.title,f.image_path,c.* FROM  $table $where $sort $limit";
    
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
    
    
    
    	foreach($result->result() as $row) {   
        
    		if($row->status=='0')
			{
				$status="<span class='btn btn-success btn-sm btn-grad'>Approved</span>";
				$chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Reject </button>";
			}
			else if($row->status=='1')
			{
				$status="<span class='btn btn-danger btn-sm btn-grad'>Rejected</span>";
				$chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Approve </button>";
			}
			else if($row->status=='2')
			{
				$status="<span class='btn btn-warning btn-sm btn-grad'>Pending</span>";
				$chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Approve </button> <button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Reject </button>";
			}
			else if($row->status=='3')
			{
				$status="<span class='btn btn-info btn-sm btn-grad'>New</span>";
				$chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Approve </button> <button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Reject </button>";
			}
    
    		$edit="<button class='btn btn-primary btn-sm btn-grad' onclick='view(".$row->id.")'><i class='icon-eye-open'></i> View </button>";
    		$image="<img src='".str_replace('/artii_manage','',base_url())."".$row->image_path."' width='100px'>";
    		$finalquery=str_replace(" ","~",$tempsql);
    
    		if ($rc) $json .= ',';
    
    		$json .= '{';
    
    		$json .= '"id":"'.$row->id.'","';
    
    		$json .= 'cell":["'.$counter123.'","'.addslashes(str_replace("'","`",$row->title)).'","'.$image.'","'.addslashes(str_replace("'","`",$row->name)).'","'.addslashes(str_replace("'","`",$row->email)).'","'.date_format(date_create($row->created_date), 'd-m-Y g:i A').'"';
    
    		$json .= ',"'.$status.'","'.$chng.' '.$edit.'"]';
    
    		 
    		$json .= "}";
    
    		$rc = true;
    		 
    
    		$counter123++;
    
    	}
    
    	$json .= "]";
    
    	$json .= "}";
    
    	return $json;
    
    }
    
    
    function getexport($db=array())
    {
    	$table = "blogposts_post f, blogposts_comments c";
    	 
    	$ordernuberquery="";
    	
    	if(!empty($db['name']))
    	{
    		$ordernuberquery.=" and name like '%".$db['name']."%'";
    	}
    	 
    	if(!empty($db['title']))
    	{
    		$ordernuberquery.=" and title like '%".$db['title']."%'";
    	}
    	 
    	if($db['stat']=='0' || $db['stat']=='1' || $db['stat']=='3' || $db['stat']=='2' || $db['stat']=='4')
    	{
    		$ordernuberquery.=" and c.status='".$db['stat']."' ";
    	}
    	 
    	if(!empty($db['fromdate']) && !empty($db['todate']))
    	{
    		$ordernuberquery.=" and DATE(c.created_date) between '".date('Y-m-d',strtotime($db['fromdate']))."' and '".date('Y-m-d',strtotime($db['todate']))."' ";
    	}
    	 
    	else if(!empty($db['fromdate']) && empty($db['todate']))
    	{
    		$ordernuberquery.=" and DATE(c.created_date) >= '".date('Y-m-d',strtotime($db['fromdate']))."' ";
    	}
    	 
    	else if(empty($db['fromdate']) && !empty($db['todate']))
    	{
    		$ordernuberquery.=" and DATE(c.created_date) <= '".date('Y-m-d',strtotime($db['todate']))."' ";
    	}
    
    
    	$where ='where f.id=c.fid  '.$ordernuberquery;
    
    	 
    	$sort = "ORDER BY id asc";
    
    
    	$sql = "SELECT f.title,f.image_path,c.* FROM  $table $where $sort $limit";
    
    	$result = $this->db->query($sql);
    
    	$row = $result->result();			
		return $row;
    
    
    }
	

}

?>