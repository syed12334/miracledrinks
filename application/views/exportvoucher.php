<?php 

error_reporting(E_ALL);

header("Expires: 0");

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

header("Cache-Control: no-store, no-cache, must-revalidate");

header("Cache-Control: post-check=0, pre-check=0", false);

header("Pragma: no-cache");

header("Content-type: application/vnd.ms-excel;charset:UTF-8");

header("Content-Disposition: attachment; filename=voucher.xls");
?>

<html>
<head>
 <style> .phone{ mso-number-format:\@; } </style>
  </head>
  <body>  
      <table border="1">
      <tr>
      <th>Sl No</th>
      <th>Voucher Type</th>
      <th>Voucher Title</th>
      <th>From Date</th>
      <th>To Date</th>
      <th>Voucher Code</th>
      <th>Discount(%)</th>
      <th>No. of times Used</th>
      <th>Status</th>   
      </tr>
      <?php
      $i=0;
     
      if(count($details)>0 && is_array($details)){
		$status = array("Active","In-Active");
		$type = array("Single Usage","Multiple Usage");
      foreach($details as $d){ $i++;
		
	  	 ?>
	  	 <tr>
		      <td><?php echo $i;?></td>
		      <td><?php echo $type[$d->type]; ?></td>
		      <td><?php echo $d->title; ?></td>
		      <td><?php echo $d->from_date; ?></td>
		      <td><?php echo $d->to_date; ?></td>
		      <td><?php echo $d->code; ?></td>
		      <td><?php echo $d->discount; ?></td>
		      <td><?php echo $d->used_count; ?></td>
		      <td><?php if($d->vstatus == "1"){echo "In-Active";}else{echo $status[$d->cstatus];} ?></td>
	     </tr>
	  	 <?php 
	  	 
	  }
	  }
	  else{
		?>
		<tr>
		      <td colspan="8">No Voucher Found!!!</td>
		      
	     </tr>
		<?php 
		}
      ?>
      </table>
     </body>
     </html>
