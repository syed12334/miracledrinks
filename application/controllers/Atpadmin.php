<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Atpadmin extends CI_Controller {

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
        $this->data['detail'] = '';
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
		//echo "dsafdsfsdafdfas".$this->data['detail'];
        $this->data['updatelogin']=$this->load->view('updatelogin', NULL , TRUE);
		$this->data['header']=$this->load->view('header', NULL , TRUE);
        $this->data['newsess'] = $this->data['detail'];
		$this->data['left']=$this->load->view('left', $this->data , TRUE);
		$this->data['jsfile']=$this->load->view('jsfile', NULL , TRUE);
		 
		 
    }

    public function index()
    {
        //echo "<pre>";print_r($this->data['detail']);exit;
       error_reporting(1); ini_set('display_errors', 1);
       //echo "new";exit;
    		
			echo $this->load->view('home',$this->data,true);
       
    } 

    
    

    
    public function logout()
    {
    	$this->updatelogin();
        $this->session->unset_userdata('atpAdmin');
         
	    $cookie = array(
                   'name'   => 'CatpAdmin',
                   'value'  => '',
                   'expire' => '0',
                   'domain' => '.ivarustech.com',
                   'path'   => '/',
                   'prefix' => 'bl_',
               );
		delete_cookie($cookie);
        redirect(base_url());

    }
    
    
    public function updatelogin(){
    	$cookie=$this->data['detail'];
    	if(!empty($cookie))
    	{
    		$id=$cookie[0]->id;
    		$last_login=$cookie[0]->last_login;
    		$db = array(
    				'logout_time'   => date('Y-m-d H:i:s')
    		);
    		$this->home_db->updatelogin($db,$id,$last_login);
    	}
    }
	
	//My profile

	public function myprofile()

	{
		$cookie=$this->data['detail'];
		if(!empty($cookie))
		{				
			$this->data['details']=$cookie;	
	    	$this->load->view('myprofile',$this->data);
		}
		else{
			redirect(base_url());
		}
	}

		

	public function myprofile_edit_save()

	{
		$cookie=$this->data['detail'];
		if(!empty($cookie))
		{
			if($_SERVER['REQUEST_METHOD']=='POST')
			{
			$id=$cookie[0]->id;
			$img = $cookie[0]->profile_img;
			$option=$this->input->post('optionsRadios');
	
			if($option==1)
	
	    		{
	    			
	    			$image=$_FILES['imag']['name'];
	
	    			$ext = explode(".", $image);
					
					$name='p'.$ext[0].time().'.'.$ext[1];
	
	    			$file="assets/profile_images/".$name;
	
	    			$config['upload_path'] = 'assets/profile_images/';
	
	    			$config['allowed_types'] = 'gif|jpg|png|ico';
	
	    			$config['file_name']=$name;
	
	    			$this->load->library('upload', $config);
	    			
	    			if($this->upload->do_upload('imag'))
					{
						if(!empty($img)){
							unlink(''.$img);
						}
	    				$db=array(
							'name'=>trim(preg_replace('!\s+!', ' ',$this->input->post('name'))),
	    					'email'=>trim(preg_replace('!\s+!', ' ',$this->input->post('email'))),
	    					'contact'=>trim(preg_replace('!\s+!', ' ',$this->input->post('contact'))),
	    					'profile_img'=>$file,
							'modified_date'=>date('Y-m-d H:i:s')	
	    				);	
	    				$this->home_db->resizeImage($file,50, 50);
	    			}
	    			else	    			
	    			{	    			
	    				$db=array(
	    						'name'=>trim(preg_replace('!\s+!', ' ',$this->input->post('name'))),
	    						'email'=>trim(preg_replace('!\s+!', ' ',$this->input->post('email'))),
	    						'contact'=>trim(preg_replace('!\s+!', ' ',$this->input->post('contact'))),
	    						'modified_date'=>date('Y-m-d H:i:s')
	    				);	    			
	    			}	
	    		}	
	    		else	
	    		{	
	    			$db=array(
	    						'name'=>trim(preg_replace('!\s+!', ' ',$this->input->post('name'))),
	    						'email'=>trim(preg_replace('!\s+!', ' ',$this->input->post('email'))),
	    						'contact'=>trim(preg_replace('!\s+!', ' ',$this->input->post('contact'))),
	    						'modified_date'=>date('Y-m-d H:i:s')
	    				);	 
	    		}
	
	    		$res=$this->home_db->profile_edit_save($db,$id);
	    		$det=$this->home_db->getdetails($this->session->userdata('atpAdmin'));
	    		$this->data['detail'] = $det;
	    		if($res)	
	    		{	
	    			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Updated Successfully</div>');
        			redirect('atpadmin/myprofile');
	    		}	
	    		else	
	    		{	
	    			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Updation not Successfull</div>');
        			redirect('atpadmin/myprofile');
	    		}
		}
		}

	}	

	
	public function check_password(){
	if($_SERVER['REQUEST_METHOD']=='GET'){
    		$oldpass = $this->input->get('oldpass');
    		$det = $this->data['detail'];
    		$id = $det[0]->passwrd;
    		if(strcmp(sha1($oldpass),$id) == 0){   
    			echo 1;
    		}
    		else{
    			echo 0;
    		}
    		//echo $this->account_db->check_password(sha1($oldpass),$id);
    	}
    	else{
    		echo 0;
    	}
	}
	

	public function changepass()
	{

		$cookie=$this->data['detail'];
		if(!empty($cookie))
		{		
			
			$this->data['details']=$cookie;
	
	    	$this->load->view('changepass',$this->data);
		}
		else{
			redirect(base_url());
		}
	}
		

	public function edit_changepass()
	{
		if($_SERVER['REQUEST_METHOD']=='POST'){
    		$new_pass=$this->input->post('new_pass');
    		$old_pass=$this->input->post('old_pass');
    		
    		$det = $this->data['detail'];
    		$pid = $det[0]->passwrd;
    		$id = $det[0]->id;
    		
    		if(strcmp(sha1($old_pass),$pid) == 0){
    			if(!empty($new_pass)){
	    			$db = array(
	    					'passwrd'=>sha1($new_pass),
	    					'modified_date'=>date('Y-m-d H:i:s')
	    			);
	    			$this->home_db->profile_edit_save($db,$id);
	    			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Password has been changed successfully.</div>');
	    			redirect("atpadmin/changepass");
    			}
    			else{
    				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Enter required details.</div>');
    				redirect("atpadmin/changepass");
    			}
    		}
    		else{
    			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Invalid Old Password.</div>');
    			redirect("atpadmin/changepass");
    		}
    	}
    	else{
    		redirect(base_url());
    	}	

	}


    public function settings()
    {
        $this->data['settings']=$this->master_db->getcontent('settings','');
        $this->load->view('settings',$this->data);

    }

    public function settings_save()

    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $fdata = $this->master_db->getcontent('settings','');
            $db=array(
                'delivery_days'=>$this->input->post('delivery_days'),
                'order_email'=>$this->input->post('oemail'),
                'product_terms'=>$this->input->post('text'),
                
            );
            if(is_array($fdata)){
                $res = $this->master_db->updateRecord('settings',$db,$fdata[0]->id);
            }
            else{
                $res = $this->master_db->insertRecord('settings',$db);
            }
            if($res)
            {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Updated Successfull</div>');
            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Updation Not Successfull</div>');

            }
            redirect('atpadmin/settings');
        }

    }
    
    public function graph_orders(){
    	$this->data['fromdate'] = $this->input->post('fromdate');
    	$this->data['todate'] = $this->input->post('todate');
        //echo "<pre>";print_r($_POST);exit;
    	$this->load->view('orders_graph',$this->data);
    }
	
	
	
}

/* End of file hmAdmin.php */
/* Location: ./application/controllers/hmAdmin.php */