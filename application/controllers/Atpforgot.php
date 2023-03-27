<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Atpforgot extends CI_Controller {

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
        no_cache();
        $this->load->model('home_db');
     }
    
    
    public function forgotpass()
    {
    	$this->data['header']=$this->load->view('header', NULL , TRUE);
    	$this->data['left']=$this->load->view('left', $this->data , TRUE);
    	if($this->input->post('emailid')!='')
    	{
    		$db=$this->input->post('emailid');    		    		//echo "cdsdfdsf".$db;
    		$em=$this->home_db->getemailId($db);    		    		//echo "hdfg ".$em;
    		if($em=="1") // login check
    		{    			///echo "aaaa";    			$em2=$this->home_db->getvalidemailId($db);    			if($em2=="1")    			{ 
    			$newpass=$this->home_db->updatepassword($db);
    			$data1['id']=$db;
				$data1['mail']=$newpass;
				$body='Hi, <br><br>Your Artiiplant Account Details are below: <br><br><strong>Username</strong> : '.$db.'<br><strong>Password</strong> : '.$newpass.' <br><br><a href="'.base_url().'">Click Here</a> to Login.';
			
				$this->load->library('email');
				$config = array (
					'mailtype' => 'html',
					'charset'  => 'utf-8',
					'priority' => '1'
				);
				$this->email->initialize($config);
				$this->email->from('noreply@noviley.com','Admin');
				$this->email->to($db);
				$this->email->subject('Your Artiiplant Account Password');
				$this->email->message($body);
				$this->email->send();
				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>Your New Password has been mailed to your email Id</div>');
				redirect('atpforgot/forgot');    			
    		}    			
    		else 
    		{   
    			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>Invalid Email ID!!! Please Contact Your Administrator.</div>');
    			redirect('atpforgot/forgot');
    		}				
				
    		}
    		else
    		{    			///echo "bbbb";
    		$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>Invalid Email ID</div>');
    			redirect('atpforgot/forgot');
    			
    		}
    	
    
    }
    
    public function forgot()
    {
    	
    	//$this->session->set_flashdatas('message','no message');
    	$this->load->view('forgot');    
    }
    
}

/* End of file blueadmin.php */
/* Location: ./application/controllers/blueadmin.php */