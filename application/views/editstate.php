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
    <link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/Font-Awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-fileupload.min.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/Markdown.Editor.hack.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/CLEditor1_4_3/jquery.cleditor.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/jquery.cleditor-hack.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-wysihtml5-hack.css" /> -->
    <script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.min.js"></script>
    <?php echo $updatelogin; ?>
    <style type="text/css">
        .mininwidth {
            width: 120px;
        }

        .mininwidth1 {
            width: 80px;
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
                        <h3 class="text-themecolor mb-0">State</h3>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active">State</li>
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
                                            <div class="card-header">
                                                <h5>Edit State</h5>
                                            </div>
                                            <div id="collapseOne" class="card-body">
                                                <form action="<?php echo base_url() . 'others/state_edit'; ?>" class="form-horizontal form-material row" id="brand-validate" method="post">



                                                    <div class="form-group col-md-12">
                                                        <label class="control-label">State<font style="color: red;">*</font></label>
                                                            <input type="hidden" value="<?php echo $details[0]->id; ?>" name="aid">
                                                            <input type="text" id="name" name="name" required class="form-control" value="<?php echo $details[0]->name; ?>" />
                                                    </div>

                                                    <div class="form-actions no-margin-bottom col-md-12" style="text-align:center;">
                                                        <a href="<?php echo base_url() . 'others/state'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info "><i class="mdi mdi-check "></i> Save Changes</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <?php else : ?>

                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Add Cities</h5>
                                            </div>
                                            <div id="collapseOne" class="card-body">
                                                <form action="<?php echo base_url() . 'others/state_save'; ?>" class="form-horizontal form-material row" id="brand-validate" method="post">

                                                    <input type="hidden" value="0" name="aid">



                                                    <div class="form-group col-md-12">
                                                        <label class="control-label">State Name<font style="color: red;">*</font></label>
                                                        <table class="table table-bordered ">
                                                            <thead>

                                                            </thead>
                                                            <tbody id="p">
                                                                <tr>
                                                                    <td><input type="text" name="np[]" class="form-control" placeholder="" /></td>
                                                                    <td class="text-center" width="200"><span id="newr" onClick="addmore();" class="btn btn-info"><i class="fas fa-plus"></i></span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="form-actions no-margin-bottom col-md-12" style="text-align:center;">
                                                        <a href="<?php echo base_url() . 'others/state'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info"><i class="mdi mdi-check "></i> Save</button>
                                                    </div>

                                                </form>
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
            </div>
        </div>
    </div>
    <!-- FOOTER -->
    <div id="footer">
        <p>&copy; <?php echo fottertitle; ?> </p>
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



    <script>
        $(function() {

            var v = $("#brand-validate").validate({
                errorClass: "help-block",
                errorElement: 'span',
                onkeyup: false,
                onblur: false,
                rules: {


                    'np[]': {
                        required: true,

                    }


                },

                messages: {
                    'np[]': {
                        //remote: jQuery.validator.format("{0} already exists.")
                    },



                },
                errorElement: 'span',
                highlight: function(element, errorClass, validClass) {
                    $(element).parents('.form-group').addClass('has-error');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).parents('.form-group').removeClass('has-error');
                }

            });
        });

        function addmore() {
            var x = Math.floor((Math.random() * 10000) + 1);
            var row = "<tr id='r_" + x + "'><td><input type='text' name='np[]' class='form-control' required placeholder=''/></td><td class='text-center'><span class='btn btn-primary' onclick='remove123(" + x + ")'><i class='fas fa-minus'></i></span></td></tr>";
            $('#p').append(row);
        }

        function remove123(trid) {
            $("#r_" + trid).fadeOut(500, function() {
                $("#r_" + trid).remove();
            });
        }
    </script>

</body>
<!-- END BODY-->

</html>