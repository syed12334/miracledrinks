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
    <!--<link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/main.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/theme.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/MoneAdmin.css" />-->
    <link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/Font-Awesome/css/font-awesome.css" />
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
                        <h3 class="text-themecolor mb-0">Products</h3>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-12 align-self-center d-none d-md-block">
                        <div class="d-flex mt-2 justify-content-end">
                            <a href="<?= base_url() ?>master/products_add" class="btn btn-info"><i
                                    class="mdi mdi-plus"></i> ADD Product</a>
                        </div>
                    </div>
                </div>

                <div class="container-fluid" id="content">

                    <div class="inner" style="min-height:1200px;">
                        <div class="card">
                            <div class="card-body">
                                <?php 
                                    if($this->session->userdata('message')) {
                                      ?>
                                       <div class="alert alert-success"><?php echo $this->session->userdata('message'); ?></div>
                                        <?php
                                    }else {

                                    }
                                ?>
                               

                                <!--<form id="productadd" method="post" action="" class="form-material">-->
                              <form id="productadd" method="post" class="form-material">
                                    <table class="table table-bordered">

                                        <thead>

                                            <tr>

                                                <th colspan="2" onClick="showfilter()" style="cursor:pointer;">Search
                                                    <div class="showhide" onClick="showfilter()"><img
                                                            src="<?php echo asset_url(); ?>images/plus-sign.png"
                                                            id="toggleimage" onClick="showfilter()"></div>
                                                </th>

                                            </tr>

                                        </thead>

                                        <tbody id="filterbody">
										<form class="form-horizontal"  method="post" id="validate" >

                                            <tr>

                                                <td>Category:</td>

                                                <td>
                                                    <select name="categ" id="categ" class="form-control">
                                                        <option value="">--All--</option>
                                                        <?php if (is_array($category)) {
															foreach ($category as $c) {
														?>
                                                        <option value="<?php echo $c->id ?>"><?php echo $c->name ?>
                                                        </option>
                                                        <?php }
														} ?>
                                                    </select>
                                                </td>

                                            </tr>

                                            <tr style="display: none;">

                                                <td>SubCategory:</td>

                                                <td>
                                                    <select name="subcateg" id="subcateg" class="form-control">
                                                        <option value="">--All--</option>
                                                    </select>
                                                </td>

                                            </tr>

                                            <tr>

                                                <td>Product Name:</td>

                                                <td><input type="text" name="name" id="name" class="form-control"></td>

                                            </tr>

                                            <tr style="display:none;">

                                                <td>Material:</td>

                                                <td>
                                                    <select name="material" id="material" class="form-control">
                                                        <option value="">--All--</option>
                                                        <?php if (is_array($material)) {
															foreach ($material as $c) {
														?>
                                                        <option value="<?php echo $c->id ?>"><?php echo $c->name ?>
                                                        </option>
                                                        <?php }
														} ?>
                                                    </select>
                                                </td>

                                            </tr>

                                            <tr style="display:none;">

                                                <td>Colors:</td>

                                                <td>
                                                    <select name="color[]" id="color" class="form-control"
                                                        multiple="multiple">

                                                        <?php
														if (is_array($color)) {
															foreach ($color  as $s) {
														?>
                                                        <option value="<?php echo $s->id ?>"><?php echo $s->name ?>
                                                        </option>
                                                        <?php }
														} ?>
                                                    </select>
                                                </td>

                                            </tr>

                                            <tr>

                                                <td>Sizes:</td>

                                                <td>
                                                    <select name="sizes[]" id="sizes" class="form-control"
                                                        multiple="multiple">
                                                        <option value="0">No Size</option>
                                                        <?php
														if (is_array($size)) {
															foreach ($size  as $s) {
														?>
                                                        <option value="<?php echo $s->id ?>"><?php echo $s->name ?>
                                                        </option>
                                                        <?php }
														} ?>
                                                    </select>
                                                </td>

                                            </tr>

                                          

                                            <tr>

                                                <td>Status:</td>

                                                <td>

                                                    <select name="choosestatus" id="choosestatus" class="form-control">

                                                        <option value="" selected>--All--</option>

                                                        <option value="0">Active</option>

                                                        <option value="1">In-Active</option>

                                                    </select>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>Stock:</td>

                                                <td>

                                                    <select name="stockstatus" id="stockstatus" class="form-control">

                                                        <option value="" selected>--All--</option>

                                                        <option value="1">In Stock</option>

                                                        <option value="0">Less Stock</option>

                                                    </select>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>Showing In Home Page?:</td>

                                                <td>

                                                    <select name="choosestatus2" id="choosestatus2"
                                                        class="form-control">

                                                        <option value="" selected>--All--</option>

                                                        <option value="1">Yes</option>

                                                        <option value="0">No</option>

                                                    </select>

                                                </td>

                                            </tr>
											
											

                                            <tr>

                                                <td colspan="2">

                                                 
                                                    <button type="button" class="btn btn-info" id="view"
                                                        onclick="initialiseData();" title="Get Records"><i
                                                            class="fa fa-search"></i> Get Records</button>

                                                    <button type="reset" class="btn btn-primary" id="resetbtn"><i
                                                            class="mdi mdi-refresh"></i> Reset</button>

                                                    

                                                </td>



                                            </tr>

                                        </tbody>

                                    </table>

                                </form>

                                <!--<table id="flex1"></table>-->
                                <div class="card scroll-sidebar">
                                     
                                        <div class="table-responsive">
                                            <!--<div class="box-body" id="DataTableValue">
                                                <?php echo $products; ?>
												
                                            </div>-->
											
											<div class="box-body" id="DataTableValue">
											  <table id="user_data" class="table table-bordered table-striped">  
												 <thead>  
													   <tr>
															<th>Sl No.</th>
															<th>Status</th>
															<th>Action</th>
															<th>Inventory</th>
															<th>Category</th>
															<th>Product Name</th>
															<th>Product Code</th>
															<th>Product Image</th>
															<!-- <th>Material</th>
															<th>Color</th>
															<th>Sizes</th> -->
													  </tr>							  
												 </thead>  
											 </table> 
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

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo asset_url(); ?>libs/popper.js/dist/umd/popper.min.js"></script>
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
    <!-- Chart JS -->
    <script src="<?php echo asset_url(); ?>dist/js/pages/dashboards/dashboard1.js"></script>

    <script src="<?php echo asset_url(); ?>libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo asset_url(); ?>dist/js/pages/datatable/custom-datatable.js"></script>
    <script src="<?php echo asset_url(); ?>dist/js/pages/datatable/datatable-basic.init.js"></script>
	<?php $this->session->unset_userdata('message');?>

    <style type="text/css">
    .showhide {
        cursor: pointer;
        float: right;
    }
    </style>
    <?php $id = $this->uri->segment(3); ?>
    
    <script type="text/javascript">
	
		  $(function () {
			  $("#user_data").dataTable().fnDestroy();
			  initialiseData();	
		  });
	     var dataTable;
	    
	     function initialiseData(){
			var categ = $('#categ').val();
			var subcateg = $('#subcateg').val();
			var name = $('#name').val();
			var material = $('#material').val();
			var color = $('#color').val();
			var sizes = $('#sizes').val();
			var choosestatus = $('#choosestatus').val();
			var choosestatus2 = $('#choosestatus2').val();
			$("#user_data").dataTable().fnDestroy();
	    	dataTable = $('#user_data').DataTable({  
	             "processing":true,  
	             "serverSide":true,  
	             "order":[],  
	             "ajax":{  
	                  url:"<?php echo base_url().'master/getproductnewd';?>",
	                  type:"POST",
					  data:{categ:categ,subcateg:subcateg,name:name,material:material,color:color,sizes:sizes,choosestatus:choosestatus,choosestatus2:choosestatus2},
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


    $(document).ready(function() {

        <?php

			if ($id == '0') {

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
            $('#productadd')[0].reset();
            $('#DataTableValue').html(result);
            $('#example1').DataTable();
            return false;
        });
    });



    var filterhiden = 1;

    function showfilter() {

        if (filterhiden == 1) {

            $("#filterbody").show();
            filterhiden = 0;

            $('#toggleimage').attr('src', "<?php echo asset_url(); ?>images/minus-sign.png");

        } else {

            $("#filterbody").hide();
            filterhiden = 1;

            $('#toggleimage').attr('src', "<?php echo asset_url(); ?>images/plus-sign.png");

        }

    }

    $(document).ready(function() {

        $("#filterbody").hide();

    });



    function test(com, grid) {
        if (com == 'Add') {
            var base_url = '<?php echo base_url(); ?>';
            document.location.href = base_url + "master/products_add";
        }
    }

    function edit(id, type) {
        var base_url = '<?php echo base_url(); ?>';
        document.location.href = base_url + "master/productsnew_edit?id=" + id;
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
                url: base_url + "master/products_status",
                data: {
                    items: id,
                    status: st
                },
                success: function(data) {
                    dataTable.ajax.reload( null, false );
                    initialiseData();
                    console.log(data);
                }
            });
        }
    }


    function changestatus2(st, id,type) {
        var base_url = '<?php echo base_url(); ?>';
        switch (type) {
            case 1:
                var typemsg = "Bundle Offers";
                break;
            case 2:
                var typemsg = "Special Offers";
                break;
				
			case 3:
                var typemsg = "Exclusive Product";
                break;
				
        }
        switch (st) {
            case 0:
                var msg = "This product will not be displayed under "+typemsg+" in Homepage";
                break;
            case 1:
                var msg = "This product will be displayed under "+typemsg+" in Homepage";
                break;
        }
        if (confirm(msg)) {
            $.ajax({
                type: "POST",
                url: base_url + "master/products_homepageshow",
                data: {
                    items: id,
                    status: st,
					type:type
                },
                success: function(data) {
                   dataTable.ajax.reload( null, false );
                    initialiseData();
                }
            });
        }
    }

    function addFormData() {

        //passing a form object to serializeArray will get the valid data from all the objects, but, if the you pass a non-form object, you have to specify the input elements that the data will come from
        var dt = $('#productadd').serializeArray();
        $("#flex1").flexOptions({
            params: dt
        });
        return true;

    }

    function viewRecord(id) {
        var docHeight = $(document).height();
        $("body").append("<div id='overlay'></div>");
        $("#overlay").height(docHeight).removeClass().addClass("addoverlay");
        $("body").append("<div id='mask' style='position:fixed; top:8%; left:25%; z-index:10000; height:100%;'></div>");
        $("#mask").html(
            '<div class="alpha30" style="margin-left:50%; margin-top:50%;"><div class="white"><img src="<?php echo asset_url(); ?>images/36.gif" /></div></div>'
        );
        $("#mask").load('<?php echo base_url(); ?>master/products_view/' + id, function(data) {});
    }

    function submitfilterstatus(ststaus) {
        $("#stockstatus").val(ststaus);
        //$("#choosestatus option[value='"+ststaus+"']").attr("disabled", false);
        $('#flex1').flexOptions({
            newp: 1
        }).flexReload();
        //reloadColorsdashboard();
        return false;
    }



    function closethisanddintRedirect() {
        $("#mask").html("");
        $("#overlay").height(0).removeClass();
        $("#flex1").flexOptions({
            newp: $("#flex1").flexGetPageNumber()
        }).flexReload();
        //reloadColorsdashboard();
    }

    function download() {
        document.location.href = "<?php echo base_url() ?>register/exportexcel?fromdate=" + $("#fromdate").val() +
            "&todate=" + $("#todate").val() + "&company_name=" + $("#company_name").val() + "&name=" + $("#name")
            .val() + "&email=" + $("#email").val() + "&phone=" + $("#phone").val() + "&plan=" + $("#plan").val() +
            "&choosestatus=" + $("#choosestatus").val();
    }
    </script>

    <script type="text/javascript">
    function getsubcateg(id)

    {
        $.post(

            '<?php echo base_url(); ?>master/getsubcat',

            {
                cid: id
            },

            function(data) {

                //alert(data);

                $('#subcateg').html('<option value="">--All--</option>' + data);

            });

    }
    </script>

</body>
<!-- END BODY-->

</html>