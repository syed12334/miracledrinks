<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blogposts extends CI_Controller {

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
		$this->load->model('about_db');
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
        $this->data['left']=$this->load->view('left', $this->data , TRUE); 
        $this->data['jsfile']=$this->load->view('jsfile', $this->data , TRUE);
    }

    
    

	//-----blogposts Posts--------//
	public function index()
    {
    	$this->load->view('blogposts_post',$this->data) ;
    }
    
    public function blogposts_post_table()
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
    	$this->data=$this->about_db->gettable_freebies($db);
    	echo $this->data;
    }
    
    public function blogposts_post_add()
    {
    	$this->data['type']='add';
    	$this->load->view('blogposts_postadd',$this->data);
    }
    
	function blogposts_post_save()
    {
    	if($_SERVER['REQUEST_METHOD']=='POST')
    	{
    
    		$det=$this->data['detail'];    		 
    
    		$img1up = $img2up = false;
    		$arry = array("gif","jpg","png","ico","jpeg");
    		$uploaddir = '../assets/blogposts/';
    		$uploadDBdir= "assets/blogposts/";
    		 
    		$arrayImage=$_FILES['imag']['name'];
    		$arrayTemp=$_FILES['imag']['tmp_name'];
    		 
    		$ext = end(explode(".", $arrayImage));
    		if(in_array($ext,$arry)){
    			$image_name='blogposts'.time().'1.'.$ext;
    			$uploadfile = $uploaddir.$image_name;
    			$uploadfileTable1 = $uploadDBdir.$image_name;
    			$img1up = move_uploaded_file($arrayTemp,$uploadfile);
//    			$size = getimagesize($uploadfile);
//    			$width = $size[0];
//    			$height = $size[1];
    			$this->home_db->resizeImagef($uploadfileTable1, 400,400);
    			
    		}
    
    
    		if($img1up)
    		{
    			$db = array(
    					'breif_descp'=>trim(preg_replace('!\s+!', ' ',$this->input->post('breif'))),
    					'title'=>trim(preg_replace('!\s+!', ' ',$this->input->post('title'))),
    					'descp'=>$this->input->post('descp'),
    					'page_url'=>$this->create_unique_slug(trim(preg_replace('!\s+!', ' ',$this->input->post('title'))),'blogposts_post','page_url'),
    					'created_date'=>date('Y-m-d H:i:s'),
    					'post_by'=>trim(preg_replace('!\s+!', ' ',$this->input->post('post_by'))),
    					'user_id'=>$det[0]->id,
    					'image_path'=>$uploadfileTable1,
    			);
    
    			$res=$this->master_db->insertRecord('blogposts_post',$db);
    
    		}
    
    		if($res)
    		{
    			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Added Successfully</div>');
    		}
    		else
    		{
    			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Added Successfully</div>');
    		}
    
    	}
    	else{
    		$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Data is Missing!!!</div>');
    	}
    	 
    	redirect('blogposts');
    
    }
    
    public function blogposts_post_status()
    {
    	$status=$this->input->post('status');
    	$det=$this->data['detail'];
    
    	$db=array(
    			'items'=>$this->input->post('items'),
    			'user_id'=>$det[0]->id,
    			'modified_date'=>date('Y-m-d H:i:s'),
    			'status'=>$status,
    	);
    	$status=$this->master_db->changeStatus('blogposts_post',$db);
    	echo $status;
    }
    
	public function blogposts_post_edit()
    {
    	$det=$this->data['detail'];
    	
    	$id=$this->input->get('id');
    	
    	if(!empty($id) && $_SERVER['REQUEST_METHOD'] != 'POST')
    	{
    		$details = $this->master_db->getcontent('blogposts_post',$id);
    		if(is_array($details)){
    			$this->data['type']='edit';
		    	$this->data['details']=$details;
		    	$this->load->view('blogposts_postadd',$this->data);
    		}
    		else{
    			redirect('blogposts');
    		}
    	}
    	
    	else if($_SERVER['REQUEST_METHOD']=='POST')
    	{
    		$id=$this->input->post('aid');
    		$db=array(
    				'breif_descp'=>trim(preg_replace('!\s+!', ' ',$this->input->post('breif'))),
    				'title'=>trim(preg_replace('!\s+!', ' ',$this->input->post('title'))),
    				'descp'=>$this->input->post('descp'),
    				'post_by'=>trim(preg_replace('!\s+!', ' ',$this->input->post('post_by'))),
					'modified_date'=>date('Y-m-d H:i:s'),
					'user_id'=>$det[0]->id,
				);

			$res=$this->master_db->updateRecord('blogposts_post',$db,$id);
			
			
			$img1up = false;
			$arry = array("gif","jpg","png","ico","jpeg");
			$uploaddir = '../assets/blogposts/';
			$uploadDBdir= "assets/blogposts/";
			 
			$arrayImage=$_FILES['imag']['name'];
			$arrayTemp=$_FILES['imag']['tmp_name'];
			
			 
			$ext = end(explode(".", $arrayImage));
			if(in_array($ext,$arry)){
				$image_name='blogposts'.time().'1.'.$ext;
				$uploadfile = $uploaddir.$image_name;
				$uploadfileTable1 = $uploadDBdir.$image_name;
				$img1up = move_uploaded_file($arrayTemp,$uploadfile);
				
				$img = $this->master_db->getcontent('blogposts_post',$id);
				unlink('../'.$img[0]->image_path);
				
				$db = array(
						'image_path'=>$uploadfileTable1,
						'user_id'=>$det[0]->id,
				);
//				$size = getimagesize($uploadfile);
//    			$width = $size[0];
//    			$height = $size[1];
    			$this->home_db->resizeImagef($uploadfileTable1, 400,400);
				$res=$this->master_db->updateRecord('blogposts_post',$db,$id);
			}
			
			
    		if($res)
    		{
    			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');
    	
    		}
    		else
    		{
    			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
    	
    		}
    		redirect('blogposts');
    	
    	}
    	else{
    		$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
    		redirect('blogposts');
    	}
    	
    }
    
    
        
//-----blogposts Comments--------//
    public function blogposts_comments()
    {
    	$this->load->view('blogposts_comments',$this->data) ;
    }
    
    public function commentsTable()
    {
    	$db=array(
    			'page'=>$this->input->post('page'),
    			'rp'=>$this->input->post('rp'),
    			'sortname'=>$this->input->post('sortname'),
    			'sortorder'=>$this->input->post('sortorder'),
    			'qtype'=>$this->input->post('qtype'),
    			'query'=>$this->input->post('query'),
    			'letter_pressed'=>$this->input->post('letter_pressed'),
    			'seller'=>$this->input->post('seller'),
    			'fromdate'=>$this->input->post('fromdate'),
    			'todate'=>$this->input->post('todate'),
    			'title'=>$this->input->post('title'),
    			'name'=>$this->input->post('name'),
    			'stat'=>$this->input->post('choosestatus'),
    	);
    	$this->data=$this->about_db->gettable_comments($db);
    	echo $this->data;
    }
    
    public function comments_status()
    {
    	$det=$this->data['detail'];
    	$status=$this->input->post('status');
    
    	$db=array(
    			'items'=>$this->input->post('items'),
    			'user_id'=>$det[0]->id,
    			'status'=>$status,
    	);
    	$status=$this->master_db->changeStatus('blogposts_comments',$db);
    	echo $status;
    }
    
    public function comments_view()
    {
    	$id=$this->uri->segment(3);
    	$details = $this->master_db->getcontent('blogposts_comments',$id);
    	if(is_array($details)){
	    	$this->data['id']=$id;
	    	$this->data['com_details']=$details;
	    	$this->data['details']=$this->master_db->getcontent('blogposts_post',$details[0]->fid);
	    	$this->load->view('viewcomments',$this->data);
    	}
    	else{
    		echo "Invalid";
    	}
    }
    
    public function exportexcel(){
    	$db=array(
    			'fromdate'=>$this->input->get('fromdate'),
    			'todate'=>$this->input->get('todate'),
    			'title'=>$this->input->get('title'),
    			'name'=>$this->input->get('name'),
    			'stat'=>$this->input->get('choosestatus'),
    	);
    	$this->data['export'] = $this->about_db->getexport($db);
    	$this->load->view('exportcomments',$this->data);
    }
    
    public function create_unique_slug($string,$table,$field,$key=NULL,$value=NULL)
    {
    	$t =& get_instance();
    	$slug = url_title($string);
    	$slug = strtolower($slug);
    	$i = 0;
    	$params = array ();
    	$params[$field] = $slug;
    
    	if($key)$params["$key !="] = $value;
    
    	while ($t->db->where($params)->get($table)->num_rows())
    	{
    		if (!preg_match ('/-{1}[0-9]+$/', $slug ))
    			$slug .= '-' . ++$i;
    		else
    			$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
    		 
    		$params [$field] = $slug;
    	}
    	return $slug;
    }
    
	
}

/* End of file master.php */
/* Location: ./application/controllers/master.php */