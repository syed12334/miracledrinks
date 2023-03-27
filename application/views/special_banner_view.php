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
    <link href="<?php echo asset_url(); ?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-fileupload.min.css" />

    <script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.min.js"></script>
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
                        <h3 class="text-themecolor mb-0">Advertisement</h3>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home Page</a></li>
                            <li class="breadcrumb-item active">Advertisement</li>
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
                                            $ser = "error";
                                            if (is_array($info)) {
                                                $ser = $info[0]->description;
                                            }
                                            //                                 
                                            ?>
                                            <?php echo $this->session->flashdata('message'); ?>
                                            <div id="collapseOne" class="card-body">
                                                <form action="<?php echo base_url() . 'homepage/special_banner_save'; ?>" class="form-horizontal" id="form" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                <div class="col-md-6">
                                                <div class="form-group">
												<label class="control-label">Advertisement <font style="color: red;">*</font></label>
												
													<div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden" value="" name="imag">
														<div class="fileupload-preview thumbnail">
															<img src="<?php echo front_url().$info[0]->banner; ?>">
														</div>
														<div>
															<span class="btn btn-file btn-info"><span class="fileupload-new selimage" uid="1">Select image</span><span class="fileupload-exists">Change</span>
															<input type="file" name="imag" id="imag"></span>
															<input type="hidden" id="imgstat" name="imgstat" value="0">
														</div>
													</div>
												</div>
											</div>
											

                                            <div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Premium Products <font style="color: red;">*</font></label>
												
													<div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden" value="" name="imag">
														<div class="fileupload-preview thumbnail">
															<img src="<?php echo front_url().$info[0]->spcl_img; ?>">
														</div>
														<div>
															<span class="btn btn-file btn-info"><span class="fileupload-new selimage" uid="1">Select image</span><span class="fileupload-exists">Change</span>
															<input type="file" name="image" id="image"></span>
															<input type="hidden" id="imgstat" name="imgstat" value="0">
														</div>
													</div>
												</div>
											</div>

												<div class="form-group col-md-12">                                                        
														<textarea id="description" name="description" required title="Enter Delivery Info" class="form-control mymce"><?php echo $ser; ?></textarea>
														<label for="privacy" class="has-error"></label>
												</div>






                                                    <div class="form-actions no-margin-bottom col-md-12" style="text-align:center;">

                                                        <button type="submit" class="btn btn-info"><i class="mdi mdi-check "></i> Save Changes</button>
                                                    </div>
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


    <script src="<?php echo asset_url(); ?>libs/tinymce/tinymce.min.js"></script>
    <script>
        $(function() {
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


    <script>
        $(document).ready(function() {
            CKEDITOR.config.toolbar = [{
                    name: 'document',
                    groups: ['mode', 'document'],
                    items: ['Source', '-', 'Save', 'Preview', 'Print']
                },
                {
                    name: 'clipboard',
                    groups: ['clipboard', 'undo'],
                    items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker'],
                    items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                },
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup'],
                    items: ['Bold', 'Italic', 'Underline', 'Strike']
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'align'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
                },
                {
                    name: 'styles',
                    items: ['Format', 'Font', 'FontSize']
                }

            ];


            CKEDITOR.replace('privacy', {
                width: 600,
                height: 400
            });

        });
    </script>

    <script>
        $("#form").validate({
            ignore: [],
            errorClass: "has-error",
            rules: {

                privacy: {
                    required: function() {
                        CKEDITOR.instances.privacy.updateElement();
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

</body>
<!-- END BODY-->

</html>
