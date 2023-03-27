<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cart_db extends CI_Model{
	
		
	function checkcoupon($coupon){
		$sql = "select code,type,used_count,discount from vouchers as v,voucher_code c where code='$coupon' and from_date<='".date('Y-m-d')."' and to_date>='".date('Y-m-d')."' and v.status=0 and c.status=0 and cid=id";
		$q=$this->db->query($sql);
		if($q->num_rows()>0)
			return $q->result();
		else
			return 0;
	}
	
	function getstatedata($city){
		$sql = "select c.name cname, s.name sname from cities c, states s where c.id='$city' and c.state_id=s.id and c.status=0 and s.status=0";
		$q=$this->db->query($sql);
		if($q->num_rows()>0)
			return $q->result();
		else
			return 0;
	}
	
	function generateOrderNo($oid){
		$sql = "SELECT CONCAT(  'MDS', INSERT( LPAD( id, 5,  '0' ) , 0, 3,  'MDS' ) ) AS OrderNo FROM orders WHERE id=$oid";
		$q=$this->db->query($sql);
		if($q->num_rows()>0){
			$res = $q->result();
			return $res[0]->OrderNo;
		}
		else
			return 'GGARBHA000001';
	}
	
	function updateStock($pid, $stock){
		$sql = "update product_sizes set stock = stock-$stock where id=$pid";
		$this->db->query($sql);
	}
	
}
?>