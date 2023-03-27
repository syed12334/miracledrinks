<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class about extends CI_Controller {

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


    function index()
    {
        $this->data['message']='';
        $this->data['info']=$this->master_db->getcontent('aboutus','');
        $this->load->view('aboutus',$this->data);
    }

    function about_save()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')


        {
            $fdata = $this->master_db->getcontent('aboutus','');
            $db=array(
                'text'=>$this->input->post('text'),


            );

            if(is_array($fdata)){
                $res = $this->master_db->updateRecord('aboutus',$db,$fdata[0]->id);
            }
            else{
                $res = $this->master_db->insertRecord('aboutus',$db);
            }




            $img1up = false;
            $arry = array("gif","jpg","png","ico","jpeg");
            $uploaddir = '../assets/about/';
            $uploadDBdir= "assets/about/";

            $arrayImage=$_FILES['imag']['name'];
            $arrayTemp=$_FILES['imag']['tmp_name'];


            $ext = end(explode(".", $arrayImage));
            if(in_array($ext,$arry)){
                $image_name='about'.time().'1.'.$ext;
                $uploadfile = $uploaddir.$image_name;
                $uploadfileTable1 = $uploadDBdir.$image_name;
                $img1up = move_uploaded_file($arrayTemp,$uploadfile);

                $img = $this->master_db->getcontent('aboutus',1);
                unlink('../'.$img[0]->path);

                $db = array(
                    'path'=>$uploadfileTable1,

                );
                $this->home_db->resizeImagef($uploadfileTable1,400, 400);
                $res=$this->master_db->updateRecord('aboutus',$db,1);
                $this->home_db->resizeImagef($uploadfileTable1,400, 400);
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
        redirect('about/index');
    }


    //-----Customer Stories--------//
    public function stories()
    {
		$this->data['testimonials'] = $this->load->view('gettestimonials', $this->data, TRUE);
        $this->load->view('testimonials',$this->data) ;
    }

    public function stories_table()
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
        $this->data=$this->about_db->gettable_testimonials($db);
        echo $this->data;
    }

    public function stories_add()
    {
        $this->data['type']='add';
        $this->load->view('testimonialsadd',$this->data);
    }

    function stories_save()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {

            $det=$this->data['detail'];

            $img1up = $img2up = false;
            $arry = array("gif","jpg","png","ico","jpeg");
            $uploaddir = '../assets/testimonials/';
            $uploadDBdir= "assets/testimonials/";

            $arrayImage=$_FILES['imag']['name'];
            $arrayTemp=$_FILES['imag']['tmp_name'];

            $ext = end(explode(".", $arrayImage));
            if(in_array($ext,$arry)){
                $image_name='testimonials'.time().'1.'.$ext;
                $uploadfile = $uploaddir.$image_name;
                $uploadfileTable1 = $uploadDBdir.$image_name;
                $img1up = move_uploaded_file($arrayTemp,$uploadfile);
                $this->home_db->resizeImagef($uploadfile,90, 90);
            }


            if($img1up)
            {
                $db = array(
                    'order_no'=>$this->input->post('orderno'),
                    'name'=>trim(preg_replace('!\s+!', ' ',$this->input->post('name'))),
                    'location'=>trim(preg_replace('!\s+!', ' ',$this->input->post('location'))),
                    'comment'=>trim(preg_replace('!\s+!', ' ',$this->input->post('comment'))),
                    'created_date'=>date('Y-m-d H:i:s'),
                    'modified_date'=>date('Y-m-d H:i:s'),
                    'user_id'=>$det[0]->id,
                    'image_path'=>$uploadfileTable1,
                    'status'=>0,
                );

                $res=$this->master_db->insertRecord('testimonials',$db);

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

        redirect('about/stories');

    }

    public function stories_status()
    {
        $items = $this->input->post('items');
		$status = $this->input->post('status');
		$db=array(
		'items'=>$items,
		'status'=>$status,
		'modified_date'=>date('Y-m-d H:i:s'),
		);
		$this->master_db->changeStatus('testimonials',$db);
		if($status == 2)
		{
			$this->master_db->deleterecord('testimonials',array("id"=>$items));
		}
		$this->data['testimonials'] = $this->load->view('gettestimonials', $this->data ,TRUE);
		echo $this->data['testimonials'];
    }

    public function stories_edit()
    {
        $det=$this->data['detail'];

        $id=$this->input->get('id');

        if(!empty($id) && $_SERVER['REQUEST_METHOD'] != 'POST')
        {
            $details = $this->master_db->getcontent('testimonials',$id);
            if(is_array($details)){
                $this->data['type']='edit';
                $this->data['details']=$details;
                $this->load->view('testimonialsadd',$this->data);
            }
            else{
               redirect('about/stories');
            }
        }

        else if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $db=array(

                'order_no'=>$this->input->post('orderno'),
                'name'=>trim(preg_replace('!\s+!', ' ',$this->input->post('name'))),
                'location'=>trim(preg_replace('!\s+!', ' ',$this->input->post('location'))),
                'comment'=>trim(preg_replace('!\s+!', ' ',$this->input->post('comment'))),
                'modified_date'=>date('Y-m-d H:i:s'),
                'user_id'=>$det[0]->id,

            );

            $res=$this->master_db->updateRecord('testimonials',$db,$id);


            $img1up = false;
            $arry = array("gif","jpg","png","ico","jpeg");
            $uploaddir = '../assets/testimonials/';
            $uploadDBdir= "assets/testimonials/";

            $arrayImage=$_FILES['imag']['name'];
            $arrayTemp=$_FILES['imag']['tmp_name'];


            $ext = end(explode(".", $arrayImage));
            if(in_array($ext,$arry)){
                $image_name='testimonials'.time().'1.'.$ext;
                $uploadfile = $uploaddir.$image_name;
                $uploadfileTable1 = $uploadDBdir.$image_name;
                $img1up = move_uploaded_file($arrayTemp,$uploadfile);

                $img = $this->master_db->getcontent('testimonials',$id);
                unlink('../'.$img[0]->image_path);

                $db = array(
                    'image_path'=>$uploadfileTable1,
                    'user_id'=>$det[0]->id,
                );
                $this->home_db->resizeImagef($uploadfile,90, 90);
                $res=$this->master_db->updateRecord('testimonials',$db,$id);
                $this->home_db->resizeImagef($uploadfile,90, 90);
            }


            if($res)
            {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');

            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');

            }
            redirect('about/stories');

        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
            redirect('about/stories');
        }

    }
	/*********** brochure*****/
	 public function brochure()
    {
        $this->data['type']='edit';
        $this->data['info']=$this->master_db->getcontent('brochure','');
        $this->load->view('brochure_view',$this->data);
    }


    public function brochure_save()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $fdata = $this->master_db->getcontent('brochure','');
            
			$img1up = false;
            $arry = array("gif","jpg","png","ico","jpeg");
            $uploaddir = '../assets/brochure_pdf/';
            $uploadDBdir= "assets/brochure_pdf/";

            $arrayImage=$_FILES['brochure_pdf']['name'];
            $arrayTemp=$_FILES['brochure_pdf']['tmp_name'];
			print_r($arrayTemp);exit;

            $ext = end(explode(".", $arrayImage));
            if(in_array($ext,$arry)){
                $image_name='about'.time().'1.'.$ext;
                $uploadfile = $uploaddir.$image_name;
                $uploadfileTable1 = $uploadDBdir.$image_name;
                $img1up = move_uploaded_file($arrayTemp,$uploadfile);

                $img = $this->master_db->getcontent('brochure',1);
                unlink('../'.$img[0]->banner);

                $db = array(
                    'brochure_pdf'=>$uploadfileTable1,

                );
                $res=$this->master_db->updateRecord('brochure',$db,1);
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
        redirect('about/brochure');

    }

	

}

/* End of file master.php */
/* Location: ./application/controllers/master.php */