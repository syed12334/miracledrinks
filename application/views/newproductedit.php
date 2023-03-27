<?php //echo "<pre>";print_r($pimages);exit; 
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD-->

<head>
	<meta charset="UTF-8" />
	<title><?php echo title; ?></title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<![endif]-->
	<!-- GLOBAL STYLES -->
	<!-- GLOBAL STYLES -->
	<link rel="stylesheet" href="<?php echo asset_url(); ?>css/style.min.css" />
	<!-- <link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo asset_url(); ?>css/main.css" />
		<link rel="stylesheet" href="<?php echo asset_url(); ?>css/theme.css" />
		<link rel="stylesheet" href="<?php echo asset_url(); ?>css/MoneAdmin.css" />
		<link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/Font-Awesome/css/font-awesome.css" /> -->
	<link rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-fileupload.min.css" />
	<link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css" />
	<link rel="stylesheet" href="<?php echo asset_url(); ?>css/Markdown.Editor.hack.css" />
	<!--<link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/CLEditor1_4_3/jquery.cleditor.css" />
		<link rel="stylesheet" href="<?php echo asset_url(); ?>css/jquery.cleditor-hack.css" />-->
	<link rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-wysihtml5-hack.css" />

	<style>
		#accordion .card-header {
			background-color: #ccc;
		}

		font {
			font-size: 10px;
			font-weight: 400;
		}

		#collapseOne {
			display: none
		}
		#category-error {
			color:red;
			padding-top:5px;
		}
		#subcateg-error {
			color:red;
			padding-top:5px;
		}
		#pname-error {
			color:red;
			padding-top:5px;
		}
		#ptitle-error {
			color:red;
			padding-top:5px;
		}
		#pcodes-error {
			color:red;
			padding-top:5px;
		}
		#mrps-error {
			color:red;
			padding-top:5px;
		}
		#stocks-error {
			color:red;
			padding-top:5px;
		}
		#sellingprices-error {
			color:red;
			padding-top:5px;
		}
		#overviews-error {
			color:red;
			padding-top:5px;
		}
		#pcode1-error {
			color:red;
			padding-top:5px;
		}
		#stock1-error {
			color:red;
			padding-top:5px;
		}
		#sellingprice1-error {
			color:red;
			padding-top:5px;
		}
		#overview1-error {
			color:red;
			padding-top:5px;
		}
		#mrp1-error {
			color:red;
			padding-top:5px;
		}
			#pcode2-error {
			color:red;
			padding-top:5px;
		}
		#stock2-error {
			color:red;
			padding-top:5px;
		}
		#sellingprice2-error {
			color:red;
			padding-top:5px;
		}
		#overview2-error {
			color:red;
			padding-top:5px;
		}
		#mrp2-error {
			color:red;
			padding-top:5px;
		}
			#pcode3-error {
			color:red;
			padding-top:5px;
		}
		#stock3-error {
			color:red;
			padding-top:5px;
		}
		#sellingprice3-error {
			color:red;
			padding-top:5px;
		}
		#overview3-error {
			color:red;
			padding-top:5px;
		}
		#mrp3-error {
			color:red;
			padding-top:5px;
		}
		#headingOne {
			display: none;
		}
		#heading1 {
			display: none;
		}
		#heading2 {
			display: none;
		}
		
			#topSuccess {
				display: none;
				position: fixed;
				right:20px;
				top:50px;
				background:green;
				z-index:9999999999!important;
				padding: 10px 20px;
				color:#fff;
				border-radius:5px;

			}

	</style>
	<?php echo $updatelogin; ?>
</head>
<!-- END  HEAD-->
<!-- BEGIN BODY-->

<body class="padTop53 ">
	<div id="topSuccess">Saving please wait....</div>
	<div id="wrap">
		<div id="main-wrapper">
			<!-- HEADER SECTION -->
			<?php echo $header; ?>
			<!-- END HEADER SECTION -->
			<!-- MENU SECTION -->
			<?php echo $left; ?>
			<!--END MENU SECTION -->
			<div class="page-wrapper">
				<!--============================================================== -->
				<!-- Bread crumb and right sidebar toggle -->
				<!-- ============================================================== -->
				<div class="row page-titles">
					<div class="col-md-5 col-12 align-self-center">
						<h3 class="text-themecolor mb-0">Products</h3>
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
							<li class="breadcrumb-item active">Products</li>
						</ol>
					</div>
					<div class="col-md-7 col-12 align-self-center d-none d-md-block">
					</div>
				</div>
				<div class="container-fluid" id="content">
					<div class="inner" style="min-height:1200px;">
						<div class="row">
<?php

	$ars = array();
	foreach ($productpackage as $key => $value) {
		$ars[] = $value->package_id;
	}

?>


						
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h5>Edit details</h5>
							</div>
							<div id="success"></div>
							<div id="submitFormData"></div>
							<?php echo $this->session->flashdata('message');?>
							<form class="form-horizontal form-material row" id="organization_validate"  method="post" enctype="multipart/form-data">
								<div class=" row" style="padding:35px 35px 0 35px;">
									<div class="form-group col-md-4">
										<label>Category<span style="color:red">*</span></label>
									<select id="category" name="category" class="form-control">
																<option value="">--Select--</option>
																<?php if (is_array($category)) {
																	foreach ($category as $c) {
																?><option value="<?php echo $c->id ?>" <?php if ($c->id == $details[0]->cat_id) { ?>selected="selected" <?php } ?>><?php echo $c->name ?></option> <?php }
																																} ?>
															</select>
															<div id="categoryError"></div>

									</div>
									<div class="form-group col-md-4">
										<label>Subcategory<span style="color:red">*</span></label>
									<select name="subcateg" id="subcateg" class="form-control" onchange="getsubsubcateg(this.value);">
																<option value="">--Select--</option>
																<?php 
																	if(count($subcategory)) {
																		foreach ($subcategory as $key => $value) {
																			?>
																			<option value="<?= $value->id;?>" <?php 
																				if($value->id == $products[0]->subcat_id) {
																					echo "selected";
																				}
																			?>><?= $value->name;?></option>
																			<?php
																		}
																	}
																?>
															</select>
<div id="subError"></div>
									</div>
									<div class="form-group col-md-4">
										<label>Sub Sub Category</label>
										<select name="sub_sub_id" id="sub_sub_id" class="form-control">
																<option value="">--Select--</option>
															</select>

									</div>

									<div class="form-group col-md-4">
										<label>Product Name<span style="color:red">*</span></label>
										<input type="text" class="form-control" name="pname" id="pname" value="<?= $products[0]->name?>">
<div id="pnameError"></div>
<input type="hidden" name="pid" value="<?= $products[0]->id?>">
									</div>

									<div class="form-group col-md-4">
										<label>Product Title<span style="color:red">*</span></label>
										<input type="text" class="form-control" name="ptitle" id="ptitle" value="<?= $products[0]->ptitle?>"/>
										<div id="ptitleError"></div>
									</div>
									<div class="form-group col-md-4">
										<label>TAX</label>
										<input type="text" class="form-control" name="tax" id="tax" value="<?= $products[0]->tax?>"/>

									</div>
							<?php 
								foreach ($pimages as $value) {
										?>
										<input type="hidden" name="pnone[]" value="<?= $value->piid?>">
										<?php							
								}
							?>

								<?php 
								foreach ($pimagesgold as $value) {
										?>
										<input type="hidden" name="pgold[]" value="<?= $value->piid?>">
										<?php							
								}
							?>

								<?php 
								foreach ($pimagessilver as $value) {
										?>
										<input type="hidden" name="psilver[]" value="<?= $value->piid?>">
										<?php							
								}
							?>

								<?php 
								foreach ($pimagesnormal as $value) {
										?>
										<input type="hidden" name="pnormal[]" value="<?= $value->piid?>">
										<?php							
								}
							?>

									<div class="col-md-12">

										<div class="form-group">

											<?php
												if(count($package)) {
													foreach ($package as $pack) {
														$id = $pack->id;
														?>
														<div class="form-check form-check-inline">
												<input class="form-check-input material-inputs" name="package[]" type="checkbox" id="inlineCheckbox<?php echo $pack->id; ?>" value="<?php echo $pack->id; ?>" <?php 
														if(in_array($pack->id, $ars)) {
															echo "checked";
														}
												?>>
												<label class="form-check-label" for="inlineCheckbox<?php echo $pack->id; ?>" ><?php echo $pack->pname; ?></label>
											</div>
														<?php
													}
												}
											?>
										</div>
									</div>

									<?php if(in_array(7, $ars)) {?>
									
											<div id="newshow" style="display: block">
										<div class="row" style="padding:15px">


											<div class="form-group col-md-3">
												<label>Product Code <span style="color:red">*</span></label>
												<input type="text" class="form-control" name="pcodes" id="pcodes" value="<?= $productpackagenone[0]->pcode?>" required/>
												<div id="pcodeError"></div>

											</div>

											<div class="form-group col-md-3">
												<label>MRP<span style="color:red">*</span></label>
												<input type="number" class="form-control" name="mrps" id="mrps" value="<?= $productpackagenone[0]->mrp?>" />
												<div id="mrpError"></div>
											</div>

											<div class="form-group col-md-3">
												<label>Selling price<span style="color:red">*</span></label>
												<input type="number" class="form-control" name="sellingprices" id="sellingprices" value="<?= $productpackagenone[0]->sellingprice?>" />
												<div id="sellingError"></div>
											</div>

											<div class="form-group col-md-3">
												<label>Stock<span style="color:red">*</span></label>
												<input type="number" class="form-control" name="stocks" id="stocks" value="<?= $productpackagenone[0]->stock?>" />
												<div id="stockError"></div>
											</div>




											<div class="col-6">
												<div class="form-group">
													<label class="control-label">Overview<span style="color:red">*</span></label>
													<textarea class="form-control" name="overviews" id="overviews"><?= $productpackagenone[0]->overview?></textarea>
												</div>
												<div id="overviewError"></div>
											</div>

											<div class="col-6">
												<div class="form-group">
													<label class="control-label">Meta Description
														<font style="color: red;">*</font>
													</label>
													<textarea class="form-control" id="mtdess" name="mtdess"><?= $productpackagenone[0]->mdesc?></textarea>
												</div>
											</div>



											<div class="col-12">
												<table class="table table-bordered ">
													<thead>
													<th width="100px">Order No</th>
														<th>Thumbnail Image <span style="color:red">*</span><br>
															<font color="#008b8b">[Note:
																Size should be 200 x 240 px]
															</font>
														</th>
														<th>Small Image <span style="color:red">*</span><br>
															<font color="#008b8b">[Note:
																Size should be 200 x 240 px]
															</font>
														</th>
														<th>Medium Image<span style="color:red">*</span> <br>
															<font color="#008b8b">[Note:
																Size should be 400 x 400 px]
															</font>
														</th>
														<th>Large Image <span style="color:red">*</span><br>
															<font color="#008b8b">[Note:
																Size should be 800 x 800 px]
															</font>
														</th>

													</thead>
													<tbody id="i">
														<?php 
															if(count($pimages)) {
																foreach ($pimages as $img) {
																	?>
																		<tr>
															<td><input type="text" name="orderno[]" id="orderno" class="form-control onlynumbers" placeholder="Order No" value="1" /></td>
															<td>
																<div class="fileupload fileupload-new" data-provides="fileupload">
																	<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																		<img src="<?php echo front_url() . $img->thumb; ?>">
																	</div>
																	<div>
																		<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																				image</span><span class="fileupload-exists">Change</span>
																			<input type="file" name="galthumbs[]" id="galthumbs" /></span>

																		<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																		<input type="hidden" id="gimgstat" name="gimgstat[]" value="0">
																		<label id="imagegalnew" ></label>
																	</div>
																</div>
															</td>


															<td>
																<div class="fileupload fileupload-new" data-provides="fileupload">
																	<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																		<img src="<?php echo front_url(). $img->image_path; ?>">
																	</div>
																	<div>
																		<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																				image</span><span class="fileupload-exists">Change</span>
																			<input type="file" name="galsmalls[]" id="galsmalls" /></span>
																		<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																		<input type="hidden" name="gimgid" value="0">
																		<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																	</div>
																</div>
															</td>

															<td>
																<div class="fileupload fileupload-new" data-provides="fileupload">
																	<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																		<img src="<?php echo front_url(). $img->image_medium; ?>">
																	</div>
																	<div>
																		<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																				image</span><span class="fileupload-exists">Change</span>
																			<input type="file" name="galmedius[]" id="galmedius" /></span>
																		<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																		<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																	</div>
																</div>
															</td>

															<td>
																<div class="fileupload fileupload-new" data-provides="fileupload">
																	<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																		<img src="<?php echo front_url(). $img->image_large; ?>">
																	</div>
																	<div>
																		<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																				image</span><span class="fileupload-exists">Change</span>
																			<input type="file" name="gallarges[]" id="gallarges" /></span>
																		<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																		<input type="hidden" id="gimgstat" name="gimgstat2" value="0">
																	</div>
																</div>
															</td>

														<td class="mininwidth text-center">
																				<span id="newr" onClick="addmoreimag();" class="btn btn-info"><i class="fas fa-plus"></i></span>
																			</td>

														</tr>
																	<?php
																}
															}
														?>
													

													</tbody>
												</table>
													<div class="row">
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Name
																</label>
																<input type="text" class="form-control" id="sname1" name="snames" value="<?= $productpackagenone[0]->sname?>" />
															</div>
														</div>
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Value
																</label>
																<input type="text" class="form-control" id="svalue1" name="svalues" value="<?= $productpackagenone[0]->svalue?>"/>
															</div>
														</div>
													</div>
											</div>

										
										</div>



									</div>
								<?php }else {
									?>

											<div id="newshow" style="display: none">
										<div class="row" style="padding:15px">


											<div class="form-group col-md-3">
												<label>Product Code <span style="color:red">*</span></label>
												<input type="text" class="form-control" name="pcodes" id="pcodes"  required/>
												<div id="pcodeError"></div>

											</div>

											<div class="form-group col-md-3">
												<label>MRP<span style="color:red">*</span></label>
												<input type="number" class="form-control" name="mrps" id="mrps" />
												<div id="mrpError"></div>
											</div>

											<div class="form-group col-md-3">
												<label>Selling price<span style="color:red">*</span></label>
												<input type="number" class="form-control" name="sellingprices" id="sellingprices"  />
												<div id="sellingError"></div>
											</div>

											<div class="form-group col-md-3">
												<label>Stock<span style="color:red">*</span></label>
												<input type="number" class="form-control" name="stocks" id="stocks" value="" />
												<div id="stockError"></div>
											</div>




											<div class="col-6">
												<div class="form-group">
													<label class="control-label">Overview<span style="color:red">*</span></label>
													<textarea class="form-control" name="overviews" id="overviews"></textarea>
												</div>
												<div id="overviewError"></div>
											</div>

											<div class="col-6">
												<div class="form-group">
													<label class="control-label">Meta Description
														<font style="color: red;">*</font>
													</label>
													<textarea class="form-control" id="mtdess" name="mtdess"></textarea>
												</div>
											</div>



											<div class="col-12">
												<table class="table table-bordered ">
													<thead>
													<th width="100px">Order No</th>
														<th>Thumbnail Image <span style="color:red">*</span><br>
															<font color="#008b8b">[Note:
																Size should be 200 x 240 px]
															</font>
														</th>
														<th>Small Image <span style="color:red">*</span><br>
															<font color="#008b8b">[Note:
																Size should be 200 x 240 px]
															</font>
														</th>
														<th>Medium Image<span style="color:red">*</span> <br>
															<font color="#008b8b">[Note:
																Size should be 400 x 400 px]
															</font>
														</th>
														<th>Large Image <span style="color:red">*</span><br>
															<font color="#008b8b">[Note:
																Size should be 800 x 800 px]
															</font>
														</th>

													</thead>
													<tbody id="i">
													
																		<tr>
															<td><input type="text" name="orderno[]" id="orderno" class="form-control onlynumbers" placeholder="Order No" value="1" /></td>
															<td>
																<div class="fileupload fileupload-new" data-provides="fileupload">
																	<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																	</div>
																	<div>
																		<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																				image</span><span class="fileupload-exists">Change</span>
																			<input type="file" name="galthumbs[]" id="galthumbs" /></span>

																		<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																		<input type="hidden" id="gimgstat" name="gimgstat[]" value="0">
																		<label id="imagegalnew" ></label>
																	</div>
																</div>
															</td>


															<td>
																<div class="fileupload fileupload-new" data-provides="fileupload">
																	<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																	</div>
																	<div>
																		<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																				image</span><span class="fileupload-exists">Change</span>
																			<input type="file" name="galsmalls[]" id="galsmalls" /></span>
																		<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																		<input type="hidden" name="gimgid" value="0">
																		<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																	</div>
																</div>
															</td>

															<td>
																<div class="fileupload fileupload-new" data-provides="fileupload">
																	<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																	</div>
																	<div>
																		<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																				image</span><span class="fileupload-exists">Change</span>
																			<input type="file" name="galmedius[]" id="galmedius" /></span>
																		<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																		<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																	</div>
																</div>
															</td>

															<td>
																<div class="fileupload fileupload-new" data-provides="fileupload">
																	<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																	</div>
																	<div>
																		<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																				image</span><span class="fileupload-exists">Change</span>
																			<input type="file" name="gallarges[]" id="gallarges" /></span>
																		<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																		<input type="hidden" id="gimgstat" name="gimgstat2" value="0">
																	</div>
																</div>
															</td>

														<td class="mininwidth text-center">
																				<span id="newr" onClick="addmoreimag();" class="btn btn-info"><i class="fas fa-plus"></i></span>
																			</td>

														</tr>
															
													

													</tbody>
												</table>
													<div class="row">
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Name
																</label>
																<input type="text" class="form-control" id="sname1" name="snames" value="" />
															</div>
														</div>
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Value
																</label>
																<input type="text" class="form-control" id="svalue1" name="svalues" value=""/>
															</div>
														</div>
													</div>
											</div>

										
										</div>



									</div>
									<?php
								}?>
								</div>
							


								<div id="accordion" class="col-lg-12" style="padding-bottom: 0px!important">
									<div class="card  col-lg-12">
										<?php 
													if(in_array(1, $ars)) {
														?>
															<div class="card-header" id="headingOne" style="display: block!important">
											<h5 class="mb-0">
												
														<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="0" style="display: block!important">Gold Package </button>
														
														
													
												
											</h5>
										</div>
														<?php
													}else {
														?>
																<div class="card-header" id="headingOne" style="display: none!important">
											<h5 class="mb-0">
												
														<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="0" style="display: block!important">Gold Package </button>
														
														
													
												
											</h5>
										</div>
															<?php
													}

												?>
									
										<?php if(in_array(1, $ars)) { ?> 
										<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="<?php if(in_array(1, $ars)) {echo 'display:block';}else {echo 'display:none';}?>">
												
											<div class="card-body">
												<div class=" row">
													<div class="form-group col-md-3">
														<label>Product Code<span style="color:red">*</span></label>
														<input type="text" class="form-control" name="pcode1" id="pcode1" value="<?= $productpackagegold[0]->pcode; ?>" />
														<div id="pcodeError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>MRP<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="mrp1" id="mrp1" value="<?= $productpackagegold[0]->mrp; ?>"/>
														<div id="mrpError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>Selling price<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="sellingprice1" id="sellingprice1" value="<?= $productpackagegold[0]->sellingprice; ?>"/>
														<div id="sellingError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>Stock<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="stock1" id="stock1" value="<?= $productpackagegold[0]->stock; ?>"/>
														<div id="stockError"></div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label class="control-label">Overview<span style="color:red">*</span></label>
															<textarea class="form-control" id="overview1" name="overview1"><?= $productpackagegold[0]->overview; ?></textarea>
														</div>
														<div id="overviewError"></div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label class="control-label">Meta Description
																<font style="color: red;">*</font>
															</label>
															<textarea class="form-control" id="mtdesc1" name="mtdesc1"><?= $productpackagegold[0]->mdesc; ?></textarea>
														</div>
													</div>
												</div>

												<div class="">
													<table class="table table-bordered ">
														<thead>
														<th width="100px">Order No</th>
															<th>Thumbnail Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 200 x 240 px]
																</font>
															</th>
															<th>Small Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 200 x 240 px]
																</font>
															</th>
															<th>Medium Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 400 x 400 px]
																</font>
															</th>
															<th>Large Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 800 x 800 px]
																</font>
															</th>

														</thead>
														<tbody id="j">
<?php 
															if(count($pimagesgold)) {
																foreach ($pimagesgold as $img) {
																	?>
															<tr>
																<td><input type="text" name="orderno1[]" id="orderno4" class="form-control onlynumbers" placeholder="Order No" value="1" /></td>
																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			<img src="<?php echo front_url() . $img->thumb; ?>">
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galthumb1[]" id="galthumb1" /></span>

																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>


																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			<img src="<?php echo front_url(). $img->image_path; ?>">
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galsmall1[]" id="galsmall1" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" name="gimgid" value="0">
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>

																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			<img src="<?php echo front_url(). $img->image_medium; ?>">
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galmedium1[]" id="galmedium1" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>

																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			<img src="<?php echo front_url(). $img->image_large; ?>">
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="gallarge1[]" id="gallarge1" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat2" value="0">
																		</div>
																	</div>
																</td>

	<td class="mininwidth text-center">
																				<span id="newr" onClick="addmoregold();" class="btn btn-info"><i class="fas fa-plus"></i></span>
																			</td>

															</tr>
<?php }
 }
 ?>
														</tbody>
													</table>
														<div class="row">
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Name
																</label>
																<input type="text" class="form-control" id="sname1" name="sname1" value="<?= $productpackagegold[0]->sname; ?>" />
															</div>
														</div>
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Value
																</label>
																<input type="text" class="form-control" id="svalue1" name="svalue1" value="<?= $productpackagegold[0]->svalue; ?>" />
															</div>
														</div>
													</div>
												</div>
<div class="col-12">
												
											</div>
											</div>
										
										</div>
									<?php }else {

										?>
											<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
												
											<div class="card-body">
												<div class=" row">
													<div class="form-group col-md-3">
														<label>Product Code<span style="color:red">*</span></label>
														<input type="text" class="form-control" name="pcode1" id="pcode1" value="" />
														<div id="pcodeError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>MRP<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="mrp1" id="mrp1" value=""/>
														<div id="mrpError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>Selling price<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="sellingprice1" id="sellingprice1" value=""/>
														<div id="sellingError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>Stock<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="stock1" id="stock1" value=""/>
														<div id="stockError"></div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label class="control-label">Overview<span style="color:red">*</span></label>
															<textarea class="form-control" id="overview1" name="overview1"></textarea>
														</div>
														<div id="overviewError"></div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label class="control-label">Meta Description
																<font style="color: red;">*</font>
															</label>
															<textarea class="form-control" id="mtdesc1" name="mtdesc1"></textarea>
														</div>
													</div>
												</div>

												<div class="">
													<table class="table table-bordered ">
														<thead>
														<th width="100px">Order No</th>
															<th>Thumbnail Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 200 x 240 px]
																</font>
															</th>
															<th>Small Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 200 x 240 px]
																</font>
															</th>
															<th>Medium Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 400 x 400 px]
																</font>
															</th>
															<th>Large Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 800 x 800 px]
																</font>
															</th>

														</thead>
														<tbody id="j">

															<tr>
																<td><input type="text" name="orderno1[]" id="orderno4" class="form-control onlynumbers" placeholder="Order No" value="1" /></td>
																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																		
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galthumb1[]" id="galthumb1" /></span>

																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>


																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galsmall1[]" id="galsmall1" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" name="gimgid" value="0">
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>

																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galmedium1[]" id="galmedium1" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>

																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																		
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="gallarge1[]" id="gallarge1" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat2" value="0">
																		</div>
																	</div>
																</td>

	<td class="mininwidth text-center">
																				<span id="newr" onClick="addmoregold();" class="btn btn-info"><i class="fas fa-plus"></i></span>
																			</td>

															</tr>

														</tbody>
													</table>
														<div class="row">
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Name
																</label>
																<input type="text" class="form-control" id="sname1" name="sname1"  />
															</div>
														</div>
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Value
																</label>
																<input type="text" class="form-control" id="svalue1" name="svalue1" />
															</div>
														</div>
													</div>
												</div>
<div class="col-12">
												
											</div>
											</div>
										
										</div>
										<?php
									} ?>
									</div>
									<div class="card  col-lg-12">
										<?php 
													if(in_array(2, $ars)) {
														?>
															<div class="card-header" id="heading1"  style="display: block!important">
											<h5 class="mb-0">
													
														<button class="btn btn-link collapsed " data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1" id="1">
													Silver Package </button>
													
														
													
												
											</h5>
										</div>
															<?php

													}else {
														?>
															<div class="card-header" id="heading1"  style="display: none!important">
											<h5 class="mb-0">
													
														<button class="btn btn-link collapsed " data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1" id="1">
													Silver Package </button>
													
														
													
												
											</h5>
										</div>
															<?php
													}
													?>
									
										<?php if(in_array(2, $ars)) { ?>
										<div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordion" style="<?php if(in_array(2, $ars)) {echo 'display:block';}else {echo 'display:none';}?>">
											
											<div class="card-body">
											<div class=" row">
													<div class="form-group col-md-3">
														<label>Product Code<span style="color:red">*</span></label>
														<input type="text" class="form-control" name="pcode2" id="pcode2" value="<?= $productpackagesilver[0]->pcode;?>" />
														<div id="pcodeError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>MRP<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="mrp2" id="mrp2" value="<?= $productpackagesilver[0]->mrp;?>"/>
														<div id="mrpError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>Selling price<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="sellingprice2" id="sellingprice2" value="<?= $productpackagesilver[0]->sellingprice;?>"/>
														<div id="sellingError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>Stock<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="stock2" id="stock2" value="<?= $productpackagesilver[0]->stock;?>"/>
														<div id="stockError"></div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label class="control-label">Overview<span style="color:red">*</span><font style="color: red;">*</font></label>
															<textarea class="form-control" id="overview2" name="overview2"><?= $productpackagesilver[0]->overview;?></textarea>
														</div>
														<div id="overviewError"></div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label class="control-label">Meta Description
															</label>
															<textarea class="form-control" id="mtdesc2" name="mtdesc2"><?= $productpackagesilver[0]->mdesc;?></textarea>
														</div>
													</div>
												</div>




												<div class="">
													<table class="table table-bordered ">
														<thead>
														<th width="100px">Order No</th>
															<th>Thumbnail Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 200 x 240 px]
																</font>
															</th>
															<th>Small Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 200 x 240 px]
																</font>
															</th>
															<th>Medium Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 400 x 400 px]
																</font>
															</th>
															<th>Large Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 800 x 800 px]
																</font>
															</th>

														</thead>
														<tbody id="k">
<?php 
															if(count($pimagessilver)) {
																foreach ($pimagessilver as $img) {
																	?>
															<tr>
																<td><input type="text" name="orderno2[]" id="orderno1" class="form-control onlynumbers" placeholder="Order No" value="1" /></td>
																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			<img src="<?php echo front_url() . $img->thumb; ?>">
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galthumb2[]" id="galthumb2" /></span>

																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>


																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			<img src="<?php echo front_url(). $img->image_path; ?>">
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galsmall2[]" id="galsmall2" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" name="gimgid[]" value="0">
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>

																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			<img src="<?php echo front_url(). $img->image_medium; ?>">
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galmedium2[]" id="galmedium2" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>

																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			<img src="<?php echo front_url(). $img->image_large; ?>">
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="gallarge2[]" id="gallarge2" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat2" value="0">
																		</div>
																	</div>
																</td>

	<td class="mininwidth text-center">
																				<span id="newr" onClick="addmoresilver();" class="btn btn-info"><i class="fas fa-plus"></i></span>
																			</td>

															</tr>

															<?php 

														}
													} ?>

														</tbody>
													</table>
													<div class="row">
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Name
																</label>
																<input type="text" class="form-control" id="sname2" name="sname2" value="<?= $productpackagesilver[0]->sname;?>" />
															</div>
														</div>
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Value
																</label>
																<input type="text" class="form-control" id="svalue2" name="svalue2" value="<?= $productpackagesilver[0]->svalue;?>" />
															</div>
														</div>
													</div>
												</div>
<div class="col-12">
											
											</div>
											
											</div>
									
										</div>
									<?php }else {

								?>
												<div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordion">
											
											<div class="card-body">
											<div class=" row">
													<div class="form-group col-md-3">
														<label>Product Code<span style="color:red">*</span></label>
														<input type="text" class="form-control" name="pcode2" id="pcode2" />
														<div id="pcodeError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>MRP<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="mrp2" id="mrp2" />
														<div id="mrpError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>Selling price<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="sellingprice2" id="sellingprice2"/>
														<div id="sellingError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>Stock<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="stock2" id="stock2" />
														<div id="stockError"></div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label class="control-label">Overview<span style="color:red">*</span><font style="color: red;">*</font></label>
															<textarea class="form-control" id="overview2" name="overview2"></textarea>
														</div>
														<div id="overviewError"></div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label class="control-label">Meta Description
															</label>
															<textarea class="form-control" id="mtdesc2" name="mtdesc2"></textarea>
														</div>
													</div>
												</div>




												<div class="">
													<table class="table table-bordered ">
														<thead>
														<th width="100px">Order No</th>
															<th>Thumbnail Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 200 x 240 px]
																</font>
															</th>
															<th>Small Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 200 x 240 px]
																</font>
															</th>
															<th>Medium Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 400 x 400 px]
																</font>
															</th>
															<th>Large Image <span style="color:red">*</span><br>
																<font color="#008b8b">[Note:
																	Size should be 800 x 800 px]
																</font>
															</th>

														</thead>
														<tbody id="k">

															<tr>
																<td><input type="text" name="orderno2[]" id="orderno1" class="form-control onlynumbers" placeholder="Order No" value="1" /></td>
																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galthumb2[]" id="galthumb2" /></span>

																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>


																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galsmall2[]" id="galsmall2" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" name="gimgid[]" value="0">
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>

																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galmedium2[]" id="galmedium2" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>

																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="gallarge2[]" id="gallarge2" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat2" value="0">
																		</div>
																	</div>
																</td>
<!-- 
	<td class="mininwidth text-center">
																				<span id="newr" onClick="addmoresilver();" class="btn btn-info"><i class="fas fa-plus"></i></span>
																			</td> -->

															</tr>

														

														</tbody>
													</table>
													<div class="row">
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Name
																</label>
																<input type="text" class="form-control" id="sname2" name="sname2" />
															</div>
														</div>
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Value
																</label>
																<input type="text" class="form-control" id="svalue2" name="svalue2"  />
															</div>
														</div>
													</div>
												</div>
<div class="col-12">
											
											</div>
											
											</div>
									
										</div>
								<?php
									} ?>
									</div>


									<div class="card  col-lg-12">
										<?php if(in_array(3, $ars)) {
													?>
													<div class="card-header" id="heading2" style="display: block!important">
											<h5 class="mb-0">
												
													<button class="btn btn-link collapsed " data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2" id="2" >
													Normal </button>
												
												
												
											</h5>
										</div>
														<?php
												 }else {
													?>	
														<div class="card-header" id="heading2" style="display: none!important">
											<h5 class="mb-0">
												
													<button class="btn btn-link collapsed " data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2" id="2" >
													Normal </button>
												
												
												
											</h5>
										</div>
													<?php
												} ?>
										
										<?php if(in_array(3, $ars)) { ?>
										<div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordion" style="<?php if(in_array(3, $ars)) {echo 'display:block';}else {echo 'display:none';}?>">
											
											<div class="card-body">
											<div class=" row">
													<div class="form-group col-md-3">
														<label>Product Code<span style="color:red">*</span></label>
														<input type="text" class="form-control" name="pcode3" id="pcode3" value="<?= $productpackagenormal[0]->pcode;?>" />
														<div id="pcodeError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>MRP<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="mrp3" id="mrp3" value="<?= $productpackagenormal[0]->mrp;?>"/>
														<div id="mrpError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>Selling price<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="sellingprice3" id="sellingprice3" value="<?= $productpackagenormal[0]->sellingprice;?>"/>
														<div id="sellingError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>Stock<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="stock3" id="stock3" value="<?= $productpackagenormal[0]->stock;?>"/>
														<div id="stockError"></div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label class="control-label">Overview<span style="color:red">*</span></label>
															<textarea class="form-control" id="overview3" name="overview3"><?= $productpackagenormal[0]->overview;?></textarea>
														</div>
														<div id="overviewError"></div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label class="control-label">Meta Description
																
															</label>
															<textarea class="form-control" id="mtdesc3" name="mtdesc3"><?= $productpackagenormal[0]->mdesc;?></textarea>
														</div>
													</div>
												</div>




												<div class="">
													<table class="table table-bordered ">
														<thead>
														<th width="100px">Order No</th>
															<th>Thumbnail Image <span style="color:red"></span><br>
																<font color="#008b8b">[Note:
																	Size should be 200 x 240 px]
																</font>
															</th>
															<th>Small Image <span style="color:red"></span><br>
																<font color="#008b8b">[Note:
																	Size should be 200 x 240 px]
																</font>
															</th>
															<th>Medium Image <span style="color:red"></span><br>
																<font color="#008b8b">[Note:
																	Size should be 400 x 400 px]
																</font>
															</th>
															<th>Large Image<span style="color:red"></span> <br>
																<font color="#008b8b">[Note:
																	Size should be 800 x 800 px]
																</font>
															</th>

														</thead>
														<tbody id="l">
<?php 
															if(count($pimagesnormal)) {
																foreach ($pimagesnormal as $img) {
																	?>
															<tr>
																<td><input type="text" name="orderno3[]" id="orderno2" class="form-control onlynumbers" placeholder="Order No" value="1" /></td>
																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			<img src="<?php echo front_url() . $img->thumb; ?>">
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galthumb3[]" id="galthumb3" /></span>

																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>


																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			<img src="<?php echo front_url(). $img->image_path; ?>">
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galsmall3[]" id="galsmall3" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" name="gimgid[]" value="0">
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>

																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			<img src="<?php echo front_url(). $img->image_medium; ?>">
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galmedium3[]" id="galimag2" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>

																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																			<img src="<?php echo front_url(). $img->image_large; ?>">
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="gallarge3[]" id="galimag2" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat2" value="0">
																		</div>
																	</div>
																</td>

<td class="mininwidth text-center">
																				<span id="newr" onClick="addmorenormal();" class="btn btn-info"><i class="fas fa-plus"></i></span>
																			</td>


															</tr>

														<?php }
													} ?>

														</tbody>
													</table>
														<div class="row">
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Name
																</label>
																<input type="text" class="form-control" id="sname3" name="sname3" value="<?= $productpackagenormal[0]->sname;?>"/>
															</div>
														</div>
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Value
																</label>
																<input type="text" class="form-control" id="svalue3" name="svalue3" value="<?= $productpackagenormal[0]->svalue;?>"/>
															</div>
														</div>
													</div>
												</div>
												<div class="col-12">
												
											</div>
											</div>
											<div id="msgbox2"></div>
										
										</div>
<?php }else {
	?>
		<div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordion">
											
											<div class="card-body">
											<div class=" row">
													<div class="form-group col-md-3">
														<label>Product Code<span style="color:red">*</span></label>
														<input type="text" class="form-control" name="pcode3" id="pcode3"  />
														<div id="pcodeError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>MRP<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="mrp3" id="mrp3"/>
														<div id="mrpError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>Selling price<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="sellingprice3" id="sellingprice3" />
														<div id="sellingError"></div>
													</div>
													<div class="form-group col-md-3">
														<label>Stock<span style="color:red">*</span></label>
														<input type="number" class="form-control" name="stock3" id="stock3" />
														<div id="stockError"></div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label class="control-label">Overview<span style="color:red">*</span></label>
															<textarea class="form-control" id="overview3" name="overview3"></textarea>
														</div>
														<div id="overviewError"></div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label class="control-label">Meta Description
																
															</label>
															<textarea class="form-control" id="mtdesc3" name="mtdesc3"></textarea>
														</div>
													</div>
												</div>




												<div class="">
													<table class="table table-bordered ">
														<thead>
														<th width="100px">Order No</th>
															<th>Thumbnail Image <span style="color:red"></span><br>
																<font color="#008b8b">[Note:
																	Size should be 200 x 240 px]
																</font>
															</th>
															<th>Small Image <span style="color:red"></span><br>
																<font color="#008b8b">[Note:
																	Size should be 200 x 240 px]
																</font>
															</th>
															<th>Medium Image <span style="color:red"></span><br>
																<font color="#008b8b">[Note:
																	Size should be 400 x 400 px]
																</font>
															</th>
															<th>Large Image<span style="color:red"></span> <br>
																<font color="#008b8b">[Note:
																	Size should be 800 x 800 px]
																</font>
															</th>

														</thead>
														<tbody id="l">

															<tr>
																<td><input type="text" name="orderno3[]" id="orderno2" class="form-control onlynumbers" placeholder="Order No" value="1" /></td>
																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galthumb3[]" id="galthumb3" /></span>

																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>


																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galsmall3[]" id="galsmall3" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" name="gimgid[]" value="0">
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>

																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																		
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="galmedium3[]" id="galimag2" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat" value="0">
																		</div>
																	</div>
																</td>

																<td>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
																		
																		</div>
																		<div>
																			<span class="btn btn-file btn-info"><span class="fileupload-new">Select
																					image</span><span class="fileupload-exists">Change</span>
																				<input type="file" name="gallarge3[]" id="galimag2" /></span>
																			<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
																			<input type="hidden" id="gimgstat" name="gimgstat2" value="0">
																		</div>
																	</div>
																</td>

<td class="mininwidth text-center">
																				<span id="newr" onClick="addmorenormal();" class="btn btn-info"><i class="fas fa-plus"></i></span>
																			</td>


															</tr>

													

														</tbody>
													</table>
														<div class="row">
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Name
																</label>
																<input type="text" class="form-control" id="sname3" name="sname3" value=""/>
															</div>
														</div>
														<div class="col-6">
															<div class="form-group">
																<label class="control-label">Specification Value
																</label>
																<input type="text" class="form-control" id="svalue3" name="svalue3" value=""/>
															</div>
														</div>
													</div>
												</div>
												<div class="col-12">
												
											</div>
											</div>
											<div id="msgbox2"></div>
										
										</div>
	<?php
} ?>
									</div>
								</div>
								<div class="form-group text-center" style="width:100%">
													<button type="submit" name="submit"  class="btn btn-primary" id="save">Save</button>
												</div>
								</form>
					
						</div>
					</div>

					<hr />
				</div>
			</div>

			<!--END PAGE CONTENT -->
		</div>

		<!--END MAIN WRAPPER -->
	</div>
	</div>
	</div>
	<!-- FOOTER -->

	<div id="footer">
		<p>&copy; <?php echo fottertitle; ?></p>
	</div>

	<!--END FOOTER -->

	<!-- GLOBAL SCRIPTS -->
	<script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.min.js"></script>
	<!--<script src="<?php echo asset_url(); ?>plugins/bootstrap/js/bootstrap.min.js"></script>-->
	<script src="<?php echo asset_url(); ?>js/jquery.validate.js"></script>
	<script src="<?php echo asset_url(); ?>plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
	<!-- END GLOBAL SCRIPTS -->
	<script src="<?php echo asset_url(); ?>plugins/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js"></script>
	<script src="<?php echo asset_url(); ?>plugins/jasny/js/bootstrap-fileupload.js"></script>

	<script>
	
		$(document).ready(function() {

				$("#organization_validate").validate({
			rules: {
				category: "required",
				subcateg: "required",
				pname: "required",
				ptitle: "required",
				pcodes: "required",
				mrps: "required",
				
				sellingprices: "required",
				stocks: "required",
				overviews: "required",
				pcode1: "required",
				mrp1: "required",
				sellingprice1: "required",
				stock1: "required",
				overview1: "required",
				pcode2: "required",
				mrp2: "required",
				sellingprice2: "required",
				stock2: "required",
				overview2: "required",
				pcode3: "required",
				mrp3: "required",
				sellingprice3: "required",
				stock3: "required",
				overview3: "required",
				
			},
			messages: {
				category: "Please enter category",
				subcateg: "Please enter subcategory",
				pname: "Please enter product name",
				ptitle: "Please enter product title",
				pcodes: "Please enter product code",
				mrps: "Please enter mrp",
				
				sellingprices: "Please enter selling price",
				stocks: "Please enter stock",
				overviews: "Please enter overview",
				pcode1: "Please enter product code",
				mrp1: "Please enter mrp",
				sellingprice1: "Please enter selling price",
				stock1: "Please enter stock",
				overview1: "Please enter overview",
				pcode2: "Please enter product code",
				mrp2: "Please enter mrp",
				sellingprice2: "Please enter selling price",
				stock2: "Please enter stock",
				overview2: "Please enter overview",
				pcode3: "Please enter product code",
				mrp3: "Please enter mrp",
				sellingprice3: "Please enter selling price",
				stock3: "Please enter stock",
				overview3: "Please enter overview",
				imagegalnew:"Image is required"
				
				
			},
		
            
    });
		});




				$(".form-check-input").on("change",function(e) {
					e.preventDefault();
				var gold_checked = $('#inlineCheckbox1').is(":checked");
				 var silver_checked = $('#inlineCheckbox2').is(":checked");
				var normal_checked = $('#inlineCheckbox3').is(":checked");

			
					
						 if(gold_checked) {
						 	$("#newshow").css('display', 'none');
						}
						else if(silver_checked) {
							$("#newshow").css('display', 'none');
						}else if(normal_checked) {
								$("#newshow").css('display', 'none');
						}
						else {
							$("#newshow").css('display', 'block');
						}
				
				});
			


			$("#inlineCheckbox1").click(function() {
				if ($(this).prop('checked')) {
					$("#collapseOne").show();
					$("#newshow").css('display', 'none');
					$("#inlineCheckbox7").prop('checked',false);
					$("#headingOne").show();
				}else {
					$("#collapseOne").hide();
					$("#headingOne").hide();
					$("#newshow").css('display', 'block');
				}
			});

			$("#inlineCheckbox2").click(function() {
				if ($(this).prop('checked')) {
					$("#heading1").show();
					$("#collapse1").show();
					$("#inlineCheckbox7").prop('checked',false);
					$("#newshow").css('display', 'none');
				} else {
					$("#collapse1").hide();
					$("#heading1").hide();
					$("#newshow").css('display', 'block');
				}
			});

			$("#inlineCheckbox3").click(function() {
				if ($(this).prop('checked')) {
					$("#collapse2").show();
					$("#heading2").show();
					$("#inlineCheckbox7").prop('checked',false);
					$("#newshow").css('display', 'none');
				} else {
					$("#heading2").hide();
					$("#collapse2").hide();
					$("#newshow").css('display', 'block');
				}
			});

			$("#inlineCheckbox7").on('click',function() {
				if ($(this).prop('checked')) {
					$("#inlineCheckbox3").prop('checked',false);
					$("#inlineCheckbox1").prop('checked',false);
					$("#inlineCheckbox2").prop('checked',false);
					$("#collapseOne").hide();
					$("#headingOne").hide();
					$("#collapse1").hide();
					$("#heading1").hide();
					$("#heading2").hide();
					$("#collapse2").hide();
					$("#newshow").show();
				}else {

				}
			});


		

		$(document).ready(function() {
			$("#organization_validate").on('submit',function(e) {
				 e.preventDefault();
				var formdata = new FormData(this);
				var category = $("#category").val();
					var subcateg = $("#subcateg").val();
					var pname = $("#pname").val();
					var ptitle = $("#ptitle").val();
				$gold = $('#inlineCheckbox1').val();
				$silver = $('#inlineCheckbox2').val();
				$normal = $('#inlineCheckbox3').val();
				$none = $('#inlineCheckbox7').val();

				$gold_checked = $('#inlineCheckbox1').is(":checked");
				$silver_checked = $('#inlineCheckbox2').is(":checked");
				$normal_checked = $('#inlineCheckbox3').is(":checked");
				$none_checked = $('#inlineCheckbox7').is(":checked");

				if($gold_checked && $gold == '1'){
			
					var pcode1 = $("#pcode1").val();
					var mrp1= $("#mrp1").val();
					var sellingprice1 = $("#sellingprice1").val();
					var stock1 = $("#stock1").val();
					var overview1 = $("#overview1").val();
					var galthumb1 = $("#galthumb1").val();
					var galsmall1 = $("#galsmall1").val();
					var galmedium1 = $("#galmedium1").val();
					var gallarge1 = $("#gallarge1").val();

					if(pcode1 ==''){
						
						return false;
					}
					
					if(mrp1 ==''){
						
						return false;
					}
					
					if(sellingprice1 ==''){
						
						return false;
					}

					if(stock1 ==''){
						
						return false;
					}

					if(overview1 ==''){
						
						return false;
					}

					
					
				
					
				}

				
				if($silver_checked && $silver == '2'){
						var pcode2 = $("#pcode2").val();
					var mrp2= $("#mrp2").val();
					var sellingprice2 = $("#sellingprice2").val();
					var stock2 = $("#stock2").val();
					var overview2 = $("#overview2").val();
					var galthumb2 = $("#galthumb2").val();
					var galsmall2 = $("#galsmall2").val();
					var galmedium2 = $("#galmedium2").val();
					var gallarge2 = $("#gallarge2").val();

					if(pcode2 ==''){
						
						return false;
					}
					
					if(mrp2 ==''){
						
						return false;
					}
					
					if(sellingprice2 ==''){
						
						return false;
					}

					if(stock2 ==''){
					
						return false;
					}

					if(overview2 ==''){
						
						return false;
					}
					

				
					
				}

				if($normal_checked && $normal == '3'){
					
					var pcode3 = $("#pcode3").val();
					var mrp3 = $("#mrp3").val();
					var sellingprice3 = $("#sellingprice3").val();
					var stock3 = $("#stock3").val();
					var overview3 = $("#overview3").val();
					var galthumb3 = $("#galthumb3").val();
					var galsmall3 = $("#galsmall3").val();
					var galmedium3 = $("#galmedium3").val();
					var gallarge3 = $("#gallarge3").val();
					var formdata = new FormData(this);
					var  package1 = $("#inlineCheckbox6").val();


					if(pcode3 ==''){
					
						return false;
					}
					
					if(mrp3 ==''){
						
						return false;
					}
					
					if(sellingprice3 ==''){
						
						return false;
					}

					if(stock3 ==''){
						
						return false;
					}

					if(overview3 ==''){
					
						return false;
					}


					
				
				}

				if($none_checked && $none == '7'){
					
					var pcodes = $("#pcodes").val();
					var mrp = $("#mrps").val();
					var sellingprice = $("#sellingprices").val();
					var stock = $("#stocks").val();
					var overview = $("#overviews").val();
					var formdata = new FormData(this);
					var  package1 = $("#inlineCheckbox7").val();
				
				
					if(pcodes ==''){
						return false;
					}
					
					if(mrp ==''){
					
						return false;
					}
					
					if(sellingprice ==''){
						
						return false;
					}

					if(stock ==''){
					
						return false;
					}

					if(overview ==''){
						
						return false;
					}
					
				

				}
					$.ajax({
					url :"<?= base_url().'master/updateProductPackage1';?>",
					method :"post",
					contentType:false,
					processData:false,
					data :formdata,
					dataType:"json",
					beforeSend:function() {
							
					},
					success:function(data) {
						console.log(data);
						$("#topSuccess").show();
						if(data.status =='success') {
							$("#topSuccess").hide();
							$("#submitFormData").html('');
							$("#organization_validate")[0].reset();
							$("#success").html('<div class="alert alert-success">'+data.pdata+'</div>');
							 window.location.href="<?= base_url().'master/products';?>";
						}
						else if(data.status =='failures'){
							$("#success").html('<div class="alert alert-danger">'+data.pdata+'</div>');
						}
					}
				});
			
			
				
		});
			});

		
		function submitfn() {
			if (validate1() == false) {
				$("#0").removeClass("show");
				$("#0").click();
				$("#0").addClass("show");
				return false;
			} else {
				$('form').removeAttr('onsubmit', 'return false;');
				$("#organization_validate").submit();
				//return true;
			}
		}

		var empty_string = /^\s*$/;

		$(document).ready(function() {
			$("#inlineCheckbox1").click(function() {

			});
		});

		function validate1() { //alert(0);
			$("#alert1").remove();
			$("#msgbox1").html("<br><br><div class='alert' id='alert1'></div>");
			$("#alert1").removeClass().addClass('alert').html('Validating....').fadeIn(1000).addClass(
				'alert-warning');

			var category = document.getElementById('category').value;
			var subcateg = document.getElementById('subcateg').value;
			subcateg = 1;
			var name = document.getElementById('name').value;
			var code = 1;
			//var material = document.getElementById('material').value;
			//var color = document.getElementById('color').value;
			//var overview = document.getElementById('overview').value;
			//var metatag = tinyMCE.get('metatag').getContent();
			//var metadesc = tinyMCE.get('metadesc').getContent();

			//alert(1);		
			var rebatestr = "";
			//category
			if (empty_string.test(category)) {
				$("#alert1").html(
					"<button type='button' class='close' data-dismiss='alert'>&times;</button>Select Category"
				).addClass('alert-danger').fadeTo(900, 1);
				return false;
			} else if (empty_string.test(subcateg)) {
				$("#alert1").html(
					"<button type='button' class='close' data-dismiss='alert'>&times;</button>Select Subcategory"
				).addClass('alert-danger').fadeTo(900, 1);
				return false;
			} else if (empty_string.test(name)) {
				$("#alert1").html(
					"<button type='button' class='close' data-dismiss='alert'>&times;</button>Enter Product Name"
				).addClass('alert-danger').fadeTo(900, 1);
				return false;
			} else if (empty_string.test(code)) {
				$("#alert1").html(
					"<button type='button' class='close' data-dismiss='alert'>&times;</button>Enter Product Code"
				).addClass('alert-danger').fadeTo(900, 1);
				return false;
			}

			else {
				$("#alert1").remove();
				return true;
			}


		}

		function validate2() { //alert(0);
			$("#alert2").remove();
			$("#msgbox2").html("<br><br><div class='alert' id='alert2'></div>");
			$("#alert2").removeClass().addClass('alert').html('Validating....').fadeIn(1000).addClass(
				'alert-warning');

			//alert(1);		
			var rebatestr = "";
			//category
			if (!empty_string.test(rebatestr = check_size())) {
				$("#alert2").html("<button type='button' class='close' data-dismiss='alert'>&times;</button>" +
					rebatestr).addClass('alert-danger').fadeTo(900, 1);
				return false;
			} else if (!empty_string.test(rebatestr = checkduplicate_size())) {
				$("#alert2").html("<button type='button' class='close' data-dismiss='alert'>&times;</button>" +
					rebatestr).addClass('alert-danger').fadeTo(900, 1);
				return false;
			}
			//			else if(!empty_string.test(rebatestr=check_images())){
			//				$("#alert2").html("<button type='button' class='close' data-dismiss='alert'>&times;</button>"+rebatestr).addClass('alert-danger').fadeTo(900,1);
			//				return false;
			//			}
			else {
				$("#alert2").remove();
				return true;
			}
		}


		function checkduplicate_size() {
			var size = document.getElementsByName('size[]');

			var rebatestr = "";
			for (var i = 0; i < size.length; i++) {
				for (var j = 0; j < size.length; j++) {
					if (i != j && size[i].value == size[j].value) { // && prod[i].value == 0
						rebatestr = "Product Sizes entered with duplicate values";
						break;
					}
				}
			}
			return rebatestr;
		}


		$(document).ready(function() {
			$.configureBoxes();

			$(".remgalimage").click(function() {

				var val = $(this).attr('uid');
				$("#gimgstat" + val).val(0);
			});

			$('a[data-toggle="collapse"]').click(function(e) {
				if ($(this).hasClass("disable")) {
					e.stopPropagation();
				}
			});




			$('body').on('keypress', ".floatval", function(event) {
				var charCode = (event.which) ? event.which : event.keyCode
				if (charCode == 8 || charCode == 9) {

				} else if ((charCode != 46 || $(this).val().indexOf('.') != -1) && (charCode < 48 ||
						charCode > 57)) {
					event.preventDefault();
				}
			});

			$('body').on('keypress', ".onlynumbers", function(evt) {
				var charCode = (evt.which) ? evt.which : event.keyCode

				if (charCode == 8) //back space
					return true;
				if (charCode < 48 || charCode > 57) //0-9
				{
					return false;
				}

				return true;
			});


			

		

		});

		function addmore() {
			var x = Math.floor((Math.random() * 10000) + 1);
			var row = "<tr id='r_" + x +
				"' class='removeall'><td><input type='hidden' name='hsize[]' value='0'><select name='size[]' id='size" + x +
				"'  class='form-control' >" + $('#size').html() + "</select></td>";
			row +=
				"<td><input type='text' name='mrp[]' id='mrp' class='form-control floatval' placeholder='MRP' value='' /></td>";
			row +=
				"<td><input type='text' name='sell_price[]' id='sell_price' class='form-control floatval' placeholder='Selling Price' value='' /></td>";
			row +=
				"<td><input type='text' name='sel_dollar[]' id='sel_dollar' class='form-control floatval' placeholder='Selling Price' value='' /></td>";
			row +=
				"<td><input type='text' name='b2b_selling_price[]' id='b2b_selling_price' class='form-control floatval' placeholder='Selling Price' value='' /></td>";
			row +=
				"<td><input type='text' name='b2b_sel_dollar[]' id='b2b_sel_dollar' class='form-control floatval' placeholder='Selling Price' value='' /></td>";
			row +=
				"<td><input type='text' name='stock[]' id='stock' class='form-control floatval' placeholder='Stock' value='' /></td>";

			row +=
				"<td><input type='text' name='minimum_buy[]' id='minimum_buy' class='form-control floatval' placeholder='Minimum Buy' value='' /></td>";
			row += "<td class='text-center'><span class='btn btn-primary' onclick='remove123(" + x +
				")'><i class='fas fa-minus'></i></span></td></tr>";
			$('#p').append(row);
			$('#size' + x + ' option[value="0"]').remove();
			$('#size' + x).val('');
		}

		function remove123(trid) {
			$("#r_" + trid).fadeOut(500, function() {
				$("#r_" + trid).remove();
			});
		}

		function addmoreimag() {
			var x = Math.floor((Math.random() * 10000) + 1);
			var row = "<tr id='r_" + x +
				"'><td><input type='text' name='orderno[]'  id='orderno' class='form-control onlynumbers'  placeholder='Order No'  value='1'/></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='galthumbs[]' id='galthumbs' /><input type='hidden' name='gimgid[]' value='0' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='galsmalls[]' id='galsmalls' /><input type='hidden' name='gimgid[]' value='0' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='galmedius[]' id='galmedius' /><input type='hidden' name='gimgid[]' value='0' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='gallarges[]' id='gallarges' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";

			row += "<td class='text-center'><span class='btn btn-primary' onclick='remove123(" + x +
				")'><i class='fas fa-minus'></i></span></td></tr>";
			$('#i').append(row);
		}

				function addmoregold() {
			var x = Math.floor((Math.random() * 10000) + 1);
			var row = "<tr id='r_" + x +
				"'><td><input type='text' name='orderno1[]'  id='orderno' class='form-control onlynumbers'  placeholder='Order No'  value='1'/></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='galthumb1[]' id='galthumb1' /><input type='hidden' name='gimgid[]' value='0' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='galsmall1[]' id='galsmall1' /><input type='hidden' name='gimgid[]' value='0' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='galmedium1[]' id='galmedium1' /><input type='hidden' name='gimgid[]' value='0' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='gallarge1[]' id='gallarge1' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";

			row += "<td class='text-center'><span class='btn btn-primary' onclick='remove123(" + x +
				")'><i class='fas fa-minus'></i></span></td></tr>";
			$('#j').append(row);
		}

						function addmoresilver() {
			var x = Math.floor((Math.random() * 10000) + 1);
			var row = "<tr id='r_" + x +
				"'><td><input type='text' name='orderno2[]'  id='orderno' class='form-control onlynumbers'  placeholder='Order No'  value='1'/></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='galthumb2[]' id='galthumb2' /><input type='hidden' name='gimgid[]' value='0' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='galsmall2[]' id='galsmall2' /><input type='hidden' name='gimgid[]' value='0' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='galmedium2[]' id='galmedium2' /><input type='hidden' name='gimgid[]' value='0' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='gallarge2[]' id='gallarge2' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";

			row += "<td class='text-center'><span class='btn btn-primary' onclick='remove123(" + x +
				")'><i class='fas fa-minus'></i></span></td></tr>";
			$('#k').append(row);
		}

					function addmorenormal() {
			var x = Math.floor((Math.random() * 10000) + 1);
			var row = "<tr id='r_" + x +
				"'><td><input type='text' name='orderno3[]'  id='orderno' class='form-control onlynumbers'  placeholder='Order No'  value='1'/></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='galthumb3[]' id='galthumb3' /><input type='hidden' name='gimgid[]' value='0' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='galsmall3[]' id='galsmall3' /><input type='hidden' name='gimgid[]' value='0' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='galmedium3[]' id='galmedium3' /><input type='hidden' name='gimgid[]' value='0' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 150px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='gallarge3[]' id='gallarge3' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";

			row += "<td class='text-center'><span class='btn btn-primary' onclick='remove123(" + x +
				")'><i class='fas fa-minus'></i></span></td></tr>";
			$('#l').append(row);
		}



		function addmorevase() {
			var x = Math.floor((Math.random() * 10000) + 1);
			var row = "<tr id='r_" + x +
				"'><td><input type='text' name='vasename[]'  id='vasename' class='form-control'  placeholder='Vase Name'  value=''/></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' style='width: 200px; height: 150px;'></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='vaseimag[]' id='vaseimag' /><input type='hidden' name='vimgid[]' value='0' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='vimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";
			row +=
				"<td><input type='text' name='price[]'  id='price' class='form-control floatval'  placeholder='Vase Price'  value=''/></td>";
			row +=
				"<td><input type='text' name='vasestock[]'  id='vasestock' class='form-control onlynumbers'  placeholder='Vase Stock'  value=''/></td>";
			row += "<td class='text-center'><span class='btn btn-primary' onclick='remove123(" + x +
				")'><i class='fas fa-minus'></i></span></td></tr>";
			$('#v').append(row);
		}

		function addmorespec() {
			var x = Math.floor((Math.random() * 10000) + 1);
			var row = "<tr id='r_" + x + "'>";
			row +=
				"<td><input type='text' name='spec_name[]' id='spec_name' class='form-control' placeholder='Specification Name' value='' /></td>";
			row +=
				"<td><input type='text' name='spec_val[]' id='spec_val' class='form-control' placeholder='Specification Value' value='' /></td>";
			row += "<td class='text-center'><span class='btn btn-primary' onclick='remove123(" + x +
				")'><i class='fas fa-minus'></i></span></td></tr>";
			$('#sp').append(row);
		}

		$(document).ready(function() {
			$("#category").on('change',function(e) {
				e.preventDefault();
				var id = $(this).val();
				$.ajax({
					url :"<?php echo base_url(); ?>master/getsubcat",
					method :"post",
					data : {cid :id},
					success:function(data) {
						$('#subcateg').html('<option value="">--Select--</option>' + data);
					}
				});
			});
		});

	

		function getsubsubcateg(id) {

			$.post('<?php echo base_url(); ?>master/getsubsubcat', {
				subid: id
			}, function(data) {
				$('#sub_sub_id').html('<option value="">--Select--</option>' + data);
			});

		}

		function hidesize(val) {
			$("#newsize").show();
			if (parseInt(val) == 0) {
				$("#newsize").hide();
				$(".removeall").remove();
			}
		}
	</script>
	<script src="https://cdn.tiny.cloud/1/a6tj60xi1k10z1c7trmg4bk6mp3dzpe9eoyi37anyzfpllhc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		$(function() {

			tinymce.init({
				selector: '#mtdesc',
				plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen table charmap hr toc insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars ',
				menubar: '',
				toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap | fullscreen  preview ',
				height: 300,
				image_caption: true,
				quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
				noneditable_noneditable_class: "mceNonEditable",
				toolbar_mode: 'sliding',
				contextmenu: "table",
			});
		});
		$(function() {

			tinymce.init({
				selector: '#overview',
				plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen table charmap hr toc insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars ',
				menubar: '',
				toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap | fullscreen  preview ',
				height: 300,
				image_caption: true,
				quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
				noneditable_noneditable_class: "mceNonEditable",
				toolbar_mode: 'sliding',
				contextmenu: "table",
			});
		});
		$(function() {

			tinymce.init({
				selector: '#mttag',
				plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen table charmap hr toc insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars ',
				menubar: '',
				toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap | fullscreen  preview ',
				height: 300,
				image_caption: true,
				quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
				noneditable_noneditable_class: "mceNonEditable",
				toolbar_mode: 'sliding',
				contextmenu: "table",
			});
		});
	</script>


	<!-- <script src="<?php echo asset_url(); ?>libs/bootstrap/dist/js/bootstrap.min.js"></script> -->
	<!-- apps -->
	<script src="<?php echo asset_url(); ?>dist/js/app.min.js"></script>
	<script src="<?php echo asset_url(); ?>dist/js/app.init.js"></script>
	<!-- slimscrollbar scrollbar JavaScript -->
	<script src="<?php echo asset_url(); ?>libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
	<!--Wave Effects -->
	<script src="<?php echo asset_url(); ?>dist/js/waves.js"></script>
	<!--Menu sidebar -->
	<script src="<?php echo asset_url(); ?>dist/js/sidebarmenu.js"></script>
	<!--Custom JavaScript -->
	<script src="<?php echo asset_url(); ?>dist/js/custom.min.js"></script>
	<!--This page JavaScript -->

</body>
<!-- END BODY-->

</html>