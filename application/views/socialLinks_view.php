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
    <style type="text/css">
        .has-error {
            color: #F56954;
        }

        .has-error {
            border-color: #F56954 !important;
            color: #555555;
            box-shadow: none;
        }
    </style>
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
                        <h3 class="text-themecolor mb-0">Social Links</h3>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Footer</a></li>
                            <li class="breadcrumb-item active">Social Links</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-12 align-self-center d-none d-md-block">

                    </div>
                </div>

                <div class="container-fluid" id="content">
                    <div class="inner" style="min-height:1200px;">
                        <div class="row">
                            <div class="col-lg-12">

                                <?php if ($type == 'edit') : ?>
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <?php
                                            $ser = "";

                                            $facebook = $twitter = $instagram = $rss = "";
                                            if (is_array($links)) {
                                                $facebook = $links[0]->facebook;
                                                $twitter = $links[0]->twitter;
                                                $rss = $links[0]->rssfeeds;
                                                $googleplus = $links[0]->googleplus;
                                                $insta = $links[0]->insta;
                                            }
                                            //                                 
                                            ?>
                                            <?php echo $this->session->flashdata('message'); ?>
                                            <div id="collapseOne" class="card-body">
                                                <form action="<?php echo base_url() . 'sociallinks/link_save'; ?>" class="form-horizontal form-material row" id="form" method="post" enctype="multipart/form-data">


                                                    <div class="form-group col-md-12">
                                                        <label class="control-label">Facebook<font style="color: red;">*</font></label>
                                                        <input type="url" id="facebook" title="Enter Facebook Link" name="facebook" required class="form-control" value="<?php echo $facebook ?>" />
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label class="control-label">Twitter<font style="color: red;">*</font></label>
                                                        <input type="url" id="twitter" title="Enter Twitter Link" name="twitter" required class="form-control" value="<?php echo $twitter ?>" />
                                                    </div>

                                                    <div class="form-group col-md-12" style="display: none;">
                                                        <label class="control-label">RSS Feeds<font style="color: red;">*</font></label>
                                                        <input type="url" id="rss" title="Enter RSS Feeds Link" name="rss" class="form-control" value="<?php echo $rss ?>" />
                                                    </div>


                                                    <div class="form-group col-md-12">
                                                        <label class="control-label">Youtube<font style="color: red;">*</font></label>
                                                        <input type="url" id="googleplus" title="Enter Google Plus Link" name="googleplus" required class="form-control" value="<?php echo $googleplus ?>" />
                                                    </div> 
                                                        <div class="form-group col-md-12">
                                                        <label class="control-label">Linkedin<font style="color: red;">*</font></label>
                                                        <input type="url" id="googleplus" title="Enter Linkedin Link" name="linkedin" required class="form-control" value="<?php echo $rss ?>" />
                                                    </div> 
													<div class="form-group col-md-12">
                                                        <label class="control-label">Instagram<font style="color: red;">*</font></label>
                                                        <input type="url" id="insta" title="Enter Google Plus Link" name="insta" required class="form-control" value="<?php echo $insta ?>" />
                                                    </div>

                                                    <div class="form-actions no-margin-bottom col-md-12" style="text-align:center;">
                                                        <button type="submit" class="btn btn-info"><i class="mdi mdi-check "></i> Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
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
            <script src="<?php echo asset_url(); ?>plugins/bootstrap/js/bootstrap.min.js"></script>
            <script src="<?php echo asset_url(); ?>plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
            <!-- END GLOBAL SCRIPTS -->

            <script src="<?php echo asset_url(); ?>plugins/validationengine/js/jquery.validationEngine.js"></script>
            <script src="<?php echo asset_url(); ?>plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
            <script src="<?php echo asset_url(); ?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>



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
                    $("#form").validate({
                        ignore: [],
                        errorClass: 'help-block',
                        errorElement: 'span',

                        highlight: function(element, errorClass, validClass) {
                            $(element).parents('.form-group').addClass('has-error');
                        },
                        unhighlight: function(element, errorClass, validClass) {
                            $(element).parents('.form-group').removeClass('has-error');
                        }
                    });
                });
            </script>

</body>
<!-- END BODY-->

</html>