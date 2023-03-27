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
		<link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/Font-Awesome/css/font-awesome.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->

    <link href="<?php echo asset_url(); ?>plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"
        href="https://www.srisankaratv.com/admin_manage/assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
    <?php echo $updatelogin; ?>
    <!-- END PAGE LEVEL  STYLES -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

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
            <!--PAGE CONTENT -->
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-12 align-self-center">
                        <h3 class="text-themecolor mb-0">Dashboard</h3>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-12 align-self-center d-none d-md-block">

                    </div>
                </div>
                <div class="container-fluid" id="content">


                    <div class="inner ">
                       <?php 
                        if($newsess[0]->city_id ==2) {

                        }else {
                            ?>
                            <div class="row">
                            <a class="col-lg-4 col-md-6 d-flex align-items-stretch" href="<?php echo base_url() ?>reports/user_orders/1">
                                <div class="card bg-info w-100 text-white">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div
                                                class="out round round-lg text-white d-inline-block text-center rounded-circle">
                                                <i class="mdi mdi-flower"></i>
                                            </div>
                                            <div class="ml-2 align-self-center">
                                                
                                                <h5 class="text-white mb-0"> New Success Orders</h5>

                                                <h3 class="mb-0 font-weight-light text-white"><?php $cnt = $this->master_db->getcontent2('orders', '', '', '1');
                                                //echo $this->db->last_query();
                                                    if (is_array($cnt)) {
                                                    if (count($cnt) < 100) {
                                                        echo count($cnt);
                                                    } else {
                                                        echo "99+";
                                                    }
                                                    } else {
                                                        echo 0;
                                                    } ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="col-lg-4 col-md-6 d-flex align-items-stretch" href="<?php echo base_url() ?>  reports/user_orders/-1">
                                <div class="card bg-info w-100 text-white">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div
                                                class="out round round-lg text-white d-inline-block text-center rounded-circle">
                                                <i class="fas fa-box-open"></i>
                                            </div>
                                            <div class="ml-2 align-self-center">
                                                
                                                <h5 class="text-white mb-0"> Failure Orders</h5>
                                                <h3 class="mb-0 font-weight-light text-white"><?php $cnt = $this->master_db->getcontent2('orders', '', '', '-1');
                                                    if (is_array($cnt)) {
                                                        if (count($cnt) < 100) {
                                                            echo count($cnt);
                                                        } else {
                                                            echo "99+";
                                                        }
                                                    } else {
                                                        echo 0;
                                                    } ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="col-lg-4 col-md-6 d-flex align-items-stretch" href="<?php echo base_url() ?>master/products/0">
                                <div class="card bg-info w-100 text-white">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div
                                                class="out round round-lg text-white d-inline-block text-center rounded-circle">
                                                <i class=" fas fa-boxes"></i>
                                            </div>
                                            <div class="ml-2 align-self-center">
                                                
                                                <h5 class="text-white mb-0">Less Stock</h5>
                                                <h3 class="mb-0 font-weight-light text-white"><?php $cnt = $this->home_db->getOutofstock();
                                                    if (intval($cnt) >= 100) {
                                                        echo '99+';
                                                    } else {
                                                        echo $cnt;
                                                    } ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <!--<a class="col-lg-4 col-md-6 d-flex align-items-stretch" href="<?php echo base_url() ?>blogposts/blogposts_comments/3">
                                <div class="card bg-info w-100 text-white">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div
                                                class="out round round-lg text-white d-inline-block text-center rounded-circle">
                                                <i class="far fa-comments"></i>
                                            </div>
                                            <div class="ml-2 align-self-center">
                                                
                                                <h5 class="text-white mb-0">New Blog Comments</h5>
                                                <h3 class="mb-0 font-weight-light text-white"><?php $blog = $this->master_db->getcontent2('blogposts_comments', '', '', '3');
                                                    if (is_array($blog)) {
                                                        echo count($blog);
                                                    } else {
                                                        echo 0;
                                                    } ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>-->
                            <a class="col-lg-4 col-md-6 d-flex align-items-stretch" href="<?php echo base_url() ?>others">
                                <div class="card bg-info w-100 text-white">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div
                                                class="out round round-lg text-white d-inline-block text-center rounded-circle">
                                                <i class="far fa-envelope"></i>
                                            </div>
                                            <div class="ml-2 align-self-center">
                                                
                                                <h5 class="text-white mb-0">Newsletter</h5>
                                                <h3 class="mb-0 font-weight-light text-white"><?php $newsletter = $this->master_db->getcontent2('newsletter', '', '', '');
                                                    if (is_array($newsletter) && count($newsletter) >= 100) {
                                                        echo "99+";
                                                    } else if (is_array($newsletter) && count($newsletter) <= 99) {
                                                        echo count($newsletter);
                                                    } else {
                                                        echo 0;
                                                    } ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="col-lg-4 col-md-6 d-flex align-items-stretch" href="<?php echo base_url() ?>reports/customers">
                                <div class="card bg-info w-100 text-white">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div
                                                class="out round round-lg text-white d-inline-block text-center rounded-circle">
                                                <i class="fas fa-users"></i>

                                                
                                            </div>
                                            <div class="ml-2 align-self-center">

                                          
                                                
                                                <h5 class="text-white mb-0">Registered Users</h5>
                                                <h3 class="mb-0 font-weight-light text-white"><?php $pin = $this->master_db->getcontent2('users', '', '', '');
                                                    if (is_array($pin) && count($pin) >= 100) {
                                                        echo "99+";
                                                    } else if (is_array($pin) && count($pin) <= 99) {
                                                        echo count($pin);
                                                    } else {
                                                        echo 0;
                                                    } ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="col-lg-4 col-md-6 d-flex align-items-stretch" href="<?php echo base_url() ?>reports/reviews/3">
                                <div class="card bg-info w-100 text-white">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div
                                                class="out round round-lg text-white d-inline-block text-center rounded-circle">
                                                <i class="far fa-star"></i>
                                            </div>
                                            <div class="ml-2 align-self-center">
                                                
                                                <h5 class="text-white mb-0">Customer Review</h5>
                                                <h3 class="mb-0 font-weight-light text-white"><?php $pin = $sql = $this->master_db->sqlExecute('select * from reviews where user_id !=0');
                                                if(count($sql)) {
                                                    echo count($sql);
                                                }
                                             ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                               <h4 class="mb-4"> <b> Product Orders History</b></h4>
                                            </div>
                                            <div class="panel-body">
                                                <form id="productadd" method="post" onsubmit="return false;" action="<?php echo base_url() ?>atpadmin/graph_orders">
                                                   
                                                <div class="row">
                                                
                                                <div class="form-group col-md-4">
                                                
                                                        <label>From Date (YYYY-MM-DD)</label>
                                                            <input type="date" name="fromdate" id="fromdate"
                                                                                class="form-control today_date_time"
                                                                                required="required" readonly">
                                                                        </div>

                                                                        <div class="form-group  col-md-4">
                                                                <label>To Date (YYYY-MM-DD):</label>
                                                                 <input type="date" name="todate" id="todate"
                                                                        class="form-control today_date_time"
                                                                        required="required" readonly">
                                                </div>
                                                            
                                                <div class="form-group  col-md-4"> <label> &nbsp; </label>  <button type="button" class="btn btn-primary form-control" onclick="viewreport();"><i    class="icon-search"></i> Search</button></div>
                                                                    </div>     
                                                </form>
                                                <!--<iframe src="<?php echo base_url() ?>atpadmin/graph_orders" frameborder="0" id="mainFrame" name="mainFrame" style="width: 100%;height: 1000px;"></iframe>-->
                                                <!-- <div id="morris-line-chart"></div> -->
                                                 <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-body analytics-info">
                                                                 
                                                                <div id="basic-bar" style="height:400px;"></div>
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
                            <?php
                        }

                       ?>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- FOOTER -->
        <div id="footer">
            <p>&copy; <?php echo fottertitle; ?></p>
        </div>
        <!--END FOOTER -->
        <!-- GLOBAL SCRIPTS -->
        <script src="<?php echo asset_url(); ?>plugins/jquery-2.0.3.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/bootstrap/js/bootstrap.min.js"></script>
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
        <script src="<?php echo asset_url(); ?>/libs/moment/moment.js"></script>
        <script
            src="<?php echo asset_url(); ?>/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js">
        </script>
        <script>
        /*  $(function() {
                $("body").on("focus", ".datepicker", function(e) {
                    $(".datepicker").datepicker({
                        dateFormat: "yy-mm-dd"
                    });
                });
            });*/
        /* $('.fromdate').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD HH:mm:ss'  });
         $('.todate').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD HH:mm:ss'  });*/
        </script>
        <script src="https://www.srisankaratv.com/admin_manage/assets/libs/moment/moment.js"></script>
        <script
            src="https://www.srisankaratv.com/admin_manage/assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js">
        </script>
        <script>
        $('.today_date_time').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            time: false
        });
        </script>

        <script type="text/javascript">
        $(function() {
            $(".dropdown").click(function() {
                if ($(this).hasClass("open")) {
                    $(this).removeClass("open");
                } else {
                    $(this).addClass("open");
                }
            });

            /*$("#productadd").submit(function() {
                $("#mainFrame").attr("src", '<?php echo base_url() ?>atpadmin/graph_orders?fromdate=' +
                    $("#fromdate").val() + '&todate=' + $("#todate").val());
            });*/
        });
		
		function viewreport()
		{
				
				var fromdate = $('#fromdate').val();
				var todate = $('#todate').val();
				$.post('<?php echo base_url();?>atpadmin/graph_orders',{fromdate:fromdate,todate:todate,},function(data) 
				{
					$('#basic-bar').html(data);
				});

		}
		
        </script>

       
</body>
<!-- END BODY -->

</html>