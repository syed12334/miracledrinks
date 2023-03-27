
            <?php 
			
			$currencyid = $this->session->userdata('currencyid');
			$priceType = ($currencyid !='' ) ? $currencyid['price_type'] : '';
			$price_icon =  ($priceType == 2) ? '<span>&#36;</span> ' : '<i class="fas fa-rupee-sign"></i> ';
			
			//$tot_price = 0;
			if(count($this->cart->contents()) > 0){
                		foreach ($this->cart->contents() as $items){
						  $options = $this->cart->product_options($items['rowid']);
						  $type = $options['categ'];
						  
						  
						  $sellp = ($priceType == 2) ? $items['sel_dollar'] : $this->home_db->getnumberformat($items['price']);
						  
						  //$tot_price = $tot_price+$sellp;
							  
                	?>
            <div class="allcart " >
                <div class="cart-img">
                    <a href="<?php echo $items['plink'];?>">
                        <img src="<?php echo $items['image'];?>" class="img-thumbnail" width="110">
                    </a>
                </div>
                <div class="cart-des">
                    <a class="cart-des-name"
                        href="<?php echo $items['plink'];?>"><?php echo $items['name'];?><?php if($items['sizeid'] != '0'){echo '('.$items['sname'].')';}?></a>
                    <div><?php echo $items['pcode']?></div>
					
					
                     <div class="price-new" <?php if($priceType !=""){?>style="display:none;"<?php }?>><?php echo $price_icon.' '.$sellp;?></div>
					 <span class="inr-new" <?php if($priceType != 1){?>style="display:none;"<?php }?>>
					   <i class="fas fa-rupee-sign"></i> <?php echo $this->home_db->getnumberformat($items['price']); ?> 
					 </span>
							 
					 <span class="usd-new" <?php if($priceType != 2){?>style="display:none;"<?php }?>>
					   <span>&#36;</span> <?php echo $this->home_db->getnumberformat($items['sel_dollar']); ?> 
					 </span>
						
                    <div class="input-group btn-block" style="max-width: 200px;">
                       <button type="button" class="reduced items-count" onclick="reduceqty('<?php echo $items['rowid'];?>')"> - </button>
                        <input type="text" value="<?php echo $items['qty'];?>" class="qty onlynumbers form-control"
                            name="qty<?php echo $items['rowid'];?>" id="qty<?php echo $items['rowid'];?>"
                            uid="<?php echo $items['rowid'];?>" maxlength="3">
						<button type="button" class="increase items-count" onclick="addqty('<?php echo $items['rowid'];?>');"> + </button>
                    </div>
                </div>
                <button type="button" data-toggle="tooltip" title="" class="pull-right cart-re" onclick="remove_row('<?php echo $items['rowid'];?>');"><i class="fa fa-trash-o"></i></button>
            </div>






			<?php }}
            else{
            ?>

            <h1 class="text-center">Oops!! There are no items in your cart</h1>

            <?php }?>

            <div class="row">

                <div class="col-lg-8 col-xs-12 col-md-6">
                    <div class="gift_coupon" id="gift_voucherid">
                        <?php if(!$this->session->userdata('coupon')){
							?>
                        <h1>Use Coupon Code</h1>

                        <div class="input-group">
                            <input type="text" placeholder="Enter your gift coupon" name="coupon" id="coupon"
                                class="form-control">
                            <span class="input-group-btn">
                                <input type="submit" class="btn btn-primary giftcoupon" value="update">
                            </span>
                        </div>


                        <?php }
                    else{?>
                        <p class="have gift_coupon_added">1 gift coupon added <span
                                class="removecoupon icon icon-pencil" title="Edit"></span><br>
                            <?php if(floatval($this->cart->total()) > 0){?><span class="save">You have saved <i
                                    class="icon_rs_green"></i>
                                <?php echo $this->session->userdata('discount_amt');?> </span><?php }?>
                        </p>
                        <?php }
                    ?>
                    </div>

                    <?php $charges = 0;?>
                </div>
                <div class="col-lg-4 col-xs-12 col-sm-12 col-md-6">
                    <table class=" table table-bordered">
                        <?php if($this->session->userdata('coupon') && floatval($this->cart->total()) > 0){?>

                        <tr>
                            <td class="text-right"> Saved </td>
                            <td class="text-right"><?php echo $price_icon;?>
                                -<?php echo $this->session->userdata('discount_amt');?> </td>
                        </tr>
                        <?php }?>
                        <?php $charges = 0;?>
                        <?php if($this->session->userdata('pincode')){
		                    		if(floatval($this->session->userdata('charges')) > 0  && floatval($this->cart->total()) > 0){
										$charges = $this->session->userdata('charges');
		                    	?>
                        <tr>
                            <td class="text-right"> Delivery Charges </td>
                            <td class="text-right"><?php echo $price_icon;?> <?php echo $charges;?> </td>
                        </tr>
                        <?php }}?>
                        <tr>
                            <td class="text-right">Total Payable Amount </td>
                            <td class="text-right"><?php echo $price_icon;?>
                                <?php echo $this->home_db->getcarttotal($this->session->userdata('discount'),$this->cart->total(),$charges);?>
                            </td>
                            <p class="tax">(Incl.tax)</p>
                        </tr>
                    </table>
                </div>
            </div>
