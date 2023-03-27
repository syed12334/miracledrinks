<?php 
		/* error_reporting(0); */
		$data="";
		
		$row=$details;
		$data.='<div class="card">';
		$data.='<div class="cart-tabs lastUnit">';
		$data.='<div id="cart-tab" class="tab selected" style="width: 100%;">';
		$data.='<div id="close-b"><span onClick="closethisanddintRedirect();" style="float:right;"></span></div></div>';
		$data.='</div>';
		
		
		$data.='<div class="card-body">';
		$data.='<div class="table-responsive">';
		$data.='<table class="table" style="border: none;">';
		
		$data.='<tbody>';
		$data.='<tr>';
		$data.='<th style="width:213px;">Name</th>';
		$data.='<td>'.$row[0]->name.'</td>';
		$data.='</tr>';
		
		$data.='<tr>';
		$data.='<th style="width:213px;">Email ID</th>';
		$data.='<td>'.$row[0]->emailid.'</td>';
		$data.=' </tr>';
		
		$data.='<tr>';
		$data.='<th style="width:213px;">Contact No.</th>';
		$data.='<td>'.$row[0]->phone.'</td>';
		$data.=' </tr>';
		

		
		$data.='<tr>';
		$data.='<th style="width:213px;">Address 1</th>';
		$data.='<td>'.$row[0]->address1.'</td>';
		$data.=' </tr>';

		$data.='<tr>';
		$data.='<th style="width:213px;">Address 2</th>';
		$data.='<td>'.$row[0]->address2.'</td>';
		$data.=' </tr>';
		
		$data.='<tr>';
		$data.='<th style="width:213px;">Town</th>';
		$data.='<td>'.$row[0]->town_name.'</td>';
		$data.=' </tr>';
		
		$data.='<tr>';
		$data.='<th style="width:213px;">Zip</th>';
		$data.='<td>'.$row[0]->zip.'</td>';
		$data.=' </tr>';
		
		$data.='<tr>';
		$data.='<th style="width:213px;">State</th>';
		$data.='<td>'.$row[0]->state_name.'</td>';
		$data.=' </tr>';
		
		$data.='<tr>';
		$data.='<th style="width:213px;">Country</th>';
		$data.='<td>'.$row[0]->country.'</td>';
		$data.=' </tr>';
				
		$data.='<tr>';
		$data.='<th style="width:213px;">Registered Date & Time</th>';
		$data.=' <td>'.$row[0]->credate.'</td>';
		$data.='</tr>';
		
		$data.='</tbody>';
		$data.='</table>';
		
		$data.='</div>';
		$data.='</div>';
		$data.='</form>';
		
		echo $data;
		
		?>