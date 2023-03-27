<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/pthome
     *    - or -  
     *         http://example.com/index.php/blueadmin/index
     *    - or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/pthome
     <method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
     
    protected $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('utility_helper');
        $this->load->helper('cookie');
        no_cache();
        $this->load->model('home_db');
		$this->load->model('master_db');
		
		$cookie=get_cookie('bl_CatpAdmin');
        
        if(!$this->session->userdata('atpAdmin') && $cookie=="")
        {    
            redirect('atplogin','refresh');
        }
        else
        {
        if($this->session->userdata('atpAdmin')){
            $det=$this->home_db->getdetails($this->session->userdata('atpAdmin'));
        }
        else if($cookie!=""){
        $det=$this->home_db->getdetails($cookie);
        }
            $this->data['detail']=$det;
        }  
        $this->data['updatelogin']=$this->load->view('updatelogin', NULL , TRUE);
        $this->data['popcss']=$this->load->view('popcss', NULL , TRUE);
		$this->data['header']=$this->load->view('header', NULL , TRUE);
        $this->data['newsess'] = $this->data['detail'];
		$this->data['jsfile']=$this->load->view('jsfile', NULL , TRUE);
        $this->data['left']=$this->load->view('left', $this->data , TRUE); 
		//$this->load->library('excel');
        $this->data['styleArray'] = array('font'  => array('bold'  => true,'size'  => 10,'name'  => 'arial'));
        $this->data['styleArrayrow ']= array('font'  => array('size'  => 10,'name'  => 'arial'));
        $this->data['styleArrayactive '] = array('font'  => array('bold'  => true,'color' => array('rgb' => 'green'),'name'  => 'arial'));
        $this->data['styleArrayinactive '] = array('font'  => array('bold'  => true, 'color' => array('rgb' => 'red'),'name'  => 'arial'));
        // $this->data['styleArrayunpaid']=array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFB8AA')));
    }

    
    

	//-----category--------//
	public function category()
    {
		$this->data['category'] = $this->load->view('getcategory', $this->data, TRUE);
    	$this->load->view('category',$this->data) ;
    }
    
    public function category_table()
    {
	   $db=array(
				'page'=>$this->input->post('page'),
				'rp'=>$this->input->post('rp'),
				'sortname'=>$this->input->post('sortname'),
				'sortorder'=>$this->input->post('sortorder'),
				'qtype'=>$this->input->post('qtype'),
				'query'=>$this->input->post('query'),
				'letter_pressed'=>$this->input->post('letter_pressed'),
		);
		$this->data=$this->master_db->gettable_category('category',$db);
		echo $this->data;
    }
    
	public function category_add(){
        $this->data['type']='add';
        $this->data['details']=array();
        $this->load->view('editcategory',$this->data);
    }
    
	public function category_save(){
        $det=$this->data['detail'];
        //echo "<pre>";print_r($_POST);print_r($_FILES);exit;
        $order_no=$this->input->post('order_no');
        $desc=$this->input->post('desc');
        $name = trim(preg_replace('!\s+!', ' ',$this->input->post('name')));
         
        $db['order_no'] = $order_no;
        $db['description'] = $desc;
        $db['name'] = $name;
        

            if(!empty($_FILES['imag']['name'])) {
                        $uploadPath = 'assets/our_products/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|jpeg|PNG|png';
                       
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('imag')){
                            
                                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>'.$this->upload->display_errors().'</div>');
                        }else {
                            $upload_data = $this->upload->data();
                            $db['image_path'] =  'assets/our_products/'.$upload_data['file_name']; 
                        }
                    }
       
                   
            
         if(!empty($_FILES['bimage']['name'])) {
                        $uploadPath = 'assets/our_products/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|jpeg|PNG|png';
                       
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('bimage')){
                            
                                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>'.$this->upload->display_errors().'</div>');
                        }else {
                            $upload_data = $this->upload->data();
                            $db['icons'] =  'assets/our_products/'.$upload_data['file_name']; 
                        }
                    }
            
             $res=$this->master_db->insertRecord('category',$db);  
       

        if($res){
        	
        	//$this->all_views();
        	
            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Success</div>');
            redirect('master/category');
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Failed</div>');
            redirect('master/category');
        }
    }    
    
	public function all_views(){
    	$this->createviews_back();
    	$this->createviews_front();
    	$this->createcategviews();
    	$this->creatematerialviews();
    	$this->createcolorviews();
    	$this->createsizeviews();
    	$this->createwishlistviews();
    	$this->creategifts();
    }
    
	public function createviews_back(){
    	$c =  $this->master_db->getcontent1('category','','');
    	foreach ($c as $ca){
    	$sql = "CREATE OR REPLACE VIEW ".$ca->page_url."_product_view
				AS
				Select c.id as cid,c.order_no corder_no,c.name cname,c.page_url cpage_url,c.status cstatus,
				m.name mname, m.id mid, m.order_no morder_no, m.page_url mpage_url,m.status mstatus,
				cl.name clname, cl.id clid, cl.order_no clorder_no, cl.page_url clpage_url,cl.status clstatus,
				p.id pid,p.name pname,p.page_url ppage_url,p.status pstatus, overview, pcode, vase, p.created_date pcreated_date,
				pi.order_no piorder_no, pi.image_path, ps.id as psid, ps.mrp, ps.selling_price, ps.stock,ps.size_id,
				s.name sname, s.id sid, s.order_no sorder_no,s.page_url spage_url,s.status sstatus,home_page,p.special,p.exclusive
				From category c,materials m, colors cl, products p, product_images pi, product_sizes ps, sizes s
				Where c.id=p.cat_id and p.material_id=m.id and cl.id=p.color_id and p.id=ps.pid and (ps.size_id=s.id or ps.size_id=0)
    			and p.id=pi.pid and pi.status=0 and p.status=0 and ps.status=0 and c.page_url='".$ca->page_url."'
				group by ps.id order by pi.order_no";
    	$this->master_db->runQuery($sql);
    	}
    }
    
    
	public function createviews_front(){
    	$c =  $this->master_db->getcontent1('category','','');
    	foreach ($c as $ca){
	    	$sql = "CREATE OR REPLACE VIEW frontview_".$ca->page_url."_product
					AS
					Select c.id as cid,c.order_no corder_no,c.name cname,c.page_url cpage_url,c.description cdescription, c.image_path cimage_path,
					m.name mname, m.id mid, m.order_no morder_no, m.page_url mpage_url,
					cl.name clname, cl.id clid, cl.order_no clorder_no, cl.page_url clpage_url,
					p.id pid,p.name pname,p.page_url ppage_url, overview, pcode, vase, p.created_date pcreated_date,
					pi.order_no piorder_no, pi.image_path, ps.id as psid, ps.mrp, ps.selling_price, ps.sel_dollar, ps.b2b_selling_price, ps.b2b_sel_dollar,ps.minimum_buy,ps.stock,ps.size_id,
					s.name sname, s.id sid, s.order_no sorder_no,s.page_url spage_url, home_page,IFNULL(sub.name,'') as sub_name,IFNULL(ssub.name,'') as sub_sub_name,IFNULL(sub.page_url,'') as subpage_url,IFNULL(ssub.page_url,'') as sub_subpage_url
					From category c,materials m, colors cl, product_images pi, product_sizes ps, sizes s,products p
					
					LEFT JOIN subcategory sub ON sub.id=p.subcat_id
					LEFT JOIN sub_subcategory ssub ON ssub.id=p.sub_sub_id
					Where c.id=p.cat_id and p.material_id=m.id and cl.id=p.color_id and p.id=ps.pid and (ps.size_id=s.id or ps.size_id=0)
	    			and p.id=pi.pid and pi.status=0 and ps.status=0 and c.page_url='".$ca->page_url."' 
	    			and c.status IN(0,2) and m.status=0 and cl.status=0 and p.status=0 and s.status=0 and (ps.selling_price!='' or CAST(ps.selling_price AS DECIMAL)>0) 
					group by ps.id order by pi.order_no";
	    	$this->master_db->runQuery($sql);
    	}
    }
	
	
	
	public function createexclusivelistviews(){
    	$c =  $this->master_db->getcontent1('category','','');
    	$sql = "CREATE OR REPLACE VIEW frontview_exclusive_offers
    	AS ";
    	$sub = array();
    	foreach ($c as $ca){
    		
    		
    		$sub[] = " (Select c.id as cid,c.order_no corder_no,c.name cname,c.page_url cpage_url,c.description cdescription, c.image_path cimage_path,
					m.name mname, m.id mid, m.order_no morder_no, m.page_url mpage_url,
					cl.name clname, cl.id clid, cl.order_no clorder_no, cl.page_url clpage_url,
					p.id pid,p.name pname,p.page_url ppage_url, overview, pcode, vase, p.created_date pcreated_date,
					pi.order_no piorder_no, pi.image_path, ps.id as psid, ps.mrp, ps.selling_price, ps.sel_dollar, ps.b2b_selling_price, ps.b2b_sel_dollar,ps.minimum_buy,ps.stock,ps.size_id,
					s.name sname, s.id sid, s.order_no sorder_no,s.page_url spage_url, home_page,IFNULL(sub.name,'') as sub_name,IFNULL(ssub.name,'') as sub_sub_name,IFNULL(sub.page_url,'') as subpage_url,IFNULL(ssub.page_url,'') as sub_subpage_url
					From category c,materials m, colors cl, product_images pi, product_sizes ps, sizes s,products p
					
					LEFT JOIN subcategory sub ON sub.id=p.subcat_id
					LEFT JOIN sub_subcategory ssub ON ssub.id=p.sub_sub_id
					Where c.id=p.cat_id and p.material_id=m.id and cl.id=p.color_id and p.id=ps.pid and (ps.size_id=s.id or ps.size_id=0)
	    			and p.id=pi.pid and pi.status=0 and ps.status=0 and c.page_url='".$ca->page_url."' 
	    			and c.status IN(0,2) and m.status=0 and cl.status=0 and p.status=0 and s.status=0 and (ps.selling_price!='' or CAST(ps.selling_price AS DECIMAL)>0) and ps.stock>0 and p.exclusive=1
					group by p.id order by pi.order_no) ";
    		//$sub[] = $sql;
    	}
    
    	$sql = $sql.implode(" union ", $sub);
    	$this->master_db->runQuery($sql);
    }
	
	public function createbundlelistviews(){
    	$c =  $this->master_db->getcontent1('category','','');
    	$sql = "CREATE OR REPLACE VIEW frontview_bundle_product
    	AS ";
    	$sub = array();
    	foreach ($c as $ca){
    		
    		
    		$sub[] = " (Select c.id as cid,c.order_no corder_no,c.name cname,c.page_url cpage_url,c.description cdescription, c.image_path cimage_path,
					m.name mname, m.id mid, m.order_no morder_no, m.page_url mpage_url,
					cl.name clname, cl.id clid, cl.order_no clorder_no, cl.page_url clpage_url,
					p.id pid,p.name pname,p.page_url ppage_url, overview, pcode, vase, p.created_date pcreated_date,
					pi.order_no piorder_no, pi.image_path, ps.id as psid, ps.mrp, ps.selling_price, ps.sel_dollar, ps.b2b_selling_price, ps.b2b_sel_dollar,ps.minimum_buy,ps.stock,ps.size_id,
					s.name sname, s.id sid, s.order_no sorder_no,s.page_url spage_url, home_page,IFNULL(sub.name,'') as sub_name,IFNULL(ssub.name,'') as sub_sub_name,IFNULL(sub.page_url,'') as subpage_url,IFNULL(ssub.page_url,'') as sub_subpage_url
					From category c,materials m, colors cl, product_images pi, product_sizes ps, sizes s,products p
					
					LEFT JOIN subcategory sub ON sub.id=p.subcat_id
					LEFT JOIN sub_subcategory ssub ON ssub.id=p.sub_sub_id
					Where c.id=p.cat_id and p.material_id=m.id and cl.id=p.color_id and p.id=ps.pid and (ps.size_id=s.id or ps.size_id=0)
	    			and p.id=pi.pid and pi.status=0 and ps.status=0 and c.page_url='".$ca->page_url."' 
	    			and c.status IN(0,2) and m.status=0 and cl.status=0 and p.status=0 and s.status=0 and (ps.selling_price!='' or CAST(ps.selling_price AS DECIMAL)>0) and ps.stock>0 and p.home_page=1
					group by p.id order by pi.order_no) ";
    		//$sub[] = $sql;
    	}
    
    	$sql = $sql.implode(" union ", $sub);
    	$this->master_db->runQuery($sql);
    }
	
	
	public function creatediscountlistviews(){
    	$c =  $this->master_db->getcontent1('category','','');
    	$sql = "CREATE OR REPLACE VIEW frontview_special_offers
    	AS ";
    	$sub = array();
    	foreach ($c as $ca){
    		
    		
    		$sub[] = " (Select c.id as cid,c.order_no corder_no,c.name cname,c.page_url cpage_url,c.description cdescription, c.image_path cimage_path,
					m.name mname, m.id mid, m.order_no morder_no, m.page_url mpage_url,
					cl.name clname, cl.id clid, cl.order_no clorder_no, cl.page_url clpage_url,
					p.id pid,p.name pname,p.page_url ppage_url, overview, pcode, vase, p.created_date pcreated_date,
					pi.order_no piorder_no, pi.image_path, ps.id as psid, ps.mrp, ps.selling_price, ps.sel_dollar, ps.b2b_selling_price, ps.b2b_sel_dollar,ps.minimum_buy,ps.stock,ps.size_id,
					s.name sname, s.id sid, s.order_no sorder_no,s.page_url spage_url, home_page,IFNULL(sub.name,'') as sub_name,IFNULL(ssub.name,'') as sub_sub_name,IFNULL(sub.page_url,'') as subpage_url,IFNULL(ssub.page_url,'') as sub_subpage_url
					From category c,materials m, colors cl, product_images pi, product_sizes ps, sizes s,products p
					
					LEFT JOIN subcategory sub ON sub.id=p.subcat_id
					LEFT JOIN sub_subcategory ssub ON ssub.id=p.sub_sub_id
					Where c.id=p.cat_id and p.material_id=m.id and cl.id=p.color_id and p.id=ps.pid and (ps.size_id=s.id or ps.size_id=0)
	    			and p.id=pi.pid and pi.status=0 and ps.status=0 and c.page_url='".$ca->page_url."' 
	    			and c.status IN(0,2) and m.status=0 and cl.status=0 and p.status=0 and s.status=0 and (ps.selling_price!='' or CAST(ps.selling_price AS DECIMAL)>0) and ps.stock>0 and p.special=1
					group by p.id order by pi.order_no) ";
    		//$sub[] = $sql;
    	}
    
    	$sql = $sql.implode(" union ", $sub);
    	$this->master_db->runQuery($sql);
    }
    
    public function createcategviews(){
    	$c =  $this->master_db->getcontent1('category','','');
    	$sql = "CREATE OR REPLACE VIEW view_categ_exist
    	AS ";
    	$sub = array();
    	foreach ($c as $ca){
    		
    		$sub[] = " SELECT cid,corder_no,cname,cpage_url,cdescription,cimage_path FROM frontview_".$ca->page_url."_product where 1 group by cid ";   
    				
    	}
    	
    	$sql = $sql.implode(" union ", $sub);
		//echo $sql;exit;
    	$this->master_db->runQuery($sql);
    }
    
    
    public function creatematerialviews(){
    	$c =  $this->master_db->getcontent1('category','','');
    	$sql = "CREATE OR REPLACE VIEW view_material_exists
    	AS ";
    	$sub = array();
    	foreach ($c as $ca){
    		$sub[] = " SELECT mname,mid,morder_no,mpage_url,cpage_url FROM frontview_".$ca->page_url."_product where mid!=0 group by mid ";
    	}
    	 
    	$sql = $sql.implode(" union ", $sub);
    	$this->master_db->runQuery($sql);
    }
    
    
    public function createcolorviews(){
    	$c =  $this->master_db->getcontent1('category','','');
    	$sql = "CREATE OR REPLACE VIEW view_color_exists
    	AS ";
    	$sub = array();
    	foreach ($c as $ca){
    		$sub[] = " SELECT clname,clid,clorder_no,clpage_url,cpage_url FROM frontview_".$ca->page_url."_product where clid!=0 group by clid ";
    	}
    
    	$sql = $sql.implode(" union ", $sub);
    	$this->master_db->runQuery($sql);
    }
    
    public function createsizeviews(){
    	$c =  $this->master_db->getcontent1('category','','');
    	$sql = "CREATE OR REPLACE VIEW view_sizes_exists
    	AS ";
    	$sub = array();
    	foreach ($c as $ca){
    		$sub[] = " SELECT sname,sid,sorder_no,spage_url,cpage_url,size_id FROM frontview_".$ca->page_url."_product where 1 group by sid ";
    	}
    
    	$sql = $sql.implode(" union ", $sub);
    	$this->master_db->runQuery($sql);
    }
    
    public function createwishlistviews(){
    	$c =  $this->master_db->getcontent1('category','','');
    	$sql = "CREATE OR REPLACE VIEW wishlist_view
    	AS ";
    	$sub = array();
    	foreach ($c as $ca){
    		
    		//$sql = " (SELECT pname,ppage_url,pcode,cpage_url,pid,image_path,id,user_id,selling_price,created_date,mrp,psid FROM
    				//	(SELECT pname,ppage_url,pcode,cpage_url,f.pid,image_path,w.id,w.user_id,selling_price,w.created_date,mrp,psid FROM frontview_".$ca->page_url."_product f, wishlist w where f.pid=w.pid and w.categ='".$ca->page_url."' order by CAST(selling_price AS DECIMAL) asc ) t
    				//	group by id) ";//order by pcreated_date desc
    		
    		$sub[] = " (SELECT pname,ppage_url,pcode,cpage_url,f.pid,image_path,w.id,w.user_id,selling_price,sel_dollar,b2b_selling_price,b2b_sel_dollar,minimum_buy,w.created_date,mrp,psid FROM frontview_".$ca->page_url."_product f, wishlist w where f.pid=w.pid and w.categ='".$ca->page_url."' group by w.id order by CAST(selling_price AS DECIMAL) asc) ";
    		//$sub[] = $sql;
    	}
    
    	$sql = $sql.implode(" union ", $sub);
    	$this->master_db->runQuery($sql);
    }
    
    public function creategifts(){
    	$c =  $this->master_db->getcontent1('gifts','','');
    	foreach ($c as $ca){
    		$sql = "CREATE OR REPLACE VIEW gift_".$ca->page_url."_view
					AS
					Select c.id as cid,c.order_no corder_no,c.name cname,c.page_url cpage_url, 
    				p.id pid,p.name pname,p.page_url ppage_url, pcode, p.created_date pcreated_date, 
    				pi.order_no piorder_no, pi.image_path, ps.id as psid, ps.mrp, ps.selling_price, ps.stock,ps.size_id, 
    				s.name sname, s.id sid, s.order_no sorder_no,s.page_url spage_url, 
    				g.order_no gorder_no, g.title gtitle, g.image_path gimage_path, g.page_url gpage_url, g.created_date gcreated_date 
    				From category c,materials m, colors cl, products p, product_images pi, product_sizes ps, sizes s, gifts g, gift_products gp 
    				Where c.id=p.cat_id and p.material_id=m.id and cl.id=p.color_id and p.id=ps.pid and (ps.size_id=s.id or ps.size_id=0) and 
    				p.id=pi.pid and pi.status=0 and ps.status=0 and g.id=gp.gift_id and gp.pid=p.id and g.status=0 and c.status=0 and m.status=0 and 
    				cl.status=0 and p.status=0 and s.status=0 and (ps.selling_price!='' or CAST(ps.selling_price AS DECIMAL)>0) and ps.stock>0 and g.id='".$ca->id."'
    				group by ps.id order by pi.order_no ";
    		$this->master_db->runQuery($sql);
    	}
    }
    
	public function category_edit(){
		$det=$this->data['detail'];
	
		$id=$this->input->get('id');
		$res = 0;
		if(!empty($id) && $_SERVER['REQUEST_METHOD'] != 'POST')
		{
			$details = $this->master_db->getcontent('category',$id);
			if(is_array($details)){
				$this->data['type']='edit';
				$this->data['details']=$details;
				$this->load->view('editcategory',$this->data);
			}
			else{
				redirect('master/category');
			}
		}	
		else if($_SERVER['REQUEST_METHOD']=='POST')
		{
				$id=$this->input->post('aid');
                //echo "<pre>";print_r($_POST);print_r($_FILES);exit;
				$details = $this->master_db->getcontent('category',$id);
				$order_no=$this->input->post('order_no');
            	$desc=$this->input->post('desc');
            	$name = trim(preg_replace('!\s+!', ' ',$this->input->post('name')));
				 $db['order_no'] = $order_no;
        $db['description'] = $desc;
        $db['name'] = $name;
        

            if(!empty($_FILES['imag']['name'])) {
                        $uploadPath = 'assets/our_products/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|jpeg|PNG|png';
                       
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('imag')){
                            
                                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>'.$this->upload->display_errors().'</div>');
                        }else {
                            $upload_data = $this->upload->data();
                            $db['image_path'] =  'assets/our_products/'.$upload_data['file_name']; 
                        }
                    }
       
                   
            
         if(!empty($_FILES['bimage']['name'])) {
                        $uploadPath = 'assets/our_products/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|jpeg|PNG|png';
                       
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('bimage')){
                            
                                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>'.$this->upload->display_errors().'</div>');
                        }else {
                            $upload_data = $this->upload->data();
                            $db['icons'] =  'assets/our_products/'.$upload_data['file_name']; 
                        }
                    }
                    $db['modified_date'] =date('Y-m-d H:i:s');
           $res =  $this->master_db->updateRecord('category',$db,['id'=>$id]);
           //echo $this->db->last_query();exit;

				if($res)
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Updated Successfully</div>');
	
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
	
				}
				redirect('master/category');
	
				}
				else{
					redirect('master/category');
				}
				}
				
	public function category_status()
	{
		$items = $this->input->post('items');
		$status = $this->input->post('status');
		$db=array(
		'items'=>$items,
		'status'=>$status,
		'modified_date'=>date('Y-m-d H:i:s'),
		);
		$this->master_db->changeStatus('category',$db);
		if($status == 2)
		{
			$this->master_db->deleterecordss('category',array("id"=>$items));
		}
		$this->data['category'] = $this->load->view('getcategory', $this->data ,TRUE);
		echo $this->data['category'];
	}
	public function new_collection_status()
	{
		$items = $this->input->post('items');
		$status = $this->input->post('status');
		$db=array(
		'items'=>$items,
		'new_collection'=>$status,
		'modified_date'=>date('Y-m-d H:i:s'),
		);
		$this->master_db->new_collection_status('category',$db);
		$this->data['category'] = $this->load->view('getcategory', $this->data ,TRUE);
		echo $this->data['category'];
	}
    
    




    //***********************************************************************************************************************
//*********************************************subcategory***************************************************************


    public function subcategory()
    {
		$this->data['subcategory'] = $this->load->view('getsubcategory', $this->data, TRUE);
        $this->load->view('subcategory',$this->data) ;
    }

    public function subcategory_table()
    {
        $db=array(
            'page'=>$this->input->post('page'),
            'rp'=>$this->input->post('rp'),
            'sortname'=>$this->input->post('sortname'),
            'sortorder'=>$this->input->post('sortorder'),
            'qtype'=>$this->input->post('qtype'),
            'query'=>$this->input->post('query'),
            'letter_pressed'=>$this->input->post('letter_pressed'),
        );
        $this->data=$this->master_db->gettable_subcategory($db);
        echo $this->data;
    }

    public function subcategory_add()
    {
        $this->data['type']='add';
        $this->data['country']=$this->master_db->getRecords('category',['status'=>0],'*');
        $this->load->view('editsubcategory',$this->data);
    }

    function subcategory_save()
    {
        $det=$this->data['detail'];
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $post=$this->input->post(null,true);
            $country=$this->input->post('country');
            $order=$this->input->post('order_no');
            for($i=0;$i<count($_POST['np']);$i++)
            {
                $name=$post['np'] ;
                if(!empty($name[$i]))
                {
                    $check = $this->master_db->dup_check('subcategory',trim(preg_replace('!\s+!', ' ',$name[$i])),'');
                    if($check == "0"){
                        $db=array(
                            'name'=>trim(preg_replace('!\s+!', ' ',$name[$i])),
                            'category_id'=>$country,
                            'order_no'=>$order,
                        	'page_url'=>$this->master_db->create_unique_slug(trim(preg_replace('!\s+!', ' ',$name[$i])),'subcategory','page_url'),
                            'created_date'=>date('Y-m-d H:i:s'),

                        );
                        $res1=$this->master_db->insertRecord('subcategory',$db);
                    }
                }
            }

            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sub-category Added Successfully</div>');


            redirect('master/subcategory');
        }
        else{
            redirect(base_url());
        }
    }



    public function subcategory_status()
    {
        $status=$this->input->post('status');
        $det=$this->data['detail'];

        $db=array(
            'items'=>$this->input->post('items'),

            'modified_date'=>date('Y-m-d H:i:s'),
            'status'=>$status,
        );
        $status=$this->master_db->changeStatus('subcategory',$db);
        // redirect('master/subcategory');
    }

    public function subcategory_edit(){
        $det=$this->data['detail'];

        $id=$this->input->get('id');

        if($id)
        {
            $this->data['type']='edit';
            $this->data['country']=$this->master_db->sqlExecute('select * from category where status =0');
            $this->data['details']=$this->master_db->getcontent('subcategory',$id);
            $this->load->view('editsubcategory',$this->data);
        }

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $country=$this->input->post('country');
            $order=$this->input->post('order_no');
            $name = trim(preg_replace('!\s+!', ' ',$this->input->post('name')));
             if(!empty($order)) {
                $orderss .= $order;
            }else {

            }
            $db=array(
                
                'category_id'=>$country,
                'name'=>$name,
                'modified_date'=>date('Y-m-d H:i:s'),
                'order_no'=>$orderss,
                

            );
           
                $res=$this->master_db->updateRecord('subcategory',$db,$id);
          
            if($res)
            {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');

            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');

            }
            redirect('master/subcategory');

        }
    }

//*********************************************sub_subcategory***************************************************************


    public function sub_subcategory()
    {
		$this->data['sub_subcategory'] = $this->load->view('getsub_subcategory', $this->data, TRUE);
        $this->load->view('sub_subcategory',$this->data) ;
    }

    public function sub_subcategory_table()
    {
        $db=array(
            'page'=>$this->input->post('page'),
            'rp'=>$this->input->post('rp'),
            'sortname'=>$this->input->post('sortname'),
            'sortorder'=>$this->input->post('sortorder'),
            'qtype'=>$this->input->post('qtype'),
            'query'=>$this->input->post('query'),
            'letter_pressed'=>$this->input->post('letter_pressed'),
        );
        $this->data=$this->master_db->gettable_sub_subcategory($db);
        echo $this->data;
    }

    public function sub_subcategory_add()
    {
        $this->data['type']='add';
        $this->data['country']=$this->master_db->getRecords('subcategory',['status'=>0],'*');
        $this->load->view('editsub_subcategory',$this->data);
    }

    function sub_subcategory_save()
    {
        $det=$this->data['detail'];
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $post=$this->input->post(null,true);
            $country=$this->input->post('country');
            $order=$this->input->post('order_no');
            for($i=0;$i<count($_POST['np']);$i++)
            {
                $name=$post['np'] ;
                if(!empty($name[$i]))
                {
                    $check = $this->master_db->dup_check('sub_subcategory',trim(preg_replace('!\s+!', ' ',$name[$i])),'');
                    if($check == "0"){
                        $db=array(
                            'subcategory_id'=>$country,
                            'name'=>trim(preg_replace('!\s+!', ' ',$name[$i])),
                            'cat_id'=>$country,
                             'created_date'=>date('Y-m-d H:i:s'),
                             'page_url'=>$this->master_db->create_unique_slug(trim(preg_replace('!\s+!', ' ',$name[$i])),'sub_subcategory','page_url'),
                            'order_no'=>$order,
                        	
                           

                        );
                        
                    }
                }
            }
           $res1=$this->master_db->insertRecord('sub_subcategory',$db);
                         $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sub-category Added Successfully</div>');
            redirect('master/sub_subcategory');
        }
        else{
            redirect(base_url());
        }
    }



    public function sub_subcategory_status()
    {
        $status=$this->input->post('status');
        $det=$this->data['detail'];

        $db=array(
            'items'=>$this->input->post('items'),

            'modified_date'=>date('Y-m-d H:i:s'),
            'status'=>$status,
        );
        $status=$this->master_db->changeStatus('sub_subcategory',$db);
        echo $status;
    }

    public function sub_subcategory_edit(){
        $det=$this->data['detail'];

        $id=$this->input->get('id');

        if($id)
        {
            $this->data['type']='edit';
            $this->data['country']=$this->master_db->getRecords('subcategory',['status ='=>0],'*');
            $this->data['details']=$this->master_db->getRecords('sub_subcategory',['id'=>$id],'*');
            $this->load->view('editsub_subcategory',$this->data);
        }

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $country=$this->input->post('country');
            $order=$this->input->post('order_no');
            $name = trim(preg_replace('!\s+!', ' ',$this->input->post('name')));
            $orderss = "";
            if(!empty($order)) {
                $orderss .= $order;
            }else {

            }
           
            $db=array(
                'subcategory_id'=>$country,
                'name'=>$name,
                 'modified_date'=>date('Y-m-d H:i:s'),
                'order_no'=>$orderss,
               

            );
            $check = $this->master_db->dup_check('sub_subcategory',$name,$id);
            if($check == "0"){
                $res=$this->master_db->updateRecord('sub_subcategory',$db,$id);
            }
            if($res)
            {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');

            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');

            }
            redirect('master/sub_subcategory');

        }
    }

    //-----Material--------//
    public function material()
    {
		$this->data['material_data'] = $this->load->view('getmaterial', $this->data, TRUE);
		$this->load->view('material', $this->data);
    } 
	

    public function material_table()
    {
        $db=array(
            'page'=>$this->input->post('page'),
            'rp'=>$this->input->post('rp'),
            'sortname'=>$this->input->post('sortname'),
            'sortorder'=>$this->input->post('sortorder'),
            'qtype'=>$this->input->post('qtype'),
            'query'=>$this->input->post('query'),
            'letter_pressed'=>$this->input->post('letter_pressed'),
        );
        $this->data=$this->master_db->gettable_materials($db);
        echo $this->data;
    }

    public function material_add()
    {
        $this->data['type']='add';

        $this->load->view('editmaterial',$this->data);
    }

    function material_save()
    {
        $det=$this->data['detail'];
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
           // $order = $this->input->post('order');
            $post=$this->input->post(null,true);

            for($i=0;$i<count($_POST['np']);$i++)
            {
                $name=$post['np'] ;
                $order=$post['order'] ;
                if(!empty($name[$i]) && !empty($order[$i]))
                {
                    $check = $this->master_db->dup_check('materials',trim(preg_replace('!\s+!', ' ',$name[$i])),'');
                    if($check == "0"){
                        $db=array(
                            'name'=>trim(preg_replace('!\s+!', ' ',$name[$i])),
                            'page_url'=>$this->master_db->create_unique_slug(trim(preg_replace('!\s+!', ' ',$name[$i])),'materials','page_url'),
                            'order_no'=>trim(preg_replace('!\s+!', ' ',$order[$i])),
                            'status'=>'0'

                        );
                       
                    }
                }
            }

            $res1=$this->master_db->insertRecord('materials',$db);
                         $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Material Added Successfully</div>');


            redirect('master/material');
        }
        else{
            redirect(base_url());
        }
    }



    public function material_status()
    {
      /*  $status=$this->input->post('status');
        $det=$this->data['detail'];

        $db=array(
            'items'=>$this->input->post('items'),
            'user_id'=>$det[0]->id,
            'modified_date'=>date('Y-m-d H:i:s'),
            'status'=>$status,
        );
        $status=$this->master_db->changeStatus('materials',$db);
        echo $status;*/
		
			$items = $this->input->post('items');
			$status = $this->input->post('status');
            //echo "<pre>";print_r($_POST);exit;
			$db=array(
			'items'=>$items,
			'status'=>$status,
			'modified_date'=>date('Y-m-d H:i:s'),
			);
			$this->master_db->changeStatus('materials',$db);
			if($status == 2)
			{
				$this->master_db->deleterecordss('materials',['id'=>$items]);
			}
			$this->data['material'] = $this->load->view('getmaterial', $this->data ,TRUE);
			echo $this->data['material'];
		}

    public function material_edit(){
        $det=$this->data['detail'];

        $id=$this->input->get('id');

        if($id)
        {
            $this->data['type']='edit';

            $this->data['details']=$this->master_db->getcontent('materials',$id);
            $this->load->view('editmaterial',$this->data);
        }

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $order=$this->input->post('order');

            $name = trim(preg_replace('!\s+!', ' ',$this->input->post('name')));
            $db=array(
                'name'=>$name,
                'order_no'=>$order,




            );
            $check = $this->master_db->dup_check('materials',$name,$id);
            if($check == "0"){
                $res=$this->master_db->updateRecord('materials',$db,$id);
            }
            if($res)
            {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');

            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');

            }
            redirect('master/material');

        }
    }


    //-----Color--------//
    public function color()
    {
		$this->data['color'] = $this->load->view('getcolor', $this->data, TRUE);
        $this->load->view('color',$this->data) ;
    }

    public function color_table()
    {
        $db=array(
            'page'=>$this->input->post('page'),
            'rp'=>$this->input->post('rp'),
            'sortname'=>$this->input->post('sortname'),
            'sortorder'=>$this->input->post('sortorder'),
            'qtype'=>$this->input->post('qtype'),
            'query'=>$this->input->post('query'),
            'letter_pressed'=>$this->input->post('letter_pressed'),
        );
        $this->data=$this->master_db->gettable_colors($db);
        echo $this->data;
    }

    public function color_add()
    {
        $this->data['type']='add';

        $this->load->view('editcolor',$this->data);
    }

    function color_save()
    {
        $det=$this->data['detail'];
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            // $order = $this->input->post('order');
            $post=$this->input->post(null,true);

            for($i=0;$i<count($_POST['np']);$i++)
            {
                $name=$post['np'] ;
                $order=$post['order'] ;
                if(!empty($name[$i]) && !empty($order[$i]))
                {
                    $check = $this->master_db->dup_check('colors',trim(preg_replace('!\s+!', ' ',$name[$i])),'');
                    if($check == "0"){
                        $db=array(
                            'name'=>trim(preg_replace('!\s+!', ' ',$name[$i])),
                            'order_no'=>trim(preg_replace('!\s+!', ' ',$order[$i])),
                            'status'=>'0',
                            'page_url'=>$this->master_db->create_unique_slug(trim(preg_replace('!\s+!', ' ',$name[$i])),'colors','page_url'),

                        );
                        $res1=$this->master_db->insertRecord('colors',$db);
                    }
                }
            }

            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Color Added Successfully</div>');


            redirect('master/color');
        }
        else{
            redirect(base_url());
        }
    }

 public function color_status()
    {
			$items = $this->input->post('items');
			$status = $this->input->post('status');
			$db=array(
			'items'=>$items,
			'status'=>$status,
			'modified_date'=>date('Y-m-d H:i:s'),
			);
			$this->master_db->changeStatus('colors',$db);
			if($status == 2)
			{
				$this->master_db->deleterecordss('colors',array("id"=>$items));
			}
			$this->data['colors'] = $this->load->view('getcolor', $this->data ,TRUE);
			echo $this->data['colors'];
		}




	

    
    public function color_edit(){
        $det=$this->data['detail'];

        $id=$this->input->get('id');

        if($id)
        {
            $this->data['type']='edit';

            $this->data['details']=$this->master_db->getcontent('colors',$id);
            $this->load->view('editcolor',$this->data);
        }

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $order=$this->input->post('order');

            $name = trim(preg_replace('!\s+!', ' ',$this->input->post('name')));
            $db=array(
                'name'=>$name,
                'order_no'=>$order,




            );
            $check = $this->master_db->dup_check('colors',$name,$id);
            if($check == "0"){
                $res=$this->master_db->updateRecord('colors',$db,$id);
            }
            if($res)
            {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');

            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');

            }
            redirect('master/color');

        }
    }


    //-----Size--------//
    public function size()
    {
		$this->data['size'] = $this->load->view('getsize', $this->data, TRUE);
        $this->load->view('size',$this->data) ;
    }

    public function size_table()
    {
        $db=array(
            'page'=>$this->input->post('page'),
            'rp'=>$this->input->post('rp'),
            'sortname'=>$this->input->post('sortname'),
            'sortorder'=>$this->input->post('sortorder'),
            'qtype'=>$this->input->post('qtype'),
            'query'=>$this->input->post('query'),
            'letter_pressed'=>$this->input->post('letter_pressed'),
        );
        $this->data=$this->master_db->gettable_sizes($db);
        echo $this->data;
    }

    public function size_add()
    {
        $this->data['type']='add';

        $this->load->view('editsize',$this->data);
    }

    function size_save()
    {
        $det=$this->data['detail'];
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            // $order = $this->input->post('order');
            $post=$this->input->post(null,true);

            for($i=0;$i<count($_POST['np']);$i++)
            {
                $name=$post['np'] ;
                $order=$post['order'] ;
                if(!empty($name[$i]) && !empty($order[$i]))
                {
                    $check = $this->master_db->dup_check('sizes',trim(preg_replace('!\s+!', ' ',$name[$i])),'');
                    if($check == "0"){
                        $db=array(
                            'name'=>trim(preg_replace('!\s+!', ' ',$name[$i])),
                            'order_no'=>trim(preg_replace('!\s+!', ' ',$order[$i])),
                            'status'=>'0',
                            'page_url'=>$this->master_db->create_unique_slug(trim(preg_replace('!\s+!', ' ',$name[$i])),'sizes','page_url'),

                        );
                        $res1=$this->master_db->insertRecord('sizes',$db);
                    }
                }
            }

            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Size Added Successfully</div>');


            redirect('master/size');
        }
        else{
            redirect(base_url());
        }
    }

    public function size_status()
    {
		$items = $this->input->post('items');
		$status = $this->input->post('status');
		$db=array(
		'items'=>$items,
		'status'=>$status,
		'modified_date'=>date('Y-m-d H:i:s'),
		);
		$this->master_db->changeStatus('sizes',$db);
		if($status == 2)
		{
			$this->master_db->deleterecordss('sizes',array("id"=>$items));
		}
		$this->data['sizes'] = $this->load->view('getsize', $this->data ,TRUE);
		echo $this->data['sizes'];
    }

    public function size_edit(){
        $det=$this->data['detail'];

        $id=$this->input->get('id');

        if($id)
        {
            $this->data['type']='edit';

            $this->data['details']=$this->master_db->getcontent('sizes',$id);
            $this->load->view('editsize',$this->data);
        }

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $order=$this->input->post('order');

            $name = trim(preg_replace('!\s+!', ' ',$this->input->post('name')));
            $db=array(
                'name'=>$name,
                'order_no'=>$order,




            );
            $check = $this->master_db->dup_check('sizes',$name,$id);
            if($check == "0"){
                $res=$this->master_db->updateRecord('sizes',$db,$id);
            }
            if($res)
            {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');

            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');

            }
            redirect('master/size');

        }
    }



    //-----Products--------//
   /* public function products()
    {
    	$this->data['category'] = $this->master_db->getcontent('category','');
    	$this->data['material'] = $this->master_db->getcontent('materials','');
    	$this->data['color'] = $this->master_db->getcontent('colors','');
    	$this->data['size'] = $this->master_db->getcontent('sizes','');
		$db = array(
			'page'=>$this->input->post('page'),
			'rp'=>$this->input->post('rp'),
			'sortname'=>$this->input->post('sortname'),
			'sortorder'=>$this->input->post('sortorder'),
			'qtype'=>$this->input->post('qtype'),
			'query'=>$this->input->post('query'),
			'letter_pressed'=>$this->input->post('letter_pressed'),
			'category'=>$this->input->post('categ'),
			'subcateg'=>'',
			'name'=>$this->input->post('name'),
			'material'=>$this->input->post('material'),
			'color'=>$this->input->post('color'),
			'size'=>$this->input->post('sizes'),
			'vase'=>$this->input->post('vase'),
			'stat'=>$this->input->post('choosestatus'),
			'stat2'=>$this->input->post('choosestatus2'),
			'stockstatus'=>$this->input->post('stockstatus'),
        );
		$this->data['product_det'] = $this->master_db->getproduct($db);
		//echo $this->db->last_query();exit;
        $this->data['products'] = $this->load->view('getproducts', $this->data , TRUE);
        $this->load->view('products',$this->data);
    }*/
	
	   public function products()
    {
		$this->data['category'] = $this->master_db->getRecords('category',['status'=>0],'id,name');
    	$this->data['material'] = $this->master_db->getcontent('materials','');
    	$this->data['color'] = $this->master_db->getcontent('colors','');
    	$this->data['size'] = $this->master_db->getcontent('sizes','');
        $post = $this->input->get(NULL,true);
        $this->load->view('products',$this->data);
    }
    
   public function getproducts()
    {
        $det = $this->data['detail'];
        $post=$this->input->post(NULL,TRUE);
        $where =' WHERE p.status !=2';
        $category = trim(preg_replace('!\s+!', ' ',$post['categ']));
        $subcateg = trim(preg_replace('!\s+!', ' ',$post['subcateg']));
        $name = trim(preg_replace('!\s+!', ' ',$post['name']));
        $material = trim(preg_replace('!\s+!', ' ',$post['material']));
        $stat = trim(preg_replace('!\s+!', ' ',$post['choosestatus']));
        $stat2 = trim(preg_replace('!\s+!', ' ',$post['choosestatus2']));
        $db = array(
            "category"=>$category,
            "subcateg"=>$subcateg,
            "name"=>$name,
            "material"=>$material,
            "stat"=>$stat,
            "stat2"=>$stat2,
        );
        $categorys = $this->master_db->getcontent2('category','id',$db['category'],'');
        if(!empty($db['category']))
        {
            $where .=" and p.cat_id='".$db['category']."'";
        }
           if(!empty($db['material']))
        {
            $where .=" and p.material_id='".$db['material']."'";
        }
        if(!empty($db['name']))
        {
            $where .=" and p.name like '%".$db['name']."%' ";
        }
        if($db['category'] !='' && ($db['stat']=='0' || $db['stat']=='1'))
        {
            $where .=" and p.status='".$db['stat']."' ";
        }
        if($db['category'] !='' && ( $db['stat2']=='0' || $db['stat2']=='1'))
        {
            $where .=" and p.home_page='".$db['stat2']."' ";
        }
         if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (p.home_page like '%$val%') ";
                $where .= " or (p.name like '%$val%') ";
                $where .= " or (c.name like '%$val%')  ";
                $where .= " or (p.pcode like '%$val%')  ";
                $where .= " or (p.special like '%$val%')  ";
            }
            $order_by_arr[] = "p.name";
            $order_by_arr[] = "";
            $order_by_arr[] = "p.id";
            $order_by_def   = " order by p.id desc";
   
     $query = "select c.name as cname,p.name as title,p.home_page,p.bundle_product,p.special,p.exclusive,p.id,p.pcode,p.status,m.name as mname,co.name as coname,pi.image_path,ps.stock,s.name as sname from products p left join category c on p.cat_id = c.id left join colors co on p.color_id = co.id left join product_images pi on  p.id =pi.pid left join product_sizes ps on p.id =ps.pid left join sizes s on s.id = ps.size_id left join materials m on p.material_id = m.id ".$where." group by ps.pid";         
            $fetchdata = $this->master_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
        //$fetch_data = $this->master_db->getproduct($db);
    //echo $this->db->last_query();exit;
        $data = array();
        $i = $_POST["start"]+1;

        foreach($fetchdata as $b)
        {
            
                    if($b->home_page == 0){
                        $show = "<button class='btn btn-info btn-sm btn-grad' onclick='changestatus2(1,".$b->id.",1)'><i class=' fas fa-database'></i> Show In Homepage </button>";
                    } else {

                        $show="<button class='btn btn-primary btn-sm btn-grad' onclick='changestatus2(0,".$b->id.",1)'><i class=' fas fa-database'></i> Dont Show In Homepage</button>";

                    }
                    
                    if($b->special == 0){
                        $special = "<button class='btn btn-info btn-sm btn-grad' onclick='changestatus2(1,".$b->id.",2)'><i class='far fa-star'></i> Show In Special Product </button>";
                    } else {

                        $special="<button class='btn btn-primary btn-sm btn-grad' onclick='changestatus2(0,".$b->id.",2)'><i class='far fa-star'></i> Dont Show In Special Product </button>";

                    }
                


                    if($b->status=='0')
                    {
                        $status="<span class='btn btn-info  btn-sm btn-grad'>Active</span>";
                        $chng="<button class='btn btn-primary btn-sm btn-grad' onclick='changestatus(1,".$b->id.")'><i class='icon-remove'></i> Deactivate </button>";

                    }
                    else
                    {
                        $status="<span class='btn btn-primary btn-sm btn-grad'>In-Active</span>";
                        $chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$b->id.")'><i class='icon-ok'></i> Activate </button>";
                    }
                    
                    $delete="<button class='btn btn-primary btn-sm btn-grad' onclick='changestatus(2,".$b->id.")'><i class='icon-trash'></i> Delete </button>";
        
                    $image="<img src='".front_url()."".$b->image_path."' width='100px'>";   
                    // $size = "";
                    // $viewtable = $this->master_db->sqlExecute('select ');
                    
                    // if(is_array($viewtable)){
                    //  $sizearr = array();
                    //  foreach ($viewtable as $v){
                    //      if($v->size_id == '0'){
                    //          $sizearr[$v->sid] = 'No Size';
                    //      }
                    //      else{
                    //          $sizearr[$v->sid] = $v->sname;
                    //      }
                    //  }
                    //  $size = implode("<br>",$sizearr);
                    // }
                    // $size = "";
                    // $stock = $this->master_db->runsql('*','product_sizes','where pid='.$b->ppid.'');
                    // echo $this->db->last_query();exit;
                    $edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$b->id.")'><i class='icon-pencil icon-white'></i> Edit</button>";   
            $sub_array = array();
            $sub_array[] = $i++;
            $sub_array[] = $status;
            $sub_array[] = $chng.' '.$edit.' '.$show.' '.$special.' '.$delete;
            $sub_array[] = $b->stock;
            $sub_array[] = $b->pcode;
            $sub_array[] = $b->cname;
            $sub_array[] = $b->title;
            $sub_array[] = $image;
            $sub_array[] = $b->mname;
            $sub_array[] = $b->coname;
            $sub_array[] = $b->sname;
            $data[] = $sub_array;
        }
        $stdcnt =$this->master_db->run_manual_query_result($query);
        $total = count($stdcnt);
        $output = array(
            "draw"                    =>     intval($_POST["draw"]),
            "recordsTotal"          =>      $total,
            "recordsFiltered"     =>     $total,//$this->master_db->get_filtered_data("guards")
            "data"                    =>     $data
        );
        echo json_encode($output);
    }


    public function exportproduct(){

      require 'excelexport.php';
        $arr = $this->master_db->sqlExecute("select c.name as cname,c.page_url as cpage_url,p.id,s.name as sname,s.page_url as spage_url,p.name as title,p.pcode,p.youtube,p.overview,su.name as suname ,p.meta_description as mdesc,ps.mrp,ps.selling_price,ps.stock,ps.id as psid,s.id as sid,s.name as sname,ps.minimum_buy,s.page_url as spage_url,ps.sel_dollar,p.tax,p.how_to_use,p.youtube from products p left join product_sizes ps on p.id=ps.pid left join sizes s on ps.size_id=s.id left join category c on p.cat_id=c.id left join subcategory su on su.id =p.subcat_id where p.status !=2 order by p.id desc");


        $count = 1;
        $data = array(array("Sl No","Category Name","Subcategory","Size","Product Name","Product Code","MRP","Selling Price","Stock","Tax","Overview","Meta Description","How To Use","Youtube Link"));
        foreach($arr as $subsbr){

    
            $data[] = array(strval($count),$subsbr->cname,$subsbr->suname,$subsbr->sname,$subsbr->title,$subsbr->pcode,$subsbr->mrp,$subsbr->selling_price,$subsbr->stock,$subsbr->tax,$subsbr->overview,$subsbr->mdesc,$subsbr->how_to_use,$subsbr->youtube);
            $count++;

        }

        $xls = new Excel_XML('UTF-8', false, 'My Test Sheet');
        $xls->addArray($data);
        $xls->generateXML('products');




    }

    public function getsubcat(){
    	$cid = $this->input->post('cid');
    	if(!empty($cid)){
    	$category = $this->master_db->getcontent2('subcategory','category_id',$this->input->post('cid'),'0');
    	if(is_array($category)){
    		foreach ($category as $categ){
    			echo "<option value='".$categ->id."'>".$categ->name."</option>";
    		}
    	}
    		echo "";
    	}
    	else{
    		echo "";
    	}
    }
	
	 public function getsubsubcat(){
    	$subid = $this->input->post('subid');
    	if(!empty($subid)){
    	$category = $this->master_db->getcontent2('sub_subcategory','subcategory_id',$this->input->post('subid'),'0');
    	if(is_array($category)){
    		foreach ($category as $categ){
    			echo "<option value='".$categ->id."'>".$categ->name."</option>";
    		}
    	}
    		echo "";
    	}
    	else{
    		echo "";
    	}
    }
    
    public function products_add()
    {
    	$this->data['type']='add';
    	$this->data['category'] = $this->master_db->getRecords('category',['status'=>0],'id,name');
    	$this->data['material'] = $this->master_db->getcontent('materials','');
    	$this->data['color'] = $this->master_db->getcontent('colors','');
    	$this->data['size'] = $this->master_db->getRecords('sizes',['status'=>0],'id,name');
        $this->data['package'] = $this->master_db->sqlExecute('select pname,id from packages where status =0');
    	$this->load->view('productsadd',$this->data);
    }
      public function productsnews_add()
    {
        
    	   $this->data['type']='add';
        $this->data['category'] = $this->master_db->getRecords('category',['status'=>0],'id,name');
        $this->data['material'] = $this->master_db->getcontent('materials','');
        $this->data['color'] = $this->master_db->getcontent('colors','');
        $this->data['size'] = $this->master_db->getRecords('sizes',['status'=>0],'id,name');
         $this->data['package'] = $this->master_db->sqlExecute('select pname,id from packages where status =0');
    	$this->load->view('newproductadd',$this->data);
    }
    function products_save()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {    
            //echo "<pre>";print_r($_POST);print_r($_FILES);exit;
            $det=$this->data['detail'];
            $category = trim(preg_replace('!\s+!', ' ',$this->input->post('category')));
            $subcateg = trim(preg_replace('!\s+!', '',$this->input->post('subcateg')));
            
            $name = trim(preg_replace('!\s+!', ' ',$this->input->post('name')));
            $code = trim(preg_replace('!\s+!', ' ',$this->input->post('code')));
            //$code = trim(preg_replace('!\s+!', ' ',$this->input->post('code')));
            $material = trim(preg_replace('!\s+!', ' ',$this->input->post('material')));
            $mttag = trim(preg_replace('!\s+!', ' ',$this->input->post('mttag')));
            $mtdesc = trim(preg_replace('!\s+!', ' ',$this->input->post('mtdesc')));
            $color = trim(preg_replace('!\s+!', ' ',$this->input->post('color')));
            $tax = trim(preg_replace('!\s+!', ' ',$this->input->post('tax')));
            $protype = trim(preg_replace('!\s+!', ' ',$this->input->post('protype')));
            $overview = $this->input->post('overview');
            $howtouse = $this->input->post('howtouse');
            $testimonials = $this->input->post('testimonials');
            $differencenoted = $this->input->post('differencenoted');
            $vase = $this->input->post('vase');
            $youtube = $this->input->post('youtube');

            $youtubeid = "";
            if(!empty($youtube)) {
                $ex = explode("v=", $youtube);
                if(is_array($ex) && !empty($ex)) {
                    $youtubeid .= $ex[1];
                }
                
            }
           
            
            $c =  $this->master_db->getcontent1('category','id',$category);
            $type = $c[0]->page_url;
            $arry = array("jpg","png","jpeg","JPG","JPEG","PNG");
            $uploaddir = 'assets/products/';
            $uploadDBdir= "assets/products/";
            
            // $code = $this->master_db->generatecode($c[0]->short_form,$category);
            
            if(!empty($category) && !empty($name) ){
                $db = array(
                        'cat_id'=>$category,
                        'subcat_id'=>$subcateg,
                        'name'=>$name,
                        'page_url'=>$this->master_db->create_unique_slug($name,'products','page_url'),
                        'material_id'=>1,
                        'color_id'=>1,
                        'pcode'=>$code,
                        'vase'=>$vase,
                        'overview'=>$overview,
                        'testimonials'=>$testimonials,
                        'differencenoted'=>$differencenoted,
                        'user_id'=>$det[0]->id,
                        'created_date'=>date('Y-m-d H:i:s'),
                        'modified_date'=>date('Y-m-d H:i:s'),
                         'status'=>'0',
                        'meta_keywords'=>$mttag,
                        'meta_description'=>$mtdesc,
                        'tax'=>$tax,
                        'how_to_use'=>$howtouse,
                        'youtube'=>$youtube,
                        'youtubelink'=>$youtubeid,
                );
    
                $res=$this->master_db->insertRecord('products',$db);
                $size = $this->input->post('size');
                $mrp = $this->input->post('mrp');
                $sell_price = $this->input->post('sell_price');
                $sel_dollar = $this->input->post('sel_dollar');
                // $b2b_sel_dollar = $this->input->post('b2b_sel_dollar');
                // $b2b_selling_price = $this->input->post('b2b_selling_price');
                $stock = $this->input->post('stock');
                $minimum_buy = $this->input->post('minimum_buy');
                
                
                if(is_array($size) && is_array($mrp) && is_array($sell_price) && is_array($sel_dollar) && is_array($stock)){
    
                    foreach ($size as $key=>$s){
                        
                        if(isset($s) && isset($mrp[$key]) && isset($sell_price[$key])){
                            $db = array(
                                    'pid'=>$res,
                                    'size_id'=>$s,
                                    'mrp'=>$mrp[$key],
                                    'selling_price'=>$sell_price[$key],
                                    'sel_dollar'=>$sel_dollar[$key],
                                    'stock'=>$stock[$key],
                                    'minimum_buy'=>$minimum_buy[$key],
                                    'status'=>0,
                                    'user_id'=>$det[0]->id,
                                    'created_date'=>date('Y-m-d H:i:s'),
                                    'modified_date'=>date('Y-m-d H:i:s'),
                                );

                            if(!empty($_FILES['proimages']['name'][$key])) {
                                 $arrayImage2=$_FILES['proimages']['name'][$key];
                                $arrayTemp1=$_FILES['proimages']['tmp_name'][$key];
                                $dd1 = explode(".", $arrayImage2);
                                $ext = end($dd1);
                                if(in_array($ext,$arry)){
                                    $image_name='MIRACLE'.time().'.'.$ext;
                                    $uploadfile = $uploaddir.$image_name;
                                    $uploadfileTable1 = "assets/products/".$image_name;
                                    $img1up = move_uploaded_file($arrayTemp1,$uploadfile);
                                    $db['image'] = $uploadfileTable1;
                                }
                            }
                             
                            $this->master_db->insertRecord('product_sizes',$db);
                        }
                    }
                }
                
                $orderno = $this->input->post('orderno');
                $details = $this->master_db->getcontent('products',$res);
                foreach ($orderno as $i=>$value)
                {

                    $dbimg['pid'] = $res;
                    $dbimg['order_no'] = $value;
                            $arrayImage1=$_FILES['galthumb']['name'][$i];
                            $arrayTemp1=$_FILES['galthumb']['tmp_name'][$i];
                            $dd1 = explode(".", $arrayImage1);
                            $ext = end($dd1);
                            
                            if(in_array($ext,$arry)){
                                $image_name=$arrayImage1;
                                $uploadfile = $uploaddir.$image_name;
                                $uploadfileTable1 = $uploadDBdir.$image_name;
                                $img1up = move_uploaded_file($arrayTemp1,$uploadfile);
                                //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                                $dbimg['thumb'] =$uploadfileTable1;
                                
                            }
                             $arrayImage2=$_FILES['galsmall']['name'][$i];
                            $arrayTemp2=$_FILES['galsmall']['tmp_name'][$i];
                            $dd2 = explode(".", $arrayImage2);
                            $ext2 = end($dd2);
                            
                            if(in_array($ext2,$arry)){
                                $image_name=$arrayImage2;
                                $uploadfile = $uploaddir.$image_name;
                                $uploadfileTable1 = $uploadDBdir.$image_name;
                                $img1up = move_uploaded_file($arrayTemp2,$uploadfile);
                                //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                                
                                $dbimg['image_path'] =$uploadfileTable1;
                            }
                            
                            
                            $arrayImage3=$_FILES['galmedium']['name'][$i];
                            $arrayTemp3=$_FILES['galmedium']['tmp_name'][$i];
                            $dd3=explode(".", $arrayImage3);
                            $ext3 = end($dd3);
                            
                            if(in_array($ext3,$arry)){
                                $image_name=$arrayImage3;
                                $uploadfile = $uploaddir.$image_name;
                                $uploadfileTable1 = $uploadDBdir.$image_name;
                                $img1up = move_uploaded_file($arrayTemp3,$uploadfile);
                                //$this->home_db->resizeImagef($uploadfileTable1, 400, 400);
                                
                                $dbimg['image_medium'] =$uploadfileTable1;
                                
                            }
                            
                            
                            $arrayImage4=$_FILES['gallarge']['name'][$i];
                            $arrayTemp4=$_FILES['gallarge']['tmp_name'][$i];
                            $dd4 = explode(".", $arrayImage4);
                            $ext4 = end($dd4);
                            
                            if(in_array($ext4,$arry)){
                                $image_name=$arrayImage4;
                                $uploadfile = $uploaddir.$image_name;
                                $uploadfileTable1 = $uploadDBdir.$image_name;
                                $img1up = move_uploaded_file($arrayTemp4,$uploadfile);
                                $dbimg['image_large'] = $uploadfileTable1;
                            }
                    $dbimg['user_id'] = $det[0]->id;
                    $dbimg['created_date'] =date('Y-m-d H:i:s');
                       
                    $imgid = $this->master_db->insertRecord('product_images',$dbimg);
                
                            
                            
                            
                           
                   
                    
                    
                }
                
                $vasename = $this->input->post('vasename');
                
                if($vase == "1"){
                    foreach ($vasename as $key=>$s)
                    {
                        
                        if(!empty($s)){
                            $db = array(
                                    'pid'=>$res,
                                    'vase_id'=>$s,
                                    'status'=>0,
                                    'user_id'=>$det[0]->id,
                                    'created_date'=>date('Y-m-d H:i:s'),
                                    
                                );
                            //$this->home_db->resizeImagef($uploadfileTable1, 666, 313);
                            $this->master_db->insertRecord('product_vase',$db);
                        }
                    }
                }
                
                $spec_name = $this->input->post('spec_name');
                $spec_val = $this->input->post('spec_val');
                $qnts = $this->input->post('qnts');
                 
                if(is_array($spec_name) && is_array($spec_val)){
                    foreach ($spec_name as $key=>$s){
                        if(!empty($s) && !empty($spec_val[$key])){
                            $db = array(
                                    'pid'=>$res,
                                    'spec_name'=>$s,
                                    'spec_val'=>$spec_val[$key], 
                                    'quantity'=>$qnts[$key] 
                            );
                            $this->master_db->insertRecord('product_spec',$db);
                        }
                    }
                }
    
            if($res)
            {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Product Details Added Successfully</div>');
                //redirect($redirect);
            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Added Successfully</div>');
            }
        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Data is Missing!!!</div>');
        }
    
        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Data is Missing!!!</div>');
        }
    
        redirect('master/products');
    
    }

	 

      public function products_status()
    {
        $items = $this->input->post('items');
        $status = $this->input->post('status');
        //echo "<pre>";print_r($_POST);exit;
        $db=array(
          'status'=>$status,
          'modified_date'=>date('Y-m-d H:i:s'),
        );
$res=$this->master_db->updateRecord('products',$db,['id'=>$items]);     
if($status == 2)
        {
           $del =  $this->master_db->deleterecordss('products',array("id"=>$items));
          
        }   

  


		
    }

    public function productstatusview() {
        //echo "<pre>";print_r($_POST);
                $items = $this->input->post('items');
        $status = $this->input->post('status');
        //echo "<pre>";print_r($_POST);exit;
        $db=array(
          'status'=>$status,
          'modified_date'=>date('Y-m-d H:i:s'),
        );
    $res=$this->master_db->updateRecord('products',$db,$items);   
if($res)    {
    echo "Updated";
}else {
    echo "Not updated";
}

    }

    public function products_homepageshow()
    {
		$items = $this->input->post('items');
		$status = $this->input->post('status');
		$type = $this->input->post('type');
        //echo "<pre>";print_r()
		$db=array(
			'modified_date'=>date('Y-m-d H:i:s'),
		);
		
		if($type == 1)
		{
			$db['home_page']=$status;
		}
		if($type == 2)
		{
			$db['special']=$status;
		}
		
		if($type == 3)
		{
			$db['exclusive']=$status;
		}

		$res=$this->master_db->updateRecord('products',$db,['id'=>$items]);
		//echo $this->db->last_query();exit;
		// $this->data['product_det'] = $this->load->view('getproducts', $this->data ,TRUE);
		// echo $this->data['product_det'];
    }

    public function productslateststatus() {
            $items = $this->input->post('items');
        $status = $this->input->post('status');
       
        //echo "<pre>";print_r()
        $db=array(
            'modified_date'=>date('Y-m-d H:i:s'),
        );
        
      
            $db['home_page']=$status;
  
     

        $res=$this->master_db->updateRecord('productpackage',$db,$items);
    }
    
    public function products_edit()
    {
    	$det=$this->data['detail'];
        $id=$this->input->get('id');
         
        if(!empty($id) && $_SERVER['REQUEST_METHOD'] != 'POST')
        {
            $details = $this->master_db->getcontent('products',$id);
           // echo "<pre>";print_r($details);exit;
            if(is_array($details)){
                $this->data['type']='edit';
                $this->data['category'] = $this->master_db->getRecords('category',['status'=>0],"id,name");
                $this->data['material'] = $this->master_db->getcontent('materials','');
                $this->data['color'] = $this->master_db->getcontent('colors','');
                $this->data['size'] = $this->master_db->getcontent('sizes','');
                $this->data['details']=$details;
                $this->load->view('productsadd',$this->data);
            }
            else{
                redirect('master/products');
            }
        }
        else if($_SERVER['REQUEST_METHOD']=='POST')
        {
            
            //echo "<pre>";print_r($_POST);print_r($_FILES);exit;
            $id=$this->input->post('aid');
            $getSpecification = $this->master_db->getRecords('product_spec',['pid'=>$id],'*');
           // echo $this->db->last_query();exit;
            $category = trim(preg_replace('!\s+!', ' ',$this->input->post('category')));
            $subcateg = trim(preg_replace('!\s+!', '',$this->input->post('subcateg')));
            $name = trim(preg_replace('!\s+!', ' ',$this->input->post('name')));
            $code = trim(preg_replace('!\s+!', ' ',$this->input->post('code')));
            $material = trim(preg_replace('!\s+!', ' ',$this->input->post('material')));
            $color = trim(preg_replace('!\s+!', ' ',$this->input->post('color')));
           $overview = trim($this->input->post('overview'));
            $howtouse = trim($this->input->post('howtouse'));
            $testimonials = trim($this->input->post('testimonials'));
            $differencenoted = trim($this->input->post('differencenoted'));
            $vase = $this->input->post('vase');
            $protype = trim(preg_replace('!\s+!', ' ',$this->input->post('protype')));
            $mttag = trim(preg_replace('!\s+!', ' ',$this->input->post('mttag')));
            $mtdesc = trim(preg_replace('!\s+!', ' ',$this->input->post('mtdesc')));
            $tax = trim(preg_replace('!\s+!', ' ',$this->input->post('tax')));
               $youtube = $this->input->post('youtube');
               $youtubeid = "";
            if(!empty($youtube)) {
                $ex = explode("v=", $youtube);
                $youtubeid .= $ex[1];
            }
           
            $details = $this->master_db->getcontent('products',$id);
             $howtouse = $this->input->post('howtouse');
            
            $c =  $this->master_db->getcontent1('category','id',$category);
            $type = $c[0]->page_url;
            $arry = array("gif","jpg","png","ico","jpeg");
            $uploaddir = 'assets/products/';
            $uploadDBdir= "assets/products/";
            
            if(!empty($category) && !empty($name) ){            
                             
                
            $db = array(
                'cat_id'=>$category,
                'subcat_id'=>$subcateg,
                'name'=>$name,
                'material_id'=>1,
                'color_id'=>1,
                'pcode'=>$code,
                'vase'=>$vase,
                'overview'=>$overview,
                'testimonials'=>$testimonials,
                'differencenoted'=>$differencenoted,
                'user_id'=>$det[0]->id,
                'modified_date'=>date('Y-m-d H:i:s'),
                'meta_keywords'=>$mttag,
                'meta_description'=>$mtdesc,
                'tax'=>$tax,
                'how_to_use'=>$howtouse,
                'youtube'=>$youtube,
                'youtubelink'=>$youtubeid,
                
                
            );
    
            $res=$this->master_db->updateRecord('products',$db,['id'=>$id]);
                
            $size = $this->input->post('size');
            $hsize = $this->input->post('hsize');
            $mrp = $this->input->post('mrp');
            $sell_price = $this->input->post('sell_price');
            $sel_dollar = $this->input->post('sel_dollar');
            // $b2b_selling_price = $this->input->post('b2b_selling_price');
            // $b2b_sel_dollar = $this->input->post('b2b_sel_dollar');
            $stock = $this->input->post('stock');
            $minimum_buy = $this->input->post('minimum_buy');
            
            if(is_array($size) && is_array($mrp) && is_array($sell_price) && is_array($sel_dollar) && is_array($stock)){
                $db = array(
                        'status'=>1,
                );
                $this->master_db->updateRecord1('product_sizes',$db,'pid',$id);
                 
                
                foreach ($size as $key=>$s){
            
                    if(isset($s) && isset($mrp[$key]) && isset($sell_price[$key]) && isset($sel_dollar[$key]) && isset($stock[$key])){
                        if($hsize[$key] == "0"){
                            $db = array(
                                    'pid'=>$id,
                                    'size_id'=>$s,
                                    'mrp'=>$mrp[$key],
                                    'selling_price'=>$sell_price[$key],
                                    'sel_dollar'=>$sel_dollar[$key],
                                
                                    'stock'=>$stock[$key],
                                    'minimum_buy'=>$minimum_buy[$key],
                                    'status'=>0,
                                    'user_id'=>$det[0]->id,
                                    'created_date'=>date('Y-m-d H:i:s'),
                                    'modified_date'=>date('Y-m-d H:i:s'),
                                    
                                    
                            );

                              if(!empty($_FILES['proimages']['name'][$key])) {
                                 $arrayImage2=$_FILES['proimages']['name'][$key];
                                $arrayTemp1=$_FILES['proimages']['tmp_name'][$key];
                                $dd1 = explode(".", $arrayImage2);
                                $ext = end($dd1);
                                if(in_array($ext,$arry)){
                                    $image_name=$arrayImage2;
                                    $uploadfile = $uploaddir.$image_name;
                                    $uploadfileTable1 = "assets/products/".$image_name;
                                    $img1up = move_uploaded_file($arrayTemp1,$uploadfile);
                                    $db['image'] = $uploadfileTable1;
                                }
                            }
            
                            $this->master_db->insertRecord('product_sizes',$db);
                        }
                        else{
                            $db = array(
                                    'size_id'=>$s,
                                    'mrp'=>$mrp[$key],
                                    'selling_price'=>$sell_price[$key],
                                    'sel_dollar'=>$sel_dollar[$key],
                                   
                                    'stock'=>$stock[$key],
                                    'minimum_buy'=>$minimum_buy[$key],
                                    'status'=>0,
                                    'user_id'=>$det[0]->id,
                                    'modified_date'=>date('Y-m-d H:i:s'),
                                    
                                    
                            );

                            if(!empty($_FILES['proimages']['name'][$key])) {
                                 $arrayImage2=$_FILES['proimages']['name'][$key];
                                $arrayTemp1=$_FILES['proimages']['tmp_name'][$key];
                                $dd1 = explode(".", $arrayImage2);
                                $ext = end($dd1);
                                if(in_array($ext,$arry)){
                                    $image_name='gog'.$key.time().'.'.$ext;
                                    $uploadfile = $uploaddir.$image_name;
                                    $uploadfileTable1 = "assets/products/".$image_name;
                                    $img1up = move_uploaded_file($arrayTemp1,$uploadfile);
                                    $db['image'] = $uploadfileTable1;
                                }
                            }
                                
                            $this->master_db->updateRecord1('product_sizes',$db,'id',$hsize[$key]);
                        }
                    }
                }
            
                $this->master_db->deleterecord('product_sizes','pid',$id,'1');
            }
            
            
            $orderno = $this->input->post('orderno');
            $gimgid = $this->input->post('gimgid');

            if(is_array($orderno)){
                // $db = array(
                //         'status'=>1,
                // );
                // $this->master_db->updateRecord1('product_images',$db,'pid',$id);
                foreach($orderno as $i=>$value)
                {
                    $imgid = $gimgid[$i];
                    if($gimgid[$i] != 0){
                        $db = array(
                                'order_no'=>$value,
                                'status'=>0,
                                'user_id'=>$det[0]->id,
                                'modified_date'=>date('Y-m-d H:i:s'),
                                
                        );
                        $this->master_db->updateRecord('product_images',$db,['id'=>$gimgid[$i]]);                       
                    }
                    else{
                        $db = array(
                                'pid'=>$id,
                                'order_no'=>$value,
                                'status'=>0,
                                'user_id'=>$det[0]->id,
                                'created_date'=>date('Y-m-d H:i:s'),
                                
                        );
                        $imgid = $this->master_db->insertRecord('product_images',$db);
                    }
                    
                    $arrayImage1=$_FILES['galthumb']['name'][$i];
                    $arrayTemp1=$_FILES['galthumb']['tmp_name'][$i];
                    $ex1 = explode(".", $arrayImage1);
                    $ext1 = end($ex1);
                    
                    if(in_array($ext1,$arry)){
                        $image_name1=$arrayImage1;
                        $uploadfile = $uploaddir.$image_name1;
                        $uploadfileTable1 = $uploadDBdir.$image_name1;
                        $img1up = move_uploaded_file($arrayTemp1,$uploadfile);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        $img = $this->master_db->getcontent('product_images',$imgid);
                        $db = array(
                                'thumb'=>$uploadfileTable1
                        );
                        $this->master_db->updateRecord('product_images',$db,['id'=>$imgid]);
                    } 
                    
                    
                    $arrayImage2=$_FILES['galsmall']['name'][$i];
                    $arrayTemp2=$_FILES['galsmall']['tmp_name'][$i];
                    $ex2 = explode(".", $arrayImage2);
                    $ext2 = end($ex2);
                    
                    if(in_array($ext2,$arry)){
                        $image_name2=$arrayImage2;
                        $uploadfile = $uploaddir.$image_name2;
                        $uploadfileTable1 = $uploadDBdir.$image_name2;
                        $img1up = move_uploaded_file($arrayTemp2,$uploadfile);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        $img = $this->master_db->getcontent('product_images',$imgid);
                        $db = array(
                                'image_path'=>$uploadfileTable1
                        );
                        $this->master_db->updateRecord('product_images',$db,['id'=>$imgid]);
                    }
                    
                    
                    $arrayImage3=$_FILES['galmedium']['name'][$i];
                    $arrayTemp3=$_FILES['galmedium']['tmp_name'][$i];
                    $ex3 = explode(".", $arrayImage3);
                    $ext3 = end($ex3);
                    
                    if(in_array($ext3,$arry)){
                        $image_name3=$arrayImage3;
                        $uploadfile = $uploaddir.$image_name3;
                        $uploadfileTable1 = $uploadDBdir.$image_name3;
                        $img1up = move_uploaded_file($arrayTemp3,$uploadfile);
                        //$this->home_db->resizeImagef($uploadfileTable1, 400, 400);
                        $img = $this->master_db->getcontent('product_images',$imgid);
                        $db = array(
                                'image_medium'=>$uploadfileTable1
                        );
                        $this->master_db->updateRecord('product_images',$db,['id'=>$imgid]);
                    }
                    
                    
                    $arrayImage4=$_FILES['gallarge']['name'][$i];
                    $arrayTemp4=$_FILES['gallarge']['tmp_name'][$i];
                    $ex4 = explode(".", $arrayImage4);
                    $ext4 = end($ex4);
                    
                    if(in_array($ext4,$arry)){
                        $image_name4=$arrayImage4;
                        $uploadfile = $uploaddir.$image_name4;
                        $uploadfileTable1 = $uploadDBdir.$image_name4;
                        $img1up = move_uploaded_file($arrayTemp4,$uploadfile);
                        //$this->home_db->resizeImagef($uploadfileTable1, 800, 800);
                        $img = $this->master_db->getcontent('product_images',$imgid);
                        $db = array(
                                'image_large'=>$uploadfileTable1
                        );
                        $this->master_db->updateRecord('product_images',$db,['id'=>$imgid]);
                    }
                
                                                
            }
            }
                
                // $vasename = $this->input->post('vasename');
                // if($vase == "1"){
                //     foreach ($vasename as $key=>$s)
                //     {
                
                //         if(!empty($s)){
                //             $db = array(
                //                     'pid'=>$id,
                //                     'vase_id'=>$s,
                //                     'status'=>0,
                //                     'user_id'=>$det[0]->id,
                //                     'created_date'=>date('Y-m-d H:i:s'),
                                    
                //             );
                //             $this->master_db->insertRecord('product_vase',$db);
                //         }
                //     }
                // }
                
                //echo $this->db->last_query();exit;
                $spec_name = $this->input->post('spec_name');
                $spec_val = $this->input->post('spec_val');
                $qnts = $this->input->post('qnts');
                $spec_id = $this->input->post('spec_id');
                $getSpechd = [];
                if(count($getSpecification) >0) {
                	foreach ($getSpecification as $key => $value) {
                		$getSpechd[] = $value->id;
                	}
                }
                 
                if(is_array($spec_id)){
                        
                    foreach ($spec_id as $key=>$s){
                       	if(in_array($s, $getSpechd)) {
                       		
                       		$db =array(
                       			'spec_name' =>$spec_name[$key],
                       			'spec_val' =>$spec_val[$key],
                       			'quantity' => $qnts[$key],
                       		);
                       		$this->master_db->updateRecord1('product_spec',$db,'id',$s);
                       	}else {
                       		$db =array(
                       			'pid' => $id,
                       			'spec_name' =>$spec_name[$key],
                       			'spec_val' =>$spec_val[$key],
                       			'quantity' => $qnts[$key],
                       		);
                       		
                       		$this->master_db->insertRecord('product_spec',$db);
                       	}
                    }
                }
            
          
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');
           
           
        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Data is Missing!!!</div>');
        }
           redirect('master/products');
        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
            redirect('master/products');
        }
    	 
    }
    
    
    public function resizeimg(){//wss.png
    	/* $c =  $this->master_db->getcontent1('product_images','','');
    	foreach ($c as $ca){
    		$this->home_db->overlay($ca->image_path, 'wss.png');
    	} */
    	/* $cat = $this->input->get('id');
    	$c = $this->home_db->getimg($cat);
    	foreach ($c as $ca){
    		$this->home_db->overlay($ca->image_large, 'water.png');
    	} */
    } 
    
    
    public function createcode(){
    	$c =  $this->master_db->getcontent1('category','','');
    	foreach ($c as $ca){
    		$this->master_db->updatecode($ca->short_form,$ca->id);
    		
    	}
    }
	
		
public function pincodes() {
            $this->load->view('pincode_list', $this->data);

}
public function getPincodeList() {
    $where = "where p.status !=-1";

      
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (p.pincode like '%$val%') ";
                $where .= " or (p.charges like '%$val%') ";
                $where .= " or (c.name like '%$val%') ";
				$where .= " or (s.name like '%$val%') ";
               
            }
            $order_by_arr[] = "p.pincode";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by p.id desc";
            $query = "select p.pincode,p.id,p.charges,p.status,c.name,s.name as state from pincodes p left join cities c on c.id=p.city_id left join states s on s.id=c.state_id $where";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {

                   $cls = "";$status="";

                if ($r->status == '0') 
                {
                    $status = "<button type='button' class='text-warning'><i class='fa fa-remove'></i> Active</button>";
                    $chng = "<button class='btn btn-info btn-sm' onclick='changestatus(1," . $r->id . ")'  $cls> Active</button>";
                }
                 else
                  {
                   $status = "<button type='button' class='text-success'><i class='fa fa-check'></i> In-Active</button>";
                    $chng = "<button class='btn btn-primary btn-sm pl-3 pr-3' onclick='changestatus(0," . $r->id . ")'  $cls> In-Active</button>";
                }
                $action =' <a href="'.base_url()."master/pincode_edit?id=".$r->id."".'" class="btn btn-circle btn-info" title="Edit" ><i class="mdi mdi-border-color"></i></a>
                        <button type="button" class="btn btn-circle btn-primary" title="Delete" onclick="changestatus(2,'.$r->id.')" ><i class=" fas fa-trash" ></i></button>';
                $sub_array = array();
             $sub_array[] = $i++;
             $sub_array[] = $r->pincode;
             $sub_array[] = $r->charges;
             $sub_array[] = $r->name;
             $sub_array[] = $r->state;
             $sub_array[] = $chng;
             $sub_array[] =  $action;
            
            $data[] = $sub_array;
            }

            $res    = $this->home_db->run_manual_query_result($query);
        $total  = count($res);
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
             "recordsTotal"          => $total,  
                "recordsFiltered"     => $total,  
            "data"              =>  $data
        );
        echo json_encode($output);
}
public function pincode_status() {
        $items = $this->input->post('items');
            $status = $this->input->post('status');
            //echo "<pre>";print_r($_POST);exit;
            $db=array(
            'items'=>$items,
            'status'=>$status
            );
            $this->master_db->changeStatus('pincodes',$db);
            if($status == 2)
            {
                $this->master_db->deleterecordss('pincodes',['id'=>$items]);
            }
            echo 1;
}
    public function pincode_add() {
        $this->data['type']='add';
		$this->data['states']= $this->master_db->getRecords('states',['status'=>0],"id,name");
        $this->data['city']= $this->master_db->getRecords('cities',['status'=>0],"id,name");
        $this->load->view('pincode_add',$this->data);
    }
    public function pincode_save() {
        $pincode = trim(preg_replace('!\s+!', ' ',$this->input->post('pincode')));
            $amount = trim(preg_replace('!\s+!', '',$this->input->post('amount')));
            $city = trim(preg_replace('!\s+!', '',$this->input->post('city')));
            $state = trim(preg_replace('!\s+!', '',$this->input->post('state')));
            $getrecords = $this->master_db->getRecords('pincodes',['pincode'=>$pincode]);
            //echo $this->db->last_query();exit;
            if(count($getrecords) >0) {
              $this->session->set_flashdata('success','<div class="alert alert-danger">Pincode already exist </div>');
                     redirect('master/pincodes');
            }else {
                      $db = array(
                    'pincode'=>$pincode,
                    'charges'=>$amount,
                    'pincode1'=>$pincode,
                    'city_id'=>$city,
                    'state'=>$state,
                    'status'=>0
                    );
                $insert = $this->master_db->insertRecord('pincodes',$db);
                if($insert) {
                    $this->session->set_flashdata('success','<div class="alert alert-success">Pincode inserted successfully</div>');
                    redirect('master/pincodes');
                }else {
                     $this->session->set_flashdata('success','<div class="alert alert-danger">Error in interting data</div>');
                     redirect('master/pincodes');
                }
               
            }
    }
    public function pincode_edit() {
        $det=$this->data['detail'];

        $id=$this->input->get('id');

        if($id)
        {
            $this->data['type']='edit';
			$this->data['states']= $this->master_db->getRecords('states',['status'=>0],"id,name");
            $this->data['city']= $this->master_db->getRecords('cities',['status'=>0],"id,name");
            $this->data['details']=$this->master_db->getcontent('pincodes',$id);
            $this->load->view('pincode_add',$this->data);
        }

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $order=$this->input->post('order');

            $picode = trim(preg_replace('!\s+!', ' ',$this->input->post('pincode')));
            $amount = trim(preg_replace('!\s+!', ' ',$this->input->post('amount')));
            $city = trim(preg_replace('!\s+!', ' ',$this->input->post('city')));
            $state = trim(preg_replace('!\s+!', ' ',$this->input->post('state')));
            $db=array(
                'pincode'=>$picode,
                'charges'=>$amount,
                'pincode1'=>$picode,
                'state'=>$state,
                'city_id'=>$city
            );
            $res=$this->master_db->updateRecord('pincodes',$db,['id'=>$id]);
            if($res)
            {
                $this->session->set_flashdata('success','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');
                redirect('master/pincodes');

            }
            else
            {
                $this->session->set_flashdata('success','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
                redirect('master/pincodes');

            }
            
        }
    }

    public function city() {
            $this->load->view('city_list', $this->data);

}
public function cityList() {
    $where = "where c.status !=2";

      
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (c.name like '%$val%') ";
                $where .= " or (s.name like '%$val%') ";
               }
            $order_by_arr[] = "c.name";
            $order_by_arr[] = "";
            $order_by_arr[] = "c.id";
            $order_by_def   = " order by c.name asc";
            $query = "select c.id,c.name as cname,s.name,c.status from cities c left join states s on s.id=c.state_id  $where";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {

                   $cls = "";$status="";

                if ($r->status == '0') 
                {
                    $status = "<button type='button' class='text-warning'><i class='fa fa-remove'></i> Active</button>";
                    $chng = "<button class='btn btn-info btn-sm' onclick='changestatus(1," . $r->id . ")'  $cls> Active</button>";
                }
                 else
                  {
                   $status = "<button type='button' class='text-success'><i class='fa fa-check'></i> In-Active</button>";
                    $chng = "<button class='btn btn-primary btn-sm pl-3 pr-3' onclick='changestatus(0," . $r->id . ")'  $cls> In-Active</button>";
                }
                $action =' <a href="'.base_url()."master/city_edit?id=".base64_encode($r->id)."".'" class="btn btn-circle btn-info" title="Edit" ><i class="mdi mdi-border-color"></i></a>
                        <button type="button" class="btn btn-circle btn-primary" title="Delete" onclick="changestatus(2,'.$r->id.')" ><i class=" fas fa-trash" ></i></button>';
                $sub_array = array();
             $sub_array[] = $i++;
             $sub_array[] = $r->cname;
             $sub_array[] = $r->name;
            
             $sub_array[] = $chng;
             $sub_array[] =  $action;
            
            $data[] = $sub_array;
            }

            $res    = $this->home_db->run_manual_query_result($query);
        $total  = count($res);
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
             "recordsTotal"          => $total,  
                "recordsFiltered"     => $total,  
            "data"              =>  $data
        );
        echo json_encode($output);
}
public function city_status() {
        $items = $this->input->post('items');
            $status = $this->input->post('status');
            //echo "<pre>";print_r($_POST);exit;
            $db=array(
            'items'=>$items,
            'status'=>$status
            );
            $this->master_db->changeStatus('cities',$db);
            if($status == 2)
            {
                $this->master_db->deleterecordss('cities',['id'=>$items]);
            }
            echo 1;
}
    public function city_add() {
        $this->data['type']='add';
        $this->data['city']= $this->master_db->getRecords('states',['status'=>0],"id,name");
        $this->load->view('city_add',$this->data);
    }
    public function city_save() {
        $cname = trim(preg_replace('!\s+!', ' ',$this->input->post('cname')));
            $state = trim(preg_replace('!\s+!', '',$this->input->post('state')));
            //$city = trim(preg_replace('!\s+!', '',$this->input->post('city')));
            $getrecords = $this->master_db->getRecords('cities',['name'=>$cname]);
            //echo $this->db->last_query();exit;
            if(count($getrecords) >0) {
              $this->session->set_flashdata('success','<div class="alert alert-danger">Pincode already exist </div>');
                     redirect('master/pincodes');
            }else {
                      $db = array(
                    'state_id'=>$state,
                    'name'=>$cname,
                    'favourite'=>0,
                    'status'=>0
                    );
                $insert = $this->master_db->insertRecord('cities',$db);
                if($insert) {
                    $this->session->set_flashdata('success','<div class="alert alert-success">City inserted successfully</div>');
                    redirect('master/city');
                }else {
                     $this->session->set_flashdata('success','<div class="alert alert-danger">Error in interting data</div>');
                     redirect('master/city');
                }
               
            }
    }
    public function city_edit() {
        $det=$this->data['detail'];

        $id=base64_decode($this->input->get('id'));

        if($id)
        {
            $this->data['type']='edit';
            $this->data['city']= $this->master_db->getRecords('states',['status'=>0],"id,name");
            $this->data['details']=$this->master_db->getcontent('cities',$id);
            $this->load->view('city_add',$this->data);
        }

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $order=$this->input->post('order');

            $cname = trim(preg_replace('!\s+!', ' ',$this->input->post('cname')));
            $state = trim(preg_replace('!\s+!', ' ',$this->input->post('state')));
            $db=array(
               'state_id'=>$state,
                'name'=>$cname
            );
            $res=$this->master_db->updateRecord('cities',$db,['id'=>$id]);
            if($res)
            {
                $this->session->set_flashdata('success','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');
                redirect('master/city');

            }
            else
            {
                $this->session->set_flashdata('success','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
                redirect('master/city');

            }
            
        }
    }

    /* States add */
	
		
	public function get_state(){
    	$id = $this->input->post('id');
    	if(!empty($id)){
    	$cities = $this->master_db->getcontent2('cities','state_id',$this->input->post('id'),'0');
    	if(is_array($cities)){
    		foreach ($cities as $categ){
    			echo "<option value='".$categ->id."'>".$categ->name."</option>";
    		}
    	}
    		echo "";
    	}
    	else{
    		echo "";
    	}
    }
	
	
		public function upload_states()
	{
		$det = $this->data['detail'];
		
	    $this->load->view('state_upload_view',$this->data);
	}
	
        public function states() {
            $this->load->view('state_list', $this->data);

		}
		
		function ImportStates(){
		
		$det = $this->data['detail'];
		
	    //$this->load->library('excel');
	   
		
	    $xlsFile = $_FILES['excel_data']['tmp_name'];
		 print_r($xlsFile);exit;
	    if($_SERVER['REQUEST_METHOD']=='POST' )//&& !empty($xlsFile)
	    {
	        
	        $xlsFile = $_FILES['excel_data']['tmp_name'];
	        
	        $objPHPExcel = PHPExcel_IOFactory::load($xlsFile);
	       
	        $objWorksheet = $objPHPExcel->getActiveSheet();
	        $worksheet = $objWorksheet;
	        
	        $highestRow         = $worksheet->getHighestRow(); // e.g. 10
	        $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
	        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
	        $nrColumns = ord($highestColumn) - 64;
	        
	        $leftRow = $original = $tracedid = $newCourse = array();
	        $uniqueid = rand();
	        $u = 0;
	        for ($row = 2; $row <= $highestRow; ++ $row) {
	            $original[] = $row;
	            $msg = $recent_id = "";
	            $slno =  trim(preg_replace('!\s+!', '',html_escape($worksheet->getCellByColumnAndRow(0, $row)->getValue())));
	            $state_name =  trim(preg_replace('!\s+!', ' ',html_escape($worksheet->getCellByColumnAndRow(1, $row)->getValue())));
				
	            $check = $this->master_db->getRecords('states',array('status != '=> -1,'name'=>$state_name),'id, name','name asc');
				
				if(count($check) !=0)
				{
					 $msg = "State name already exists";
				}
				 
	            if($state_name !='')
				{					
	               if($msg == ""){
	                    $db=array(
	                        
							'name'=>$state_name,
							'status'=>0	                       
	                    );
						
	                    $recent_id = $this->master_db->insertRecord('states',$db);
						
						//print_r($recent_id);exit;
	                }
	            }
	            else{
	                $msg = "Few fields are empty/invalid";
	            }
	            $db = array(
					'randid'=>$uniqueid,
					'slno'=>$slno,
					'remarks'=>$msg,
					'state_name'=>$state_name,
					'created_date'=>date('Y-m-d H:i:s'),
    	        );
	            $res=$this->master_db->insertRecord('state_log',$db);
	              
	        }
	      //  $msg = "";
	        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">&times;</button><a href="'.base_url().'master/download_statedata?id='.$uniqueid.'">Click Here</a> to download the file to check the result.'.$msg.'</div>');
	        redirect(base_url().'master/states');
	    }
	    else{
	        $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">&times;</button>Try again. Data not uploaded!</div>');
	        redirect(base_url().'master/states');
	    }
	}
		
public function statesList() {
    $where = "where status !=2";

      
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
              
               }
            $order_by_arr[] = "name";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by name asc";
            $query = "select name,status,id from states $where";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {

                   $cls = "";$status="";

                if ($r->status == '0') 
                {
                    $status = "<button type='button' class='text-warning'><i class='fa fa-remove'></i> Active</button>";
                    $chng = "<button class='btn btn-info btn-sm' onclick='changestatus(1," . $r->id . ")'  $cls> Active</button>";
                }
                 else
                  {
                   $status = "<button type='button' class='text-success'><i class='fa fa-check'></i> In-Active</button>";
                    $chng = "<button class='btn btn-primary btn-sm pl-3 pr-3' onclick='changestatus(0," . $r->id . ")'  $cls> In-Active</button>";
                }
                $action =' <a href="'.base_url()."master/states_edit?id=".base64_encode($r->id)."".'" class="btn btn-circle btn-info" title="Edit" ><i class="mdi mdi-border-color"></i></a>
                        <button type="button" class="btn btn-circle btn-primary" title="Delete" onclick="changestatus(2,'.$r->id.')" ><i class=" fas fa-trash" ></i></button>';
                $sub_array = array();
             $sub_array[] = $i++;
             $sub_array[] = $r->name;
            
             $sub_array[] = $chng;
             $sub_array[] =  $action;
            
            $data[] = $sub_array;
            }

            $res    = $this->home_db->run_manual_query_result($query);
        $total  = count($res);
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
             "recordsTotal"          => $total,  
                "recordsFiltered"     => $total,  
            "data"              =>  $data
        );
        echo json_encode($output);
}
public function states_status() {
        $items = $this->input->post('items');
            $status = $this->input->post('status');
            //echo "<pre>";print_r($_POST);exit;
            $db=array(
            'items'=>$items,
            'status'=>$status
            );
            $this->master_db->changeStatus('states',$db);
            if($status == 2)
            {
                $this->master_db->deleterecordss('states',['id'=>$items]);
            }
            echo 1;
}
    public function states_add() {
        $this->data['type']='add';
        $this->data['city']= $this->master_db->getRecords('states',['status'=>0],"id,name");
        $this->load->view('state_add',$this->data);
    }
    public function states_save() {
        $cname = trim(preg_replace('!\s+!', ' ',$this->input->post('sname')));
            //$city = trim(preg_replace('!\s+!', '',$this->input->post('city')));
            $getrecords = $this->master_db->getRecords('states',['name'=>$cname]);
            //echo $this->db->last_query();exit;
            if(count($getrecords) >0) {
              $this->session->set_flashdata('success','<div class="alert alert-danger">Pincode already exist </div>');
                     redirect('master/states');
            }else {
                      $db = array(
                   
                    'name'=>$cname,
                   
                    'status'=>0
                    );
                $insert = $this->master_db->insertRecord('states',$db);
                if($insert) {
                    $this->session->set_flashdata('success','<div class="alert alert-success">State inserted successfully</div>');
                    redirect('master/states');
                }else {
                     $this->session->set_flashdata('success','<div class="alert alert-danger">Error in interting data</div>');
                     redirect('master/states');
                }
               
            }
    }
    public function states_edit() {
        $det=$this->data['detail'];

        $id=base64_decode($this->input->get('id'));

        if($id)
        {
            $this->data['type']='edit';
            $this->data['city']= $this->master_db->getRecords('states',['status'=>0],"id,name");
            $this->data['details']=$this->master_db->getcontent('states',$id);
            $this->load->view('state_add',$this->data);
        }

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $order=$this->input->post('order');

            $cname = trim(preg_replace('!\s+!', ' ',$this->input->post('sname')));
           
            $db=array(
               
                'name'=>$cname
            );
            $res=$this->master_db->updateRecord('states',$db,['id'=>$id]);
            if($res)
            {
                $this->session->set_flashdata('success','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');
                redirect('master/states');

            }
            else
            {
                $this->session->set_flashdata('success','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
                redirect('master/states');

            }
            
        }
    }
    public function newProductsave() {
	 //error_reporting(1);init_set('display_errors',1);
        $det=$this->data['detail'];
       // echo "<pre>";print_r($det);exit;
     //echo "<pre>";print_r($_POST);print_r($_FILES);exit;
         $package = $this->input->post('package');
         //echo "<pre>";print_r($package);exit;
        $category = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('category', true))));
        $subcateg = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('subcateg', true))));
        /*$sub_sub_id = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sub_sub_id', true))));*/
        $pname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pname', true))));
        $ptitle = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('ptitle', true))));
        $tax = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('tax', true))));
        $pcode = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pcodes', true))));
        $mrp = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mrps', true))));
        $sellingprice = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sellingprices', true))));
        $stock = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('stocks', true))));
        $overview = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('overviews', true))));
        $mtdesc = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mtdess', true))));
        $sname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('snames', true))));
        $svalue = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('svalues', true))));
       $package1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('package1', true))));
       $package2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('package2', true))));
       $package3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('package3', true))));
       $package7 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('package7', true))));
       $pcode1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pcode1', true))));
       $mrp1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mrp1', true))));
       $sellingprice1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sellingprice1', true))));
       $stock1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('stock1', true))));
       $overview1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('overview1', true))));
       $sizes = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sizes', true))));
         $uploaddir = 'assets/images/';
        $uploadDBdir= "assets/images/";
        $arry = array("jpg","png","jpeg","JPG","JPEG");
       $insert ="";
   if(!empty($category) && !empty($subcateg) && !empty($pname) && !empty($ptitle)) {
        $db['cat_id'] = $category;  
        $db['subcat_id'] = $subcateg;   
        $db['name'] = $pname;  
        $db['ptitle'] = $ptitle;  
        $db['page_url'] = $this->master_db->create_unique_slug($ptitle,'products','page_url');  
        $db['created_date'] = date('Y-m-d H:i:s');  
        $db['status'] = 0;  
        $db['tax'] = $tax;  
        $insert .= $this->master_db->insertRecord('products',$db);
    if($package7 ==7) {
        if(!empty($pcode) && !empty($mrp) && !empty($sellingprice) && !empty($overview)) {
              $orderno =$this->input->post('orderno');
             $youtube1 =$this->input->post('youtube1');
             $howtouse1 =$this->input->post('howtouse1');
             $p7['pid'] = $insert;
            $p7['pcode'] = $pcode;
            $p7['mrp'] = $mrp;
            $p7['sellingprice'] = $sellingprice;
            $p7['stock'] = $stock;
            $p7['overview'] = $overview;
            $p7['mdesc'] = $mtdesc;
            $p7['sname'] = $sname;
            $p7['svalue'] = $svalue;
            $p7['package_id'] = 7;
            $p7['psize'] = $sizes;
            $p7['home_page'] = 0;
            $p7['bundle_products'] = 0;
            $p1['status'] = 0;
            $p1['created_date'] = date('Y-m-d H:i:s');
            $p1['how_to_use'] = $howtouse1;
            $p1['youtube'] = $youtube1;
            $p = $this->master_db->insertRecord('productpackage',$p7);
                  
                    foreach($orderno as $key => $value){
                          $db = array(
                                'pid'=>$p,
                                'order_no'=>$value,
                                'thumb'=>0,
                                'image_path'=>0,
                                'image_medium'=>0,
                                'image_large'=>0,
                                'status'=>0,
                                'created_date'=>date('Y-m-d H:i:s'),
                                'modified_date'=>date('Y-m-d H:i:s'),
                                'image_path2'=>0,
                                
                        );
                        $imgid = $this->master_db->insertRecord('product_images',$db);

                                $arrayImage1=$_FILES['galthumbs']['name'][$key];
                    $arrayTemp1=$_FILES['galthumbs']['tmp_name'][$key];
                    $t1 = explode(".", $arrayImage1);
                    $ext = end($t1);
                    
                    if(in_array($ext,$arry)){
                        $image_name=$_FILES['galthumbs']['name'][$key];
                        $uploadfile = $uploaddir.$image_name;
                        $uploadfileTable1 = $uploadDBdir.$image_name;
                        $img1up = move_uploaded_file($arrayTemp1,$uploadfile);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $db = array(
                                'thumb'=>$uploadfileTable1
                        );
                        $this->master_db->updateRecord('product_images',$db,['id'=>$imgid]);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }

                            $arrayImag2=$_FILES['galsmalls']['name'][$key];
                    $arrayTemp2=$_FILES['galsmalls']['tmp_name'][$key];
                    $t2 = explode(".", $arrayImag2);
                    $ext2 = end($t2);
                    
                    if(in_array($ext2,$arry)){
                        $image_name2=$_FILES['galsmalls']['name'][$key];
                        $uploadfile2 = $uploaddir.$image_name2;
                        $uploadfileTable2 = $uploadDBdir.$image_name2;
                        $img1up = move_uploaded_file($arrayTemp2,$uploadfile2);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbs = array(
                                'image_path'=>$uploadfileTable2
                        );
                        $this->master_db->updateRecord('product_images',$dbs,['id'=>$imgid]);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                            $arrayImage3=$_FILES['galmedius']['name'][$key];
                    $arrayTemp3=$_FILES['galmedius']['tmp_name'][$key];
                    $t3 = explode(".", $arrayImage3);
                    $ext3 = end($t3);
                    
                    if(in_array($ext3,$arry)){
                        $image_name3=$_FILES['galmedius']['name'][$key];
                        $uploadfile3 = $uploaddir.$image_name3;
                        $uploadfileTable3 = $uploadDBdir.$image_name3;
                        $img1up = move_uploaded_file($arrayTemp3,$uploadfile3);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbss = array(
                                'image_medium'=>$uploadfileTable3
                        );
                        $this->master_db->updateRecord('product_images',$dbss,['id'=>$imgid]);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                            $arrayImage4=$_FILES['gallarges']['name'][$key];
                    $arrayTemp4=$_FILES['gallarges']['tmp_name'][$key];
                    $t4 = explode(".", $arrayImage4);
                    $ext4 = end($t4);
                    
                    if(in_array($ext4,$arry)){
                        $image_name4=$_FILES['gallarges']['name'][$key];
                        $uploadfile4 = $uploaddir.$image_name4;
                        $uploadfileTable4 = $uploadDBdir.$image_name4;
                        $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsss = array(
                                'image_large'=>$uploadfileTable4
                        );
                        $this->master_db->updateRecord('product_images',$dbsss,['id'=>$imgid]);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }
                  

                      }
         
         
       }
  }
        if($package1 ==1) {
          	 $pcode1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pcode1', true))));
        	$mrp1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mrp1', true))));
        	$sellingprice1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sellingprice1', true))));
        	$stock1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('stock1', true))));
       	 	$overview1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('overview1', true))));
        	$mtdesc = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mtdesc1', true))));
        	$orderno1 = $this->input->post('orderno1');
        	$sname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sname1', true))));
        	$svalue = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('svalue1', true))));
            $sizes1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sizes1', true))));
            $youtube2 =$this->input->post('youtube2');
             $howtouse2 =$this->input->post('howtouse2');
           if(!empty($category) && !empty($subcateg) && !empty($pname) && !empty($ptitle) && !empty($pcode1) && !empty($mrp1) && !empty($sellingprice1) && !empty($stock1) && !empty($overview1) && !empty($_FILES['galthumb1']['name']) && !empty($_FILES['galsmall1']['name']) && !empty($_FILES['galmedium1']['name']) &&  !empty($_FILES['gallarge1']['name'])) {
                $p1['pid'] = $insert;
            $p1['pcode'] = $pcode1;
            $p1['mrp'] = $mrp1;
            $p1['sellingprice'] = $sellingprice1;
            $p1['stock'] = $stock1;
            $p1['overview'] = $overview1;
            $p1['mdesc'] = $mtdesc;
            $p1['sname'] = $sname;
            $p1['svalue'] = $svalue;
            $p1['package_id'] = 1;
            $p1['psize'] = $sizes1;
            $p1['home_page'] = 0;
            $p1['bundle_products'] = 0;
            $p1['status'] = 0;
            $p1['created_date'] = date('Y-m-d H:i:s');
            $p1['how_to_use'] = $howtouse2;
            $p1['youtube'] = $youtube2;
            $p = $this->master_db->insertRecord('productpackage',$p1);

            foreach ($orderno1 as $key => $value) {
                 $db = array(
                                'pid'=>$p,
                                'order_no'=>$value,
                                
                                'thumb'=>0,
                                'image_path'=>0,
                                'image_medium'=>0,
                                'image_large'=>0,
                                'status'=>0,
                                'created_date'=>date('Y-m-d H:i:s'),
                                'modified_date'=>date('Y-m-d H:i:s'),
                                
                                'image_path2'=>0,
                                
                        );
                        $imgid = $this->master_db->insertRecord('product_images',$db);

                                $arrayImage1=$_FILES['galthumb1']['name'][$key];
                    $arrayTemp1=$_FILES['galthumb1']['tmp_name'][$key];
                    $tmps = explode(".", $arrayImage1);
                    $ext = end($tmps);
                    
                    if(in_array($ext,$arry)){
                        $image_name=$_FILES['galthumb1']['name'][$key];
                        $uploadfile = $uploaddir.$image_name;
                        $uploadfileTable1 = $uploadDBdir.$image_name;
                        $img1up = move_uploaded_file($arrayTemp1,$uploadfile);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $db = array(
                                'thumb'=>$uploadfileTable1
                        );
                        $this->master_db->updateRecord('product_images',$db,['id'=>$imgid]);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }

                            $arrayImag2=$_FILES['galsmall1']['name'][$key];
                    $arrayTemp2=$_FILES['galsmall1']['tmp_name'][$key];
                    $tmps1 = explode(".", $arrayImag2);
                    $ext2 = end($tmps1);
                    
                    if(in_array($ext2,$arry)){
                        $image_name2=$_FILES['galsmall1']['name'][$key];
                        $uploadfile2 = $uploaddir.$image_name2;
                        $uploadfileTable2 = $uploadDBdir.$image_name2;
                        $img1up = move_uploaded_file($arrayTemp2,$uploadfile2);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbs = array(
                                'image_path'=>$uploadfileTable2
                        );
                        $this->master_db->updateRecord('product_images',$dbs,['id'=>$imgid]);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                            $arrayImage3=$_FILES['galmedium1']['name'][$key];
                    $arrayTemp3=$_FILES['galmedium1']['tmp_name'][$key];
                    $tmps2 = explode(".", $arrayImage3);
                    $ext3 = end($tmps2);
                    
                    if(in_array($ext3,$arry)){
                        $image_name3=$_FILES['galmedium1']['name'][$key];
                        $uploadfile3 = $uploaddir.$image_name3;
                        $uploadfileTable3 = $uploadDBdir.$image_name3;
                        $img1up = move_uploaded_file($arrayTemp3,$uploadfile3);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbss = array(
                                'image_medium'=>$uploadfileTable3
                        );
                        $this->master_db->updateRecord('product_images',$dbss,['id'=>$imgid]);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                            $arrayImage4=$_FILES['gallarge1']['name'][$key];
                    $arrayTemp4=$_FILES['gallarge1']['tmp_name'][$key];
                    $tmps3 = explode(".", $arrayImage4);
                    $ext4 = end($tmps3);
                    
                    if(in_array($ext4,$arry)){
                        $image_name4=$_FILES['gallarge1']['name'][$key];
                        $uploadfile4 = $uploaddir.$image_name4;
                        $uploadfileTable4 = $uploadDBdir.$image_name4;
                        $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsss = array(
                                'image_large'=>$uploadfileTable4
                        );
                        $this->master_db->updateRecord('product_images',$dbsss,['id'=>$imgid]);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }
            }
           }
        	
       } 
       if($package2 ==2) {
          $pcode2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pcode2', true))));
        	$mrp2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mrp2', true))));
        	$sellingprice2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sellingprice2', true))));
        	$stock2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('stock2', true))));
       	 	$overview2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('overview2', true))));
        	$mtdesc = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mtdesc2', true))));
            $orderno2 = $this->input->post('orderno2');     
            $sizes2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sizes2', true))));   	
            $sname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sname2', true))));
        	$svalue = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('svalue2', true))));
            $youtube3 =$this->input->post('youtube3');
             $howtouse3 =$this->input->post('howtouse3');
             if(!empty($category) && !empty($subcateg) && !empty($pname) && !empty($ptitle) && !empty($pcode2) && !empty($mrp2) && !empty($sellingprice2) && !empty($stock2) && !empty($overview2)) {
                $p1['pid'] = $insert;
            $p1['pcode'] = $pcode2;
            $p1['mrp'] = $mrp2;
            $p1['sellingprice'] = $sellingprice2;
            $p1['stock'] = $stock2;
            $p1['overview'] = $overview2;
            $p1['mdesc'] = $mtdesc;
            $p1['sname'] = $sname;
            $p1['svalue'] = $svalue;
            $p1['package_id'] = 2;
            $p1['psize'] = $sizes2;
            $p1['home_page'] = 0;
            $p1['bundle_products'] = 0;
       
            $p1['status'] = 0;
            $p1['created_date'] = date('Y-m-d H:i:s');
            $p1['how_to_use'] = $howtouse3;
            $p1['youtube'] = $youtube3;
            $p = $this->master_db->insertRecord('productpackage',$p1);

               foreach ($orderno2 as $key => $value) {
                     $db = array(
                                'pid'=>$p,
                                'order_no'=>$value,
                                
                                'thumb'=>0,
                                'image_path'=>0,
                                'image_medium'=>0,
                                'image_large'=>0,
                                'status'=>0,
                                'user_id'=>$det[0]->id,
                                'created_date'=>date('Y-m-d H:i:s'),
                                'modified_date'=>date('Y-m-d H:i:s'),
                                
                                'image_path2'=>0,
                                
                        );
                        $imgid = $this->master_db->insertRecord('product_images',$db);

                                $arrayImage10=$_FILES['galthumb2']['name'][$key];
                    $arrayTemp10=$_FILES['galthumb2']['tmp_name'][$key];
                    $t5 = explode(".", $arrayImage10);
                    $ext10 = end($t5);
                    
                    if(in_array($ext10,$arry)){
                        $image_name10=$_FILES['galthumb2']['name'][$key];
                        $uploadfile10 = $uploaddir.$image_name10;
                        $uploadfileTable10 = $uploadDBdir.$image_name10;
                        $img1up = move_uploaded_file($arrayTemp10,$uploadfile10);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbgp = array(
                                'thumb'=>$uploadfileTable10
                        );
                        $this->master_db->updateRecord('product_images',$dbgp,['id'=>$imgid]);
                    }

                            $arrayImag11=$_FILES['galsmall2']['name'][$key];
                    $arrayTemp11=$_FILES['galsmall2']['tmp_name'][$key];
                    $t6=explode(".", $arrayImag11);
                    $ext11 = end($t6);
                    
                    if(in_array($ext11,$arry)){
                        $image_name11=$_FILES['galsmall2']['name'][$key];
                        $uploadfile11 = $uploaddir.$image_name11;
                        $uploadfileTable11 = $uploadDBdir.$image_name11;
                        $img1up = move_uploaded_file($arrayTemp11,$uploadfile11);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsp = array(
                                'image_path'=>$uploadfileTable11
                        );
                        $this->master_db->updateRecord('product_images',$dbsp,['id'=>$imgid]);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                            $arrayImage12=$_FILES['galmedium2']['name'][$key];
                    $arrayTemp12=$_FILES['galmedium2']['tmp_name'][$key];
                    $t7 = explode(".", $arrayImage12);
                    $ext12 = end($t7);
                    
                    if(in_array($ext12,$arry)){
                        $image_name12=$_FILES['galmedium2']['name'][$key];
                        $uploadfile12 = $uploaddir.$image_name3;
                        $uploadfileTable12 = $uploadDBdir.$image_name12;
                        $img1up = move_uploaded_file($arrayTemp12,$uploadfile12);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbss = array(
                                'image_medium'=>$uploadfileTable12
                        );
                        $this->master_db->updateRecord('product_images',$dbss,['id'=>$imgid]);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                            $arrayImage4=$_FILES['gallarge2']['name'][$key];
                    $arrayTemp4=$_FILES['gallarge2']['tmp_name'][$key];
                    $t8 = explode(".", $arrayImage4);
                    $ext4 = end($t8);
                    
                    if(in_array($ext4,$arry)){
                        $image_name4=$_FILES['gallarge2']['name'][$key];
                        $uploadfile4 = $uploaddir.$image_name4;
                        $uploadfileTable4 = $uploadDBdir.$image_name4;
                        $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsss = array(
                                'image_large'=>$uploadfileTable4
                        );
                        $this->master_db->updateRecord('product_images',$dbsss,['id'=>$imgid]);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }
               }
           }
       } 
       if($package3 ==3) {
              $pcode3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pcode3', true))));
        	$mrp3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mrp3', true))));
        	$sellingprice3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sellingprice3', true))));
        	$stock3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('stock3', true))));
       	 	$overview3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('overview3', true))));
        	$mtdesc = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mtdesc3', true))));
        	$orderno3 = $this->input->post('orderno3');
        	$sname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sname3', true))));
            $sizes3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sizes3', true))));
        	$svalue = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('svalue3', true))));
             $youtube4 =$this->input->post('youtube4');
             $howtouse4 =$this->input->post('howtouse4');
             if(!empty($category) && !empty($subcateg) && !empty($pname) && !empty($ptitle) && !empty($pcode3) && !empty($mrp3) && !empty($sellingprice3) && !empty($stock3) && !empty($overview3)) {
                    $p1['pid'] = $insert;
            $p1['pcode'] = $pcode3;
            $p1['mrp'] = $mrp3;
            $p1['sellingprice'] = $sellingprice3;
            $p1['stock'] = $stock3;
            $p1['overview'] = $overview3;
            $p1['mdesc'] = $mtdesc;
            $p1['sname'] = $sname;
            $p1['svalue'] = $svalue;
            $p1['package_id'] = 3;
            $p1['psize'] = $sizes3;
            $p1['home_page'] = 0;
            $p1['bundle_products'] = 0;
          
            $p1['status'] = 0;
            $p1['created_date'] = date('Y-m-d H:i:s');
            $p1['how_to_use'] = $howtouse4;
            $p1['youtube'] = $youtube4;
          $p =  $this->master_db->insertRecord('productpackage',$p1);


               foreach($orderno3 as $key => $value) {
                        $db = array(
                                'pid'=>$p,
                                'order_no'=>$value,
                                'thumb'=>0,
                                'image_path'=>0,
                                'image_medium'=>0,
                                'image_large'=>0,
                                'status'=>0,
                                'user_id'=>$det[0]->id,
                                'created_date'=>date('Y-m-d H:i:s'),
                                'modified_date'=>date('Y-m-d H:i:s'),
                                'image_path2'=>0,
                                
                        );
                        $imgid = $this->master_db->insertRecord('product_images',$db);

                    $arrayImage100=$_FILES['galthumb3']['name'][$key];
                    $arrayTemp100=$_FILES['galthumb3']['tmp_name'][$key];
                    $t9 = explode(".", $arrayImage100);
                    $ext100 = end($t9);
                    
                    if(in_array($ext100,$arry)){
                        $image_name100=$_FILES['galthumb3']['name'][$key];
                        $uploadfile100 = $uploaddir.$image_name100;
                        $uploadfileTable100 = $uploadDBdir.$image_name100;
                        $img1up = move_uploaded_file($arrayTemp100,$uploadfile100);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $db = array(
                                'thumb'=>$uploadfileTable100
                        );
                        $this->master_db->updateRecord('product_images',$db,['id'=>$imgid]);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }

                            $arrayImag2=$_FILES['galsmall3']['name'][$key];
                    $arrayTemp2=$_FILES['galsmall3']['tmp_name'][$key];
                    $t10 = explode(".", $arrayImag2);
                    $ext2 = end($t10);
                    
                    if(in_array($ext2,$arry)){
                        $image_name2=$_FILES['galsmall3']['name'][$key];
                        $uploadfile2 = $uploaddir.$image_name2;
                        $uploadfileTable2 = $uploadDBdir.$image_name2;
                        $img1up = move_uploaded_file($arrayTemp2,$uploadfile2);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbs = array(
                                'image_path'=>$uploadfileTable2
                        );
                        $this->master_db->updateRecord('product_images',$dbs,['id'=>$imgid]);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                            $arrayImage3=$_FILES['galmedium3']['name'][$key];
                    $arrayTemp3=$_FILES['galmedium3']['tmp_name'][$key];
                    $t11 = explode(".", $arrayImage3);
                    $ext3 = end($t11);
                    
                    if(in_array($ext3,$arry)){
                        $image_name3=$_FILES['galmedium3']['name'][$key];
                        $uploadfile3 = $uploaddir.$image_name3;
                        $uploadfileTable3 = $uploadDBdir.$image_name3;
                        $img1up = move_uploaded_file($arrayTemp3,$uploadfile3);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbss = array(
                                'image_medium'=>$uploadfileTable3
                        );
                        $this->master_db->updateRecord('product_images',$dbss,['id'=>$imgid]);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                            $arrayImage4=$_FILES['gallarge3']['name'][$key];
                    $arrayTemp4=$_FILES['gallarge3']['tmp_name'][$key];
                    $t12 = explode(".", $arrayImage4);
                    $ext4 = end($t12);
                    
                    if(in_array($ext4,$arry)){
                        $image_name4=$_FILES['gallarge3']['name'][$key];
                        $uploadfile4 = $uploaddir.$image_name4;
                        $uploadfileTable4 = $uploadDBdir.$image_name4;
                        $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsss = array(
                                'image_large'=>$uploadfileTable4
                        );
                        $this->master_db->updateRecord('product_images',$dbsss,['id'=>$imgid]);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }
               }

           }
       } 
       $this->session->set_userdata('message','Product inserted successfully');
    echo json_encode(['status'=>'success','pdata'=>'Product inserted successfully']);     
}
   }
   public function updateProductPackage() {
     //error_reporting(1);init_set('display_errors',1);
        $det=$this->data['detail'];
     //echo "<pre>";print_r($_POST);exit;
         //echo "<pre>";print_r($package);print_r($_FILES);exit;
        $category = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('category', true))));
        $subcateg = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('subcateg', true))));
      
        $pname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pname', true))));
        $ptitle = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('ptitle', true))));
        $tax = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('tax', true))));
        $pcode = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pcodes', true))));
        $mrp = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mrps', true))));
        $sellingprice = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sellingprices', true))));
        $stock = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('stocks', true))));
        $overview = $this->input->post('overviews');
        $mtdesc = $this->input->post('mtdess');
        $pid = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pid', true))));
        $sname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('snames', true))));
        $svalue = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('svalues', true))));
         $sizes = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sizes', true))));
        $package = $this->input->post('package');
       // echo "<pre>";print_r( $package);exit;
        $uploaddir = 'assets/images/';
        $uploadDBdir= "assets/images/";
        $arry = array("jpg","png","jpeg","JPG","JPEG");
         $insert ="";
         $pp = $this->master_db->getRecords('productpackage',['pid'=>$pid],'id,pid,pcode,mrp,sellingprice,overview,mdesc,stock,package_id');
         //echo $this->db->last_query();exit;
         $ppid=array(); 
         foreach ($pp as $key => $value) {
             $ppid[] = $value->package_id;
         }
         //echo "<pre>";print_r($ppid);exit;
         if(!empty($category) && !empty($subcateg) && !empty($pname) && !empty($ptitle)) {
            $db['cat_id'] = $category;  
            $db['subcat_id'] = $subcateg;  
           
            $db['name'] = $pname;  
            $db['ptitle'] = $ptitle;  
            $db['page_url'] = $this->master_db->create_unique_slug($pname,'products','page_url');  
            $db['created_date'] = date('Y-m-d H:i:s');  
            $db['status'] = 0;  
            $db['tax'] = $tax;  
            $update = $this->master_db->updateRecord('products',$db,$pid);
        }
          foreach ($package as $pack) {
              if(!in_array($pack, $ppid)) {
                if($pack ==7) {
                    $youtube1 =$this->input->post('youtube1');
             $howtouse1 =$this->input->post('howtouse1');
                       $orderno =$this->input->post('orderno');
             $p7['pid'] = $pid;
            $p7['pcode'] = $pcode;
            $p7['mrp'] = $mrp;
            $p7['sellingprice'] = $sellingprice;
            $p7['stock'] = $stock;
            $p7['overview'] = $overview;
            $p7['mdesc'] = $mtdesc;
            $p7['sname'] = $sname;
            $p7['svalue'] = $svalue;
            $p7['package_id'] = 7;
            $p7['psize'] = $sizes;
            $p7['home_page'] = 0;
            $p7['bundle_products'] = 0;
            $p1['status'] = 0;
            $p1['created_date'] = date('Y-m-d H:i:s');
            $p1['how_to_use'] = $howtouse1;
            $p1['youtube'] = $youtube1;
            $p = $this->master_db->insertRecord('productpackage',$p7);
                  
                    foreach($orderno as $key => $value){
                          $db = array(
                                'pid'=>$p,
                                'order_no'=>$value,
                                'thumb'=>0,
                                'image_path'=>0,
                                'image_medium'=>0,
                                'image_large'=>0,
                                'status'=>0,
                                'created_date'=>date('Y-m-d H:i:s'),
                                'modified_date'=>date('Y-m-d H:i:s'),
                                'image_path2'=>0,
                                
                        );
                        $imgid = $this->master_db->insertRecord('product_images',$db);

                                $arrayImage1=$_FILES['galthumbs']['name'][$key];
                    $arrayTemp1=$_FILES['galthumbs']['tmp_name'][$key];
                    $t1 = explode(".", $arrayImage1);
                    $ext = end($t1);
                    
                    if(in_array($ext,$arry)){
                        $image_name=$_FILES['galthumbs']['name'][$key];
                        $uploadfile = $uploaddir.$image_name;
                        $uploadfileTable1 = $uploadDBdir.$image_name;
                        $img1up = move_uploaded_file($arrayTemp1,$uploadfile);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $db = array(
                                'thumb'=>$uploadfileTable1
                        );
                        $this->master_db->updateRecord('product_images',$db,$imgid);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }

                            $arrayImag2=$_FILES['galsmalls']['name'][$key];
                    $arrayTemp2=$_FILES['galsmalls']['tmp_name'][$key];
                    $t2 = explode(".", $arrayImag2);
                    $ext2 = end($t2);
                    
                    if(in_array($ext2,$arry)){
                        $image_name2=$_FILES['galsmalls']['name'][$key];
                        $uploadfile2 = $uploaddir.$image_name2;
                        $uploadfileTable2 = $uploadDBdir.$image_name2;
                        $img1up = move_uploaded_file($arrayTemp2,$uploadfile2);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbs = array(
                                'image_path'=>$uploadfileTable2
                        );
                        $this->master_db->updateRecord('product_images',$dbs,$imgid);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                            $arrayImage3=$_FILES['galmedius']['name'][$key];
                    $arrayTemp3=$_FILES['galmedius']['tmp_name'][$key];
                    $t3 = explode(".", $arrayImage3);
                    $ext3 = end($t3);
                    
                    if(in_array($ext3,$arry)){
                        $image_name3=$_FILES['galmedius']['name'][$key];
                        $uploadfile3 = $uploaddir.$image_name3;
                        $uploadfileTable3 = $uploadDBdir.$image_name3;
                        $img1up = move_uploaded_file($arrayTemp3,$uploadfile3);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbss = array(
                                'image_medium'=>$uploadfileTable3
                        );
                        $this->master_db->updateRecord('product_images',$dbss,$imgid);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                            $arrayImage4=$_FILES['gallarges']['name'][$key];
                    $arrayTemp4=$_FILES['gallarges']['tmp_name'][$key];
                    $t4 = explode(".", $arrayImage4);
                    $ext4 = end($t4);
                    
                    if(in_array($ext4,$arry)){
                        $image_name4=$_FILES['gallarges']['name'][$key];
                        $uploadfile4 = $uploaddir.$image_name4;
                        $uploadfileTable4 = $uploadDBdir.$image_name4;
                        $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsss = array(
                                'image_large'=>$uploadfileTable4
                        );
                        $this->master_db->updateRecord('product_images',$dbsss,$imgid);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }
                  

                      }
         
         
     


                }

                if($pack ==1) {
                                $pcode1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pcode1', true))));
            $mrp1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mrp1', true))));
            $sellingprice1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sellingprice1', true))));
            $stock1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('stock1', true))));
            $overview1 = $this->input->post('overview1');
            $mtdesc =$this->input->post('mtdesc1');
            $orderno1 = $this->input->post('orderno1');
             $sizes1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sizes1', true))));
            $sname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sname1', true))));
            $svalue = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('svalue1', true))));
             $youtube2 =$this->input->post('youtube2');
             $howtouse2 =$this->input->post('howtouse2');
                
           if(!empty($category) && !empty($subcateg) && !empty($pname) && !empty($ptitle) && !empty($pcode1) && !empty($mrp1) && !empty($sellingprice1) && !empty($stock1) && !empty($overview1) && !empty($_FILES['galthumb1']['name']) && !empty($_FILES['galsmall1']['name']) && !empty($_FILES['galmedium1']['name']) &&  !empty($_FILES['gallarge1']['name'])) {
                $p1['pid'] = $pid;
            $p1['pcode'] = $pcode1;
            $p1['mrp'] = $mrp1;
            $p1['sellingprice'] = $sellingprice1;
            $p1['stock'] = $stock1;
            $p1['overview'] = $overview1;
            $p1['mdesc'] = $mtdesc;
            $p1['sname'] = $sname;
            $p1['svalue'] = $svalue;
            $p1['package_id'] = 1;
            $p1['psize'] = $sizes1;
            $p1['home_page'] = 0;
            $p1['bundle_products'] = 0;
            $p1['status'] = 0;
            $p1['created_date'] = date('Y-m-d H:i:s');
            $p1['how_to_use'] = $howtouse2;
            $p1['youtube'] = $youtube2;
            $p = $this->master_db->insertRecord('productpackage',$p1);
            foreach ($orderno1 as $key => $value) {
                 $db = array(
                                'pid'=>$p,
                                'order_no'=>$value,
                                'thumb'=>0,
                                'image_path'=>0,
                                'image_medium'=>0,
                                'image_large'=>0,
                                'status'=>0,
                                'created_date'=>date('Y-m-d H:i:s'),
                                'modified_date'=>date('Y-m-d H:i:s'),
                                
                                'image_path2'=>0,
                                
                        );
                        $imgid = $this->master_db->insertRecord('product_images',$db);

                                $arrayImage1=$_FILES['galthumb1']['name'][$key];
                    $arrayTemp1=$_FILES['galthumb1']['tmp_name'][$key];
                    $t5 = explode(".", $arrayImage1);
                    $ext = end($t5);
                    
                    if(in_array($ext,$arry)){
                        $image_name=$_FILES['galthumb1']['name'][$key];
                        $uploadfile = $uploaddir.$image_name;
                        $uploadfileTable1 = $uploadDBdir.$image_name;
                        $img1up = move_uploaded_file($arrayTemp1,$uploadfile);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $db = array(
                                'thumb'=>$uploadfileTable1
                        );
                        $this->master_db->updateRecord('product_images',$db,$imgid);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }

                            $arrayImag2=$_FILES['galsmall1']['name'][$key];
                    $arrayTemp2=$_FILES['galsmall1']['tmp_name'][$key];
                    $t6 = explode(".", $arrayImag2);
                    $ext2 = end($t6);
                    
                    if(in_array($ext2,$arry)){
                        $image_name2=$_FILES['galsmall1']['name'][$key];
                        $uploadfile2 = $uploaddir.$image_name2;
                        $uploadfileTable2 = $uploadDBdir.$image_name2;
                        $img1up = move_uploaded_file($arrayTemp2,$uploadfile2);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbs = array(
                                'image_path'=>$uploadfileTable2
                        );
                        $this->master_db->updateRecord('product_images',$dbs,$imgid);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                            $arrayImage3=$_FILES['galmedium1']['name'][$key];
                    $arrayTemp3=$_FILES['galmedium1']['tmp_name'][$key];
                    $t7=explode(".", $arrayImage3);
                    $ext3 = end($t7);
                    
                    if(in_array($ext3,$arry)){
                        $image_name3=$_FILES['galmedium1']['name'][$key];
                        $uploadfile3 = $uploaddir.$image_name3;
                        $uploadfileTable3 = $uploadDBdir.$image_name3;
                        $img1up = move_uploaded_file($arrayTemp3,$uploadfile3);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbss = array(
                                'image_medium'=>$uploadfileTable3
                        );
                        $this->master_db->updateRecord('product_images',$dbss,$imgid);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                    $arrayImage4=$_FILES['gallarge1']['name'][$key];
                    $arrayTemp4=$_FILES['gallarge1']['tmp_name'][$key];
                    $t8 = explode(".", $arrayImage4);
                    $ext4 = end($t8);
                    
                    if(in_array($ext4,$arry)){
                        $image_name4=$_FILES['gallarge1']['name'][$key];
                        $uploadfile4 = $uploaddir.$image_name4;
                        $uploadfileTable4 = $uploadDBdir.$image_name4;
                        $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsss = array(
                                'image_large'=>$uploadfileTable4
                        );
                        $this->master_db->updateRecord('product_images',$dbsss,$imgid);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }
                  }
                 }


                }

                if($pack ==2) {
                    $pcode2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pcode2', true))));
            $mrp2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mrp2', true))));
            $sellingprice2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sellingprice2', true))));
            $stock2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('stock2', true))));
            $overview2 = $this->input->post('overview2');
            $mtdesc = $this->input->post('mtdesc2');
            $orderno2 = $this->input->post('orderno2');         
            $sname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sname2', true))));
             $sizes2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sizes2', true))));
            $svalue = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('svalue2', true))));
            $youtube3 =$this->input->post('youtube3');
             $howtouse3 =$this->input->post('howtouse3');
                
             if(!empty($category) && !empty($subcateg) && !empty($pname) && !empty($ptitle) && !empty($pcode2) && !empty($mrp2) && !empty($sellingprice2) && !empty($stock2) && !empty($overview2)) {
                $p1['pid'] = $pid;
            $p1['pcode'] = $pcode2;
            $p1['mrp'] = $mrp2;
            $p1['sellingprice'] = $sellingprice2;
            $p1['stock'] = $stock2;
            $p1['overview'] = $overview2;
            $p1['mdesc'] = $mtdesc;
            $p1['sname'] = $sname;
            $p1['svalue'] = $svalue;
            $p1['package_id'] = 2;
            $p1['psize'] = $sizes2;
            $p1['home_page'] = 0;
            $p1['bundle_products'] = 0;
       
            $p1['status'] = 0;
            $p1['created_date'] = date('Y-m-d H:i:s');
            $p1['how_to_use'] = $howtouse3;
            $p1['youtube'] = $youtube3;
            $p = $this->master_db->insertRecord('productpackage',$p1);

               foreach ($orderno2 as $key => $value) {
                     $db = array(
                                'pid'=>$p,
                                'order_no'=>$value,
                                
                                'thumb'=>0,
                                'image_path'=>0,
                                'image_medium'=>0,
                                'image_large'=>0,
                                'status'=>0,
                                'created_date'=>date('Y-m-d H:i:s'),
                                'modified_date'=>date('Y-m-d H:i:s'),
                                
                                'image_path2'=>0,
                                
                        );
                        $imgid = $this->master_db->insertRecord('product_images',$db);

                                $arrayImage10=$_FILES['galthumb2']['name'][$key];
                    $arrayTemp10=$_FILES['galthumb2']['tmp_name'][$key];
                    $t9 = explode(".", $arrayImage10);
                    $ext10 = end($t9);
                    
                    if(in_array($ext10,$arry)){
                        $image_name10=$_FILES['galthumb2']['name'][$key];
                        $uploadfile10 = $uploaddir.$image_name10;
                        $uploadfileTable10 = $uploadDBdir.$image_name10;
                        $img1up = move_uploaded_file($arrayTemp10,$uploadfile10);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbgp = array(
                                'thumb'=>$uploadfileTable10
                        );
                        $this->master_db->updateRecord('product_images',$dbgp,$imgid);
                    }

                            $arrayImag11=$_FILES['galsmall2']['name'][$key];
                    $arrayTemp11=$_FILES['galsmall2']['tmp_name'][$key];
                    $t10 = explode(".", $arrayImag11);
                    $ext11 = end($t10);
                    
                    if(in_array($ext11,$arry)){
                        $image_name11=$_FILES['galsmall2']['name'][$key];
                        $uploadfile11 = $uploaddir.$image_name11;
                        $uploadfileTable11 = $uploadDBdir.$image_name11;
                        $img1up = move_uploaded_file($arrayTemp11,$uploadfile11);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsp = array(
                                'image_path'=>$uploadfileTable11
                        );
                        $this->master_db->updateRecord('product_images',$dbsp,$imgid);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                            $arrayImage12=$_FILES['galmedium2']['name'][$key];
                    $arrayTemp12=$_FILES['galmedium2']['tmp_name'][$key];
                    $t12 = explode(".", $arrayImage12);
                    $ext12 = end($t12);
                    
                    if(in_array($ext12,$arry)){
                        $image_name12=$_FILES['galmedium2']['name'][$key];
                        $uploadfile12 = $uploaddir.$image_name3;
                        $uploadfileTable12 = $uploadDBdir.$image_name12;
                        $img1up = move_uploaded_file($arrayTemp12,$uploadfile12);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbss = array(
                                'image_medium'=>$uploadfileTable12
                        );
                        $this->master_db->updateRecord('product_images',$dbss,$imgid);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                            $arrayImage4=$_FILES['gallarge2']['name'][$key];
                    $arrayTemp4=$_FILES['gallarge2']['tmp_name'][$key];
                    $t13 = explode(".", $arrayImage4);
                    $ext4 = end($t13);
                    
                    if(in_array($ext4,$arry)){
                        $image_name4=$_FILES['gallarge2']['name'][$key];
                        $uploadfile4 = $uploaddir.$image_name4;
                        $uploadfileTable4 = $uploadDBdir.$image_name4;
                        $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsss = array(
                                'image_large'=>$uploadfileTable4
                        );
                        $this->master_db->updateRecord('product_images',$dbsss,$imgid);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }
               }
           }


                }

                if($pack ==3) {
                                  $pcode3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pcode3', true))));
            $mrp3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mrp3', true))));
            $sellingprice3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sellingprice3', true))));
            $stock3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('stock3', true))));
            $overview3 = $this->input->post('overview3');
            $mtdesc = $this->input->post('mtdesc3');
            $orderno3 = $this->input->post('orderno3');
            $sname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sname3', true))));
             $sizes3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sizes3', true))));
            $svalue = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('svalue3', true))));
            $youtube4 =$this->input->post('youtube4');
             $howtouse4 =$this->input->post('howtouse4');
               
             if(!empty($category) && !empty($subcateg) && !empty($pname) && !empty($ptitle) && !empty($pcode3) && !empty($mrp3) && !empty($sellingprice3) && !empty($stock3) && !empty($overview3)) {
                    $p1['pid'] = $pid;
            $p1['pcode'] = $pcode3;
            $p1['mrp'] = $mrp3;
            $p1['sellingprice'] = $sellingprice3;
            $p1['stock'] = $stock3;
            $p1['overview'] = $overview3;
            $p1['mdesc'] = $mtdesc;
            $p1['sname'] = $sname;
            $p1['svalue'] = $svalue;
            $p1['package_id'] = 3;
            $p1['psize'] = $sizes3;
            $p1['home_page'] = 0;
            $p1['bundle_products'] = 0;
          
            $p1['status'] = 0;
            $p1['created_date'] = date('Y-m-d H:i:s');
             $p1['how_to_use'] = $howtouse4;
            $p1['youtube'] = $youtube4;
          $p =  $this->master_db->insertRecord('productpackage',$p1);


               foreach($orderno3 as $key => $value) {
                        $db = array(
                                'pid'=>$p,
                                'order_no'=>$value,
                                'thumb'=>0,
                                'image_path'=>0,
                                'image_medium'=>0,
                                'image_large'=>0,
                                'status'=>0,
                                'created_date'=>date('Y-m-d H:i:s'),
                                'modified_date'=>date('Y-m-d H:i:s'),
                                'image_path2'=>0,
                                
                        );
                        $imgid = $this->master_db->insertRecord('product_images',$db);

                    $arrayImage100=$_FILES['galthumb3']['name'][$key];
                    $arrayTemp100=$_FILES['galthumb3']['tmp_name'][$key];
                    $t14 = explode(".", $arrayImage100);
                    $ext100 = end($t14);
                    
                    if(in_array($ext100,$arry)){
                        $image_name100=$_FILES['galthumb3']['name'][$key];
                        $uploadfile100 = $uploaddir.$image_name100;
                        $uploadfileTable100 = $uploadDBdir.$image_name100;
                        $img1up = move_uploaded_file($arrayTemp100,$uploadfile100);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $db = array(
                                'thumb'=>$uploadfileTable100
                        );
                        $this->master_db->updateRecord('product_images',$db,$imgid);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }

                            $arrayImag2=$_FILES['galsmall3']['name'][$key];
                    $arrayTemp2=$_FILES['galsmall3']['tmp_name'][$key];
                    $t15 = explode(".", $arrayImag2);
                    $ext2 = end($t15);
                    
                    if(in_array($ext2,$arry)){
                        $image_name2=$_FILES['galsmall3']['name'][$key];
                        $uploadfile2 = $uploaddir.$image_name2;
                        $uploadfileTable2 = $uploadDBdir.$image_name2;
                        $img1up = move_uploaded_file($arrayTemp2,$uploadfile2);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbs = array(
                                'image_path'=>$uploadfileTable2
                        );
                        $this->master_db->updateRecord('product_images',$dbs,$imgid);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                            $arrayImage3=$_FILES['galmedium3']['name'][$key];
                    $arrayTemp3=$_FILES['galmedium3']['tmp_name'][$key];
                    $t16 = explode(".", $arrayImage3);
                    $ext3 = end($t16);
                    
                    if(in_array($ext3,$arry)){
                        $image_name3=$_FILES['galmedium3']['name'][$key];
                        $uploadfile3 = $uploaddir.$image_name3;
                        $uploadfileTable3 = $uploadDBdir.$image_name3;
                        $img1up = move_uploaded_file($arrayTemp3,$uploadfile3);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbss = array(
                                'image_medium'=>$uploadfileTable3
                        );
                        $this->master_db->updateRecord('product_images',$dbss,$imgid);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }


                            $arrayImage4=$_FILES['gallarge3']['name'][$key];
                    $arrayTemp4=$_FILES['gallarge3']['tmp_name'][$key];
                    $t17=explode(".", $arrayImage4);
                    $ext4 = end($t17);
                    
                    if(in_array($ext4,$arry)){
                        $image_name4=$_FILES['gallarge3']['name'][$key];
                        $uploadfile4 = $uploaddir.$image_name4;
                        $uploadfileTable4 = $uploadDBdir.$image_name4;
                        $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsss = array(
                                'image_large'=>$uploadfileTable4
                        );
                        $this->master_db->updateRecord('product_images',$dbsss,$imgid);
                    }else {
                        echo json_encode(['status'=>'failures','pdata'=>'Please upload jpg or png image']);exit;
                    }
               }

           }

                }
              }else {
                  if($pack ==7) {
                    $nonep = $this->master_db->sqlExecute('select * from productpackage where pid='.$pid.' and package_id=7');
                     $goldimg = $this->master_db->sqlExecute('select id,pid from product_images where pid='.$nonep[0]->id.'');
                    //echo $this->db->last_query();exit;

                                                     $youtube1 =$this->input->post('youtube1');
             $howtouse1 =$this->input->post('howtouse1');
                
                       $orderno =$this->input->post('orderno');
             $p7['pid'] = $pid;
            $p7['pcode'] = $pcode;
            $p7['mrp'] = $mrp;
            $p7['sellingprice'] = $sellingprice;
            $p7['stock'] = $stock;
            $p7['overview'] = $overview;
            $p7['mdesc'] = $mtdesc;
            $p7['sname'] = $sname;
            $p7['svalue'] = $sizes;
            if(!empty($sizes)) {
               $p7['psize'] = $sizes; 
            }
            
          $pnone = $this->input->post('pnone');
          //echo "<pre>";print_r($pnone);exit;
           
            $p7['modified_date'] = date('Y-m-d H:i:s');
            $p7['how_to_use'] = $howtouse1;
            $p7['youtube'] = $youtube1;
            $p = $this->master_db->updateRecord('productpackage',$p7,$nonep[0]->id);
                  	
                    foreach($_FILES['galthumbs']['name'] as $key => $value){
                        if($_FILES['galthumbs']['name'][$key] !=""  || $_FILES['galsmalls']['name'][$key] !="" || $_FILES['galmedius']['name'][$key] !="" || $_FILES['gallarges']['name'][$key] !="") {
                            if(isset($this->input->post('pnone')[$key])) {
                                
                                                 $arrayImage=$_FILES['galthumbs']['name'][$key];
                                        $arrayTemp1=$_FILES['galthumbs']['tmp_name'][$key];
                                        $t18 = explode(".", $arrayImage);
                                        $ext = end($t18);
                                        
                                        if(in_array($ext,$arry)){
                                            $image_name=$_FILES['galthumbs']['name'][$key];
                                            $uploadfile = $uploaddir.$image_name;
                                            $uploadfileTable1 = $uploadDBdir.$image_name;
                                            $img1up = move_uploaded_file($arrayTemp1,$uploadfile);
                                            //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                                            
                                            $db = array(
                                                    'thumb'=>$uploadfileTable1
                                            );
                                            $this->master_db->updateRecord('product_images',$db,$pnone[$key]);
                                        }

                                                $arrayImag2=$_FILES['galsmalls']['name'][$key];
                                        $arrayTemp2=$_FILES['galsmalls']['tmp_name'][$key];
                                        $t19 = explode(".", $arrayImag2);
                                        $ext2 = end($t19);
                                        
                                        if(in_array($ext2,$arry)){
                                            $image_name2=$_FILES['galsmalls']['name'][$key];
                                            $uploadfile2 = $uploaddir.$image_name2;
                                            $uploadfileTable2 = $uploadDBdir.$image_name2;
                                            $img1up = move_uploaded_file($arrayTemp2,$uploadfile2);
                                            //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                                            
                                            $dbs = array(
                                                    'image_path'=>$uploadfileTable2
                                            );
                                            $this->master_db->updateRecord('product_images',$dbs,$pnone[$key]);
                                        }


                                                $arrayImage3=$_FILES['galmedius']['name'][$key];
                                        $arrayTemp3=$_FILES['galmedius']['tmp_name'][$key];
                                        $t20 = explode(".", $arrayImage3);
                                        $ext3 = end($t20);
                                        
                                        if(in_array($ext3,$arry)){
                                            $image_name3=$_FILES['galmedius']['name'][$key];
                                            $uploadfile3 = $uploaddir.$image_name3;
                                            $uploadfileTable3 = $uploadDBdir.$image_name3;
                                            $img1up = move_uploaded_file($arrayTemp3,$uploadfile3);
                                            //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                                            
                                            $dbss = array(
                                                    'image_medium'=>$uploadfileTable3
                                            );
                                            $this->master_db->updateRecord('product_images',$dbss,$pnone[$key]);
                                        }


                                                $arrayImage4=$_FILES['gallarges']['name'][$key];
                                        $arrayTemp4=$_FILES['gallarges']['tmp_name'][$key];
                                        $t21 = explode(".", $arrayImage4);
                                        $ext4 = end($t21);
                                        
                                        if(in_array($ext4,$arry)){
                                            $image_name4=$_FILES['gallarges']['name'][$key];
                                            $uploadfile4 = $uploaddir.$image_name4;
                                            $uploadfileTable4 = $uploadDBdir.$image_name4;
                                            $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                                            //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                                            
                                            $dbsss = array(
                                                    'image_large'=>$uploadfileTable4
                                            );
                                            $this->master_db->updateRecord('product_images',$dbsss,$pnone[$key]);
                                        }
                  
                            }else {
                                                       $db = array(
                                'pid'=>$nonep[0]->id,
                                'order_no'=>$value,
                                'thumb'=>0,
                                'image_path'=>0,
                                'image_medium'=>0,
                                'image_large'=>0,
                                'status'=>0,
                                'created_date'=>date('Y-m-d H:i:s'),
                                'modified_date'=>date('Y-m-d H:i:s'),
                                'image_path2'=>0,
                                
                        );
                        $imgid = $this->master_db->insertRecord('product_images',$db);

                                $arrayImage=$_FILES['galthumbs']['name'][$key];
                    $arrayTemp1=$_FILES['galthumbs']['tmp_name'][$key];
                    $t22 = explode(".", $arrayImage);
                    $ext = end($t22);
                    
                    if(in_array($ext,$arry)){
                        $image_name=$_FILES['galthumbs']['name'][$key];
                        $uploadfile = $uploaddir.$image_name;
                        $uploadfileTable1 = $uploadDBdir.$image_name;
                        $img1up = move_uploaded_file($arrayTemp1,$uploadfile);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $db = array(
                                'thumb'=>$uploadfileTable1
                        );
                        $this->master_db->updateRecord('product_images',$db,$imgid);
                    }

                            $arrayImag2=$_FILES['galsmalls']['name'][$key];
                    $arrayTemp2=$_FILES['galsmalls']['tmp_name'][$key];
                    $t23 = explode(".", $arrayImag2);
                    $ext2 = end($t23);
                    
                    if(in_array($ext2,$arry)){
                        $image_name2=$_FILES['galsmalls']['name'][$key];
                        $uploadfile2 = $uploaddir.$image_name2;
                        $uploadfileTable2 = $uploadDBdir.$image_name2;
                        $img1up = move_uploaded_file($arrayTemp2,$uploadfile2);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbs = array(
                                'image_path'=>$uploadfileTable2
                        );
                        $this->master_db->updateRecord('product_images',$dbs,$imgid);
                    }


                            $arrayImage3=$_FILES['galmedius']['name'][$key];
                    $arrayTemp3=$_FILES['galmedius']['tmp_name'][$key];
                    $t24 = explode(".", $arrayImage3);
                    $ext3 = end($t24);
                    
                    if(in_array($ext3,$arry)){
                        $image_name3=$_FILES['galmedius']['name'][$key];
                        $uploadfile3 = $uploaddir.$image_name3;
                        $uploadfileTable3 = $uploadDBdir.$image_name3;
                        $img1up = move_uploaded_file($arrayTemp3,$uploadfile3);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbss = array(
                                'image_medium'=>$uploadfileTable3
                        );
                        $this->master_db->updateRecord('product_images',$dbss,$imgid);
                    }


                            $arrayImage4=$_FILES['gallarges']['name'][$key];
                    $arrayTemp4=$_FILES['gallarges']['tmp_name'][$key];
                    $t25 = explode(".", $arrayImage4);
                    $ext4 = end($t25);
                    
                    if(in_array($ext4,$arry)){
                        $image_name4=$_FILES['gallarges']['name'][$key];
                        $uploadfile4 = $uploaddir.$image_name4;
                        $uploadfileTable4 = $uploadDBdir.$image_name4;
                        $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsss = array(
                                'image_large'=>$uploadfileTable4
                        );
                        $this->master_db->updateRecord('product_images',$dbsss,$imgid);
                    }


                            }
                        }
    

                      }
         
        // echo "inserted";
     
                }
//exit;
                if($pack ==1) {
                    //echo "<pre>";print_r($_FILES);print_r($_POST);exit;
                    $goldp = $this->master_db->sqlExecute('select id from productpackage where pid='.$pid.' and package_id=1');
                    $pnoneimg = $this->master_db->sqlExecute('select id,pid from product_images where pid='.$goldp[0]->id.'');
                    //echo $this->db->last_query();exit;
                    
            $pcode1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pcode1', true))));
            $mrp1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mrp1', true))));
            $sellingprice1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sellingprice1', true))));
            $stock1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('stock1', true))));
            $overview1 = $this->input->post('overview1');
            $mtdesc = $this->input->post('mtdesc1');
            $orderno1 = $this->input->post('orderno1');
            $sname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sname1', true))));
            $svalue = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('svalue1', true))));
             $sizes1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sizes1', true))));
            $pgold = $this->input->post('pgold');
            $youtube2 =$this->input->post('youtube2');
             $howtouse2 =$this->input->post('howtouse2');
                
            //echo "<pre>";print_r($pgold);exit;
             $p1['pid'] = $pid;
            $p1['pcode'] = $pcode1;
            $p1['mrp'] = $mrp1;
            $p1['sellingprice'] = $sellingprice1;
            $p1['stock'] = $stock1;
            $p1['overview'] = $overview1;
            $p1['mdesc'] = $mtdesc;
            $p1['sname'] = $sname;
            $p1['svalue'] = $svalue;
            if(!empty($sizes1)) {
                $p1['psize'] = $sizes1;  
            }
            
            $p1['modified_date'] = date('Y-m-d H:i:s');
            $p1['how_to_use'] = $howtouse2;
            $p1['youtube'] = $youtube2;
            $p = $this->master_db->updateRecord('productpackage',$p1,$goldp[0]->id);
            //echo $this->db->last_query();exit;
            foreach ($_FILES['galthumb1']['name'] as $key => $value) {

                 if($_FILES['galthumb1']['name'][$key] !="" || $_FILES['galsmall1']['name'][$key] !="" || $_FILES['galmedium1']['name'][$key]!="" || $_FILES['gallarge1']['name'][$key]!="") {
                            if(isset($this->input->post('pgold')[$key])) {
                                 $arrayImage=$_FILES['galthumb1']['name'][$key];
                    $arrayTemp1=$_FILES['galthumb1']['tmp_name'][$key];
                    $t26 = explode(".", $arrayImage);
                    $ext = end($t26);
                    
                    if(in_array($ext,$arry)){
                        $image_name=$_FILES['galthumb1']['name'][$key];
                        $uploadfile = $uploaddir.$image_name;
                        $uploadfileTable1 = $uploadDBdir.$image_name;
                        $img1up = move_uploaded_file($arrayTemp1,$uploadfile);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $db = array(
                                'thumb'=>$uploadfileTable1
                        );
                        $this->master_db->updateRecord('product_images',$db,$pgold[$key]);
                    }
                        $arrayImag2=$_FILES['galsmall1']['name'][$key];
                    $arrayTemp2=$_FILES['galsmall1']['tmp_name'][$key];
                    $t27 = explode(".", $arrayImag2);
                    $ext2 = end($t27);
                    if(in_array($ext2,$arry)){
                        $image_name2=$_FILES['galsmall1']['name'][$key];
                        $uploadfile2 = $uploaddir.$image_name2;
                        $uploadfileTable2 = $uploadDBdir.$image_name2;
                        $img1up = move_uploaded_file($arrayTemp2,$uploadfile2);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbs = array(
                                'image_path'=>$uploadfileTable2
                        );
                        $this->master_db->updateRecord('product_images',$dbs,$pgold[$key]);
                    }
                   $arrayImage3=$_FILES['galmedium1']['name'][$key];
                        $arrayTemp3=$_FILES['galmedium1']['tmp_name'][$key];
                        $t28 = explode(".", $arrayImage3);
                        $ext3 = end($t28);
                    if(in_array($ext3,$arry)){
                        $image_name3=$_FILES['galmedium1']['name'][$key];
                        $uploadfile3 = $uploaddir.$image_name3;
                        $uploadfileTable3 = $uploadDBdir.$image_name3;
                        $img1up = move_uploaded_file($arrayTemp3,$uploadfile3);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbss = array(
                                'image_medium'=>$uploadfileTable3
                        );
                        $this->master_db->updateRecord('product_images',$dbss,$pgold[$key]);
                    }
                 
                    $arrayImage4=$_FILES['gallarge1']['name'][$key];
                            $arrayTemp4=$_FILES['gallarge1']['tmp_name'][$key];
                            $t29 = explode(".", $arrayImage4);
                        $ext4 = end($t29);
                    
                        if(in_array($ext4,$arry)){
                            $image_name4=$_FILES['gallarge1']['name'][$key];
                            $uploadfile4 = $uploaddir.$image_name4;
                            $uploadfileTable4 = $uploadDBdir.$image_name4;
                            $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                            //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                            
                            $dbsss = array(
                                    'image_large'=>$uploadfileTable4
                            );
                            $this->master_db->updateRecord('product_images',$dbsss,$pgold[$key]);
                        }




                            }else {

                                                             $db = array(
                                'pid'=>$goldp[0]->id,
                                'order_no'=>$value,
                                'thumb'=>0,
                                'image_path'=>0,
                                'image_medium'=>0,
                                'image_large'=>0,
                                'status'=>0,
                                'created_date'=>date('Y-m-d H:i:s'),
                                'modified_date'=>date('Y-m-d H:i:s'),
                                
                                'image_path2'=>0,
                                
                        );
                        $imgid = $this->master_db->insertRecord('product_images',$db);

                                $arrayImage=$_FILES['galthumb1']['name'][$key];
                    $arrayTemp1=$_FILES['galthumb1']['tmp_name'][$key];
                    $t30 = explode(".", $arrayImage);
                    $ext = end($t30);
                    
                    if(in_array($ext,$arry)){
                        $image_name=$_FILES['galthumb1']['name'][$key];
                        $uploadfile = $uploaddir.$image_name;
                        $uploadfileTable1 = $uploadDBdir.$image_name;
                        $img1up = move_uploaded_file($arrayTemp1,$uploadfile);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $db = array(
                                'thumb'=>$uploadfileTable1
                        );
                        $this->master_db->updateRecord('product_images',$db,$imgid);
                    }

                            $arrayImag2=$_FILES['galsmall1']['name'][$key];
                    $arrayTemp2=$_FILES['galsmall1']['tmp_name'][$key];
                    $t31 = explode(".", $arrayImag2);
                    $ext2 = end($t31);
                    
                    if(in_array($ext2,$arry)){
                        $image_name2=$_FILES['galsmall1']['name'][$key];
                        $uploadfile2 = $uploaddir.$image_name2;
                        $uploadfileTable2 = $uploadDBdir.$image_name2;
                        $img1up = move_uploaded_file($arrayTemp2,$uploadfile2);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbs = array(
                                'image_path'=>$uploadfileTable2
                        );
                        $this->master_db->updateRecord('product_images',$dbs,$imgid);
                    }


                            $arrayImage3=$_FILES['galmedium1']['name'][$key];
                    $arrayTemp3=$_FILES['galmedium1']['tmp_name'][$key];
                    $t32 = explode(".", $arrayImage3);
                    $ext3 = end($t32);
                    
                    if(in_array($ext3,$arry)){
                        $image_name3=$_FILES['galmedium1']['name'][$key];
                        $uploadfile3 = $uploaddir.$image_name3;
                        $uploadfileTable3 = $uploadDBdir.$image_name3;
                        $img1up = move_uploaded_file($arrayTemp3,$uploadfile3);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbss = array(
                                'image_medium'=>$uploadfileTable3
                        );
                        $this->master_db->updateRecord('product_images',$dbss,$imgid);
                    }


                    $arrayImage4=$_FILES['gallarge1']['name'][$key];
                    $arrayTemp4=$_FILES['gallarge1']['tmp_name'][$key];
                    $t33 = explode(".", $arrayImage4);
                    $ext4 = end($t33);
                    
                    if(in_array($ext4,$arry)){
                        $image_name4=$_FILES['gallarge1']['name'][$key];
                        $uploadfile4 = $uploaddir.$image_name4;
                        $uploadfileTable4 = $uploadDBdir.$image_name4;
                        $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsss = array(
                                'image_large'=>$uploadfileTable4
                        );
                        $this->master_db->updateRecord('product_images',$dbsss,$imgid);
                    }



                            }
                        }

                   
                  }
             
                }
                if($pack ==2) {
                    $silverp = $this->master_db->sqlExecute('select * from productpackage where pid='.$pid.' and package_id=2');
                    $silverimg = $this->master_db->sqlExecute('select id,pid from product_images where pid='.$silverp[0]->id.'');
                   $pcode2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pcode2', true))));
            $mrp2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mrp2', true))));
            $sellingprice2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sellingprice2', true))));
            $stock2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('stock2', true))));
            $overview2 = $this->input->post('overview2');
            $mtdesc = $this->input->post('mtdesc2');
            $orderno2 = $this->input->post('orderno2');         
            $sname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sname2', true))));
            $svalue = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('svalue2', true))));
            $sizes2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sizes2', true))));
            $psilver = $this->input->post('psilver');
            $youtube3 =$this->input->post('youtube3');
             $howtouse3 =$this->input->post('howtouse3');
                
          
                $p1['pid'] = $pid;
            $p1['pcode'] = $pcode2;
            $p1['mrp'] = $mrp2;
            $p1['sellingprice'] = $sellingprice2;
            $p1['stock'] = $stock2;
            $p1['overview'] = $overview2;
            $p1['mdesc'] = $mtdesc;
            $p1['sname'] = $sname;
            $p1['svalue'] = $svalue;
             if(!empty($sizes2)) {
                $p1['psize'] = $sizes2;  
            }
           
            $p1['modified_date'] = date('Y-m-d H:i:s');
            $p1['how_to_use'] = $howtouse3;
            $p1['youtube'] = $youtube3;
            $p = $this->master_db->updateRecord('productpackage',$p1,$silverp[0]->id);

               foreach ($_FILES['galthumb2']['name'] as $key => $value) {
                
                    if($_FILES['galthumb2']['name'][$key] !="" || $_FILES['galsmall2']['name'][$key]!="" || $_FILES['galmedium2']['name'][$key] !=""  || $_FILES['gallarge2']['name'][$key] !="") {
                        if(isset($this->input->post('psilver')[$key])) {
                                       $arrayImage10=$_FILES['galthumb2']['name'][$key];
                    $arrayTemp10=$_FILES['galthumb2']['tmp_name'][$key];
                    $t34 = explode(".", $arrayImage10);
                    $ext10 = end($t34);
                    
                    if(in_array($ext10,$arry)){
                        $image_name10=$_FILES['galthumb2']['name'][$key];
                        $uploadfile10 = $uploaddir.$image_name10;
                        $uploadfileTable10 = $uploadDBdir.$image_name10;
                        $img1up = move_uploaded_file($arrayTemp10,$uploadfile10);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbgp = array(
                                'thumb'=>$uploadfileTable10
                        );
                        $this->master_db->updateRecord('product_images',$dbgp,$psilver[$key]);
                    }


                             $arrayImag11=$_FILES['galsmall2']['name'][$key];
                    $arrayTemp11=$_FILES['galsmall2']['tmp_name'][$key];
                    $t36 = explode(".", $arrayImag11);
                    $ext11 = end($t36);
                    
                    if(in_array($ext11,$arry)){
                        $image_name11=$_FILES['galsmall2']['name'][$key];
                        $uploadfile11 = $uploaddir.$image_name11;
                        $uploadfileTable11 = $uploadDBdir.$image_name11;
                        $img1up = move_uploaded_file($arrayTemp11,$uploadfile11);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsp = array(
                                'image_path'=>$uploadfileTable11
                        );
                        $this->master_db->updateRecord('product_images',$dbsp,$psilver[$key]);
                    }


                            $arrayImage12=$_FILES['galmedium2']['name'][$key];
                    $arrayTemp12=$_FILES['galmedium2']['tmp_name'][$key];
                    $t37 = explode(".", $arrayImage12);
                    $ext12 = end($t37);
                    
                    if(in_array($ext12,$arry)){
                        $image_name12=$_FILES['galmedium2']['name'][$key];
                        $uploadfile12 = $uploaddir.$image_name12;
                        $uploadfileTable12 = $uploadDBdir.$image_name12;
                        $img1up = move_uploaded_file($arrayTemp12,$uploadfile12);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbss = array(
                                'image_medium'=>$uploadfileTable12
                        );
                        $this->master_db->updateRecord('product_images',$dbss,$psilver[$key]);
                    }


                            $arrayImage4=$_FILES['gallarge2']['name'][$key];
                    $arrayTemp4=$_FILES['gallarge2']['tmp_name'][$key];
                    $t38 = explode(".", $arrayImage4);
                    $ext4 = end($t38);
                    
                    if(in_array($ext4,$arry)){
                        $image_name4=$_FILES['gallarge2']['name'][$key];
                        $uploadfile4 = $uploaddir.$image_name4;
                        $uploadfileTable4 = $uploadDBdir.$image_name4;
                        $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsss = array(
                                'image_large'=>$uploadfileTable4
                        );
                        $this->master_db->updateRecord('product_images',$dbsss,$psilver[$key]);
                    }


                        }else {
                                $db = array(
                                'pid'=>$silverp[0]->id,
                                'order_no'=>$value,
                                
                                'thumb'=>0,
                                'image_path'=>0,
                                'image_medium'=>0,
                                'image_large'=>0,
                                'status'=>0,
                                'created_date'=>date('Y-m-d H:i:s'),
                                'modified_date'=>date('Y-m-d H:i:s'),
                                
                                'image_path2'=>0,
                                
                        );
                        $imgid = $this->master_db->insertRecord('product_images',$db);

                                $arrayImage10=$_FILES['galthumb2']['name'][$key];
                    $arrayTemp10=$_FILES['galthumb2']['tmp_name'][$key];
                    $t39 = explode(".", $arrayImage10);
                    $ext10 = end($t39);
                    
                    if(in_array($ext10,$arry)){
                        $image_name10=$_FILES['galthumb2']['name'][$key];
                        $uploadfile10 = $uploaddir.$image_name10;
                        $uploadfileTable10 = $uploadDBdir.$image_name10;
                        $img1up = move_uploaded_file($arrayTemp10,$uploadfile10);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbgp = array(
                                'thumb'=>$uploadfileTable10
                        );
                        $this->master_db->updateRecord('product_images',$dbgp,$imgid);
                    }

                            $arrayImag11=$_FILES['galsmall2']['name'][$key];
                    $arrayTemp11=$_FILES['galsmall2']['tmp_name'][$key];
                    $t40 = explode(".", $arrayImag11);
                    $ext11 = end($t40);
                    
                    if(in_array($ext11,$arry)){
                        $image_name11=$_FILES['galsmall2']['name'][$key];
                        $uploadfile11 = $uploaddir.$image_name11;
                        $uploadfileTable11 = $uploadDBdir.$image_name11;
                        $img1up = move_uploaded_file($arrayTemp11,$uploadfile11);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsp = array(
                                'image_path'=>$uploadfileTable11
                        );
                        $this->master_db->updateRecord('product_images',$dbsp,$imgid);
                    }


                            $arrayImage12=$_FILES['galmedium2']['name'][$key];
                    $arrayTemp12=$_FILES['galmedium2']['tmp_name'][$key];
                    $t41 = explode(".", $arrayImage12);
                    $ext12 = end($t41);
                    
                    if(in_array($ext12,$arry)){
                        $image_name12=$_FILES['galmedium2']['name'][$key];
                        $uploadfile12 = $uploaddir.$image_name3;
                        $uploadfileTable12 = $uploadDBdir.$image_name12;
                        $img1up = move_uploaded_file($arrayTemp12,$uploadfile12);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbss = array(
                                'image_medium'=>$uploadfileTable12
                        );
                        $this->master_db->updateRecord('product_images',$dbss,$imgid);
                    }


                            $arrayImage4=$_FILES['gallarge2']['name'][$key];
                    $arrayTemp4=$_FILES['gallarge2']['tmp_name'][$key];
                    $t42 = explode(".", $arrayImage4);
                    $ext4 = end($t42);
                    
                    if(in_array($ext4,$arry)){
                        $image_name4=$_FILES['gallarge2']['name'][$key];
                        $uploadfile4 = $uploaddir.$image_name4;
                        $uploadfileTable4 = $uploadDBdir.$image_name4;
                        $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsss = array(
                                'image_large'=>$uploadfileTable4
                        );
                        $this->master_db->updateRecord('product_images',$dbsss,$imgid);
                    }


                        }
                    }
                     

                           
               }
       


                }

                if($pack ==3) {
                    $normalp = $this->master_db->sqlExecute('select * from productpackage where pid='.$pid.' and package_id=3');
                    $silverimg = $this->master_db->sqlExecute('select id,pid from product_images where pid='.$normalp[0]->id.'');
                    //echo $this->db->last_query();exit;
                                        $pcode3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pcode3', true))));
            $mrp3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('mrp3', true))));
            $sellingprice3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sellingprice3', true))));
            $stock3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('stock3', true))));
            $overview3 = $this->input->post('overview3');
            $mtdesc = $this->input->post('mtdesc3');
            $orderno3 = $this->input->post('orderno3');
            $sname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sname3', true))));
            $svalue = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('svalue3', true))));
            $sizes3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('sizes3', true))));
             $youtube4 =$this->input->post('youtube4');
             $howtouse4 =$this->input->post('howtouse4');
                
           $pnormal = $this->input->post('pnormal');
                    $p1['pid'] = $pid;
            $p1['pcode'] = $pcode3;
            $p1['mrp'] = $mrp3;
            $p1['sellingprice'] = $sellingprice3;
            $p1['stock'] = $stock3;
            $p1['overview'] = $overview3;
            $p1['mdesc'] = $mtdesc;
            $p1['sname'] = $sname;
            $p1['svalue'] = $svalue;
             if(!empty($sizes3)) {
                $p1['psize'] = $sizes3;  
            }
            
            $p1['modified_date'] = date('Y-m-d H:i:s');
            $p1['how_to_use'] = $howtouse4;
            $p1['youtube'] = $youtube4;
          $p =  $this->master_db->updateRecord('productpackage',$p1, $normalp[0]->id);


               foreach($_FILES['galthumb3']['name'] as $key => $value) {
                      

                      if($_FILES['galthumb3']['name'][$key] !="" || $_FILES['galsmall3']['name'][$key]!="" ||  $_FILES['galmedium3']['name'][$key] !="" || $_FILES['gallarge3']['name'][$key]!="") {
                        if(isset($this->input->post('pnormal')[$key])) {
                            $arrayImage100=$_FILES['galthumb3']['name'][$key];
                    $arrayTemp100=$_FILES['galthumb3']['tmp_name'][$key];
                    $t43 = explode(".", $arrayImage100);
                    $ext100 = end($t43);
                    
                    if(in_array($ext100,$arry)){
                        $image_name100=$_FILES['galthumb3']['name'][$key];
                        $uploadfile100 = $uploaddir.$image_name100;
                        $uploadfileTable100 = $uploadDBdir.$image_name100;
                        $img1up = move_uploaded_file($arrayTemp100,$uploadfile100);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $db = array(
                                'thumb'=>$uploadfileTable100
                        );
                        $this->master_db->updateRecord('product_images',$db,$pnormal[$key]);
                    }

                            $arrayImag2=$_FILES['galsmall3']['name'][$key];
                    $arrayTemp2=$_FILES['galsmall3']['tmp_name'][$key];
                    $t44 = explode(".", $arrayImag2);
                    $ext2 = end($t44);
                    
                    if(in_array($ext2,$arry)){
                        $image_name2=$_FILES['galsmall3']['name'][$key];
                        $uploadfile2 = $uploaddir.$image_name2;
                        $uploadfileTable2 = $uploadDBdir.$image_name2;
                        $img1up = move_uploaded_file($arrayTemp2,$uploadfile2);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbs = array(
                                'image_path'=>$uploadfileTable2
                        );
                        $this->master_db->updateRecord('product_images',$dbs,$pnormal[$key]);
                    }


                            $arrayImage3=$_FILES['galmedium3']['name'][$key];
                    $arrayTemp3=$_FILES['galmedium3']['tmp_name'][$key];
                    $t45 = explode(".", $arrayImage3);
                    $ext3 = end($t45);
                    
                    if(in_array($ext3,$arry)){
                        $image_name3=$_FILES['galmedium3']['name'][$key];
                        $uploadfile3 = $uploaddir.$image_name3;
                        $uploadfileTable3 = $uploadDBdir.$image_name3;
                        $img1up = move_uploaded_file($arrayTemp3,$uploadfile3);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbss = array(
                                'image_medium'=>$uploadfileTable3
                        );
                        $this->master_db->updateRecord('product_images',$dbss,$pnormal[$key]);
                    }


                            $arrayImage4=$_FILES['gallarge3']['name'][$key];
                    $arrayTemp4=$_FILES['gallarge3']['tmp_name'][$key];
                    $t46 = explode(".", $arrayImage4);
                    $ext4 = end($t46);
                    
                    if(in_array($ext4,$arry)){
                        $image_name4=$_FILES['gallarge3']['name'][$key];
                        $uploadfile4 = $uploaddir.$image_name4;
                        $uploadfileTable4 = $uploadDBdir.$image_name4;
                        $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsss = array(
                                'image_large'=>$uploadfileTable4
                        );
                        $this->master_db->updateRecord('product_images',$dbsss,$pnormal[$key]);
                    }


                        }else {
                                                                      $db = array(
                                'pid'=>$normalp[0]->id,
                                'order_no'=>$value,
                                'thumb'=>0,
                                'image_path'=>0,
                                'image_medium'=>0,
                                'image_large'=>0,
                                'status'=>0,
                                'created_date'=>date('Y-m-d H:i:s'),
                                'modified_date'=>date('Y-m-d H:i:s'),
                                'image_path2'=>0,
                                
                        );
                        $imgid = $this->master_db->insertRecord('product_images',$db);

                    $arrayImage100=$_FILES['galthumb3']['name'][$key];
                    $arrayTemp100=$_FILES['galthumb3']['tmp_name'][$key];
                    $t47 = explode(".", $arrayImage100);
                    $ext100 = end($t47);
                    
                    if(in_array($ext100,$arry)){
                        $image_name100=$_FILES['galthumb3']['name'][$key];
                        $uploadfile100 = $uploaddir.$image_name100;
                        $uploadfileTable100 = $uploadDBdir.$image_name100;
                        $img1up = move_uploaded_file($arrayTemp100,$uploadfile100);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $db = array(
                                'thumb'=>$uploadfileTable100
                        );
                        $this->master_db->updateRecord('product_images',$db,$imgid);
                    }

                            $arrayImag2=$_FILES['galsmall3']['name'][$key];
                    $arrayTemp2=$_FILES['galsmall3']['tmp_name'][$key];
                    $t48 = explode(".", $arrayImag2);
                    $ext2 = end($t48);
                    
                    if(in_array($ext2,$arry)){
                        $image_name2=$_FILES['galsmall3']['name'][$key];
                        $uploadfile2 = $uploaddir.$image_name2;
                        $uploadfileTable2 = $uploadDBdir.$image_name2;
                        $img1up = move_uploaded_file($arrayTemp2,$uploadfile2);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbs = array(
                                'image_path'=>$uploadfileTable2
                        );
                        $this->master_db->updateRecord('product_images',$dbs,$imgid);
                    }


                            $arrayImage3=$_FILES['galmedium3']['name'][$key];
                    $arrayTemp3=$_FILES['galmedium3']['tmp_name'][$key];
                    $t49 = explode(".", $arrayImage3);
                    $ext3 = end($t49);
                    
                    if(in_array($ext3,$arry)){
                        $image_name3=$_FILES['galmedium3']['name'][$key];
                        $uploadfile3 = $uploaddir.$image_name3;
                        $uploadfileTable3 = $uploadDBdir.$image_name3;
                        $img1up = move_uploaded_file($arrayTemp3,$uploadfile3);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbss = array(
                                'image_medium'=>$uploadfileTable3
                        );
                        $this->master_db->updateRecord('product_images',$dbss,$imgid);
                    }


                            $arrayImage4=$_FILES['gallarge3']['name'][$key];
                    $arrayTemp4=$_FILES['gallarge3']['tmp_name'][$key];
                    $t50 = explode(".", $arrayImage4);
                    $ext4 = end($t50);
                    
                    if(in_array($ext4,$arry)){
                        $image_name4=$_FILES['gallarge3']['name'][$key];
                        $uploadfile4 = $uploaddir.$image_name4;
                        $uploadfileTable4 = $uploadDBdir.$image_name4;
                        $img1up = move_uploaded_file($arrayTemp4,$uploadfile4);
                        //$this->home_db->resizeImagef($uploadfileTable1, 200, 240);
                        
                        $dbsss = array(
                                'image_large'=>$uploadfileTable4
                        );
                        $this->master_db->updateRecord('product_images',$dbsss,$imgid);
                    }


  
                        }
                    }

                    
               }




                }
              }
        }
     
        echo json_encode(['status'=>'success','pdata'=>'Product updated successfully']);
        $this->session->set_userdata('message','Product updated successfully');
   }

   public function productimagesd() {
    $id = $this->input->post('piid');
    $del = $this->master_db->deleterecordss('product_images',array("id"=>$id));
    if($del) {
       echo json_encode(['status'=>'success']);
    }else {
        echo json_encode(['status'=>'failure','pdata'=>'Error in deleting images']);
    }

   }

   public function upanayana() {
        $this->load->view('upanayana',$this->data);
   }
   public function getupanayana() {
    $det = $this->data['detail'];
        $post=$this->input->post(NULL,TRUE);
        $where =' WHERE status !=2';
    
   
         if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (name like '%$val%') ";
                $where .= " or (fname like '%$val%') ";
                $where .= " or (mphone like '%$val%')  ";
                $where .= " or (rashi like '%$val%')  ";
                $where .= " or (nakshatra like '%$val%')  ";
                $where .= " or (gotra like '%$val%')  ";
                $where .= " or (address like '%$val%')  ";
                $where .= " or (comments like '%$val%')  ";
                $where .= " or (registerno like '%$val%')  ";
            }
            $order_by_arr[] = "name";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by id desc";
        
     $query = "select * from upanayana ".$where."";         
            $fetchdata = $this->master_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
        //$fetch_data = $this->master_db->getproduct($db);
    //echo $this->db->last_query();exit;
        $data = array();
        $i = $_POST["start"]+1;

        foreach($fetchdata as $b)
        {
        $image="<img src='".front_url()."".$b->image."' width='100px'>";   
            $sub_array = array();
            $sub_array[] = $i++;
            $sub_array[] = $b->name;
            $sub_array[] = $b->fname;
            $sub_array[] = $b->rashi;
            $sub_array[] = $b->nakshatra;
            $sub_array[] = $b->gotra;
            $sub_array[] = $b->mphone;
            $sub_array[] = $b->registerno;
            $sub_array[] = $b->address;
            $sub_array[] = $b->dob;
            $sub_array[] = $b->comments;
            $sub_array[] = date('d-m-Y',strtotime($b->created_date));
           $sub_array[] = $image;
           
            // $sub_array[] = $b->mname;
            // $sub_array[] = $b->coname;
            // $sub_array[] = $b->sname;
            $data[] = $sub_array;
             
        }
        $stdcnt =$this->master_db->run_manual_query_result($query);
        $total = count($stdcnt);
        $output = array(
            "draw"                    =>     intval($_POST["draw"]),
            "recordsTotal"          =>      $total,
            "recordsFiltered"     =>     $total,//$this->master_db->get_filtered_data("guards")
            "data"                    =>     $data
        );
        echo json_encode($output);
   }

   public function releaseorder() {
        $this->load->view('releaseorder',$this->data);
   }

    public function releaseorder_add() {
        $this->data['type'] = 'add';
        $this->load->view('releaseorder_add',$this->data);
   }
   public function releaseordersave() {
     //echo "<pre>";print_r($_POST);print_r($_FILES);exit;
    $name = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('name'))));
    $designation = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('designation'))));
    $cno = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('cno'))));
    $client = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('client'))));
    $gstno = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('gstno'))));
    $addr = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('addr'))));
    $email = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('email'))));
    $web = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('web'))));
    $m = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('m'))));
    $bookedby = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('bookedby'))));
    $rono = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('rono'))));
    $adcap = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('adcap'))));
    $dur = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('dur'))));
    $noofinsertion = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('noofinsertion'))));
    $totalfct = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('totalfct'))));
    $er = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('er'))));
    $lband = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('lband'))));
    $astonband = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('astonband'))));
    $spotros = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('spotros'))));
    $spotrodp = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('spotrodp'))));
    $scroll = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('scroll'))));
    $slot = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('slot'))));
    $others = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('others'))));
    $from = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('from'))));
    $to = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('to'))));
    $tofdays = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('tofdays'))));
    $total = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('total'))));
    $ros = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('ros'))));
    $rodp = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('rodp'))));
    $prog = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('prog'))));
    $rodptimings = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('rodptimings'))));
    $byhand = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('byhand'))));
    $byemail = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('byemail'))));
    $photoe = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('photoe'))));
    $asenclosed = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('asenclosed'))));
    $specialins = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('specialins'))));
    $valueadded = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('valueadded'))));
    $billmount = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('billmount'))));
    $gst = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('gst'))));
    $deduction = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('deduction'))));
    $totalpay = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('totalpay'))));
    $chq = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('chq'))));
    $cash = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('cash'))));
    $neft = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('neft'))));
    $upi = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('upi'))));
    $rupees = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('rupees'))));
    $date = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('date'))));
    $place = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('place'))));
    $id = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('id'))));

    $db['name'] = $name;
    $db['designation'] = $designation;
    $db['cno'] = $cno;
    $db['client'] = $client;
    $db['gstno'] = $gstno;
    $db['addr'] = $addr;
    $db['email'] = $email;
    $db['web'] = $web;
    $db['m'] = $m;
    $db['bookedby'] = $bookedby;
    $db['rono'] = $rono;
    $db['adcap'] = $adcap;
    $db['dur'] = $dur;
    $db['noofinsertion'] = $noofinsertion;
    $db['totalfct'] = $totalfct;
    $db['er'] = $er;
    $db['lband'] = $lband;
    $db['astonband'] = $astonband;
    $db['spotros'] = $spotros;
    $db['spotrodp'] = $spotrodp;
    $db['scroll'] = $scroll;
    $db['slot'] = $slot;
    $db['others'] = $others;
    $db['from'] = $from;
    $db['to'] = $to;
    $db['tofdays'] = $tofdays;
    $db['total'] = $total;
    $db['ros'] = $ros;
    $db['rodp'] = $rodp;
    $db['prog'] = $prog;
    $db['rodptimings'] = $rodptimings;
    $db['byhand'] = $byhand;
    $db['byemail'] = $byemail;
    $db['photoe'] = $photoe;
    $db['asenclosed'] = $asenclosed;
    $db['specialins'] = $specialins;
    $db['valueadded'] = $valueadded;
    $db['billmount'] = $billmount;
    $db['gst'] = $gst;
    $db['deduction'] = $deduction;
    $db['totalpay'] = $totalpay;
    $db['chq'] = $chq;
    $db['cash'] = $cash;
    $db['neft'] = $neft;
    $db['upi'] = $upi;
    $db['rupees'] = $rupees;

       if( !empty($_FILES['msign']['name']) ){
                    $config2 = array();
                    $config2['upload_path'] = 'assets/images/';  
                    $config2['allowed_types'] = 'jpeg|jpg|png|PNG';
                    $ext = pathinfo($_FILES["msign"]['name'], PATHINFO_EXTENSION);
                    $new_name = "ayush".rand(11111,99999).'.'.$ext; 
                    $config2['file_name'] = $new_name;
                    
                    //Stored the new name into $config['file_name']
                    $this->load->library('upload', $config2);
                    // Alternately you can set
                    $this->upload->initialize($config2);
                    if (!$this->upload->do_upload('msign') && !empty($_FILES['msign']['name'])) {
                        $error = array('status'=>'failure','mdata' => "<div class='alert alert-danger'>".$this->upload->display_errors()."</div>");
                        echo json_encode($error);exit;
                    } else {
                        $upload_data = $this->upload->data();
                        $db['msign'] = 'assets/images/'.$upload_data['file_name'];
                        //print_r($upload_data);exit;
                    }
                }


                   if( !empty($_FILES['csign']['name']) ){
                    $config3 = array();
                    $config3['upload_path'] = 'assets/images/';  
                    $config3['allowed_types'] = 'jpeg|jpg|png|PNG';
                    $ext = pathinfo($_FILES["csign"]['name'], PATHINFO_EXTENSION);
                    $new_name = "ayush".rand(11111,99999).'.'.$ext; 
                    $config3['file_name'] = $new_name;
                    
                    //Stored the new name into $config['file_name']
                    $this->load->library('upload', $config3);
                    // Alternately you can set
                    $this->upload->initialize($config3);
                    if (!$this->upload->do_upload('csign') && !empty($_FILES['csign']['name'])) {
                        $error = array('status'=>'failure','mdata' => "<div class='alert alert-danger'>".$this->upload->display_errors()."</div>");
                        echo json_encode($error);exit;
                    } else {
                        $upload_data = $this->upload->data();
                        $db['csign'] = 'assets/images/'.$upload_data['file_name'];
                        //print_r($upload_data);exit;
                    }
                }
    $db['status'] = 0;

    if(!empty($id) && $id !="") {
             $update = $this->master_db->updateRecord('releaseorder',$db,$id);
         if($update) {
            $this->session->set_flashdata('message','<div class="alert alert-success">Updated successfully</div>');
            redirect('master/releaseorder');
        }else {
            $this->session->set_flashdata('message','<div class="alert alert-danger">Error in updating</div>');
            redirect('master/releaseorder');
        } 
    }else {
        $db['created_at'] = date('Y-m-d H:i:s'); 
        $ins = $this->master_db->insertRecord('releaseorder',$db);
         if($ins) {
            $this->session->set_flashdata('message','<div class="alert alert-success">Inserted successfully</div>');
            redirect('master/releaseorder');
        }else {
            $this->session->set_flashdata('message','<div class="alert alert-danger">Error in inserting</div>');
            redirect('master/releaseorder');
        } 
    }
    

    
     
}

public function releaseorder_list() {
    $det = $this->data['detail'];
        $post=$this->input->post(NULL,TRUE);
        $where =' WHERE status !=2';
    
   
         if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (name like '%$val%') ";
                $where .= " or (designation like '%$val%') ";
                $where .= " or (cno like '%$val%')  ";
                $where .= " or (client like '%$val%')  ";
                $where .= " or (gstno like '%$val%')  ";
                $where .= " or (addr like '%$val%')  ";
                $where .= " or (email like '%$val%')  ";
                $where .= " or (web like '%$val%')  ";
                $where .= " or (m like '%$val%')  ";
                $where .= " or (bookedby like '%$val%')  ";
                $where .= " or (rono like '%$val%')  ";
                $where .= " or (adcap like '%$val%')  ";
                $where .= " or (dur like '%$val%')  ";
                $where .= " or (noofinsertion like '%$val%')  ";
                $where .= " or (totalfct like '%$val%')  ";
                $where .= " or (er like '%$val%')  ";
                $where .= " or (lband like '%$val%')  ";
                $where .= " or (astonband like '%$val%')  ";
                $where .= " or (spotros like '%$val%')  ";
                $where .= " or (spotrodp like '%$val%')  ";
                $where .= " or (scroll like '%$val%')  ";
                $where .= " or (slot like '%$val%')  ";
                $where .= " or (others like '%$val%')  ";
                $where .= " or (from like '%$val%')  ";
                $where .= " or (to like '%$val%')  ";
                $where .= " or (tofdays like '%$val%')  ";
                $where .= " or (total like '%$val%')  ";
                $where .= " or (ros like '%$val%')  ";
                $where .= " or (rodp like '%$val%')  ";
                $where .= " or (prog like '%$val%')  ";
                $where .= " or (rodptimings like '%$val%')  ";
                $where .= " or (byhand like '%$val%')  ";
                $where .= " or (byemail like '%$val%')  ";
                $where .= " or (photoe like '%$val%')  ";
                $where .= " or (asenclosed like '%$val%')  ";
                $where .= " or (specialins like '%$val%')  ";
                $where .= " or (valueadded like '%$val%')  ";
                $where .= " or (billmount like '%$val%')  ";
                $where .= " or (gst like '%$val%')  ";
                $where .= " or (deduction like '%$val%')  ";
                $where .= " or (totalpay like '%$val%')  ";
                $where .= " or (chq like '%$val%')  ";
                $where .= " or (cash like '%$val%')  ";
                $where .= " or (neft like '%$val%')  ";
                $where .= " or (upi like '%$val%')  ";
                $where .= " or (rupees like '%$val%')  ";
            }
            $order_by_arr[] = "name";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by id desc";
        
     $query = "select * from releaseorder ".$where."";         
            $fetchdata = $this->master_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
        //$fetch_data = $this->master_db->getproduct($db);
    //echo $this->db->last_query();exit;
        $data = array();
        $i = $_POST["start"]+1;

        foreach($fetchdata as $b)
        {
 $action =' <a href="'.base_url()."master/edit_releaseorder/".$b->id."".'" class="btn btn-circle btn-info" title="Edit" ><i class="mdi mdi-border-color"></i></a>';            
            $sub_array = array();
            $sub_array[] = $i++;
            $sub_array[] =$action;
            $sub_array[] = $b->name;
            $sub_array[] = $b->designation;
            $sub_array[] = $b->cno;
            $sub_array[] = $b->client;
            $sub_array[] = $b->gstno;
            $sub_array[] = $b->addr;
            $sub_array[] = $b->email;
            $sub_array[] = $b->web;
            $sub_array[] = $b->bookedby;
            $sub_array[] = $b->adcap;
            $sub_array[] = $b->dur;
            $sub_array[] = $b->noofinsertion;
            $sub_array[] = $b->totalfct;
            $sub_array[] = $b->er;
            $sub_array[] = $b->from;
            $sub_array[] = $b->tofdays;
            $sub_array[] = $b->ros;
            $sub_array[] = $b->rodp;
            $sub_array[] = $b->prog;
            $sub_array[] = $b->rodptimings;
            $sub_array[] = $b->byhand;
            $sub_array[] = $b->byemail;
            $sub_array[] = $b->photoe;
            $sub_array[] = $b->asenclosed;
            $sub_array[] = $b->specialins;
            $sub_array[] = $b->valueadded;
            $sub_array[] = $b->billmount;
            $sub_array[] = $b->gst;
            $sub_array[] = $b->deduction;
            $sub_array[] = $b->totalpay;
            $sub_array[] = $b->chq;
            $sub_array[] = $b->cash;
            $sub_array[] = $b->neft;
            $sub_array[] = $b->upi;
            $sub_array[] = $b->rupees;
            $sub_array[] = date('d-m-Y',strtotime($b->created_at));
            $data[] = $sub_array;
             
        }
        $stdcnt =$this->master_db->run_manual_query_result($query);
        $total = count($stdcnt);
        $output = array(
            "draw"                    =>     intval($_POST["draw"]),
            "recordsTotal"          =>      $total,
            "recordsFiltered"     =>     $total,//$this->master_db->get_filtered_data("guards")
            "data"                    =>     $data
        );
        echo json_encode($output);
   }

   public function edit_releaseorder() {
        $id = $this->uri->segment(3);
        $this->data['releasedata'] = $this->master_db->getRecords('releaseorder',['id'=>$id],'*');
        $this->data['type'] = 'edit';
        $this->load->view('releaseorder_add',$this->data);
   }
   public function templedetails() {
    $this->data['category'] = $this->load->view('templegallery', $this->data, TRUE);
    $this->load->view('templedetails',$this->data) ;
   }
   public function viewgallery() {
    //echo "<pre>";print_r($_POST);exit;
        $id = $this->input->post('id');
        $getGal =  $this->master_db->getRecords('temple_photos',['tid'=>$id],'gallery');
        if(count($getGal) >0) {
                $this->data['gallery'] =  $getGal;
               $html =  $this->load->view('showgalleryview',$this->data,true);
               echo json_encode(['status'=>true,'msg'=>$html]);
        }else {
            echo json_encode(['status'=>false,'msg'=>'No data found']);
        }


   }
   /********* Add Diet ********/
   public function diet() {
        $this->data['diet'] = $this->load->view('masters/diet/getdiet', $this->data, TRUE);
       $this->load->view('masters/diet/diet', $this->data);
   }
   public function adddiet() {
    $this->load->view('masters/diet/dietadd', $this->data);
   }
    public function dietsave() {
        //echo "<pre>";print_r($_POST);exit;
        $this->load->library('form_validation');
        $cid = trim($this->input->post('cid'));
        $this->form_validation->set_rules('title','Title','required',['required'=>'Title is required','regex_match'=>'Only characters and numbers are allowed and spaces are not allowed']);
        if(!empty($cid)) {

        }else {
            if(empty($_FILES['pdf']['name'][0])) {
            $this->form_validation->set_rules('pdf','Pdf','required',['required'=>'PDF is required']);
            }
        }
        
         if($this->form_validation->run() ==TRUE) {
          
            $cid = trim($this->input->post('cid'));
            $title = trim($this->input->post('title'));
           
            if(!empty($cid)) {
                  $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'pdf|PDF';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"PDF File : ".$this->upload->display_errors()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['pdf_link'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                $db['modified_at'] = date('Y-m-d H:i:s');
                $update = $this->master_db->updateRecord('diet',$db,['did'=>$cid]);
                  if($update >0) {
                        $resul = array('status'   => true, 'msg' =>'Updated successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }else {
                $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'pdf|PDF';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"PDF File : ".$this->upload->display_errors(),'csrf_token'=> $this->security->get_csrf_hash()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['pdf_link'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                $db['created_at'] = date('Y-m-d H:i:s');
                $res=$this->master_db->insertRecord('diet',$db);
                if($res >0) {
                        $resul = array('status'   => true, 'msg' =>'Inserted successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }
           
         }else {
                $resul = array(
                     'formerror'   => false,
                    'title_error' => form_error('title'),
                    'pdf_error' => form_error('pdf')
                );
         }
         echo json_encode($resul);
    }
    public function diet_status()
    {
        $items = $this->input->post('items');
        $status = $this->input->post('status');
        $db=array(
        'status'=>$status,
        'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('diet',$db,['did'=>$items]);
        if($status == 2)
        {
            $this->master_db->deleterecordss('diet',array("did"=>$items));
        }
        $this->data['category'] = $this->load->view('masters/diet/getdiet', $this->data ,TRUE);
        echo $this->data['category'];
    }
    public function diet_edit() {
        $id=$this->input->get('id');
        if(isset($id)) {
            $this->data['edit'] = $this->master_db->getRecords('diet',['did'=>$id],'*');
            $this->load->view('masters/diet/editdiet',$this->data);
        }else {
            redirect(base_url().'master/diet');
        }
    }

    /******** Diy ***********/
   public function diy() {
    $this->data['diet'] = $this->load->view('masters/diy/getdiy', $this->data, TRUE);
       $this->load->view('masters/diy/diy', $this->data);
   }
   public function adddiy() {
    $this->load->view('masters/diy/diyadd', $this->data);
   }
    public function diy_edit() {
        $id=$this->input->get('id');
        if(isset($id)) {
            $this->data['edit'] = $this->master_db->getRecords('diy',['diy_id'=>$id],'*');
            $this->load->view('masters/diy/editdiy',$this->data);
        }else {
            redirect(base_url().'master/diy');
        }
    }
     public function diysave() {
        //echo "<pre>";print_r($_POST);exit;
        $this->load->library('form_validation');
        $cid = trim($this->input->post('cid'));
        $this->form_validation->set_rules('title','Title','required',['required'=>'Title is required','regex_match'=>'Only characters and numbers are allowed and spaces are not allowed']);
        if(!empty($cid)) {

        }else {
            
            $this->form_validation->set_rules('link','Description','required',['required'=>'Description is required']);
           
        }
        
         if($this->form_validation->run() ==TRUE) {
          
            $cid = trim($this->input->post('cid'));
            $title = trim($this->input->post('title'));
            $link = trim($this->input->post('link'));
           
            if(!empty($cid)) {
                  $db['title'] = $title;
                $db['ldesc'] = $link;
                $db['modified_at'] = date('Y-m-d H:i:s');
                $update = $this->master_db->updateRecord('diy',$db,['diy_id'=>$cid]);
                  if($update >0) {
                        $resul = array('status'   => true, 'msg' =>'Updated successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }else {
                $db['title'] = $title;
               $db['ldesc'] = $link;
                $db['created_at'] = date('Y-m-d H:i:s');
                $res=$this->master_db->insertRecord('diy',$db);
                if($res >0) {
                        $resul = array('status'   => true, 'msg' =>'Inserted successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }
           
         }else {
                $resul = array(
                     'formerror'   => false,
                    'title_error' => form_error('title'),
                    'pdf_error' => form_error('link')
                );
         }
         echo json_encode($resul);
    }

    public function diy_status()
    {
        $items = $this->input->post('items');
        $status = $this->input->post('status');
        $db=array(
        'status'=>$status,
        'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('diy',$db,['diy_id'=>$items]);
        if($status == 2)
        {
            $this->master_db->deleterecordss('diy',array("diy_id"=>$items));
        }
        $this->data['category'] = $this->load->view('masters/diy/getdiy', $this->data ,TRUE);
        echo $this->data['category'];
    }
    /*********** Articles ********/
  public function articles() {
    $this->data['diet'] = $this->load->view('masters/articles/getarticles', $this->data, TRUE);
       $this->load->view('masters/articles/articles', $this->data);
   }
   public function addarticles() {
    $this->load->view('masters/articles/articlesadd', $this->data);
   }
    public function articles_edit() {
        $id=$this->input->get('id');
        if(isset($id)) {
            $this->data['edit'] = $this->master_db->getRecords('articles',['art_id'=>$id],'*');
            $this->load->view('masters/articles/editarticles',$this->data);
        }else {
            redirect(base_url().'master/articles');
        }
    }
     public function articlessave() {
         //echo "<pre>";print_r($_POST);exit;
        $this->load->library('form_validation');
        $cid = trim($this->input->post('cid'));
        $this->form_validation->set_rules('title','Title','required',['required'=>'Title is required','regex_match'=>'Only characters and numbers are allowed and spaces are not allowed']);
        if(!empty($cid)) {

        }else {
            if(empty($_FILES['pdf']['name'][0])) {
            $this->form_validation->set_rules('pdf','Pdf','required',['required'=>'Image is required']);
            }
            // $this->form_validation->set_rules('sdesc','Short description','required',['required'=>'Short description is required']);
            // $this->form_validation->set_rules('ldesc','Long description','required',['required'=>'Long description is required']);
           
        }
        
         if($this->form_validation->run() ==TRUE) {
            $cid = trim($this->input->post('cid'));
            $title = trim($this->input->post('title'));
            $sdesc = trim($this->input->post('sdesc'));
            $ldesc = trim($this->input->post('ldesc'));
            if(!empty($cid)) {
                  $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'jpg|jpeg|png';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"Image : ".$this->upload->display_errors()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['image'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                         // $db['sdesc'] = $sdesc;
                         // $db['ldesc'] = $ldesc;
                $db['modified_at'] = date('Y-m-d H:i:s');
                $update = $this->master_db->updateRecord('articles',$db,['art_id'=>$cid]);
                  if($update >0) {
                        $resul = array('status'   => true, 'msg' =>'Updated successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }else {
                 $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'jpg|jpeg|png';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"Image : ".$this->upload->display_errors()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['image'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                         // $db['sdesc'] = $sdesc;
                         // $db['ldesc'] = $ldesc;
                $db['created_at'] = date('Y-m-d H:i:s');
                $res=$this->master_db->insertRecord('articles',$db);
                if($res >0) {
                        $resul = array('status'   => true, 'msg' =>'Inserted successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }
           
         }else {
                $resul = array(
                     'formerror'   => false,
                    'title_error' => form_error('title'),
                    'pdf_error' => form_error('pdf'),
                    'sdesc_error' => form_error('sdesc'),
                    'ldesc_error' => form_error('ldesc'),

                );
         }
         echo json_encode($resul);
    }

    public function articles_status()
    {
        $items = $this->input->post('items');
        $status = $this->input->post('status');
        $db=array(
        'status'=>$status,
        'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('articles',$db,['art_id'=>$items]);
        if($status == 2)
        {
            $this->master_db->deleterecordss('articles',array("art_id"=>$items));
        }
        $this->data['category'] = $this->load->view('masters/articles/getarticles', $this->data ,TRUE);
        echo $this->data['category'];
    }
   /*********** Herbal ********/
   public function herbal() {
    $this->data['diet'] = $this->load->view('masters/herbal/getherbal', $this->data, TRUE);
       $this->load->view('masters/herbal/herbal', $this->data);
   }
   public function addherbal() {
     $this->load->view('masters/herbal/herbaladd', $this->data);
   }
    public function herbal_edit() {
        $id=$this->input->get('id');
        if(isset($id)) {
            $this->data['edit'] = $this->master_db->getRecords('herbal',['hid'=>$id],'*');
            $this->load->view('masters/herbal/editherbal',$this->data);
        }else {
            redirect(base_url().'master/herbal');
        }
    }
     public function herbalsave() {
         //echo "<pre>";print_r($_POST);exit;
        $this->load->library('form_validation');
        $cid = trim($this->input->post('cid'));
        $this->form_validation->set_rules('title','Title','required',['required'=>'Title is required','regex_match'=>'Only characters and numbers are allowed and spaces are not allowed']);
        if(!empty($cid)) {

        }else {
            if(empty($_FILES['pdf']['name'][0])) {
            $this->form_validation->set_rules('pdf','Pdf','required',['required'=>'PDF is required']);
            }
        }
        
         if($this->form_validation->run() ==TRUE) {
          
            $cid = trim($this->input->post('cid'));
            $title = trim($this->input->post('title'));
           
            if(!empty($cid)) {
                  $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'pdf|PDF';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"PDF File : ".$this->upload->display_errors()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['pdf_link'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                $db['modified_at'] = date('Y-m-d H:i:s');
                $update = $this->master_db->updateRecord('herbal',$db,['hid'=>$cid]);
                  if($update >0) {
                        $resul = array('status'   => true, 'msg' =>'Updated successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }else {
                $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'pdf|PDF';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"PDF File : ".$this->upload->display_errors(),'csrf_token'=> $this->security->get_csrf_hash()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['pdf_link'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                $db['created_at'] = date('Y-m-d H:i:s');
                $res=$this->master_db->insertRecord('herbal',$db);
                if($res >0) {
                        $resul = array('status'   => true, 'msg' =>'Inserted successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }
           
         }else {
                $resul = array(
                     'formerror'   => false,
                    'title_error' => form_error('title'),
                    'pdf_error' => form_error('pdf')
                );
         }
         echo json_encode($resul);
    }

    public function herbal_status()
    {
        $items = $this->input->post('items');
        $status = $this->input->post('status');
        $db=array(
        'status'=>$status,
        'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('herbal',$db,['hid'=>$items]);
        if($status == 2)
        {
            $this->master_db->deleterecordss('herbal',array("hid"=>$items));
        }
        $this->data['category'] = $this->load->view('masters/herbal/getherbal', $this->data ,TRUE);
        echo $this->data['category'];
    }
   /*********** Research ********/
   public function research() {
    $this->data['diet'] = $this->load->view('masters/research/getresearch', $this->data, TRUE);
       $this->load->view('masters/research/research', $this->data);
   }
   public function addresearch() {
    $this->load->view('masters/research/researchadd', $this->data);
   }
    public function research_edit() {
        $id=$this->input->get('id');
        if(isset($id)) {
            $this->data['edit'] = $this->master_db->getRecords('research',['rid'=>$id],'*');
            $this->load->view('masters/research/editresearch',$this->data);
        }else {
            redirect(base_url().'master/research');
        }
    }
     public function researchsave() {
         //echo "<pre>";print_r($_POST);exit;
        $this->load->library('form_validation');
        $cid = trim($this->input->post('cid'));
        $this->form_validation->set_rules('title','Title','required',['required'=>'Title is required','regex_match'=>'Only characters and numbers are allowed and spaces are not allowed']);
        if(!empty($cid)) {

        }else {
            if(empty($_FILES['pdf']['name'][0])) {
            $this->form_validation->set_rules('pdf','Pdf','required',['required'=>'PDF is required']);
            }
        }
        
         if($this->form_validation->run() ==TRUE) {
          
            $cid = trim($this->input->post('cid'));
            $title = trim($this->input->post('title'));
           
            if(!empty($cid)) {
                  $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'pdf|PDF';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"PDF File : ".$this->upload->display_errors()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['pdf_link'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                $db['modified_at'] = date('Y-m-d H:i:s');
                $update = $this->master_db->updateRecord('research',$db,['rid'=>$cid]);
                  if($update >0) {
                        $resul = array('status'   => true, 'msg' =>'Updated successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }else {
                $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'pdf|PDF';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"PDF File : ".$this->upload->display_errors(),'csrf_token'=> $this->security->get_csrf_hash()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['pdf_link'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                $db['created_at'] = date('Y-m-d H:i:s');
                $res=$this->master_db->insertRecord('research',$db);
                if($res >0) {
                        $resul = array('status'   => true, 'msg' =>'Inserted successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }
           
         }else {
                $resul = array(
                     'formerror'   => false,
                    'title_error' => form_error('title'),
                    'pdf_error' => form_error('pdf')
                );
         }
         echo json_encode($resul);
    }

    public function research_status()
    {
        $items = $this->input->post('items');
        $status = $this->input->post('status');
        $db=array(
        'status'=>$status,
        'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('research',$db,['rid'=>$items]);
        if($status == 2)
        {
            $this->master_db->deleterecordss('research',array("rid"=>$items));
        }
        $this->data['category'] = $this->load->view('masters/research/getresearch', $this->data ,TRUE);
        echo $this->data['category'];
    }
   /*********** Awards ********/
   public function awards() {
    $this->data['diet'] = $this->load->view('masters/awards/getawards', $this->data, TRUE);
       $this->load->view('masters/awards/awards', $this->data);
   }
     public function addawards() {
    $this->load->view('masters/awards/awardsadd', $this->data);
   }
    public function awards_edit() {
        $id=$this->input->get('id');
        if(isset($id)) {
            $this->data['edit'] = $this->master_db->getRecords('awards',['aid'=>$id],'*');
            $this->load->view('masters/awards/editawards',$this->data);
        }else {
            redirect(base_url().'master/awards');
        }
    }
     public function awardssave() {
         //echo "<pre>";print_r($_POST);exit;
        $this->load->library('form_validation');
        $cid = trim($this->input->post('cid'));
        $this->form_validation->set_rules('title','Title','required',['required'=>'Title is required','regex_match'=>'Only characters and numbers are allowed and spaces are not allowed']);
        if(!empty($cid)) {

        }else {
            if(empty($_FILES['pdf']['name'][0])) {
            $this->form_validation->set_rules('pdf','Pdf','required',['required'=>'Image is required']);
            }
        }
        
         if($this->form_validation->run() ==TRUE) {
          
            $cid = trim($this->input->post('cid'));
            $title = trim($this->input->post('title'));
           
            if(!empty($cid)) {
                  $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'jpg|jpeg|png';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"PDF File : ".$this->upload->display_errors()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['image'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                $db['modified_at'] = date('Y-m-d H:i:s');
                $update = $this->master_db->updateRecord('awards',$db,['aid'=>$cid]);
                  if($update >0) {
                        $resul = array('status'   => true, 'msg' =>'Updated successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }else {
                $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'jpg|jpeg|png';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"PDF File : ".$this->upload->display_errors(),'csrf_token'=> $this->security->get_csrf_hash()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['image'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                $db['created_at'] = date('Y-m-d H:i:s');
                $res=$this->master_db->insertRecord('awards',$db);
                if($res >0) {
                        $resul = array('status'   => true, 'msg' =>'Inserted successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }
           
         }else {
                $resul = array(
                     'formerror'   => false,
                    'title_error' => form_error('title'),
                    'pdf_error' => form_error('pdf')
                );
         }
         echo json_encode($resul);
    }

    public function awards_status()
    {
        $items = $this->input->post('items');
        $status = $this->input->post('status');
        $db=array(
        'status'=>$status,
        'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('awards',$db,['aid'=>$items]);
        if($status == 2)
        {
            $this->master_db->deleterecordss('awards',array("aid"=>$items));
        }
        $this->data['category'] = $this->load->view('masters/awards/getawards', $this->data ,TRUE);
        echo $this->data['category'];
    }
   /*********** Gallery ********/
    public function gallery() {
    $this->data['diet'] = $this->load->view('masters/gallery/getgallery', $this->data, TRUE);
       $this->load->view('masters/gallery/gallery', $this->data);
   }
   public function galleryadd() {
    $this->load->view('masters/gallery/galleryadd',$this->data);
   }
    public function gallery_edit() {
        $id=$this->input->get('id');
        if(isset($id)) {
            $this->data['edit'] = $this->master_db->getRecords('gallery',['gal_id'=>$id],'*');
            $this->load->view('masters/gallery/editgallery',$this->data);
        }else {
            redirect(base_url().'master/gallery');
        }
    }
     public function gallerysave() {
         //echo "<pre>";print_r($_POST);exit;
        $this->load->library('form_validation');
        $cid = trim($this->input->post('cid'));
        $this->form_validation->set_rules('title','Title','required',['required'=>'Title is required','regex_match'=>'Only characters and numbers are allowed and spaces are not allowed']);
        if(!empty($cid)) {

        }else {
            if(empty($_FILES['pdf']['name'][0])) {
            $this->form_validation->set_rules('pdf','Pdf','required',['required'=>'PDF is required']);
            }
        }
        
         if($this->form_validation->run() ==TRUE) {
          
            $cid = trim($this->input->post('cid'));
            $title = trim($this->input->post('title'));
           
            if(!empty($cid)) {
                  $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'jpg|jpeg|png';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"PDF File : ".$this->upload->display_errors()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['image'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                $db['modified_at'] = date('Y-m-d H:i:s');
                $update = $this->master_db->updateRecord('gallery',$db,['gal_id'=>$cid]);
                  if($update >0) {
                        $resul = array('status'   => true, 'msg' =>'Updated successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }else {
                $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'jpg|jpeg|png';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"PDF File : ".$this->upload->display_errors(),'csrf_token'=> $this->security->get_csrf_hash()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['image'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                $db['created_at'] = date('Y-m-d H:i:s');
                $res=$this->master_db->insertRecord('gallery',$db);
                if($res >0) {
                        $resul = array('status'   => true, 'msg' =>'Inserted successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }
           
         }else {
                $resul = array(
                     'formerror'   => false,
                    'title_error' => form_error('title'),
                    'pdf_error' => form_error('pdf')
                );
         }
         echo json_encode($resul);
    }

    public function gallery_status()
    {
        $items = $this->input->post('items');
        $status = $this->input->post('status');
        $db=array(
        'status'=>$status,
        'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('gallery',$db,['gal_id'=>$items]);
        if($status == 2)
        {
            $this->master_db->deleterecordss('gallery',array("gal_id"=>$items));
        }
        $this->data['category'] = $this->load->view('masters/gallery/getgallery', $this->data ,TRUE);
        echo $this->data['category'];
    }
   
   /*********** Gallery ********/
    public function tests() {
    $this->data['diet'] = $this->load->view('masters/tests/gettests', $this->data, TRUE);
       $this->load->view('masters/tests/tests', $this->data);
   }
     public function addtests() {
    $this->load->view('masters/tests/testsadd', $this->data);
   }
    public function tests_edit() {
        $id=$this->input->get('id');
        if(isset($id)) {
            $this->data['edit'] = $this->master_db->getRecords('tests',['tid'=>$id],'*');
            $this->load->view('masters/tests/edittest',$this->data);
        }else {
            redirect(base_url().'master/tests');
        }
    }
     public function testssave() {
         //echo "<pre>";print_r($_POST);exit;
        $this->load->library('form_validation');
        $cid = trim($this->input->post('cid'));
        $this->form_validation->set_rules('title','Title','required',['required'=>'Title is required','regex_match'=>'Only characters and numbers are allowed and spaces are not allowed']);
       
        
         if($this->form_validation->run() ==TRUE) {
          
            $cid = trim($this->input->post('cid'));
            $title = trim($this->input->post('title'));
           
            if(!empty($cid)) {
                  $db['title'] = $title;
               
                $db['modified_at'] = date('Y-m-d H:i:s');
                $update = $this->master_db->updateRecord('tests',$db,['tid'=>$cid]);
                  if($update >0) {
                        $resul = array('status'   => true, 'msg' =>'Updated successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }else {
                $db['title'] = $title;
                
                $db['created_at'] = date('Y-m-d H:i:s');
                $res=$this->master_db->insertRecord('tests',$db);
                if($res >0) {
                        $resul = array('status'   => true, 'msg' =>'Inserted successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }
           
         }else {
                $resul = array(
                     'formerror'   => false,
                    'title_error' => form_error('title'),
                    'pdf_error' => form_error('pdf')
                );
         }
         echo json_encode($resul);
    }

    public function tests_status()
    {
        $items = $this->input->post('items');
        $status = $this->input->post('status');
        $db=array(
        'status'=>$status,
        'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('tests',$db,['tid'=>$items]);
        if($status == 2)
        {
            $this->master_db->deleterecordss('tests',array("tid"=>$items));
        }
        $this->data['category'] = $this->load->view('masters/tests/gettests', $this->data ,TRUE);
        echo $this->data['category'];
    }
   /*********** Video ********/
    public function video() {
    $this->data['diet'] = $this->load->view('masters/videos/getvideo', $this->data, TRUE);
       $this->load->view('masters/videos/videos', $this->data);
   }
    public function addvideos() {
    $this->load->view('masters/videos/videosadd', $this->data);
   }
    public function videos_edit() {
        $id=$this->input->get('id');
        if(isset($id)) {
            $this->data['edit'] = $this->master_db->getRecords('videos',['vid'=>$id],'*');
            $this->load->view('masters/videos/editvideo',$this->data);
        }else {
            redirect(base_url().'master/video');
        }
    }
     public function videosave() {
         //echo "<pre>";print_r($_POST);exit;
        $this->load->library('form_validation');
        $cid = trim($this->input->post('cid'));
        $this->form_validation->set_rules('title','Title','required',['required'=>'Title is required','regex_match'=>'Please enter title']);
        $this->form_validation->set_rules('url','Youtube link','required|valid_url',['required'=>'Youtube link is required','valid_url'=>'Please enter valid url']);
         if($this->form_validation->run() ==TRUE) {
          
            $cid = trim($this->input->post('cid'));
            $title = trim($this->input->post('title'));
            $url = trim($this->input->post('url'));
           
            if(!empty($cid)) {
                $db['title'] = $title;
                  $db['video_id'] = $url;
               
                $db['modified_at'] = date('Y-m-d H:i:s');
                $update = $this->master_db->updateRecord('videos',$db,['vid'=>$cid]);
                  if($update >0) {
                        $resul = array('status'   => true, 'msg' =>'Updated successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }else {
                 $db['title'] = $title;
                $db['video_id'] = $title;
                
                $db['created_at'] = date('Y-m-d H:i:s');
                $res=$this->master_db->insertRecord('videos',$db);
                if($res >0) {
                        $resul = array('status'   => true, 'msg' =>'Inserted successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }
           
         }else {
                $resul = array(
                     'formerror'   => false,
                    'title_error' => form_error('title'),
                    'url_error' => form_error('url'),
                );
         }
         echo json_encode($resul);
    }

    public function video_status()
    {
        $items = $this->input->post('items');
        $status = $this->input->post('status');
        $db=array(
        'status'=>$status,
        'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('videos',$db,['vid'=>$items]);
        if($status == 2)
        {
            $this->master_db->deleterecordss('videos',array("vid"=>$items));
        }
        $this->data['category'] = $this->load->view('masters/videos/getvideo', $this->data ,TRUE);
        echo $this->data['category'];
    }
       /*********** Treatment ********/
     public function treatment() {
    $this->data['diet'] = $this->load->view('masters/treatment/gettreatment', $this->data, TRUE);
       $this->load->view('masters/treatment/treatment', $this->data);
   }
   public function treatmentadd() {
    $this->load->view('masters/treatment/treatmentadd',$this->data);
   }
    public function treatment_edit() {
        $id=$this->input->get('id');
        if(isset($id)) {
            $this->data['edit'] = $this->master_db->getRecords('treatment',['tid'=>$id],'*');
            $this->load->view('masters/treatment/edittreatment',$this->data);
        }else {
            redirect(base_url().'master/treatment');
        }
    }
     public function treatmentsave() {
         //echo "<pre>";print_r($_POST);exit;
        $this->load->library('form_validation');
        $cid = trim($this->input->post('cid'));
        $this->form_validation->set_rules('title','Title','required',['required'=>'Title is required','regex_match'=>'Only characters and numbers are allowed and spaces are not allowed']);
        if(!empty($cid)) {

        }else {
            if(empty($_FILES['pdf']['name'][0])) {
            $this->form_validation->set_rules('pdf','Image','required',['required'=>'Image is required']);
            }
            
           
        }
        
         if($this->form_validation->run() ==TRUE) {
            $cid = trim($this->input->post('cid'));
            $title = trim($this->input->post('title'));
            $sdesc = trim($this->input->post('sdesc'));
            $ldesc = trim($this->input->post('ldesc'));
            $morning = trim($this->input->post('morning'));
            $afternoon = trim($this->input->post('afternoon'));
            $evening = trim($this->input->post('evening'));
            if(!empty($cid)) {
                  $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'jpg|jpeg|png';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"Image : ".$this->upload->display_errors()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['image'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                         $db['rdiet'] = $sdesc;
                         $db['things'] = $ldesc;
                         $db['morning'] = $morning;
                         $db['afternoon'] = $afternoon;
                         $db['evening'] = $evening;
                $db['modified_at'] = date('Y-m-d H:i:s');
                $update = $this->master_db->updateRecord('treatment',$db,['tid'=>$cid]);
                  if($update >0) {
                        $resul = array('status'   => true, 'msg' =>'Updated successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }else {
                 $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'jpg|jpeg|png';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"Image : ".$this->upload->display_errors()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['image'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                         $db['rdiet'] = $sdesc;
                         $db['things'] = $ldesc;
                         $db['morning'] = $morning;
                         $db['afternoon'] = $afternoon;
                         $db['evening'] = $evening;
                $db['created_at'] = date('Y-m-d H:i:s');
                $res=$this->master_db->insertRecord('treatment',$db);
                if($res >0) {
                        $resul = array('status'   => true, 'msg' =>'Inserted successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }
           
         }else {
                $resul = array(
                     'formerror'   => false,
                    'title_error' => form_error('title'),
                    'pdf_error' => form_error('pdf'),
                    'sdesc_error' => form_error('sdesc'),
                    'ldesc_error' => form_error('ldesc'),
                    'link_error' => form_error('link'),

                );
         }
         echo json_encode($resul);
    }

    public function treatment_status()
    {
        $items = $this->input->post('items');
        $status = $this->input->post('status');
        $db=array(
        'status'=>$status,
        'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('treatment',$db,['tid'=>$items]);
        if($status == 2)
        {
            $this->master_db->deleterecordss('treatment',array("tid"=>$items));
        }
        $this->data['category'] = $this->load->view('masters/treatment/gettreatment', $this->data ,TRUE);
        echo $this->data['category'];
    }
   /*********** Blog ********/
    public function blog() {
    $this->data['diet'] = $this->load->view('masters/blogs/getblogs', $this->data, TRUE);
       $this->load->view('masters/blogs/blogs', $this->data);
   }
   public function blogadd() {
    $this->load->view('masters/blogs/blogsadd',$this->data);
   }
    public function blog_edit() {
        $id=$this->input->get('id');
        if(isset($id)) {
            $this->data['edit'] = $this->master_db->getRecords('blogs',['bid'=>$id],'*');
            $this->load->view('masters/blogs/editblogs',$this->data);
        }else {
            redirect(base_url().'master/blog');
        }
    }
     public function blogsave() {
         //echo "<pre>";print_r($_POST);exit;
        $this->load->library('form_validation');
        $cid = trim($this->input->post('cid'));
        $this->form_validation->set_rules('title','Title','required',['required'=>'Title is required','regex_match'=>'Only characters and numbers are allowed and spaces are not allowed']);
        if(!empty($cid)) {

        }else {
            if(empty($_FILES['pdf']['name'][0])) {
            $this->form_validation->set_rules('pdf','Pdf','required',['required'=>'PDF is required']);
            }
            $this->form_validation->set_rules('sdesc','Short description','required',['required'=>'Short description is required']);
            $this->form_validation->set_rules('ldesc','Long description','required',['required'=>'Long description is required']);
           
        }
        
         if($this->form_validation->run() ==TRUE) {
            $cid = trim($this->input->post('cid'));
            $title = trim($this->input->post('title'));
            $sdesc = trim($this->input->post('sdesc'));
            $ldesc = trim($this->input->post('ldesc'));
            if(!empty($cid)) {
                  $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'jpg|jpeg|png';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"Image : ".$this->upload->display_errors()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['image'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                         $db['sdesc'] = $sdesc;
                         $db['ldesc'] = $ldesc;
                $db['modified_at'] = date('Y-m-d H:i:s');
                $update = $this->master_db->updateRecord('blogs',$db,['bid'=>$cid]);
                  if($update >0) {
                        $resul = array('status'   => true, 'msg' =>'Updated successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }else {
                 $db['title'] = $title;
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/images/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'jpg|jpeg|png';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"Image : ".$this->upload->display_errors()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['image'] = 'assets/images/' . $upload_data1['file_name'];
                            }
                        }
                         $db['sdesc'] = $sdesc;
                         $db['ldesc'] = $ldesc;
                $db['created_at'] = date('Y-m-d H:i:s');
                $res=$this->master_db->insertRecord('blogs',$db);
                if($res >0) {
                        $resul = array('status'   => true, 'msg' =>'Inserted successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }
           
         }else {
                $resul = array(
                     'formerror'   => false,
                    'title_error' => form_error('title'),
                    'pdf_error' => form_error('pdf'),
                    'sdesc_error' => form_error('sdesc'),
                    'ldesc_error' => form_error('ldesc'),

                );
         }
         echo json_encode($resul);
    }

    public function blog_status()
    {
        $items = $this->input->post('items');
        $status = $this->input->post('status');
        $db=array(
        'status'=>$status,
        'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('blogs',$db,['bid'=>$items]);
        if($status == 2)
        {
            $this->master_db->deleterecordss('blogs',array("bid"=>$items));
        }
        $this->data['category'] = $this->load->view('masters/blogs/getblogs', $this->data ,TRUE);
        echo $this->data['category'];
    }
   public function notifications() {
    $this->data['diet'] = $this->load->view('masters/notification/getnotification', $this->data, TRUE);
       $this->load->view('masters/notification/notification', $this->data);
   }
   /*********** Notification ********/
   public function feedback() {
    $this->data['diet'] = $this->load->view('masters/feedback/getfeedback', $this->data, TRUE);
       $this->load->view('masters/feedback/feedback', $this->data);
   }
   /*********** Support ********/
   public function support() {
    $this->data['diet'] = $this->load->view('masters/support/getsupport', $this->data, TRUE);
       $this->load->view('masters/support/support', $this->data);
   }
   public function listtreatment() {
    $id = $this->uri->segment(3);
    $this->data['data'] = $this->master_db->getRecords('treatment',['tid'=>$id,'status'=>0],'*');
    $this->load->view('treatment_list',$this->data);
   }
   public function removeSpecification() {
   	$id = $this->input->post('id');
   	$del =  $this->master_db->deleterecordss('product_spec',array("id"=>$id));
   	echo json_encode(['status'=>true]);
   }
   public function getcurl() {
   	$ar = array('listsms'=>array(array('sms'=>'Dear syed Your OTP for login is 0001 Regards, Team Miracle Drinks.','mobiles'=>'+919986571768','senderid'=>'MIRCOL','clientSMSID'=>'1947692308','accountusagetypeid'=>'1','entityid'=>'1701159256675943303', 'tempid'=>'1707167592051531633')),'password'=>'63d06f365dXX','user'=>'Miracolo');
   	 $var = json_encode($ar);
   	// echo $var;exit;
   	$url = "http://mobicomm.dove-sms.com//REST/sendsms";
   	 $ch_session = curl_init();

curl_setopt($ch_session, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch_session, CURLOPT_POST, 1);
curl_setopt($ch_session, CURLOPT_POSTFIELDS, $var);
curl_setopt($ch_session, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
  ));

  curl_setopt($ch_session, CURLOPT_URL, $url);

  $result_url = curl_exec($ch_session);
  echo $result_url;

   }
   /*************** Disease **************/
   public function disease() {
        $this->load->view('disease', $this->data);
   }
   public function disease_add() {
      $this->data['type']='add';
    $this->load->view('disease_add',$this->data);
   }
   public function diseaseList() {
    $where = "where status !=2";

      
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
              
               }
            $order_by_arr[] = "title";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by title asc";
            $query = "select * from disease $where";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {

                   $cls = "";$status="";

                if ($r->status == '0') 
                {
                    $status = "<button type='button' class='text-warning'><i class='fa fa-remove'></i> Active</button>";
                    $chng = "<button class='btn btn-info btn-sm' onclick='changestatus(1," . $r->id . ")'  $cls> Active</button>";
                }
                 else
                  {
                   $status = "<button type='button' class='text-success'><i class='fa fa-check'></i> In-Active</button>";
                    $chng = "<button class='btn btn-primary btn-sm pl-3 pr-3' onclick='changestatus(0," . $r->id . ")'  $cls> In-Active</button>";
                }
                $action =' <a href="'.base_url()."master/disease_edit?id=".base64_encode($r->id)."".'" class="btn btn-circle btn-info" title="Edit" ><i class="mdi mdi-border-color"></i></a>
                        <button type="button" class="btn btn-circle btn-primary" title="Delete" onclick="changestatus(2,'.$r->id.')" ><i class=" fas fa-trash" ></i></button>';
                $sub_array = array();
             $sub_array[] = $i++;
             $sub_array[] = $r->title;
            
             $sub_array[] = $chng;
             $sub_array[] =  $action;
            
            $data[] = $sub_array;
            }

            $res    = $this->home_db->run_manual_query_result($query);
        $total  = count($res);
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
             "recordsTotal"          => $total,  
                "recordsFiltered"     => $total,  
            "data"              =>  $data
        );
        echo json_encode($output);
}
public function disease_save() {
        $cname = trim(preg_replace('!\s+!', ' ',$this->input->post('sname')));
            //$city = trim(preg_replace('!\s+!', '',$this->input->post('city')));
            $getrecords = $this->master_db->getRecords('disease',['title'=>$cname],'*');
            //echo $this->db->last_query();exit;
            if(count($getrecords) >0) {
              $this->session->set_flashdata('success','<div class="alert alert-danger">Disease already exists try another </div>');
            }else {
                      $db = array(
                    'title'=>$cname,
                   
                    'status'=>0,
                    'created_at'=>date('Y-m-d H:i:s')
                    );
                $insert = $this->master_db->insertRecord('disease',$db);
                if($insert) {
                    $this->session->set_flashdata('success','<div class="alert alert-success">State inserted successfully</div>');
                }else {
                     $this->session->set_flashdata('success','<div class="alert alert-danger">Error in interting data</div>');
                     
                }
               
            }
            redirect('master/disease');
    }
    public function disease_edit() {
        $det=$this->data['detail'];

        $id=base64_decode($this->input->get('id'));

        if($id)
        {
            $this->data['type']='edit';
           $this->data['details']= $this->master_db->getRecords('disease',['id'=>$id],"*");
            $this->load->view('disease_add',$this->data);
        }

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $order=$this->input->post('order');

            $cname = trim(preg_replace('!\s+!', ' ',$this->input->post('sname')));
           
            $db=array(
               
                'title'=>$cname,
                'modified_at'=>date('Y-m-d H:i:s')
            );
            $res=$this->master_db->updateRecord('disease',$db,['id'=>$id]);
            if($res)
            {
                $this->session->set_flashdata('success','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');
                redirect('master/disease');

            }
            else
            {
                $this->session->set_flashdata('success','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
                redirect('master/disease');

            }
            
        }
    }
    public function disease_status() {
        $items = $this->input->post('items');
            $status = $this->input->post('status');
            //echo "<pre>";print_r($_POST);exit;
            $db=array(
            'items'=>$items,
            'status'=>$status
            );
            $this->master_db->changeStatus('disease',$db);
            if($status == 2)
            {
                $this->master_db->deleterecordss('disease',['id'=>$items]);
            }
            echo 1;
}
/*************** Symptoms **************/
   public function symptoms() {
        $this->load->view('symptoms', $this->data);
   }
   public function symptoms_add() {
      $this->data['type']='add';
      $this->data['disease'] = $this->master_db->getRecords('disease',['status'=>0],'*');
    $this->load->view('symptoms_add',$this->data);
   }
     public function symptomsList() {
        $where = "where status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
              
               }
            $order_by_arr[] = "title";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by title asc";
            $query = "select * from symptoms $where";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {

                   $cls = "";$status="";

                if ($r->status == '0') 
                {
                    $status = "<button type='button' class='text-warning'><i class='fa fa-remove'></i> Active</button>";
                    $chng = "<button class='btn btn-info btn-sm' onclick='changestatus(1," . $r->id . ")'  $cls> Active</button>";
                }
                 else
                  {
                   $status = "<button type='button' class='text-success'><i class='fa fa-check'></i> In-Active</button>";
                    $chng = "<button class='btn btn-primary btn-sm pl-3 pr-3' onclick='changestatus(0," . $r->id . ")'  $cls> In-Active</button>";
                }
                $action =' <a href="'.base_url()."master/symptoms_edit?id=".base64_encode($r->id)."".'" class="btn btn-circle btn-info" title="Edit" ><i class="mdi mdi-border-color"></i></a>
                        <button type="button" class="btn btn-circle btn-primary" title="Delete" onclick="changestatus(2,'.$r->id.')" ><i class=" fas fa-trash" ></i></button>';
                $sub_array = array();
             $sub_array[] = $i++;
             $sub_array[] = $r->title;
            
             $sub_array[] = $chng;
             $sub_array[] =  $action;
            
            $data[] = $sub_array;
            }

            $res    = $this->home_db->run_manual_query_result($query);
        $total  = count($res);
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
             "recordsTotal"          => $total,  
                "recordsFiltered"     => $total,  
            "data"              =>  $data
        );
        echo json_encode($output);
}

public function symptoms_save() {
        $cname = trim(preg_replace('!\s+!', ' ',$this->input->post('sname')));
        $disease = trim(preg_replace('!\s+!', ' ',$this->input->post('disease')));
            //$city = trim(preg_replace('!\s+!', '',$this->input->post('city')));
            $getrecords = $this->master_db->getRecords('symptoms',['title'=>$cname,'did'=>$disease],'*');
            //echo $this->db->last_query();exit;
            if(count($getrecords) >0) {
              $this->session->set_flashdata('success','<div class="alert alert-danger">Symptoms already exists try another </div>');
            }else {
                      $db = array(
                        'did'=>$disease,
                        'title'=>$cname,
                        'status'=>0,
                        'created_at'=>date('Y-m-d H:i:s')
                    );
                $insert = $this->master_db->insertRecord('symptoms',$db);
                if($insert) {
                    $this->session->set_flashdata('success','<div class="alert alert-success">State inserted successfully</div>');
                }else {
                     $this->session->set_flashdata('success','<div class="alert alert-danger">Error in interting data</div>');
                     
                }
               
            }
            redirect('master/symptoms');
    }
    public function symptoms_edit() {
        $det=$this->data['detail'];

        $id=base64_decode($this->input->get('id'));

        if($id)
        {
            $this->data['type']='edit';
           $this->data['details']= $this->master_db->getRecords('symptoms',['id'=>$id],"*");
            $this->data['disease'] = $this->master_db->getRecords('disease',['status'=>0],'*');
            $this->load->view('symptoms_add',$this->data);
        }

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $order=$this->input->post('order');
            $cname = trim(preg_replace('!\s+!', ' ',$this->input->post('sname')));
            $disease = trim(preg_replace('!\s+!', ' ',$this->input->post('disease')));
            $db=array(
               'did'=>$disease,
                'title'=>$cname,
                'modified_at'=>date('Y-m-d H:i:s')
            );
            $res=$this->master_db->updateRecord('symptoms',$db,['id'=>$id]);
            if($res)
            {
                $this->session->set_flashdata('success','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');
                redirect('master/symptoms');
            }
            else
            {
                $this->session->set_flashdata('success','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
                redirect('master/symptoms');
            }
        }
    }
    public function symptoms_status() {
        $items = $this->input->post('items');
            $status = $this->input->post('status');
            //echo "<pre>";print_r($_POST);exit;
            $db=array(
            'items'=>$items,
            'status'=>$status
            );
            $this->master_db->changeStatus('symptoms',$db);
            if($status == 2)
            {
                $this->master_db->deleterecordss('symptoms',['id'=>$items]);
            }
            echo 1;
    }
    /********** Bloodparameters ************/
    public function bloodparameters() {
        $this->load->view('bloodparameters',$this->data);
    }
    public function getbloodparameterslist() {
        $where = "where b.status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
              
               }
            $order_by_arr[] = "b.tid";
            $order_by_arr[] = "";
            $order_by_arr[] = "b.bid";
            $order_by_def   = " order by b.bid desc";
            $query = "select t.title as ttitle,bp.title,bp.id,b.status from bloodparameters b left join blood_parameters_details bp on bp.bid =b.bid left join tests t on t.tid = b.tid $where";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {

                   $cls = "";$status="";

                if ($r->status == '0') 
                {
                    $status = "<button type='button' class='text-warning'><i class='fa fa-remove'></i> Active</button>";
                    $chng = "<button class='btn btn-info btn-sm' onclick='changestatus(1," . $r->id . ")'  $cls> Active</button>";
                }
                 else
                  {
                   $status = "<button type='button' class='text-success'><i class='fa fa-check'></i> In-Active</button>";
                    $chng = "<button class='btn btn-primary btn-sm pl-3 pr-3' onclick='changestatus(0," . $r->id . ")'  $cls> In-Active</button>";
                }
                $action =' <a href="'.base_url()."master/bloodparameters_edit?id=".base64_encode($r->id)."".'" class="btn btn-circle btn-info" title="Edit" ><i class="mdi mdi-border-color"></i></a>
                        <button type="button" class="btn btn-circle btn-primary" title="Delete" onclick="changestatus(2,'.$r->id.')" ><i class=" fas fa-trash" ></i></button>';
                $sub_array = array();
             $sub_array[] = $i++;
             $sub_array[] = $r->ttitle;
             $sub_array[] = $r->title;
            
             $sub_array[] = $chng;
             $sub_array[] =  $action;
            
            $data[] = $sub_array;
            }

            $res    = $this->home_db->run_manual_query_result($query);
        $total  = count($res);
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
             "recordsTotal"          => $total,  
                "recordsFiltered"     => $total,  
            "data"              =>  $data
        );
        echo json_encode($output);
    }
    public function bloodparametersadd() {
        $this->data['type'] = 'add';
        $this->data['tests'] = $this->master_db->getRecords('tests',['status'=>0],'tid as id,title','tid desc');
        $this->load->view('bloodparametersadd',$this->data);
    }
     public function bloodparameters_edit() {
        $det=$this->data['detail'];

        $id=base64_decode($this->input->get('id'));

        if($id)
        {
            $this->data['type']='edit';
           $this->data['details']= $this->master_db->sqlExecute('select b.tid,bp.id,bp.title from blood_parameters_details bp left join bloodparameters b on b.bid= bp.bid where bp.id='.$id.'');
           //echo $this->db->last_query();exit;
            $this->data['tests'] = $this->master_db->getRecords('tests',['status'=>0],'*');
            $this->load->view('bloodparametersadd',$this->data);
        }

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $tests = trim(preg_replace('!\s+!', ' ',$this->input->post('tests')));
            $title = trim(preg_replace('!\s+!', ' ',$this->input->post('title')));
            $db=array(
                'title'=>$title,
            );
            $res=$this->master_db->updateRecord('blood_parameters_details',$db,['id'=>$id]);
            if($res)
            {
                $this->session->set_flashdata('success','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');
                redirect('master/bloodparameters');
            }
            else
            {
                $this->session->set_flashdata('success','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
                redirect('master/bloodparameters');
            }
        }
    }
    public function savebloodparameters() {
        //echo "<pre>";print_r($_POST);exit;
         $tests = trim(preg_replace('!\s+!', ' ',$this->input->post('tests')));
        $title = $this->input->post('title');
        if(!empty($tests) && !empty($title)) {
            $db['tid'] = $tests;
            $db['created_at'] = date('Y-m-d H:i:s');
            $in = $this->master_db->insertRecord('bloodparameters',$db);
            if($in >0) {
                if(is_array($title) && !empty($title)) {
                    foreach ($title as $key => $value) {
                        $dbs['bid'] = $in;
                        $dbs['title'] = $value;
                        $this->master_db->insertRecord('blood_parameters_details',$dbs);
                    }
                }
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Saved successfully</div>');
                redirect(base_url().'master/bloodparameters');
            }
        }else {
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Required fields is missing</div>');
            redirect(base_url().'master/bloodparameters');
        }
    }
     public function bloodparameters_status() {
        $items = $this->input->post('items');
            $status = $this->input->post('status');
            //echo "<pre>";print_r($_POST);exit;
            if($status == 2)
            {
                $this->master_db->deleterecordss('blood_parameters_details',['id'=>$items]);
            }
            echo 1;
    }
    /*********** Doctor panel ***********/
    public function doctorpanel() {
        $this->load->view('doctorpanel',$this->data);
    }
    public function adddoctorpanel() {
        $this->data['type'] = 'add';
        $this->data['users']  =$this->master_db->getRecords('users',['status'=>0],'name,phone,id','id desc');
        $this->data['disease']  =$this->master_db->getRecords('disease',['status'=>0],'title,id','id desc');
        $this->data['symptoms']  =$this->master_db->getRecords('symptoms',['status'=>0],'title,id','id desc');
        $this->load->view('adddoctorpanel',$this->data);
    }
      public function doctorpanelList() {
        $where = "where d.status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
              
               }
            $order_by_arr[] = "d.disease_id";
            $order_by_arr[] = "";
            $order_by_arr[] = "d.doctor_id";
            $order_by_def   = " order by d.doctor_id desc";
            $query = "select d.doctor_id as id,u.name,di.title,d.status from doctorpanel d left join users u on u.id =d.user_id left join disease di on di.id = d.disease_id $where";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {

                   $cls = "";$status="";

                if ($r->status == '0') 
                {
                    $status = "<button type='button' class='text-warning'><i class='fa fa-remove'></i> Active</button>";
                    $chng = "<button class='btn btn-info btn-sm' onclick='changestatus(1," . $r->id . ")'  $cls> Active</button>";
                }
                 else
                  {
                   $status = "<button type='button' class='text-success'><i class='fa fa-check'></i> In-Active</button>";
                    $chng = "<button class='btn btn-primary btn-sm pl-3 pr-3' onclick='changestatus(0," . $r->id . ")'  $cls> In-Active</button>";
                }
                $action =' <a href="'.base_url()."master/editbloodparameters/".miracleEncrypt($r->id)."".'" class="btn btn-circle btn-info" title="Edit" ><i class="mdi mdi-border-color"></i></a><a href="'.base_url()."master/viewbloodparameters/".miracleEncrypt($r->id).'" class="btn btn-circle btn-warning" title="View"><i class=" fas fa-eye" ></i></a>
                        <button type="button" class="btn btn-circle btn-primary" title="Delete" onclick="changestatus(2,'.$r->id.')" ><i class=" fas fa-trash" ></i></button>';
                $sub_array = array();
             $sub_array[] = $i++;
             $sub_array[] = $r->name;
             $sub_array[] = $r->title;
            
             $sub_array[] = $chng;
             $sub_array[] =  $action;
            
            $data[] = $sub_array;
            }

            $res    = $this->home_db->run_manual_query_result($query);
        $total  = count($res);
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
             "recordsTotal"          => $total,  
                "recordsFiltered"     => $total,  
            "data"              =>  $data
        );
        echo json_encode($output);
    }
    public function editbloodparameters() {
        $bid = miracleDcrypt($this->uri->segment(3));
        $this->data['doctors'] = $doctor =  $this->home_db->sqlExecute('select d.doctor_id,d.user_id,d.disease_id,di.title from doctorpanel d left join disease di on di.id=d.disease_id where d.doctor_id ='.$bid.'');
        //echo $this->db->last_query();exit;
        $this->data['type'] = 'add';
        $this->data['symptoms'] = $this->master_db->getRecords('symptoms',['status'=>0,'did'=>$doctor[0]->disease_id],'*','id desc');
        $this->data['parameters'] = $this->master_db->getRecords('blood_parameters_details',['status'=>0],'*','id desc');
        $this->data['visit1'] = $visits1 =  $this->master_db->getRecords('doctor_visits',['visits'=>1,'did'=>$doctor[0]->disease_id,'user_id'=>$doctor[0]->user_id],'*','id desc');
       // echo $this->db->last_query();exit;
        if(!empty($visits1) && is_array($visits1)) {
            $this->data['psymptoms1'] = $this->master_db->getRecords('doctor_symptoms',['vid'=>$visits1[0]->id],'*');
            $this->data['userblood1'] = $this->master_db->getRecords('user_blood_parameters_count',['vid'=>$visits1[0]->id],'*');
        }else {
            $this->data['psymptoms1'] = [];
            $this->data['userblood1'] = [];
        }
        
        $this->data['visit2'] = $visits2 =  $this->master_db->getRecords('doctor_visits',['visits'=>2,'did'=>$doctor[0]->disease_id,'user_id'=>$doctor[0]->user_id],'*','id desc');

         if(!empty($visits2) && is_array($visits2)) {
            $this->data['psymptoms2'] = $this->master_db->getRecords('doctor_symptoms',['vid'=>$visits2[0]->id],'*');
            $this->data['userblood2'] = $this->master_db->getRecords('user_blood_parameters_count',['vid'=>$visits2[0]->id],'*');
        }else {
            $this->data['psymptoms2'] = [];
            $this->data['userblood2'] = [];
        }
        $this->data['visit3'] = $visits3 =  $this->master_db->getRecords('doctor_visits',['visits'=>3,'did'=>$doctor[0]->disease_id,'user_id'=>$doctor[0]->user_id],'*','id desc');
         if(!empty($visits3) && is_array($visits3)) {
            $this->data['psymptoms3'] = $this->master_db->getRecords('doctor_symptoms',['vid'=>$visits3[0]->id],'*');
            $this->data['userblood3'] = $this->master_db->getRecords('user_blood_parameters_count',['vid'=>$visits3[0]->id],'*');
        }else {
            $this->data['psymptoms3'] = [];
            $this->data['userblood3'] = [];
        }
        $this->data['visit4'] = $visits4 =  $this->master_db->getRecords('doctor_visits',['visits'=>4,'did'=>$doctor[0]->disease_id,'user_id'=>$doctor[0]->user_id],'*','id desc');
         if(!empty($visits4) && is_array($visits4)) {
            $this->data['psymptoms4'] = $this->master_db->getRecords('doctor_symptoms',['vid'=>$visits4[0]->id],'*');
            $this->data['userblood4'] = $this->master_db->getRecords('user_blood_parameters_count',['vid'=>$visits4[0]->id],'*');
        }else {
            $this->data['psymptoms4'] = [];
            $this->data['userblood4'] = [];
        }
        $this->data['visit5'] = $visits5 =  $this->master_db->getRecords('doctor_visits',['visits'=>5,'did'=>$doctor[0]->disease_id,'user_id'=>$doctor[0]->user_id],'*','id desc');
         if(!empty($visits5) && is_array($visits5)) {
            $this->data['psymptoms5'] = $this->master_db->getRecords('doctor_symptoms',['vid'=>$visits5[0]->id],'*');
            $this->data['userblood5'] = $this->master_db->getRecords('user_blood_parameters_count',['vid'=>$visits5[0]->id],'*');
        }else {
            $this->data['psymptoms5'] = [];
            $this->data['userblood5'] = [];
        }
        $this->data['visit6'] = $visits6 =  $this->master_db->getRecords('doctor_visits',['visits'=>6,'did'=>$doctor[0]->disease_id,'user_id'=>$doctor[0]->user_id],'*','id desc');
         if(!empty($visits6) && is_array($visits6)) {
            $this->data['psymptoms6'] = $this->master_db->getRecords('doctor_symptoms',['vid'=>$visits6[0]->id],'*');
            $this->data['userblood6'] = $this->master_db->getRecords('user_blood_parameters_count',['vid'=>$visits6[0]->id],'*');
        }else {
            $this->data['psymptoms6'] = [];
            $this->data['userblood6'] = [];
        }
        $this->data['bloodparams'] = $this->master_db->getRecords('blood_parameters_details',['status'=>0],'*');
               
        $this->data['tests'] = $this->master_db->getRecords('tests',['status'=>0],'*','tid desc');
        $this->load->view('editbloodparameters',$this->data);
    }

    
     public function bloodparametersview_save() {
        // echo "<pre>";print_r($_POST);exit;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('visits','Visit','required',['required'=>'Please select visit']);
        $this->form_validation->set_rules('date','Visit','required',['required'=>'Date is required']);
        $this->form_validation->set_rules('symptoms[0]','Symptoms','required',['required'=>'Symptoms is required']);
         if($this->form_validation->run() ==TRUE) {
            $problem = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('problem', true))));
            $visits = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('visits', true))));
            $date = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('date', true))));
            $cid = trim($this->input->post('bid'));
            $uid = trim($this->input->post('uid'));
            $did = trim($this->input->post('did'));
            $visit_id = trim($this->input->post('visit_id'));
            $title = $this->input->post('title');
            $sblood = $this->input->post('sblood');
            $symptoms = $this->input->post('symptoms');
            $tests = $this->input->post('tests');
            $nvalue = $this->input->post('nvalue');
             $testids = $this->input->post('testids');
            $symids = $this->input->post('symids');
            $bparams = $this->input->post('bparams');
                    $vids ="";
                    if(empty($visit_id)) {
                        $vids .=' and visits='.$visits.'';
                    }
                    $getVisits = $this->home_db->sqlExecute('select * from doctor_visits where did='.$cid.' '.$vids.' ');

            //echo $this->db->last_query();exit;
            if(count($getVisits) >0) {
                $vi = "";
                if($getVisits[0]->visits == 1) {
                    $vi .="1st visit";
                }
                else if($getVisits[0]->visits == 2) {
                    $vi .="2nd visit";
                }
                 else if($getVisits[0]->visits == 3) {
                    $vi .="3rd visit";
                }
                 else if($getVisits[0]->visits == 4) {
                    $vi .="4th visit";
                }
                 else if($getVisits[0]->visits == 5) {
                    $vi .="5th visit";
                }
                 else if($getVisits[0]->visits == 6) {
                    $vi .="6th visit";
                }
                $resul = ['status'=>false,'msg'=>$vi." already exists try another"];
            }else {
                if(!empty($visit_id)) {
                    
                    $getBloodcount = $this->master_db->sqlExecute('select * from user_blood_parameters_count where vid= '.$visit_id.'');
                    //echo $this->db->last_query();exit;

                    $getbcount = [];$getSymid = [];
                    if(count($getBloodcount) >0) {
                        foreach ($getBloodcount as $key => $value) {
                           $getbcount[] = $value->tid;
                        }
                    }
                    //echo "<pre>";print_r($getbcount);exit;
                    $getSymptoms = $this->master_db->getRecords('doctor_symptoms',['vid'=>$visit_id],'*');
                    if(count($getSymptoms) >0) {
                        foreach ($getSymptoms as $key => $sym) {
                            $getSymid[] = $sym->sid;
                        }
                    }
                    $db['vdate'] = date('Y-m-d',strtotime($date));
                    $db['problems'] =$problem;
                    $db['modified_at'] =date('Y-m-d H:i:s');
                    $up = $this->master_db->updateRecord('doctor_visits',$db,['id'=>$visit_id]);
                    if($up >0) {
                        if(is_array($testids) && !empty($testids)) {
                            foreach ($testids as $key => $val) {
                                $this->master_db->deleterecordss('user_blood_parameters_count',['vid'=>$visit_id,'tid'=>$val]);
                            }
                        }
                         if(is_array($symids) && !empty($symids)) {
                            foreach ($symids as $key => $sym) {
                                $this->master_db->deleterecordss('doctor_symptoms',['vid'=>$visit_id,'sid'=>$sym]);
                            }
                        }
                        if(is_array($symptoms) && !empty($symptoms)) {
                            foreach ($symptoms as $key => $value) {
                                if(!in_array($value, $getSymid)) {
                                    $syms['vid'] = $visit_id;
                                    $syms['sid'] = $value;
                                    $this->master_db->insertRecord('doctor_symptoms',$syms);
                                }
                            }
                        }
                          if(is_array($tests) && !empty($tests)) {
                            foreach ($tests as $k => $ti) {
                            	$tes =[];
                            	$getIdsby = $this->home_db->sqlExecute('select ub.tid,uc.id from user_blood_parameters_count uc left join user_blood_parameters ub on ub.pid = uc.id where uc.vid='.$visit_id.' and uc.tid='.$ti.'');
                            	if(count($getIdsby) >0) {
                            		foreach ($getIdsby as $key => $value) {
                            			$tes[] = $value->tid;
                            		}
                            	}
                                if(in_array($ti, $getbcount)) {
                                     if(!empty($bparams[$ti]) && is_array($bparams[$ti])) {
                                              foreach($bparams[$ti] as $keys => $v) {
                                              	if(in_array($v, $tes)) {
	                                                    if(!empty($sblood[$ti][$keys])) {
	                                                        $prs['tid'] = $v;
	                                                    }
	                                                    $prs['title'] = $title[$ti][$keys];
	                                                   $prs['nvalue'] = $nvalue[$ti][$keys];
                                                   
	                                                   
	                                                    $this->master_db->updateRecord('user_blood_parameters',$prs,['tid'=>$v,'pid'=>$getIdsby[0]->id]);
                                              	}else {
                                              		  // if(!empty($sblood[$ti][$keys])) {
	                                                 //        $prs['tid'] = $v;
	                                                 //    }
	                                                 //    $prs['title'] = $title[$ti][$keys];
	                                                 //    if(!empty($nvalue[$ti][$keys]) && $nvalue[$ti][$keys] !='') {
	                                                 //        $prs['nvalue'] = $nvalue[$ti][$keys];
	                                                 //    }
	                                                 //    $this->master_db->insertRecord('user_blood_parameters',$prs);
                                              	}
                                            }
                                        }
                                }else {
                                    $params['vid'] = $visit_id;
                                    $params['tid'] = $ti;
                                    $ars =$this->master_db->insertRecord('user_blood_parameters_count',$params);
                                     if($ars >0) {
                                        if(!empty($title[$ti]) && is_array($title[$ti])) {
                                              foreach($title[$ti] as $keys => $v) {
                                                    $prs['pid'] = $ars;
                                                    if(!empty($sblood[$ti][$keys])) {
                                                        $prs['tid'] = $sblood[$ti][$keys];
                                                    }
                                                    $prs['title'] = $v;
                                                    //echo "keys :".$keys."values: ".$v."<br />";
                                                        $prs['nvalue'] = $nvalue[$ti][$keys];
                                                    
                                                    $this->master_db->insertRecord('user_blood_parameters',$prs);
                                                 }
                                        }
                                    }
                                }

                                    
                            }
                        }
                        //exit;
                    }
                    $resul =['status'=>true,'msg'=>'Updated successfully'];
                }else {
                    $db['did'] = $did;
                    $db['user_id'] = $uid;
                    $db['visits'] = $visits;
                    $db['vdate'] = date('Y-m-d',strtotime($date));
                    $db['problems'] =$problem;
                    $db['created_at'] =date('Y-m-d H:i:s');
                    $in = $this->master_db->insertRecord('doctor_visits',$db);
                    if($in >0) {
                        if(is_array($symptoms) && !empty($symptoms)) {
                            foreach ($symptoms as $key => $value) {
                                $sym['vid'] = $in;
                                $sym['sid'] = $value;
                                $this->master_db->insertRecord('doctor_symptoms',$sym);
                            }
                        }
                        if(is_array($tests) && !empty($tests)) {
                            foreach ($tests as $k => $ti) {
                                    $params['vid'] = $in;
                                    $params['tid'] = $ti;
                                    $ars =$this->master_db->insertRecord('user_blood_parameters_count',$params);
                                     if($ars >0) {
                                        if(!empty($title[$ti]) && is_array($title[$ti])) {
                                              foreach($title[$ti] as $keys => $v) {
                                                    $prs['pid'] = $ars;
                                                    if(!empty($sblood[$ti][$keys])) {
                                                        $prs['tid'] = $sblood[$ti][$keys];
                                                    }
                                                    $prs['title'] = $v;
                                                        $prs['nvalue'] = $nvalue[$ti][$keys];
                                                
                                                    //echo $nvalue[$ti][$keys]."<br />";
                                                    $this->master_db->insertRecord('user_blood_parameters',$prs);
                                             }
                                        }
                                    }
                            }
                        }
                        $resul =['status'=>true,'msg'=>'Saved successfully'];
                    }else {
                        $resul =['status'=>false,'msg'=>'Error in saving'];
                    } 
                }
               
            }
         }else {
                $resul = array(
                     'formerror'   => false,
                    'title_error' => form_error('title[0]'),
                    'visits_error' => form_error('visits'),
                    'symptoms_error' => form_error('symptoms[0]'),
                    'sblood_error' => form_error('sblood[0]'),
                    'value_error' => form_error('value[0]'),
                    'tests_error' => form_error('tests[0]'),
                    'date_error' =>form_error('date')
                );
         }
       echo json_encode($resul);
    }

    public function treatmentadd_save() {
        $users = trim(preg_replace('!\s+!', ' ',$this->input->post('users')));
        $disease = $this->input->post('disease');
        if(!empty($users) && !empty($disease)) {
            
            $db['user_id'] = $users;
            $db['disease_id'] = $disease;
            $db['created_at'] = date('Y-m-d H:i:s');
            $in = $this->master_db->insertRecord('doctorpanel',$db);
            if($in >0) {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Saved successfully</div>');
                redirect(base_url().'master/doctorpanel');
            }
        }else {
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Required fields is missing</div>');
            redirect(base_url().'master/adddoctorpanel');
        }
        
    }

    public function getTests() {
        //echo "<pre>";print_r($_POST);exit;
        $tid = $this->input->post('tid');
        //$newcheck = $this->input->post('newcheck');
        $vid1 = $this->input->post('vid1');
        $getUsersb = $this->master_db->getRecords('user_blood_parameters_count',['vid'=>$vid1,'tid'=>$tid],'*');
       // echo $this->db->last_query();exit;
        // if(count($getUsersb) >0) {
        //     $this->master_db->deleterecordss('user_blood_parameters_count',['vid'=>$vid1,'tid'=>$tid]);
        // }else {

        // }
       
                 //$im = implode(",",$newcheck);
             // $getdata = $this->home_db->sqlExecute('select bid,tid from bloodparameters where tid in ('.$im.') order by tid desc');
            $getdata = $this->home_db->sqlExecute('select bid,tid from bloodparameters where tid ='.$tid.' order by tid desc');
           // echo $this->db->last_query();exit;
            // foreach ($getdata as $key => $value) {
            //     echo "Keys : ".$key." Values :".$value->tid."<br />";
            // }
            $this->data['data'] = $getdata;
            $html = $this->load->view('appendrow',$this->data,true);
            echo json_encode(['status'=>true,'data'=>$html]);
        
        
    }
    public function getSymptomsdel() {
         $sid = $this->input->post('tid');
        $vid1 = $this->input->post('vid1');
         $this->master_db->deleterecordss('doctor_symptoms',['vid'=>$vid1,'sid'=>$sid]);
         echo json_encode(['status'=>true,'msg'=>'Deleted successfully']);
    }
    /********* Treatment Protocol ********/
   public function tprotocol() {
        $this->data['diet'] = $this->load->view('masters/treatmentprotocol/gettreatmentprotocol', $this->data, TRUE);
       $this->load->view('masters/treatmentprotocol/treatmentprotocol', $this->data);
   }
   public function addtreatprotocol() {
    $this->load->view('masters/treatmentprotocol/treatmentprotocoladd', $this->data);
   }
    public function treatmentprotocolsave() {
        //echo "<pre>";print_r($_POST);exit;
        $this->load->library('form_validation');
        $cid = trim($this->input->post('cid'));
        $this->form_validation->set_rules('title','Title','required',['required'=>'Title is required','regex_match'=>'Only characters and numbers are allowed and spaces are not allowed']);
        if(!empty($cid)) {

        }else {
            if(empty($_FILES['pdf']['name'][0])) {
            $this->form_validation->set_rules('pdf','Pdf','required',['required'=>'PDF is required']);
            }
            if(empty($_FILES['image']['name'][0])) {
            $this->form_validation->set_rules('image','Thumbnail Image','required',['required'=>'Thumbnail Image is required']);
            }
        }
        
         if($this->form_validation->run() ==TRUE) {
          
            $cid = trim($this->input->post('cid'));
            $title = trim($this->input->post('title'));
           
            if(!empty($cid)) {
                  $db['title'] = $title;
                   if (!empty($_FILES['image']['name'])) {
                            $uploadPath = 'assets/treatment_protocol/image/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'png|jpg|JPEG|PNG';
                            $ext = pathinfo($_FILES["image"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('image')) {
                                $array1 = ['status'=>false,'msg'=>"Image : ".$this->upload->display_errors()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['thumbnail_image'] = 'assets/treatment_protocol/image/' . $upload_data1['file_name'];
                            }
                        }
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/treatment_protocol/pdf/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'pdf|PDF';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"PDF File : ".$this->upload->display_errors()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['pdf'] = 'assets/treatment_protocol/pdf/' . $upload_data1['file_name'];
                            }
                        }
                $db['modified_at'] = date('Y-m-d H:i:s');
                $update = $this->master_db->updateRecord('treatment_protocol',$db,['id'=>$cid]);
                  if($update >0) {
                        $resul = array('status'   => true, 'msg' =>'Updated successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }else {
                $db['title'] = $title;
                   if (!empty($_FILES['image']['name'])) {
                            $uploadPath = 'assets/treatment_protocol/image/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'png|jpg|JPEG|PNG';
                            $ext = pathinfo($_FILES["image"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('image')) {
                                $array1 = ['status'=>false,'msg'=>"Image : ".$this->upload->display_errors()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['thumbnail_image'] = 'assets/treatment_protocol/image/' . $upload_data1['file_name'];
                            }
                        }
                if (!empty($_FILES['pdf']['name'])) {
                            $uploadPath = 'assets/treatment_protocol/pdf/';
                            $config1['upload_path'] = $uploadPath;
                            $config1['allowed_types'] = 'pdf|PDF';
                            $ext = pathinfo($_FILES["pdf"]['name'], PATHINFO_EXTENSION);
                            $new_name = "MIRACLE" . rand(11111, 99999) . '.' . $ext;
                            $config1['file_name'] = $new_name;
                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);
                            if (!$this->upload->do_upload('pdf')) {
                                $array1 = ['status'=>false,'msg'=>"PDF File : ".$this->upload->display_errors()];
                                echo json_encode($array1);exit;
                            } else {
                                $upload_data1 = $this->upload->data();
                                $db['pdf'] = 'assets/treatment_protocol/pdf/' . $upload_data1['file_name'];
                            }
                        }
                $db['created_at'] = date('Y-m-d H:i:s');
                $res=$this->master_db->insertRecord('treatment_protocol',$db);
                if($res >0) {
                        $resul = array('status'   => true, 'msg' =>'Inserted successfully');
                }
                else {
                    $resul = array('status'   => false,'msg' =>'Error in inserted');  
                }
            }
           
         }else {
                $resul = array(
                     'formerror'   => false,
                    'title_error' => form_error('title'),
                    'pdf_error' => form_error('pdf'),
                    'image_error' => form_error('image'),

                );
         }
         echo json_encode($resul);
    }
    public function treatmentprotocol_status()
    {
        $items = $this->input->post('items');
        $status = $this->input->post('status');
        $db=array(
        'status'=>$status,
        'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('treatment_protocol',$db,['id'=>$items]);
        if($status == 2)
        {
            $this->master_db->deleterecordss('treatment_protocol',array("id"=>$items));
        }
        $this->data['category'] = $this->load->view('masters/treatmentprotocol/gettreatmentprotocol', $this->data ,TRUE);
        echo $this->data['category'];
    }
    public function treatmentprotocol_edit() {
        $id=$this->input->get('id');
        if(isset($id)) {
            $this->data['edit'] = $this->master_db->getRecords('treatment_protocol',['id'=>$id],'*');
            $this->load->view('masters/treatmentprotocol/treatmentprotocoledit',$this->data);
        }else {
            redirect(base_url().'master/tprotocol');
        }
    }

      public function doctorsview_status() {
        $items = $this->input->post('items');
            $status = $this->input->post('status');
           
            if($status == 2)
            {
                $this->master_db->deleterecordss('doctorpanel',['doctor_id'=>$items]);
            }
            $db['status'] = $status;
            $this->master_db->updateRecord('doctorpanel',$db,['doctor_id'=>$items]);
            echo 1;
    }

}
?>
