<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_db extends CI_Model{

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
	 function getnumberformat($num){
    	return str_replace(".00", "", (string)number_format((float)$num, 2, '.', ','));
    }

	function checkcoupon($coupon){
		$sql = "select v.id,code as coupon_code,discount from vouchers as v,voucher_code c where code='$coupon' and from_date<='".date('Y-m-d')."' and to_date>='".date('Y-m-d')."' and v.status=0 and c.status=0 and cid=id";
		$q=$this->db->query($sql);
		if($q->num_rows()>0)
			return $q->result();
		else
			return 0;
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
		function sqlExecute($sql)
	{
	    $q=$this->db->query($sql);
	    return $q !== FALSE ? $q->result() : array();
	}
	  function checkwishlist($db=array()){
    	$this->db->where('pid',$db['pid']);
    	$this->db->where('user_id',$db['user_id']);
    	$this->db->where('categ',$db['categ']);
    	$q=$this->db->get('wishlist');
    	return $q->num_rows();
    }
    function checkmail($email,$pass)
	{
		$this->db->where('emailid',$email);
		$q=$this->db->get('users');
		if($q->num_rows()>0)
		{
			$sql = "update users set password = '".sha1($pass)."' where emailid = '".$email."' ";
			$result = $this->db->query($sql);
			if($this->db->affected_rows())
				return 0;//updated
			else
				return 1;//exists but not updated
		}
		else return 2;//not exists
	
	
	}
     function checkwishlistapi($db=array()){
    	$this->db->where('pid',$db['pid']);
    	$this->db->where('user_id',$db['user_id']);
    	$this->db->where('categ',$db['cpage_url']);
    	$q=$this->db->get('wishlist');
    	return $q->num_rows();
    }
    public function getloginval($db=array())
	{
		$this->db->where('emailid',$db['email']);
		$this->db->where('login_type',$db['type']);
		$q=$this->db->get('users');
		if($q->num_rows()>0)
			return $q->result();
		else
			return 0;
	}
    
    function add_wishlist($db=array())
    {
    	$num = $this->checkwishlist($db);
    	if($num == 0){
    		$this->db->insert('wishlist',$db);
    		return 1;
    	}
    	else{
    		return 1;
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
			$this->overlay($filename,$water);
			}
			return 1;
		}
		$this->image_lib->clear();
	
	}
	
	public function getimg($cat){
		$sql="select image_large from product_images i, products p where p.id=i.pid and i.image_large!='' and p.cat_id='$cat'";	
		
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

            $status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";

            $chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

        }

        else

        {

            $status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";

            $chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

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

                $status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";

                $chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

            }

            else

            {

                $status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";

                $chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

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

                $status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";

                $chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

            }

            else

            {

                $status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";

                $chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

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
	
				$status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";
	
				$chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";
	
			}
	
			else
	
			{
	
				$status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";
	
				$chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";
	
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
				$sql = "SELECT p.id FROM  products p left join product_sizes ps on ps.pid = p.id  where  ps.stock<=5 group by p.id ";
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
	
    function getRecords($table,$db = array(),$select = "*",$ordercol = '',$group = '',$start='',$limit='')
    {
        $this->db->select($select);
        if(!empty($ordercol))
        {
            $this->db->order_by($ordercol);
        }
        if($limit != '' && $start !='')
        {
            $this->db->limit($limit,$start);
        }
        if($group != '')
        {
            $this->db->group_by($group);
        }
        $q=$this->db->get_where($table, $db);
        return $q !== FALSE ? $q->result() : array();
        //return $q->result();
        //return $this->db->last_query();
    }
    public function rows_by_paginations($query,$order_by,$order_by_arr,$db="default")
    {
        $this->load->database($db);

        if(isset($_POST["order"]))
        {
            $order_by = " order by ".$order_by_arr[$_POST['order']['0']['column']]." ".$_POST['order']['0']['dir'];
        }
        
        $limit = " ";
        if($_POST["length"] != -1)
        {
            $limit = " limit {$_POST['length']}";
            if($_POST['start'] > 0){
                $limit = " limit {$_POST['start']}, {$_POST['length']}";
            }
        }
        $query = $this->db->query($query.$order_by.$limit);
        
        return $query->result();
    }   
    public function run_manual_query_result($query,$db="default")
    {
        $this->load->database($db);
        $query = $this->db->query($query);
        return $query->result();
    }
    public function productDetails($pro_url) {
		$q = $this->db->select('c.name as cname,c.page_url as cpage_url,p.id,p.page_url as ppage_url,s.name as sname,s.page_url as spage_url,p.name as title,p.pcode,p.youtube,p.overview,p.status,p.cat_id,p.subcat_id,pi.image_path,pi.thumb,ps.mrp,ps.selling_price,ps.stock,ps.id as psid,s.id as sid,ps.minimum_buy,ps.sel_dollar,ps.b2b_selling_price,ps.b2b_sel_dollar,p.material_id as mid,p.how_to_use,p.youtubelink')->from('products p')
								  ->join('product_images pi','p.id=pi.pid')
								  ->join('product_sizes ps','p.id=ps.pid')
								  ->join('category c','p.cat_id=c.id')
								  ->join('sizes s','ps.size_id=s.id')
								  ->where(['p.page_url'=>$pro_url])
								  ->group_by('p.id')
								  ->get();
			if($q->num_rows()>0)
			return $q->result();
		else
			return 0;

	}

	public function productDetailsWithoutSize($pro_url) {
		$q = $this->db->select('c.name as cname,c.id as cid,c.page_url as cpage_url,p.id,p.page_url as ppage_url,p.name as title,p.pcode,p.overview,p.status,p.cat_id,p.subcat_id,pi.image_path,pi.thumb,ps.mrp,ps.selling_price,ps.stock,ps.id as psid,ps.minimum_buy,ps.sel_dollar,ps.b2b_selling_price,ps.b2b_sel_dollar,p.material_id as mid,p.how_to_use,p.youtubelink as youtubeid,p.tax')->from('products p')
								  ->join('product_images pi','p.id=pi.pid')
								  ->join('product_sizes ps','p.id=ps.pid')
								  ->join('category c','p.cat_id=c.id')
								  ->where(['p.page_url'=>$pro_url])
								  ->group_by('p.id')
								  ->get();
			if($q->num_rows()>0)
			return $q->result();
		else
			return 0;

	}

	public function productDetailsSizeView($psid) {
		$q = $this->db->select('c.name as cname,c.page_url as cpage_url,p.id,p.page_url as ppage_url,s.name as sname,s.page_url as spage_url,p.name as title,p.pcode,p.overview,p.status,p.cat_id,p.subcat_id,pi.image_path,pi.thumb,ps.mrp,ps.selling_price,ps.stock,ps.id as psid,s.id as sid,ps.minimum_buy,s.page_url as spage_url,ps.sel_dollar,ps.b2b_selling_price,ps.b2b_sel_dollar,p.material_id as mid,p.how_to_use')->from('products p')
								  ->join('product_images pi','p.id=pi.pid')
								  ->join('product_sizes ps','p.id=ps.pid')
								  ->join('category c','p.cat_id=c.id')
								  ->join('sizes s','ps.size_id=s.id')
								  ->where(['ps.id'=>$psid])
								  ->group_by('p.id')
								  ->get();
			if($q->num_rows()>0)
			return $q->result();
		else
			return 0;

	}

		public function productDetailsApiList($pro_url) {
		$q = $this->db->select('c.name as cname,c.id as cid,c.page_url as cpage_url,p.id,p.page_url as ppage_url,s.name as sname,s.page_url as spage_url,p.name as title,p.pcode,p.overview,p.testimonials,p.differencenoted,p.status,p.cat_id,p.subcat_id,pi.image_path,pi.image_large,,pi.thumb,ps.mrp,ps.selling_price,ps.stock,ps.id as psid,s.id as sid,ps.minimum_buy,ps.sel_dollar,ps.b2b_selling_price,ps.b2b_sel_dollar,p.material_id as mid,p.how_to_use,p.youtubelink as youtubeid,p.tax')->from('products p')
								  ->join('product_images pi','p.id=pi.pid')
								  ->join('product_sizes ps','p.id=ps.pid')
								  ->join('category c','p.cat_id=c.id')
								  ->join('sizes s','ps.size_id=s.id')
								  ->where(['p.page_url'=>$pro_url])
								  ->group_by('p.id')
								  ->get();
			if($q->num_rows()>0)
			return $q->result();
		else
			return 0;

	}

	public function productDetailsView($pid,$cat_id) {
		$q = $this->db->select('c.name as cname,c.page_url as cpage_url,p.id,p.page_url as ppage_url,s.name as sname,s.page_url as spage_url,p.name as title,p.pcode,p.overview,p.status,p.cat_id,p.subcat_id,pi.image_path,pi.thumb,ps.mrp,ps.selling_price,ps.stock,ps.minimum_buy,s.page_url as spage_url,ps.sel_dollar,ps.b2b_selling_price,ps.b2b_sel_dollar,p.material_id as mid,p.status,p.tax')->from('products p')
								  ->join('product_images pi','p.id=pi.pid')
								  ->join('product_sizes ps','p.id=ps.pid')
								  ->join('category c','p.cat_id=c.id')
								  ->join('sizes s','ps.size_id=s.id')
								  ->where(['p.id !='=>$pid,'p.cat_id'=>$cat_id,'p.status ='=>0])
								  ->group_by('ps.pid')
								  ->get();
			if($q->num_rows()>0)
			return $q->result();
		else
			return 0;

	}

		public function productDetailsViewSimilar($pid,$cat_id) {
		$q = $this->db->select('c.name as cname,c.page_url as cpage_url,p.id,p.page_url as ppage_url,p.name as title,p.pcode,p.overview,p.status,p.cat_id,p.subcat_id,pi.image_path,pi.thumb,ps.mrp,ps.selling_price,ps.stock,ps.minimum_buy,ps.sel_dollar,ps.b2b_selling_price,ps.b2b_sel_dollar,p.material_id as mid,p.status,p.tax')->from('products p')
								  ->join('product_images pi','p.id=pi.pid')
								  ->join('product_sizes ps','p.id=ps.pid')
								  ->join('category c','p.cat_id=c.id')
								  ->where(['p.id !='=>$pid,'p.cat_id'=>$cat_id,'p.status ='=>0])
								  ->group_by('ps.pid')
								  ->get();
			if($q->num_rows()>0)
			return $q->result();
		else
			return 0;

	}

		public function productPackageDetailsView($id,$pid) {
		$q = $this->db->select('c.name as cname,c.id as cid,c.page_url as cpage_url,p.id,p.page_url as ppage_url,pp.how_to_use,pp.youtube,p.name as title,p.ptitle,pp.pcode,pp.overview,p.status,p.cat_id,p.subcat_id,pi.id as piidmg,pi.image_path,pi.thumb,pp.mrp,pp.id as ppid,pp.sellingprice,pp.stock,pp.id as psid,p.minimum_buy,pp.sname,pp.svalue,pi.image_large,pi.image_medium,pp.package_id,pp.psize,p.tax')->from('products p')
								 ->join('productpackage pp','pp.pid=p.id')
								  ->join('product_images pi','pp.id=pi.pid')
								  ->join('category c','p.cat_id=c.id')
								  ->where(['p.id'=>$id,'pp.id'=>$pid])
								  ->order_by('pp.pid desc')
								  ->limit(1)
								  ->get();
			if($q->num_rows()>0)
			return $q->result();
		else
			return 0;

	}

	public function productApiDetailsList($prod_url) {
		$q = $this->db->select('c.name as cname,c.page_url as cpage_url,p.id as pid,p.page_url as ppage_url,s.name as sname,p.name as pname,p.pcode,p.overview,p.status,p.cat_id,p.subcat_id,pi.image_path,pi.thumb,ps.mrp,ps.selling_price,ps.stock,ps.id as psid,s.id as sid,ps.minimum_buy,s.page_url as spage_url,ps.sel_dollar,ps.b2b_selling_price,ps.b2b_sel_dollar,p.material_id as mid')->from('products p')
								  ->join('product_images pi','p.id=pi.pid')
								  ->join('product_sizes ps','p.id=ps.pid')
								  ->join('category c','p.cat_id=c.id')
								  ->join('sizes s','ps.size_id=s.id')
								  ->where(['p.page_url'=>$pro_url])
								  ->get();
			if($q->num_rows()>0)
			return $q->result();
		else
			return 0;

	}



		public function productDetailsViewApiKey($pid,$id) {
		$q = $this->db->select('c.id as cid,c.name as cname,c.page_url as cpage_url,p.id,p.page_url,p.name as title,pp.pcode,pp.overview,p.status,p.cat_id,p.subcat_id,pi.image_path,pi.thumb,pp.mrp,pp.id as ppid,pp.sellingprice,pp.stock,pp.id as psid,p.minimum_buy,pp.sname,pp.svalue,pi.image_large,pp.package_id,p.ptitle,s.id as sid,s.name as sname')->from('products p')
								 ->join('productpackage pp','pp.pid=p.id')
								  ->join('product_images pi','pp.id=pi.pid')
								  ->join('category c','p.cat_id=c.id')
								  ->join('sizes s','s.id=pp.psize')
								  ->where(['c.id'=>$id,'p.id !='=>$pid,'p.status ='=>0])
								  ->group_by('p.ptitle')
								  ->get();
			if($q->num_rows()>0)
			return $q->result();
		else
			return 0;

	}



	public function productDetailsViewApi($cate,$pid,$mid) {
			$q = $this->db->select('c.name as cname,c.page_url as cpage_url,p.id,p.page_url as ppage_url,s.name as sname,s.page_url as spage_url,p.name as title,p.pcode,p.overview,p.status,p.cat_id,p.subcat_id,pi.image_path,pi.thumb,ps.mrp,ps.selling_price,ps.stock,ps.minimum_buy,s.page_url as spage_url,ps.sel_dollar,ps.b2b_selling_price,ps.b2b_sel_dollar,p.material_id as mid,p.status,p.tax')->from('products p')
								  ->join('product_images pi','p.id=pi.pid')
								  ->join('product_sizes ps','p.id=ps.pid')
								  ->join('category c','p.cat_id=c.id')
								  ->join('sizes s','ps.size_id=s.id')
								  ->where(['p.id !='=>$pid,'p.status ='=>0])
								  ->group_by('ps.pid')
								  ->get();
			if($q->num_rows()>0)
			return $q->result();
		else
			return 0;

	}
	  function runSql($sql){
    	if(!empty($sql)){
	    	$q=$this->db->query($sql);
	    	return $q->result();
    	}
    	else{
    		return '';
    	}
    }
    public function productDetailsViewS($pid,$cat_id) {
		$q = $this->db->select('c.name as cname,c.page_url as cpage_url,p.id,p.page_url as ppage_url,s.name as sname,s.page_url as spage_url,p.name as title,p.pcode,p.overview,p.status,p.cat_id,p.subcat_id,pi.image_path,pi.thumb,ps.id as psid,ps.mrp,ps.selling_price,ps.stock,ps.minimum_buy,s.page_url as spage_url,s.id as sid,ps.sel_dollar,ps.b2b_selling_price,ps.b2b_sel_dollar,p.material_id as mid,p.status,p.tax')->from('products p')
								  ->join('product_images pi','p.id=pi.pid')
								  ->join('product_sizes ps','p.id=ps.pid')
								  ->join('category c','p.cat_id=c.id')
								  ->join('sizes s','ps.size_id=s.id')
								  ->where(['p.id !='=>$pid,'p.cat_id'=>$cat_id,'p.status ='=>0])
								  ->group_by('ps.pid')
								  ->get();
			if($q->num_rows()>0)
			return $q->result();
		else
			return 0;

	}
	function getcontent1($table,$col,$id,$status,$ordcol,$order)
	{
	
		if(!empty($id)){
			$this->db->where($col,$id);
		}
		if($status != ''){
			$this->db->where('status',$status);
		}
		if($order != ''){
			$this->db->order_by($ordcol,$order);
		}
	
		$q=$this->db->get($table);
	
		if($q->num_rows()>0)
	
			return $q->result();
	
		else
	
			return 0;
	
	}
	function updateRecord($table,$db=array(),$col,$id)
	{
		$this->db->where($col,$id);
		$q=$this->db->update($table,$db);
		$total = $this->db->affected_rows();
		if($total>0)
			return 1;
		else
			return 0;
	}
	 function delete_wishlist($db=array()){
    	$this->db->delete('wishlist', $db);
    	$total = $this->db->affected_rows();
    	if($total>0)
    		return 1;
    	else
    		return 0;
    }
	public function productDetailsViewSimilars($pid,$cat_id) {
		$q = $this->db->select('c.name as cname,c.page_url as cpage_url,p.id,p.page_url as ppage_url,p.name as title,p.pcode,p.overview,p.status,p.cat_id,p.subcat_id,pi.image_path,pi.thumb,ps.mrp,ps.selling_price,ps.stock,ps.minimum_buy,ps.sel_dollar,ps.b2b_selling_price,ps.b2b_sel_dollar,p.material_id as mid,p.status,p.tax')->from('products p')
								  ->join('product_images pi','p.id=pi.pid')
								  ->join('product_sizes ps','p.id=ps.pid')
								  ->join('category c','p.cat_id=c.id')
								  ->where(['p.id !='=>$pid,'p.cat_id'=>$cat_id,'p.status ='=>0])
								  ->group_by('ps.pid')
								  ->get();
			if($q->num_rows()>0)
			return $q->result();
		else
			return 0;

	}
}

?>