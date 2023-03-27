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
	<link rel="stylesheet" type="text/css" href="https://www.srisankaratv.com/admin_manage/assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
	<?php echo $updatelogin; ?>
	<?php echo $popcss; ?>

	<?php $id = $this->uri->segment(3); ?>


	<style>
		.updatedetail {
			width: 350px !important;
			height: 66px !important;
		}

		.btn-packing {
			background-color: #a264e7;
			border-color: #62309a;
			color: #ffffff !important;
		}

		.btn-grad.btn-packing {
			background-image: linear-gradient(to bottom, #a264e7, #a264e7);
			border-color: rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.4);
		}

		.btn-grad.btn-packing:hover,
		.btn-grad.btn-packing:focus,
		.btn-grad.btn-packing:active,
		.btn-grad.btn-packing.active {
			background-image: none;
			border-color: rgba(0, 0, 0, 0.4) rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.2);
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) inset;
		}

		.btn-transmit {
			background-color: #999999;
			border-color: #999999;
			color: #ffffff !important;
		}

		.btn-grad.btn-transmit {
			background-image: linear-gradient(to bottom, #999999, #999999);
			border-color: rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.4);
		}

		.btn-grad.btn-transmit:hover,
		.btn-grad.btn-transmit:focus,
		.btn-grad.btn-transmit:active,
		.btn-grad.btn-transmit.active {
			background-image: none;
			border-color: rgba(0, 0, 0, 0.4) rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.2);
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) inset;
		}


		.btn-refund {
			background-color: #FF69B4;
			border-color: #FFC0CB;
			color: #ffffff !important;
		}

		.btn-grad.btn-refund {
			background-image: linear-gradient(to bottom, #FF69B4, #FF69B4);
			border-color: rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.4);
		}

		.btn-grad.btn-refund:hover,
		.btn-grad.btn-refund:focus,
		.btn-grad.btn-refund:active,
		.btn-grad.btn-refund.active {
			background-image: none;
			border-color: rgba(0, 0, 0, 0.4) rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.2);
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) inset;
		}

		.flex-Failed {

			background: none repeat scroll 0 0 #B94A48;

			color: #FFFFFF;

			height: 100%;

			margin-right: 1px;

			padding: 2px;

			text-align: center;

			width: 100%;

		}

		.flex-Completed {

			background: none repeat scroll 0 0 #468847;

			color: #FFFFFF;

			height: 100%;

			margin-right: 1px;

			padding: 2px;

			text-align: center;

			width: 100%;

		}

		.imagewh {

			height: 20px;

			width: 20px;

		}
	</style>



	<style>
		.badge-orange {

			background-color: #FE5E00;

		}

		.showhide {

			float: right;

			cursor: pointer;



		}
	</style>





	<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->

	
	<!--<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/flexigrid.css" />-->
    <link href="<?=asset_url()?>css/dataTables.bootstrap4.css" rel="stylesheet">
	<link href="<?=asset_url()?>css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=asset_url()?>/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo asset_url()?>css/jquery-ui.css">
	<?php $id = $this->uri->segment(3); ?>
	<script type="text/javascript">
		var filterhiden = 1;

		function showfilter() {

			if (filterhiden == 1)

			{



				$("#filterbody").show();
				filterhiden = 0;

				$('#toggleimage').attr('src', "<?php echo asset_url(); ?>images/minus-sign.png");



			} else

			{

				$("#filterbody").hide();
				filterhiden = 1;

				$('#toggleimage').attr('src', "<?php echo asset_url(); ?>images/plus-sign.png");

			}
		}

		$(document).ready(function() {

			$("#filterbody").hide();

			<?php

			if ($id) {

				echo "submitfilterstatus(" . $id . ");";
			}

			?>

		});



		var base_url = '<?php echo base_url(); ?>';

		$(document).ready(function() {



			$("#flex1").flexigrid

			({

				url: base_url + 'reports/user_ordersTable',

				dataType: 'json',

				colModel: [{
						display: 'Sl.No.',
						width: 40,
						sortable: false,
						align: 'center'
					},
					{
						display: 'Actions',
						width: 250,
						sortable: true,
						align: 'center'
					},
					{
						display: 'Order No.',
						width: 140,
						name: 'o.orderid',
						sortable: true,
						align: 'center'
					},
					{
						display: 'Ordered Date',
						name: 'o.ordered_date',
						width: 140,
						sortable: true,
						align: 'center'
					},
					{
						display: 'Order Status',
						width: 100,
						sortable: true,
						align: 'center'
					},
					{
						display: 'Ordered By',
						width: 140,
						name: 'u.name',
						sortable: true,
						align: 'center'
					},
					{
						display: 'Email ID',
						width: 140,
						name: 'u.emailid',
						sortable: true,
						align: 'center'
					},
					{
						display: 'Phone',
						width: 140,
						name: 'u.phone',
						sortable: true,
						align: 'center'
					},
					{
						display: 'Total Qty',
						name: 'o.tot_qty',
						width: 100,
						sortable: true,
						align: 'center'
					},
					{
						display: 'Total Amount',
						name: 'o.pamount_debit',
						width: 100,
						sortable: true,
						align: 'center'
					}
				],

				showToggleBtn: false,
				onError: function(data) {

					for (var i in data) {

						alert("Header: " + i + "\nMessage: " + data[i]);

					}

				},

				sortname: "o.id",

				sortorder: "desc",

				onSubmit: addFormData,

				usepager: true,

				useRp: true,

				rp: 10,

				showTableToggleBtn: false,

				width: 1000,

				height: 300

			});


			$('#productadd').submit(function() {

				$('#flex1').flexOptions({
					newp: 1
				}).flexReload();

				return false;

			});



			$('#resetbtn').click(function() {
				document.getElementById("productadd").reset();
				$('#flex1').flexReload();
				return false;
			});

		});

		function changestatus(st, id) {
			var base_url = '<?php echo base_url(); ?>';
			if (confirm('Change status of the item?')) {
				var docHeight = $(document).height();
				$("body").append("<div id='overlay'></div>");
				$("#overlay").height(docHeight).removeClass().addClass("addoverlay");
				$("body").append("<div id='mask' style='position:fixed; top:8%; left:25%; z-index:10000; height:100%;'></div>");
				$("#mask").html('<div class="alpha30" style="margin-left:50%; margin-top:50%;"><div class="white"><img src="<?php echo asset_url(); ?>images/36.gif" /></div></div>');
				$("#mask").load('<?php echo base_url(); ?>reports/orders_status?items=' + id + '&status=' + st, function(data) {location.reload();});

			}
		}

		function submitstatus(st, id) {
			var empty_string = /^\s*$/;
			var fromdate = $("#sfromdate").val();
			var todate = $("#stodate").val();
			var base_url = '<?php echo base_url(); ?>';
			var msg = 'Update status of the item with dates?';
			if (st == "0") {
				msg = 'Update only dates?';
			}
			$("#gmsgbox").html('<div class="alert alert-warning alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Please wait...</div>');
			if ($.trim(fromdate) == "") {
				$("#gmsgbox").html('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Select ' + $(".sfromdate").html() + '.</div>');
			} else {
				if (confirm(msg)) {
					$.ajax({
						type: "POST",
						dataType: "json",
						url: base_url + "reports/submit_status",
						data: {
							items: id,
							status: st,
							fromdate: fromdate,
							todate: todate
						},
						success: function(data) {
							closethisanddintRedirect();
							$("#flex1").flexOptions({
								newp: $("#flex1").flexGetPageNumber()
							}).flexReload();
							$.post(base_url + "reports/sendsms_status", {
								items: id,
								status: st
							}, function(data) {

							});
						},
						/*error: function (request, status, error) {
						    alert(request.responseText);
						}*/
					});
				}
			}
		}


		function closethisanddintRedirect() {
			$("#mask").html("");
			$("#overlay").height(0).removeClass();
			$("#flex1").flexOptions({
				newp: $("#flex1").flexGetPageNumber()
			}).flexReload();
		}

		function addFormData() {

			//passing a form object to serializeArray will get the valid data from all the objects, but, if the you pass a non-form object, you have to specify the input elements that the data will come from

			var dt = $('#productadd').serializeArray();

			$("#flex1").flexOptions({
				params: dt
			});

			return true;

		}

		function submitfilterstatus(ststaus) {
			$("#choosestatus").val(ststaus);
			$('#flex1').flexOptions({
				newp: 1
			}).flexReload();

			return false;

		}


		function view(id) {

			document.location.href = '<?php echo base_url(); ?>reports/orders_view?id=' + id;

		}

		function download() {
			document.location.href = "<?php echo base_url() ?>reports/export_orders?fromdate=" + $("#fromdate").val() + "&todate=" + $("#todate").val() + "&orderno=" + $("#orderno").val() + "&name=" + $("#name").val() + "&email=" + $("#email").val() + "&phone=" + $("#phone").val() + "&choosestatus=" + $("#choosestatus").val();
		}
	</script>

</head>

<!-- END  HEAD-->

<!-- BEGIN BODY-->

<body class="padTop53 ">


	<div id="wrap">
		<div id="main-wrapper">

			<!-- HEADER SECTION -->
			<?php echo $header; ?>
			<!-- END HEADER SECTION -->



			<!-- MENU SECTION -->
			<?php echo $left; ?>
			<!--END MENU SECTION -->

			<div class="page-wrapper">
				<!-- ============================================================== -->
				<!-- Bread crumb and right sidebar toggle -->
				<!-- ============================================================== -->
				<div class="row page-titles">
					<div class="col-md-5 col-12 align-self-center">
						<h3 class="text-themecolor mb-0">Order Report</h3>
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
							<li class="breadcrumb-item active">User Orders</li>
						</ol>
					</div>
					<div class="col-md-7 col-12 align-self-center d-none d-md-block">

					</div>
				</div>

				<div class="container-fluid" id="content">



					<div class="inner" style="min-height:700px;">

						<div class="row">

							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<form id="productadd" class="form-material" method="post">

											<table class="table table-bordered">

												<thead>

													<tr>

														<th colspan="2" onClick="showfilter()" style="cursor:pointer;">Search <div class="showhide" onClick="showfilter()"><img src="<?php echo asset_url(); ?>images/plus-sign.png" id="toggleimage" onClick="showfilter()"></div>
														</th>

													</tr>

												</thead>

												<tbody id="filterbody">


													<tr>

														<td>From Date:</td>

														<td><input type="text" name="fromdate" id="fromdate" class="form-control today_date_time" readonly ></td>

													</tr>

													<tr>

														<td>To Date:</td>

														<td><input type="text" name="todate" id="todate" class="form-control today_date_time" readonly ></td>

													</tr>

													<tr>

														<td>Order No:</td>

														<td><input type="text" name="orderno" id="orderno" class="form-control" ></td>

													</tr>

													<tr>

														<td>Order By:</td>

														<td><input type="text" name="name" id="name" class="form-control" ></td>

													</tr>

													<tr>

														<td>Email ID:</td>

														<td><input type="text" name="email" id="email" class="form-control" ></td>

													</tr>

													<tr>

														<td>Phone:</td>

														<td>+91 <input type="text" name="phone" id="phone" class="form-control" ></td>

													</tr>

													<tr>

														<td>Status:</td>

														<td>

															<select name="choosestatus" id="choosestatus" class="form-control" >

																<option value="" selected>All</option>

																<option value="1">New</option>

																<option value="2">In-Progress</option>

																<option value="3">Shipped</option>

																<option value="4">Delivered</option>

																<option value="-1">Failed</option>

															</select>

														</td>

													</tr>

													<tr>

														<td colspan="2">

														<!--<button type="submit" class="btn btn-info"><i class="mdi mdi-magnify"></i> Search</button>-->
														<button type="button" class="btn btn-info" id="view" onclick="initialiseData();"><i class="fa  fa-search"></i> Search</button>
															<button type="reset" class="btn btn-primary" id="resetbtn"><i class="mdi mdi-refresh"></i> Reset</button>
															<button type="button" class="btn btn-primary" onclick="download();"><i class="fas fa-file"></i> Export</button>
														</td>



													</tr>

												</tbody>

											</table>

										</form>

								<!--<table id="flex1"></table>-->
								<div class="scroll-sidebar">
									
										<div class="table-responsive">
											<!--<div class="box-body" id="DataTableValue">
												<?php echo $review_report; ?>
											</div>-->
											<div class="box-body" id="DataTableValue">
											  <table id="user_data" class="table table-bordered table-striped">  
												 <thead>  
													   <tr>
															 <th>Sl. No.</th>
															<th>Actions</th>
															<th>Order No.</th>
															<th>Ordered Date</th>
															<th>Order Status</th>
															<th>Ordered By</th>
															<th>Email ID</th>
															<th>Phone</th>
															<th>Total Qty</th>
															<th>Total Amount</th>
													  </tr>							  
												 </thead>  
											 </table> 
											</div>


										</div>
									
								</div>  


										<div class="col-lg-12">

											<div class="modal fade" id="uiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">



											</div>

										</div>
									</div>
								</div>
							</div>

						</div>



						<hr />

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

			<script src="<?php echo asset_url(); ?>plugins/bootstrap/js/bootstrap.min.js"></script>

			<script src="<?php echo asset_url(); ?>plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>

			<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">

			<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

			<script src="<?php echo asset_url(); ?>libs/jquery/dist/jquery.min.js"></script>
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
			
			 $(function () {
			  $("#user_data").dataTable().fnDestroy();
			  initialiseData();	
		  });
	     var dataTable;
	    
	     function initialiseData(){
			var fromdate = $('#fromdate').val();
			var todate = $('#todate').val();
			var orderno = $('#orderno').val();
			var name = $('#name').val();
			var email = $('#email').val();
			var phone = $('#phone').val();
			var choosestatus = $('#choosestatus').val();
			$("#user_data").dataTable().fnDestroy();
	    	dataTable = $('#user_data').DataTable({  
	             "processing":true,  
	             "serverSide":true,  
	             "order":[],  
	             "ajax":{  
	                  url:"<?php echo base_url().'reports/getorders';?>",
	                  type:"POST",
					  data:{fromdate:fromdate,todate:todate,orderno:orderno,name:name,email:email,phone:phone,choosestatus:choosestatus},
	                  error: function(){  // error handling
							$(".user_data-error").html("");
							$("#user_data").append('<tbody class="user_data-error"><tr><th colspan="8">No data found in the server</th></tr></tbody>');
							$("#user_data_processing").css("display","none");
						}
	             },  
	             "columnDefs":[  
	                  {  
	                       "targets":[0, 1],  
	                       "orderable":false,  
	                  },  
	             ],  
	        }); 
	    }

			
				$(function() {


					$("body").on("focus", ".datepicker", function(e) {
						$(".datepicker").datepicker({
							dateFormat: "dd-mm-yy"
						});
					});

				});
			</script>


			<script type="text/javascript" src="<?php echo asset_url(); ?>flexigrid.js"></script>
			<?php $id = $this->uri->segment(3); ?>
			<script type="text/javascript">
				var filterhiden = 1;

				function showfilter() {

					if (filterhiden == 1)

					{



						$("#filterbody").show();
						filterhiden = 0;

						$('#toggleimage').attr('src', "<?php echo asset_url(); ?>images/minus-sign.png");



					} else

					{

						$("#filterbody").hide();
						filterhiden = 1;

						$('#toggleimage').attr('src', "<?php echo asset_url(); ?>images/plus-sign.png");

					}
				}

				$(document).ready(function() {

					$("#filterbody").hide();

					<?php

					if ($id) {

						echo "submitfilterstatus(" . $id . ");";
					}

					?>

				});



				var base_url = '<?php echo base_url(); ?>';

				$(document).ready(function() {



					$("#flex1").flexigrid

					({

						url: base_url + 'reports/user_ordersTable',

						dataType: 'json',

						colModel: [{
								display: 'Sl.No.',
								width: 40,
								sortable: false,
								align: 'center'
							},
							{
								display: 'Actions',
								width: 250,
								sortable: true,
								align: 'center'
							},
							{
								display: 'Order No.',
								width: 140,
								name: 'o.orderid',
								sortable: true,
								align: 'center'
							},
							{
								display: 'Ordered Date',
								name: 'o.ordered_date',
								width: 140,
								sortable: true,
								align: 'center'
							},
							{
								display: 'Order Status',
								width: 100,
								sortable: true,
								align: 'center'
							},
							{
								display: 'Ordered By',
								width: 140,
								name: 'u.name',
								sortable: true,
								align: 'center'
							},
							{
								display: 'Email ID',
								width: 140,
								name: 'u.emailid',
								sortable: true,
								align: 'center'
							},
							{
								display: 'Phone',
								width: 140,
								name: 'u.phone',
								sortable: true,
								align: 'center'
							},
							{
								display: 'Total Qty',
								name: 'o.tot_qty',
								width: 100,
								sortable: true,
								align: 'center'
							},
							{
								display: 'Total Qty',
								name: 'o.pamount_debit',
								width: 100,
								sortable: true,
								align: 'center'
							}
						],

						showToggleBtn: false,
						onError: function(data) {

							for (var i in data) {

								alert("Header: " + i + "\nMessage: " + data[i]);

							}

						},

						sortname: "o.id",

						sortorder: "desc",

						onSubmit: addFormData,

						usepager: true,

						useRp: true,

						rp: 10,

						showTableToggleBtn: false,

						width: 1000,

						height: 300

					});


					$('#productadd').submit(function() {

						$('#flex1').flexOptions({
							newp: 1
						}).flexReload();

						return false;

					});



					$('#resetbtn').click(function() {
						document.getElementById("productadd").reset();
						$('#flex1').flexReload();
						return false;
					});

				});

				function changestatus(st, id) {
					var base_url = '<?php echo base_url(); ?>';
					if (confirm('Change status of the item?')) {
						var docHeight = $(document).height();
						$("body").append("<div id='overlay'></div>");
						$("#overlay").height(docHeight).removeClass().addClass("addoverlay");
						$("body").append("<div id='mask' style='position:fixed; top:8%; left:25%; z-index:10000; height:100%;'></div>");
						$("#mask").html('<div class="alpha30" style="margin-left:50%; margin-top:50%;"><div class="white"><img src="<?php echo asset_url(); ?>images/36.gif" /></div></div>');
						$("#mask").load('<?php echo base_url(); ?>reports/orders_status?items=' + id + '&status=' + st, function(data) {});

					}
				}

				function submitstatus(st, id) {
					var empty_string = /^\s*$/;
					var fromdate = $("#sfromdate").val();
					var todate = $("#stodate").val();
					var base_url = '<?php echo base_url(); ?>';
					var msg = 'Update status of the item with dates?';
					if (st == "0") {
						msg = 'Update only dates?';
					}
					$("#gmsgbox").html('<div class="alert alert-warning alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Please wait...</div>');
					if ($.trim(fromdate) == "") {
						$("#gmsgbox").html('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Select ' + $(".sfromdate").html() + '.</div>');
					} else {
						if (confirm(msg)) {
							$.ajax({
								type: "POST",
								dataType: "json",
								url: base_url + "reports/submit_status",
								data: {
									items: id,
									status: st,
									fromdate: fromdate,
									todate: todate
								},
								success: function(data) {
									closethisanddintRedirect();
									$("#flex1").flexOptions({
										newp: $("#flex1").flexGetPageNumber()
									}).flexReload();
									$.post(base_url + "reports/sendsms_status", {
										items: id,
										status: st
									}, function(data) {

									});
								},
								/*error: function (request, status, error) {
								    alert(request.responseText);
								}*/
							});
						}
					}
				}


				function closethisanddintRedirect() {
					$("#mask").html("");
					$("#overlay").height(0).removeClass();
					$("#flex1").flexOptions({
						newp: $("#flex1").flexGetPageNumber()
					}).flexReload();
				}

				function addFormData() {

					//passing a form object to serializeArray will get the valid data from all the objects, but, if the you pass a non-form object, you have to specify the input elements that the data will come from

					var dt = $('#productadd').serializeArray();

					$("#flex1").flexOptions({
						params: dt
					});

					return true;

				}

				function submitfilterstatus(ststaus) {
					$("#choosestatus").val(ststaus);
					$('#flex1').flexOptions({
						newp: 1
					}).flexReload();

					return false;

				}
				
				function geninvoice(id)
				{
					var base_url = '<?php echo base_url();?>';
					if(confirm('Are you sure?'))
					{
						var docHeight = $(document).height();
						$("body").append("<div id='overlay'></div>");
						$("#overlay").height(docHeight).removeClass().addClass("addoverlay");
						$("body").append("<div id='mask' style='position:fixed; top:8%; left:25%; z-index:10000; height:100%;'></div>");
						$("#mask").html('<div class="alpha30" style="margin-left:50%; margin-top:50%;"><div class="white"><img src="<?php echo asset_url();?>images/36.gif" /></div></div>');
						$("#mask").load('<?php echo base_url();?>reports/geninvoice?items='+id+'&status=0', function(data){});
					}
				}
				function genincentive (id)
				{
					var base_url = '<?php echo base_url();?>';
					if(confirm('Are you sure?'))
					{
						var docHeight = $(document).height();
						$("body").append("<div id='overlay'></div>");
						$("#overlay").height(docHeight).removeClass().addClass("addoverlay");
						$("body").append("<div id='mask' style='position:fixed; top:8%; left:25%; z-index:10000; height:100%;'></div>");
						$("#mask").html('<div class="alpha30" style="margin-left:50%; margin-top:50%;"><div class="white"><img src="<?php echo asset_url();?>images/36.gif" /></div></div>');
						$("#mask").load('<?php echo base_url();?>reports/genincentive?items='+id+'&status=0', function(data){});
					}
				}

				function view(id) {

					document.location.href = '<?php echo base_url(); ?>reports/orders_view?id=' + id;

				}

				function download() {
					document.location.href = "<?php echo base_url() ?>reports/export_orders?fromdate=" + $("#fromdate").val() + "&todate=" + $("#todate").val() + "&orderno=" + $("#orderno").val() + "&name=" + $("#name").val() + "&email=" + $("#email").val() + "&phone=" + $("#phone").val() + "&choosestatus=" + $("#choosestatus").val();
				}
				
				function submit_invoice(id){
	var empty_string = /^\s*$/;
	var invoice_date = $("#invoice_date").val();
	var base_url = '<?php echo base_url();?>';
	
	if($.trim(invoice_date) == ""){
		$("#gmsgbox").html('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Select Invoice Date.</div>');
	}else{
		$("#gmsgbox").html('');
	    if(confirm('Are your sure?'))
	    {    
			//window.location.href = "<?=base_url().'reports/createInvoice'?>?items="+id+"&invoice_date="+invoice_date;   
	    	
			$("#gmsgbox").html('<div class="alert alert-warning alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Please wait...</div>');
	        $.ajax({
	            type: "POST",
	            dataType: "json",
	            url: base_url+"reports/createInvoice",
	            data: {items:id,invoice_date:invoice_date},
                success: function(data){
		            console.log(data);
	            	//closethisanddintRedirect();
	            	//$("#flex1").flexOptions({newp: $("#flex1").flexGetPageNumber()}).flexReload();  
	            	$("#mask").load('<?php echo base_url();?>reports/download_invoice?items='+id+'&status=0', function(data){});
	            },error: function (request, status, error) {
		            //alert("status"+status);
		            //alert("error"+error);
	                // alert(request.responseText);
	            }
	        });
	    }
	}
}

function submit_incentive(id){
	var empty_string = /^\s*$/;
	var invoice_date = $("#invoice_date").val();
	var base_url = '<?php echo base_url();?>';
	
	if($.trim(invoice_date) == ""){
		$("#gmsgbox").html('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Select Invoice Date.</div>');
	}else{
		$("#gmsgbox").html('');
	    if(confirm('Are your sure?'))
	    {    
			//window.location.href = "<?=base_url().'reports/createInvoice'?>?items="+id+"&invoice_date="+invoice_date;   
	    	
			$("#gmsgbox").html('<div class="alert alert-warning alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Please wait...</div>');
	        $.ajax({
	            type: "POST",
	            dataType: "json",
	            url: base_url+"reports/createIncentive",
	            data: {items:id,invoice_date:invoice_date},
                success: function(data){
		            console.log(data);
	            	//closethisanddintRedirect();
	            	//$("#flex1").flexOptions({newp: $("#flex1").flexGetPageNumber()}).flexReload();  
	            	$("#mask").load('<?php echo base_url();?>reports/download_incentive?items='+id+'&status=0', function(data){});
	            },error: function (request, status, error) {
		            //alert("status"+status);
		            //alert("error"+error);
	                // alert(request.responseText);
	            }
	        });
	    }
	}
}
			</script>

			<!-- END GLOBAL SCRIPTS -->
<script src="https://www.srisankaratv.com/admin_manage/assets/libs/moment/moment.js"></script>
    <script src="https://www.srisankaratv.com/admin_manage/assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js"></script>

	<script>
	    $('.today_date_time').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD', time:false});
	</script>


</body>

<!-- END BODY-->



</html>