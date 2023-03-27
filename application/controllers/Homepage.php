<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends CI_Controller {

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
        $this->data['left']=$this->load->view('left', $this->data , TRUE); 
        $this->data['jsfile']=$this->load->view('jsfile', NULL , TRUE);
    }

    
    

//*************Banner**************//
    
    public function banner()    
    {
		$this->data['banner'] = $this->load->view('getbanner', $this->data, TRUE);
    	$this->load->view('banner',$this->data);
    
    }
    
    public function banner_table()    
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
		$this->data=$this->home_db->banner_table($db);
		echo $this->data;
    
    }
    
    public function banner_add()    
    {
    
    	$this->data['type']='add';    
    	$this->load->view('banneradd',$this->data);
    
    }
    
    function banner_save()    
    {
    
    	$det=$this->data['detail'];
    		
    	$img1up = false;
		$arry = array("gif","jpg","png","jpeg");
		$uploaddir = 'assets/our_products/';
		$uploadDBdir= "assets/our_products/";

		$arrayImage=$_FILES['imag']['name'];
		$arrayTemp=$_FILES['imag']['tmp_name'];

		
		$ext = end(explode(".", $arrayImage));
		if(in_array($ext,$arry))
		{            	
			$image_name='banner'.time().'1.'.$ext;
			$uploadfile = $uploaddir.$image_name;
			$uploadfileTable1 = $uploadDBdir.$image_name;
			$img1up = move_uploaded_file($arrayTemp,$uploadfile); 
			$res = 0;
			/*$this->load->library('upload', $config);
			if($this->upload->do_upload('imag'))
			{*/
    
    		$db = array(
    				'order_no'=>$this->input->post('orderno'),
                    'banner_link'=>$this->input->post('btext'),
                    'descp'=>$this->input->post('descp'),
    				'banner_image'=>$uploadfileTable1,
    				'status'=>'0',
    				'created_date'=>date('Y-m-d H:i:s'),
    				'modified_date'=>date('Y-m-d H:i:s'),
    				'user_id'=>$det[0]->id
    		);
    		$res=$this->master_db->insertRecord('banner',$db);
		}
			//echo $this->db->last_query();exit;
    		//$this->home_db->resizeImagef($file,1170, 300);
    	/*}*/
    
    	if($res)    
    	{    		
    		$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Banner Added Successfully</div>');
    
    	}    
    	else    
    	{    
    		$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
    	}
    	redirect('homepage/banner');
    }
    
    
    
				public function banner_status()
        		{
					$items = $this->input->post('items');
					$status = $this->input->post('status');
					$db=array(
					'items'=>$items,
					'status'=>$status,
					'modified_date'=>date('Y-m-d H:i:s'),
					);
					$this->master_db->changeStatus('banner',$db);
					if($status == 2)
					{
						$this->master_db->deleterecordss('banner',array("id"=>$items));
					}
					$this->data['banner'] = $this->load->view('getbanner', $this->data ,TRUE);
					echo $this->data['banner'];
        		}
    
    public function banner_edit()    
    {
    
    	$det=$this->data['detail'];
    	
    	$id=$this->input->get('id');
    	
    	if(!empty($id) && $_SERVER['REQUEST_METHOD'] != 'POST')
    	{
    		$details = $this->master_db->getcontent('banner',$id); 
			//echo $this->db->last_query();exit;
    		if(is_array($details)){
    			$this->data['type']='edit';
		    	$this->data['bannerdetail']=$details;
		    	$this->load->view('banneradd',$this->data);
    		}
    		else{
    			redirect('homepage/banner');
    		}
    	}
    	
    	else if($_SERVER['REQUEST_METHOD']=='POST')
    	{
    		$id=$this->input->post('aid');
    		$db=array(

    				'order_no'=>trim(preg_replace('!\s+!', ' ',$this->input->post('orderno'))),
					'modified_date'=>date('Y-m-d H:i:s'),
    				'banner_link'=>$this->input->post('btext'),
    				'descp'=>$this->input->post('descp'),
					'user_id'=>$det[0]->id,
					
				);

			$res=$this->master_db->updateRecord('banner',$db,$id);
			
			
			$img1up = $img2up = false;
			$arry = array("gif","jpg","png","ico","jpeg");
			$uploaddir = 'assets/our_products/';
			$uploadDBdir= "assets/our_products/";

			$arrayImage=$_FILES['imag']['name'];
			$arrayTemp=$_FILES['imag']['tmp_name'];
			$ext = end(explode(".", $arrayImage));

			if(in_array($ext,$arry)){
				$image_name='banner'.time().'1.'.$ext;
				$uploadfile = $uploaddir.$image_name;
				$uploadfileTable1 = $uploadDBdir.$image_name;
				$img1up = move_uploaded_file($arrayTemp,$uploadfile);
				$img = $this->master_db->getcontent('banner',$id);
				unlink('../'.$img[0]->banner_image);
			
				$db = array(
						'banner_image'=>$uploadfileTable1,
						'user_id'=>$det[0]->id,
				);
				//$this->home_db->resizeImagef($uploadfileTable1, 1170, 300);
				$res=$this->master_db->updateRecord('banner',$db,$id);
			}
			
			
    		if($res)
    		{
    			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');
    	
    		}
    		else
    		{
    			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
    	
    		}
    		redirect('homepage/banner');
    	
    	}
    	else{
    		$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
    		redirect('homepage/banner');
    	}
    }




    //*************Clients**************//

    public function client()
    {
		$this->data['client'] = $this->load->view('getclient', $this->data, TRUE);
        $this->load->view('client',$this->data);

    }

    public function client_table()
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
        $this->data=$this->home_db->client_table($db);
        echo $this->data;

    }

    public function client_add()
    {

        $this->data['type']='add';
        $this->load->view('clientadd',$this->data);

    }

    function client_save()
    {

        $det=$this->data['detail'];

       $img1up = false;
		$arry = array("gif","jpg","png","ico","jpeg");
		$uploaddir = 'assets/our_products/';
		$uploadDBdir= "assets/our_products/";

		$arrayImage=$_FILES['imag']['name'];
		$arrayTemp=$_FILES['imag']['tmp_name'];

		
		$ext = end(explode(".", $arrayImage));
		if(in_array($ext,$arry))
		{            	
			$image_name='banner'.'.'.$ext;
			$uploadfile = $uploaddir.$image_name;
			$uploadfileTable1 = $uploadDBdir.$image_name;
			$img1up = move_uploaded_file($arrayTemp,$uploadfile); 
        $res = 0;
       /* $this->load->library('upload', $config);
        if($this->upload->do_upload('imag'))
        {*/

            $db = array(
                'order_no'=>$this->input->post('orderno'),
                'name' => $this->input->post('name'),
                'category'=>trim(preg_replace('!\s+!', ' ',$this->input->post('ctgry'))),
                'client_image'=>$uploadfileTable1,
                'status'=>'0',
                'created_date'=>date('Y-m-d H:i:s'),
                'modified_date'=>date('Y-m-d H:i:s'),

            );

            $res=$this->master_db->insertRecord('clients',$db);
            $this->home_db->resizeImagef($file,189, 76);
        }

        if($res)
        {
            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Client Added Successfully</div>');

        }
        else
        {
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
        }
        redirect('homepage/client');
    }



    public function client_status()
    {
       $items = $this->input->post('items');
		$status = $this->input->post('status');
		$db=array(
		'items'=>$items,
		'status'=>$status,
		'modified_date'=>date('Y-m-d H:i:s'),
		);
		$this->master_db->changeStatus('clients',$db);
		if($status == 2)
		{
			$this->master_db->deleterecord('clients',array("id"=>$items));
		}
		$this->data['clients'] = $this->load->view('getclient', $this->data ,TRUE);
		echo $this->data['clients'];
    }

    public function client_edit()
    {

        $det=$this->data['detail'];

        $id=$this->input->get('id');

        if(!empty($id) && $_SERVER['REQUEST_METHOD'] != 'POST')
        {
            $details = $this->master_db->getcontent('clients',$id);
            if(is_array($details)){
                $this->data['type']='edit';
                $this->data['info']=$details;
                $this->load->view('clientadd',$this->data);
            }
            else{
                redirect('homepage/client');
            }
        }

        else if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $db=array(

                'order_no'=>trim(preg_replace('!\s+!', ' ',$this->input->post('orderno'))),
                'name' => $this->input->post('name'),
                'modified_date'=>date('Y-m-d H:i:s'),
                'category'=>trim(preg_replace('!\s+!', ' ',$this->input->post('ctgry'))),


            );

            $res=$this->master_db->updateRecord('clients',$db,$id);


            $img1up = $img2up = false;
            $arry = array("gif","jpg","png","ico","jpeg");
            $uploaddir = 'assets/our_products/';
            $uploadDBdir= "assets/our_products/";

            $arrayImage=$_FILES['imag']['name'];
            $arrayTemp=$_FILES['imag']['tmp_name'];


            $ext = end(explode(".", $arrayImage));
            if(in_array($ext,$arry)){
                $image_name='client'.time().'1.'.$ext;
                $uploadfile = $uploaddir.$image_name;
                $uploadfileTable1 = $uploadDBdir.$image_name;
                $img1up = move_uploaded_file($arrayTemp,$uploadfile);

                $img = $this->master_db->getcontent('clients',$id);
                unlink('../'.$img[0]->banner_image);

                $db = array(
                    'client_image'=>$uploadfileTable1,

                );
                $this->home_db->resizeImagef($uploadfileTable1, 189, 76);
                $res=$this->master_db->updateRecord('clients',$db,$id);
            }


            if($res)
            {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');

            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');

            }
            redirect('homepage/client');

        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
            redirect('homepage/client');
        }
    }












    //-----How It Works--------//
    public function ourproducts()
    {
    	$this->load->view('ourproducts',$this->data) ;
    }
    
    public function ourproducts_table()
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
    	$this->data=$this->home_db->ourproducts_table($db);
    	echo $this->data;    
    }
    
    public function ourproducts_edit()
    {
    	$det=$this->data['detail'];
    	
    	$id=$this->input->get('id');
    	
    	if(!empty($id) && $_SERVER['REQUEST_METHOD'] != 'POST')
    	{
    		$details = $this->master_db->getcontent('our_products',$id);
    		if(is_array($details)){
    			$this->data['type']='edit';
		    	$this->data['workdetail']=$details;
		    	$this->load->view('editourproducts',$this->data);
    		}
    		else{
    			redirect('homepage/ourproducts');
    		}
    	}
    	
    	else if($_SERVER['REQUEST_METHOD']=='POST')
    	{
    		$id=$this->input->post('aid');
    		$db=array(

    				'order_no'=>$this->input->post('orderno'),
    				'title'=>trim(preg_replace('!\s+!', ' ',$this->input->post('title'))),
    				'sub_title'=>trim(preg_replace('!\s+!', ' ',$this->input->post('sub_title'))),
					'modified_date'=>date('Y-m-d H:i:s'),
					'user_id'=>$det[0]->id,					
				);

			$res=$this->master_db->updateRecord('our_products',$db,$id);
			
			
			$img1up = false;
			$arry = array("gif","jpg","png","ico","jpeg");
			$uploaddir = 'assets/our_products/';
			$uploadDBdir= "assets/our_products/";
			 
			$arrayImage=$_FILES['imag']['name'];
			$arrayTemp=$_FILES['imag']['tmp_name'];
			
			 
			$ext = end(explode(".", $arrayImage));
			if(in_array($ext,$arry)){
				$image_name='design'.time().'1.'.$ext;
				$uploadfile = $uploaddir.$image_name;
				$uploadfileTable1 = $uploadDBdir.$image_name;
				$img1up = move_uploaded_file($arrayTemp,$uploadfile);
				
				$img = $this->master_db->getcontent('our_products',$id);
				unlink('../'.$img[0]->image_path);
				
				$db = array(
						'image_path'=>$uploadfileTable1,
						'user_id'=>$det[0]->id,
				);
				$this->home_db->resizeImagef($uploadfileTable1, 244, 124);
				$res=$this->master_db->updateRecord('our_products',$db,$id);
			}
			
			
    		if($res)
    		{
    			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');
    	
    		}
    		else
    		{
    			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
    	
    		}
    		redirect('homepage/ourproducts');
    	
    	}
    	else{
    		$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
    		redirect('homepage/ourproducts');
    	}
    }
    
    public function ourproducts_status()
    {
    	$status=$this->input->post('status');
    	$det=$this->data['detail'];
    	 
    	$db=array(
    			'items'=>$this->input->post('items'),
    			'user_id'=>$det[0]->id,
    			'modified_date'=>date('Y-m-d H:i:s'),
    			'status'=>$status,
    	);
    	$status=$this->master_db->changeStatus('our_products',$db);
    	echo $status;
    }


//    ************************************************************Advertise****************************************************


    public function advertise()
    {

        $det=$this->data['detail'];

        $id = 1;

        if(!empty($id) && $_SERVER['REQUEST_METHOD'] != 'POST')
        {
            $details = $this->master_db->getcontent('advertise',$id);
            if(is_array($details)){
                $this->data['type']='edit';
                $this->data['advertise']=$details;
                $this->load->view('advertise',$this->data);
            }
            else{
                redirect('homepage/advertise');
            }
        }

        else if($_SERVER['REQUEST_METHOD']=='POST')
        {


            $db = array(

                'leftlink'=>$this->input->post('link'),
                'rightlink'=>$this->input->post('link1')
            );

            $res=$this->master_db->updateRecord('advertise',$db,$id);


            $img1up = $img2up = false;
            $arry = array("gif","jpg","png","ico","jpeg");
            $uploaddir = 'assets/our_products/';
            $uploadDBdir= "assets/our_products/";

            $arrayImage=$_FILES['imag1']['name'];
            $arrayTemp=$_FILES['imag1']['tmp_name'];

            $arrayImage1=$_FILES['imag2']['name'];
            $arrayTemp1=$_FILES['imag2']['tmp_name'];


            $ext = end(explode(".", $arrayImage));
            if(in_array($ext,$arry)){
                $image_name='advertise'.time().'1.'.$ext;
                $uploadfile = $uploaddir.$image_name;
                $uploadfileTable1 = $uploadDBdir.$image_name;
                $img1up = move_uploaded_file($arrayTemp,$uploadfile);

                $img = $this->master_db->getcontent('advertise',$id);
                unlink('../'.$img[0]->banner_image);

                $db = array(
                    'leftimage'=>$uploadfileTable1,
                    'leftlink'=>$this->input->post('link')

                );
                $this->home_db->resizeImagef($uploadfileTable1, 1097, 410);
                $res=$this->master_db->updateRecord('advertise',$db,$id);
            }


            $ext = end(explode(".", $arrayImage1));
            if(in_array($ext,$arry)){
                $image_name='advertise'.time().'2.'.$ext;
                $uploadfile = $uploaddir.$image_name;
                $uploadfileTable1 = $uploadDBdir.$image_name;
                $img1up = move_uploaded_file($arrayTemp1,$uploadfile);

                $img = $this->master_db->getcontent('advertise',$id);
                unlink('../'.$img[0]->banner_image);

                $db = array(
                    'rightimage'=>$uploadfileTable1,
                    'rightlink'=>$this->input->post('link1')

                );
                $this->home_db->resizeImagef($uploadfileTable1, 1097, 410);
                $res=$this->master_db->updateRecord('advertise',$db,$id);
            }


            if($res)
            {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');

            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');

            }
            redirect('homepage/advertise');

        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
            redirect('homepage/advertise');
        }
    }


	public function gifts(){
		$this->data['gifts'] = $this->load->view('getgifts', $this->data, TRUE);
        $this->load->view('gifts',$this->data);
    }

    public function gifts_add(){
        $this->load->view('giftsadd',$this->data);
    }


    

    public function gifts_table()
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
        $this->data=$this->home_db->gifts_table($db);
        echo $this->data;
    }


    public function gifts_status()
    {
       $items = $this->input->post('items');
		$status = $this->input->post('status');
		$db=array(
		'items'=>$items,
		'status'=>$status,
		'modified_date'=>date('Y-m-d H:i:s'),
		);
		$this->master_db->changeStatus('gifts',$db);
		if($status == 2)
		{
			$this->master_db->deleterecordss('gifts',array("id"=>$items));
		}
		$this->data['gifts'] = $this->load->view('getgifts', $this->data ,TRUE);
		echo $this->data['gifts'];
    }


    public function getproducts(){
        $id = $this->input->post('cid');

        if($id != 'All'){
        $data = $this->master_db->getcontent2('products','cat_id',$id,'0');

        if(is_array($data)){
            foreach ($data as $pro){
                $id = str_replace(" ","_",$pro->name);
                echo "<option id='{$pro->id}' class='{$pro->cat_id}' value='".$pro->id."'>".$pro->name." [".$pro->pcode."]</option>";
            }
        }

        else{
            echo "";
        }
        }
        if($id == 'All'){

            $data = $this->master_db->getcontent2('products','','','0');

            if(is_array($data)){
                foreach ($data as $pro){
                    $id = str_replace(" ","_",$pro->name);
                    echo "<option id='{$pro->id}' class='{$pro->cat_id}' value='".$pro->id."'>".$pro->name." [".$pro->pcode."]</option>";
                }
            }

            else{
                echo "";
            }


        }
    }



    function gift_save()
    {
         $det=$this->data['detail'];

	     $db=array(
			'order_no'=>trim(preg_replace('!\s+!', ' ',$this->input->post('orderno'))),
			'title'=>$this->input->post('name'),
			'modified_date'=>date('Y-m-d H:i:s'),
			'user_id'=>$det[0]->id,
		 );

        $this->master_db->insertRecord('gifts',$db);
		
		$img1up = $img2up = false;
		$arry = array("gif","jpg","png","ico","jpeg");
		$uploaddir = 'assets/our_products/';
		$uploadDBdir= "assets/our_products/";

		$arrayImage=$_FILES['imag']['name'];
		$arrayTemp=$_FILES['imag']['tmp_name'];


		$ext = end(explode(".", $arrayImage));
		if(in_array($ext,$arry)){
			$image_name='gift'.time().'1.'.$ext;
			$uploadfile = $uploaddir.$image_name;
			$uploadfileTable1 = $uploadDBdir.$image_name;
			$img1up = move_uploaded_file($arrayTemp,$uploadfile);

			$img = $this->master_db->getcontent('gifts',$id);
			unlink('../'.$img[0]->image_path);

			$db = array(
				'image_path'=>$uploadfileTable1,

				'order_no'=>trim(preg_replace('!\s+!', ' ',$this->input->post('orderno'))),
				'title'=>$this->input->post('name'),
				'modified_date'=>date('Y-m-d H:i:s'),
				'user_id'=>$det[0]->id,
			);
			//$this->home_db->resizeImagef($uploadfileTable1, 91, 93);
		   $this->master_db->updateRecord('gifts',$db,$id);

		}
        if($res)
        {
            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Gifts Added Successfully</div>');

        }
        else
        {
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
        }
        redirect('homepage/gifts');
    }



    public function gifts_edit()
    {

        $det=$this->data['detail'];

        $id=$this->input->get('id');

        if(!empty($id) && $_SERVER['REQUEST_METHOD'] != 'POST')
        {
            $details = $this->master_db->getcontent('gifts',$id);
            if(is_array($details)){
                $this->data['type']='edit';
                $this->data['gft']=$details;
                $this->load->view('giftsedit',$this->data);
            }
            else{
                redirect('homepage/gifts');
            }
        }

        else if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $db=array(

                'order_no'=>trim(preg_replace('!\s+!', ' ',$this->input->post('orderno'))),
                'title'=>$this->input->post('name'),
                'modified_date'=>date('Y-m-d H:i:s'),
                'user_id'=>$det[0]->id,

            );

            $this->master_db->updateRecord('gifts',$db,$id);


            $img1up = $img2up = false;
            $arry = array("gif","jpg","png","ico","jpeg");
            $uploaddir = 'assets/our_products/';
            $uploadDBdir= "assets/our_products/";

            $arrayImage=$_FILES['imag']['name'];
            $arrayTemp=$_FILES['imag']['tmp_name'];


            $ext = end(explode(".", $arrayImage));
            if(in_array($ext,$arry)){
                $image_name='gift'.time().'1.'.$ext;
                $uploadfile = $uploaddir.$image_name;
                $uploadfileTable1 = $uploadDBdir.$image_name;
                $img1up = move_uploaded_file($arrayTemp,$uploadfile);

                $img = $this->master_db->getcontent('gifts',$id);
                unlink('../'.$img[0]->image_path);

                $db = array(
                    'image_path'=>$uploadfileTable1,

                    'order_no'=>trim(preg_replace('!\s+!', ' ',$this->input->post('orderno'))),
                    'title'=>$this->input->post('name'),
                    'modified_date'=>date('Y-m-d H:i:s'),
                    'user_id'=>$det[0]->id,
                );
                //$this->home_db->resizeImagef($uploadfileTable1, 91, 93);
               $this->master_db->updateRecord('gifts',$db,$id);

            }

            
            
            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');

            
            redirect('homepage/gifts');

        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
            redirect('homepage/gifts');
        }
    }



//    ***************************************************Client Category**********************************************

    public function clientscategory()
    {
		$this->data['clientscategory'] = $this->load->view('getclientscategory', $this->data, TRUE);
        $this->load->view('clientscategory',$this->data) ;
    }

    public function clientscategory_table()
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
        $this->data=$this->master_db->gettable_clientscategory($db);
        echo $this->data;
    }

    public function clientscategory_add()
    {
        $this->data['type']='add';

        $this->load->view('editclientscategory',$this->data);
    }

    function clientscategory_save()
    {
        $det=$this->data['detail'];
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $post=$this->input->post(null,true);

            for($i=0;$i<count($_POST['np']);$i++)
            {
                $name=$post['np'] ;
                $order=$post['order'] ;
                if(!empty($name[$i]) && !empty($order[$i]))
                {
                    $check = $this->master_db->dup_check('clientscategory',trim(preg_replace('!\s+!', ' ',$name[$i])),'');
                    if($check == "0"){
                        $db=array(
                            'name'=>trim(preg_replace('!\s+!', ' ',$name[$i])),
                            'order_no' => trim(preg_replace('!\s+!', ' ',$order[$i])),
							'status'=>'0',
                        );
                        $res1=$this->master_db->insertRecord('clientscategory',$db);
                    }
                }
            }

            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Client Category Added Successfully</div>');


            redirect('homepage/clientscategory');
        }
        else{
            redirect(base_url());
        }
    }



    public function clientscategory_status()
    {
        $items = $this->input->post('items');
		$status = $this->input->post('status');
		$db=array(
		'items'=>$items,
		'status'=>$status,
		'modified_date'=>date('Y-m-d H:i:s'),
		);
		$this->master_db->changeStatus('clientscategory',$db);
		if($status == 2)
		{
			$this->master_db->deleterecord('clientscategory',array("id"=>$items));
		}
		$this->data['clientscategory'] = $this->load->view('getclientscategory', $this->data ,TRUE);
		echo $this->data['clientscategory'];
    }

    public function clientscategory_edit(){
        $det=$this->data['detail'];

        $id=$this->input->get('id');

        if($id)
        {
            $this->data['type']='edit';

            $this->data['details']=$this->master_db->getcontent('clientscategory',$id);
            $this->load->view('editclientscategory',$this->data);
        }

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');

            $name = trim(preg_replace('!\s+!', ' ',$this->input->post('name')));
            $order = trim(preg_replace('!\s+!', ' ',$this->input->post('order')));
            $db=array(
                'name'=>$name,
                'order_no'=>$order



            );
            $check = $this->master_db->dup_check('clientscategory',$name,$id);
            if($check == "0"){
                $res=$this->master_db->updateRecord('clientscategory',$db,$id);
            }
            if($res)
            {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');

            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');

            }
            redirect('homepage/clientscategory');

        }
    }
	/*********** advertisement*****/
	 public function special_banner()
    {
        $this->data['type']='edit';
        $this->data['info']=$this->master_db->getcontent('special_banner','');
        $this->load->view('special_banner_view',$this->data);
    }


    public function special_banner_save()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $fdata = $this->master_db->getcontent('special_banner','');
            $db=array(
                'description'=>$this->input->post('description'),
            );
            if(is_array($fdata)){
                $res = $this->master_db->updateRecord('special_banner',$db,$fdata[0]->id);
            }
            else{
                $res = $this->master_db->insertRecord('special_banner',$db);
            }
			$img1up = false;
            $arry = array("gif","jpg","png","ico","jpeg");
            $uploaddir = 'assets/our_products/';
            $uploadDBdir= "assets/our_products/";

            $arrayImage=$_FILES['imag']['name'];
            $arrayTemp=$_FILES['imag']['tmp_name'];


            $ext = end(explode(".", $arrayImage));
            if(in_array($ext,$arry)){
                $image_name='about'.time().'1.'.$ext;
                $uploadfile = $uploaddir.$image_name;
                $uploadfileTable1 = $uploadDBdir.$image_name;
                $img1up = move_uploaded_file($arrayTemp,$uploadfile);

                $img = $this->master_db->getcontent('special_banner',1);
                unlink('../'.$img[0]->banner);

                $db = array(
                    'banner'=>$uploadfileTable1,

                );
                $res=$this->master_db->updateRecord('special_banner',$db,1);
            }
			$img2up = false;
            $arry = array("gif","jpg","png","ico","jpeg");
            $uploaddir = 'assets/our_products/';
            $uploadDBdir= "assets/our_products/";

            $arrayImage=$_FILES['image']['name'];
            $arrayTemp=$_FILES['image']['tmp_name'];


            $ext = end(explode(".", $arrayImage));
            if(in_array($ext,$arry)){
                $image_name='about'.time().'1.'.$ext;
                $uploadfile = $uploaddir.$image_name;
                $uploadfileTable1 = $uploadDBdir.$image_name;
                $img2up = move_uploaded_file($arrayTemp,$uploadfile);

                $img = $this->master_db->getcontent('special_banner',1);
                unlink('../'.$img[0]->spcl_img);

                $db = array(
                    'spcl_img'=>$uploadfileTable1,

                );
                $res=$this->master_db->updateRecord('special_banner',$db,1);
            }


            if($res)
            {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Updated Successfull</div>');

            }
            else
            {

                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Updation Not Successfull</div>');

            }

        }
        redirect('homepage/special_banner');

    }

	
}

/* End of file master.php */
/* Location: ./application/controllers/master.php */