<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sociallinks extends CI_Controller {

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

    

    public function index()
    {
        $this->data['type']='edit';
        $this->data['links']=$this->master_db->getcontent('social_links','');
        $this->load->view('socialLinks_view',$this->data);
    }


    public function link_save()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $fdata = $this->master_db->getcontent('social_links','');
            $db=array(

                'facebook'=>$this->input->post('facebook'),
                'twitter'=>$this->input->post('twitter'),
                'rssfeeds'=>$this->input->post('linkedin'),
                'googleplus'=>$this->input->post('googleplus'),
                'insta'=>$this->input->post('insta')



            );
            if(is_array($fdata)){
                $res = $this->master_db->updateRecord('social_links',$db,$fdata[0]->id);
            }
            else{
                $res = $this->master_db->insertRecord('social_links',$db);
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
        redirect('sociallinks');

    }








}

