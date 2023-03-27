<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Others extends CI_Controller {

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
		$this->data['newslttr'] = $this->load->view('getnewslttr', $this->data, TRUE);
        $this->load->view('newslttr',$this->data) ;
    }

    public function newsletter_table()
    {
        $db=array(
            'page'=>$this->input->post('page'),
            'rp'=>$this->input->post('rp'),
            'sortname'=>$this->input->post('sortname'),
            'sortorder'=>$this->input->post('sortorder'),
            //'qtype'=>$this->input->post('qtype'),
            //'query'=>$this->input->post('query'),
            //'letter_pressed'=>$this->input->post('letter_pressed'),
        );
        $this->data=$this->master_db->getNewsTable('newsletter',$db);
        echo $this->data;
    }

    public function export(){

      require 'excelexport.php';
        $arr = $this->master_db->getRecords('newsletter',['status'=>0],'*','id desc');

        $count = 1;
        $data = array(array("Sl No","Date","","Email-id"));
        foreach($arr as $subsbr){
            $data[] = array(strval($count),date_format(date_create($subsbr->subscribed_date), 'd-m-Y g:i A'),"",$subsbr->email);
            $count++;

        }





        $xls = new Excel_XML('UTF-8', false, 'My Test Sheet');
        $xls->addArray($data);
        $xls->generateXML('subscribers');




    }

    //-----Pincodes--------//
    public function pincode()
    {
		$this->data['pincode'] = $this->load->view('getpincode', $this->data, TRUE);
        $this->load->view('pincodes',$this->data) ;
    }

    public function pincode_table()
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
        $this->data=$this->master_db->getPincldeTable('pincodes',$db);
        echo $this->data;
    }

    public function pincode_add()
    {
        $this->data['type']='add';
        $this->load->view('editpincode',$this->data);
    }

    public function pincode_csv()
    {
        $this->data['type']='csv';
        $this->load->view('editpincode',$this->data);
    }

    public function import_csv(){

            $row = 1;
            $i=1;


            $fname = $_FILES['pinfile']['name'];



            $filename = $_FILES['pinfile']['tmp_name'];
            $handle = fopen($filename, "r");


                while (($datar = fgetcsv($handle, 2000, ",")) !== FALSE)
            {

               // echo $datar[0];
                if($row!=1){

                    if($this->master_db->dup_check_pincode("pincodes",trim(preg_replace('!\s+!', '',$datar[0])),"") == 0) {


                            $ar = array("pincode"=>trim(preg_replace('!\s+!', '',$datar[0])),"charges"=>$datar[1]);
                            $total = $this->master_db->insertRecord("pincodes",$ar);
                            if($total == 0){
                                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Failed, Please Upload Valid CSV File</div>');
                                redirect('others/pincode');
                            }

                    }

                }
                $row++;
            }
            fclose($handle);
//
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Pincodes Added Successfully</div>');
        redirect('others/pincode');

        }



    function pincode_save()
    {
        $det=$this->data['detail'];
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $post=$this->input->post(null,true);
            for($i=0;$i<count($_POST['np']);$i++)
            {
                $name=$post['np'] ;
                $charges=$post['charges'] ;
                if(!empty($name[$i]))
                {
                    $check = $this->master_db->dup_check_pincode('pincodes',trim(preg_replace('!\s+!', '',$name[$i])),'');
                    if($check == "0"){
                        $db=array(
                            'pincode'=>trim(preg_replace('!\s+!', '',$name[$i])),
                        	'charges'=>trim(preg_replace('!\s+!', '',$charges[$i]))

                        );
                        $res1=$this->master_db->insertRecord('pincodes',$db);
                    }
                }
            }

            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Pincode Added Successfully</div>');

        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Data is Missing!!!</div>');
        }
        redirect('others/pincode');
    }

    public function pincode_edit(){
        $det=$this->data['detail'];

        $id=$this->input->get('id');

        if(!empty($id) && $_SERVER['REQUEST_METHOD'] != 'POST')
        {
            $details = $this->master_db->getcontent('pincodes',$id);
            if(is_array($details)){
                $this->data['type']='edit';
                $this->data['details']=$details;
                $this->load->view('editpincode',$this->data);
            }
            else{
                redirect('others/pincode');
            }
        }

        else if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $name = trim(preg_replace('!\s+!', '',$this->input->post('name')));
            $charges = trim(preg_replace('!\s+!', '',$this->input->post('charges')));
            $db=array(
                'pincode'=>$name,
            	'charges'=>$charges

            );
            $check = $this->master_db->dup_check_pincode('pincodes',$name,$id);
            if($check == "0"){
                $res=$this->master_db->updateRecord('pincodes',$db,$id);
            }
            if($res)
            {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');

            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');

            }
            redirect('others/pincode');

        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
            redirect('others/pincode');
        }

    }




function deletePins(){


    $items = $this->input->post('items');
    //$res = $this->master_db->deletePins(trim($items,","));
    $resp = $this->master_db->deletePins(trim($items,","));

        echo $resp;




}

    //-----State--------//
    public function state()
    {
		$this->data['state'] = $this->load->view('getstate', $this->data, TRUE);
        $this->load->view('state',$this->data) ;
    }

    public function state_table()
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
        $this->data=$this->master_db->gettable_states($db);
        echo $this->data;
    }

    public function state_add()
    {
        $this->data['type']='add';

        $this->load->view('editstate',$this->data);
    }

    function state_save()
    {
        $det=$this->data['detail'];
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $post=$this->input->post(null,true);

            for($i=0;$i<count($_POST['np']);$i++)
            {
                $name=$post['np'] ;
                if(!empty($name[$i]))
                {
                    $check = $this->master_db->dup_check('states',trim(preg_replace('!\s+!', ' ',$name[$i])),'');
                    if($check == "0"){
                        $db=array(
                            'name'=>trim(preg_replace('!\s+!', ' ',$name[$i])),
                            'status'=>0,

                        );
                        $res1=$this->master_db->insertRecord('states',$db);
                    }
                }
            }

            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>State Added Successfully</div>');


            redirect('others/state');
        }
        else{
            redirect(base_url());
        }
    }



    public function state_status()
    {
        $items = $this->input->post('items');
		$status = $this->input->post('status');
		$db=array(
		'items'=>$items,
		'status'=>$status,
		'modified_date'=>date('Y-m-d H:i:s'),
		);
		$this->master_db->changeStatus('states',$db);
		if($status == 2)
		{
			$this->master_db->deleterecord('states',array("id"=>$items));
		}
		$this->data['state'] = $this->load->view('getstate', $this->data ,TRUE);
		echo $this->data['state'];
    }

    public function state_edit(){
        $det=$this->data['detail'];

        $id=$this->input->get('id');

        if($id)
        {
            $this->data['type']='edit';

            $this->data['details']=$this->master_db->getcontent('states',$id);
            $this->load->view('editstate',$this->data);
        }

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');

            $name = trim(preg_replace('!\s+!', ' ',$this->input->post('name')));
            $db=array(
                'name'=>$name,



            );
            $check = $this->master_db->dup_check('states',$name,$id);
            if($check == "0"){
                $res=$this->master_db->updateRecord('states',$db,$id);
            }
            if($res)
            {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');

            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');

            }
            redirect('others/state');

        }
    }


    //-----city--------//
    public function city()
    {		
		$this->data['city'] = $this->load->view('getcity', $this->data, TRUE);
        $this->load->view('city',$this->data) ;
    }

    public function city_table()
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
        $this->data=$this->master_db->gettable_city($db);
        echo $this->data;
    }

    public function city_add()
    {
        $this->data['type']='add';

        $this->load->view('editcity',$this->data);
    }

    function getstate(){
        $id = $this->input->post('cid');
        $screens = $this->master_db->getcontent2('state','country_id',$id,'0');
        echo '<option value="">--Select--</option>';
        if(is_array($screens) && !empty($id)){
            foreach($screens as $s){
                echo '<option value="'.$s->id.'">'.$s->name.'</option>';
            }
        }
    }

    function city_save()
    {
        $det=$this->data['detail'];
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $post=$this->input->post(null,true);
            $state=$this->input->post('state');
            for($i=0;$i<count($_POST['np']);$i++)
            {
                $name=$post['np'] ;
                if(!empty($name[$i]))
                {
                    $check = $this->master_db->dup_check('cities',trim(preg_replace('!\s+!', ' ',$name[$i])),'');
                    if($check == "0"){
                        $db=array(
                            'name'=>trim(preg_replace('!\s+!', ' ',$name[$i])),
                            'state_id'=>$state,
                            'order_no'=>$this->input->post('order'),
                            'favourite'=>0,
                            'status'=>0,

                        );
                        $res1=$this->master_db->insertRecord('cities',$db);
                    }
                }
            }

            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>City Added Successfully</div>');


            redirect('others/city');
        }
        else{
            redirect(base_url());
        }
    }



    public function city_status()
    {
       $items = $this->input->post('items');
		$status = $this->input->post('status');
		$db=array(
		'items'=>$items,
		'status'=>$status,
		'modified_date'=>date('Y-m-d H:i:s'),
		);
		$this->master_db->changeStatus('cities',$db);
		if($status == 2)
		{
			$this->master_db->deleterecord('cities',array("id"=>$items));
		}
		$this->data['city'] = $this->load->view('getcity', $this->data ,TRUE);
		echo $this->data['city'];
    }

    public function city_edit()

    {
        $det=$this->data['detail'];

        $id=$this->input->get('id');

        if($id)
        {
            $this->data['type']='edit';

            $this->data['details']=$this->master_db->getcontent('cities',$id);
            $this->load->view('editcity',$this->data);
        }

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $id=$this->input->post('aid');
            $state=$this->input->post('state');
            $name = trim(preg_replace('!\s+!', ' ',$this->input->post('name')));
            $db=array(
                'name'=>$name,
                'state_id'=>$state,
                'order_no'=>$this->input->post('order'),
				'favourite'=>0,


            );
            $check = $this->master_db->dup_check('cities',$name,$id);
            if($check == "0"){
                $res=$this->master_db->updateRecord('cities',$db,$id);
            }
            if($res)
            {
                $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Successfull</div>');

            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');

            }
            redirect('others/city');

        }
    }



    function sendmail(){
        $this->load->view('sendmail',$this->data);
    }

    function lettermailer(){



        $image=$_FILES['imag']['name'];
        $ext = end(explode(".", $image));
        $name='mail'.time().'.'.$ext;
        $file="assets/mail/".$name;
        $config['upload_path'] = '../assets/mail/';
        $config['allowed_types'] = 'html';
        $config['file_name']=$name;
        $res = 0;
        $this->load->library('upload', $config);
        $this->upload->do_upload('imag');



        $homepage = file_get_contents(str_replace("artii_manage/","",base_url()).$file);


        $this->load->library('email');
        $this->load->library('parser');
        $list = $this->input->post('proname');
        foreach($list as $contct ){
        $this->email->clear();
        $config['mailtype'] = "html";
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('vinay@savithru.com', 'Test');
        $this->email->to($contct);
        $this->email->subject($this->input->post('sub'));
        $this->email->message($homepage);
            $ok = $this->email->send();
        }


        if ($ok) {
            echo 'Your email was sent, thanks chamil.';
            print_r($list);
            $count = count($list);

            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Mail Sent Successfully To '.$count.' Contacts</div>');
           redirect('others/sendmail');
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Failed To Send Email</div>');
           redirect('others/sendmail');
        }






    }



    

}
