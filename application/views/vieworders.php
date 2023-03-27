<?php
  //echo "<pre>";print_r($orders_prod);exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <style>

    .hear{
      background-color:#f2a20c!important;
      color:#fff;
    }

    .bg-primary {
    background-color: #f2a20c!important;
}

.bg-success {
    background-color: #00a65a!important;
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

     <?php $price_icon =  ($orders[0]->currency_type == 2) ? '&#36; ' : '&#x20b9; ';?>
      <div class="bk_wrapper">
        <div class="row track_container">
          <div class="order_details col-md-6">
            <h3 class="h">Order Details</h3>

            <table class="table table-bordred" border="0" cellspacing="0" cellpadding="0" id="order_detail">
              <tr>
                <th width="121" scope="row">Order ID </th>
                <td width="10">:</td>
                <td width="242"><?php echo $orders[0]->orderid; ?></td>

              </tr>

              <tr>
                <th scope="row">Order Date </th>
                <td width="10">:</td>
                <td width="242"><?php echo date_format(date_create($orders[0]->ordered_date), 'g:ia \o\n l jS F Y'); ?></td>
              </tr>
               <tr>
                <th scope="row">Delivery Charges </th>
                <td width="10">:</td>
                <td width="242"><strong><?php echo $price_icon; ?> <?php echo $orders[0]->devilery_charge; ?></strong> </td>
              </tr>
             <!--  <tr>
                <th scope="row">Total Amount </th>
                <td width="10">:</td>
                <td width="242"><strong><?php echo $price_icon; ?> <?php echo number_format((float)$orders[0]->total_amt, 2, '.', ''); ?></strong> </td>
              </tr> -->
              

              <tr>
                <th scope="row">Total Amount Paid</th>
                <td width="10">:</td>
                <td width="242"><strong><?php echo $price_icon; ?> <?php echo number_format((float)$orders[0]->total_amt_paid, 2, '.', ''); ?></strong> </td>
              </tr>

              <tr>
                <th scope="row">Paid Through</th>
                <td width="10">:</td>
                <td width="242"><strong><?php echo strtoupper($orders[0]->paymode); ?></strong> </td>
              </tr>
              <?php if ($orders[0]->paymode != "COD" || $orders[0]->paymode != "cod") { ?>
                <tr>
                  <th scope="row">Transaction ID</th>
                  <td width="10">:</td>
                  <td width="242"><strong><?php echo $orders[0]->txnid; ?></strong> </td>
                </tr>
              <?php } ?>

               <?php if ($paymentid[0]->status == "1") { ?>
                <tr>
                  <th scope="row">Payment ID</th>
                  <td width="10">:</td>
                  <td width="242"><strong><?php echo $paymentid[0]->pay_id; ?></strong> </td>
                </tr>
              <?php }else {} ?>


              <tr>
                <th scope="row">Ordered By </th>
                <td width="10">:</td>
                <td width="242"><?php echo $users[0]->name; ?> </td>
              </tr>

              <tr>
                <th scope="row">Customer Email ID </th>
                <td width="10">:</td>
                <td width="242"><?php echo $users[0]->emailid; ?> </td>
              </tr>
              <?php
              $arry_status = array(
                "",
                "<span class='badge badge-dark'>New</span>",
                "<span class='badge badge-danger'>In-Progress</span>",
                "<span class='badge badge-warning text-white'>Shipped</span>",
                "<span class='badge badge-success'>Delivered</span>"
              );


              if ($orders[0]->status == '-1') {
              ?>
                <tr>
                  <th scope="row">Order Status </th>
                  <td width="10">:</td>
                  <td width="242"><span class='btn btn-primary  btn-grad'>Failed</span></td>
                </tr>
              <?php } else {

              ?>
                <tr>
                  <th scope="row">Order Status </th>
                  <td width="10">:</td>
                  <td width="242"><?php echo $arry_status[$orders[0]->status]; ?> </td>
                </tr>
              <?php } ?>
              <?php
              $date = date_create($orders[0]->delivery_date);
              $today = date_format($date, "d-m-Y");
              ?>
              <tr>
                <th scope="row">Estimated Delivery Date </th>
                <td width="10">:</td>
                <td width="242"><?php echo $today ?> </td>
              </tr>

              <?php
              if ($orders[0]->coupon_code != '0' && !empty($orders[0]->coupon_code)) { ?>
                <tr>
                  <th scope="row">Coupon Code </th>
                  <td width="10">:</td>
                  <td width="242"><?php echo $orders[0]->coupon_code ?> (Discount: <?php echo $orders[0]->discount_per ?>%)</td>
                </tr>
              <?php } ?>

            </table>

          </div><!-- order_details -->

          <div class="shipping_details col-md-6">
            <div class="row">
              <div class="col-md-6">
                <h3 class="h">Billing Details</h3>

                <div class="name_cntact"><?php echo $orders_bill[0]->bname; ?> | <?php echo $orders_bill[0]->bphone; ?></div>
                <p><?php echo $orders_bill[0]->baddr1; ?><br />
                  <?php if (!empty($orders_bill[0]->baddr2)) {
                    echo $orders_bill[0]->baddr2 . "<br>";
                  } ?>
                  <?php echo $orders_bill[0]->bpincode; ?><br>
                  <?php echo $orders_bill[0]->bcountry; ?><br></p>
              </div>

              <div class="col-md-6">
                <h3 class="h">Shipping Details</h3>

                <div class="name_cntact"><?php echo $orders_bill[0]->sname; ?> | <?php echo $orders_bill[0]->sphone; ?></div>
                <p><?php echo $orders_bill[0]->saddr1; ?><br />
                  <?php if (!empty($orders_bill[0]->saddr2)) {
                    echo $orders_bill[0]->saddr2 . "<br>";
                  } ?>
                  <?php echo $orders_bill[0]->spincode; ?><br>
                  <?php echo $orders_bill[0]->scountry; ?><br>
                  <?php if (!empty($orders_bill[0]->landmark)) {
                    echo "Landmark -" . $orders_bill[0]->landmark . "<br>";
                  } ?>
                </p>
              </div>
            </div>
          </div><!-- shipping_details -->

          <div class="products_detail col-md-12">
            <table class="table table-bordred" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th class="h hear">Product Details</th>
                <th class="h text-right hear">Price</th>
                <th class="h text-right hear">Quantity</th>
                <th class="h text-right hear">Tax</th>
                <th class="h text-right hear">SubTotal</th>

              </tr>
              <?php $savings = 0;
              $itemdelv = 0;
              $delv = 0;
              $newAr=[];
              if(count($orders_prod) && !empty($orders_prod)) {
              foreach ($orders_prod as $ordp) {
              ?>
                <tr>
                  <td class="det" valign="top">
                     
                    <?php if (!empty($ordp->image_path)) {
                      echo $img = '<img  style="height: 100px;width: 100px;" src="'. $ordp->image_path . '" alt="Picture" class="media-object img-thumbnail user-img float-left mr-2">';
                    } 
					
					$unit_price = ($orders[0]->currency_type == 2 ) ? $ordp->unit_dollar :  $ordp->unit_price;
					$price = ($orders[0]->currency_type == 2 ) ? $ordp->dollar :  $ordp->price;
					?>
                    <?php echo $ordp->pname; ?> <?php if($ordp->package_id ==1) { echo "(Gold)";}else if($ordp->package_id ==2) {echo "(Silver)";} else if($ordp->package_id ==3) {echo "(Normal)";}?><br>
                   
                  </td>
                  <?php $tax_amt = ($settings[0]->invoice_tax/100)*$ordp->price;?>
                  <td valign="top" align="right"><?php echo $price_icon; ?> <?php echo $ordp->price; ?></td>
                  <td valign="top" align="right"><?php echo $ordp->qty; ?></td>
                   <td valign="top" align="right"><?php echo $price_icon; ?><?php echo $ordp->tax ?></td>
                  <td valign="top" align="right"><?php if(is_numeric($price) && $price !=0) {$newAr[] = (int)$ordp->tax + (int)$price* (int)$ordp->qty; echo $price_icon; } ?> 
                  <?php if(is_numeric($price) && $price !=0) { echo (int)$ordp->tax + (int)$price*(int)$ordp->qty; } ?></td>
                </tr>
              <?php }
            }else {
              echo "No data found";
            }

               ?>

             <!--  <tr>
                <th class="text-right" valign="top" align="right" colspan="3">Saved </th>
                <td valign="top" align="right"><?php echo $price_icon; ?> <?php echo number_format((float)$orders[0]->saved_amt, 2, '.', ''); ?></td>
              </tr> -->
                 <tr>
                <th class="text-right" valign="top" align="right" colspan="4">Total </th>
                <td valign="top" align="right"><?php echo $price_icon; ?> <?php echo number_format(floatval(array_sum($newAr)),2); ?></td>
              </tr>


              <tr>
                <th class="text-right" valign="top" align="right" colspan="4">Delivery Charges </th>
                <td valign="top" align="right"><?php echo $price_icon; ?> <?php echo number_format($orders[0]->devilery_charge); ?></td>
              </tr>

            <?php 

  if(empty($orders[0]->discount)) {

  }else {
    ?>
      <tr>
                <th class="text-right" valign="top" align="right" colspan="4">Discount </th>
                <td valign="top" align="right"> <?php echo $orders[0]->discount_per."%"; ?></td>
              </tr>
     <tr>
                <th class="text-right" valign="top" align="right" colspan="4">Discount Price </th>
                <td valign="top" align="right"><?php echo "- ". $price_icon; ?> <?php echo $orders[0]->discount; ?></td>
              </tr>
    <?php
  }
?>
             <!--  <tr>
                <th class="text-right" valign="top" align="right" colspan="3">Tax </th>
                <td valign="top" align="right"><?php echo $price_icon; ?> <?php echo number_format($orders[0]->taxamount); ?></td>
              </tr> -->

              <tr>
                <th class="text-right" valign="top" align="right" colspan="4">Paid Amount </th>
                <th class="text-right" valign="top" align="right"><?php echo $price_icon; ?> <?php echo $orders[0]->total_amt_paid; ?></th>
              </tr>


            </table>

          </div><!-- products_detail -->


          <div class="products_detail  col-md-12">
            <table class="table table-bordred" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th class="h bg-dark text-white">Order Placed</th>
                <th class="h bg-primary text-white">Shipped</th>
                <th class="h bg-success text-white">Delivered</th>
              </tr>

              <tr>
                <td valign="top"><?php echo date_format(date_create($orders[0]->ordered_date), "d-m-Y"); ?></td>
                <td valign="top"><?php
                                    if(!empty($orders[0]->shipping_date)) {
                                      echo date('d-m-Y',strtotime($orders[0]->shipping_date));
                                    }else {

                                    }
                                  ?></td>
                <td valign="top"><?php  if(!empty($orders[0]->delivered_date)) {
                                      echo date('d-m-Y',strtotime($orders[0]->delivered_date));
                                    }else {

                                    }?></td>
              </tr>
            </table>

          </div><!-- products_detail -->

        </div><!-- container -->
      </div><!-- bk_wrapper -->
    </div>
  </div>
</body>

</html>