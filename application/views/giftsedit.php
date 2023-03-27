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


	<?php echo $updatelogin; ?>

</head>
<!-- END  HEAD-->
<!-- BEGIN BODY-->

<body class="padTop53 ">

	<div id="main-wrapper">

		<!-- HEADER SECTION -->
		<?php echo $header; ?>
		<!-- END HEADER SECTION -->



		<!-- MENU SECTION -->
		<?php echo $left; ?>
		<!--END MENU SECTION -->


		<!--PAGE CONTENT -->
		<div class="page-wrapper">
			<!-- ============================================================== -->
			<!-- Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<div class="row page-titles">
				<div class="col-md-5 col-12 align-self-center">
					<h3 class="text-themecolor mb-0">Gifts</h3>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Home Page</a></li>
						<li class="breadcrumb-item active">Gifts</li>
					</ol>
				</div>
				<div class="col-md-7 col-12 align-self-center d-none d-md-block">

				</div>
			</div>
			<div class="container-fluid" id="content">
				<div class="inner" style="min-height:1200px;">

					<div class="card">

						<div class="card-header">
							<h5>Edit Gifts</h5>
						</div>

						<div class="card-body">




							<form action="<?php echo base_url() . 'homepage/gifts_edit'; ?>" class="form-group form-material" id="organization_validate" method="post" enctype="multipart/form-data">
								
								<input type="hidden" name="aid" value="<?php echo $gft[0]->id; ?>" />

								<div class="row" id="vasediv">
									<div class="form-group col-md-6">
										<label class="control-label">Order No. </label>
										<input type="text" id="orderno" name="orderno" class="form-control onlynumbers" maxlength="3" value="<?php echo $gft[0]->order_no; ?>" />
									</div>


									<div class="form-group col-md-6">
										<label class="control-label">Offer Title </label>
										<input type="text" id="name" name="name" class="form-control" maxlength="35" value="<?php echo $gft[0]->title; ?>" />
									</div>


									<div class="form-group col-md-6">
										<label class="control-label">Image <font style="color: red;">*</font></label>
										<div class="fileupload fileupload-exists" data-provides="fileupload">
											<div class="fileupload-preview thumbnail" ><img src="<?php echo front_url() . $gft[0]->image_path; ?>">
											</div>

											<div>

												<span class="btn btn-file btn-info"><span class="fileupload-new selimage" uid="1">Select
														image</span><span class="fileupload-exists">Change</span>
													<input type="file" name="imag" id="imag" /></span>


												<input type="hidden" id="imgstat" name="imgstat" value="1">
											</div>

										</div>
										<div class="alert alert-info alert-dismissable"><strong>Note:</strong>
									Please add image of size 91 x 93 px</div>
									</div>




								<!--	<div class="col-md-5">

										<div class="form-group ">
											<div class="input-group">
												<?php $cat = $this->master_db->getcontent2('category', '', '', '0'); ?>
												<select id="demo" style="margin-left:-14px;" class="form-control" onchange="change(this.value);">
													<?php
													if (is_array($cat)) {
														echo "<option id='select' class='select' value='select'>--Select--</option>";
														echo "<option id='All' class='All' value='All'>--All--</option>";
														foreach ($cat as $c) {
													?>
															<option value="<?php echo $c->id ?>">
																<?php echo $c->name ?></option>
													<?php }
													} ?>
												</select>
												<img class='' style="visibility: hidden" id="wait" src="<?php echo asset_url(); ?>images/loadingg.gif">
											</div>



											<div class="input-group">
												<input id="box1Filter" type="text" placeholder="Filter" class="form-control" />
												<span class="input-group-btn">
													<button id="box1Clear" class="btn btn-warning" type="button">x</button>
												</span>
											</div>
										</div>


										<font style="color: red;"> <label style="visibility: hidden;" id="nf">Product Not Found</label></font>
										<div class="form-group">
											<select id="box1View" style="height:400px " multiple="multiple" class="form-control" size="16"> </select>

											<div class="alert alert-block">
												<select id="box1Storage" class="form-control"></select>
											</div>


										</div>


									</div>

									<div class="col-md-2 text-center">
										<div class="btn-group btn-group-vertical" style="white-space: normal;">
											<button id="to2" type="button" class="btn btn-primary">
												<i class="fas fa-angle-right"></i>
											</button>
											<button id="allTo2" type="button" class="btn btn-primary">
												<i class="fas fa-angle-double-right"></i>
											</button>
											<button id="allTo1" type="button" class="btn btn-primary">
												<i class=" fas fa-angle-double-left"></i>
											</button>
											<button id="to1" type="button" class="btn btn-primary">
												<i class="fas fa-angle-left"></i>
											</button>
										</div>
									</div>


									<div class="col-md-5">
										<div class="input-group">
											<?php $cat = $this->master_db->getcontent2('category', '', '', '0'); ?>

											 
												<select id="box2sel" class="form-control" onchange="change2(this.value);">
													<?php
													if (is_array($cat)) {

														echo "<option id='All' class='All' value='All'>--All--</option>";
														foreach ($cat as $c) {
													?>

															<option value="<?php echo $c->id ?>"><?php echo $c->name ?>
															</option>
													<?php }
													} ?>
												</select>
											 

											 

												<img class='' style="visibility: hidden" id="wait" src="<?php echo asset_url(); ?>images/loadingg.gif">

											 
										</div>


										<div class="form-group">
											<div class="input-group">
												<input id="box2Filter" type="text" placeholder="Filter" class="form-control" />
												<span class="input-group-btn">
													<button id="box2Clear" class="btn btn-warning" type="button">x</button>
												</span>
											</div>
										</div>

										<font style="color: red;"> <label style="visibility: hidden;" id="nf">Product Not Found</label></font>

										<div class="form-group">
											<select id="box2View" style="height: 400px" name="proname[]" multiple="multiple" class="form-control" size="16">
												<?php $products = $this->master_db->getgiftproducts($gft[0]->id); ?>
												<?php
												if (is_array($products)) {

													foreach ($products as $c) {
												?>
														<option id="<?php echo $c->id; ?>" class="<?php echo $c->cat_id; ?>" value="<?php echo $c->id ?>">
															<?php echo $c->name . " [" . $c->pcode . "]" ?></option>
												<?php }
												} ?>


											</select>

										</div>

										<div class="alert alert-block">
											<select id="box2Storage" class="form-control"> </select>
										</div>
									</div>-->
							</form>






							<div id="msgbox3"> </div>

							<div class="form-actions no-margin-bottom col-md-12" style="text-align:center;">
								<a href="<?php echo base_url() . 'homepage/gifts'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left "></i> Back</a> 
								<button type="submit" class="btn btn-info " id="validate"><i class="mdi mdi-check "></i> Save Changes</button>
							</div>



						</div>

					</div>



				</div>




			</div>
		</div>
	</div>






	</div>
	</div>

	<!--END PAGE CONTENT -->
	</div>

	<!--END MAIN WRAPPER -->

	<!-- FOOTER -->

	<div id="footer">
		<p>&copy; <?php echo fottertitle; ?></p>
	</div>

	<!--END FOOTER -->

	<!-- GLOBAL SCRIPTS -->
	<script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.min.js"></script>
	<script src="<?php echo asset_url(); ?>plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo asset_url(); ?>plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
	<!-- END GLOBAL SCRIPTS -->
	<script src="<?php echo asset_url(); ?>plugins/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js"></script>
	<script src="<?php echo asset_url(); ?>plugins/jasny/js/bootstrap-fileupload.js"></script>



	<script src="<?php echo asset_url(); ?>plugins/validationengine/js/jquery.validationEngine.js"></script>

	<script src="<?php echo asset_url(); ?>plugins/validationengine/js/languages/jquery.validationEngine-en.js">
	</script>

	<script src="<?php echo asset_url(); ?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>

	<script src="<?php echo asset_url(); ?>plugins/jasny/js/bootstrap-fileupload.js"></script>
	<script src="<?php echo asset_url(); ?>plugins/validationengine/js/jquery.validationEngine.js"></script>
	<script src="<?php echo asset_url(); ?>plugins/validationengine/js/languages/jquery.validationEngine-en.js">
	</script>


	<!-- Bootstrap tether Core JavaScript -->
	<script src="<?php echo asset_url(); ?>libs/popper.js/dist/umd/popper.min.js"></script>
	<script src="<?php echo asset_url(); ?>libs/bootstrap/dist/js/bootstrap.min.js"></script>
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
	<!-- Chart JS -->
	<script src="<?php echo asset_url(); ?>dist/js/pages/dashboards/dashboard1.js"></script>

	<script src="<?php echo asset_url(); ?>libs/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo asset_url(); ?>dist/js/pages/datatable/custom-datatable.js"></script>
	<script src="<?php echo asset_url(); ?>dist/js/pages/datatable/datatable-basic.init.js"></script>




	<script>
	/*	$(document).ready(function() {
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

			$('.previous').click(function(e) {
				var val = $(this).attr("uid");
				$("#" + val).removeClass("disable");
				$("#" + val).click();
				$(".allhd").addClass("disable");
			});

			$('.skip').click(function(e) {
				if (validate1() == true) {
					$("#second").removeClass("disable");
					$("#second").click();
					$(".allhd").addClass("disable");
					$('html, body').animate({
						scrollTop: $("#first").offset().top
					}, 1000);
				}
			});

			$('.skip1').click(function(e) {
				if (validate2() == true) {
					$("#third").removeClass("disable");
					$("#third").click();
					$(".allhd").addClass("disable");
					$('html, body').animate({
						scrollTop: $("#first").offset().top
					}, 1000);
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

			CKEDITOR.config.toolbar = [{
					name: 'document',
					groups: ['mode', 'document'],
					items: ['Source', '-', 'Save', 'Preview', 'Print']
				},
				{
					name: 'clipboard',
					groups: ['clipboard', 'undo'],
					items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo']
				},
				{
					name: 'editing',
					groups: ['find', 'selection', 'spellchecker'],
					items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
				},
				{
					name: 'basicstyles',
					groups: ['basicstyles', 'cleanup'],
					items: ['Bold', 'Italic', 'Underline', 'Strike']
				},
				{
					name: 'paragraph',
					groups: ['list', 'indent', 'align'],
					items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft',
						'JustifyCenter', 'JustifyRight', 'JustifyBlock'
					]
				},
				{
					name: 'styles',
					items: ['Format', 'Font', 'FontSize']
				}

			];

			CKEDITOR.replace('overview', {
				width: 600
			});


			var empty_string = /^\s*$/;

			function validate1() { //alert(0);
				$("#alert1").remove();
				$("#msgbox1").html("<br><br><div class='alert' id='alert1'></div>");
				$("#alert1").removeClass().addClass('alert').html('Validating....').fadeIn(1000).addClass(
					'alert-warning');

				var category = document.getElementById('category').value;
				var subcateg = document.getElementById('subcateg').value;
				subcateg = 1;
				var name = document.getElementById('name').value;
				var code = document.getElementById('code').value;
				var material = document.getElementById('material').value;
				var color = document.getElementById('color').value;
				var overview = CKEDITOR.instances.overview.getData();

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
				} else if (empty_string.test(material)) {
					$("#alert1").html(
						"<button type='button' class='close' data-dismiss='alert'>&times;</button>Select Material"
					).addClass('alert-danger').fadeTo(900, 1);
					return false;
				} else if (empty_string.test(color)) {
					$("#alert1").html(
							"<button type='button' class='close' data-dismiss='alert'>&times;</button>Select Color")
						.addClass('alert-danger').fadeTo(900, 1);
					return false;
				} else if (empty_string.test(overview)) {

					return false;
				} else {
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
				} else if (!empty_string.test(rebatestr = check_images())) {
					$("#alert2").html("<button type='button' class='close' data-dismiss='alert'>&times;</button>" +
						rebatestr).addClass('alert-danger').fadeTo(900, 1);
					return false;
				} else {
					$("#alert2").remove();
					return true;
				}
			}

			function check_images() {
				var orderno = document.getElementsByName('orderno[]');
				var galimag = document.getElementsByName('galimag[]');
				var gimgstat = document.getElementsByName('gimgstat[]');

				var rebatestr = "";
				for (var i = 0; i < orderno.length; i++) {
					if (empty_string.test(orderno[i].value)) {
						rebatestr = "You have missed somewhere to enter Product Images Order No.";
						break;
					} else if (empty_string.test(galimag[i].value) && gimgstat[i].value == "0") {
						rebatestr = "You have missed somewhere to select Product Image";
						break;
					}
				}
				return rebatestr;
			}

			function check_size() {
				var size = document.getElementsByName('size[]');
				var mrp = document.getElementsByName('mrp[]');
				var sell_price = document.getElementsByName('sell_price[]');
				var stock = document.getElementsByName('stock[]');

				var rebatestr = "";
				for (var i = 0; i < size.length; i++) {
					if (empty_string.test(size[i].value)) {
						rebatestr = "You have missed somewhere to Select Size";
						break;
					} else if (empty_string.test(mrp[i].value)) {
						rebatestr = "You have missed somewhere to enter MRP";
						break;
					} else if (empty_string.test(sell_price[i].value)) {
						rebatestr = "You have missed somewhere to enter Selling Price";
						break;
					} else if (empty_string.test(stock[i].value)) {
						rebatestr = "You have missed somewhere to enter Stock";
						break;
					}
				}
				return rebatestr;
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


			function validate3() { //alert(0);
				$("#alert3").remove();
				$("#msgbox3").html("<br><br><div class='alert' id='alert3'></div>");
				$("#alert3").removeClass().addClass('alert').html('Validating....').fadeIn(1000).addClass(
					'alert-warning');
				var len = document.getElementById("box2View").length;
				var vase = $('#vasey').is(':checked');
				//alert(1);		
				var rebatestr = "";
				//category
				if (vase && len == 0) {
					$("#alert3").html(
						"<button type='button' class='close' data-dismiss='alert'>&times;</button>Select Planters to be applied"
					).addClass('alert-danger').fadeTo(900, 1);
					return false;
				} else {
					$("#alert3").html(
						"<button type='button' class='close' data-dismiss='alert'>&times;</button>Please wait..."
					).addClass('alert-success').fadeTo(900, 1);
					return true;
				}
			}






		});

		function addmore() {
			var x = Math.floor((Math.random() * 10000) + 1);
			var row = "<tr id='r_" + x + "' class='removeall'><td><select name='size[]' id='size" + x +
				"'  class='form-control' >" + $('#size').html() + "</select></td>";
			row +=
				"<td><input type='text' name='mrp[]' id='mrp' class='form-control floatval' placeholder='MRP' value='' /></td>";
			row +=
				"<td><input type='text' name='sell_price[]' id='sell_price' class='form-control floatval' placeholder='Selling Price' value='' /></td>";
			row +=
				"<td><input type='text' name='stock[]' id='stock' class='form-control floatval' placeholder='Stock' value='' /></td>";
			row += "<td><span class='btn btn-sm btn-primary' onclick='remove123(" + x + ")'>- Remove</span></td></tr>";
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
			row += "<div class='fileupload-preview thumbnail'  ></div>";
			row += "<div>";
			row +=
				"<span class='btn btn-file btn-info'><span class='fileupload-new'>Select image</span><span class='fileupload-exists'>Change</span><input type='file' name='galimag[]' id='galimag' /><input type='hidden' name='gimgid[]' value='0' /></span>";
			row +=
				"  <a href='#' class='btn btn-primary fileupload-exists' data-dismiss='fileupload'>Remove</a><input type='hidden'  name='gimgstat[]' value='0'>";
			row += "</div>";
			row += "</div></td>";
			row += "<td><span class='btn btn-sm btn-primary' onclick='remove123(" + x + ")'>- Remove</span></td></tr>";
			$('#i').append(row);
		}

		function addmorevase() {
			var x = Math.floor((Math.random() * 10000) + 1);
			var row = "<tr id='r_" + x +
				"'><td><input type='text' name='vasename[]'  id='vasename' class='form-control'  placeholder='Vase Name'  value=''/></td>";
			row += "<td><div class='fileupload fileupload-new' data-provides='fileupload'>";
			row += "<div class='fileupload-preview thumbnail' ></div>";
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
			row += "<td><span class='btn btn-sm btn-primary' onclick='remove123(" + x + ")'>- Remove</span></td></tr>";
			$('#v').append(row);
		}

		function addmorespec() {
			var x = Math.floor((Math.random() * 10000) + 1);
			var row = "<tr id='r_" + x + "'>";
			row +=
				"<td><input type='text' name='spec_name[]' id='spec_name' class='form-control' placeholder='Specification Name' value='' /></td>";
			row +=
				"<td><input type='text' name='spec_val[]' id='spec_val' class='form-control' placeholder='Specification Value' value='' /></td>";
			row += "<td><span class='btn btn-sm btn-primary' onclick='remove123(" + x + ")'>- Remove</span></td></tr>";
			$('#sp').append(row);
		}


		function getsubcateg(id)

		{
			$.post(

				'<?php echo base_url(); ?>master/getsubcat',

				{
					cid: id
				},

				function(data) {

					//alert(data);

					$('#subcateg').html('<option value="">--Select--</option>' + data);

				});

		}

		function hidesize(val) {
			$("#newsize").show();
			if (parseInt(val) == 0) {
				$("#newsize").hide();
				$(".removeall").remove();
			}
		}

		function change(id) {

			if (id != 'select')
				$("#wait").removeAttr("style")

			if (id == 'select') {
				var sel1 = new Array();
				$("#box1View option").each(function() {

					$(this).hide();



				});
			} else {

				var sel1 = new Array();
				$("#box1View option").each(function() {

					$(this).show();



				});

			}


			$.post(

				'<?php echo base_url(); ?>homepage/getproducts',

				{
					cid: id
				},

				function(data) {

					if (id != 'select') {
						if (data == '') {
							$("#nf").removeAttr("style");
							$('#box1View').html('');

						} else {

							$('#nf').css('visibility', 'hidden');
							$('#box1View').html(data);

						}
						$('#wait').css('visibility', 'hidden');
					}

					var sel1 = new Array();
					$("#box1View option").each(function() {

						sel1.push(this.value);



					});


					var sel2 = new Array();

					$("#box2View option").each(function() {

						sel2.push(this.value);


					});



					var i;
					var j;
					for (i = 0; i < sel1.length; i++) {
						for (j = 0; j < sel2.length; j++) {

							if (sel1[i] == sel2[j]) {
								$('#' + sel1[i]).hide();
							}
						}
					}




					$('#box2sel').find('option[value="' + id + '"]').attr("selected", "selected");

					var filter = $('#box2sel').attr('value');

					$("#box2View option").each(function() {

						var cl = $('#' + this.id).attr('class');

						if (filter == cl) {
							$('.' + cl).show();
						} else {
							$('.' + cl).hide();
						}

						if (filter == 'All')

							$('#' + this.id).show();



					});


					var sel1 = new Array();
					$("#box1View option").each(function() {

						sel1.push(this.value);



					});


					var sel2 = new Array();

					$("#box2View option").each(function() {

						sel2.push(this.value);


					});



					var i;
					var j;
					for (i = 0; i < sel1.length; i++) {
						for (j = 0; j < sel2.length; j++) {

							if (sel1[i] == sel2[j]) {
								$('#' + sel1[i]).remove();
							}
						}
					}

					if (id == 'All') {
						var sel1 = new Array();
						$("#box2View option").each(function() {

							$(this).show();



						});
					}






				});


		}



		function change2(id) {



			var sel1 = new Array();
			$("#box1View option").each(function() {

				sel1.push(this.value);



			});


			var sel2 = new Array();

			$("#box2View option").each(function() {

				sel2.push(this.value);


			});



			var i;
			var j;
			for (i = 0; i < sel1.length; i++) {
				for (j = 0; j < sel2.length; j++) {

					if (sel1[i] == sel2[j]) {
						$('#' + sel1[i]).hide();
					}
				}
			}




			$('#box2sel').find('option[value="' + id + '"]').attr("selected", "selected");

			var filter = $('#box2sel').attr('value');

			$("#box2View option").each(function() {

				var cl = $('#' + this.id).attr('class');

				if (filter == cl) {
					$(this).show();
				} else {
					$(this).hide();
				}

				if (filter == 'All')

					$('#' + this.id).show();



			});


			var sel1 = new Array();
			$("#box1View option").each(function() {

				sel1.push(this.value);



			});


			var sel2 = new Array();

			$("#box2View option").each(function() {

				sel2.push(this.value);


			});



			var i;
			var j;
			for (i = 0; i < sel1.length; i++) {
				for (j = 0; j < sel2.length; j++) {

					if (sel1[i] == sel2[j]) {
						$('#' + sel1[i]).remove();
					}
				}
			}







		}*/


		//	var sel = $("#box2Storage option").map(function() {return $(this).text();}).get();
		//		alert(sel);
	</script>
	<script>
		/*function check_vase() {

			var sel2 = new Array();

			$("#box2View option").each(function() {

				sel2.push(this.value);


			});

			if ($('#orderno').val() == "") {
				$("#msgbox3").html(
					"<div class='alert alert-warning alert-danger' id='msgbox3' style='opacity: 1;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Enter Order No</div>"
				).addClass('alert-danger').fadeTo(900, 1);
				return false;
			} else if ($('#name').val() == "") {
				$("#msgbox3").html(
					"<div class='alert alert-warning alert-danger' id='msgbox3' style='opacity: 1;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Enter Title</div>"
				).addClass('alert-danger').fadeTo(900, 1);
				return false;
			}

			if (sel2.length == 0) {


				if (sel2.length == 0) {
					$("#msgbox3").html(
						"<div class='alert alert-warning alert-danger' id='msgbox3' style='opacity: 1;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Select Products That Should Come Under Gifts</div>"
					).addClass('alert-danger').fadeTo(900, 1);
					return false;
				}
			}
			return true;
		}


		$("#validate").click(function() {


			if (check_vase() == false) {

				return false;
			} else {
				$("#organization_validate").submit();
				//return true;
			}
		});*/
	</script>

</body>
<!-- END BODY-->

</html>