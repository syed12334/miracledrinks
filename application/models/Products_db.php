<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class products_db extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	var $rangeChart=array();
	var $chart=array();
	var $removedProd=array();
	
	function getallProductssql($categ, $condition,$sort='',$user_type){
		
		if($sort =='' && $user_type ==1)
		{
		  $sort = ' order by CAST(selling_price AS DECIMAL) asc';
		}
		else if($sort =='' && $user_type ==2)
		{
			$sort = "order by CAST(b2b_selling_price AS DECIMAL) asc";
		}
		else if($sort == '')
		{
			$sort = ' order by CAST(selling_price AS DECIMAL) asc';
		}
		
        $order_by = "order by CAST(selling_price AS DECIMAL) asc";
		if($user_type == 2)
		{
			$order_by = "order by CAST(b2b_selling_price AS DECIMAL) asc";
		}
		
		//echo $sort;
    	 $sql = "select t.* from (SELECT * FROM frontview_".$categ."_product 
		    	where 1 $condition $order_by ) t 
		    	group by t.pid  $sort"; 
		
		/* $sql = "select t.* from frontview_".$categ."_product t 
		where 1 $condition 
		group by t.pid order by CAST(selling_price AS DECIMAL) asc"; */
    	return $sql;
		
		
    	
		
	}
	
	function getproductdetails($table,$url){
		$sql = "select t.* from $table t where ppage_url like '$url'  order by CAST(selling_price AS DECIMAL) asc";
		$q=$this->db->query($sql);
		if($q->num_rows()>0)		
			return $q->result();		
		else		
			return 0;
	}
	
	function getvasedetails($pid){
		$sql = "select ppage_url,pname,selling_price,pid,psid,image_path from frontview_planters_product t  where pid in ($pid) order by CAST(selling_price AS DECIMAL) asc";
		$q=$this->db->query($sql);
		if($q->num_rows()>0)
			return $q->result();
		else
			return 0;
	}
	
	function getsimilarproducts($categ, $pid, $mid){
		//$sql = "select ppage_url,pname,selling_price,pid,psid,image_path from frontview_".$categ."_product  where pid!='$pid' and mid='$mid' order by CAST(selling_price AS DECIMAL) asc";
		$sql="SELECT ppage_url,pname,mrp,pid,psid,image_path,cpage_url,stock,selling_price,sel_dollar,b2b_selling_price,b2b_sel_dollar
		FROM (SELECT ppage_url,pname,mrp,pid,psid,image_path,cpage_url,stock,selling_price,sel_dollar,b2b_selling_price,b2b_sel_dollar
		FROM frontview_".$categ."_product
		where pid!='$pid' and mid='$mid' order by CAST(selling_price AS DECIMAL) asc ) t
		group by t.pid order by CAST(selling_price AS DECIMAL) asc ";
		$q=$this->db->query($sql);
		if($q->num_rows()>0)
			return $q->result();
		else
			return 0;
	}
	
	
	function price_rangeArrays($categ){
		$prices=Array();	
		$sql="SELECT selling_price FROM frontview_".$categ."_product where 1 group by selling_price order by CAST(selling_price AS DECIMAL) ";
		/* $sql="SELECT distinct(selling_price),t.pid FROM (SELECT selling_price,pid FROM frontview_".$categ."_product
				where 1  order by CAST(selling_price AS DECIMAL) asc ) t 
				group by t.pid order by CAST(selling_price AS DECIMAL) asc "; */
			
		$q=$this->db->query($sql);
		$res=$q->result();
		foreach($res as $price){
		$prices[]=$price->selling_price;
		}
		return $prices;
	}
	
	
	function calculateRange($prices){
		global $highestPrice,$maxPRoductInRange ,$rangeChart,$minimumPrice, $chart;
		
		// round the highest price
		$lastElement=end($prices);
		$highestPrice=round($lastElement, -2);
		$minimumPrice=$prices[0];
		 
		$var = $minimumPrice;
		$minimumPrice = ceil((int) ($var/100)) * 100;
		//ceil($input / 10) * 10;
		
		$maxPRoductInRange=10;		 
		 
		// range list initialize
		$this->makeRangeChart($minimumPrice,$highestPrice,$rangeChart);	
	
		$count=count($rangeChart);
	
		for($a=0;$a<$count;$a++){
			if(isset($rangeChart[$a+1])){
				$min=ceil((int) ($rangeChart[$a]/100)) * 100;
				$max=ceil((int) ($rangeChart[$a+1]/100)) * 100;;
				$result=$this->productCount($min,$max,$prices,0);
				if($result>$maxPRoductInRange){
					//create bigger range chart
					$this->makeRangeChart($min,$max,$rangeChart);
					$this->calculateRange($prices);
				}	
			}
		}
	}
	
	function productCount($minVal,$maxVal,$prices,$check){
		global $chart,$removedProd;
		$icount=0;
		if($maxVal == 0){
			$maxVal=max($prices);
			$range = range($minVal, $maxVal);
		}
		else{
			$range = range($minVal, $maxVal);
		}
			
		$resultprod = array_intersect($prices, $range);
		$icount = count($resultprod);
		$chart[$minVal]=$icount;
		return $icount;
			
	}
	
	
	function makeRangeChart($min=0,$max,&$rangeChart){
		$middleOfRange=($max+$min)/2;
		$rangeChart[]=$min;
		$rangeChart[]=$middleOfRange;
		$rangeChart[]=$max;
		$rangeChart=array_unique ($rangeChart);
		//var_dump($rangeChart);
		sort($rangeChart, SORT_NUMERIC );
	}
	
	function printChart($pricerang,$prarray){
		global $chart,$highestPrice;$line='';
		//var_dump($chart);
		if(is_array($chart) && count($chart) > 1){
			$minPrices=array_keys($chart);
			$count=count($minPrices);
			 
			for($a=0;$a<$count;$a++){
				$minpr=$minPrices[$a];
				if($a != 0){
					$minpr=$minpr+1;
				}
	
				$maxpr=(isset($minPrices[$a+1]))?$minPrices[$a+1]:'0';
				$text='';
				//$minpr = ceil($input / 10) * 10;
				$text.='<i class="icon_rs_gray"></i>'.$minpr;
				$text.=(isset($minPrices[$a+1]))?' - '.$minPrices[$a+1]:'+';
				$values=$minpr.'-'.$maxpr;
				$sele="";
				if(is_array($pricerang) && in_array($values, $pricerang)){
					$sele="checked";
				}
	
				$line.='<li class="filtercheckbox"><input type="checkbox" name="pricerang[]" id="'.$minpr.'-'.$maxpr.'" value="'.$minpr.'-'.$maxpr.'" '.$sele.'><label for="'.$minpr.'-'.$maxpr.'">'.$text.'</label></li>';
	
			}
		}
		return $line;
	}
	
	function checkcateg_exists($page_url){
		
		$sql = "select c.page_url from category c, products p where p.page_url like '$page_url'  and c.id=p.cat_id and c.status IN(0,2) and p.status=0";
		$q = $this->db->query($sql);
		if($q->num_rows()>0)
		{
			$res = $q->result();
			return $res[0]->page_url;
		}
		else
		{
			return '';
		}
	}
	
	function getratings($id){
		$sql = "select avg(rating) as avgrat from reviews where pid=".$id." and status=0 group by pid";
		$q = $this->db->query($sql);
		if($q->num_rows()>0)
		{
			$res = $q->result();
			return $res[0]->avgrat;
		}
		else
		{
			return '0';
		}
	}
	
	function getrating_count($id,$rate){
		$sql = "select count(id) avgrat from reviews where psid='$id' and rating='$rate' and status=0 group by psid";
		$q = $this->db->query($sql);
		if($q->num_rows()>0)
		{
			$res = $q->result();
			return $res[0]->avgrat;
		}
		else
		{
			return '0';
		}
	}
	
        
}
?>