<?php 

error_reporting(E_ALL);

header("Expires: 0");

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

header("Cache-Control: no-store, no-cache, must-revalidate");

header("Cache-Control: post-check=0, pre-check=0", false);

header("Pragma: no-cache");

header("Content-type: application/vnd.ms-excel;charset:UTF-8");

header("Content-Disposition: attachment; filename=freebies_comments.xls");
?>

<html>
<head>
 <style> .phone{ mso-number-format:\@; } </style>
  </head>
  <body>  
      <table border="1">
      <tr>
      <th>Sl No</th>
      <th>Freebies Title</th>
      <th>Comment By</th>
      <th>Email ID</th>
      <th>Comment</th>
      <th>Posted date</th>
      <th>Status</th>   
      </tr>
      <?php
      $i=0;
     
      if(count($export)>0 && is_array($export)){
      foreach($export as $exp){$i++;
		$status = array("Approved","Rejected","Pending","New");
		
	  	 ?>
	  	 <tr>
		      <td><?php echo $i;?></td>
		      <td><?php echo $exp->title; ?></td>
		      <td><?php echo $exp->name; ?></td>
		      <td><?php echo $exp->email; ?></td>
		      <td><?php echo $exp->comment; ?></td>
		      <td><?php echo date_format(date_create($exp->created_date), 'd-m-Y g:i A'); ?></td>
		      <td><?php echo $status[$exp->status]; ?></td>
	     </tr>
	  	 <?php 
	  	 
	  }
	  }
	  else{
		?>
		<tr>
		      <td colspan="7">No Comments</td>
		      
	     </tr>
		<?php 
		}
      ?>
      </table>
     </body>
     </html>
