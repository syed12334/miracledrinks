<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {



	protected $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('utility_helper');
        $this->load->helper('url');
		$this->load->helper('cookie');
		no_cache();
		$this->load->model('home_db');
		$this->load->model('report_db');
		$this->load->model('orders_db');
		$this->load->model('master_db');
		date_default_timezone_set("Asia/Kolkata");
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
		$this->data['newsess'] = $this->data['detail'];
		$this->data['popcss']=$this->load->view('popcss', NULL , TRUE);
		$this->data['header']=$this->load->view('header', NULL , TRUE);
		$this->data['left']=$this->load->view('left', $this->data , TRUE);
		$this->data['jsfile']=$this->load->view('jsfile', NULL , TRUE);
	}

	public function customers(){
		$this->data['customers'] = $this->load->view('getcustomers', $this->data, TRUE);
		$this->load->view('customers',$this->data);
	}

	/*public function customersTable()
	{
		$db=array(
			'page'=>$this->input->post('page'),
			'rp'=>$this->input->post('rp'),
			'sortname'=>$this->input->post('sortname'),
			'sortorder'=>$this->input->post('sortorder'),
			'qtype'=>$this->input->post('qtype'),
			'query'=>$this->input->post('query'),
			'letter_pressed'=>$this->input->post('letter_pressed'),
			'fromdate'=>$this->input->post('fromdate'),
			'todate'=>$this->input->post('todate'),
			'email'=>$this->input->post('email'),
			'name'=>$this->input->post('name'),
			'contact'=>$this->input->post('contact'),
			'company'=>$this->input->post('company'),
			'town'=>$this->input->post('town'),
			'zip'=>$this->input->post('zip'),
			'state'=>$this->input->post('state'),
			'country'=>$this->input->post('country'),
		);
		$this->data=$this->report_db->getcustomers($db);
		echo $this->data;
	}*/

	public function customer_view()
	{
		//$id=$this->uri->segment(3);
		$this->data['id']=$id=$this->input->get('id');
		$this->data['details']=$this->report_db->getcustomercontent($id);
		$body = $this->load->view('customer_view',$this->data,true);
		$this->data['data']=$body;
		$this->load->view('viewcustomer',$this->data);
	}

	public function exportcust(){
		$db=array(
			'fromdate'=>$this->input->post('fromdate'),
			'todate'=>$this->input->post('todate'),
			'email'=>$this->input->post('email'),
			'name'=>$this->input->post('name'),
			'contact'=>$this->input->post('contact'),
			'company'=>$this->input->post('company'),
			'town'=>$this->input->post('town'),
			'zip'=>$this->input->post('zip'),
			'state'=>$this->input->post('state'),
			'country'=>$this->input->post('country'),
		);
		$this->data['sellers'] = $this->report_db->getexportcust($db);
		$this->load->view('exportcust',$this->data);
	}

	public function exportexcel(){
		$db=array(

			'fromdate'=>$this->input->get('fromdate'),
			'todate'=>$this->input->get('todate'),
			'cat'=>$this->input->get('cat'),
			'name'=>$this->input->get('name'),
			'pname'=>$this->input->get('pname'),
			'stat'=>$this->input->get('choosestatus'),
		);
		$this->data['sellers'] = $this->report_db->getexport($db);
		//echo $this->db->last_query();exit;
        //var_dump($this->data['sellers']);
		$this->load->view('exportreview',$this->data);
	}

	public function reviews()
	{
		$this->data['category'] = $this->master_db->getcontent('category','');
    	$this->data['material'] = $this->master_db->getcontent('materials','');
    	$this->data['color'] = $this->master_db->getcontent('colors','');
    	$this->data['size'] = $this->master_db->getcontent('sizes','');
        $post = $this->input->get(NULL,true);
        $this->load->view('reviews',$this->data);
	}
	
	 public function getreview()
    {
        $det = $this->data['detail'];
        $where =' WHERE r.status !=4';
        $post=$this->input->post(NULL,TRUE);
        $cat = trim(preg_replace('!\s+!', ' ',$post['cat']));
        $fromdate = trim(preg_replace('!\s+!', ' ',$post['fromdate']));
        $todate = trim(preg_replace('!\s+!', ' ',$post['todate']));
        $pname = trim(preg_replace('!\s+!', ' ',$post['pname']));
        $name = trim(preg_replace('!\s+!', ' ',$post['name']));
        $choosestatus = trim(preg_replace('!\s+!', ' ',$post['choosestatus']));
        $db = array(
            "cat"=>$cat,
            "fromdate"=>$fromdate,
            "todate"=>$todate,
            "pname"=>$pname,
            "name"=>$name,
            "choosestatus"=>$choosestatus,
        );
		 if(!empty($db['cat']))
        {
            $where .=" and c.id='".$db['cat']."'";
        }
           if(!empty($db['name']))
        {
            $where .=" and (r.name like '%".$db['name']."%' or r.name like '%".$db['name']."%')";
        }
        if(!empty($db['fromdate']) && !empty($db['todate']))
        {
            $where .=" and DATE(r.created_date) between '".date('Y-m-d',strtotime($db['fromdate']))."' and '".date('Y-m-d',strtotime($db['todate']))."' ";
        }
       
         if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (c.home_page like '%$val%') ";
                $where .= " or (p.name like '%$val%') ";
                $where .= " or (c.name like '%$val%')  ";
                $where .= " or (pp.pcode like '%$val%')  ";
                $where .= " or (p.special like '%$val%')  ";
            }
            $order_by_arr[] = "p.name";
            $order_by_arr[] = "";
            $order_by_arr[] = "p.id";
            $order_by_def   = " order by r.id desc";
      
     $query = "select r.*,DATE_FORMAT(r.created_date,'%d-%m-%Y %h:%i %p') AS created_date,p.name pname,i.image_path path,c.name cname from products p left join category c on p.cat_id = c.id left join productpackage pp on pp.pid=p.id left join product_images i on i.pid = pp.id left join reviews as r on r.psid =i.id ".$where.""; 
     //echo $query; exit;        
            $fetchdata = $this->master_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
        
        $data = array();
        $i = $_POST["start"]+1;

        foreach($fetchdata as $b)
        {
            $cls = "";
                if($b->status=='0')
            {
                $status="<span class='btn btn-info btn-sm btn-grad'>Approved</span>";
                $chng="<button class='btn btn-primary btn-sm btn-grad' onclick='changestatus(1,".$b->id.")'><i class='icon-remove'></i> Reject </button>";
            }
            else if($b->status=='1')
            {
                $status="<span class='btn btn-primary btn-sm btn-grad'>Rejected</span>";
                $chng="<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(0,".$b->id.")'><i class='icon-ok'></i> Approve </button>";
            }
            else if($b->status=='2')
            {
                $status="<span class='btn btn-warning btn-sm btn-grad'>Pending</span>";
                $chng="<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(0,".$b->id.")'><i class='icon-ok'></i> Approve </button> <button class='btn btn-primary btn-sm btn-grad' onclick='changestatus(1,".$b->id.")'><i class='icon-remove'></i> Reject </button>";
            }
            else if($b->status=='3')
            {
                $status="<span class='btn btn-info btn-sm btn-grad'>New</span>";
                $chng="<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(0,".$b->id.")'><i class='icon-ok'></i> Approve </button> <button class='btn btn-primary btn-sm btn-grad' onclick='changestatus(1,".$b->id.")'><i class='icon-remove'></i> Reject </button>";
            }

            $image = "";

            if(!empty($b->path)){
                $image = "<img src='".front_url()."".$b->path."' width='80'>";
                //  $image="<img src='".base_url().$s->img1."' width='80'>";
            }

               
                
                
                $edit="<button class='btn btn-primary btn-sm btn-grad' onclick='view(".$b->id.",`".''."`)'><i class='fas fa-eye'></i> View </button>";  
            $sub_array = array();
            $sub_array[] = $i++;
            $sub_array[] = $b->cname;
            $sub_array[] = $b->pname;
            $sub_array[] = $image;
            $sub_array[] = $b->name;
            $sub_array[] = $b->email;
            $sub_array[] = $b->rating;
            $sub_array[] = $b->created_date;
            $sub_array[] = $status;
            $sub_array[] = $chng.' '.$edit;
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

	/*public function reviewTable()
	{
		$db=array(
			'page'=>$this->input->post('page'),
			'rp'=>$this->input->post('rp'),
			'sortname'=>$this->input->post('sortname'),
			'sortorder'=>$this->input->post('sortorder'),
			'qtype'=>$this->input->post('qtype'),
			'query'=>$this->input->post('query'),
			'letter_pressed'=>$this->input->post('letter_pressed'),
			'cat'=>$this->input->post('cat'),
			'fromdate'=>$this->input->post('fromdate'),
			'todate'=>$this->input->post('todate'),
			'name'=>$this->input->post('name'),
			'pname'=>$this->input->post('pname'),

			'stat'=>$this->input->post('choosestatus'),
		);
		$this->data=$this->report_db->getreviews($db);
		echo $this->data;
	}*/

	public function review_status()
	{


		/*$status=$this->input->post('status');

		$db=array(
			'id'=>$this->input->post('items'),

			'approved_date'=>date('Y-m-d H:i:s'),
			'status'=>$status,
		);
		//$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">�</button>Updated Successfully</div>');
		$status=$this->report_db->reviewStatus('reviews',$db);
		echo $status;*/
		$items = $this->input->post('items');
		$status = $this->input->post('status');
		$db=array(
		'id'=>$items,
		'status'=>$status,
		'approved_date'=>date('Y-m-d H:i:s'),
		);
		//print_r($db);exit;
		$this->report_db->reviewStatus('reviews',$db);
		//echo $this->db->last_query();exit;
		$db=array(
			'page'=>$this->input->post('page'),
			'rp'=>$this->input->post('rp'),
			'sortname'=>$this->input->post('sortname'),
			'sortorder'=>$this->input->post('sortorder'),
			'qtype'=>$this->input->post('qtype'),
			'query'=>$this->input->post('query'),
			'letter_pressed'=>$this->input->post('letter_pressed'),
			'cat'=>$this->input->post('cat'),
			'fromdate'=>$this->input->post('fromdate'),
			'todate'=>$this->input->post('todate'),
			'name'=>$this->input->post('name'),
			'pname'=>$this->input->post('pname'),
			'stat'=>$this->input->post('choosestatus'),
		);
		$this->data['result'] =$this->report_db->getreviews($db);
		$this->data['review_report'] = $this->load->view('getreviewreport', $this->data, TRUE);
		echo $this->data['review_report'];
	}

	/*public function review_view()
	{
		$id=$this->uri->segment(3);


		$this->data['id']=$id;
		$this->data['details']=$this->report_db->getreviewcontent($id,"");
		$this->load->view('viewreview',$this->data);
	}*/
	
	public function review_view()
	{
		//$id=$this->uri->segment(3);
		//echo "<pre>";print_r($_GET);exit;
		$this->data['id']=$id=$this->input->get('id');
		$this->data['details']=$this->report_db->getreviewcontent($id,"");
		//echo $this->db->last_query();exit;
		$body = $this->load->view('reviewview',$this->data,true);
		$this->data['data']=$body;
		$this->load->view('viewreview',$this->data);
	}
	
	public function user_orders()
	{
        $post = $this->input->get(NULL,true);
		$this->load->view('user_orders',$this->data);
	}
	
	public function getorders()
    {
        $det = $this->data['detail'];
        $post=$this->input->post(NULL,TRUE);
        $fromdate = trim(preg_replace('!\s+!', ' ',$post['fromdate']));
        $todate = trim(preg_replace('!\s+!', ' ',$post['todate']));
        $orderno = trim(preg_replace('!\s+!', ' ',$post['orderno']));
        $name = trim(preg_replace('!\s+!', ' ',$post['name']));
        $email = trim(preg_replace('!\s+!', ' ',$post['email']));
        $phone = trim(preg_replace('!\s+!', ' ',$post['phone']));
        $choosestatus = trim(preg_replace('!\s+!', ' ',$post['choosestatus']));
        $db = array(
            "fromdate"=>$fromdate,
            "todate"=>$todate,
            "orderno"=>$orderno,
            "name"=>$name,
            "email"=>$email,
            "phone"=>$phone,
            "choosestatus"=>$choosestatus,
        );
        $where =' WHERE o.status !=5 ';
         if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (o.id like '%$val%') ";
                $where .= " or (o.orderid like '%$val%') ";
                $where .= " or (o.status like '%$val%')  ";
                $where .= " or (o.total_amt_paid like '%$val%')  ";
                $where .= " or (o.tot_qty like '%$val%')  ";
                $where .= " or (o.total_amt like '%$val%')  ";
                $where .= " or (u.name like '%$val%')  ";
                $where .= " or (u.phone like '%$val%')  ";
                $where .= " or (o.invoice_no like '%$val%')  ";
                $where .= " or (o.invoice_date like '%$val%')  ";
                $where .= " or (o.ordered_date like '%$val%')  ";
                $where .= " or (u.emailid like '%$val%')  ";
            }
            $order_by_arr[] = "o.orderid";
            $order_by_arr[] = "";
            $order_by_arr[] = "o.id";
            $order_by_def   = " order by o.id desc";
            if(!empty($db['orderno']))
		{
			$where .=" and orderid like '%".$db['orderno']."%'";
		}
		if(!empty($db['name']))
		{
			$where .=" and (u.name like '%".$db['name']."%')";
		}
		if(!empty($db['phone']))
		{
			$where .=" and (u.phone like '%".$db['phone']."%' or b.bphone like '%".$db['phone']."%' or b.sphone like '%".$db['phone']."%')";
		}
		if(!empty($db['fromdate']) && !empty($db['todate']))
		{
			$where .=" and DATE(ordered_date) between '".date('Y-m-d',strtotime($db['fromdate']))."' and '".date('Y-m-d',strtotime($db['todate']))."' ";
		}
		else if(!empty($db['fromdate']) && empty($db['todate']))
		{
			$where .=" and DATE(ordered_date) >= '".date('Y-m-d',strtotime($db['fromdate']))."' ";
		}
		else if(empty($db['fromdate']) && !empty($db['todate']))
		{
			$where .=" and DATE(ordered_date) <= '".date('Y-m-d',strtotime($db['todate']))."' ";
		}
            $order_by_def   = " order by o.id desc";
            $query = "SELECT o.id,o.orderid, o.status,u.emailid,o.total_amt_paid,o.tot_qty,o.total_amt,u.name,u.phone,o.invoice_no,o.invoice_date,o.ordered_date,o.invoice_by,o.invoice_pdf,DATE_FORMAT(ordered_date,'%d-%m-%Y %h:%i %p') AS ordered_date FROM orders o inner join users  u on o.user_id=u.id ".$where." group by o.randid";           
            $fetchdata = $this->master_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
           // echo $this->db->last_query();exit;
		//$fetch_data = $this->orders_db->getuser_orders($db);
		//echo $this->db->last_query();exit;
        $data = array();
        $i = $_POST["start"]+1;

        foreach($fetchdata as $b)
        {
			$arry_status = array(
				"",
				"<span class='btn btn-info btn-sm btn-grad'>Success</span>",
				"<span class='btn btn-warning btn-sm btn-grad'>In-Progress</span>",
				"<span class='btn btn-default btn-sm btn-grad'>Shipped</span>",
				"<span class='btn btn-success btn-sm btn-grad'>Delivered</span>");
				$arry_chngstatus = array(
					"",
					"<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(3,".$b->id.")'><i class='icon-truck'></i> Change to Shipping </button>",
					"<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(3,".$b->id.")'><i class='icon-truck'></i> Change to Shipping </button>",
					"<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(4,".$b->id.")'><i class='icon-home'></i> Change to Delivered </button>","");
			if(empty($b->invoice_no) && $b->status != '-1')
			{
				
				$invoice="<button class='btn btn-success btn-sm btn-grad' onclick='geninvoice(".$b->id.")'><i class='fas fa-file-alt'></i> Generate Invoice  </button>";
				
			}
			else if(!empty($b->invoice_no) && $b->status != '-1')
			{
				$invoice="<a class='btn btn-info btn-sm btn-grad' href='".front_url().$b->invoice_pdf."' target='_blank'><i class=' fas fa-file-alt'></i> Download Invoice </a>";
				
				
			}
			if($b->status=='-1')
			{
				$status="<span class='btn btn-primary btn-sm btn-grad'>Failed</span>";
				$chng = "";
			}
			else
			{
				$status = $arry_status[$b->status];
				$chng = $arry_chngstatus[$b->status];
			}
			$invoice =  '';
			
				$incentive =  '';
			if(empty($b->invoice_no) && $b->status != '-1')
			{
				
				$invoice="<button class='btn btn-info btn-sm btn-grad' onclick='geninvoice(".$b->id.")'><i class=' fas fa-file-alt'></i> Generate Invoice  </button>";
				
			}
			else if(!empty($b->invoice_no) && $b->status != '-1')
			{
				$invoice="<a class='btn btn-info btn-sm btn-grad' href='".front_url().$b->invoice_pdf."' target='_blank'><i class=' fas fa-file-alt'></i> Download Invoice </a>";
				
				
			}
			// $incentive =  '';
			// if(empty($b->invoice_no) && $b->status != '-1')
			// {
				
			// 	$incentive="<button class='btn btn-info btn-sm btn-grad' onclick='genincentive(".$b->id.")'><i class=' fas money-bill-alt'></i> Generate Incentive  </button>";
				
			// }
			
			
			$view="<button class='btn btn-primary btn-sm btn-grad' onclick='view(`".$b->id."`)'><i class='fas fa-eye'></i> View </button>";	
            $sub_array = array();
            $sub_array[] = $i++;
            $sub_array[] = $view.' '.$chng.' '.$invoice.' '.$incentive;
            $sub_array[] = $b->orderid;
            $sub_array[] = $b->ordered_date;
            $sub_array[] = $status;
            $sub_array[] = $b->name;
            $sub_array[] = $b->emailid;
            $sub_array[] = $b->phone;
            $sub_array[] = $b->tot_qty;
            $sub_array[] = number_format($b->total_amt_paid,2);
            $data[] = $sub_array;
        }
        $stdcnt = $this->master_db->run_manual_query_result($query);
        $total = count($stdcnt);
        $output = array(
            "draw"                    =>     intval($_POST["draw"]),
            "recordsTotal"          =>      $total,
            "recordsFiltered"     =>     $total,//$this->master_db->get_filtered_data("guards")
            "data"                    =>     $data
        );
        echo json_encode($output);
    }
	
	public function orders_view()
	{
		$id=$this->input->get('id');	
		$this->data['id']=$id;		
		$this->data['orders']=$this->master_db->getcontent1('orders','id',$id);
		$this->data['users']=$this->master_db->getcontent1('users','id',$this->data['orders'][0]->user_id);
		$this->data['orders_bill']=$this->master_db->getcontent1('orders_bill_ship','oid',$id);
		$this->data['orders_prod']=$this->master_db->getcontent1('orders_products','oid',$id);
		$this->data['settings']=$this->master_db->sqlExecute('select * from settings');
		$this->data['paymentid']=$this->master_db->sqlExecute('select pay_id,status from payment_log where oid = '.$id.'');
	//echo "<pre>";print_r($this->data['orders']);exit;
		$body = $this->load->view('vieworders',$this->data,true);
		$this->data['ordervw']=$body;
		$this->data['status']=$this->data['orders'][0]->status;
		// $this->orders_db->changeorderstatus($id);
		$this->load->view('view_order',$this->data);
	}
	
	public function orders_status()
	{
		$id=$this->input->get('items');
		$status=$this->input->get('status');
		//echo $id."<br />".$status;exit;
		//echo "<pre>";print_r($_GET);exit;
	
		$this->data['id']=$id;
		$this->data['status']=$status;
		$this->data['orders']=$this->master_db->getcontent1('orders','id',$id);
		//echo "<pre>";print_r($this->data['orders']);exit;
		$this->load->view('changeorder',$this->data);
		//redirect('reports/user_orders');
	}
	
	
	public function submit_status(){
		$id       = $this->input->post('items');
		$status   = $this->input->post('status');
		$fromdate = $this->input->post('fromdate');
		$todate   = $this->input->post('todate');
		//echo "<pre>";print_r($_POST);exit;
		$det=$this->data['detail'];		 
		 
		$db = array(				
				'shipping_date'=>date('Y-m-d',strtotime($fromdate)),
				'delivered_date'=>date('Y-m-d',strtotime($todate)),
		);
		$this->master_db->updateRecord('orders',$db,$id);
		
		if($status == '3'){
			$db = array(
					'shipping_by'=>$det[0]->id,
					'status'=>$status
			);
			$this->master_db->updateRecord('orders',$db,$id);	
			
		/*	$orders =$this->master_db->getcontent1('orders','id',$id);
			$this->data['orders'] = $orders;
			$order_bill = $this->master_db->getcontent1('orders_bill_ship','oid',$id);
			$this->data['order_bill'] = $order_bill;
			//$this->data['order_products'] = $this->master_db->getcontent2('orders_products','oid',$id,'0');

			$body=$this->load->view('order_shipping',$this->data,true);*/
			
			/*$this->load->library('email');
			$config = array (
					'mailtype' => 'html',
					'charset'  => 'utf-8',
					'priority' => '1'
			);
			
			$this->email->initialize($config);
			$this->email->from('noreply@dhrtva.com', 'dhrtva');
			$list = array($order_bill[0]->bemail);
			$this->email->to($list);
			$this->email->subject($orders[0]->orderid.' - has been sent for delivery');
			
			$this->email->message($body);
			$send = $this->email->send();*/
		}
		else if($status == '4'){
			$db = array(
					'delivered_by'=>$det[0]->id,
					'status'=>$status
			);
			$this->master_db->updateRecord('orders',$db,$id);

			/*$orders =$this->master_db->getcontent1('orders','id',$id);
			$this->data['orders'] = $orders;
			$order_bill = $this->master_db->getcontent1('orders_bill_ship','oid',$id);
			$this->data['order_bill'] = $order_bill;
			$this->data['order_products'] = $this->master_db->getcontent2('orders_products','oid',$id,'0');*/
			
			//$body=$this->load->view('order_delivery',$this->data,true);
				
		/*	$this->load->library('email');
			$config = array (
					'mailtype' => 'html',
					'charset'  => 'utf-8',
					'priority' => '1'
			);*/
				
			/*$this->email->initialize($config);
			$this->email->from('noreply@artiiplant.com', 'Artiiplants');
			$list = array($order_bill[0]->bemail);
			$this->email->to($list);
			$this->email->subject($orders[0]->orderid.' - has been delivered successfully');
				
			$this->email->message($body);
			$send = $this->email->send();*/
		}
		$this->orders_db->changeorderstatus($id);
		header("Content-type: application/json");
		
		$json = "";
		
		$json .= "{";
				
		$json .= '"total": "1"';
		
		$json .= "}";
		echo $json;
	}
	
	public function wholesaler_user_orders()
	{
        $post = $this->input->get(NULL,true);
		$this->load->view('wholesaler_user_orders',$this->data);
	}
	
		public function getwholesalerorders()
    {
        $det = $this->data['detail'];
        $post=$this->input->post(NULL,TRUE);
        $fromdate = trim(preg_replace('!\s+!', ' ',$post['fromdate']));
        $todate = trim(preg_replace('!\s+!', ' ',$post['todate']));
        $orderno = trim(preg_replace('!\s+!', ' ',$post['orderno']));
        $name = trim(preg_replace('!\s+!', ' ',$post['name']));
        $email = trim(preg_replace('!\s+!', ' ',$post['email']));
        $phone = trim(preg_replace('!\s+!', ' ',$post['phone']));
        $choosestatus = trim(preg_replace('!\s+!', ' ',$post['choosestatus']));
        $db = array(
            "fromdate"=>$fromdate,
            "todate"=>$todate,
            "orderno"=>$orderno,
            "name"=>$name,
            "email"=>$email,
            "phone"=>$phone,
            "choosestatus"=>$choosestatus,
        );
		$fetch_data = $this->orders_db->getwholesaler_user_orders($db);
		//echo $this->db->last_query();exit;
        $data = array();
        $i = $_POST["start"]+1;

        foreach($fetch_data as $b)
        {
			
           $arry_status = array(
				"",
				"<span class='btn btn-info btn-sm btn-grad'>New</span>",
				"<span class='btn btn-warning btn-sm btn-grad'>In-Progress</span>",
				"<span class='btn btn-default btn-sm btn-grad'>Shipped</span>",
				"<span class='btn btn-success btn-sm btn-grad'>Delivered</span>");
				$arry_chngstatus = array(
					"",
					"<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(3,".$b->id.")'><i class=' fas fa-truck'></i> Change to Shipping </button>",
					"<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(3,".$b->id.")'><i class=' fas fa-truck'></i> Change to Shipping </button>",
					"<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(4,".$b->id.")'><i class='icon-home'></i> Change to Delivered </button>","");
	
			if($b->status=='-1')
			{
				$status="<span class='btn btn-primary btn-sm btn-grad'>Failed</span>";
				$chng = "";
			}
			else
			{
				$status = $arry_status[$b->status];
				$chng = $arry_chngstatus[$b->status];
			}
				$invoice =  '';
			if(empty($b->invoice_no) && $b->status != '-1')
			{
				
				$invoice="<button class='btn btn-info btn-sm btn-grad' onclick='geninvoice(".$b->id.")'><i class='fas fa-file-alt'></i> Generate Invoice  </button>";
				
			}
			else if(!empty($b->invoice_no) && $b->status != '-1')
			{
				$invoice="<a class='btn btn-info btn-sm btn-grad' href='".front_url().$b->invoice_pdf."' target='_blank'><i class=' fas fa-file-alt'></i> Download Invoice </a>";
				
				
			}
			$incentive =  '';
			if(empty($b->invoice_no) && $b->status != '-1')
			{
				
				$incentive="<button class='btn btn-info btn-sm btn-grad' onclick='genincentive(".$b->id.")'><i class='far fa-money-bill-alt'></i> Generate Incentive  </button>";
				
			}
			else if(!empty($b->invoice_no) && $b->status != '-1')
			{
				$incentive="<a class='btn btn-info btn-sm btn-grad' href='".front_url().$b->invoice_pdf."' target='_blank'><i class='far fa-money-bill-alt'></i> Download Incentive </a>";
				
				
			}
			
			$view="<button class='btn btn-primary btn-sm btn-grad' onclick='view(`".$b->id."`)'><i class='fas fa-eye'></i> View </button>";	
            $sub_array = array();
            $sub_array[] = $i++;
            $sub_array[] = $view.' '.$chng.' '.$invoice.' '.$incentive;
            $sub_array[] = $b->orderid;
            $sub_array[] = $b->ordered_date;
            $sub_array[] = $status;
            $sub_array[] = $b->name;
            $sub_array[] = $b->emailid;
            $sub_array[] = $b->phone;
            $sub_array[] = $b->tot_qty;
            $sub_array[] = number_format((float)$b->total_amt_paid, 2, '.', '');;
            $data[] = $sub_array;
        }
        $stdcnt = $this->orders_db->getwholesaler_user_orders($db);
        $total = count($stdcnt);
        $output = array(
            "draw"                    =>     intval($_POST["draw"]),
            "recordsTotal"          =>      $total,
            "recordsFiltered"     =>     $total,//$this->master_db->get_filtered_data("guards")
            "data"                    =>     $data
        );
        echo json_encode($output);
    }
	
		public function geninvoice(){
		$id=$this->input->get('items');
		$status=$this->input->get('status');
		if($status == "0"){
			$this->data['id'] = $id;
			$this->data['status'] = $status;
			$this->data['orders'] = $this->master_db->getcontent1('orders','id',$id);
			$this->data['users'] = $this->master_db->getcontent1('users','id',$this->data['orders'][0]->user_id);
			$this->load->view('generateInvoice',$this->data);
		}
	}
	
	public function genincentive(){
		$id=$this->input->get('items');
		$status=$this->input->get('status');
		if($status == "0"){
			$this->data['id'] = $id;
			$this->data['status'] = $status;
			$this->data['orders'] = $this->master_db->getcontent1('orders','id',$id);
			$this->data['users'] = $this->master_db->getcontent1('users','id',$this->data['orders'][0]->user_id);
			$this->load->view('generateIncentive',$this->data);
		}
	}
	
	public function download_invoice(){
		$id=$this->input->get('items');
		$status=$this->input->get('status');
		//print_r($id);exit;
		if($status == "0"){
			$this->data['id'] = $id;
			$this->data['status'] = $status;
			$this->data['orders'] = $this->master_db->getcontent1('orders','id',$id);
			$this->data['users'] = $this->master_db->getcontent1('users','id',$this->data['orders'][0]->user_id);
			//echo $this->db->last_query();exit;
			$this->load->view('downloadInvoice',$this->data);
		}
	}
	
	public function createInvoice(){
		require_once APPPATH."vendor/autoload.php";
		//$this->load->library('m_pdf');
		//echo $this->load->view('createInvoice',$this->data,true);
		$id = $this->input->post('items');
		//echo $id;exit;
		$invoice_date = $this->input->post('invoice_date');
		
		$det = $this->data['detail'];
		$this->data['orders'] = $orders = $this->master_db->getcontent1('orders','id',$id);
		//echo "<pre>";print_r($this->data['orders']);exit;
		$this->data['settings'] = $this->master_db->getcontent('settings','');

		$this->data['order_type']	=	1;

		/*
		$invoice = $orders[0]->orderid.'-'.$ac_year;
		$invoice_no = $orders[0]->orderid.'/'.$ac_year;
		*/
		$invoice_no = 'GGA'.rand(11111,99999);

		$invoice = 'GGA'.substr($orders[0]->orderid,9,strlen($orders[0]->orderid)-1);
		$outfile = $savepdf = 'pdf/'.$orders[0]->orderid.'.pdf';
//echo "<pre>";print_r($outfile);exit;

		$base_path = "../assets/".$outfile;
		$newpath = "assets/".$outfile;
		//echo base_url().$base_path;exit;
	
		$this->data['invoice'] = $invoice_no; 
		$this->data['invoice_date'] = $invoice_date; 
		$this->data['date'] = $invoice_date;
		
			$this->data['order_bill'] = $this->master_db->getcontent1('orders_bill_ship','oid',$id);

			$this->data['order_products'] = $this->master_db->getcontent2('orders_products','oid',$id,'0');
			//echo "<pre>";print_r($this->data['order_products']);exit;

			$this->data['order'] = $this->master_db->getcontent2('orders','id',$id,'');
								//echo "<pre>";print_r($this->data['order']);exit;

			$buff = $this->load->view('createInvoice',$this->data,true); 
		
		$db = array(
			'invoice_no'=>$invoice_no,
			'invoice_date'=>date('Y-m-d',strtotime($invoice_date)),
			'invoice_by'=>$det[0]->id,
			'invoice_pdf'=>''.$newpath,
		);
		$this->master_db->updateRecord1('orders',$db,'id',$id);

		$filename = $invoice_no.'.pdf';


		$mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 9,
	'default_font' => 'Arial, Helvetica, sans-serif'
]);
		$mpdf->WriteHTML($buff);
$mpdf->Output($base_path, "F");
		
        //$this->m_pdf->pdf->WriteHTML($buff);
		//$this->m_pdf->pdf->Output($base_path,"F");


		header("Content-type: application/json");
		$json = "";
		$json .= "{";
		$json .= '"query": "",';
		$json .= '"total": "1"';
		$json .= "}";	
		echo $json; 

		//echo $base_path;exit();
	}
	
	public function download_incentive(){
		$id=$this->input->get('items');
		$status=$this->input->get('status');
		//print_r($id);exit;
		if($status == "0"){
			$this->data['id'] = $id;
			$this->data['status'] = $status;
			$this->data['orders'] = $this->master_db->getcontent1('orders','id',$id);
			$this->data['users'] = $this->master_db->getcontent1('users','id',$this->data['orders'][0]->user_id);
			//echo $this->db->last_query();exit;
			$this->load->view('downloadincentive',$this->data);
		}
	}
	
	public function createIncentive(){
		
		$this->load->library('m_pdf');
		//echo $this->load->view('createInvoice',$this->data,true);
		$id = $this->input->post('items');
		$invoice_date = $this->input->post('invoice_date');
		
		$det = $this->data['detail'];
		$this->data['orders'] = $orders = $this->master_db->getcontent1('orders','id',$id);
		$this->data['settings'] = $orders = $this->master_db->getcontent('settings','');
		$this->data['order_type']	=	1;

		/*
		$invoice = $orders[0]->orderid.'-'.$ac_year;
		$invoice_no = $orders[0]->orderid.'/'.$ac_year;
		*/
		$invoice_no = 'DRU'.substr($orders[0]->orderid,9,strlen($orders[0]->orderid)-1).'-'.$ac_year;
		$invoice = 'DRU'.substr($orders[0]->orderid,9,strlen($orders[0]->orderid)-1).'/'.$ac_year;

		$outfile = $savepdf = 'pdf/'.$invoice_no.'.pdf';

		$base_path = "../assets/".$outfile;
	
		$this->data['invoice'] = $invoice; 
		$this->data['date'] = $invoice_date;
		$buff = "";
		if(count($orders)){
			$this->data['order_bill'] = $this->master_db->getcontent1('orders_bill_ship','oid',$id);
			$this->data['order_products'] = $this->master_db->getcontent2('orders_products','oid',$id,'0');
			$this->data['order'] = $this->master_db->getcontent2('orders','id',$id,'');
			
		   $buff = $this->load->view('createIncentive',$this->data,true); 
			
		}

		$filename = $invoice_no.'.pdf';

		$mpdf = new mPDF('',    // mode - default ''
			'A4',    // format - A4, for example, default ''
			0,     // font size - default 0
			'Arial, Helvetica, sans-serif',    // default font family
			5,    // margin left
			5,    // margin right
			5,    // margin top
			5,    // margin bottom
			0,     // margin header
			0,     // margin footer
			'P');  // L - landscape, P - portrait

        $mpdf->SetImportUse();
        $mpdf->WriteHTML($buff);
		$mpdf->Output($base_path, "F");
		
        //$this->m_pdf->pdf->WriteHTML($buff);
		//$this->m_pdf->pdf->Output($base_path,"F");

		$db = array(
			'invoice_no'=>$invoice_no,
			'invoice_date'=>date('Y-m-d',strtotime($invoice_date)),
			'invoice_by'=>$det[0]->id,
			'invoice_pdf'=>''.$base_path,
		);
		$this->master_db->updateRecord1('orders',$db,'id',$id);

		header("Content-type: application/json");
		$json = "";
		$json .= "{";
		$json .= '"query": "",';
		$json .= '"total": "1"';
		$json .= "}";	
		echo $json; 

		//echo $base_path;exit();
	}
	
	public function sendsms_status(){
		$id       = $this->input->post('items');
		$status   = $this->input->post('status');		
		$det=$this->data['detail'];
			
		if($status == '3'){			
				
			require_once '../payu/smsAPI.php';
			$mclass = new sendSms();
				
			$order_bill = $this->master_db->getcontent1('orders_bill_ship','oid',$id);
			$orders = $this->master_db->getcontent1('orders','id',$id);
			$shpname = $order_bill[0]->sname;
			$sms = "Dear $shpname, We are glad to inform you that your order ".$orders[0]->orderid." has been sent for delivery. Please check for any damages at the time of delivery as we do not have an exchange policy once the order is closed.";
			$response = $mclass->sendSmsToUser($sms, "91".$order_bill[0]->sphone);
				
			$db = array(
					'shipsms_response' => $response
			);
		
			$this->master_db->updateRecord('orders',$db,$orders[0]->id);
		}
		else if($status == '4'){
					
			require_once '../payu/smsAPI.php';
			$mclass = new sendSms();
		
			$order_bill = $this->master_db->getcontent1('orders_bill_ship','oid',$id);
			$orders = $this->master_db->getcontent1('orders','id',$id);
			$shpname = $order_bill[0]->sname;
			$sms = "Dear $shpname, Order No: ".$orders[0]->orderid." has been delivered and your order is now closed. Thank you for choosing Artiiplant Product. A Perfect & Elegant Imitation Of Nature.";
			$response = $mclass->sendSmsToUser($sms, "91".$order_bill[0]->sphone);
		
			$db = array(
					'delvrsms_response' => $response
			);
				
			$this->master_db->updateRecord('orders',$db,$orders[0]->id);
		}
	}
	
	public function export_orders(){
		$db=array(
				'fromdate'=>$this->input->get('fromdate'),
				'todate'=>$this->input->get('todate'),
				'orderno'=>$this->input->get('orderno'),
				'phone'=>$this->input->get('phone'),
				'name'=>$this->input->get('name'),
				'email'=>$this->input->get('email'),
				'stat'=>$this->input->get('choosestatus'),
				'estat'=>$this->input->post('echoosestatus'),
		);
		$this->data['orders'] = $this->orders_db->getexport($db);
		$this->load->view('exportOrders',$this->data);
	}
	
	
		public function getcustomer_report()
	{
		$db=array(
			'page'=>$this->input->post('page'),
			'rp'=>$this->input->post('rp'),
			'sortname'=>$this->input->post('sortname'),
			'sortorder'=>$this->input->post('sortorder'),
			'qtype'=>$this->input->post('qtype'),
			'query'=>$this->input->post('query'),
			'letter_pressed'=>$this->input->post('letter_pressed'),
			'fromdate'=>$this->input->post('fromdate'),
			'todate'=>$this->input->post('todate'),
			'email'=>$this->input->post('email'),
			'name'=>$this->input->post('name'),
			'contact'=>$this->input->post('contact'),
			'company'=>$this->input->post('company'),
			'town'=>$this->input->post('town'),
			'zip'=>$this->input->post('zip'),
			'state'=>$this->input->post('state'),
			'country'=>$this->input->post('country'),
		);
		$this->data['customer_data'] = $this->report_db->getcustomers($db);
        echo $this->load->view('get_customer_view',$this->data,TRUE);
	}
	
		public function get_review_report()
	{
		$db=array(
			'page'=>$this->input->post('page'),
			'rp'=>$this->input->post('rp'),
			'sortname'=>$this->input->post('sortname'),
			'sortorder'=>$this->input->post('sortorder'),
			'qtype'=>$this->input->post('qtype'),
			'query'=>$this->input->post('query'),
			'letter_pressed'=>$this->input->post('letter_pressed'),
			'cat'=>$this->input->post('cat'),
			'fromdate'=>$this->input->post('fromdate'),
			'todate'=>$this->input->post('todate'),
			'name'=>$this->input->post('name'),
			'pname'=>$this->input->post('pname'),
			'stat'=>$this->input->post('choosestatus'),
		);
		$this->data['result'] =$this->report_db->getreviews($db);
		//echo $this->db->last_query();exit;
        echo $this->load->view('getreview_reportview',$this->data,TRUE);
	}
	
	public function get_order_report()
	{
		$db=array(
				'page'=>$this->input->post('page'),
				'rp'=>$this->input->post('rp'),
				'sortname'=>$this->input->post('sortname'),
				'sortorder'=>$this->input->post('sortorder'),
				'qtype'=>$this->input->post('qtype'),
				'query'=>$this->input->post('query'),
				'letter_pressed'=>$this->input->post('letter_pressed'),
				'fromdate'=>$this->input->post('fromdate'),
				'todate'=>$this->input->post('todate'),
				'orderno'=>$this->input->post('orderno'),
				'name'=>$this->input->post('name'),
				'email'=>$this->input->post('email'),
				'phone'=>$this->input->post('phone'),
				'stat'=>$this->input->post('choosestatus')
		);
		$this->data['userorders']=$this->orders_db->getuser_orders($db);
	//	echo $this->db->last_query();exit;
        echo $this->load->view('get_order_reportview',$this->data,TRUE);
	}
	public function newinvoiceview() {
		$this->load->library('m_pdf');
		//echo $this->load->view('createInvoice',$this->data,true);
		$id = $this->input->post('items');
		//echo $id;exit;
		$invoice_date = $this->input->post('invoice_date');
		
		$det = $this->data['detail'];
		$this->data['orders'] = $orders = $this->master_db->getcontent1('orders','id',$id);
		//echo "<pre>";print_r($this->data['orders']);exit;
		$this->data['settings'] = $this->master_db->getcontent('settings','');

		$this->data['order_type']	=	1;

		/*
		$invoice = $orders[0]->orderid.'-'.$ac_year;
		$invoice_no = $orders[0]->orderid.'/'.$ac_year;
		*/
		$invoice_no = 'DRU'.substr($orders[0]->orderid,9,strlen($orders[0]->orderid)-1).'-'.$ac_year;

		$invoice = 'DRU'.substr($orders[0]->orderid,9,strlen($orders[0]->orderid)-1).'/'.$ac_year;
		$outfile = $savepdf = 'pdf/'.$orders[0]->orderid.'.pdf';
//echo "<pre>";print_r($outfile);exit;

		$base_path = "../assets/".$outfile;
		//echo base_url().$base_path;exit;
	
		$this->data['invoice'] = $invoice; 
		$this->data['date'] = $invoice_date;
		
			$this->data['order_bill'] = $this->master_db->getcontent1('orders_bill_ship','oid',$id);

			$this->data['order_products'] = $this->master_db->getcontent2('orders_products','oid',$id,'0');
			//echo "<pre>";print_r($this->data['order_products']);exit;

			$this->data['order'] = $this->master_db->getcontent2('orders','id',$id,'');
								//echo "<pre>";print_r($this->data['order']);exit;

			$this->load->view('newinvoice',$this->data);
	}
}

/* End of file kimbadmin.php */
/* Location: ./application/controllers/kimbadmin.php */