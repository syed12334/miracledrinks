<?php 

error_reporting(E_ALL);

header("Expires: 0");

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

header("Cache-Control: no-store, no-cache, must-revalidate");

header("Cache-Control: post-check=0, pre-check=0", false);

header("Pragma: no-cache");

header("Content-type: application/vnd.ms-excel;charset:UTF-8");

header("Content-Disposition: attachment; filename=registered_buyers.xls");
?>

<html>
<head>
 <style> .phone{ mso-number-format:\@; } </style>
  </head>
  <body>  
      <table border="1">
      <tr>
      <th>Sl No</th>
      <th>Name</th>
      <th>Email ID</th>
      <th>Contact No.</th>

      <th>Address 1</th>
          <th>Address 2</th>
      <th>Town</th>
      <th>Zip</th>
      <th>State</th>
      <th>Country</th>
      <th>Registered Date</th>  
      </tr>
      <?php
      $i=0;
      
      if(count($sellers)>0 && is_array($sellers)){
      foreach($sellers as $sell){$i++;
	  	 ?>
	  	 <tr>
		      <td><?php echo $i;?></td>
		      <td><?php echo $sell->name?></td>
		      <td><?php echo $sell->emailid; ?></td>
		      <td class="phone"><?php echo $sell->phone; ?></td>

		      <td><?php echo $sell->address1; ?></td>
             <td><?php echo $sell->address1; ?></td>
		      <td><?php echo $sell->town_name; ?></td>
		      <td><?php echo $sell->zip; ?></td>
		      <td><?php echo $sell->state_name; ?></td>
		      <td><?php echo $sell->country; ?></td>
		      <td><?php echo $sell->credate; ?></td>
	     </tr>
	  	 <?php 
	  	 
	  }
	  }
	  else{
		?>
		<tr>
		      <td colspan="10">No records found !!!</td>
		      
	     </tr>
		<?php 
		}
      ?>
      </table>
     </body>
     </html>
