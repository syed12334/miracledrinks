<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial, Helvetica, sans-serif; color:#595959">
	<tr>
    	<td colspan="2">
        	<table border="0" cellpadding="0" cellspacing="0" width="100%">
            	<tr>
                	<td style="padding:10px;"> <hr /> </td>
                    <td style="padding:10px; width:115px; height:105px"><img src="<?php echo str_replace('/artii_manage','',asset_url());?>images/logo_emailer.png" /></td>
                    <td style="padding:10px;"><hr /></td>
                </tr>
            </table>
        </td>
    </tr>
    
    <tr>
    	<td colspan="2">
            <p> Hi <?php echo $order_bill[0]->bname?>, </p>
            <?php 
            $text = $this->master_db->getcontent('emailer','');
            if($msg == "success"){
            	
            	if(is_array($text) && !empty($text[0]->ostext)){
					echo $text[0]->ostext;
				}
				else{?>
				<p> Thank you for shopping with Create Your Couch ! Your order has been successfully received and the details are as below. Our delivery team will call you to schedule a convenient time for the delivery.</p>
          		<p> We hope you really liked the experience. Call us at <?php echo $call?> or at <?php echo $emlid;?> if you have any questions. </p>
	            <p> We hope to see you again! <br /> -The Create Your Couch Team. </p>
				<?php 
				}
            }
            else{
            	if(is_array($text) && !empty($text[0]->oftext)){
					echo $text[0]->oftext;
				}
				else{?>
				<p> Thank you for shopping with Create Your Couch ! Something is wrong with payment. Your order has not been placed successfully and the details are as below.</p>
          		<p> We hope you really liked the experience. Call us at <?php echo $call?> or at <?php echo $emlid;?> if you have any questions. </p>
	            <p> We hope to see you again! <br /> -The Create Your Couch Team. </p>
            	
            <?php }}?>
            
            <br />
            
            <spam style="maring:0; padding:0: display:inline-block; font-weight:bold; "> Order ID : <?php echo $orders[0]->orderid?>  </span>
            <span style="display:inline-block; border:1px solid #ccc; font-size:10px; padding-right:10px; -webkit-border-radius:6px; -moz-border-radius:6px; -ms-border-radius:6px; border-radius:6px;">
                <img src="<?php echo asset_url()?>images/van.png" style="vertical-align:middle; padding:5px; border-right:1px solid #ccc" />
                Delivery by <b style="color:#e778ac;"> <?php $date=date_create($orders[0]->delivery_date);echo date_format($date,"M d, Y");?></b> 
            </span>
            <p style="font-weight:bold; margin:0; padding:0; font-size:10px;">(Placed on <?php $date=date_create($orders[0]->ordered_date);echo date_format($date,"M d, Y H:i a");?> IST)</p>
        </td>
    </tr>
    
	<tr>
    	<td width="50%" valign="top">
        	<div style="padding:20px; padding-left:0; ">
            	<div style=" border:1px dashed #ccc; -webkit-border-radius:6px; -moz-border-radius:6px; -ms-border-radius:6px; border-radius:6px; ">
                	<h3 style="margin:0; padding:10px; background:#fafafa; color:#9dd29c; border-bottom:1px dashed #d0d0d0;">Billing Address</h3>
                    <address style="margin:0; padding:50px; font-style:normal; font-weight:bold;">
                    	<?php echo $order_bill[0]->bname?><br>
                        <?php echo $order_bill[0]->baddr1?>,<br>
                        <?php if(!empty($order_bill[0]->baddr2)){?>
                        <?php echo $order_bill[0]->baddr2?>,<br>
                        <?php }?>
                        <?php echo $order_bill[0]->bcity?> - <?php echo $order_bill[0]->bpincode?>. <br>
                        <?php echo $order_bill[0]->bstate?>, India. <br>
                        Phone : +91 <?php echo $order_bill[0]->bphone?><br>
                    </address>
                </div>
            </div>
        </td>
        <td width="50%" valign="top">
        	<div style="padding:20px; padding-right:0;">
            	<div style=" border:1px dashed #ccc; -webkit-border-radius:6px; -moz-border-radius:6px; -ms-border-radius:6px; border-radius:6px; ">
                	<h3 style="margin:0; padding:10px; background:#fafafa; color:#9dd29c; border-bottom:1px dashed #d0d0d0;">Shipping Address</h3>
                    <address style="margin:0; padding:50px; font-style:normal; font-weight:bold;">
                    	<?php echo $order_bill[0]->sname?><br>
                        <?php echo $order_bill[0]->saddr1?>,<br>
                        <?php if(!empty($order_bill[0]->saddr2)){?>
                        <?php echo $order_bill[0]->saddr2?>,<br>
                        <?php }?>
                        <?php echo $order_bill[0]->scity?> - <?php echo $order_bill[0]->spincode?>. <br>
                        <?php echo $order_bill[0]->sstate?>, India. <br>
                        Landmark : <?php echo $order_bill[0]->landmark?><br>
                        Phone : +91 <?php echo $order_bill[0]->sphone?><br>
                    </address>
                </div>
            </div>
        </td>
    </tr>
    
    <tr>
    	<td colspan="2" style="border:1px dashed #ccc;">
        	<table border="0" cellpadding="0" cellspacing="0" width="100%">
            	<tr style="background:#fafafa; font-weight:bold;">
                	<td style="padding:10px; border-bottom:1px dashed #ccc">Item</td>
                    <td style="padding:10px; border-bottom:1px dashed #ccc ">Quantity</td>
                    <td style="padding:10px; border-bottom:1px dashed #ccc; text-align:right;">Price</td>
                </tr>
                 <?php if(is_array($order_products)){
                        	foreach ($order_products as $ord){
                        		$image = str_replace('/artii_manage','',base_url()).$ord->image_path;
                        		$seatname = $ord->seat_name;
                        		$fabname = $ord->fab_name;
                        		$product = $this->master_db->getcontent1($ord->categ.'_seater_view','spid',$ord->spid);
                        		if($ord->cushion_id == '0'){                        			
                        			$url = base_url().'collections/atp_step2?type='.$ord->categ.'&page='.$product[0]->ppage_url.'&seater='.$product[0]->sid;
                        		}
                        		else{
                        			$url = base_url().'collections/atp_step3?type='.$ord->categ.'&page='.$product[0]->ppage_url.'&seater='.$product[0]->spid;
                        		} 
                  ?>
                <tr>
                	<td valign="top" style="padding:10px; border-bottom:1px dashed #ccc">
                    	<div style="border:1px solid #fafafa; float:left;">
                        	<a href="<?php echo $url;?>"><img src="<?php echo $image?>" style="width:150px;" /></a>
                        </div>
                        <div style="float:left;">
                        	<h3 style="margin:0; padding:0; margin-bottom:10px;"><?php echo $ord->pname?></h3>
                        	<?php if($seatname != '' && $fabname != ''){?>
                            <span style="border:1px solid #ccc; padding:5px; font-size:10px; -webkit-border-radius:6px; -moz-border-radius:6px; -ms-border-radius:6px; border-radius:6px;">
                            	Searter <b style="color:#e778ac"><?php echo $seatname?></b> Fabric <b style="color:#e778ac"> <?php echo $fabname?></b>
                            </span> &nbsp;
                            <?php }
				             else if($seatname != '' && $fabname == ''){
				            ?>
				            <span style="border:1px solid #ccc; padding:5px; font-size:10px; -webkit-border-radius:6px; -moz-border-radius:6px; -ms-border-radius:6px; border-radius:6px;">
                            	Searter <b style="color:#e778ac"><?php echo $seatname?></b>
                            </span> &nbsp;
                            <?php }
				             else if($seatname == '' && $fabname != ''){
				             ?>
				             <span style="border:1px solid #ccc; padding:5px; font-size:10px; -webkit-border-radius:6px; -moz-border-radius:6px; -ms-border-radius:6px; border-radius:6px;">
                            	Fabric <b style="color:#e778ac"> <?php echo $fabname?></b>
                            </span> &nbsp;
                            <?php } ?>
                            
                            <p>
                            <?php if($ord->cushion_id == '0'){
					                    	
					                  $seater = $this->orders_db->getseaterwithout($ord->categ, $product[0]->pid, $ord->seat_id);
					                  $h=0;
					                  if(is_array($seater)){
					        ?>
			                                
			                <?php foreach ($seater as $s){
			                         $flag = 0;
										$seatid = $ord->seat_id;
										if($seatid == $s->sid){
											$flag = 1;break;
										}
									if($flag == 0){$h = $h+1;?>
									<?php if($h == 1){?>Add<?php }?>
			                        <span style="border:1px solid #ccc; padding:5px; font-size:10px; -webkit-border-radius:6px; -moz-border-radius:6px; -ms-border-radius:6px; border-radius:6px;">
                                		<a href="<?php echo base_url().'collections/atp_step2?type='.$ord->categ.'&page='.$s->ppage_url.'&seater='.$s->sid;?>"><?php echo $s->sname?> Seater</a>
                                	</span> &nbsp;
			                       <?php }?>
			                                
			                 <?php }}}?>
                            </p>
                            
                            <!-- <p>
                            	Add
                                <span style="border:1px solid #ccc; padding:5px; font-size:10px; -webkit-border-radius:6px; -moz-border-radius:6px; -ms-border-radius:6px; border-radius:6px;">
                                	1 Seater
                                </span> &nbsp;
                                 <span style="border:1px solid #ccc; padding:5px; font-size:10px; -webkit-border-radius:6px; -moz-border-radius:6px; -ms-border-radius:6px; border-radius:6px;">
                                	2 Seater
                                </span> &nbsp;
                                 <span style="border:1px solid #ccc; padding:5px; font-size:10px; -webkit-border-radius:6px; -moz-border-radius:6px; -ms-border-radius:6px; border-radius:6px;">
                                	3 Seater
                                </span>
                            </p> -->
                        </div>
                    </td>
                    <td valign="top" style="padding:10px; border-bottom:1px dashed #ccc">
                    	<?php echo $ord->qty?>
                    </td>
                    <td valign="top" align="right" style="padding:10px; border-bottom:1px dashed #ccc">
                    	&#x20b9; <?php echo $this->orders_db->getnumberformat($ord->price);?>
                    </td>
                </tr>
                <?php }?>
                <tr>
                	<td colspan="3" align="right" style="background:#fafafa; padding:10px; border-top:1px dashed #ccc">
                    	Saved : &#x20b9; <?php echo $this->orders_db->getnumberformat($orders[0]->saved_amt);?>
                    </td>
                </tr>
                <tr>
                	<td colspan="3" align="right" style="background:#fafafa; padding:10px; border-top:1px dashed #ccc">
                    	Tax : &#x20b9; <?php echo $this->orders_db->getnumberformat($orders[0]->tax_amt);?>
                    </td>
                </tr>
                <tr>
                	<td colspan="3" align="right" style="background:#fafafa; padding:10px; border-top:1px dashed #ccc">
                    	Total : &#x20b9; <?php echo $this->orders_db->getnumberformat($orders[0]->pamount_debit);?>
                    </td>
                </tr>
                <?php }?>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
