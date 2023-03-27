<?php 

 error_reporting(E_ALL);

header("Expires: 0");

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

header("Cache-Control: no-store, no-cache, must-revalidate");

header("Cache-Control: post-check=0, pre-check=0", false);

header("Pragma: no-cache");

header("Content-type: application/vnd.ms-excel;charset:UTF-8");

header("Content-Disposition: attachment; filename=user_orders.xls"); 
$arry_status = array(
				"",
				"<span class='badge badge-dark'>New</span>",
				"<span class='badge badge-danger'>In-Progress</span>",
				"<span class='badge badge-warning text-white'>Shipped</span>",
				"<span class='badge badge-success'>Delivered</span>");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <style>
  
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
h3 {
    font-weight: normal;
    margin-bottom: 20px;
    text-transform: uppercase;
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
}
  </style>
  
  <style> .item{
    font-size: 11px;
    }
    .phone{ mso-number-format:\@; }
     .heading_blue { font-size: 13px; font-weight: bold;} .savings{color: green;font-size: 11px;}</style>
  </head>
  <body>
      <div class="bk_wrapper">
    	<div class="container track_container">   
    	<?php 
                if(is_array($orders)){
				foreach ($orders as $ord){
                ?>         
           
            	<h3 class="h">Order Details</h3>
               
                	<table border="1" cellspacing="0" cellpadding="0" id="order_detail">
                      <tr>
                        <th width="121" scope="row">Order ID : </th>
                        <td width="242"><?php echo $ord->orderid;?></td>
                       
                      </tr>
                                            
                      <tr>
                        <th scope="row">Order Date : </th>
                        <td width="242"><?php echo date_format(date_create($ord->ordered_date),'g:ia \o\n l jS F Y');?></td>
                      </tr>
                      <tr>
                        <th scope="row">Total Amount : </th>
                        <td width="242"><strong> <?php echo number_format((float)$ord->total_amt_paid, 2, '.', '');?></strong> </td>
                      </tr> 
                      
                      <tr>
                        <th scope="row">Total Amount Paid : </th>
                        <td width="242"><strong > <?php echo number_format((float)$ord->pamount_debit, 2, '.', '');?></strong> </td>
                      </tr> 
                      
                      <tr>
                        <th scope="row">Customer Name : </th>
                        <td width="242"><?php echo $ord->ufname;?> </td>
                      </tr> 
                      
                      <tr>
                        <th scope="row">Customer Email ID : </th>
                        <td width="242"><?php echo $ord->uemail;?> </td>
                      </tr> 
                      <?php 		
				
						if($ord->status == '-1')
						{
                      ?> 
                      <tr>
                        <th scope="row">Order Status : </th>
                        <td width="242"><span class='btn btn-primary btn-sm btn-grad'>Failed</span></td>
                      </tr> 
                      <?php }
                      else{
                      ?> 
                      <tr>
                        <th scope="row">Order Status : </th>
                        <td width="242"><?php echo $arry_status[$ord->status];?> </td>
                      </tr> 
                      <?php }?>
                      <?php 
                      $date = date_create($ord->delivery_date);
                      $today = date_format($date,"d-m-Y");
                      ?>  
                      
                      <tr>
                        <th scope="row">Estimated Delivery Date : </th>
                        <td width="242"><?php echo $today?> </td>
                      </tr> 
                      
                      <?php 
                      if($ord->coupon_code !='0' && !empty($ord->coupon_code))
                      {?>
                      <tr>
                        <th scope="row">Coupon Code : </th>
                        <td width="242"><?php echo $ord->coupon_code?> (Discount: <?php echo $ord->discount?>%)</td>
                      </tr>
                      <?php }?>
                                     
                    </table>

            
            <table border="1" cellspacing="0" cellpadding="0">
            <tr>
            <td>
	            <div style="float: left;width: 240px;">
	            	<h3 class="h">Billing Details</h3>
	                
	                <div class="name_cntact"><?php echo $ord->bname;?>  |  <?php echo $ord->bphone;?></div>	
	                <p class="phone"><?php echo $ord->baddr1;?><br/>
	                	<?php if(!empty($ord->baddr2)){echo $ord->baddr2."<br>";}?>
	                        <?php echo $ord->bcity;?><br>
	                        <?php echo $ord->bstate;?><br>
	                        <?php echo $ord->bpincode;?><br>
	                        <?php echo $ord->bcountry;?><br></p>
	           </div>
	         </td>
	         <td> 
	           <div style="float: left;width: 240px;">
	            	<h3 class="h">Shipping Details</h3>
	                
	                <div class="name_cntact"><?php echo $ord->sname;?>  |  <?php echo $ord->sphone;?></div>	
	                <p class="phone"><?php echo $ord->saddr1;?><br/>
	                	<?php if(!empty($ord->saddr2)){echo $ord->saddr2."<br>";}?>
	                        <?php echo $ord->scity;?><br>
	                        <?php echo $ord->sstate;?><br>
	                        <?php echo $ord->spincode;?><br>
	                        <?php echo $ord->scountry;?><br>
	                        Landmark - <?php echo $ord->landmark;?><br></p>
	           </div>
               </td>         
            
            </tr>
            </table>
            
            
            	<table border="1" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="h">Product Details</td>
                    <td class="h" align="right">Price</td>
                    <td class="h" align="right">Quantity</td>
                    <td class="h" align="right">SubTotal</td>
                    
                  </tr>
                  <?php $savings=0;$itemdelv=0;$delv=0;
                  	$orders_prod=$this->master_db->getcontent1('orders_products','oid',$ord->id);
                    foreach ($orders_prod as $ordp):
                    ?>
                  <tr>
                    <td class="det" valign="top"><?php echo $ordp->pname;?><?php if(!empty($ordp->size_name)){echo "(".$ordp->size_name.")";}?><br>
                    Material: <?php echo $ordp->material;?><br>Color: <?php echo $ordp->color;?></td>
                    <td valign="top" align="right"><?php echo $ordp->unit_price;?></td>
                    <td valign="top" align="right"><?php echo $ordp->qty;?></td>
                    <td valign="top" align="right"><?php echo $ordp->price;?></td>
                  </tr>
                  <?php endforeach;?>
                  
                 <tr>
                    <td valign="top" align="right" colspan="3">Saved </td>
                    <td valign="top" align="right"><?php echo $ord->saved_amt;?></td>
                 </tr>
                 
                 <tr>
                    <td valign="top" align="right" colspan="3">Delivery Charges </td>
                    <td valign="top" align="right"><?php echo $ord->devilery_charge;?></td>
                 </tr>
                 
                 <tr>
                    <td valign="top" align="right" colspan="3">Grand Total </td>
                    <td valign="top" align="right"><?php echo $ord->total_amt_paid;?></td>
                 </tr>
                  
                  
                </table>     
            
                      
            	<table border="1" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="h">Order Placed</td>
                    <td class="h">Shipping</td>
                    <td class="h">Delivery</td>                    
                  </tr>
                  
                  <tr>
                    <td valign="top" ><?php echo date_format(date_create($ord->ordered_date),"d-m-Y");?></td>
                    <td valign="top" ><?php if($ord->shipping_date != '0000-00-00'){echo date_format(date_create($ord->shipping_date),"d-m-Y");}?></td>
                    <td valign="top" ><?php if($ord->delivered_date != '0000-00-00'){echo date_format(date_create($ord->delivered_date),"d-m-Y");}?></td>
                  </tr>
                </table>

            
            <?php }
echo "<hr/><br>";
}?>
        
      </div><!-- container -->
     </div><!-- bk_wrapper -->
     </body></html>