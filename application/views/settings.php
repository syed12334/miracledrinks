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
    <!--  <link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/main.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/theme.css" /> 
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/MoneAdmin.css" />-->
    <link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/Font-Awesome/css/font-awesome.css" />
    <script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <?php echo $updatelogin; ?>





    <script type="text/javascript">
        $(document).ready(function() {

            // restrict phone input
            $('#ipin,#itel,#ifax').keypress(function(key) {
                if (key.charCode == 0 || key.charCode == 32) return true;
                if (key.charCode < 48 || key.charCode > 57) return false;
            });

            // restrict surname input
            $('#icity').keypress(function(key) {
                if (key.charCode == 0 || key.charCode == 32) return true;
                if ((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45)) return false;
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            CKEDITOR.config.toolbar = [{
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup'],
                    items: ['Bold', 'Italic', 'Underline']
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                    items: ['NumberedList', 'BulletedList', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
                },
                {
                    name: 'links',
                    items: ['Link']
                },
                {
                    name: 'styles',
                    items: ['Format']
                }

            ];
            CKEDITOR.config.width = "600px";
            CKEDITOR.config.height = "250px";
        });
    </script>

    <style type="text/css">
        .redborder {
            border: 1px solid #bf0000;
        }
    </style>

    <style type="text/css">
        .has-error {
            color: #f50200;
            border-color: #f50015 !important;

            box-shadow: none;
        }
    </style>

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


            <!--PAGE CONTENT -->
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-12 align-self-center">
                        <h3 class="text-themecolor mb-0">Settings</h3>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Settings</a></li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-12 align-self-center d-none d-md-block">

                    </div>
                </div>
                <div class="container-fluid" id="content">
                    <div class="inner" style="min-height:1200px;">
                        <div class="row">



                            <div class="col-lg-12">
                                <?php echo $this->session->flashdata('message'); ?>
                                <div class="card">



                                    <div id="collapseOne" class="card-body">
                                        <form action="<?php echo base_url() . 'atpadmin/settings_save'; ?>" class="form-horizontal form-material" id="brand-validate" method="post" enctype="multipart/form-data">
                                            <?php
                                            $delivery_days = $invoice_tax = $incentive_per = '';
                                            $phone = $email = $terms = $time = $oemail = '';

                                            if (is_array($settings)) {
                                                $delivery_days = $settings[0]->delivery_days;
                                                $delivery_charges = $settings[0]->delivery_charges;
                                                $invoice_tax = $settings[0]->invoice_tax;
                                                $incentive_per = $settings[0]->incentive_per;

                                                $terms = $settings[0]->product_terms;
                                                $oemail = $settings[0]->order_email;
                                            }
                                            ?>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Delivery Days( For Orders ) <font style="color: red;">*</font> <small>(Days)</small></label>
                                                        <input type="text" id="delivery_days" name="delivery_days" class="form-control" value="<?php echo $delivery_days; ?>" required="required" />
                                                    </div>
                                                </div>
                                        
                                                <div class="col-md-4">

                                                    <div class="form-group">
                                                        <label class="control-label">Order Email-Id<font style="color: red;">*</font> </label>                                                       
                                                            <input type="email" id="oemail" title="Enter Order Email-Id" name="oemail" class="form-control" value="<?php echo $oemail; ?>" required="required" />
                                                    </div>
                                                </div>
                                                  <div class="col-md-4">
                                                </div>
                                                <div class="col-md-12">
                                                     
                                                        <label class="control-label">Products Terms<font style="color: red;">*</font></label>
                                                        <textarea required="required" rows="5" cols="5" id="text" name="text" class="form-control mymce"><?php echo $terms; ?></textarea>
                                                        <label for="text" class="has-error"></label>
                                                    
                                                </div>

                                            </div>




                                            <div class="form-actions" style="text-align:center;">
                                                <button class="btn btn-primary" type="reset"><i class="icon-refresh"></i> Reset</button> 
                                                <button type="submit" class="btn btn-info"><i class="icon-save"></i> Save Changes</button>
                                            </div>

                                        </form>
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
    <?php echo $jsfile; ?>

    <script src="<?php echo asset_url(); ?>plugins/validationengine/js/jquery.validationEngine.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    <script>
        $(function() {
            var base_url = '<?php echo base_url(); ?>';


            $('#brand-validate').validate({
                rules: {

                    text: {
                        required: function() {
                            CKEDITOR.instances.text.updateElement();
                        }
                    }

                },


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

    <script>
        $('#brand-validate').validate({
            errorClass: 'has-error',
            errorElement: 'span',
            ignore: [],

            rules: {

                text: {
                    required: function() {
                        CKEDITOR.instances.text.updateElement();
                    }
                }



            }
            //              messages: {
            //
            //
            //              }

            //              errorPlacement: function(error, element)
            //              {
            //
            //                  if (element.attr("name") == "privacy")
            //                  {
            //                      error.insertAfter("textarea#privacy");
            //                      element.addClass("has-error");
            //
            //
            //                  }
            //
            //                   else {
            //                      error.insertAfter(element);
            //
            //                  }
            //              }

        });
    </script>

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

    <script src="<?php echo asset_url(); ?>libs/tinymce/tinymce.min.js"></script>
    <script>
        $(function () {
            if ($(".mymce").length > 0) {
                tinymce.init({
                    selector: "textarea.mymce",
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                });
            }
        });
    </script>

</body>
<!-- END BODY-->

</html>