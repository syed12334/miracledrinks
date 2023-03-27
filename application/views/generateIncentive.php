<?php 

        $price_icon =  ($orders[0]->currency_type == 2) ? '&#36;' : '&#x20b9;';
		/* error_reporting(0); */
		$data = '';
		$row=$orders;	
		$data.='<div class="card">';
		$data.='<div class="cart-tabs lastUnit">';
		$data.='<div id="cart-tab" class="tab selected" style="width: 100%;">Incentive Invoice ';
		$data.='<div id="close-b"><span onClick="closethisanddintRedirect();" style="float:right;"></span></div></div>';
		$data.='</div>';
		
		$data.='<div class="panel panel-body" style="overflow-y:scroll;height:400px;width: 600px;">';
		$data.='<div class="table-responsive">';
		$data.='<table class="table" style="border: none;">';
		
		$data.='<tbody>';
		if($row[0]->status != "-1"){//build
			
			$date=date_create($row[0]->ordered_date);
			$today = date_format($date,"d-m-Y H:i a");
			
			$data.='<tr>';
			$data.='<th style="width:213px;">Order No.</th>';
			$data.='<td>'.$row[0]->orderid.'</td>';
			$data.='</tr>';
			
			$data.='<tr>';
			$data.='<th style="width:213px;">Ordered Date</th>';
			$data.='<td>'.$today.'</td>';
			$data.='</tr>';
			
			$data.='<tr>';
			$data.='<th style="width:213px;">Order By</th>';
			$data.='<td>'.$users[0]->name.'<br>'.$users[0]->emailid.'<br>'.$users[0]->phone.'</td>';
			$data.='</tr>';
			
			$data.='<tr>';
			$data.='<th style="width:213px;">Order Amount</th>';
			$data.='<td>'.$price_icon.' '.$this->orders_db->getnumberformat($row[0]->total_amt_paid).'</td>';
			$data.='</tr>';
			
			$date=date_create(date('Y-m-d H:i:s'));
			$today = date_format($date,"d-m-Y");
			
			$data.='<tr>';
			$data.='<th style="width:213px;">Invoice Date</th>';
			$data.='<td><input type="text" name="invoice_date" value='.$today.' id="invoice_date"  class="form-control datepicker" readonly style="width:50%;"></td>';
			$data.='</tr>';
		}
		
		$id = $row[0]->id;
		
		$data.='<tr>';
		$data.='<th style="width:213px;">&nbsp;</th>';
		$data.='<td><button onclick="submit_incentive('.$id.');" type="button" class="btn btn-primary btn-xs"> Generate Incentive</button>
				<div id="gmsgbox"></div></td>';
		$data.='</tr>';				 
		 
		
		$data.='</tbody>';
		$data.='</table>';
		
		$data.='</div>';
		$data.='</div>';
		$data.='</form>';
		
		echo $data;
		
		?>