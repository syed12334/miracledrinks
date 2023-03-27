<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home_db extends CI_Model{

	function getlogin($db=array()){

		$sql="SELECT * FROM admin WHERE username=? and passwrd=? and status=?";

		$q=$this->db->query($sql,array($db['username'] , $db['password'] , 0)); 

		if($q->num_rows()>0)

		{

            $sqll="update admin set last_login=now() where username=? and passwrd=?";

            $this->db->query($sqll,array($db['username'] , $db['password'])); 
            
            $sql="SELECT * FROM admin WHERE username=? and passwrd=? and status=?";
            
            $q=$this->db->query($sql,array($db['username'] , $db['password'] , 0));
            
            $res = $q->result();
            
            $sqll="insert into login_report (user_id,login_time,logout_time) values ('".$res[0]->id."','".$res[0]->last_login."','0000-00-00 00:00:00')";
            
            $this->db->query($sqll);

			return 1;

		}

		else

		{

			return 0;

		}

	}

	

	function getdetails($email){

		$this->db->where('username',$email);

		$sql=$this->db->get('admin'); 

		if($sql->num_rows()>0)

		{	

			return $sql->result();

		}

	}

    
	
	
	function countRec($fname,$tname,$where)
    {
		$sql = "SELECT $fname FROM $tname $where";
    	$q=$this->db->query($sql);
        return $q->num_rows();
    }
		
    function updatelogin($db =array(),$id,$login)
    {
    	$this->db->where('user_id',$id);
    	$this->db->where('login_time',$login); 
    	$q=$this->db->update('login_report',$db);
    	$total = $this->db->affected_rows();
    	if($total>0)
    		return 1;
    	else
    		return 0;
    }

	function profile_edit_save($db =array(),$id)
	{
		$this->db->where('id',$id);
        $q=$this->db->update('admin',$db); 
        $total = $this->db->affected_rows();
        if($total>0)
        return 1;
        else 
        return 0;
	}
	
	//--Forgot pwd
	
	function getemailId($email)

	{
		$sql = "select * from admin where email='".$email."' and status=0";
		
		$q=$this->db->query($sql);

		if($q->num_rows()>0)
		{

			return 1;

		}

		else 

		{

			return 0;

		}

	}
	
	public function resizeImage($filename,$width, $height){
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $_SERVER['DOCUMENT_ROOT'].'/artii_manage/'.$filename;
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = $width;
		$config['height'] = $height;
		$config['new_image'] = $_SERVER['DOCUMENT_ROOT'].'/artii_manage/'.$filename;
		$this->image_lib->initialize($config);
		if(!$this->image_lib->resize())
		{
			return $this->image_lib->display_errors();
		}
		else{
			return 1;
		}
		$this->image_lib->clear();
	
	}
	
	public function resizeImagef($filename,$width, $height,$water = ""){
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		//echo $_SERVER['DOCUMENT_ROOT'].'/couch/'.$filename;
		$config['source_image'] = $_SERVER['DOCUMENT_ROOT'].'/'.$filename;
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = $width;
		$config['height'] = $height;
		$config['new_image'] = $_SERVER['DOCUMENT_ROOT'].'/'.$filename;
		$this->image_lib->initialize($config);
		if(!$this->image_lib->resize())
		{
			return $this->image_lib->display_errors();
		}
		else{
			if(!empty($water)){
			//$this->overlay($filename,$water);
			}
			return 1;
		}
		$this->image_lib->clear();
	
	}
	
	public function getimg($cat){
		$sql="select image_medium from product_images i, products p where p.id=i.pid and i.image_medium!='' and p.cat_id='$cat'";	
		
		$q=$this->db->query($sql);
		return $q->result();
	}
	
	public function overlay($filename,$water)
	{
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $_SERVER['DOCUMENT_ROOT'].'/'.$filename;
		 $config['wm_type'] = 'overlay';
		$config['wm_overlay_path'] = $_SERVER['DOCUMENT_ROOT'].'/assets/images/'.$water;//the overlay image
		$config['wm_opacity']=50;
		$config['wm_vrt_alignment'] = 'middle';
		$config['wm_hor_alignment'] = 'center'; 
		//$config['wm_hor_offset'] = '20';
		//$config['wm_padding']       = '10'; 
		
		 /* $config['wm_text']          = 'www.arttiplant.com';
		$config['wm_type']          = 'text';
		$config['wm_font_path']     = $_SERVER['DOCUMENT_ROOT'].'/assets/fonts/gnuolane_free-webfont.ttf';
		$config['wm_font_size']     = 12;
		$config['wm_opacity']=100;
		$config['wm_font_color']    = 'F0FFFF';
		$config['wm_vrt_alignment'] = 'middle';
		$config['wm_hor_alignment'] = 'center';
		$config['wm_hor_offset'] = '20';  */
		//$config['wm_padding']       = '50';
		$this->image_lib->initialize($config);
	
		if(!$this->image_lib->watermark())
		{
			echo $this->image_lib->display_errors();
		}
		$this->image_lib->clear();
	}

	public function updatepassword($id)
	
	{
	
		//echo "email ".$id;
	
		$newpass=rand();
	
		$sql="update admin set passwrd='".sha1($newpass)."' where email='".$id."' and status=0";
	
	
		$q=$this->db->query($sql);
	
		$total = $this->db->affected_rows();
	
		if($total>0)
	
			return $newpass;
	
		else
	
			return 0;
	
	}
	
	//Banner Table
	function banner_table($db=array())
{

    $table='banner';

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

            $status="<span class='btn btn-info btn-sm btn-grad'>Active</span>";

            $chng="<button class='btn btn-primary btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

        }

        else

        {

            $status="<span class='btn btn-primary btn-sm btn-grad'>In-Active</span>";

            $chng="<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

        }

        $image="<a href='".$row->banner_link."' target='_blank'><img src='".str_replace('/artii_manage','',base_url())."".$row->banner_image."' width='150' width='100'></a>";

        $edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";

        $finalquery=str_replace(" ","~",$tempsql);

        if ($rc) $json .= ',';

        $json .= '{';

        $json .= '"id":"'.$row->id.'","';

        $json .= 'cell":["'.$counter123.'","'.$row->order_no.'","'.$image.'" ';

        $json .= ',"'.$status.'","'.$chng.'&nbsp;'.$edit.'"]';


        $json .= "}";

        $rc = true;


        $counter123++;

    }

    $json .= "]";

    $json .= "}";

    return $json;

}




    function gifts_table($db=array())
    {

        $table='gifts';

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

                $status="<span class='btn btn-info btn-sm btn-grad'>Active</span>";

                $chng="<button class='btn btn-primary btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

            }

            else

            {

                $status="<span class='btn btn-primary btn-sm btn-grad'>In-Active</span>";

                $chng="<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

            }

            $image="<img src='".str_replace('/artii_manage','',base_url())."".$row->image_path."'>";

            $edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";

            $finalquery=str_replace(" ","~",$tempsql);

            if ($rc) $json .= ',';

            $json .= '{';

            $json .= '"id":"'.$row->id.'","';

            $json .= 'cell":["'.$counter123.'","'.$row->order_no.'","'.$row->title.'","'.$image.'" ';

            $json .= ',"'.$status.'","'.$chng.'&nbsp;'.$edit.'"]';


            $json .= "}";

            $rc = true;


            $counter123++;

        }

        $json .= "]";

        $json .= "}";

        return $json;

    }









    function client_table($db=array())
    {

        $table='clients';

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

                $status="<span class='btn btn-info btn-sm btn-grad'>Active</span>";

                $chng="<button class='btn btn-primary btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

            }

            else

            {

                $status="<span class='btn btn-primary btn-sm btn-grad'>In-Active</span>";

                $chng="<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

            }

            $image="<img src='".str_replace('/artii_manage','',base_url())."".$row->client_image."' width='150' width='100'>";

            $edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";

            $finalquery=str_replace(" ","~",$tempsql);

            if ($rc) $json .= ',';

            $json .= '{';

            $json .= '"id":"'.$row->id.'","';

            $json .= 'cell":["'.$counter123.'","'.$row->order_no.'","'.$row->name.'","'.$row->category.'","'.$image.'" ';

            $json .= ',"'.$status.'","'.$chng.'&nbsp;'.$edit.'"]';


            $json .= "}";

            $rc = true;


            $counter123++;

        }

        $json .= "]";

        $json .= "}";

        return $json;

    }
	
	
	//How it works Table
	function ourproducts_table($db=array())
	{
	
		$table='our_products';
	
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
	
				$status="<span class='btn btn-info btn-sm btn-grad'>Active</span>";
	
				$chng="<button class='btn btn-primary btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";
	
			}
	
			else
	
			{
	
				$status="<span class='btn btn-primary btn-sm btn-grad'>In-Active</span>";
	
				$chng="<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";
	
			}
	
			$image="<img src='".str_replace('/artii_manage','',base_url())."".$row->image_path."' width='150' width='100'>";
	
			$edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";
	
			$finalquery=str_replace(" ","~",$tempsql);
	
			if ($rc) $json .= ',';
	
			$json .= '{';
	
			$json .= '"id":"'.$row->id.'","';
	
			$json .= 'cell":["'.$counter123.'","'.addslashes($row->order_no).'","'.addslashes(str_replace("'","`",$row->title)).'","'.$image.'" ';
	
			$json .= ',"'.$status.'","'.$chng.'&nbsp;'.$edit.'"]';
	
			 
			$json .= "}";
	
			$rc = true;
			 
	
			$counter123++;
	
		}
	
		$json .= "]";
	
		$json .= "}";
	
		return $json;
	
	}
	
	
	public function getOutofstock(){
		$category = $this->master_db->getcontent2('category','','','');
		if(is_array($category)){
			$tabarr = array();
			foreach ($category as $c){
				$sql = "SELECT pid FROM  ".$c->page_url."_product_view p where  stock<=5 group by pid ";
				$tabarr[] = $sql;
			}
			$sql = implode(" union ", $tabarr);
			$sql = $sql." ";
			$result = $this->db->query($sql);
			$total = count($result->result());
			return $total;
		}
		else
			return 0;
	}
	
	public function arrange_dates($fromdate, $todate){
		// Start date
		$date = $fromdate;
		// End date
		$end_date = $todate;
		$array_final = array();
		$finaldate = '';
		$array  = array();
		$i=0;
		while (strtotime($date) <= strtotime($end_date)) {
			if($i%7==0 && $i>0){
				array_push($array_final,$array);
				$array  = array();
				$finaldate = $date;
			}
		
			array_push($array,$date);
		
			$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
			$i++;
		}
		if(strtotime($finaldate) <= strtotime($end_date)){
			array_push($array_final,$array);
		}
		
		return $array_final;
	}

}

?>