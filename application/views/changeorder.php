<?php 
		/* error_reporting(0); */
		//echo "<pre>";print_r($orders);print_r($status);exit;
		$data = '';
		//echo "<pre>";print_r($orders);exit;
		$row=$orders;	
		if(count($orders)) {
			$data.='<div class="card">';
		$data.='<div class="cart-tabs lastUnit">';
		$data.='<div id="cart-tab" class="tab selected" style="width: 100%;">Change Status for Order ID - '.$orders[0]->orderid.' ';
		$data.='<div id="close-b"><span onClick="closethisanddintRedirect();" style="float:right;"></span></div></div>';
		$data.='</div>';
		
		$data.='<div class="card-body">';
		$data.='<div class="table-responsive">';
		$data.='<table class="table" style="border: none;">';
		
		$data.='<tbody>';
		//not a failed order			
			$shipdate = $deliverdate = "";
			if($orders[0]->shipping_date != '0000-00-00' && $orders[0]->shipping_date != '1970-01-01' && intval($orders[0]->status) <= 4){
				$date=date_create($orders[0]->shipping_date);
				$shipdate = date_format($date,"d-m-Y");
			}
			else{
				$date=date_create(date('Y-m-d H:i:s'));
				$shipdate = date_format($date,"d-m-Y");
			}
			
			if($orders[0]->delivered_date != '0000-00-00' && $orders[0]->delivered_date != '1970-01-01'){
				$date=date_create($orders[0]->delivered_date);
				$deliverdate = date_format($date,"d-m-Y");
			}
			
			
			$data.='<tr>';
			$data.='<th style="width:213px;" class="sfromdate">Shipped Date</th>';
			$data.='<td><input type="text" name="sfromdate" value="'.$shipdate.'" id="sfromdate"  class="form-control datepicker" style="width:50%;"></td>';
			$data.='</tr>';
			
			$data.='<tr>';
			$data.='<th style="width:213px;" class="stodate">Delivered Date</th>';
			$data.='<td><input type="text" name="stodate"  id="stodate" value="'.$deliverdate.'" class="form-control datepicker" style="width:50%;"></td>';
			$data.=' </tr>';
		
		
		$id = $orders[0]->id;
		
		$data.='<tr>';
		$data.='<th style="width:213px;">&nbsp;</th>';
		$data.='<td><button onclick="submitstatus('.$status.','.$id.');" type="button" class="btn btn-info"> Update status with dates</button> &nbsp; <button onclick="submitstatus(0,'.$id.');" type="button" class="btn btn-primary"> Update dates only</button>
				<div id="gmsgbox"></div></td>';
		$data.='</tr>';
		
		
		 
		
		$data.='</tbody>';
		$data.='</table>';
		
		$data.='</div>';
		$data.='</div>';
		$data.='</form>';
		
		echo $data;
	}else {
		echo "No data found";
	}
		
		
		?>