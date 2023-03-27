<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST,DELETE,UPDATE");
header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
//header('Content-type: application/json; charset=UTF-8');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
// include_once('easebuzz-lib/easebuzz_payment_gateway.php');
// include_once('easebuzz-lib/payment.php');
class App extends CI_Controller { 
	public function __construct() {
		parent::__construct();	
		//$this->load->model('master_db');
		   $this->load->helper('utility_helper');
		$this->load->model('home_db');
		$this->load->model('products_db');
		$this->load->model('search_db');
		$this->load->model('cart_db');
		$this->load->model('master_db');
		date_default_timezone_set('Asia/Kolkata');
	}
	 public function register() {
            $result = array('status'=>'failure','msg'=>'Required fields are missing.');
            $bodys = file_get_contents('php://input');
            $data = json_decode($bodys, true);
            $phone = trim(preg_replace('!\s+!', '',@$data['phone']));
            if(!empty($phone)) {
                $getPhone = $this->master_db->getRecords('users',['phone'=>$phone],'*');
                if(count($getPhone) >0) {
                    $otp = rand(1234,9999);
                    $uname ="";
                    if(!empty($getPhone[0]->name)) {
                    	$uname .=$getPhone[0]->name;
                    }else {
                    	$uname .="user";
                    }
                      // $message = "Dear Devotees, Your OTP is ".$otp." - Regards, Sri Ramamrita Tarangini Trust.";
                      //    require_once("includes/smsAPI.php");
                      //    $mclass = new sendSms();
                      //  $res = $mclass->sendSmsToUser($message,$phone);
                    	$this->getSms($otp,$phone,$uname);
                        $this->master_db->updateRecord('users',['otp'=>$otp],['id'=>$getPhone[0]->id]);
                        //echo $this->db->last_query();exit;
                    $result = ['status'=>'success','msg'=>'otp sent to mobile number','user_id'=>$getPhone[0]->id];
                }else {
                    $otp = rand(1234,9999);
                    $db['phone'] = $phone;
                    $db['otp'] = $otp;
                    $db['created_at'] = date('Y-m-d H:i:s');
                    $in = $this->master_db->insertRecord('users',$db);
                    if($in >0) {
                        //    $message = "Dear Devotees, Your OTP is ".$otp." - Regards, Sri Ramamrita Tarangini Trust.";
                        //  require_once("includes/smsAPI.php");
                        //  $mclass = new sendSms();
                        // $res = $mclass->sendSmsToUser($message,$phone);
                        $this->getSms($otp,$phone,'user');
                        $result = ['status'=>'success','msg'=>'otp sent to mobile number','user_id'=>$in];
                    }else {
                        $result = ['status'=>'failure','msg'=>'Error in inserting'];
                    }
                }
            }
         echo json_encode($result);
    }
    public function verifyOtp() {
        $result = array('status'=>'failure','msg'=>'Required fields are missing.');
        $bodys = file_get_contents('php://input');
        $data = json_decode($bodys, true);
        $otp = trim(preg_replace('!\s+!', '',@$data['otp']));
        $phone = trim(preg_replace('!\s+!', '',@$data['phone']));
        if(!empty($otp) && !empty($phone) ) {
             $getPhone = $this->master_db->getRecords('users',['phone'=>$phone,'otp'=>$otp],'*');
             if(count($getPhone) >0) {
                $result =['status'=>'success','msg'=>'otp verified successfully','user_id'=>$getPhone[0]->id];
             }else {
                $result =['status'=>'failure','msg'=>'OTP not verified'];
             }
        }
        echo json_encode($result);
    }
    public function resendOtp() {
        $result = array('status'=>'failure','msg'=>'Required fields are missing.');
        $bodys = file_get_contents('php://input');
        $data = json_decode($bodys, true);
        $phone = trim(preg_replace('!\s+!', '',@$data['phone']));
        if(!empty($phone) ) {
             $getPhone = $this->master_db->getRecords('users',['phone'=>$phone],'*');
             if(count($getPhone) >0) {
                $otp = rand(1234,9999);
               	$uname ="";
                    if(!empty($getPhone[0]->name)) {
                    	$uname .=$getPhone[0]->name;
                    }else {
                    	$uname .="user";
                    }
                      // $message = "Dear Devotees, Your OTP is ".$otp." - Regards, Sri Ramamrita Tarangini Trust.";
                      //    require_once("includes/smsAPI.php");
                      //    $mclass = new sendSms();
                      //  $res = $mclass->sendSmsToUser($message,$phone);
                    	$this->getSms($otp,$phone,$uname);
                $this->master_db->updateRecord('users',['otp'=>$otp],['phone'=>$phone]);
                $result =['status'=>'success','msg'=>'otp sent to mobile number','user_id'=>$getPhone[0]->id];
             }else {
                $result =['status'=>'failure','msg'=>'OTP not sent'];
             }
        }
        echo json_encode($result);
    }
	public function login() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		 $bod = file_get_contents('php://input');
			$data = json_decode($bod, true);
			$email = trim(preg_replace('!\s+!', '',$data['email']));
			$pass = trim(preg_replace('!\s+!', '',$data['password']));
		 if(!empty($email) && !empty($pass)) {
		 	$count = $this->home_db->getRecords('users',['emailid'=>$email,'password'=>sha1($pass)],'id,emailid,phone,name');
		 	if(count($count)) {
		 		$data = ['user_id'=>$count[0]->id,'username'=>$count[0]->name,'email'=>$count[0]->emailid,'phone'=>$count[0]->phone];
		 		$result = array('status'=>'success','login_data'=>$data);
		 	}else {
		 		$result = array('status'=>'failure','msg'=>'Email not exists.');
		 	}
		 }
		 echo json_encode($result);
	}
	public function banners() {
		//echo "New";die();
		$list = $this->home_db->getRecords('banner',array('status ='=>0),'id,banner_image,banner_link');
		if(count($list)){
			$ar =[];
			foreach ($list as $key => $value) {
				$ar[] =$value;
				$value->banner_image = base_url($value->banner_image);
			}
			$result = array('status'=>'success','banner_data'=>$ar);
		}else {
			$result = array('status'=>'success','msg'=>'No data found');
		}
        echo json_encode($result);
	}
	public function category_list() {
		$list = $this->home_db->getRecords('category',array('status'=>0),'id as cid ,name,image_path,page_url','order_no asc');
		if(count($list)) {
			foreach ($list as $key => $value) {
				$value->image_path = base_url($value->image_path);
			}
			$result = array('status'=>'success','category_data'=>$list);
		}else {
			$result = array('status'=>'success','msg'=>'No data found');
		}
        echo json_encode($result);
	}
	public function product_list() {
			error_reporting(1);ini_set('display_errors', TRUE);
				$where =" where p.status !=2";
				$product_list = file_get_contents('php://input');
				$pro = json_decode($product_list, true);
				$cat_id = @trim(preg_replace('!\s+!', '',$pro['cat_id']));
				$subcat_id = @trim(preg_replace('!\s+!', '',$pro['subcat_id']));
				$price = @$pro['price'];
				$dimension = @$pro['dimension'];
				$price_range = $pro['price_range'];
				$sort = @trim(preg_replace('!\s+!', '',$pro['sort']));
				if(!empty($cat_id)) {
					$where .= " and p.cat_id=".$cat_id."  ";
				}
				$order_by ="";
				if(!empty($subcat_id) && $subcat_id!='') {
					$where .= " and p.subcat_id=".$subcat_id."  ";
				}
				if(!empty($price_range)) {
				$condition = "";
            	$explode = explode(",", $price_range);
            	if(is_array($explode)) {
            		foreach ($explode as $key => $value) {
            			$ex = $value;
        				$condition = [];
		            	if($ex ==1) {
		                    $pr1 = 100; $pr2 =300; 
		                    $condition[]= " and ps.selling_price >= ".$pr1." and  ps.selling_price <= ".$pr2." ";
		                }
		                if($ex ==2) {
		                    $pr3 = 300; $pr4 =500; 
		                    $condition[]= " and ps.selling_price >= ".$pr3." and ps.selling_price <= ".$pr4." ";
		                }
		                if($ex ==3) {
		                    $pr5 = 500; $pr6 =700; 
		                    $condition[]= " and ps.selling_price >= ".$pr5." and ps.selling_price <= ".$pr6." ";
		                }
		                if($ex ==4) {
		                    $pr7 = 700; $pr8 =900; 
		                    $condition[]= " and ps.selling_price >= ".$pr7." and ps.selling_price <= ".$pr8." ";
		                }
		                if($ex ==5) {
		                    $pr9 =1000; 
		                    $condition[]= " and ps.selling_price >= ".$pr9." ";
		                }
		                $im = implode(" ", $condition);
		                $sql = $this->home_db->sqlExecute('select c.name as cname, p.name as pname,p.id as pid,p.cat_id,c.page_url as cpage_url,ps.mrp,ps.selling_price,p.subcat_id,p.page_url as ppage_url,p.tax,p.pcode,p.status,p.page_url as ppage_url,p.testimonials,p.differencenoted,m.name as mname,co.name as coname,pi.image_path,ps.stock,ps.id as psid,s.id as sid,s.name as sname,su.page_url as subpage_url from products p left join category c on c.id = p.cat_id left join colors co on co.id = p.color_id left join product_images pi on  pi.pid =p.id left join product_sizes ps on ps.pid =p.id left join sizes s on s.id = ps.size_id left join materials m on m.id=p.material_id left join subcategory su on su.id = p.subcat_id '.$where.' '.$im.' group by ps.pid');
		               // echo $this->db->last_query();exit;
		                	foreach ($sql as $key => $value) {
                  				$res[]=$value;
                  				$value->image_path=base_url($value->image_path);
               				}
			  				$result = array('status'=>'success','product_data'=>$sql);
			  				echo json_encode($result);exit;
            			}
            		}
				}
				if($sort ==1) {
					$order_by .="ps.selling_price asc";
				}else if($sort ==2) {
					$order_by .="ps.selling_price desc";
				}
				else if($sort ==3) {
					$order_by .="p.name asc";
				}
				else if($sort ==4) {
					$order_by .="p.name desc";
				}else {
					$order_by .="p.id desc";
				}
				$categ = $this->home_db->runSql('select page_url from category where status =0');
					$sql = "select c.name as cname,c.page_url as cpage_url,p.id,p.page_url as ppage_url,s.name as sname,s.page_url as spage_url,p.name as title,p.pcode,p.youtube,p.overview,p.status,p.cat_id,p.subcat_id,pi.image_path,pi.thumb,ps.mrp,ps.selling_price,ps.stock,ps.id as psid,s.id as sid,s.name as sname,ps.minimum_buy,s.page_url as spage_url,ps.sel_dollar,ps.b2b_selling_price,ps.b2b_sel_dollar,p.how_to_use,p.youtube,p.testimonials,p.differencenoted from products p left join product_images pi on p.id=pi.pid left join product_sizes ps on p.id=ps.pid left join sizes s on ps.size_id=s.id left join category c on p.cat_id=c.id ".$where." group by ps.pid order by ".$order_by." ";
							$query = $this->db->query($sql);
							echo $this->db->last_query();exit;
							$res= $query->result();
							foreach ($res as $data) {
								$data->image_path = base_url($data->image_path);
								$data->thumb = base_url($data->thumb);
							}
							if(count($res)) {
								$result = array('status'=>'success','product_data'=>$res);
							}else {
								$result = array('status'=>'success','msg'=>'No data found');
							}
			
				
        		//echo json_encode($result);
		}
		
		public function gift_list() {
			$list = $this->home_db->runSql('select g.title,g.id,g.image_path from gifts g where g.status !=2 limit 4');
			if(count($list)) {
				$ar = [];
				foreach ($list as $value) {
					$ar[] =$value;
					$value->image_path = base_url($value->image_path);
				}
				$result = array('status'=>'success','gift_data'=>$ar);
			}else {
				$result = array('status'=>'success','msg'=>'No data found');
			}
	        echo json_encode($result);
		}
		public function gifts_insert() {
		 $result = array('status'=>'failure','msg'=>'Required fields are missing.');
		 $giftsinsert = file_get_contents('php://input');
			$gifts = json_decode($giftsinsert, true);
			$title = trim(preg_replace('!\s+!', '',$gifts['title']));
			$user_id = trim(preg_replace('!\s+!', '',$gifts['user_id']));
			$email = trim(preg_replace('!\s+!', '',$gifts['email']));
			$phone = trim(preg_replace('!\s+!', '',$gifts['phone']));
			$order_summary = trim(preg_replace('!\s+!', '',$gifts['order_summary']));
			if(!empty($title) && !empty($user_id) && !empty($email) && !empty($phone) && !empty($order_summary)) {
		 	$insertDB = array(
		 			'title'	     		=>$title,
		 			'email'	     		=>$email,
		 			'mphone'	 		=>$phone,
		 			'order_details'	    =>$order_summary,
		 			'created_date'		=>date('Y-m-d H:i:s'),
		 			'user_id'			=>$user_id
		 		);
		 		$insert = $this->home_db->insertRecord('gifts',$insertDB);
		 		if($insert) {
		 			$userdata = ['gift_id'=>$insert,'user_id'=>$user_id,'gift_title'=>$title];
		 			$result = array('status'=>'success','gifts_data'=>$userdata);
		 		}
		}
		echo json_encode($result);
	}
	public function gifts_request() {
		 $result = array('status'=>'failure','msg'=>'Required fields are missing.');
		 $giftsinsert = file_get_contents('php://input');
			$gifts = json_decode($giftsinsert, true);
			$gift_id = trim(preg_replace('!\s+!', '',$gifts['gift_id']));
		if(!empty($gift_id)) {
		 	$insertDB = array(
		 			'gift_id'	        =>$gift_id,
		 			'created_date'		=>date('Y-m-d H:i:s')
		 		);
		 		$insert = $this->home_db->insertRecord('gift_products',$insertDB);
				$result = array('status'=>'success','msg'=>"Successfully gifted");
		}
		echo json_encode($result);
	}
	public function submenus() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$submenus = file_get_contents('php://input');
		$datas = json_decode($submenus, true);
		$catid = trim(preg_replace('!\s+!', '',$datas['cat_id']));
		if(!empty($catid)) {
			$list = $this->home_db->getRecords('subcategory',array('category_id'=>$catid,'status'=>0,'type'=>1),'id ,name','id desc');
			if(count($list)) {
				$result = array('status'=>'success','submenu_data'=>$list);
			}else {
				$result = array('status'=>'success','msg'=>'No data found');
			}
		}
		echo json_encode($result);
	}
	public function product_details() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$prodetailss = file_get_contents('php://input');
		$datas = json_decode($prodetailss, true);
		$prod_url = trim(preg_replace('!\s+!', '',$datas['page_url']));
		if(!empty($prod_url)) {
				$list = $this->home_db->productDetailsApiList($prod_url);
				$getSpecification = $this->master_db->getRecords('product_spec',['pid'=>$list[0]->id],'spec_name as ingradient,spec_val as botanical_name,quantity as quantity_used');
				
				//echo $this->db->last_query();exit;
				//$list = $this->home_db->productDetailsWithoutSize($prod_url);
				$reviews = $this->home_db->getRecords('reviews',['pid'=>$list[0]->id,'status'=>0],'name as title,rating,review_descp as comment,created_date');
				 $prosize = $this->home_db->sqlExecute('select s.id as sid,s.name as sname,ps.id as psid,ps.mrp,ps.selling_price,ps.stock from product_sizes ps left join sizes s on s.id = ps.size_id where ps.pid ='.$list[0]->id.'');
				//echo $this->db->last_query();exit;
				$rate = $this->products_db->getratings($list[0]->id);
					$rates = str_replace(".0000", "", $rate);
					$rate = [];
				
					$countReviews = count($reviews);	
					$sizes = $this->home_db->getRecords('sizes',['id'=>@$list[0]->sid],'id,name');	
					$raten = "";
					if(count($reviews) >0) {
						$raten .=array_sum($rate)/count($reviews);
					}else {
						$raten .=0;
					}	
					
					$settings = $this->home_db->runSql('select * from settings limit 1');
					if(!empty($list[0]->image_large )) {
						$list[0]->image_large = base_url($list[0]->image_large);
					}
					if(!empty($list[0]->image_medium )) {
					$list[0]->image_medium = base_url($list[0]->image_medium);
				}
					$list[0]->reviews=$countReviews;
					$list[0]->rating=$rates;
					$list[0]->image_path = base_url($list[0]->image_path);
					$list[0]->thumb = base_url($list[0]->thumb);
					$list[0]->review_list = $reviews;
					$list[0]->product_size = $prosize;
					$ex = "";
				if(!empty($list[0]->youtubelink)) {
					$ex = explode("v=", $list[0]->youtubelink);
					$list[0]->youtubeid = $ex[1];
				}
						
						
				
					
					$cpage_url = $list[0]->cpage_url;
					$pid = $list[0]->id;
					//$mid = $list[0]->mid;
				if(count($getSpecification) >0) {
					$list[0]->ingradients = $getSpecification;
				}else {
					$list[0]->ingradients =[];
				}

					 $listArray = $this->home_db->productDetailsViewS( $list[0]->id,$list[0]->cid);
     //        $listArray = $this->home_db->productDetailsViewSimilars( $list[0]->id,$list[0]->cid);
					$ar =[];$pp=[];
					
				
						
						$id = $list[0]->id;$pimages =[];
						$pi = $this->home_db->getRecords('product_images',['pid'=>$id],'id,thumb,image_path,image_medium,image_large');
						foreach ($pi as $key => $pimg) {
							$pimg->thumb = base_url($pimg->thumb);
							$pimg->image_path = base_url($pimg->image_path);
							$pimg->image_medium = base_url($pimg->image_medium);
							$pimg->image_large = base_url($pimg->image_large);
							$pimages[]=$pimg;
						}
						$list[0]->gallery = $pimages;

						if(is_array($listArray)) {
							foreach (@$listArray as $res) {
						$ar[] = $res;

						$res->image_path = base_url($res->image_path);
						$res->thumb = base_url($res->thumb);
						if(!empty($res->image_large)) {
							$res->image_large = base_url($res->image_large);
						}
						
						}
						}
					
				if(count($list)) {
						$result = array(
							'status'=>'success',
							'product_data'=>$list,
							'related_products'=>$ar
						);
				}else {
					$result = array('status'=>'failure','msg'=>'No data found');
				}					
			}
					echo json_encode($result);
		
		}
	
public function reviews() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$reviewss= file_get_contents('php://input');
			$review = json_decode($reviewss, true);
			$name = trim(preg_replace('!\s+!', '',$review['name']));
			$user_id = trim(preg_replace('!\s+!', '',$review['user_id']));
			$email = trim(preg_replace('!\s+!', '',$review['email']));
			$comment = trim(preg_replace('!\s+!', '',$review['comment']));
			$star_rate = trim(preg_replace('!\s+!', '',$review['star_rate']));
			$pid = trim(preg_replace('!\s+!', '',$review['pid']));
			if(!empty($user_id) && !empty($name) && !empty($email) && !empty($comment) && !empty($star_rate) && !empty($pid)) {

			
			$user = $this->home_db->getRecords('users',['id'=>$user_id],'name');
			//echo $this->db->last_query();exit;
		
					$list = $this->home_db->getRecords('reviews',['pid'=>$pid,'user_id'=>$user_id],'name');
					//echo $this->db->last_query();exit;
					if(count($list) >0) {
						$result = array('status'=>'failure','msg'=>'Review already exists');
					}else {
						$insertDB = array(
				 			'name'	     	=>$name,
				 			'email'	     	=>$email,
				 			'rating'	 	=>$star_rate,
				 			'psid'	 	    =>$pid,
				 			'review_descp'	=>$comment,
				 			'created_date'	=>date('Y-m-d H:i:s'),
				 			'status'		=>0,
				 			'user_id' 	 	=>$user_id,
				 		);
				 		$insert = $this->home_db->insertRecord('reviews',$insertDB);
				 		if($insert) {
				 			$userdata = ['user_id'=>$insert,'email'=>$email];
				 			$result = array('status'=>'success');
				 		}else {
				 			$result = array('status'=>'failure','msg'=>'There is an error inserting data');
				 		}
					}
					
				
			
		}
		echo json_encode($result);
	}
	public function wishlist() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$wishlist = file_get_contents('php://input');
		$dat = json_decode($wishlist, true);
		$user_id = @trim(preg_replace('!\s+!', '',$dat['user_id']));
		if(!empty($user_id)) {
			$list = $this->home_db->runSql('select c.name as cname,p.name as title,p.id,p.page_url,p.pcode,p.status,pi.image_path,ps.id as psid,pi.thumb,ps.selling_price,ps.mrp,ps.stock,s.name as sname,w.id as wid,s.id as sid,p.tax from products p left join product_sizes ps on p.id=ps.pid left join product_images pi on p.id=pi.pid left join sizes s on s.id =ps.size_id left join category c on c.id =p.cat_id left join wishlist w on w.pid=p.id where w.user_id='.$user_id.' group by ps.pid  order by p.id desc');
			if(count($list) >0) {
				$ar =[];
				foreach ($list as $value) {
					$ar[] =$value;
					$value->image_path = base_url($value->image_path);
				}
				$result = array('status'=>'success','whislist_data'=>$ar);
			}else {
				$result = array('status'=>'failure','msg'=>'No data found');
			}
		}
		echo json_encode($result);
	}
	public function removeWishlist() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$removeWishlist = file_get_contents('php://input');
		$datas = json_decode($removeWishlist, true);
		$user_id = trim(preg_replace('!\s+!', '',$datas['user_id']));
		$wish_id = trim(preg_replace('!\s+!', '',$datas['wish_id']));
		if(!empty($user_id) && !empty($wish_id)) {
			$delete = $this->home_db->delete_wishlist(['id'=>$wish_id,'user_id'=>$user_id]);
			if($delete) {
				$result = array('status'=>'success','msg'=>'Wishlist deleted successfully.');
			}else {
				$result = array('status'=>'success','msg'=>'Wishlist not deleted.');
			}
		}
		echo json_encode($result);
	}
	public function stateMaster() {
		$list = $this->home_db->getRecords('states',['status'=>0],'id,name');
		if(count($list)) {
			$result = array('status'=>'success','state_data'=>$list);
		}else {
			$result = array('status'=>'failure','msg'=>'No data found');
		}
        echo json_encode($result);
	}
	public function cityList() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$cityList = file_get_contents('php://input');
		$da = json_decode($cityList, true);
		$state_id = trim(preg_replace('!\s+!', '',$da['state_id']));
		if(!empty($state_id)) {
			$list = $this->home_db->getRecords('cities',['state_id'=>$state_id],'name,id');
			//echo $this->db->last_query();exit;
			if(count($list)) {
				$result = array('status'=>'success','city_data'=>$list);
			}else {
				$result = array('status'=>'failure','msg'=>'No data found');
			}
		}
		echo json_encode($result);
	}
	public function myOrders() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$orders = file_get_contents('php://input');
		$data = json_decode($orders, true);
		$user_id = trim(preg_replace('!\s+!', '',$data['user_id']));
		//echo "<pre>";print_r($data);exit;
			if(!empty($user_id)) {
				$sql = 'select orderid,id,date_format(ordered_date,"%d-%m-%Y") as order_date,total_amt_paid,status ,paymode as pay_mode from orders where user_id='.$user_id.' order by id desc';
				$list = $this->home_db->runSql($sql);
			//echo $this->db->last_query();exit;
				if(count($list)) {
					$result = array('status'=>'success','orders_data'=>$list);
				}else {
					$result = array('status'=>'failure','msg'=>'No data found');
				}
			}
			echo json_encode($result);
		}

			public function myOrdersViews() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$orders = file_get_contents('php://input');
		$data = json_decode($orders, true);
		$user_id = trim(preg_replace('!\s+!', '',$data['user_id']));
		//echo "<pre>";print_r($data);exit;
			if(!empty($user_id)) {
				$sql = 'select orderid,id,date_format(ordered_date,"%d-%m-%Y") as order_date,total_amt_paid,status,total_amt_paid,paymode as pay_mode from orders where user_id='.$user_id.' order by id desc';
				$list = $this->home_db->runSql($sql);
			//echo $this->db->last_query();exit;
				if(count($list)) {
						$listArr = [];
					foreach ($list as $key => $value) {
						$id = $value->id;
						
						$orderDetails = $this->home_db->runSql('select oid,pname,psid,ptitle,pcode,qty,unit_price,size_id,size_name,image_path,status from orders_products where oid ='.$id.'');
						$oarray =[];
						foreach ($orderDetails as $key => $new) {
							//$new->image_path = base_url($new->image_path);
							$oarray[] = $new;
						}
						$value->product_array = $oarray;
						$listArr[] = $value;
					}

					$result = array('status'=>'success','order_data'=>$listArr);
			}else {
					$result = array('status'=>'failure','msg'=>'No data found');
				}
			}
			echo json_encode($result);
		}
		public function orderDetails() {
			//error_reporting(1);ini_set('display_errors', TRUE);
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$ordersdetails = file_get_contents('php://input');
			$data = json_decode($ordersdetails, true);
			$user_id = trim(preg_replace('!\s+!', '',$data['user_id']));
			$orderid = trim(preg_replace('!\s+!', '',$data['order_id']));
			if(!empty($user_id) ) {
				$orderIds ="";
				if(!empty($orderid)) {
					$orderIds .='and o.id='.$orderid.'';
				}
				$sql = 'select o.id,o.orderid,o.total_amt_paid as totalamountpaid,o.total_amt as sub_total,o.coupon_code,o.discount as discountamount,o.devilery_charge as delivery_charges,o.delivery_days,o.paymode,o.discount_per as discountpercentage,o.saved_amt,o.delivery_date,o.taxamount, date_format(o.ordered_date,"%d-%m-%Y") as order_date,o.total_amt_paid,CASE 
					WHEN o.status  =-1 THEN "Failed"
					WHEN o.status = 1 THEN "Success"
					WHEN o.status = 2 THEN "Pending"
					WHEN o.status = 3 THEN "Shipping"
					WHEN o.status = 4 THEN "Delivered"
					END AS status,obs.bname,obs.bemail,obs.baddr1,obs.baddr2,obs.bcity,obs.bcity_id,obs.bstate,obs.bcountry,obs.bpincode,obs.bphone,obs.sname,obs.saddr1,obs.saddr2,obs.scity,obs.scity_id,obs.sstate,obs.scountry,obs.spincode,obs.sphone,obs.landmark from orders o inner join orders_bill_ship obs on obs.oid =o.id where o.user_id='.$user_id.' '.$orderIds.'';
				$list = $this->home_db->runSql($sql);
			//echo $this->db->last_query();exit;
				if(count($list)) {
					$ar =[];
					foreach ($list as $orders) {
						$ar[] =$orders;
						$orders->image_path = base_url($orders->image_path);
						$parray = $this->home_db->runSql("select * from orders_products where oid=".$orders->id."");
						$orders->product_array = $parray;
					}
					$result = array('status'=>'success','orders_data'=>$ar);
				}else {
					$result = array('status'=>'failure','msg'=>'No data found');
				}
			}
			echo json_encode($result);
		}
		public function profileDetails() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$profile = file_get_contents('php://input');
			$data = json_decode($profile, true);
			$user_id = trim(preg_replace('!\s+!', '',$data['user_id']));
			if(!empty($user_id)) {
			$list = $this->home_db->getRecords('users',['id'=>$user_id],'id,name,sname,phone,emailid,address1,address2,country,town,state,town_name,state_name,zip,dob,gender');
			//echo $this->db->last_query();exit;
			if(count($list)) {
				$userdata = ['user_id'=>$list[0]->id,'fullname'=>$list[0]->name,'phone'=>$list[0]->phone,'email'=>$list[0]->emailid,'billing_address_1'=>$list[0]->address1,'billing_address_2'=>$list[0]->address2,'country_id'=>$list[0]->country,'town_id'=>$list[0]->town,'state_id'=>$list[0]->state,'town_name'=>$list[0]->town_name,'state_name'=>$list[0]->state_name,'pincode'=>$list[0]->zip,'dob'=>$list[0]->dob,'gender'=>$list[0]->gender];
				$result = array('status'=>'success','profile_data'=>$userdata);
			}else {
				$result = array('status'=>'failure','msg'=>'No data found');
			}
		}
		echo json_encode($result);
		}
		public function updateProfile() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$updateprofile = file_get_contents('php://input');
			$data = json_decode($updateprofile, true);
			$user_id = trim(preg_replace('!\s+!', '',$data['user_id']));
			$first_name = trim(preg_replace('!\s+!', '',$data['fullname']));
			$phone = trim(preg_replace('!\s+!', '',$data['phone']));
			$emailid = trim(preg_replace('!\s+!', '',$data['email']));
			$billing_address_1 = trim($data['billing_address_1']);
			$billing_address_2 = trim($data['billing_address_2']);
			$state = trim(preg_replace('!\s+!', '',$data['state']));
			$pincode = trim(preg_replace('!\s+!', '',$data['pincode']));
			$city = trim(preg_replace('!\s+!', '',$data['city']));
			$state_id = trim(preg_replace('!\s+!', '',$data['state_id']));
			$city_id = trim(preg_replace('!\s+!', '',$data['city_id']));
			$dob = trim(preg_replace('!\s+!', '',$data['dob']));
			$gender = trim(preg_replace('!\s+!', '',$data['gender']));
			if(!empty($user_id) && !empty($first_name) && !empty($phone) && !empty($billing_address_1) && !empty($billing_address_2) && !empty($state) && !empty($pincode) && !empty($city) && !empty($state_id) && !empty($city_id) && !empty($dob) && !empty($gender) && !empty($emailid)) {
				$update = $this->home_db->updateRecord('users',['name'=>$first_name,'phone'=>$phone,'address1'=>$billing_address_1,'address2'=>$billing_address_2,'dob'=>$dob,'gender'=>$gender,'town'=>$city_id,'state'=>$state_id,'town_name'=>$city,'state_name'=>$state,'zip'=>$pincode,'emailid'=>$emailid,'modified_at'=>date('Y-m-d H:i:s')],'id',$user_id);
				if($update) {
					$result = array('status'=>'success','msg'=>'Profile updated successfully');
				}else {
					$result = array('status'=>'failure','msg'=>'Profile not updated');
				}
			}
			echo json_encode($result);
		}
		public function searchSuggestion() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$searchSuggestion = file_get_contents('php://input');
			$data = json_decode($searchSuggestion, true);
			$search_term = $data['search_term'];
			if(!empty($search_term)) {
				$category = array();
				$categ = $this->home_db->runSql('select p.id,p.name as pname from products p left join category c on c.id=p.cat_id where p.name like "%'.$search_term.'%" OR c.name like "%'.$search_term.'%"');
				//echo $this->db->last_query();exit;
				if(count($categ) >0){
					$result = array('status'=>'success','search_suggestion'=>$categ);
				}
				else{
					$result = array('status'=>'failure','msg'=>"No result found");
				}
			}
			echo json_encode($result);
		}
		public function searchResults() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$searchRess = file_get_contents('php://input');
			$searchRes = json_decode($searchRess, true);
			$term = $searchRes['term'];
			if(!empty($term)) {
				$categ = $this->home_db->runSql('select c.name as cname,c.page_url as cpage_url,p.id,p.page_url as ppage_url,s.name as sname,s.page_url as spage_url,p.name as title,p.pcode,p.overview,p.status,p.cat_id,p.subcat_id,pi.image_path,pi.thumb,ps.id as psid,ps.mrp,ps.selling_price,ps.stock,ps.minimum_buy,s.page_url as spage_url,s.id as sid,ps.sel_dollar,ps.b2b_selling_price,ps.b2b_sel_dollar,p.material_id as mid,p.status,p.tax from products p left join category c on p.cat_id = c.id left join product_sizes ps on ps.id=p.id left join product_images pi on pi.pid = p.id left join sizes s on s.id = ps.size_id left join subcategory su on su.id=p.subcat_id where p.name like "%'.$term.'%" or p.name like "%'.$term.'%" or c.name like "%'.$term.'%" or su.name like "%'.$term.'%"  and p.status=0 group by ps.pid order by p.id desc');
				//echo $this->db->last_query();exit;
				foreach ($categ as $key => $value) {
						$value->image_path = base_url($value->image_path);
						$value->thumb = base_url($value->thumb);
				}
			
				//echo "<pre>";print_r($categ);exit;
				if(count($categ)){
					$result = array('status'=>'success','search_results'=>$categ);
				}else {
					$result = array('status'=>'success','msg'=>"No data found");
				}
			}
			echo json_encode($result);
		}
		public function menus() {
			$cat = $this->home_db->getRecords('category',['status'=>0],'id as catid,name as cat_name,page_url');
			if(count($cat)) {
				foreach ($cat as $value) {
					$catid = $value->catid;

					$subcat = $this->home_db->getRecords('subcategory',['status'=>0,'category_id'=>$catid],'id as subid,name as subname,page_url as subpage_url');
					$ar = [];
					foreach ($subcat as $subcat) {
						$ar[]= $subcat;
					}
					$value->subcat_list = $ar;
				}
				//$cat['subcat_list'] = $ar;
				$result = array('status'=>'success','category_list'=>$cat);
			}else {
				$result = array('status'=>'failure','msg'=>'No result found');
			}
			echo json_encode($result);
		}
		public function filterMenu() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$filterMenu = file_get_contents('php://input');
			$filter = json_decode($filterMenu, true);
			$cat_id = trim(preg_replace('!\s+!', '',$filter['cat_id']));
			if(!empty($cat_id)) {
				$categ = $this->home_db->runSql('select page_url from category where status =0');
				if(count($categ)){
					$output=[];
					foreach ($categ as $key => $value) {
						$page_url = $value->page_url;
						$sql = "select pid,cid,pname,selling_price,mrp,sname from (SELECT pid,cid,pname,selling_price,mrp,sname FROM frontview_".$page_url."_product where cid=".$cat_id." order by CAST(selling_price AS DECIMAL) asc ) t group by t.pid ";
							$query = $this->db->query($sql);
							$res= $query->result();
							foreach ($res as $data) {
								$output[] = $data;
								$range = ['100 - 300','300+'];
								$data->range = $range;
							}
					}
					$result = array('status'=>'success','filterMenu_data'=>$output);
				}else {
					$result = array('status'=>'success','msg'=>"No data found");
				}
			}
			echo json_encode($result);
		}
		public function dimensionList() {
			$cat = $this->home_db->runSql('select id as did,name as dimension from  sizes where status=0');
			//echo $this->db->last_query();exit;
			if(count($cat)) {
				$result = array('status'=>'success','dimension_list'=>$cat);
			}else {
				$result = array('status'=>'failure','msg'=>[]);
			}
			echo json_encode($result);
		}
		public function dimentionFilters() {
			 $result = array('status'=>'failure','msg'=>'Required fields are missing.');
            $dimension = file_get_contents('php://input');
            $dimen = json_decode($dimension, true);
            $d_id = trim(preg_replace('!\s+!', '',$dimen['d_id']));
            $page_url = trim(preg_replace('!\s+!', '',$dimen['page_url']));
            $sub_url = trim(preg_replace('!\s+!', '',$dimen['sub_url']));
            if(!empty($d_id) && !empty($page_url) && !empty($sub_url)) {
				$condition = " sid in (".$d_id.") and subpage_url='".$sub_url."'";
                $sql = "select pid,pname,cimage_path,selling_price,mrp,sname from (SELECT pid,pname,cimage_path,selling_price,mrp,sname FROM frontview_".$page_url."_product where ".$condition." order by CAST(selling_price AS DECIMAL) asc ) t group by t.pid ";
                  	$output = $this->home_db->runSql($sql);$res=[];
                  	foreach ($output as $key => $value) {
                  		$res[]=$value;
                  		$value->cimage_path=base_url($value->cimage_path);
                  	}
            	$result = array('status'=>'success','dimension_data'=>$res);
            }
            echo json_encode($result);
		}
		public function sortList() {
			$ar =['1','2','3','4'];$sort = ['Low to High','High to Low','Newest First ','Popularity'];
			$jsonArray = array();
			foreach (array_combine( $ar, $sort ) as $name => $value) {
			    $jsonArray[] = array('sid' => $name, 'sortname' => $value);
			}
			echo $json = json_encode(['status'=>'success','sort_list'=>$jsonArray]);
		}
		public function sortFilters() {
			 $result = array('status'=>'failure','msg'=>'Required fields are missing.');
            $sortList = file_get_contents('php://input');
            $sort = json_decode($sortList, true);
            $sort_type = trim(preg_replace('!\s+!', '',$sort['sort_type']));
            $page_url = trim(preg_replace('!\s+!', '',$sort['page_url']));
            $sub_url = trim(preg_replace('!\s+!', '',$sort['sub_url']));
            if(!empty($sort_type) && !empty($page_url) && !empty($sub_url)) {
            	$condition = "subpage_url='".$sub_url."'";
            	$orderby ="";
            	if($sort_type ==1) {
            		$orderby .= "order by selling_price asc";
            	}elseif($sort_type ==2) {
            		$orderby .= "order by selling_price desc";
            	}elseif($sort_type ==3) {
            		$orderby .= "order by pname asc";
            	}elseif($sort_type ==4) {
            		$orderby .= "order by pname desc";
            	}
               $sql = "select pid,pname,cimage_path,selling_price,mrp,sname from (SELECT pid,pname,cimage_path,selling_price,mrp,sname FROM frontview_".$page_url."_product where ".$condition." ".$orderby.")  t group by t.pid ".$orderby."";
                  	$output = $this->home_db->runSql($sql);$res=[];
                  	//echo $sql;exit;
               foreach ($output as $key => $value) {
                  $res[]=$value;
                  $value->cimage_path=base_url($value->cimage_path);
               }
			  $result = array('status'=>'success','sort_data'=>$res);
            }
                echo json_encode($result);
		}
		public function priceList() {
			$id =['1','2','3','4','5'];$price = ['100 - 300','300 -500','500 - 700','700 - 900','1000+'];
			$jsonArray = array();
			foreach (array_combine( $id, $price ) as $name => $value) {
			    $jsonArray[] = array('p_id' => $name, 'price' => $value);
			}
			echo $json = json_encode(['status'=>'success','price_list'=>$jsonArray]);
		}
		public function priceFilters() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
            $price = file_get_contents('php://input');
            $priceList = json_decode($price, true);
            $price_range = trim(preg_replace('!\s+!', '',$priceList['price_range']));
            $sub_url = trim(preg_replace('!\s+!', '',$priceList['subcat_id']));
            if(!empty($price_range) && !empty($sub_url)) {
            	$where = "where p.status =0 and p.subcat_id =".$sub_url." ";
 				$condition = "";
            	$explode = explode(",", $price_range);
            	if(is_array($explode)) {
            		foreach ($explode as $key => $value) {
            			$ex = $value;
        				$condition = [];
		            	if($ex ==1) {
		                    $pr1 = 100; $pr2 =300; 
		                    $condition[]= " and ps.selling_price >= ".$pr1." and  ps.selling_price <= ".$pr2." ";
		                }
		                if($ex ==2) {
		                    $pr3 = 300; $pr4 =500; 
		                    $condition[]= " and ps.selling_price >= ".$pr3." and ps.selling_price <= ".$pr4." ";
		                }
		                if($ex ==3) {
		                    $pr5 = 500; $pr6 =700; 
		                    $condition[]= " and ps.selling_price >= ".$pr5." and ps.selling_price <= ".$pr6." ";
		                }
		                if($ex ==4) {
		                    $pr7 = 700; $pr8 =900; 
		                    $condition[]= " and ps.selling_price >= ".$pr7." and ps.selling_price <= ".$pr8." ";
		                }
		                if($ex ==5) {
		                    $pr9 =1000; 
		                    $condition[]= " and ps.selling_price >= ".$pr9." ";
		                }
		                $im = implode(" ", $condition);
		                $sql = $this->home_db->sqlExecute('select p.id as pid,s.name as sname,p.name as pname,p.pcode,pi.image_path as cimage_path,ps.mrp,ps.selling_price,ps.stock,ps.id as psid,s.id as sid FROM products p left join product_sizes ps on ps.pid = p.id left join product_images pi on pi.pid=p.id left join sizes s on ps.size_id=s.id '.$where.' '.$im.'  group by ps.pid,pi.pid order by ps.selling_price asc');
		                	foreach ($sql as $key => $value) {
                  				$res[]=$value;
                  				$value->cimage_path=base_url($value->cimage_path);
               				}
			  				$result = array('status'=>'success','price_data'=>$res);
            		}
            	}
            	 
            }
          echo json_encode($result); 
		}
	
		public function payments() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$pay = file_get_contents('php://input');
			$payment = json_decode($pay, true);
			$order_id = trim(preg_replace('!\s+!', '',$payment['order_id']));
			$user_id = trim(preg_replace('!\s+!', '',$payment['user_id']));
			if(!empty($order_id) && !empty($user_id)) {
				$res = $this->home_db->runSql('select o.user_id, p.order_id,p.razor_oid,p.amount,date_format(p.added_datetime,"%d-%m-%Y") as paydate,p.pay_id as payid,p.signature,p.pstatus as paystatus from orders o inner join payment_log p on p.oid=o.id where o.user_id='.$user_id.' and p.oid='.$order_id.' and p.status=1');
				$paymentapi = TEST_MERCHANT_KEY;
				if(count($res)) {
					$result = array('status'=>'success','payment_data'=>$res,'api'=>$paymentapi);
				}else {
					$result = array('status'=>'failure','msg'=>'No results found');
				}
			}
			echo json_encode($result);
		}
		public function pincode() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$pincode = file_get_contents('php://input');
			$pin = json_decode($pincode, true);
			$pincode = trim(preg_replace('!\s+!', '',$pin['pincode']));
			if(!empty($pincode)) {
				$res = $this->home_db->getRecords('pincodes',['pincode'=>$pincode]);
				$settings = $this->home_db->runSql('select delivery_charges from settings');
				if(count($res)) {
					$result = ['status'=>'success','pincode_avail'=>['msg'=>'Shipping available to this pincode','amount'=>$settings[0]->delivery_charges]];
				}else {
					$result = ['status'=>'success','msg'=>'No shipping for pincode '.$pincode.' '];
				}
			}
			echo json_encode($result);
		}
		public function specialOffers() {
				$specialOffers = $this->home_db->runSql('select c.name as cname,p.name as title,p.ptitle as ptitle,p.page_url,p.id,pp.pcode,pp.pid,pp.id as ppid,pi.image_path,pi.thumb,pp.sellingprice,pp.mrp,pp.stock,s.id as sid,s.name as sname from products p left join category c on p.cat_id = c.id left join productpackage pp on pp.pid=p.id left join product_images pi on pi.pid = pp.id left join sizes s on s.id = pp.psize where p.status =0 and pp.bundle_products=1 group by pp.pid order by pp.id desc limit 4');
				//echo "<pre>";print_r($categ);exit;
				if(count($specialOffers)){
					
					foreach ($specialOffers as $key => $value) {
						$page_url = $value->page_url;
						$value->image_path = base_url($value->image_path);			
						$value->thumb = base_url($value->thumb);			
					}
			$result = array('status'=>'success','specialoffers_data'=>$specialOffers);
				}else {
				$result = array('status'=>'failure','msg'=>'No data found');

				}
        echo json_encode($result);
		}
		public function latestOffers() {
				$latestProducts = $this->home_db->runSql('select c.name as cname,p.name as title,p.ptitle as ptitle,p.ptitle,p.id,p.page_url,pp.pcode,pp.pid,pp.id as ppid,pi.image_path,pi.thumb,pp.sellingprice,pp.mrp,pp.stock,s.id as sid,s.name as sname from products p left join category c on p.cat_id = c.id left join productpackage pp on pp.pid=p.id left join product_images pi on pi.pid = pp.id left join sizes s on s.id = pp.psize where p.status =0 and pp.home_page=1 group by pp.pid order by pp.id desc limit 4');
				//echo "<pre>";print_r($categ);exit;
				if(count($latestProducts)){
					
					foreach ($latestProducts as $key => $value) {
						$page_url = $value->page_url;
						$value->image_path = base_url($value->image_path);			
						$value->thumb = base_url($value->thumb);			
					}
			$result = array('status'=>'success','latestProducts_data'=>$latestProducts);
				}else {
				$result = array('status'=>'failure','msg'=>'No data found');
				}
        	echo json_encode($result);
		}
		public function bundleProcucts() {
				$bundleProcucts = $this->home_db->runSql('select c.name as cname,c.page_url as cpage_url,p.id as pid,p.name as pname,p.tax,p.pcode,p.page_url as ppage_url,ps.mrp,ps.selling_price,ps.id as psid,s.id as sid,ps.stock,s.name as sname,pi.image_path,pi.thumb from products p inner join product_sizes ps on p.id=ps.pid inner join product_images pi on p.id=pi.pid inner join sizes s on s.id =ps.size_id inner join category c on c.id =p.cat_id where p.status !=2 and p.home_page =1 order by p.id desc limit 4');
				//echo "<pre>";print_r($categ);exit;
				if(count($bundleProcucts)){
					foreach ($bundleProcucts as $key => $value) {
						$page_url = $value->page_url;
						$value->image_path = base_url($value->image_path);			
					}
			$result = array('status'=>'success','bundleproducts_data'=>$bundleProcucts);
				}else {
				$result = array('status'=>'failure','msg'=>'No data found');
				}
        	echo json_encode($result);
		}
		public function couponList() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$coupon = file_get_contents('php://input');
			$couponList = json_decode($coupon, true);
			$couponcode = trim(preg_replace('!\s+!', '',$couponList['couponcode']));
			if(!empty($couponcode)) {
				$list = $this->home_db->checkcoupon($couponcode);
				if(!empty($list) && $list !=0) {
					$result = ['status'=>'success','couponList'=>$list];
				}else {
					$result = ['status'=>'failure','msg'=>'Coupon code is invalid'];
				}
			}
			echo json_encode($result);
		}
		public function confirmOrders() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$confirm = file_get_contents('php://input');
			$confirmOrders = json_decode($confirm, true);
			$user_id = trim(preg_replace('!\s+!', '',$confirmOrders['user_id']));
			$bname = trim(preg_replace('!\s+!', '',$confirmOrders['bname']));
			$total_amt = trim(preg_replace('!\s+!', '',$confirmOrders['total_amt']));
			$state_id = trim(preg_replace('!\s+!', '',$confirmOrders['state_id']));
			$city_id = trim(preg_replace('!\s+!', '',$confirmOrders['city_id']));
			$saved_amt = trim(preg_replace('!\s+!', '',$confirmOrders['saved_amt']));
			$stown = trim(preg_replace('!\s+!', '',$confirmOrders['stown']));
			$sstate = trim(preg_replace('!\s+!', '',$confirmOrders['sstate']));
			$bstate = trim(preg_replace('!\s+!', '',$confirmOrders['bstate']));
			$btown = trim(preg_replace('!\s+!', '',$confirmOrders['btown']));
			$bzip = trim(preg_replace('!\s+!', '',$confirmOrders['bzip']));
			$szip = trim(preg_replace('!\s+!', '',$confirmOrders['szip']));
			$landmark = trim(preg_replace('!\s+!', '',$confirmOrders['landmark']));
			$saved_amt = trim(preg_replace('!\s+!', '',$confirmOrders['saved_amt']));
			$baddress1 = trim(preg_replace('!\s+!', '',$confirmOrders['baddress1']));
			$baddress2 = trim(preg_replace('!\s+!', '',$confirmOrders['baddress2']));
			$saddress1 = trim(preg_replace('!\s+!', '',$confirmOrders['saddress1']));
			$saddress2 = trim(preg_replace('!\s+!', '',$confirmOrders['saddress2']));
			$bemail = trim(preg_replace('!\s+!', '',$confirmOrders['bemail']));
			$sphone = trim(preg_replace('!\s+!', '',$confirmOrders['sphone']));
			$bphone = trim(preg_replace('!\s+!', '',$confirmOrders['bphone']));
			$delivery_charges = trim(preg_replace('!\s+!', '',$confirmOrders['delivery_charge']));
			$payment_type = trim(preg_replace('!\s+!', '',$confirmOrders['payment_type']));
			$coupon_code = trim(preg_replace('!\s+!', '',$confirmOrders['coupon_code']));
			$coupon_percentage = trim(preg_replace('!\s+!', '',$confirmOrders['coupon_percentage']));
			$coupon_amount = trim(preg_replace('!\s+!', '',$confirmOrders['coupon_amount']));
			$total_gst_amount = trim(preg_replace('!\s+!', '',$confirmOrders['total_gst_amount']));
			$sub_total_amt = trim(preg_replace('!\s+!', '',$confirmOrders['sub_total_amt']));
			$sname = trim(preg_replace('!\s+!', '',$confirmOrders['sname']));
			$product =$confirmOrders['products'];
			//echo "<pre>";print_r($confirmOrders);exit;
			// $paymentapi = MERCHANT_KEY;
			if(!empty($user_id) && !empty($state_id) && !empty($city_id) && !empty($bzip) && !empty($baddress1) && !empty($baddress2)  && !empty($sphone) && !empty($bphone) && !empty($payment_type) && !empty($szip)  &&  !empty($total_amt) && !empty($saddress1) && !empty($saddress2) && !empty($sname) && !empty($bemail) && !empty($bname) && is_array($product)) {
				$user_exists = $this->home_db->getRecords('users',['id'=>$user_id],'*');
				if(count($user_exists)) {
						if($payment_type =="razor") {
										$txnnum_temp=substr(hash('sha256', mt_rand() . microtime()), 0, 20);
					$qnt = [];
					foreach ($product as  $qty) {
							$qnt[] =$qty['quantity'];
					}
					$settings = $this->home_db->runSql('select * from settings');
					$material = $this->home_db->runSql('select * from materials order by id asc limit 1');
					$orders['txnid'] = $txnnum_temp;
					$orders['user_id'] = $user_id;
					$orders['user_name'] = $bname;
					$orders['emailid'] = $bemail;
					$orders['tot_qty'] = array_sum($qnt);
					$orders['total_amt'] = $total_amt;
					$subtotal ="";
					if(!empty($sub_total_amt)) {
						$subtotal .= $sub_total_amt;
					}
					$orders['total_amt'] = $subtotal;
					$coupon_codes="";$coupon_amounts="";$coupon_discounts = "";$saved_amts = "";$dc = "";$tax = "";$ctype="";
					if(!empty($coupon_code)) {
						$coupon_codes .= $coupon_code;
					}
					$orders['coupon_code'] = $coupon_codes;
					if(!empty($coupon_amount)) {
						$coupon_amounts .= $coupon_amount;
					}
					$orders['discount'] = $coupon_amounts;
					if(!empty($saved_amt)) {
						$saved_amts .= $saved_amt;
					}
					$orders['saved_amt'] = $saved_amts;
					if(!empty($delivery_charges)) {
						$dc .= $delivery_charges;
					}
					$orders['devilery_charge'] = $dc;
					$orders['total_amt_paid'] = $total_amt;
					$orders['delivery_days'] = $settings[0]->delivery_days;
					$orders['ordered_date'] = date('Y-m-d H:i:s');
					$orders['delivery_date'] = date('Y-m-d',strtotime(+ $settings[0]->delivery_days ."days"));
					$orders['status'] = 2;
					$orders['paymode'] = "Online";
					if(!empty($total_gst_amount)) {
						$tax .=$total_gst_amount;
					}
					$orders['taxamount'] = $tax;
					$orders['pincode'] = $szip;
					$orders['randid'] =rand(12345677,99999999);
					if(!empty($coupon_percentage)) {
						$coupon_discounts .= $coupon_percentage;
					}
					$orders['discount_per'] =$coupon_discounts;
					$oid = $this->master_db->insertRecord('orders',$orders);
					if($oid) {                    
	                    $orderNo = $this->cart_db->generateOrderNo($oid);
	                    $db = array('orderid' => $orderNo);
	                    $this->home_db->updateRecord('orders',$db,'id',$oid);
                	}
                	$getOrderIdview = $this->home_db->getRecords('orders',['id'=>$oid],'orderid');
                	$db=array(
								'oid'=>$oid,
								'bname'=>$bname,
								'bemail'=>$bemail,
    							'baddr1'=>$baddress1,
    							'baddr2'=>$baddress2,
    							'bcity'=>$btown,
    							'bcity_id'=>$city_id,
    							'bstate'=>$bstate,
    							'bcountry'=>'India',
    							'bpincode'=>$bzip,
    							'bphone'=>$bphone,
    							'sname'=>$sname,
    							'saddr1'=>$saddress1,
    							'saddr2'=>$saddress2,
								'scity'=>$btown,
								'scity_id'=>$city_id,
								'sstate'=>$sstate,
								'scountry'=>'India',
								'spincode'=>$szip,
								'sphone'=>$sphone,
								'landmark'=>$landmark
    					);
                	$obs = $this->master_db->insertRecord('orders_bill_ship',$db);
                	if(is_array($product)) {
                		foreach ($product as $products) {
                			$op['oid'] = $oid; 
                			$op['pname'] = $products['pname'];
                			$op['pcode'] = $products['pcode'];
                			$op['qty'] = $products['quantity'];
                			$op['unit_price'] = $products['unit_price'];
                			$op['price'] = $products['unit_price'];
                			$op['size_id'] = $products['sid'];
                			$op['size_name'] = $products['sname'];
                			$op['material'] = $material[0]->name;
                			$op['image_path'] = $products['image_path'];
                			$op['status'] = 0;
                			$opdd = $this->master_db->insertRecord('orders_products',$op);
                		}
                	}
                	$razor_amt = (float)$total_amt*100;
                	$currency ="INR";
                	$api = new Api(TEST_MERCHANT_KEY, TEST_MERCHANT_SECRET);
                	$order  = $api->order->create(array('receipt' =>rand(11111,99999), 'amount' => $razor_amt, 'currency' => $currency));
                	$orderId = $order['id'];
                		$dbp = array(
						'order_id'=>rand(1111111,9999999),
						'razor_oid'=>$orderId,
						'amount'=>$total_amt,
						'pay_array'=>json_encode($orders),
						'added_datetime'=>date('Y-m-d H:i:s'),
						'status'=>-1,
						'oid'=>$oid
					);
					$payid = $this->master_db->insertRecord('payment_log',$dbp);
					$getrecords =$this->home_db->runSql('select * from orders o left join payment_log p on p.oid =o.id where o.id ='.$oid.'');
					$paid_amount['paid_amount'] = $getrecords[0]->total_amt_paid;
					$paid_amount['payment_type'] = "Online";
					$paid_amount['order_id'] = $getrecords[0]->orderid;
					$paid_amount['razor_merchantkey'] = TEST_MERCHANT_KEY;
					$paid_amount['razor_saltkey'] = TEST_MERCHANT_SECRET;
					$paid_amount['razor_orderid'] = $orderId;
					$paid_amount['currency_type'] = 'INR';
					$paid_amount['razor_callback'] = base_url().'v1/razorpayResponse';

					$this->load->library('Mail');
                	$settings = $this->home_db->getcontent1('settings','','','','','');
                	$orders['orderid'] = $getOrderIdview[0]->orderid;
		            $this->data['order'] = $orders;
		            $order_products =$product;
		            $ordership = $db;
		            $this->data['order_products'] = $order_products;
		            $this->data['call'] = $settings[0]->phone;
		            $this->data['emlid'] ="info@gogarbha.com";
		            $this->data['order_bill'] = $ordership;
		            $social_links = $this->home_db->getRecords('social_links',['status'=>0],'*');
		            $this->data['social'] = $social_links;
		            $html = $this->load->view('order_success1',$this->data,true);
		            //echo $html;exit;
		            $this->mail->sendMail($bemail,$html,'Your Order Summary');
					$result = ['status'=>'success','payment_response'=>$paid_amount];
						}

				else if($payment_type =='cod') {
									$txnnum_temp=substr(hash('sha256', mt_rand() . microtime()), 0, 20);
					$qnt = [];
					foreach ($product as  $qty) {
							$qnt[] =$qty['quantity'];
					}
					$settings = $this->home_db->runSql('select * from settings');
					$material = $this->home_db->runSql('select * from materials order by id asc limit 1');
					$orders['txnid'] = $txnnum_temp;
					$orders['user_id'] = $user_id;
					$orders['user_name'] = $bname;
					$orders['emailid'] = $bemail;
					$orders['tot_qty'] = array_sum($qnt);
					$orders['total_amt'] = $total_amt;
					$subtotal ="";
					if(!empty($sub_total_amt)) {
						$subtotal .= $sub_total_amt;
					}
					$orders['total_amt'] = $subtotal;
					$coupon_codes="";$coupon_amounts="";$coupon_discounts = "";$saved_amts = "";$dc = "";$tax = "";$ctype="";
					if(!empty($coupon_code)) {
						$coupon_codes .= $coupon_code;
					}
					$orders['coupon_code'] = $coupon_codes;
					if(!empty($coupon_amount)) {
						$coupon_amounts .= $coupon_amount;
					}
					$orders['discount'] = $coupon_amounts;
					if(!empty($saved_amt)) {
						$saved_amts .= $saved_amt;
					}
					$orders['saved_amt'] = $saved_amts;
					if(!empty($delivery_charges)) {
						$dc .= $delivery_charges;
					}
					$orders['devilery_charge'] = $dc;
					$orders['total_amt_paid'] = $total_amt;
					$orders['delivery_days'] = $settings[0]->delivery_days;
					$orders['ordered_date'] = date('Y-m-d H:i:s');
					$orders['delivery_date'] = date('Y-m-d',strtotime(+ $settings[0]->delivery_days ."days"));
					$orders['status'] = 1;
					$orders['paymode'] = "cod";
					if(!empty($total_gst_amount)) {
						$tax .=$total_gst_amount;
					}
					$orders['taxamount'] = $tax;
					$orders['pincode'] = $szip;
					$orders['randid'] =rand(12345677,99999999);
					if(!empty($coupon_percentage)) {
						$coupon_discounts .= $coupon_percentage;
					}
					$orders['discount_per'] =$coupon_discounts;
					$oid = $this->master_db->insertRecord('orders',$orders);
					if($oid) {                    
	                    $orderNo = $this->cart_db->generateOrderNo($oid);
	                    $db = array('orderid' => $orderNo);
	                    $this->home_db->updateRecord('orders',$db,'id',$oid);
                	}
                	$getOrderIdview = $this->home_db->getRecords('orders',['id'=>$oid],'orderid');
                	$db=array(
								'oid'=>$oid,
								'bname'=>$bname,
								'bemail'=>$bemail,
    							'baddr1'=>$baddress1,
    							'baddr2'=>$baddress2,
    							'bcity'=>$btown,
    							'bcity_id'=>$city_id,
    							'bstate'=>$bstate,
    							'bcountry'=>'India',
    							'bpincode'=>$bzip,
    							'bphone'=>$bphone,
    							'sname'=>$sname,
    							'saddr1'=>$saddress1,
    							'saddr2'=>$saddress2,
								'scity'=>$btown,
								'scity_id'=>$city_id,
								'sstate'=>$sstate,
								'scountry'=>'India',
								'spincode'=>$szip,
								'sphone'=>$sphone,
								'landmark'=>$landmark
    					);
                	$obs = $this->master_db->insertRecord('orders_bill_ship',$db);
                	if(is_array($product)) {
                		foreach ($product as $products) {
                			$op['oid'] = $oid; 
                			$op['pname'] = $products['pname'];
                			$op['pcode'] = $products['pcode'];
                			$op['qty'] = $products['quantity'];
                			$op['unit_price'] = $products['unit_price'];
                			$op['price'] = $products['unit_price'];
                			$op['size_id'] = $products['sid'];
                			$op['size_name'] = $products['sname'];
                			$op['material'] = $material[0]->name;
                			$op['image_path'] = $products['image_path'];
                			$op['status'] = 0;
                			$opdd = $this->master_db->insertRecord('orders_products',$op);
                		}
                	}
                	$razor_amt = $total_amt*100;
                	$currency ="INR";
                	
                		$dbp = array(
						'order_id'=>rand(1111111,9999999),
						'amount'=>$total_amt,
						'added_datetime'=>date('Y-m-d H:i:s'),
						'status'=>-1,
						'oid'=>$oid
					);
					$payid = $this->master_db->insertRecord('payment_log',$dbp);
					$getrecords =$this->home_db->runSql('select * from orders o left join payment_log p on p.oid =o.id where o.id ='.$oid.'');
					$paid_amount['paid_amount'] = $getrecords[0]->total_amt_paid;
					$paid_amount['payment_mode'] = $getrecords[0]->paymode;
					$paid_amount['order_id'] = $getrecords[0]->orderid;
					$this->load->library('Mail');
                	$settings = $this->home_db->getcontent1('settings','','','','','');
                	$orders['orderid'] = $getOrderIdview[0]->orderid;
		            $this->data['order'] = $orders;
		            $order_products =$product;
		            $ordership = $db;
		            $this->data['order_products'] = $order_products;
		            $this->data['call'] = $settings[0]->phone;
		            $this->data['emlid'] ="info@gogarbha.com";
		            $this->data['order_bill'] = $ordership;
		            $social_links = $this->home_db->getRecords('social_links',['status'=>0],'*');
		            $this->data['social'] = $social_links;
		            $html = $this->load->view('order_success1',$this->data,true);
		            //echo $html;exit;
		            $this->mail->sendMail($bemail,$html,'Your Order Summary');
				
					$result = ['status'=>'success','payment_response'=>$paid_amount];
						}
				}else {
					$result = ['status'=>'failure','response'=>'Userid not exists'];
				}
			}
			echo json_encode($result);
		}
	public function razorpayResponse() {
			//error_reporting(1);ini_set('display_errors', TRUE);
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$response = file_get_contents('php://input');
			$razorresponse = json_decode($response, true);
			$user_id = trim(preg_replace('!\s+!', '',$razorresponse['user_id']));
			$paymentID = trim(preg_replace('!\s+!', '',$razorresponse['paymentID']));
			$orderID = trim(preg_replace('!\s+!', '',$razorresponse['orderID']));
			$signature = trim(preg_replace('!\s+!', '',$razorresponse['signature']));
			$oid = trim(preg_replace('!\s+!', '',$razorresponse['oid']));
			if(!empty($user_id) && !empty($paymentID) && !empty($orderID) && !empty($signature) && !empty($oid)) {
				//echo "<pre>";print_r($razorresponse);exit;
				$getRecords = $this->home_db->getRecords('orders',['orderid'=>$oid],'id');
				 $new = new Api(TEST_MERCHANT_KEY, TEST_MERCHANT_SECRET);
				 $payid =$new->payment->fetch($paymentID);
				 $generatedHash = hash_hmac('sha256',$orderID."|".$paymentID,TEST_MERCHANT_SECRET);
				 if($generatedHash ==$signature) {
				 		 $dbp = array(
                			'status' => 1,
                			'pstatus'=>"success"
                		);
				 	$this->home_db->updateRecord('orders',$dbp,'id',$getRecords[0]->id);
					 $payarr = array(
					 		"pstatus"=>'success',
					 		"pay_id"=>$paymentID,
					 		"signature"=>$signature,
					 );
					 $this->home_db->updateRecord('payment_log',$payarr,'oid',$getRecords[0]->id);
					 $result = ['status'=>'success','response'=>'success'];
				 }else{
				 	$dbp = array(
                			'status' => -1,
                			'pstatus'=>"failure"
                		);
				 	$this->home_db->updateRecord('orders',$dbp,'id',$getRecords[0]->id);
					 $payarr = array(
					 		"status"=>'-1',
					 );
					 $this->home_db->updateRecord('payment_log',$payarr,'oid',$getRecords[0]->id);
					 $result = ['status'=>'failure','response'=>'failure'];
				}
			}
			echo json_encode($result);
		}
		public function addWishlist() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$response = file_get_contents('php://input');
			$razorresponse = json_decode($response, true);
			$user_id = trim(preg_replace('!\s+!', '',$razorresponse['user_id']));
			$pid = trim(preg_replace('!\s+!', '',$razorresponse['pid']));
			$cpage_url = trim(preg_replace('!\s+!', '',$razorresponse['cpage_url']));
			if(!empty($user_id) && !empty($pid)) {
				$dbs=array(
	    				'cpage_url'=>$cpage_url,
	    				'pid'=>$pid,
	    				'user_id'=>$user_id,
	    				'created_date'=>date('Y-m-d H:i:s')
	    			);
				$num = $this->home_db->checkwishlistapi($dbs);
    			if($num == 0){
					$db=array(
	    				'categ'=>$cpage_url,
	    				'pid'=>$pid,
	    				'user_id'=>$user_id,
	    				'created_date'=>date('Y-m-d H:i:s')
	    			);
					//print_r($db);exit;
	    			$in = $this->home_db->add_wishlist($db);
		    		if($in) {
		    			$result = ['status'=>'success','wishlist_data'=>"Product added to wishlist"];
		    		}else {
		    			$result = ['status'=>'failure','wishlist_error'=>"Error in inserting data"];
		    		}
		    	}else {
		    		$result = ['status'=>'failure','wishlist_error'=>"Product already added to wishlist try another"];
		    	}
			}
			echo json_encode($result);
		}
			public function forgotPassword() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$forgot = file_get_contents('php://input');
			$for = json_decode($forgot, true);
			$email = trim(preg_replace('!\s+!', '',$for['email']));
			if(!empty($email)) {
					$newpasssend = rand();
    			$db=$email;
    			$db=array(
    					'email'=>$email,
    					'type'=>'general'
    			);
    			$vdata = $this->home_db->getloginval($db);
    			if(count($vadata) >0) {
    				$emailidcheck =$this->home_db->checkmail($db,$newpasssend);
    				$name=$vdata[0]->name;
	    			$this->data['name']=$name;
	    			$emailid=$email;
	    			$password=$newpasssend;
	    			$this->load->library('email');
	    			$config = array (
	    					'mailtype' => 'html',
	    					'charset'  => 'utf-8',
	    					'priority' => '1'
	    			);
	    			$this->email->initialize($config);
	    			$this->email->from('noreply@gogarbha.com', 'gogarbha');
	    			$this->email->to($emailid);
	    			$this->email->subject('Your dhrtva Account Password');
	    			$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title><?php echo title;?></title></head><body><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial, Helvetica, sans-serif; color:#595959; border:10px solid #e6e6e6"><tr><td style="padding:10px 30px 30px 30px"><table width="100%"><tr><td colspan="2"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-bottom:1px solid #e6e6e6"><tr><td style="padding:10px; width:115px; height:105px"><img src="<?php echo asset_url()?>images/logo.svg" /></td></tr></table></td></tr><tr><td colspan="2"><p> Dear <?php echo '.$name.'?>, </p><p> Your Dhrta Account Details are below:<br> <br>Your Username : <b><?php echo '.$emailid.';?></b><br>Your Password : <b><?php echo '.$password.';?></b><br><br></p><br /><p>To Login <a href="<?php echo base_url();?>">Click Here</a></p></td></tr></table></td></tr></table></body></html>';
	    			$this->email->message($body);
	    			//$this->email->message('Hi, <br><br>Your World of Labs Account Details are below: <br><br><strong>Username</strong> : '.$db.'<br><strong>Password</strong> : '.$newpasssend.' <br><br><a href="'.base_url().'home/register">Click Here</a> to Login.');
	    			$this->email->send();
	    			$result =  ['status'=>'success','forgot_data'=>"Email sent successfully"];
	    			}else {
	    				$result =  ['status'=>'failure','forgot_data'=>"Error in sending email"];
    				}
			}
			echo json_encode($result);
		}
		public function search() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$search = file_get_contents('php://input');
			$ser = json_decode($search, true);
			$search_term = trim(preg_replace('!\s+!', '',$ser['search_term']));
			if(!empty($search_term)) {
				$searchResults =$this->home_db->runSql('select c.name as cname,p.name as pname,p.subcat_id,p.page_url as ppage_url,p.home_page,p.bundle_product,p.special,p.exclusive,p.id as pid,p.page_url,p.ptitle,pp.pcode,pp.pid,pp.id as ppid,p.status,pi.image_path,pi.thumb,pp.sellingprice,pp.mrp,pp.stock,s.name as siname from products p left join category c on p.cat_id = c.id left join productpackage pp on pp.pid=p.id left join product_images pi on pi.pid = pp.id left join sizes s on s.id = pp.psize where p.name like "%'.$searchbar.'%" or p.ptitle like "%'.$search_term.'%" or c.name like "%'.$search_term.'%" group by pp.pid order by p.id desc');
				if(count($searchResults) >0) {
					  $result = ['status'=>'success','search_data'=>$searchResults];
				}else {
	    				$result =  ['status'=>'failure','search_data'=>"No results found"];
				}
			}
			echo json_encode($result);
		}
		public function packages() {
			$package =$this->home_db->runSql('select id,pname from packages order by id desc');
			if(count($package) >0) {
				$result = ['status'=>'success','package_data'=>$package];
			}else {
				$result = ['status'=>'failure','package_data'=>'No data found'];
			}
			echo json_encode($result);
		}
		public function categoryListView() {
			$categorywise = $this->home_db->getRecords('category',array('status'=>0),'id ,name,icons','order_no asc');
			$banner = $this->home_db->getRecords('banner',array('status'=>0),'id ,banner_image','id asc');
			foreach ($banner as $ba) {
				$ba->banner_image = base_url($ba->banner_image);
			}
			foreach ($categorywise as $key => $value) {
				$value->icons = base_url().$value->icons;
			}
			$special_offers = $this->home_db->sqlExecute('select c.name as cname,p.name as title,p.name as ptitle,p.page_url,p.pcode,p.id as pid,p.status,pi.image_path,pi.thumb,ps.selling_price,ps.mrp,ps.stock,s.name as sname,s.id as sid,p.tax from products p left join product_sizes ps on p.id=ps.pid left join product_images pi on p.id=pi.pid left join sizes s on s.id =ps.size_id left join category c on c.id =p.cat_id where p.status =0 and p.special=1 group by ps.pid order by p.id desc limit 4');
			foreach ($special_offers as $special) {
				$special->image_path = base_url($special->image_path);
				$special->thumb = base_url($special->thumb);
			}
			$ar = [];
		
				 	 $newproducts = $this->home_db->sqlExecute('select c.name as cname,p.name as title,p.name as ptitle,p.page_url,p.pcode,p.id as pid,p.status,pi.image_path,pi.thumb,ps.selling_price,ps.mrp,ps.stock,s.name as sname,s.id as sid,p.tax from products p left join product_sizes ps on p.id=ps.pid left join product_images pi on p.id=pi.pid left join sizes s on s.id =ps.size_id left join category c on c.id =p.cat_id where p.status =0 and p.home_page=1 and p.home_page=1  group by ps.pid order by p.id desc ');
				 	 //echo $this->db->last_query();
				 	$subnew = [];
				 	 foreach ($newproducts as  $pro) {
				 	 	$subnew[]= $pro;
				 	 	$pro->image_path = base_url($pro->image_path);
				 	 	$pro->thumb = base_url($pro->thumb);
				 	 	
				 	 }
				 	
			
			echo json_encode(['status'=>'success','sliders'=>$banner,'sort_by_category'=>$categorywise,'product_list'=>$newproducts]);
		}
		public function categorywise_list() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$forgot = file_get_contents('php://input');
			$for = json_decode($forgot, true);
			$category = trim(preg_replace('!\s+!', '',@$for['cat_id']));
			if(!empty(!empty($category))) {
				 $newproducts = $this->home_db->sqlExecute('select c.name as cname,p.name as title,p.name as ptitle,p.page_url,p.pcode,p.id as pid,p.status,pi.image_path,pi.thumb,ps.selling_price,ps.mrp,ps.stock,s.name as sname,s.id as sid,p.tax from products p left join product_sizes ps on p.id=ps.pid left join product_images pi on p.id=pi.pid left join sizes s on s.id =ps.size_id left join category c on c.id =p.cat_id where p.status =0 and p.cat_id ='.$category.'  group by ps.pid order by p.id desc');
				 	 //echo $this->db->last_query();
				 	 foreach ($newproducts as  $pro) {
				 	 	$pro->image_path = base_url($pro->image_path);
				 	 	$pro->thumb = base_url($pro->thumb);
				 	 	
				 	 }
				 	 $result = ['status'=>'success','products'=>$newproducts];
			}
			echo json_encode($result);
		}
		public function upanayanaFormView() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			if(!empty($_POST['name']) && !empty($_POST['fname']) && !empty($_POST['phone']) && !empty($_POST['address']) && !empty($_POST['dob']) && !empty($_POST['rashi']) && !empty($_POST['nakshatra']) && !empty($_POST['gotra']) && !empty($_FILES['image']['name'])) {
				//echo print_r($_FILES);exit;
				$name = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('name', true))));
				$fname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('fname', true))));
				$phone = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('phone', true))));
				$address = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('address', true))));
				$dob = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('dob', true))));
				$rashi = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('rashi', true))));
				$nakshatra = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('nakshatra', true))));
				$comments = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('comments', true))));
				$register_no = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('register_no', true))));

				$gotra = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('gotra', true))));
				$db['name'] = $name;
				$db['fname'] = $fname;
				$db['mphone'] = $phone;
				$db['address'] = $address;
				$db['dob'] = $dob;
				$db['rashi'] = $rashi;
				$db['nakshatra'] = $nakshatra;
				$db['gotra'] = $gotra;
				if(!empty($_FILES['image']['name'])){
                    $config2 = array();
                    $config2['upload_path'] = 'assets/images/';  
                    $config2['allowed_types'] = 'jpeg|jpg|png';
                    $ext = pathinfo($_FILES["image"]['name'], PATHINFO_EXTENSION);
                    $new_name = "smt".rand(11111,99999).'.'.$ext; 
                    $config2['file_name'] = $new_name;
                   $this->load->library('upload', $config2);
                    // Alternately you can set
                    $this->upload->initialize($config2);
                    if (!$this->upload->do_upload('image')) {
                        $error = array('status'=>'failure','msg' => "<div class='alert alert-danger'>".$this->upload->display_errors()."</div>");
                       // echo json_encode($error);exit;
                    } else {
                        $upload_data = $this->upload->data();
                        $db['image'] = 'assets/images/'.$upload_data['file_name'];
                        //print_r($upload_data);exit;
                    }
                }
                $db['comments'] = $comments;
                $db['created_date'] = date('Y-m-d H:i:s');
                $insert = $this->home_db->insertRecord('upanayana',$db);
		 		if($insert) {
		 			$newid = "SSM/00".$insert."/".date('Y')."-".date("y",strtotime('1 Year'));
		 			$this->home_db->updateRecord('upanayana',['registerno'=>$newid],'id',$insert);
		 			$userdata = ['user_id'=>$insert,'register_id'=>$newid];
		 			$result = array('status'=>'success','data'=>$userdata);
		 		}else {
		 			$result = array('status'=>'failure','msg'=>'Error in Inserting Data');
		 		}
			}
			echo json_encode($result);
		}
		public function fetchUpanayana() {
			$data = $this->home_db->runSql('select DATE_FORMAT(created_date,"%d-%m-%Y %h:%i") as created_date,name,fname as fathers_name,mphone,address,rashi,nakshatra,gotra,image from upanayana order by id desc');
			if(count($data) >0) {
				foreach ($data as $key => $value) {
					$value->image = base_url($value->image);
				}
				$result = ['status'=>'success','data'=>$data];
			}else {
				$result = ['status'=>'failure','msg'=>'No data found'];
			}
			echo json_encode($result);
		}
		public function categoryWise() {
		
				$product_list = file_get_contents('php://input');
				$pro = json_decode($product_list, true);
				$cat_id = @trim(preg_replace('!\s+!', '',$pro['cat_id']));
				$subcat_id = @trim(preg_replace('!\s+!', '',$pro['subcat_id']));
				$price = @$pro['price'];
				$dimension = @$pro['dimension'];
				$sort = @trim(preg_replace('!\s+!', '',$pro['sort']));
				$where = "";
				if(!empty($cat_id)) {
				$order_by ="";
				if(!empty($subcat_id) && $subcat_id!='') {
					$where .= " and p.subcat_id=".$subcat_id."  ";
				}
				if(!empty($dimension) && is_array($dimension)) {
					$ar =[];
					foreach ($dimension as $key => $value) {
						$ar[]= $value['dimension'];
					}
					$implode = implode("', '", $ar);
					$where .=" and s.name in ('$implode')";
				}
				if(!empty($price) && is_array($price)) {
					$ar =[];
					foreach ($price as $key => $value) {
						//$ar[] = $value['price'];
						$temp = explode("-", $value['price']);
						//echo $value['price'];print_r($temp);
						if(count($temp) ==2) {
							$tmp = array();
							$tmp['from'] = $temp[0];
							$tmp['to'] = $temp[1];
							$where .=" and ps.selling_price between ".$tmp['from']." and ".$tmp['to']."";
						}else {
							$temp =explode("+", $value['price']);
							$tmp['from'] = $temp[0];
							$where .=" and ps.selling_price >= ".$tmp['from']."";
						}
					}
				}
				if($sort ==1) {
					$order_by .="ps.selling_price asc";
				}else if($sort ==2) {
					$order_by .="ps.selling_price desc";
				}
				else if($sort ==3) {
					$order_by .="p.name asc";
				}
				else if($sort ==4) {
					$order_by .="p.name desc";
				}else {
					$order_by .="p.id desc";
				}
				$categ = $this->home_db->runSql('select page_url from category where status =0');
					$sql = "select c.name as cname,c.page_url as cpage_url,p.id,p.page_url as ppage_url,s.name as sname,s.page_url as spage_url,p.name as title,p.pcode,p.youtube,p.overview,p.status,p.cat_id,p.subcat_id,pi.image_path,pi.thumb,ps.mrp,ps.selling_price,ps.stock,ps.id as psid,s.id as sid,s.name as sname,ps.minimum_buy,s.page_url as spage_url,ps.sel_dollar,ps.b2b_selling_price,ps.b2b_sel_dollar,p.how_to_use,p.youtube from products p left join product_images pi on p.id=pi.pid left join product_sizes ps on p.id=ps.pid left join sizes s on ps.size_id=s.id left join category c on p.cat_id=c.id where p.cat_id =".$cat_id." and p.status !=2 ".$where." group by ps.pid order by ".$order_by." ";
							$query = $this->db->query($sql);
							//echo $this->db->last_query();exit;
							$res= $query->result();
							foreach ($res as $data) {
								$data->image_path = base_url($data->image_path);
							}
							if(count($res)) {
								$result = array('status'=>'success','product_data'=>$res);
							}else {
								$result = array('status'=>'success','msg'=>'No data found');
							}
				}
				
        		echo json_encode($result);
		}
		public function schools() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$search = file_get_contents('php://input');
			$ser = json_decode($search, true);
			$student_name = trim(preg_replace('!\s+!', '',@$ser['student_name']));
			$pname = trim(preg_replace('!\s+!', '',@$ser['pname']));
			$mobile = trim(preg_replace('!\s+!', '',@$ser['mobile']));
			$branch = trim(preg_replace('!\s+!', '',@$ser['branch']));
			$class = trim(preg_replace('!\s+!', '',@$ser['section']));
			$grade = trim(preg_replace('!\s+!', '',@$ser['grade']));
			$email = trim(preg_replace('!\s+!', '',@$ser['email']));
			$notification = trim(preg_replace('!\s+!', '',$ser['notification']));
			if(!empty($student_name) && !empty($pname) && !empty($mobile) && !empty($branch) && !empty($class) && !empty($grade) && !empty($notification) && !empty($email)) {
				$db['sname'] = $student_name;
				$db['pname'] = $pname;
				$db['mobile'] = $mobile;
				$db['email'] = $email;
				$db['branch'] = $branch;
				$db['section'] = $class;
				$db['grade'] = $grade;
				$db['notification'] = $notification;
				$db['created_at'] = date('Y-m-d H:i:s');
				$insert = $this->home_db->insertRecord('schools',$db);
				if($insert >0) {
					$result = ['status'=>true,'msg'=>'Student saved successfully'];
				}else {
					$result = ['status'=>false,'msg'=>'Error in saving record'];
				}
			}
			echo json_encode($result);
		}
		public function diet() {
			$getDiet = $this->master_db->getRecords('diet',['status'=>0],'did as id,title,pdf_link','did desc');
			if(count($getDiet) >0) {
				foreach ($getDiet as $key => $value) {
					if(!empty($value->pdf_link)) {
						$value->pdf_link = base_url().$value->pdf_link;
					}
				}
				$result = ['status'=>'success','data'=>$getDiet];
			}else {
				$result = ['status'=>'failure','data'=>[]];
			}
			echo json_encode($result);
		}
		public function treatmentprotocol() {
			$getTreatment = $this->master_db->getRecords('treatment_protocol',['status'=>0],'id,title,thumbnail_image as image, pdf','id desc');
			if(count($getTreatment) >0) {
				foreach ($getTreatment as $key => $value) {
					if(!empty($value->pdf)) {
						$value->pdf = base_url().$value->pdf;
					}
					if(!empty($value->image)) {
						$value->image = base_url().$value->image;
					}
				}
				$result = ['status'=>'success','data'=>$getTreatment];
			}else {
				$result = ['status'=>'failure','data'=>[]];
			}
			echo json_encode($result);
		}
		public function dietdetials() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$search = file_get_contents('php://input');
			$ser = json_decode($search, true);
			$diet_id = trim(preg_replace('!\s+!', '',@$ser['diet_id']));
			if(!empty($diet_id)) {
				$getDiet = $this->master_db->getRecords('diet',['did'=>$diet_id,'status'=>0],'*');
				if(count($getDiet) >0) {
					$getDetails = $this->master_db->getRecords('diet',['did'=>$diet_id],'did as id,title,pdf_link','did desc');
					foreach ($getDetails as $key => $value) {
						if(!empty($value->pdf_link)) {
							$value->pdf_link = base_url().$value->pdf_link;
						}else {
							$value->pdf_link = "";
						}
					}
					if(count($getDetails) >0) {
						$result = ['status'=>'success','data'=>$getDetails];
					}else {
						$result = ['status'=>'failure','msg'=>'No details found'];
					}
				}else {
					$result = ['status'=>'failure','msg'=>'Diet id not found'];
				}
			}
			echo json_encode($result);
		}
		public function diy() {
			$getDiet = $this->master_db->getRecords('diy',['status'=>0],'diy_id as id,title','diy_id asc');
			if(count($getDiet) >0) {
				$result = ['status'=>'success','data'=>$getDiet];
			}else {
				$result = ['status'=>'failure','data'=>[]];
			}
			echo json_encode($result);
		}
		public function diydetails() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$search = file_get_contents('php://input');
			$ser = json_decode($search, true);
			$diet_id = trim(preg_replace('!\s+!', '',@$ser['diy_id']));
			if(!empty($diet_id)) {
				$getDiet = $this->master_db->getRecords('diy',['diy_id'=>$diet_id,'status'=>0],'*');
				if(count($getDiet) >0) {
					$getDetails = $this->master_db->getRecords('diy',['diy_id'=>$diet_id],'diy_id as id,title,ldesc as description','diy_id  desc');
					if(count($getDetails) >0) {
						$result = ['status'=>'success','data'=>$getDetails];
					}else {
						$result = ['status'=>'failure','msg'=>'No details found'];
					}
				}else {
					$result = ['status'=>'failure','msg'=>'Diet id not found'];
				}
			}
			echo json_encode($result);
		}
		public function articles() {
			$articles = $this->master_db->getRecords('articles',['status'=>0],'art_id as id,title,image','art_id desc');
			if(count($articles) >0) {
				foreach ($articles as $key => $value) {
					if(!empty($value->image)) {
						$value->image = base_url().$value->image;
					}else {
						$value->image = "";
					}
				}
				$result = ['status'=>'success','data'=>$articles];
			}else {
				$result = ['status'=>'failure','data'=>[]];
			}
			echo json_encode($result);
		}
		public function herbal() {
			$herbal = $this->master_db->getRecords('herbal',['status'=>0],'hid as id,title,pdf_link','hid desc');
			if(count($herbal) >0) {
				foreach ($herbal as $key => $value) {
					if(!empty($value->pdf_link)) {
						$value->pdf_link = base_url().$value->pdf_link;
					}else {
						$value->pdf_link = "";
					}
				}
				$result = ['status'=>'success','data'=>$herbal];
			}else {
				$result = ['status'=>'failure','data'=>[]];
			}
			echo json_encode($result);
		}
		public function research() {
			$research = $this->master_db->getRecords('research',['status'=>0],'rid as id,title,pdf_link','rid desc');
			if(count($research) >0) {
				foreach ($research as $key => $value) {
					if(!empty($value->pdf_link)) {
						$value->pdf_link = base_url().$value->pdf_link;
					}else {
						$value->pdf_link = "";
					}
				}
				$result = ['status'=>'success','data'=>$research];
			}else {
				$result = ['status'=>'failure','data'=>[]];
			}
			echo json_encode($result);
		}
		public function awards() {
			$awards = $this->master_db->getRecords('awards',['status'=>0],'aid as id,title,image','aid desc');
			if(count($awards) >0) {
				foreach ($awards as $key => $value) {
					if(!empty($value->image)) {
						$value->image = base_url().$value->image;
					}else {
						$value->image = "";
					}
				}
				$result = ['status'=>'success','data'=>$awards];
			}else {
				$result = ['status'=>'failure','data'=>[]];
			}
			echo json_encode($result);
		}
		public function gallery() {
			$gallery = $this->master_db->getRecords('gallery',['status'=>0],'gal_id as id,title,image','gal_id desc');
			if(count($gallery) >0) {
				foreach ($gallery as $key => $value) {
					if(!empty($value->image)) {
						$value->image = base_url().$value->image;
					}else {
						$value->image = "";
					}
				}
				$result = ['status'=>'success','data'=>$gallery];
			}else {
				$result = ['status'=>'failure','data'=>[]];
			}
			echo json_encode($result);
		}
		public function treatment() {
			$treatment = $this->master_db->getRecords('treatment',['status'=>0],'tid as id,title,image as banner','tid asc');
			if(count($treatment) >0) {
				foreach ($treatment as $key => $value) {
					if(!empty($value->link)) {
						$value->link = $value->link;
					}else {
						$value->link = "";
					}
					if(!empty($value->banner)) {
						$value->banner = base_url().$value->banner;
					}else {
						$value->banner = "";
					}
				}
				$result = ['status'=>'success','data'=>$treatment];
			}else {
				$result = ['status'=>'failure','data'=>[]];
			}
			echo json_encode($result);
		}
		public function treatmentdetails() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$search = file_get_contents('php://input');
			$ser = json_decode($search, true);
			$diet_id = trim(preg_replace('!\s+!', '',@$ser['treatment_id']));
			if(!empty($diet_id)) {
				$getDiet = $this->master_db->getRecords('treatment',['tid'=>$diet_id,'status'=>0],'tid as id,title');
				if(count($getDiet) >0) {
					$getDiet[0]->link = base_url().'treatment/listtreatment/'.$diet_id;
					$result = ['status'=>'success','data'=>$getDiet];
				}else {
					$result = ['status'=>'failure','msg'=>'Treatment id not found'];
				}
			}
			echo json_encode($result);
		}
		public function videos() {
			$videos = $this->master_db->getRecords('videos',['status'=>0],'vid as id,title,video_id','vid desc');
			if(count($videos) >0) {
				$result = ['status'=>'success','data'=>$videos];
			}else {
				$result = ['status'=>'failure','data'=>[]];
			}
			echo json_encode($result);
		}
		public function blogs() {
			$blogs = $this->master_db->getRecords('blogs',['status'=>0],'bid as id,title,image,sdesc as short_desc','bid desc');
			if(count($blogs) >0) {
				foreach ($blogs as $key => $value) {
					if(!empty($value->image)) {
						$value->image = base_url().$value->image;
					}else {
						$value->image = "";
					}
				}
				$result = ['status'=>'success','data'=>$blogs];
			}else {
				$result = ['status'=>'failure','data'=>[]];
			}
			echo json_encode($result);
		}
		public function blogsdetails() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$search = file_get_contents('php://input');
			$ser = json_decode($search, true);
			$blog_id = trim(preg_replace('!\s+!', '',@$ser['blog_id']));
			if(!empty($blog_id)) {
				$getBlog = $this->master_db->getRecords('blogs',['bid'=>$blog_id,'status'=>0],'bid as id,title,sdesc as short_desc,ldesc as long_desc,image');
				if(count($getBlog) >0) {
					foreach ($getBlog as $key => $value) {
						if(!empty($value->image)) {
							$value->image = base_url().$value->image;
						}else {
							$value->image ="";
						}
					}
					$result = ['status'=>'success','data'=>$getBlog];
				}else {
					$result = ['status'=>'failure','msg'=>'Blog id not exists try another'];
				}
			}	
			echo json_encode($result);
		}
		public function notification() {
			$notification = $this->master_db->getRecords('notification',['status'=>0],'nid as id,msg,created_at as posted_date','nid desc');
			if(count($notification) >0) {
				foreach ($notification as $key => $value) {
					$value->posted_date = date('d-m-Y h:i A');
				}
				$result = ['status'=>'success','data'=>$notification];
			}else {
				$result = ['status'=>'failure','data'=>[]];
			}
			echo json_encode($result);
		}
		public function feedback() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$search = file_get_contents('php://input');
			$ser = json_decode($search, true);
			$user_id = trim(preg_replace('!\s+!', '',@$ser['user_id']));
			$star = trim(preg_replace('!\s+!', '',@$ser['star']));
			$feedback = trim(preg_replace('!\s+!', ' ',@$ser['feedback']));
			if(!empty($user_id) && !empty($star) && !empty($feedback)) {
				$getUsers = $this->master_db->getRecords('users',['id'=>$user_id,'status'=>0],'*');
				if(count($getUsers) >0) {
					$db['user_id'] = $user_id;
					$db['star'] = $star;
					$db['feedback'] = $feedback;
					$db['created_at'] = date('Y-m-d H:i:s');
					$in = $this->master_db->insertRecord('feedback',$db);
					if($in >0) {
						$result = ['status'=>'success','msg'=>'Successfully'];
					}
					else {
						$result = ['status'=>'failure','msg'=>'Error'];
					}
				}else {
					$result = ['status'=>'failure','msg'=>'User id not found'];
				}
			}
			echo json_encode($result);
		}
		public function tests() {
			$tests = $this->master_db->getRecords('tests',['status'=>0],'tid as id,title','tid desc');
			if(count($tests) >0) {
				$result = ['status'=>'success','data'=>$tests];
			}else {
				$result = ['status'=>'failure','data'=>[]];
			}
			echo json_encode($result);
		}
		public function support() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$search = file_get_contents('php://input');
			$ser = json_decode($search, true);
			$user_id = trim(preg_replace('!\s+!', '',@$ser['user_id']));
			$msg = trim(preg_replace('!\s+!', ' ',@$ser['msg']));
			if(!empty($user_id) && !empty($msg)) {
				$getUsers = $this->master_db->getRecords('users',['id'=>$user_id,'status'=>0],'*');
				if(count($getUsers) >0) {
					$db['user_id'] = $user_id;
					$db['msg'] = $msg;
					$db['created_at'] = date('Y-m-d H:i:s');
					$in = $this->master_db->insertRecord('support',$db);
					if($in >0) {
						$result = ['status'=>'success','msg'=>'Inserted successfully'];
					}else {
						$result = ['status'=>'failure','msg'=>'Not inserted'];
					}
				}else {
					$result = ['status'=>'failure','msg'=>'User id not found'];
				}
			}
			echo json_encode($result);
		}
		public function supportlist() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$search = file_get_contents('php://input');
			$ser = json_decode($search, true);
			$user_id = trim(preg_replace('!\s+!', '',@$ser['user_id']));
			if(!empty($user_id) >0) {
				$getUsers = $this->master_db->getRecords('users',['id'=>$user_id,'status'=>0],'*');
				if(count($getUsers) >0) {
					$getPost = $this->master_db->getRecords('support',['user_id'=>$user_id],'sid as id,msg as message,user_id,created_at as posted_date','sid desc');
					if(count($getPost) >0) {
						foreach ($getPost as $key => $value) {
							$value->posted_date = date('d-m-Y h:i A',strtotime($value->posted_date));
						}
						$result = ['status'=>'success','data'=>$getPost];
					}else {
						$result = ['status'=>'failure','msg'=>'No data found'];
					}
				}else {
					$result = ['status'=>'failure','msg'=>'User id not found'];
				}
			}
			echo json_encode($result);
		}
		public function appointment() {
			
		}
		public function userdisease() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$search = file_get_contents('php://input');
			$ser = json_decode($search, true);
			$user_id = trim(preg_replace('!\s+!', '',@$ser['user_id']));
			//echo "<pre>";print_r($ser);exit;
			if(!empty($user_id) >0) {
				$getUsers = $this->master_db->getRecords('doctorpanel',['user_id'=>$user_id],'*');
				if(count($getUsers) >0) {
					$getData = $this->home_db->sqlExecute('select d.id,d.title from doctorpanel do left join disease d on d.id = do.disease_id where do.user_id='.$user_id.'');
					if(count($getData) >0) {
						$result = ['status'=>true,'data'=>$getData];
					}else {
						$result = ['status'=>false,'data'=>[]];
					}
				}else {
					$result = ['status'=>'failure','msg'=>'User id not found'];
				}
			}
			echo json_encode($result);
		}
		public function symptomsmarker() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$sym = file_get_contents('php://input');
			$mark = json_decode($sym, true);
			$user_id = trim(preg_replace('!\s+!', '',@$mark['user_id']));
			$disease_id = trim(preg_replace('!\s+!', '',@$mark['disease_id']));
			$visit_no = trim(preg_replace('!\s+!', '',@$mark['visit_no']));
			if(!empty($user_id) && !empty($disease_id) && !empty($visit_no)) {
				$getUsers = $this->master_db->getRecords('doctorpanel',['user_id'=>$user_id,'status'=>0],'*');
				if(count($getUsers) >0) {
					$getData = $this->home_db->sqlExecute('select id,problems as problem_initiated_since,DATE_FORMAT(vdate, "%D %M %Y") as visit_date from  doctor_visits where user_id='.$user_id.' and did ='.$disease_id.' and visits in ('.$visit_no.')');
					if(count($getData) >0) {
						foreach ($getData as $key => $data) {
							$id = $data->id;
							$getSymptoms = $this->home_db->sqlExecute('select s.id as symptom_id,s.title as symptom from doctor_symptoms ds left join symptoms s on s.id = ds.sid where ds.vid='.$id.'');
							$getBloodparams = $this->home_db->sqlExecute('select ub.id,ub.tid as test_id,t.title as test_name from user_blood_parameters_count ub left join tests t on t.tid = ub.tid where ub.vid='.$id.'');
							//echo $this->db->last_query();exit;
							if(count($getBloodparams) >0) {
								foreach ($getBloodparams as $key => $value) {
									$tid = $value->id;
									$getBlood = $this->home_db->sqlExecute('select bp.id as params_id,bp.title as test_name,ub.title as unit,ub.nvalue as value from user_blood_parameters ub left join blood_parameters_details bp on bp.id = ub.tid where ub.pid='.$tid.' and ub.nvalue !=""');
									$value->parameters = $getBlood;
								}
							}
							$data->symptoms = $getSymptoms;
							$data->bloodparameters = $getBloodparams;
						}
						$result = ['status'=>true,'data'=>$getData];
					}else {
						$result = ['status'=>false,'data'=>[]];
					}
					// echo $this->db->last_query();exit;
				}else {
					$result = ['status'=>'failure','msg'=>'User id not found'];
				}
			}
			echo json_encode($result);
		}
		public function comparisonreport() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$sym = file_get_contents('php://input');
			$marks = json_decode($sym, true);
			$user_id = trim(preg_replace('!\s+!', '',@$marks['user_id']));
			$disease_id = trim(preg_replace('!\s+!', '',@$marks['disease_id']));
			if(!empty($user_id) && !empty($disease_id)) {
				$getUsers = $this->master_db->getRecords('doctorpanel',['user_id'=>$user_id,'status'=>0],'*');
				if(count($getUsers) >0) {
					$getData = $this->home_db->sqlExecute('select id,visits as visit_no from  doctor_visits where user_id='.$user_id.' and did ='.$disease_id.'');
					//echo $this->db->last_query();
					if(count($getData) >0) {
						foreach ($getData as $key => $data) {
							$id = $data->id;
							$getBloodparams = $this->home_db->sqlExecute('select ub.id,ub.tid as test_id,t.title as test_name from user_blood_parameters_count ub left join tests t on t.tid = ub.tid where ub.vid='.$id.'');
							if(count($getBloodparams) >0) {
								foreach ($getBloodparams as $key => $value) {
									$tid = $value->id;
									$getBlood = $this->home_db->sqlExecute('select bp.id as params_id,bp.title as test_name,ub.title as unit,ub.nvalue as value from user_blood_parameters ub left join blood_parameters_details bp on bp.id = ub.tid where ub.pid='.$tid.' and ub.nvalue !=""');
									$value->parameters = $getBlood;
								}
							}
							$data->bloodparameters = $getBloodparams;
						}
						//exit;
						$result = ['status'=>true,'data'=>$getData];
					}else {
						$result = ['status'=>false,'data'=>[]];
					}
				}else {
					$result = ['status'=>'failure','msg'=>'User id not found'];
				}
			}
			echo json_encode($result);
		}
		public function getSms($rand,$mobile,$uname) {
		   	  $ar = array('listsms'=>array(array('sms'=>'Dear '.$uname.' Your OTP for login is '.$rand.' Regards, Team Miracle Drinks.','mobiles'=>$mobile,'senderid'=>'MIRCOL','clientSMSID'=>'1947692308','accountusagetypeid'=>'1','entityid'=>'1701159256675943303', 'tempid'=>'1707167592051531633')),'password'=>'63d06f365dXX','user'=>'Miracolo');
		   	  $var = json_encode($ar);
		   	  $url = "http://mobicomm.dove-sms.com//REST/sendsms";
		   	  $ch_session = curl_init();
		      curl_setopt($ch_session, CURLOPT_RETURNTRANSFER, 1);
		      curl_setopt($ch_session, CURLOPT_POST, 1);
		      curl_setopt($ch_session, CURLOPT_POSTFIELDS, $var);
		      curl_setopt($ch_session, CURLOPT_HTTPHEADER, array(
		      'Content-Type: application/json'
		      ));
		      curl_setopt($ch_session, CURLOPT_URL, $url);
		      $result_url = curl_exec($ch_session);
		      if( $fp=fopen('smsmessagesResponse.txt','a+') ){	
                    fwrite($fp, $result_url . "\t" . date ("l dS of F Y h:i:s A")."\n".$result_url."\n" );
                    fclose($fp);
                }
   		}
	}
?>