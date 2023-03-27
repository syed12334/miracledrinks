<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search_db extends CI_Model{
	
	
	/* function getallProductssql($categ, $condition){
    	 $sql = "select t.* from (SELECT * FROM frontview_".$categ."_product 
		    	where 1 $condition order by CAST(selling_price AS DECIMAL) asc ) t 
		    	group by t.pid order by CAST(selling_price AS DECIMAL) asc"; 
		
    	return $sql;
		
	} */
	
	function getallProductssql($categ=array(), $condition){
		$sql = '';
		if(is_array($categ)){
    		$tabarr = array();
    		
    		foreach ($categ as $c){
    			$sql = "select t.* from (SELECT * FROM frontview_".$c."_product 
		    	where 1 $condition order by CAST(selling_price AS DECIMAL) asc ) t 
		    	group by t.pid "; 
    			
    			$tabarr[] = $sql;
    		}
    		$sql = implode(" union ", $tabarr);
    		$sql = $sql." order by CAST(selling_price AS DECIMAL) asc";
    	}
    	
    	return $sql;
		
	}
	
	function getsuggestions($categ,$condition){
		$data='';
		$labels = array();$dataFilter='';$done=0;$i=0;

		if(is_array($categ)){
			$tabarr = array();
		
			foreach ($categ as $c){
				$sql = "select pid,pname,ppage_url,selling_price from (SELECT pid,pname,ppage_url,selling_price FROM frontview_".$c."_product
				where 1 $condition order by CAST(selling_price AS DECIMAL) asc ) t
				group by t.pid ";
				 
				$tabarr[] = $sql;
			}
			$sql = implode(" union ", $tabarr);
			$sql = $sql." order by CAST(selling_price AS DECIMAL) asc";
			
			$q = $this->db->query($sql);
			$rows=$q->result();
			$catg_id='';
			if($q->num_rows()){
				$done =1;
			
				foreach($rows as $row){
					$name = $row->pname;
					$labels[$i] = array(
							'value' => $name,
							'id' => $row->ppage_url
					);
					$i = $i+1;
				}
			
			
			}
    	}
			
		/* $sql = "(select name,page_url,type,p.id,s.cas as casno from chem_product as p,chem_product_spec as s where p.id=s.pid and s.status=0 and p.status=0 and adm_status=0 and (trim(REPLACE(REPLACE(REPLACE(name,' ',' %'),'% ',''),'%','')) like '%".trim(preg_replace('!\s+!', ' ',$query))."%' or trim(REPLACE(REPLACE(REPLACE(s.cas,' ',' %'),'% ',''),'%','')) like '%".trim(preg_replace('!\s+!', ' ',$query))."%') group by p.id)
					union (select name,page_url,type,p.id,s.cas as casno from equip_product as p,equip_product_spec as s  where p.id=s.pid and  s.status=0 and p.status=0 and adm_status=0 and (trim(REPLACE(REPLACE(REPLACE(name,' ',' %'),'% ',''),'%','')) like '%".trim(preg_replace('!\s+!', ' ',$query))."%' or trim(REPLACE(REPLACE(REPLACE(s.cas,' ',' %'),'% ',''),'%','')) like '%".trim(preg_replace('!\s+!', ' ',$query))."%') group by p.id) limit 0,10"; */
			
		
	
		if($done!=1){
	
			$labels[$i] = array(
					'value' => "No Results Found !!!",
					'id' => 0
			);
			return json_encode($labels);
		}
		else{
				
			foreach($labels as $k => $v)
			{
				foreach($labels as $key => $value)
				{
					if($k != $key && $v['value'] == $value['value'])
					{
						unset($labels[$k]);
					}
				}
			}
				
			return json_encode($labels);
		}
	
	}
	
	
	
        
}
?>