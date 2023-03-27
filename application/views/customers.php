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
	<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
	<!--<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/flexigrid.css" />-->
    <link href="<?=asset_url()?>css/dataTables.bootstrap4.css" rel="stylesheet">
	<link href="<?=asset_url()?>css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=asset_url()?>/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo asset_url()?>css/jquery-ui.css">  
	<link rel="stylesheet" type="text/css" href="https://www.srisankaratv.com/admin_manage/assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
	<?php echo $updatelogin; ?>
	<?php echo $popcss; ?>
	<style>
		.updatedetail {
			width: 350px !important;
			height: 66px !important;
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
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/flexigrid.css" />
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
			<!--PAGE CONTENT -->
			<div class="page-wrapper">
				<!-- ============================================================== -->
				<!-- Bread crumb and right sidebar toggle -->
				<!-- ============================================================== -->
				<div class="row page-titles">
					<div class="col-md-5 col-12 align-self-center">
						<h3 class="text-themecolor mb-0">Registered Users</h3>
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
							<li class="breadcrumb-item active">Registered Users</li>
						</ol>
					</div>
					<div class="col-md-7 col-12 align-self-center d-none d-md-block">

					</div>
				</div>
				<div class="container-fluid" id="content">
					<div class="inner" style="min-height:700px;">
						<div class="card">
							<div class="card-body">
								<!--<form id="productadd" method="post" class="form-material">-->
								    <form class="form-horizontal form-material"  method="post"  id="validate">
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
												<td><input type="text" name="fromdate" id="fromdate" class="form-control today_date_time"  ></td>
											</tr>
											<tr>
												<td>To Date:</td>
												<td><input type="text" name="todate" id="todate" class="form-control today_date_time"  ></td>
											</tr>
											<tr>
												<td>Name:</td>
												<td><input type="text" name="name" id="name" class="form-control" ></td>
											</tr>
											<tr>
												<td>Email ID:</td>
												<td><input type="text" name="email" id="email" class="form-control" ></td>
											</tr>
											<tr>
												<td>Contact No.:</td>
												<td><input type="text" name="contact" id="contact" class="form-control" ></td>
											</tr>
											<tr>
												<td>Town:</td>
												<td><input type="text" name="town" id="town" class="form-control" ></td>
											</tr>
											<tr>
												<td>Zip:</td>
												<td><input type="text" name="zip" id="zip" class="form-control" ></td>
											</tr>
											<tr>
												<td>State:</td>
												<td><input type="text" name="state" id="state" class="form-control" ></td>
											</tr>
											<tr>
												<td>Country:</td>
												<td><input type="text" name="country" id="country" class="form-control" ></td>
											</tr>
											<tr>
												<td colspan="2">
													<!--<button type="submit" class="btn btn-info" onclick="viewreport();"><i class="mdi mdi-magnify"></i> Search</button>-->
													<button type="button" class="btn btn-info" id="view" onclick="viewreport();"><i class="fa  fa-search"></i> Search</button>
													
													<button type="reset" class="btn btn-primary" id="resetbtn"><i class="mdi mdi-refresh"></i> Reset</button>
													<button type="button" class="btn btn-info" onclick="download();"><i class="fas fa-file"></i> Export</button>
												</td>
											</tr>
										</tbody>
									</table>
								</form>
								<!--- <table id="flex1"></table>-->
								<div class="scroll-sidebar">
									 
										<div class="table-responsive">
											<div class="box-body" id="DataTableValue">
												<?php echo $customers; ?>
											</div>

										</div>
									 
								</div>


								<div class="col-lg-12">
									<!--<div class="modal fade" id="uiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
									<div class="modal fade" id="uiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header"> 
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Modal title</h4> 
											</div>
											<div class="modal-body"> ... </div> 
											<div class="modal-footer"> 
											</div>
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

		</div>
	</div>

	<!--END MAIN WRAPPER -->

	</div>
	</div>

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


	<script type="text/javascript" src="<?php echo asset_url(); ?>flexigrid.js"></script>

	<?php $id = $this->uri->segment(3); ?>

	<script type="text/javascript">
	
	 $(function () {
              $('#example1').DataTable();
          });
	
		  function viewreport()
	    {
			 $('#DataTableValue').html('Please wait loading.....</br><div class="progress"><div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div></div>');
				var fromdate = $('#fromdate').val();
				var todate = $('#todate').val();
				var name = $('#name').val();
				var email = $('#email').val();
				var contact = $('#contact').val();
				var town = $('#town').val();
				var zip = $('#zip').val();
				var state = $('#state').val();
				var country = $('#country').val();
				$.post('<?php echo base_url();?>reports/getcustomer_report',{fromdate:fromdate,todate:todate,name:name,email:email,contact:contact,town:town,zip:zip,state:state,country:country},function(data) 
				{
					$('#DataTableValue').html(data);
					$('#example1').DataTable();
					$( "#example_wrapper .row:nth-child(2)" ).addClass("table-responsive table0");
				});

	    }
	
		$(function () {
		$('#example1').DataTable();
		});
			
		$(document).ready(function() 
		{
			<?php
			if ($id) {
				echo "submitfilterstatus(" . $id . ");";
			}
			?>
			$('#productadd').submit(function() {
				$('#flex1').flexOptions({
					newp: 1
				}).flexReload();
				return false;
			});
			
			$('#resetbtn').click(function() {
				$('#DataTableValue').html(data);
				$('#example1').DataTable();
				return false;
			});
		});

		var filterhiden = 1;
		function showfilter()
		{
			if (filterhiden == 1)
			{
				$("#filterbody").show();
				filterhiden = 0;
				$('#toggleimage').attr('src', "<?php echo asset_url(); ?>images/minus-sign.png");
			} 
			else
			{
				$("#filterbody").hide();
				filterhiden = 1;
				$('#toggleimage').attr('src', "<?php echo asset_url(); ?>images/plus-sign.png");
			}
		}

		$(document).ready(function() {
			$("#filterbody").hide();
		});

		function closethisanddintRedirect() {
			$("#mask").html("");
			$("#overlay").height(0).removeClass();
			$("#flex1").flexOptions({
				newp: $("#flex1").flexGetPageNumber()
			}).flexReload();
			//reloadColorsdashboard();
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
            var base_url = '<?php echo base_url(); ?>';
            document.location.href = base_url + "reports/customer_view?id=" + id;
        }

		function download() {
			document.location.href = "<?php echo base_url() ?>reports/exportcust?fromdate=" + $("#fromdate").val() + "&todate=" + $("#todate").val() + "&email=" + $("#email").val() + "&name=" + $("#name").val() + "&contact=" + $("#contact").val() + "&company=" + $("#company").val() + "&town=" + $("#town").val() + "&zip=" + $("#zip").val() + "&state=" + $("#state").val() + "&country=" + $("#country").val();
		}
	</script>
	<script>
		/*$(function() {
			$("#fromdate").datepicker();
			$("#todate").datepicker();
		});*/
	</script>
	<script src="https://www.srisankaratv.com/admin_manage/assets/libs/moment/moment.js"></script>
    <script src="https://www.srisankaratv.com/admin_manage/assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js"></script>

	<script>
	    $('.today_date_time').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD', time:false});
	</script>
	<!-- END GLOBAL SCRIPTS -->
</body>
<!-- END BODY-->
</html>