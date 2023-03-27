<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voucher extends CI_Controller {

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
		$this->load->model('voucher_db');
		
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
		$this->data['jsfile']=$this->load->view('jsfile', NULL , TRUE);
        $this->data['left']=$this->load->view('left', $this->data , TRUE); 
    }

    
    

	//-----Gift Vouchers--------//
	public function gift_vouchers()
    {
		$this->data['vouchers'] = $this->load->view('getvouchers', $this->data, TRUE);
    	$this->load->view('gift_voucher',$this->data) ;
    }
    
    public function voucher_table()
    {
	   $db=array(
				'page'=>$this->input->post('page'),
				'rp'=>$this->input->post('rp'),
				'sortname'=>$this->input->post('sortname'),
				'sortorder'=>$this->input->post('sortorder'),
				'qtype'=>$this->input->post('qtype'),
				'query'=>$this->input->post('query'),
				'letter_pressed'=>$this->input->post('letter_pressed'),
		   		'type'=>$this->input->post('type'),
		   		'fromdate'=>$this->input->post('fromdate'),
		   		'todate'=>$this->input->post('todate'),
		   		'code'=>$this->input->post('code'),
		   		'stat'=>$this->input->post('choosestatus'),
		);
		$this->data=$this->voucher_db->gettable($db);
		echo $this->data;
    }
    
    public function voucher_add()
    {
    	$this->data['type']='add';
    	$this->load->view('gift_voucheradd',$this->data);
    }
    
    public function generatecodes()
    {
    	$cnt = trim(preg_replace('!\s+!', '',$this->input->post('cnt')));
    	$prefix = trim(preg_replace('!\s+!', '',$this->input->post('prefix')));
    	$val = trim(preg_replace('!\s+!', '',$this->input->post('val')));
    	$this->data['cnt']=$cnt;
    	$this->data['val']=$val;
    	$this->data['prefix']=$prefix;
    	$this->load->view('generatecodes',$this->data);
    }
    
    function voucher_save()
    {
    	if($_SERVER['REQUEST_METHOD']=='POST')
    	{
    
    		$det=$this->data['detail'];
    		$codes = $this->input->post('finalcode');
    		if(is_array($codes)){
    			$db = array(
    					'type'=>'0',
    					'title'=>trim(preg_replace('!\s+!', ' ',$this->input->post('title'))),
    					'from_date'=>date('Y-m-d',strtotime($this->input->post('fromdate'))),
    					'to_date'=>date('Y-m-d',strtotime($this->input->post('todate'))),
    					'discount'=>$this->input->post('discount'),
    					'prefix'=>$this->input->post('prefix'),
    					'no_of_coupons'=>$this->input->post('code'),
    					'created_date'=>date('Y-m-d H:i:s'),
    					'user_id'=>$det[0]->id,
						'status'=>'0',
    			);
    
    			$res=$this->master_db->insertRecord('vouchers',$db);
    			$arr = array();
    			foreach ($codes as $c){
    				$check = $this->master_db->getcontent1('voucher_code','code',$c);
    				if($check == "0"){
	    				$db = array(
	    						'cid'=>$res,
	    						'code'=>trim(preg_replace('!\s+!', '',$c)),
	    						'created_date'=>date('Y-m-d H:i:s')
	    				);
	    				
	    				$this->master_db->insertRecord('voucher_code',$db);
    				}
    				else{
    					$arr[] = $c;
    				}
    			}
    		}
    			
    		if($res)
    		{
    			if(count($arr) > 0){
    				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Few of the Voucher codes are not added : '.implode(', ',$arr).'</div>');
    			}
    			else{
    				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Added Successfully</div>');
    			}
    		}
    		else
    		{
    			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Added Successfully</div>');
    		}
    
    	}
    	else{
    		$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Data is Missing!!!</div>');
    	}
    
    	redirect('voucher/gift_vouchers');
    
    }
    
	public function voucher_edit(){
		$det=$this->data['detail'];
	
		$id=$this->input->get('id');
	
		if(!empty($id) && $_SERVER['REQUEST_METHOD'] != 'POST')
		{
			$details = $this->master_db->getcontent('vouchers',$id);
			if(is_array($details)){
				$this->data['type']='edit';
				$this->data['details']=$details;
				$this->load->view('gift_voucheradd',$this->data);
			}
			else{
				redirect('voucher/gift_vouchers');
			}
		}	
		else if($_SERVER['REQUEST_METHOD']=='POST')
		{
				$id=$this->input->post('aid');
				$db = array(
    					'type'=>'0',
    					'title'=>trim(preg_replace('!\s+!', ' ',$this->input->post('title'))),
    					'from_date'=>date('Y-m-d',strtotime($this->input->post('fromdate'))),
    					'to_date'=>date('Y-m-d',strtotime($this->input->post('todate'))),
    					'discount'=>$this->input->post('discount'),
    					'modified_date'=>date('Y-m-d H:i:s'),
    					'user_id'=>$det[0]->id
    				);
					$res=$this->master_db->updateRecord('vouchers',$db,$id);
					
					$reset = $this->input->post('reset');
					$active = $this->input->post('active');
					$excode = $this->input->post('excode');
					$var = 0;
					if(is_array($excode)){
						$var = count($excode);
						foreach ($excode as $key=>$e){
							$db = array(
									'status'=>$active[$key],
									'used_count'=>$reset[$key],
									'modified_date'=>date('Y-m-d H:i:s')
							);
							$this->master_db->updateRecord1('voucher_code',$db,'code',$e);
						}
					}
					$arr = array();
					$finalcode = $this->input->post('finalcode');
					$newcode = $this->input->post('newcode');
					$code = $this->input->post('code');
					if($newcode == "1" && is_array($finalcode)){
						$var = $var+count($finalcode);
					foreach ($finalcode as $c){
						$check = $this->master_db->getcontent1('voucher_code','code',$c);
						if($check == "0"){
							$db = array(
									'cid'=>$id,
									'code'=>trim(preg_replace('!\s+!', '',$c)),
									'created_date'=>date('Y-m-d H:i:s')
							);
							 
							$this->master_db->insertRecord('voucher_code',$db);
						}
						else{
							$arr[] = $c;
						}
					}
					}
					
					$db = array(
							'no_of_coupons'=>$var
					);
					$this->master_db->updateRecord('vouchers',$db,$id);
					
				if($res)
				{
					if(count($arr) > 0){
						$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Few of the Voucher codes are not added : '.implode(', ',$arr).'</div>');
					}
					else{
						$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Updated Successfully</div>');
					}
	
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Not Successfull</div>');
	
				}
				redirect('voucher/gift_vouchers');
	
		}
		else{
			redirect('voucher/gift_vouchers');
		}
	}
				
	public function voucher_status()
	{
		
		$items = $this->input->post('items');
		$status = $this->input->post('status');
		$db=array(
		'items'=>$items,
		'status'=>$status,
		'modified_date'=>date('Y-m-d H:i:s'),
		);
		$this->master_db->changeStatus('vouchers',$db);
		if($status == 2)
		{
			$this->master_db->deleterecordss('vouchers',array("id"=>$items));
		}
		$this->data['vouchers'] = $this->load->view('getvouchers', $this->data ,TRUE);
		echo $this->data['vouchers'];
	}
	
	public function voucher_view()
	{
		$id=$this->input->get('id');
	
		if(!empty($id))
		{
			$details = $this->master_db->getcontent('vouchers',$id);
			if(is_array($details))
			{
				$this->data['details']=$details;
				$this->load->view('viewvoucher',$this->data);
			}
			else
			{
				redirect('voucher/gift_vouchers');
			}
		}
		else{
			redirect('voucher/gift_vouchers');
		}
	}
	
	public function voucher_export()
	{
		$id=$this->input->get('id');
	
		if(!empty($id))
		{
			$details = $this->voucher_db->getvoucherdetails($id);
			if(is_array($details))
			{
				$this->data['details']=$details;
				$this->load->view('exportvoucher',$this->data);
			}
			else
			{
				redirect('voucher/gift_vouchers');
			}
		}
		else
		{
			redirect('voucher/gift_vouchers');
		}
	}
    
    
    
}

/* End of file master.php */
/* Location: ./application/controllers/master.php */