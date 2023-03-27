<!DOCTYPE html>
<html lang="en">

<head>
  <style>

    .hear{
      background-color: #431861;
      color:#fff;
    }
    /*   
.order_details {
    background-color: #fff;
    border: 1px solid #e1e1e1;
    float: left;
    height: 230px;
    padding: 15px 22px;
    width: 45%;
}
.shipping_details {
    background-color: #fff;
    border: 1px solid #e1e1e1;
    float: left;
    height: 230px;
    margin-left: 8px;
    padding: 15px 22px;
    width: 500px;
}

.det {
    font-size: 14px;
    line-height: 20px;
}
.products_detail table {
    width: 100%;
}
body {
    color: #444444;
    font-family: Arial,Helvetica,sans-serif;
}
.track_container {
    background-color: #f4f4f4;
    box-shadow: none;
}
.container {
    background-color: #ffffff;
    box-shadow: 0 6px 7px 1px #ccc;
    float: left;
    min-height: 500px;
    padding: 0px 12px 25px;
    width: 1018px;
}
.products_detail {
    background-color: #fff;
    border: 1px solid #e1e1e1;
    float: left;
    margin-top: 8px;
    width: 957px;
}
.h {
    color: #5c5c5c;
    font-size: 16px;
    font-weight: bold;
}


.det {
    font-size: 14px;
    line-height: 20px;
}
.products_detail td {
    border-bottom: 1px solid #e6e6e6;
    padding: 13px 20px;
} */
  </style>

  <style>
    .item {
      font-size: 11px;
    }

    .heading_blue {
      font-size: 13px;
      font-weight: bold;
    }

    .savings {
      color: green;
      font-size: 11px;
    }
  </style>
  <?php echo $updatelogin; ?>
</head>

<body>
  <div class="card">
    <div class="card-body">


      <div class="bk_wrapper">
        <div class="row track_container">
          <div class="order_details col-md-6">
            <h3 class="h">Review Details</h3>

            <table class="table table-bordred" border="0" cellspacing="0" cellpadding="0" id="order_detail">
			<?php
		$row=$details;
		$compDate="";$remarks="";
		
		if($details[0]->status == "2")
		{
			$status="<span class='label label-warning'>Pending</span>";
		}
		else if($details[0]->status == "0")
		{
			$status="<span class='label label-success'>Approved</span>";
		}
		else if($details[0]->status == "1")
		{
			$status="<span class='label label-danger'>Rejected</span>";
		}
		else if($details[0]->status == "3")
		{
			$status="<span class='label label-info'>New</span>";
			$db=array(
    			'id'=>$details[0]->id,
    			'status'=>2
    	);
		}
    	//$this->report_db->reviewStatus('reviews',$db);
		
		//$img = "";
		
		if(!empty($details[0]->path))
		{
			$img='<img style="height: 100px;width: 100px;" src="'.front_url().$details[0]->path.'" alt="Picture" class="media-object img-thumbnail user-img">';
		}
			  ?>
             <tr>
			 
                <th width="121" scope="row">Review By :</th>
                <td width="242"><?php echo $details[0]->name; ?></td>
              </tr>

             
              <tr>
                <th scope="row">Product Name : </th>
                <td width="242"><?php echo $details[0]->pname; ?></td>
              </tr>
              <tr>
                <th scope="row">Product Image : </th>
                <td width="242"><strong> <?php echo $img; ?></strong> </td>
              </tr>

              <tr>
                <th scope="row">Posted By : </th>
                <td width="242"><strong><?php echo $details[0]->name; ?></strong> </td>
              </tr>

              <tr>
                <th scope="row">Email-Id : </th>
                <td width="242"><strong><?php echo $details[0]->email; ?></strong> </td>
              </tr>
                
             
             <tr>
                <th scope="row">Review : </th>
                <td width="242"><?php echo $details[0]->review_descp; ?> </td>
              </tr>

              <tr>
                <th scope="row">Rating : </th>
                <td width="242"><?php echo $row[0]->rating; ?> </td>
              </tr>
             
                <tr>
                  <th scope="row">Posted Date & Time : </th>
                  <td width="242"><?php echo $details[0]->created_date; ?></td>
                </tr>
              
                
				<?php
		
		if($details[0]->status == "2" || $details[0]->status == "3"){?>
		
			<tr>
			<th style="width:213px;">&nbsp;</th>
			<td><button onclick="changestatus(0,<?php echo $id;?>);" type="button" class="btn btn-info btn-xs"><i class="icon-ok"></i> Click Here to Approve</button>&nbsp;<button onclick="changestatus(1,<?php echo $id;?>);" type="button" class="btn btn-primary btn-xs"><i class="icon-remove"></i> Click Here to Reject</button></td>';
			</tr>
		<?php }
		else if($details[0]->status == "0"){?>
			<tr>
			<th style="width:213px;">&nbsp;</th>
			<td><button onclick="changestatus(1,<?php echo $id;?>);" type="button" class="btn btn-primary btn-xs"><i class="icon-remove"></i> Click Here to Reject</button> </td>
			</tr>
		<?php }
		else if($details[0]->status == "1"){?>
			<tr>
			<th style="width:213px;">&nbsp;</th>
			<td><button onclick="changestatus(0,<?php echo $id;?>);" type="button" class="btn btn-info btn-xs"><i class="icon-ok"></i> Click Here to Approve</button></td>
			</tr>';	
		<?php }
?>
            </table>

          </div><!-- order_details -->

        

        


          

        </div><!-- container -->
      </div><!-- bk_wrapper -->
    </div>
  </div>
</body>

</html>