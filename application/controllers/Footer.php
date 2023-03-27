<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Footer extends CI_Controller {

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
        $this->data['jsfile']=$this->load->view('jsfile', NULL , TRUE);
    }

    

    public function deliveryinfo()
    {
        $this->data['type']='edit';
        $this->data['info']=$this->master_db->getcontent('footer_policy','');
        $this->load->view('deliveryinfo',$this->data);
    }


    public function deliveryinfo_save()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $fdata = $this->master_db->getcontent('footer_policy','');
            $db=array(

                'deliveryinfo_policy'=>$this->input->post('privacy'),


            );
            if(is_array($fdata)){
                $res = $this->master_db->updateRecord('footer_policy',$db,$fdata[0]->id);
            }
            else{
                $res = $this->master_db->insertRecord('footer_policy',$db);
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
        redirect('footer/deliveryinfo');

    }


    public function privacyPolicy()
    {
        $this->data['type']='edit';
        $this->data['info']=$this->master_db->getcontent('footer_policy','');
        $this->load->view('privacypolicy',$this->data);
    }


    public function privacyPolicy_save()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $fdata = $this->master_db->getcontent('footer_policy','');
            $db=array(

                'privacy_policy'=>$this->input->post('privacy'),


            );
            if(is_array($fdata)){
                $res = $this->master_db->updateRecord('footer_policy',$db,$fdata[0]->id);
            }
            else{
                $res = $this->master_db->insertRecord('footer_policy',$db);
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
        redirect('footer/privacyPolicy');

    }

    public function customerservice()
    {
        $this->data['type']='edit';
        $this->data['info']=$this->master_db->getcontent('footer_policy','');
        $this->load->view('customerservice',$this->data);
    }


    public function customerservice_save()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $fdata = $this->master_db->getcontent('footer_policy','');
            $db=array(

                'customerservice'=>$this->input->post('privacy'),


            );
            if(is_array($fdata)){
                $res = $this->master_db->updateRecord('footer_policy',$db,$fdata[0]->id);
            }
            else{
                $res = $this->master_db->insertRecord('footer_policy',$db);
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
        redirect('footer/customerservice');

    }




    public function termsofUse()
    {
        $this->data['type']='edit';
        $this->data['info']=$this->master_db->getcontent('footer_policy','');
        $this->load->view('termsofuse',$this->data);
    }


    public function termsofUse_save()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $fdata = $this->master_db->getcontent('footer_policy','');
            $db=array(

                'terms_of_use'=>$this->input->post('privacy'),


            );
            if(is_array($fdata)){
                $res = $this->master_db->updateRecord('footer_policy',$db,$fdata[0]->id);
            }
            else{
                $res = $this->master_db->insertRecord('footer_policy',$db);
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
        redirect('footer/termsofUse');

    }


    function contact()
    {
        $this->data['message']='';
        $this->data['info']=$this->master_db->getcontent('contactus','');
        $this->load->view('contact',$this->data);
    }

    function contact_save()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')

//echo "<pre>";print_r($_POST);exit;
        {
            $fdata = $this->master_db->getcontent('contactus','');
            $db=array(
                'address'=>$this->input->post('address'),
                'phone'=>$this->input->post('phone'),
                'email'=>$this->input->post('email'),
                'time'=>$this->input->post('time'),
                'iframe'=>$this->input->post('iframe'),

            );

            if(is_array($fdata)){
                $res = $this->master_db->updateRecord('contactus',$db,$fdata[0]->id);
            }
            else{
                $res = $this->master_db->insertRecord('contactus',$db);
            }

            
            $fdata = $this->master_db->getcontent('settings','');
            $db=array(
            
            		'phone'=>$this->input->post('phone'),
            		'time'=>$this->input->post('time'),
            
            );
            if(is_array($fdata)){
            	$this->master_db->updateRecord('settings',$db,$fdata[0]->id);
            }
            else{
            	$this->master_db->insertRecord('settings',$db);
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
        redirect('footer/contact');
    }



    public function termsandconditions()
    {
        $this->data['type']='edit';
        $this->data['info']=$this->master_db->getcontent('footer_policy','');
        $this->load->view('termsofuse1',$this->data);
    }


    public function conditions_save()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $fdata = $this->master_db->getcontent('footer_policy','');
            $db=array(

                'conditions'=>$this->input->post('privacy'),


            );
            if(is_array($fdata)){
                $res = $this->master_db->updateRecord('footer_policy',$db,$fdata[0]->id);
            }
            else{
                $res = $this->master_db->insertRecord('footer_policy',$db);
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
        redirect('footer/termsandconditions');

    }

    public function returnrefund() {
          $this->data['type']='edit';
        $this->data['info']=$this->master_db->getcontent('return_policy','');
        $this->load->view('returnrefund',$this->data);
    }
    public function refund_save()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $fdata = $this->master_db->getcontent('return_policy','');
            $db=array(

                'returnpolicy'=>$this->input->post('privacy'),


            );
            if(is_array($fdata)){
                $res = $this->master_db->updateRecord('return_policy',$db,$fdata[0]->id);
            }
            else{
                $res = $this->master_db->insertRecord('return_policy',$db);
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
        redirect('footer/returnrefund');

    }
}

