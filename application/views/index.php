<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
    <meta property="og:url" content="<?php echo base_url();?>my_account/my_orders" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Introducing our New Site" />
    <meta property="og:image" content="<?php echo base_url();?>assets/images/logo.svg" />
    <meta property="og:description" content="http://samples.ogp.me/390580850990722" />
    <meta property="fb:app_id" content="3182287005425708" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="google-site-verification" content="fxhakDZTAwDsTug2tLPGEe3badzW9Focw9_zdsS346w" />
    <title><?php echo maintitle ?></title>
   <meta name="Description" CONTENT="Changing the definition of beauty: At Oiishee we believe that beauty is a feeling, the radiance of the inside beauty enhances the outer.">
   
   
    <link href="<?php echo asset_url(); ?>css/artiiplants.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/artiiplantss.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/all.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/font-awesome.min1.css" rel="stylesheet">
   



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
    <?php echo $common; ?>
	<style>
	.offer_tag {
    background-color: #014E37;
    color: #fff;
    font-size: 12px;
    font-weight: 500;
    padding: 5px 16px 3px 9px;
    left: 0px;
    position: absolute;
    top: 8px;
    z-index: 9;
    text-transform: uppercase;
}
.offer_tag::before {
    content: "";
    position: absolute;
    right: 0;
    top: 0;
    width: 0;
    height: 0;
    border-top: 12px solid #014E37;
    border-bottom: 13px solid #014E37;
    border-right: 7px solid #fff;
}

.test{
	width:100%;
}

	</style>
</head>
<body>

    <?php echo $header; ?>


       
    <div class="banner__slider">
        <div class="slider stick-dots">
            <?php if (is_array($bannerval)) { ?>
            <?php foreach ($bannerval as $b) { ?>
            <div class="slide">
                <div class="slide__img">
                    <a href="<?php echo $b->banner_link ?>"> <img src="" alt=""
                            data-lazy="<?php echo cdn_url() . $b->banner_image; ?>" class="full-image animated"
                            data-animation-in="zoomInImage" /></a>
                </div>
                <div class="slide__content slidertext">
                    <div class="slide__content--headings">

                       <!-- <h2 class="animated" data-animation-in="fadeInUp" data-delay-in="0.3">Welcome to
                            <span style="color:#0da17f;">ARTII</span><span style="color:#e6d301;">PLANTS</span>
                        </h2>-->
                        <!-- <h1 class="animated" data-animation-in="fadeInUp">New Perfect Plant
                                    Collection</h1>-->
                        <!--<h1 class="animated" data-animation-in="fadeInUp"><?php echo $b->descp ?></h1>
                        <a href="<?php echo $b->banner_link ?>" class="btn btn-primary animated"
                            data-animation-in="fadeInUp">Shop Now</a>-->
                    </div>
                </div>
            </div>
            <?php }
            } ?>
        </div>


        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px" id="circle"
                fill="none" stroke="currentColor">
                <circle r="20" cy="22" cx="22" id="test">
            </symbol>
        </svg>
    </div>



    <!-- <SLIDER - CATEGORY INFO> ================================= -->
    <div class="category_infor_slider">
        <div class="container-fluid">
            <div id="category_info_slider" class="owl-carousel">
                <?php if (is_array($category)) { ?>
                <?php foreach ($category as $c) { ?>
                <div class="cagegory_info_box">

                    <div class="neet-effect mat-effect beffect">
                        <a href="<?php echo base_url(); ?>products?type=<?php echo $c->cpage_url; ?>"><img src="<?php echo cdn_url().$c->cimage_path; ?>"></a>
                    </div>

                </div>
                <?php }
                } ?>
            </div>
        </div>
    </div>
    <!-- END </body>SLIDER - CATEGORY INFO> -->

<?php if(!is_array($UserDetail)){?>
    <div class="container">
        <div class="">
            <div class="sellbanner row">
                <div class="">
                    <div class="sell-img col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <a href="#">
                            <img src="<?php echo base_url().$special_banner[0]->spcl_img;?>" alt="banner"
                                class="img-responsive">
                        </a>
                    </div>
                </div>
				
				
                <div class="ser-dsc col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <span class="ser-title">
                        <!--<h2>New Collection 2021</h2>-->
                       <!-- <h1>Premium Products 2021</h1>-->
                        <h1>Changing the definition of beauty</h1>
                        <?php echo $special_banner[0]->description;?>
                    </span>
                    <a href="<?php echo base_url(); ?>/wholesaler" class="btn btn-primary">Shop Now <i class="fa fa-long-arrow-right"
                            aria-hidden="true"></i> </a>
                </div>
				
            </div>
        </div>
    </div>
	<?php }?>
	<img src="<?php echo base_url().$special_banner[0]->banner;?>" class="img-responsive test">

    <!-- <PAGE CONTENT> ================================= -->
    <div class="page_content">
        <div class="container">
            <!-- <New Product Slider> ---------------------------- -->



           <?php 
			
			/* <div class="heading text-center">
                <h1><span>Featured products</span></h1>
            </div>
			
			if(count($category)>0)
			{
				foreach ($category as $c) {
					 $table = "frontview_" . $c->cpage_url . "_product";
						$products = $this->home_db->getRecords(
					  $table,
					  array('home_page' => 1),
					  'pname, pid, ppage_url, image_path, mrp, selling_price, psid, pcreated_date,cpage_url,stock,sname,spage_url',
					  'pid asc',
					  'pid',
					  '0',
					  '15'
					);
					?>
					<h1><span><?php echo ucfirst($c->cname); ?></span></h1>
					 <div class="row">
                <?php if (is_array($products)) { ?>
                <?php foreach ($products as $p) {
                        $mrp = $p->mrp;
                        $sell = $p->selling_price;
                        $disc = $this->home_db->discount($mrp, $sell);
                        $name = $p->pname;
                        $size = $p->spage_url;
						$str = explode("-",$size);
                        if (strlen($name) > 32) {
                            $name = substr($name, 0, 30) . '...';
                        }
                        $url = base_url() . 'products/product_view?page=' . $p->ppage_url;

                    ?>


                <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="product-thumb transition">
                        <div class="img">

                            <div class="image">
                                <a href="<?php echo $url; ?>"><img src="<?php echo cdn_url() . $p->image_path; ?>"
                                        class="img-responsive center-block"></a>
										<?php $sql=$this->home_db->getcontent('product_images','pid',$p->pid,'0','');
										?>
										<a href="<?php echo $url; ?>">
										<img src="<?php echo cdn_url().$sql[0]->thumb; ?>"
                                        class="img-responsive second-img" alt="hover image"></a><!-- <span
                                                class="sale"><?php if (floatval($disc) > 0) { ?> <?php echo $disc ?>% OFF
                                                <?php } ?>
                                            </span>-->
											
											<span class="offer_tag"><span class="tr"><?php if (floatval($disc) > 0) { ?> <?php echo round($disc) ?>% Off
											<?php } ?></span></span>
                            </div>


                        </div>
                        <div class="text caption">
                            <?php $rate = $this->products_db->getratings($p->pid); ?>
                            <p class="star_box">
                                <span class="star <?php if (intval($rate) >= 1) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 2) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 3) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 4) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 5) { ?>star_review<?php } ?>"></span>
                            </p>

                            <h4 class="protitle"><a href="<?php echo $url; ?>"><?php echo $name; ?></a></h4>


                            <p class="price">
                                <?php $nooffer = 'no_offer';
                                        if (floatval($disc) > 0) {
                                            $nooffer = ''; ?>

                                <span class="price-new <?php echo $nooffer; ?>"> <i class="fas fa-rupee-sign"></i>
                                    <?php echo $this->home_db->getnumberformat($p->selling_price); ?> </span> &nbsp;
                                <span class="price-old"><i class="fas fa-rupee-sign"></i>
                                    <?php echo $this->home_db->getnumberformat($p->mrp); ?></span><?php } ?>&nbsp;&nbsp;
									 <span>&#36;</span><?php echo 75;?><br/>
									<?php echo $str[0].$str[1];?>
                            </p>

                            <div class="button-group">
                                <a href="javascript:add_cart('<?php echo $p->cpage_url; ?>','<?php echo $p->psid; ?>');"
                                    type="button" data-original-title="Add to cart"><i
                                        class="fas fa-shopping-basket"></i></a>


                                <?php
                                        $wish = 0;
                                        if (!empty($UserDetail)) {
                                            $db = array(
                                                'categ' => $p->cpage_url,
                                                'pid' => $p->pid,
                                                'user_id' => $UserDetail[0]->id
                                            );
                                            $wish = $this->home_db->checkwishlist($db);
                                        }
                                        ?>
                                <a href="javascript:void(0);" data-original-title="Add to Wish List"
                                    wid="<?php echo $p->pid; ?>" id="w<?php echo $p->pid; ?>"
                                    categ="<?php echo $p->cpage_url ?>" <?php if ($wish == 0) { ?>class="awishlist"
                                    title="Add to wishlist" <?php } else { ?> class="added" title="Added to wishlist"
                                    <?php } ?>><i id="icon<?php echo $p->pid ?>"
                                        class="far <?php if ($wish == 0) { ?>fa-heart<?php } else { ?>fa-heart<?php } ?>"></i></a>



                            </div>



                        </div>
                    </div>
                </div>
                <?php }
                } ?>
            </div>
			<?php }}*/?>
			
			
			    
				
        <div class="heading text-center">
             <h1><span>Featured products</span></h1>
        </div>
			<?php  $currencyid = $this->session->userdata('currencyid');
					$priceType = ($currencyid !='' ) ? $currencyid['price_type'] : '';
                   	$price_icon =  ($priceType == 2) ? '<span>&#36;</span> ' : '<i class="fas fa-rupee-sign"></i> ';
			?>
							
			  
			
				
		  
				
				
				
				<h1><span>Special offers</span></h1>
		       <div class="row">    

                
                  <?php


                   			  
				    if(is_array($special_offers)) 
				    {  
				        foreach ($special_offers as $p) 
						{
							//$mrp = $p->mrp;
							//$sell = $p->selling_price;
							$mrp = $p->mrp;
							$sell = $p->selling_price;
							$sel_dollar = $p->sel_dollar;
							//echo 'user_type______'.$user_type;exit;
							if($user_type == 2)
							{
							  $sell = $p->b2b_selling_price;
							  $sel_dollar = $p->b2b_sel_dollar;
							}
							
							$disc = $this->home_db->discount($mrp, $sell);
							$name = $p->pname;
							$size = $p->spage_url;
							$str = explode("-",$size);
							if (strlen($name) > 32) {
								$name = substr($name, 0, 30) . '...';
							}
							$url = base_url() . 'products/product_view?page=' . $p->ppage_url;
							$sellp = ($priceType == 2) ? $sel_dollar : $sell;
							
							

                 ?>


                <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="product-thumb transition">
                        <div class="img">

                            <div class="image">
                                <a href="<?php echo $url; ?>"><img src="<?php echo cdn_url() . $p->image_path; ?>"
                                        class="img-responsive center-block"></a>
										<?php $sql=$this->home_db->getcontent('product_images','pid',$p->pid,'0','');
										?>
										<a href="<?php echo $url; ?>">
										<img src="<?php echo cdn_url().$sql[0]->thumb; ?>"
                                        class="img-responsive second-img" alt="hover image"></a><!-- <span
                                                class="sale"><?php if (floatval($disc) > 0) { ?> <?php echo $disc ?>% OFF
                                                <?php } ?>
                                            </span>-->
											<?php if($disc!=0){?>
											<span class="offer_tag"><span class="tr"><?php if (floatval($disc) > 0) { ?> <?php echo round($disc) ?>% Off
											<?php } ?></span></span><?php }?>
                            </div>


                        </div>
                        <div class="text caption">
                            <?php $rate = $this->products_db->getratings($p->pid); ?>
                            <p class="star_box">
                                <span class="star <?php if (intval($rate) >= 1) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 2) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 3) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 4) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 5) { ?>star_review<?php } ?>"></span>
                            </p>

                            <h4 class="protitle"><a href="<?php echo $url; ?>"><?php echo $name; ?></a></h4>


                            <p class="price">
                                <?php $nooffer = 'no_offer';
                                        if (floatval($disc) > 0) {
                                            $nooffer = ''; ?>

                                <span class="price-new <?php echo $nooffer; ?>" <?php if($priceType != ""){?>style="display:none;"<?php }?>> <i class="fas fa-rupee-sign"></i>
                                    <?php echo $this->home_db->getnumberformat($sellp); ?> </span> 
									
									 <span class="inr-new <?php echo $nooffer; ?>" <?php if($priceType != 1){?>style="display:none;"<?php }?>>
                                       <i class="fas fa-rupee-sign"></i> <?php echo $this->home_db->getnumberformat($sell); ?> 
									 </span>
									 
									 <span class="usd-new <?php echo $nooffer; ?>" <?php if($priceType != 2){?>style="display:none;"<?php }?>>
                                       <span>&#36;</span> <?php echo $this->home_db->getnumberformat($sel_dollar); ?> 
									 </span>
									
									&nbsp;
                                <span class="price-old"><i class="fas fa-rupee-sign"></i>
                                    <?php echo $this->home_db->getnumberformat($mrp); ?></span><?php } ?>&nbsp;&nbsp;
									
									<?php echo $str[0].$str[1];?>
                            </p>

                            <div class="button-group">
                                <a href="javascript:add_cart('<?php echo $p->cpage_url; ?>','<?php echo $p->psid; ?>');"
                                    type="button" data-original-title="Add to cart"><i
                                        class="fas fa-shopping-basket"></i></a>


                                <?php
                                        $wish = 0;
                                        if (!empty($UserDetail)) {
                                            $db = array(
                                                'categ' => $p->cpage_url,
                                                'pid' => $p->pid,
                                                'user_id' => $UserDetail[0]->id
                                            );
                                            $wish = $this->home_db->checkwishlist($db);
                                        }
                                        ?>
                                <a href="javascript:void(0);" data-original-title="Add to Wish List"
                                    wid="<?php echo $p->pid; ?>" id="w<?php echo $p->pid; ?>"
                                    categ="<?php echo $p->cpage_url ?>" <?php if ($wish == 0) { ?>class="awishlist"
                                    title="Add to wishlist" <?php } else { ?> class="added" title="Added to wishlist"
                                    <?php } ?>><i id="icon<?php echo $p->pid ?>"
                                        class="far <?php if ($wish == 0) { ?>fa-heart<?php } else { ?>fa-heart<?php } ?>"></i></a>



                            </div>



                        </div>
                    </div>
                </div>
                <?php 
				   }
                } 
				?>
				
				
			</div>

       
				<!--end--->
				
				
				<h1><span>Bundle offers</span></h1>
		       <div class="row">    

                  <?php


                   			  
				    if(is_array($bundle_products)) 
				    {  
				        foreach ($bundle_products as $p) 
						{
							//$mrp = $p->mrp;
							//$sell = $p->selling_price;
							$mrp = $p->mrp;
							$sell = $p->selling_price;
							$sel_dollar = $p->sel_dollar;
							//echo 'user_type______'.$user_type;exit;
							if($user_type == 2)
							{
							  $sell = $p->b2b_selling_price;
							  $sel_dollar = $p->b2b_sel_dollar;
							}
							$disc = $this->home_db->discount($mrp, $sell);
							//print_r($disc);exit;
							$name = $p->pname;
							$size = $p->spage_url;
							$str = explode("-",$size);
							if (strlen($name) > 32) {
								$name = substr($name, 0, 30) . '...';
							}
							$url = base_url() . 'products/product_view?page=' . $p->ppage_url;
							$sellp = ($priceType == 2) ? $sel_dollar : $sell;
							
							

                 ?>


                <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="product-thumb transition">
                        <div class="img">

                            <div class="image">
                                <a href="<?php echo $url; ?>"><img src="<?php echo cdn_url() . $p->image_path; ?>"
                                        class="img-responsive center-block"></a>
										<?php $sql=$this->home_db->getcontent('product_images','pid',$p->pid,'0','');
										?>
										<a href="<?php echo $url; ?>">
										<img src="<?php echo cdn_url().$sql[0]->thumb; ?>"
                                        class="img-responsive second-img" alt="hover image"></a><!-- <span
                                                class="sale"><?php if (floatval($disc) > 0) { ?> <?php echo $disc ?>% OFF
                                                <?php } ?>
                                            </span>-->
											<?php if($disc!=0){?>
											<span class="offer_tag"><span class="tr"><?php if (floatval($disc) > 0) { ?> <?php echo round($disc) ?>% Off
											<?php } ?></span></span><?php }?>
                            </div>


                        </div>
                        <div class="text caption">
                            <?php $rate = $this->products_db->getratings($p->pid); ?>
                            <p class="star_box">
                                <span class="star <?php if (intval($rate) >= 1) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 2) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 3) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 4) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 5) { ?>star_review<?php } ?>"></span>
                            </p>

                            <h4 class="protitle"><a href="<?php echo $url; ?>"><?php echo $name; ?></a></h4>


                            <p class="price">
                                <?php $nooffer = 'no_offer';
                                       
                                            $nooffer = ''; ?>

                                <span class="price-new <?php echo $nooffer; ?>" <?php if($priceType != ""){?>style="display:none;"<?php }?>> <i class="fas fa-rupee-sign"></i>
                                    <?php echo $this->home_db->getnumberformat($sellp); ?> </span> 
									
								 <span class="inr-new <?php echo $nooffer; ?>" <?php if($priceType != 1){?>style="display:none;"<?php }?>>
                                       <i class="fas fa-rupee-sign"></i> <?php echo $this->home_db->getnumberformat($sellp); ?> 
									 </span>
									 
									 <span class="usd-new <?php echo $nooffer; ?>" <?php if($priceType != 2){?>style="display:none;"<?php }?>>
                                       <span>&#36;</span> <?php echo $this->home_db->getnumberformat($sel_dollar); ?> 
									 </span>	
									
									
									&nbsp;
									 <?php if (floatval($disc) > 0) {?>
                                <span class="price-old"><i class="fas fa-rupee-sign"></i>
                                    <?php echo $this->home_db->getnumberformat($mrp); ?></span><?php } ?>&nbsp;&nbsp;
									 
									<?php echo $str[0].$str[1];?>
                            </p>

                            <div class="button-group">
                                <a href="javascript:add_cart('<?php echo $p->cpage_url; ?>','<?php echo $p->psid; ?>');"
                                    type="button" data-original-title="Add to cart"><i
                                        class="fas fa-shopping-basket"></i></a>


                                <?php
                                        $wish = 0;
                                        if (!empty($UserDetail)) {
                                            $db = array(
                                                'categ' => $p->cpage_url,
                                                'pid' => $p->pid,
                                                'user_id' => $UserDetail[0]->id
                                            );
                                            $wish = $this->home_db->checkwishlist($db);
                                        }
                                        ?>
                                <a href="javascript:void(0);" data-original-title="Add to Wish List"
                                    wid="<?php echo $p->pid; ?>" id="w<?php echo $p->pid; ?>"
                                    categ="<?php echo $p->cpage_url ?>" <?php if ($wish == 0) { ?>class="awishlist"
                                    title="Add to wishlist" <?php } else { ?> class="added" title="Added to wishlist"
                                    <?php } ?>><i id="icon<?php echo $p->pid ?>"
                                        class="far <?php if ($wish == 0) { ?>fa-heart<?php } else { ?>fa-heart<?php } ?>"></i></a>



                            </div>



                        </div>
                    </div>
                </div>
                <?php 
				   }
                } 
				?>
		   </div>
				<!--end--->
				
			
				
				 <h1><span>Oiishee Exclusives</span></h1>
		       <div class="row">    
          
              
				
				 
                  <?php

                   
		  
				    if(is_array($newproducts)) 
				    {  
				        foreach ($newproducts as $p) 
						{
							$mrp = $p->mrp;
							$sell = $p->selling_price;
							$sel_dollar = $p->sel_dollar;
							//echo 'user_type______'.$user_type;exit;
							if($user_type == 2)
							{
							  $sell = $p->b2b_selling_price;
							  $sel_dollar = $p->b2b_sel_dollar;
							}
							$disc = $this->home_db->discount($mrp, $sell);
							$name = $p->pname;
							$size = $p->spage_url;
							$str = explode("-",$size);
							if (strlen($name) > 32) {
								$name = substr($name, 0, 30) . '...';
							}
							$url = base_url() . 'products/product_view?page=' . $p->ppage_url;
							
							$sellp = ($priceType == 2) ? $sel_dollar : $sell;
							
							
                 ?>


                <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="product-thumb transition">
                        <div class="img">

                            <div class="image">
                                <a href="<?php echo $url; ?>"><img src="<?php echo cdn_url() . $p->image_path; ?>"
                                        class="img-responsive center-block"></a>
										<?php $sql=$this->home_db->getcontent('product_images','pid',$p->pid,'0','');
										?>
										<a href="<?php echo $url; ?>">
										<img src="<?php echo cdn_url().$sql[0]->thumb; ?>"
                                        class="img-responsive second-img" alt="hover image"></a><!-- <span
                                                class="sale"><?php if (floatval($disc) > 0) { ?> <?php echo $disc ?>% OFF
                                                <?php } ?>
                                            </span>-->
											
											<?php if($disc!=0){?><span class="offer_tag"><span class="tr"><?php if (floatval($disc) > 0) { ?> <?php echo round($disc) ?>% Off
											<?php } ?></span></span><?php }?>
                            </div>


                        </div>
                        <div class="text caption">
                            <?php $rate = $this->products_db->getratings($p->pid); ?>
                            <p class="star_box">
                                <span class="star <?php if (intval($rate) >= 1) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 2) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 3) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 4) { ?>star_review<?php } ?>"></span>
                                <span class="star <?php if (intval($rate) >= 5) { ?>star_review<?php } ?>"></span>
                            </p>

                            <h4 class="protitle"><a href="<?php echo $url; ?>"><?php echo $name; ?></a></h4>


                            <p class="price">
                                     <?php   
								
								       
								        $nooffer = 'no_offer';
                                        if (floatval($disc) > 0) {
                                            $nooffer = ''; ?>

                                     <span class="price-new <?php echo $nooffer; ?>" <?php if($priceType != ""){?>style="display:none;"<?php }?>>
                                       <?php echo $price_icon.$this->home_db->getnumberformat($sellp); ?> 
									 </span> &nbsp;
									 
									 <span class="inr-new <?php echo $nooffer; ?>" <?php if($priceType != 1){?>style="display:none;"<?php }?>>
                                       <i class="fas fa-rupee-sign"></i> <?php echo $this->home_db->getnumberformat($sell); ?> 
									 </span>
									 
									 <span class="usd-new <?php echo $nooffer; ?>" <?php if($priceType != 2){?>style="display:none;"<?php }?>>
                                       <span>&#36;</span> <?php echo $this->home_db->getnumberformat($sel_dollar); ?> 
									 </span>
									 
                                    <span class="price-old"><i class="fas fa-rupee-sign"></i>
                                    <?php echo $this->home_db->getnumberformat($mrp); ?></span><?php } ?>
									<?php /* &nbsp;&nbsp;
									 <span>&#36;</span><?php echo $sel_dollar;?><br/> */?>
									<?php echo $str[0].$str[1];?>
                            </p>

                            <div class="button-group">
                                <a href="javascript:add_cart('<?php echo $p->cpage_url; ?>','<?php echo $p->psid; ?>');"
                                    type="button" data-original-title="Add to cart"><i
                                        class="fas fa-shopping-basket"></i></a>


                                <?php
                                        $wish = 0;
                                        if (!empty($UserDetail)) {
                                            $db = array(
                                                'categ' => $p->cpage_url,
                                                'pid' => $p->pid,
                                                'user_id' => $UserDetail[0]->id
                                            );
                                            $wish = $this->home_db->checkwishlist($db);
                                        }
                                        ?>
                                <a href="javascript:void(0);" data-original-title="Add to Wish List"
                                    wid="<?php echo $p->pid; ?>" id="w<?php echo $p->pid; ?>"
                                    categ="<?php echo $p->cpage_url ?>" <?php if ($wish == 0) { ?>class="awishlist"
                                    title="Add to wishlist" <?php } else { ?> class="added" title="Added to wishlist"
                                    <?php } ?>><i id="icon<?php echo $p->pid ?>"
                                        class="far <?php if ($wish == 0) { ?>fa-heart<?php } else { ?>fa-heart<?php } ?>"></i></a>



                            </div>



                        </div>
                    </div>
                </div>
                <?php 
				   }
                } 
				?>
            </div>
			
			
			
				
				<h1><span>Gift boxes selection</span></h1>
		       <div class="row">    
               <?php 
				if(is_array($gifts)) 
				{  
					foreach ($gifts as $g) 
					{
				?>
					<div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="product-thumb transition">
							<div class="img">

								<div class="image">
									<a href="<?php echo base_url();?>gifts?page=<?=$g->page_url;?>"><img src="<?=$g->image_path;?>"	class="img-responsive center-block"></a>
									<a href="<?php echo base_url();?>gifts?page=<?=$g->page_url;?>">
									<img src="<?=$g->image_path;?>"
									class="img-responsive second-img" alt="hover image"></a>
									
								</div>


							</div>
							
						</div>
					</div>
				
		     <?php 
					}
				}
				?>
			</div>	
				<!--end--->
				
				
		</div>		
				
    </div>	       

           

       
  
  


   <?php /* <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-5 cenapp">
                <div class="neet-effect mat-effect beffect">
                    <a href="<?php echo base_url().'home/collections?page='.$gifts[0]->page_url;?>">
                        <img src="<?php echo base_url().$gifts[0]->image_path;?>" alt="banner"
                            class="img-responsive">
                    </a>
                </div>
            </div>
            <div class="col-sm-8 col-xs-12 banner-top">
                <div class="row">
                    <div class="col-sm-6 col-xs-6">
                        <div class="neet-effect mat-effect beffect">
                            <a href="<?php echo base_url().'home/collections?page='.$gifts[1]->page_url;?>">
                                <img src="<?php echo base_url().$gifts[1]->image_path;?>" alt="banner"
                                    class="img-responsive">
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <div class="neet-effect mat-effect beffect">
                            <a href="<?php echo base_url().'home/collections?page='.$gifts[2]->page_url;?>">
                                <img src="<?php echo base_url().$gifts[2]->image_path;?>" alt="banner"
                                    class="img-responsive">
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 bnrbottom">
                        <div class="neet-effect mat-effect beffect">
                            <a href="<?php echo base_url().'home/collections?page='.$gifts[3]->page_url;?>">
                                <img src="<?php echo base_url().$gifts[3]->image_path;?>" alt="banner"
                                    class="img-responsive">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>*/?>

    <div class="extra-flow">
        <div class="container">
            <div class="delibro">
                <div class="row deliveryinfo text-xs-center">
                    <div class="col-sm-2 col-xs-12 sbr">
                        <ul class="list-unstyled">
                            <li class="ser-svg s1"><span>
                                    <i class="fas fa-phone-alt"></i>
                                </span></li>
                            <li class="text-xs-left">
                                <h4>Need help ? Call</h4>
                                <p>+91 98310 88036</p>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-2 col-xs-12 sbr">
                        <ul class="list-unstyled">
                            <li class="ser-svg s2"><span><i class="fas fa-shipping-fast"></i></span></li>
                            <li class="text-xs-left">
                                <h4>Delivery</h4>
                                <p>Within a week</p>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-2 col-xs-12 sbr">
                        <ul class="list-unstyled">
                            <li class="ser-svg s3"><span><i class="fas fa-mouse-pointer"></i></span></li>
                            <li class="text-xs-left">
                                <h4>Click and collect</h4>
                                <p>Withdrawal in store</p>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-2 col-xs-12 sbr">
                        <ul class="list-unstyled">
                            <li class="ser-svg s4"><span><i class="far fa-credit-card"></i></span></li>
                            <li class="text-xs-left">
                                <h4>Payment</h4>
                                <p>By credit / debit card</p>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-2 col-xs-12 sbr">
                        <ul class="list-unstyled">
                            <li class="ser-svg s5"><span><i class="fas fa-undo"></i></span></li>
                            <li class="text-xs-left">
                                <h4>Return</h4>
                                <p>As per our return policy</p>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <?php if (current_url() == base_url() || current_url() == base_url() . '/home') {
        $testi = $this->home_db->getcontent('testimonials', '', '', '0', 'asc');
		//echo $this->db->last_query();exit;
    ?>
    <div class="testimoni">
        <h1 class="test-hed"><span>Testimonial</span></h1>
        <div class="container">
            <div class="test-t next-prevb">
                <div class="test-bg text-center fproduct row">
                    <div id="testi" class="owl-carousel owl-theme">
                        <?php
						$testi = $this->home_db->getcontent('testimonials', '', '', '0', 'asc');
						if (count($testi)>0) {
                                foreach ($testi as $t) {
                            ?>
                        <div class="item col-xs-12">
                            <div class="content_test">
                                <div class="testi-d">
                                    <div class="text-p">
                                        <img src="<?php echo cdn_url() . $t->image_path; ?>"
                                            class="img-responsive center-block testi1">
                                        <h3><?php echo $t->name ?></h3>
                                        <span class="first-t1"> <?php echo $t->location ?></span>
                                        <p><?php echo $t->comment ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }
                            } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

   <!-- <div class="blog bogbag">
        <div class="blog_webi container">
            <div class="heading text-center">
                <h1><span>Latest Blog</span></h1>
            </div>

            <div class="box-content">
                <div class="box-product row rless">
                    <div id="blog" class="owl-carousel owl-theme">

                        <div class="product-block col-xs-12 cless">
                            <div class="blogshadow">
                                <div class="blog-left">
                                    <div class="webi-blog-image">
                                        <img src="<?php echo asset_url() ?>images/1-1170x648.jpg" alt="Latest Blog"
                                            title="Latest Blog" class="img-responsive">
                                        <div class="blog-post-image-hover"> </div>
                                        <div class="webi_post_hover">
                                            <div class="blog-ic">
                                                <a class="icon zoom" title="Click to view Full Image "
                                                    href="<?php echo asset_url() ?>images/1-1170x648.jpg"
                                                    data-lightbox="example-set"><i class="fa fa-search"></i></a>
                                                <a class="icon readmore_link" title="all blog" href="#"><i
                                                        class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-right text-left">
                                    <h4><a href="#">Croton Plant - Artificial Silk Plant and Tree Range</a></h4>
                                    <h5>1 Comments</h5>
                                    <span class="blog-bag"></span>
                                    <div class="date-time blogdt"><span class="blogda">Aug 24, 2015</span>
                                    </div>
                                    <p>This striking Croton Plant (Codiaeum variegatum) with vibrant
                                        foliage would make a charming addition to the home or workplace...</p>
                                    <a class="read_more btn" href="#">read more</a>

                                </div>

                            </div>
                        </div>

                        <div class="product-block col-xs-12 cless">
                            <div class="blogshadow">
                                <div class="blog-left">
                                    <div class="webi-blog-image">
                                        <img src="<?php echo asset_url() ?>images/2-1170x648.jpg" alt="Latest Blog"
                                            title="Latest Blog" class="img-responsive">
                                        <div class="blog-post-image-hover"> </div>
                                        <div class="webi_post_hover">
                                            <div class="blog-ic">
                                                <a class="icon zoom" title="Click to view Full Image "
                                                    href="<?php echo asset_url() ?>images/2-1170x648.jpg"
                                                    data-lightbox="example-set"><i class="fa fa-search"></i></a>
                                                <a class="icon readmore_link" title="all blog" href="#"><i
                                                        class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-right text-left">
                                    <h4><a href="#">Closer To Nature Artificial Taro Plant</a></h4>
                                    <h5>1 Comments</h5>
                                    <span class="blog-bag"></span>
                                    <div class="date-time blogdt"><span class="blogda">Aug 24, 2015</span>
                                    </div>
                                    <p>This lovely Taro plant has large vibrant leaves and is ideal for both under
                                        planting with other plants or trees and as a fantastic stand-alone feature for
                                        any room.
                                        The plant would make a beautiful addition to the home or workplace....</p>
                                    <a class="read_more btn" href="#">read more</a>

                                </div>

                            </div>
                        </div>

                        <div class="product-block col-xs-12 cless">
                            <div class="blogshadow">
                                <div class="blog-left">
                                    <div class="webi-blog-image">
                                        <img src="<?php echo asset_url() ?>images/3-1170x648.jpg" alt="Latest Blog"
                                            title="Latest Blog" class="img-responsive">
                                        <div class="blog-post-image-hover"> </div>
                                        <div class="webi_post_hover">
                                            <div class="blog-ic">
                                                <a class="icon zoom" title="Click to view Full Image "
                                                    href="<?php echo asset_url() ?>images/3-1170x648.jpg"
                                                    data-lightbox="example-set"><i class="fa fa-search"></i></a>
                                                <a class="icon readmore_link" title="all blog" href="#"><i
                                                        class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-right text-left">
                                    <h4><a href="#">Sunflower Flower Sunshine</a></h4>
                                    <h5>1 Comments</h5>
                                    <span class="blog-bag"></span>
                                    <div class="date-time blogdt"><span class="blogda">Aug 24, 2015</span>
                                    </div>
                                    <p>These bright, big-faced flowers are one of the most loved flowers of all. The
                                        Sunflower
                                        is known to move its head alongwith the changing direction of the Sun...</p>
                                    <a class="read_more btn" href="#">read more</a>

                                </div>

                            </div>
                        </div>

                        <div class="product-block col-xs-12 cless">
                            <div class="blogshadow">
                                <div class="blog-left">
                                    <div class="webi-blog-image">
                                        <img src="<?php echo asset_url() ?>images/3-1170x648.jpg" alt="Latest Blog"
                                            title="Latest Blog" class="img-responsive">
                                        <div class="blog-post-image-hover"> </div>
                                        <div class="webi_post_hover">
                                            <div class="blog-ic">
                                                <a class="icon zoom" title="Click to view Full Image "
                                                    href="<?php echo asset_url() ?>images/3-1170x648.jpg"
                                                    data-lightbox="example-set"><i class="fa fa-search"></i></a>
                                                <a class="icon readmore_link" title="all blog" href="#"><i
                                                        class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-right text-left">
                                    <h4><a href="#">Sunflower Flower Sunshine</a></h4>
                                    <h5>1 Comments</h5>
                                    <span class="blog-bag"></span>
                                    <div class="date-time blogdt"><span class="blogda">Aug 24, 2015</span>
                                    </div>
                                    <p>These bright, big-faced flowers are one of the most loved flowers of all. The
                                        Sunflower
                                        is known to move its head alongwith the changing direction of the Sun...</p>
                                    <a class="read_more btn" href="#">read more</a>

                                </div>

                            </div>
                        </div>


                        <div class="product-block col-xs-12 cless">
                            <div class="blogshadow">
                                <div class="blog-left">
                                    <div class="webi-blog-image">
                                        <img src="<?php echo asset_url() ?>images/3-1170x648.jpg" alt="Latest Blog"
                                            title="Latest Blog" class="img-responsive">
                                        <div class="blog-post-image-hover"> </div>
                                        <div class="webi_post_hover">
                                            <div class="blog-ic">
                                                <a class="icon zoom" title="Click to view Full Image "
                                                    href="<?php echo asset_url() ?>images/3-1170x648.jpg"
                                                    data-lightbox="example-set"><i class="fa fa-search"></i></a>
                                                <a class="icon readmore_link" title="all blog" href="#"><i
                                                        class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-right text-left">
                                    <h4><a href="#">Sunflower Flower Sunshine</a></h4>
                                    <h5>1 Comments</h5>
                                    <span class="blog-bag"></span>
                                    <div class="date-time blogdt"><span class="blogda">Aug 24, 2015</span>
                                    </div>
                                    <p>These bright, big-faced flowers are one of the most loved flowers of all. The
                                        Sunflower
                                        is known to move its head alongwith the changing direction of the Sun...</p>
                                    <a class="read_more btn" href="#">read more</a>

                                </div>

                            </div>
                        </div>


                        <div class="product-block col-xs-12 cless">
                            <div class="blogshadow">
                                <div class="blog-left">
                                    <div class="webi-blog-image">
                                        <img src="<?php echo asset_url() ?>images/3-1170x648.jpg" alt="Latest Blog"
                                            title="Latest Blog" class="img-responsive">
                                        <div class="blog-post-image-hover"> </div>
                                        <div class="webi_post_hover">
                                            <div class="blog-ic">
                                                <a class="icon zoom" title="Click to view Full Image "
                                                    href="<?php echo asset_url() ?>images/3-1170x648.jpg"
                                                    data-lightbox="example-set"><i class="fa fa-search"></i></a>
                                                <a class="icon readmore_link" title="all blog" href="#"><i
                                                        class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-right text-left">
                                    <h4><a href="#">Sunflower Flower Sunshine</a></h4>
                                    <h5>1 Comments</h5>
                                    <span class="blog-bag"></span>
                                    <div class="date-time blogdt"><span class="blogda">Aug 24, 2015</span>
                                    </div>
                                    <p>These bright, big-faced flowers are one of the most loved flowers of all. The
                                        Sunflower
                                        is known to move its head alongwith the changing direction of the Sun...</p>
                                    <a class="read_more btn" href="#">read more</a>

                                </div>

                            </div>
                        </div>


                        <div class="product-block col-xs-12 cless">
                            <div class="blogshadow">
                                <div class="blog-left">
                                    <div class="webi-blog-image">
                                        <img src="<?php echo asset_url() ?>images/3-1170x648.jpg" alt="Latest Blog"
                                            title="Latest Blog" class="img-responsive">
                                        <div class="blog-post-image-hover"> </div>
                                        <div class="webi_post_hover">
                                            <div class="blog-ic">
                                                <a class="icon zoom" title="Click to view Full Image "
                                                    href="<?php echo asset_url() ?>images/3-1170x648.jpg"
                                                    data-lightbox="example-set"><i class="fa fa-search"></i></a>
                                                <a class="icon readmore_link" title="all blog" href="#"><i
                                                        class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-right text-left">
                                    <h4><a href="#">Sunflower Flower Sunshine</a></h4>
                                    <h5>1 Comments</h5>
                                    <span class="blog-bag"></span>
                                    <div class="date-time blogdt"><span class="blogda">Aug 24, 2015</span>
                                    </div>
                                    <p>These bright, big-faced flowers are one of the most loved flowers of all. The
                                        Sunflower
                                        is known to move its head alongwith the changing direction of the Sun...</p>
                                    <a class="read_more btn" href="#">read more</a>

                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>-->



    <?php if (is_array($clients)) { ?>
    <!-- <CIENTS> ================================= -->
    <!--<div class="clients-list">
        <div class="container">
            <div id="clients" class="owl-carousel">
                <?php foreach ($clients as $c) { ?>
                <div class="img">
                    <div class="img_box">
                        <div class="img_src"> <img alt="<?php echo $c->name ?>"
                                src="<?php echo cdn_url() . $c->client_image; ?>"> </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- END </CIENTS>  -->
    <?php } ?>

    <?php echo $footer; ?>



</body>


<script src="<?php echo asset_url() ?>js/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>js/jquery.elevatezoom.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>js/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>js/animate.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>js/lightbox-2.6.min.js" type="text/javascript"></script>
<script src='<?php echo asset_url() ?>js/artii.js'></script>
<script src='<?php echo asset_url() ?>js/sams.js'></script>
<script src="<?php echo asset_url() ?>js/script.js"></script>



<!-- 
<script src="<?php echo asset_url() ?>js/jquery-1.7.1.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo asset_url() ?>js/owl.carousel.min.js"></script> -->
<?php echo $jsFile; ?>
<script type="text/javascript">
$(document).ready(function() {
    var banner = $("#banner");
    banner.owlCarousel({
        autoPlay: 5000,
        stopOnHover: true,
        paginationSpeed: 400,
        slideSpeed: 300,
        singleItem: true,
        autoHeight: true,
    });
    var category_info_slider = $("#category_info_slider");
    category_info_slider.owlCarousel({
        autoPlay: 3000,
        stopOnHover: true,
        paginationSpeed: 400,
        slideSpeed: 300,
        itemsCustom: [
            [0, 1],
            [400, 2],
            [768, 3],
            [992, 3],
            [1200, 3],
            [1600, 3]
        ],
        autoHeight: true,
    });
    var special_product_sl = $("#special_product_sl");
    special_product_sl.owlCarousel({
        autoPlay: false,
        stopOnHover: true,
        paginationSpeed: 400,
        slideSpeed: 300,
        itemsCustom: [
            [0, 1],
            [400, 2],
            [768, 3],
            [992, 4],
            [1200, 5],
            [1600, 5]
        ],
        autoHeight: true,
    });
    $(".special_product .next").click(function() {
        special_product_sl.trigger('owl.next');
    })
    $(".special_product .prev").click(function() {
        special_product_sl.trigger('owl.prev');
    })
    var clients = $("#clients");
    clients.owlCarousel({
        autoPlay: 6000,
        stopOnHover: true,
        paginationSpeed: 400,
        pagination: false,
        slideSpeed: 300,
        itemsCustom: [
            [0, 1],
            [400, 2],
            [768, 3],
            [992, 4],
            [1200, 5],
            [1600, 5]
        ],
        autoHeight: true,
    });
    var testimonial = $("#testimonial");
    testimonial.owlCarousel({
        autoPlay: true,
        stopOnHover: true,
        paginationSpeed: 400,
        slideSpeed: 300,
        singleItem: true,
        autoHeight: true,
    });
    $('.btns').hover(function() {
        $(this).find('.text').show().stop().animate({
            top: '-11px'
        }, 300);
    }, function() {
        $(this).find('.text').hide().stop().animate({
            top: '50%'
        }, 300);
    });
});
</script>
<script>
$(document).ready(function() {
    $("#testi").owlCarousel({
        itemsCustom: [
            [0, 1],
            [768, 2],
            [992, 2],
            [1200, 2]
        ],
        autoPlay: false,
        navigationText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        navigation: false,
        pagination: true
    });
});
</script>
<script type="text/javascript">
(function($) {
    $("#blog").owlCarousel({
        itemsCustom: [
            [0, 1],
            [600, 2],
            [768, 2],
            [992, 2],
            [1200, 3],
            [1410, 3]
        ],
        navigationText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>'],
        navigation: true,
        pagination: false
    });
}(jQuery));
</script>



</body>

</html>