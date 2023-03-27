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
	<script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.min.js"></script>

	<?php echo $updatelogin; ?>
</head>
<!-- END  HEAD-->
<!-- BEGIN BODY-->

<body class="padTop53 ">

	<!-- MAIN WRAPPER -->
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
						<h3 class="text-themecolor mb-0">Coupons</h3>
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
							<li class="breadcrumb-item active">Coupons</li>
						</ol>
					</div>
					<div class="col-md-7 col-12 align-self-center d-none d-md-block">

					</div>
				</div>

				<div class="container-fluid" id="content">
					<div class="inner" style="min-height:1200px;">
						<div class="row">
							<div class="col-lg-12">

								<div class="col-lg-12">
									<div class="card">

										<div id="collapseOne" class="card-body">
											<div class="panel-body">
												<div class="col-lg-10">
													<table class="table table-bordered table-striped">
														<tr>
															<th style="width: 30%;">Coupon Type </th>
															<td><?php $arr = array("Single Usage", "Multiple Usage");
																echo $arr[$details[0]->type]; ?></td>

														</tr>
														<tr>
															<th>Coupon Title</th>
															<td><?php echo $details[0]->title; ?></td>
														</tr>

														<tr>
															<th>From Date</th>
															<td><?php echo date_format(date_create($details[0]->from_date), 'd-m-Y'); ?></td>
														</tr>

														<tr>
															<th>To Date </th>
															<td><?php echo date_format(date_create($details[0]->to_date), 'd-m-Y'); ?></td>
														</tr>

														<tr>
															<th>Discount(%) </th>
															<td><?php echo $details[0]->discount; ?></td>
														</tr>

														<tr>
															<th>Prefix of Coupon Code </th>
															<td><?php echo $details[0]->prefix; ?></td>
														</tr>

														<tr>
															<th>Coupon Codes </th>
															<td>
																<?php $check = $this->master_db->getcontent1('voucher_code', 'cid', $details[0]->id); ?>
																<div class="box col-lg-12">
																	<header>
																		<h5>Coupon Codes (<?php echo count($check); ?>)</h5>
																		<div class="toolbar">
																			<div class="btn-group">
																				<a class="btn btn-default btn-sm accordion-toggle minimize-box" data-toggle="collapse" href="#sortableTable">
																					<i class="icon-chevron-up"></i>
																				</a>
																			</div>
																		</div>
																	</header>
																	<div class="body collapse in" id="sortableTable">
																		<div <?php if (count($check) > 12) { ?> style="overflow-y:scroll;height:500px;" <?php } ?>>
																			<table class="table table-striped table-bordered table-hover">
																				<thead>
																					<th>Sl No</th>
																					<th>Coupon Code</th>
																					<th>No. of Times Used</th>
																					<th>Status</th>
																				</thead>
																				<tbody>
																					<?php if (is_array($check)) { ?>
																						<?php $i = 0;
																						$arr = array("Active", "In-Active");
																						foreach ($check as $c) { ?>
																							<tr>
																								<td><?php echo $i = $i + 1; ?></td>
																								<td><?php echo $c->code ?></td>
																								<td><?php echo $c->used_count; ?></td>
																								<td><?php echo $arr[$c->status]; ?></td>
																							</tr>
																						<?php
																						}
																					} else { ?>
																						<tr>
																							<td colspan="4">No Coupon Codes</td>
																						</tr>
																					<?php }
																					?>
																				</tbody>
																			</table>
																		</div>
																	</div>
																</div>

															</td>
														</tr>

														<tr>
															<td colspan="2" class="text-center"><a href="<?php echo base_url() . 'voucher/gift_vouchers'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left"></i> Back</a></td>
														</tr>

													</table>
												</div>
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
		</div>
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
	<!-- END GLOBAL SCRIPTS -->


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


</body>
<!-- END BODY-->

</html>