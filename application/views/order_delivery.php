<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
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
                        <p> We are pleased to inform you that the products below has been delivered to <?php echo $order_bill[0]->sname?>. </p>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" style="border:1px solid #e6e6e6;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr style="background:#fafafa; color:#333333; font-weight:bold;">
                                <td style="padding:10px; border-bottom:1px solid #e6e6e6">Products</td>
                                <td style="padding:10px; border-bottom:1px solid #e6e6e6 ">Quantity</td>
                            </tr>
                            <?php if(is_array($order_products)){
                        	foreach ($order_products as $ord){
                        		$image = str_replace('/artii_manage','',base_url()).$ord->image_path;
                        		$product = $this->master_db->getcontent1(''.$ord->categ.'_product_view','psid',$ord->psid);                     			
                        		$url = str_replace('/artii_manage','',base_url()).'products/product_view?page='.$product[0]->ppage_url;
                        		 
                  			?>
                            <tr>
                                <td valign="top" style="padding:10px; border-bottom:1px solid #e6e6e6">
                                    <div style="float:left;">
                                        <a href="<?php echo $url;?>"><img src="<?php echo $image?>" style="width:150px;" /></a>
                                    </div>
                                    <div style="float:left;">
                                        <h3 style="margin:0; padding:0; margin-bottom:10px;"><?php echo $ord->pname?></h3>
                                       <p>[<?php echo $ord->pcode?>]<br><?php if($ord->size_id != '0'){?>Size:<?php echo $ord->size_name;?><br><?php }?>Color:<?php echo $ord->color;?><br>Material:<?php echo $ord->material;?></p>
                                    </div>
                                </td>
                                <td valign="top" style="padding:10px; border-bottom:1px solid #e6e6e6">
                                    <?php echo $ord->qty;?>
                                </td>
                               
                            </tr>
                            <?php }?>
                            <?php }?>
                        </table>
                    </td>
                </tr>
                
                
                <tr>
                    <td colspan="2">                        
                        <p>Order No <?php echo $orders[0]->orderid?> is now closed. Please log on to <a href='<?php echo str_replace('/artii_manage','',base_url());?>'>www.artiiplant.com</a> for any further information.</p>
                        <p>Thank you for choosing Artiiplant Products. </p>
                        <p>A Perfect & Elegant Imitation Of Nature </p>
                       
                        <br />
                        
                    </td>
                </tr>
            </table>
            
        </td>
    </tr>
</table>

</body>
</html>
