<?php 

error_reporting(E_ALL);

header("Expires: 0");

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

header("Cache-Control: no-store, no-cache, must-revalidate");

header("Cache-Control: post-check=0, pre-check=0", false);

header("Pragma: no-cache");

header("Content-type: application/vnd.ms-excel;charset:UTF-8");

header("Content-Disposition: attachment; filename=user_reviews.xls");
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
		  <th>Email</th>
      <th>Category</th>
      <th>Product Name</th>


      <th>Posted By</th>
      <th>Review</th>
      <th>Rating</th>
      <th>Posted date</th>
      <th>Status</th>   
      </tr>
      <?php
      $i=0;
     
      if(count($sellers)>0 && is_array($sellers)){
      foreach($sellers as $sell){$i++;
		$status = array("Approved","Rejected","Pending","New");

	  	 ?>
	  	 <tr>
		      <td><?php echo $i;?></td>
		      <td><?php echo $sell->name; ?></td>
			 <td><?php echo $sell->email; ?></td>
		      <td><?php echo $sell->cname; ?></td>
		      <td><?php echo $sell->pname; ?></td>

		      <td><?php echo $sell->name; ?></td>

		      <td class="phone"><?php echo $sell->review_descp; ?></td>
		      <td class="phone"><?php echo $sell->rating; ?></td>
		      <td><?php echo $sell->created_date; ?></td>
		      <td><?php echo $status[$sell->status]; ?></td>
	     </tr>
	  	 <?php 
	  	 
	  }
	  }
	  else{
		?>
		<tr>
		      <td colspan="13">No Reviews</td>
		      
	     </tr>
		<?php 
		}
      ?>
      </table>
     </body>
     </html>
