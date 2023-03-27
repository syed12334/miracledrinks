<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo maintitle;?></title>
</head>

<body>

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial, Helvetica, sans-serif; color:#595959; border:10px solid #e6e6e6">
	<tr>
    	<td style="padding:10px 30px 30px 30px">
        	
            <table>
            	<tr>
                    <td colspan="2">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-bottom:1px solid #e6e6e6">
                            <tr>
                                <td style="padding:10px; width:115px; height:105px"><img src="<?php echo str_replace('/artii_manage','',asset_url());?>images/artiiplants-logo.png" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <p> Dear <?php echo $order_bill[0]->bname?>, </p>
                        <p>Greetings from Artiiplant!</p>
                        <p> We are glad to inform you that your Order No <?php echo $orders[0]->orderid;?> has been sent for delivery. Our delivery team will contact you shortly</p>
                    </td>
                </tr>
                
                <tr>
                    <td width="50%" valign="top">
                        <div style="padding:20px; padding-right:0; ">
                            <div style=" border:1px solid #e6e6e6;  ">
                                <h3 style="margin:0; padding:10px; background:#fafafa; color:#333333; border-bottom:1px solid #e6e6e6;">Delivery Address</h3>
                                <address style="margin:0; padding:50px; font-style:normal; font-weight:bold;">
                                    <?php echo $order_bill[0]->sname?><br>
			                        <?php echo $order_bill[0]->saddr1?>,<br>
			                        <?php if(!empty($order_bill[0]->saddr2)){?>
			                        <?php echo $order_bill[0]->saddr2?>,<br>
			                        <?php }?>
			                        <?php echo $order_bill[0]->scity?> - <?php echo $order_bill[0]->spincode?>. <br>
			                        <?php echo $order_bill[0]->sstate?>, India. <br>
			                        <?php if(!empty($order_bill[0]->landmark)){?>
			                        Landmark : <?php echo $order_bill[0]->landmark?><br>
			                        <?php }?>
			                        Phone : +91 <?php echo $order_bill[0]->sphone?><br>
                                </address>
                            </div>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">                        
                        <p>Please check for any damages at the time of delivery as we do not have an exchange policy once the order is closed.</p>
                        <p>For any information on the product or its maintenance, please log on to <a href='<?php echo str_replace('/artii_manage','',base_url());?>'>www.artiplant.com</a></p>
                       
                        <br />
                        
                    </td>
                </tr>
            </table>
            
        </td>
    </tr>
</table>

</body>
</html>
