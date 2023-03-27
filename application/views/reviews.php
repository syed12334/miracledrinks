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
                        <h3 class="text-themecolor mb-0">Customer Reviews</h3>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                            <li class="breadcrumb-item active">Customer Reviews</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-12 align-self-center d-none d-md-block">

                    </div>
                </div>
                <div class="container-fluid" id="content">



                    <div class="inner" style="min-height:700px;">

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

                                                <td>Category:</td>

                                                <td>

                                                    <select name="cat" id="cat" class="form-control">
                                                        <option value="">--Select--</option>
                                                        <?php
                                                        if (count($cate) > 0) {
                                                            foreach ($cate as $sel) {
                                                        ?>
                                                                <option value="<?php echo $sel->id ?>"><?php echo $sel->name; ?></option>
                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </select>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>From Date:</td>

                                                <td>

                                                    <input type="text" name="fromdate" id="fromdate" class="form-control today_date_time">

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>To Date:</td>

                                                <td>

                                                    <input type="text" name="todate" id="todate" class="form-control today_date_time">

                                                </td>

                                            </tr>











                                            <tr>

                                                <td>Product Name:</td>

                                                <td><input type="text" name="pname" id="pname" class="form-control"></td>

                                            </tr>




                                            <tr>

                                                <td>Posted By:</td>

                                                <td><input type="text" name="name" id="name" class="form-control"></td>

                                            </tr>




                                            <tr>

                                                <td>Status:</td>

                                                <td>

                                                    <select name="choosestatus" id="choosestatus" class="form-control">

                                                        <option value="" selected>All</option>

                                                        <option value="3">New</option>

                                                        <option value="2">Pending</option>

                                                        <option value="0">Approved</option>

                                                        <option value="1">Rejected</option>

                                                    </select>

                                                </td>

                                            </tr>


                                            <tr>

                                                <td colspan="2">

                                                   <!-- <button type="submit" class="btn btn-info"><i class="mdi mdi-magnify"></i> Search</button>-->
												   <button type="button" class="btn btn-info" id="view" onclick="initialiseData();"><i class="fa  fa-search"></i> Search</button>
                                                    <button type="reset" class="btn btn-primary" id="resetbtn"><i class="mdi mdi-refresh"></i> Reset</button>
                                                    <button type="button" class="btn btn-info" onclick="download();"><i class="fas fa-file"></i> Export</button>
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
															<th width="5%">Sl. No.</th>
															<th width="15%">Category</th>
															<th>Product</th>
															<th>Product Image</th>
															<th>Posted By</th>
															<th>Email ID</th>
															<th>Rating</th>
															<th>Posted Date</th>
															<th>Status</th>
															<th>Actions</th>
													  </tr>							  
												 </thead>  
											 </table> 
											</div>


										</div>
									
								</div>   



                                <div class="col-lg-12">

                                   <!-- <div class="modal fade" id="uiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
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


    <script>
		$(function () {
			  $("#user_data").dataTable().fnDestroy();
			  initialiseData();	
		  });
	     var dataTable;
	    
	     function initialiseData(){
			var cat = $('#cat').val();
			var fromdate = $('#fromdate').val();
			var todate = $('#todate').val();
			var pname = $('#pname').val();
			var name = $('#name').val();
			var choosestatus = $('#choosestatus').val();
			$("#user_data").dataTable().fnDestroy();
	    	dataTable = $('#user_data').DataTable({  
	             "processing":true,  
	             "serverSide":true,  
	             "order":[],  
	             "ajax":{  
	                  url:"<?php echo base_url().'reports/getreview';?>",
	                  type:"POST",
					  data:{cat:cat,fromdate:fromdate,todate:todate,pname:pname,name:name,choosestatus:choosestatus},
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

            $("#fromdate").datepicker();

            $("#todate").datepicker();

        });



        function getsub(id)

        {

            $('#brand').html('<option value="">--Select Brand--</option>');

            $('#subsubcat').html('<option value="">--Select Sub-Sub Category--</option>');

            $('#subcat').html('<option value="">--Select Sub Category--</option>');

            $.post(

                '<?php echo base_url(); ?>master/getsubcat',

                {
                    cid: id
                },

                function(data) {

                    $('#subcat').html(data);

                });

        }

        function getBrand(subsub) {

            $('#brand').html('<option value="">--Select Brand--</option>');

            $.post(

                '<?php echo base_url(); ?>master/getBrands',

                {
                    cid: $('#cat').val(),
                    subid: subsub
                },

                function(data) {

                    $('#brand').html(data);

                });

        }


        function getsubsub(id)

        {
            $('#subsubcat').html('<option value="">--Select Sub-Sub Category--</option>');

            $('#brand').html('<option value="">--Select Brand--</option>');
            $.post(

                '<?php echo base_url(); ?>kimberproducts/getsubsubcat',

                {
                    cid: id,
                    categ: $('#cat').val()
                },

                function(data) {

                    //alert(data);

                    $('#subsubcat').html(data);

                });

        }
    </script>


    <script type="text/javascript" src="<?php echo asset_url(); ?>flexigrid.js"></script>

    <?php $id = $this->uri->segment(3); ?>

    <script type="text/javascript">
        $(document).ready(function() {



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
				$('#example').DataTable();
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



            } else

            {

                $("#filterbody").hide();
                filterhiden = 1;

                $('#toggleimage').attr('src', "<?php echo asset_url(); ?>images/plus-sign.png");

            }



        }

        $(document).ready(function() {

            $("#filterbody").hide();

        });



        var base_url = '<?php echo base_url(); ?>';

        $(document).ready(function() {



            $("#flex1").flexigrid({

                url: base_url + 'reports/reviewTable',

                dataType: 'json',

                colModel: [

                    {
                        display: 'Sl.No.',
                        width: 40,
                        sortable: false,
                        align: 'center'
                    },
                    {
                        display: 'Category',
                        width: 100,
                        name: 'cname',
                        sortable: true,
                        align: 'center'
                    },
                    {
                        display: 'Product',
                        width: 100,
                        name: 'pname',
                        sortable: true,
                        align: 'center'
                    },



                    {
                        display: 'Product Image',
                        width: 100,
                        sortable: false,
                        align: 'center'
                    },
                    {
                        display: 'Posted By',
                        name: 'name',
                        width: 100,
                        sortable: true,
                        align: 'center'
                    },
                    {
                        display: 'Email ID',
                        name: 'email',
                        width: 100,
                        sortable: true,
                        align: 'center'
                    },

                    {
                        display: 'Rating',
                        name: 'rating',
                        width: 50,
                        sortable: true,
                        align: 'center'
                    },
                    {
                        display: 'Posted Date',
                        name: 'created_date',
                        width: 100,
                        sortable: true,
                        align: 'center'
                    },
                    {
                        display: 'Status',
                        name: 'status',
                        width: 100,
                        sortable: true,
                        align: 'center'
                    },
                    {
                        display: 'Actions',
                        width: 230,
                        align: 'center'
                    }
                ],
                showToggleBtn: false,

                onError: function(data) {

                    for (var i in data) {

                        alert("Header: " + i + "\nMessage: " + data[i]);

                    }

                },

                sortname: "r.id",

                sortorder: "desc",

                onSubmit: addFormData,

                usepager: true,

                useRp: true,

                rp: 10,

                showTableToggleBtn: false,

                width: 1000,

                height: 300

            });
        });

        function closethisanddintRedirect() {
            $("#mask").html("");
            $("#overlay").height(0).removeClass();
            $("#flex1").flexOptions({
                newp: $("#flex1").flexGetPageNumber()
            }).flexReload();
            //reloadColorsdashboard();
        }


        function changestatus(st, id) {
            /*var base_url = '<?php echo base_url(); ?>';
            if (confirm('Change status of the item?')) {

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: base_url + "reports/review_status",
                    data: {
                        items: id,
                        status: st
                    },
                    success: function(data) {
                        // alert(data);
                        closethisanddintRedirect();
                        $("#flex1").flexOptions({
                            newp: $("#flex1").flexGetPageNumber()
                        }).flexReload();
                    },
                    //                   error: function (request, status, error) {
                    //                       alert(request.responseText);
                    //                   }
                });
            }*/
			
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





        function submitfilterstatus(ststaus) {
            $("#choosestatus").val(ststaus);

            $('#flex1').flexOptions({
                newp: 1
            }).flexReload();

            return false;

        }


        /*function view(id, type) {
            var docHeight = $(document).height();
            $("body").append("<div id='overlay'></div>");
            $("#overlay").height(docHeight).removeClass().addClass("addoverlay");
            $("body").append("<div id='mask' style='position:fixed; top:8%; left:25%; z-index:10000; height:100%;'></div>");
            $("#mask").html('<div class="alpha30" style="margin-left:50%; margin-top:50%;"><div class="white"><img src="<?php echo asset_url(); ?>images/36.gif" /></div></div>');
            $("#mask").load('<?php echo base_url(); ?>reports/review_view/' + id, function(data) {});

        }*/
		
		function view(id) {

			document.location.href = '<?php echo base_url(); ?>reports/review_view?id=' + id;

		}

        function download() {
            //alert("<?php echo base_url() ?>reports/exportexcel?fromdate="+$("#fromdate").val()+"&todate="+$("#todate").val()+"&name="+$("#name").val()+"&cat="+$("#cat").val()+"&subcat="+$("#subcat").val()+"&subsubcat="+$("#subsubcat").val()+"&brand="+$("#brand").val()+"&choosestatus="+$("#choosestatus").val()+"&seller="+$("#seller").val());
            document.location.href = "<?php echo base_url() ?>reports/exportexcel?size=" + $("#size").val() + "&fromdate=" + $("#fromdate").val() + "&todate=" + $("#todate").val() + "&name=" + $("#name").val() + "&cat=" + $("#cat").val() + "&subcat=" + $("#subcat").val() + "&subsubcat=" + $("#subsubcat").val() + "&brand=" + $("#brand").val() + "&choosestatus=" + $("#choosestatus").val() + "&seller=" + $("#seller").val() + "&pname=" + $("#pname").val();
        }
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