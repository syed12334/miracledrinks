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
            <h3 class="h">Order Details</h3>

            <table class="table table-bordred" border="0" cellspacing="0" cellpadding="0" id="order_detail">
			<?php $row=$details;
				if(!empty($row[0]->image_path))
				{
					$img='<img style="height: 100px;width: 100px;" src="'.front_url().$row[0]->image_path.'" alt="Picture" class="media-object img-thumbnail user-img">';
				}
			  ?>
             <tr>
			 
                <th width="121" scope="row">Name :</th>
                <td width="242"><?php echo $row[0]->name; ?></td>
              </tr>

             <?php if($row[0]->user_type == '2')
				{?>
              <tr>
                <th scope="row">Company Name : </th>
                <td width="242"><?php echo $row[0]->company_name; ?></td>
              </tr>
              <tr>
                <th scope="row">PAN Number : </th>
                <td width="242"><strong> <?php echo $row[0]->pan_no; ?></strong> </td>
              </tr>

              <tr>
                <th scope="row">GST : </th>
                <td width="242"><strong><?php echo $row[0]->gst; ?></strong> </td>
              </tr>

              <tr>
                <th scope="row">Country : </th>
                <td width="242"><strong><?php echo$row[0]->country; ?></strong> </td>
              </tr>
                <!--<tr>
                  <th scope="row">Document Download</th>
                  <td width="10">:</td>
                  <td width="242"><strong><?php echo $img; ?></strong> </td>
                </tr>-->
              <?php } ?>
             <tr>
                <th scope="row">Email ID : </th>
                <td width="242"><?php echo $row[0]->emailid; ?> </td>
              </tr>

              <tr>
                <th scope="row">Customer Email ID : </th>
                <td width="242"><?php echo $row[0]->emailid; ?> </td>
              </tr>
             
                <tr>
                  <th scope="row">Contact No. : </th>
                  <td width="242"><?php echo $row[0]->phone; ?></td>
                </tr>
              
                <tr>
                  <th scope="row">Address 1 :</th>
                  <td width="242"><?php echo $row[0]->address1; ?> </td>
                </tr>
				<!--<tr>
                  <th scope="row">Address 2</th>
                  <td width="10">:</td>
                  <td width="242"><?php echo $row[0]->address2; ?> </td>
                </tr>
				<tr>
                  <th scope="row">Town</th>
                  <td width="10">:</td>
                  <td width="242"><?php echo $row[0]->town_name; ?> </td>
                </tr>
				<tr>
                  <th scope="row">Zip</th>
                  <td width="10">:</td>
                  <td width="242"><?php echo $row[0]->zip; ?> </td>
                </tr>
				<tr>
                  <th scope="row">State</th>
                  <td width="10">:</td>
                  <td width="242"><?php echo $row[0]->state; ?> </td>
                </tr>-->
				<tr>
                  <th scope="row">Country :</th>
                  <td width="242"><?php echo $row[0]->country; ?> </td>
                </tr>
				<tr>
                  <th scope="row">Registered Date & Time :</th>
                  <td width="242"><?php echo $row[0]->credate; ?> </td>
                </tr>

            </table>

          </div><!-- order_details -->

        

        


          

        </div><!-- container -->
      </div><!-- bk_wrapper -->
    </div>
  </div>
</body>

</html>