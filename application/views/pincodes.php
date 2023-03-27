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
		<?php echo $updatelogin; ?>
		<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
		<!--<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/flexigrid.css" />-->
		<link href="<?=asset_url()?>css/dataTables.bootstrap4.css" rel="stylesheet">
		<link href="<?=asset_url()?>css/style.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?=asset_url()?>/css/select2.min.css">
		<link rel="stylesheet" href="<?php echo asset_url()?>css/jquery-ui.css">
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
							<h3 class="text-themecolor mb-0">Pincode</h3>
							<ol class="breadcrumb mb-0">
								<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
								<li class="breadcrumb-item"><a href="javascript:void(0)">Others</a></li>
								<li class="breadcrumb-item active">Pincode</li>
							</ol>
						</div>
						<div class="col-md-7 col-12 align-self-center d-none d-md-block">
							<div class="d-flex mt-2 justify-content-end">
								<a href="<?= base_url() ?>others/pincode_add" class="btn btn-info"><i class="mdi mdi-plus"></i> ADD Pincode</a>
							</div>
							<div class="d-flex mt-2 justify-content-end">
								<a href="<?= base_url() ?>others/pincode_csv" class="btn btn-info"><i class="mdi mdi-file-import"></i> Import Pincode</a>
							</div>
						</div>
					</div>
					<div class="container-fluid" id="content">
						<div class="inner" style="min-height:1200px;">
							<div class="card">
								<div class="card-body">                              
									<?php echo $this->session->flashdata('message'); ?>
									<!--- <table id="flex1"></table>-->
									<div class="card scroll-sidebar">
										<div class="card-body">
											<div class="table-responsive">
												<div class="box-body" id="DataTableValue">
													<?php echo $pincode; ?>
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
		<!-- FOOTER -->
		<div id="footer">
			<p>&copy; <?php echo fottertitle; ?></p>
		</div>
		<!--END FOOTER -->
		<!-- GLOBAL SCRIPTS -->
		<script src="<?php echo asset_url(); ?>plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo asset_url(); ?>plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<!-- END GLOBAL SCRIPTS -->
		<script src="<?php echo asset_url(); ?>plugins/validationengine/js/jquery.validationEngine.js"></script>
		<script src="<?php echo asset_url(); ?>plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
		<script src="<?php echo asset_url(); ?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
		<script src="<?php echo asset_url(); ?>plugins/jasny/js/bootstrap-fileupload.js"></script>
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
		<script type="text/javascript">
			/*$(document).ready(function() {
				var base_url = '<?php echo base_url(); ?>';
				$("#flex1").flexigrid({
					url: base_url + 'others/pincode_table',
					dataType: 'json',
					colModel: [{
							display: 'Sl No.',
							name: 'id',
							width: 70,
							align: 'center'
						},
						{
							display: 'Pincode',
							name: 'pincode',
							width: 200,
							sortable: true,
							align: 'center'
						},
						{
							display: 'Delivery Charges',
							name: 'charges',
							width: 200,
							sortable: true,
							align: 'center'
						},

						{
							display: 'Actions',
							width: 200,
							align: 'center'
						},
					],
					buttons: [{
							name: 'Add',
							bclass: 'add',
							onpress: test
						},
						{
							separator: true
						},

						{
							name: 'Delete',
							bclass: 'inactive',
							onpress: test
						},
						{
							separator: true
						},
						{
							name: 'Import CSV',
							bclass: 'export',
							onpress: test
						},
						{
							separator: true
						}
					],
					onError: function(data) {
						for (var i in data) {
							alert("Header: " + i + "\nMessage: " + data[i]);
						}
					},
					success: function(data) {
						for (var i in data) {
							alert("Header: " + i + "\nMessage: " + data[i]);
						}
					},
					sortname: "id",
					sortorder: "desc",
					usepager: true,
					useRp: true,
					rp: 10,
					showTableToggleBtn: false,
					width: 950,
					height: 255
				});

			});*/

				function test(com, grid) {
				if (com == 'Add') {
					var base_url = '<?php echo base_url(); ?>';
					document.location.href = base_url + "others/pincode_add";
				} else if (com == 'Import CSV') {
					var base_url = '<?php echo base_url(); ?>';
					document.location.href = base_url + "others/pincode_csv";
				} else if (com == 'Refresh') {
					sortAlpha("");
				} else if (com == 'Delete') {
					var base_url = '<?php echo base_url(); ?>';
					if ($('.trSelected', grid).length > 0) {
						if (confirm('Delete ' + $('.trSelected', grid).length + ' items?')) {
							var items = $('.trSelected', grid);
							var itemlist = '';
							for (i = 0; i < items.length; i++) {
								tempitems = items[i].id.split("^");
								itemlist += tempitems[0].substr(3) + ",";
							}
							// alert(itemlist);

							$.ajax({
								type: "POST",
								dataType: "json",
								url: base_url + "others/deletePins",
								data: "items=" + itemlist,
								success: function(data) {
									//alert(data);

									alert($('.trSelected', grid).length + " items are deleted Successfully");
									$("#flex1").flexOptions({
										newp: $("#flex1").flexGetPageNumber()
									}).flexReload();


									//$("#flex1").flexReload();
								}
								/*error: function(xhr, status, error) {
									alert(xhr.responseText);
								}*/
							});
						}
					} else {
						alert("Sorry Select Any one or more Record to Delete");
						return false;
					}
				}


			}

        function changestatus(st, id) {
            var base_url = '<?php echo base_url(); ?>';
            if (confirm('Change status of the item?')) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: base_url + "master/fabtype_status",
                    data: {
                        items: id,
                        status: st
                    },
                    success: function(data) {
                        $("#flex1").flexReload();
                    }
                });
            }
        }

        function edit(id) {
            var base_url = '<?php echo base_url(); ?>';
            document.location.href = base_url + "others/pincode_edit?id=" + id;
        }
    </script>
</body>
<!-- END BODY-->

</html>