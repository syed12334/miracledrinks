<?php //echo $data; exit; ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

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
	<link rel="stylesheet" href="<?php echo asset_url(); ?>css/style.min.css" />
	<!-- <link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo asset_url(); ?>css/main.css" />
	<link rel="stylesheet" href="<?php echo asset_url(); ?>css/theme.css" />
	<link rel="stylesheet" href="<?php echo asset_url(); ?>css/MoneAdmin.css" />
	<link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/Font-Awesome/css/font-awesome.css" /> -->
	<!--END GLOBAL STYLES -->

	<!-- PAGE LEVEL STYLES -->

	<link href="<?php echo asset_url(); ?>plugins/flot/examples/examples.css" rel="stylesheet" />

	<?php echo $updatelogin; ?>
	<?php echo $popcss; ?>
	<style type="text/css">
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

		.btn-resend {
			background-color: #8A2BE2;
			border-color: #8A2BE2;
			color: #ffffff !important;
		}

		.btn-grad.btn-resend {
			background-image: linear-gradient(to bottom, #8A2BE2, #8A2BE2);
			border-color: rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.4);
		}

		.btn-grad.btn-resend:hover,
		.btn-grad.btn-resend:focus,
		.btn-grad.btn-resend:active,
		.btn-grad.btn-resend.active {
			background-image: none;
			border-color: rgba(0, 0, 0, 0.4) rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.2);
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) inset;
		}

		.btn-invoice {
			background-color: #6495ED;
			border-color: #6495ED;
			color: #ffffff !important;
		}

		.btn-grad.btn-invoice {
			background-image: linear-gradient(to bottom, #6495ED, #6495ED);
			border-color: rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.4);
		}

		.btn-grad.btn-invoice:hover,
		.btn-grad.btn-invoice:focus,
		.btn-grad.btn-invoice:active,
		.btn-grad.btn-invoice.active {
			background-image: none;
			border-color: rgba(0, 0, 0, 0.4) rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.2);
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) inset;
		}
	</style>
	<!-- END PAGE LEVEL  STYLES -->
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript">
		var base_url = '<?php echo base_url(); ?>';

		function closethisanddintRedirect() {
			$("#mask").html("");
			$("#overlay").height(0).removeClass();
			//$("#flex1").flexOptions({newp: $("#flex1").flexGetPageNumber()}).flexReload();  
		}

		
        function changestatus(st, id) {
          
			
			var base_url = '<?php echo base_url(); ?>';
            // alert(st);
            switch (st) {
                case 0:
                    var msg = "Are you sure,you want to activate ?";
                    break;
                case 1:
                    var msg = "Are you sure,you want to deactivate ?";
                    break;
                case 2:
                    var msg = "Are you sure,you want to delete ?";
                    break;
            }
            if (confirm(msg)) {
                $.ajax({
                    type: "POST",
                    url: base_url + "reports/review_status",
                    data: {
                        items: id,
                        status: st
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
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
							$.post(base_url + "reports/sendsms_status", {
								items: id,
								status: st
							}, function(data) {
								location.reload();
							});

						},
						/*error: function (request, status, error) {
						    alert(request.responseText);
						}*/
					});
				}
			}
		}
	</script>
	<style type="text/css">
		.myloader {
			background: none repeat scroll 0 0 rgba(255, 255, 255, 0.5);
			display: block;
			height: 100%;
			position: fixed;
			width: 100%;
			background-image: url("../images/loader.gif");
			background-position: center;
			background-repeat: no-repeat;
			z-index: 999;
		}
	</style>
</head>
<!-- END  HEAD-->
<!-- BEGIN BODY-->

<body class="padTop53 ">
	<span class="myloader" style="display:none;"></span>
	<!-- MAIN WRAPPER -->

	<!-- MAIN WRAPPER -->
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
						<h3 class="text-themecolor mb-0">Orders Report</h3>
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
							<li class="breadcrumb-item active">Orders Report</li>
						</ol>
					</div>
					<div class="col-md-7 col-12 align-self-center d-none d-md-block">

					</div>
				</div>
				<div class="container-fluid" id="content">

					<div class="inner" style="min-height:700px;">
						<div class="row">
							<div class="col-lg-12">
								

								<?php echo $data; ?>

							</div>
						</div><br><br>
						
						<div class="form-actions no-margin-bottom" style="text-align:center;">
							<a href="<?php echo base_url() . 'reports/reviews'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left"></i> Back</a>&nbsp;
						</div>
						
					</div>
				</div>
				<!--END PAGE CONTENT -->

			</div>
		</div>
	</div>

	<!--END MAIN WRAPPER -->

	<!-- FOOTER -->
	<div id="footer">
		<p>&copy; <?php echo fottertitle; ?></p>
	</div>
	<!--END FOOTER -->

	<!-- GLOBAL SCRIPTS -->
	<script src="<?php echo asset_url(); ?>plugins/jquery-2.0.3.min.js"></script>
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
		$(function() {


			$("body").on("focus", ".datepicker", function(e) {
				$(".datepicker").datepicker({
					dateFormat: "dd-mm-yy"
				});
			});

		});
	</script>
	<!-- END GLOBAL SCRIPTS -->

</body>
<!-- END BODY-->

</html>