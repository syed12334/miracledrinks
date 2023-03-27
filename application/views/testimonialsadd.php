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
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-fileupload.min.css" />
    <script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.min.js"></script>

    <?php echo $updatelogin; ?>
</head>
<!-- END  HEAD-->
<!-- BEGIN BODY-->

<body class="padTop53 ">

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
                    <h3 class="text-themecolor mb-0">Testimonials</h3>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home Page</a></li>
                        <li class="breadcrumb-item active">Testimonials</li>
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
                                            <h5>Edit Testimonial</h5>
                                        </div>

                                        <div id="collapseOne" class="card-body">
                                            <form action="<?php echo base_url() . 'about/stories_edit'; ?>" class="form-horizontal form-material row" id="organization_validate" method="post" onsubmit="return validate();" enctype="multipart/form-data">
                                                
                                                <input type="hidden" id="aid" name="aid" class="form-control" value="<?php echo $details[0]->id ?>" />


                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Order No. <font style="color: red;">*</font></label>
                                                    <input type="text" id="orderno" name="orderno" class="form-control onlynumbers" maxlength="3" required value="<?php echo $details[0]->order_no ?>" />
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Name <font style="color: red;">*</font></label>
                                                    <input type="text" id="name" name="name" class="form-control" required maxlength="35" value="<?php echo $details[0]->name ?>" />
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Location <font style="color: red;">*</font></label>
                                                    <input type="text" id="location" name="location" class="form-control" required value="<?php echo $details[0]->location ?>" />
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Comment<font style="color: red;">*</font></label>
                                                    <textarea id="comment" name="comment" class="form-control" required><?php echo $details[0]->comment ?></textarea>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Image <font style="color: red;">*</font></label>
                                                    <div class="fileupload fileupload-exists" data-provides="fileupload">
                                                        <div class="fileupload-preview thumbnail"><img src="<?php echo str_replace('/artii_manage', '', base_url()) . $details[0]->image_path; ?>"></div>
                                                        <div>

                                                            <span class="btn btn-file btn-info"><span class="fileupload-new selimage" uid="1">Select image</span><span class="fileupload-exists">Change</span>
                                                                <input type="file" name="imag" id="imag" /></span>

                                                            <a href="#" class="btn btn-primary fileupload-exists remimage" uid="" data-dismiss="fileupload">Remove</a>
                                                            <input type="hidden" id="imgstat" name="imgstat" value="1">
                                                        </div>

                                                    </div>

                                                    <div class="alert alert-info alert-dismissable col-md-12"><strong>Note:</strong> Please add image of size 89 x 89 px</div>
                                                </div>

                                                <div class="form-actions no-margin-bottom col-md-12" style="text-align:center;">
                                                    <a href="<?php echo base_url() . 'about/stories'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left"></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info"><i class="mdi mdi-check "></i> Save Changes</button>
                                                </div>
                                                <div class="col-md-12">
                                                    <div id="msgbox"></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                            <?php else : ?>

                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Add Testimonial</h5>
                                        </div>

                                        <div id="collapseOne" class="card-body">
                                            <form action="<?php echo base_url() . 'about/stories_save'; ?>" class="form-horizontal  form-material row" id="organization_validate" method="post" enctype="multipart/form-data">
                                                
                                                <input type="hidden" id="aid" name="aid" class="form-control" value="0" />


                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Order No. <font style="color: red;">*</font></label>

                                                    <input type="text" id="orderno" name="orderno" class="form-control onlynumbers" maxlength="3" required value="1" />

                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Name <font style="color: red;">*</font></label>

                                                    <input type="text" id="name" name="name" class="form-control" required maxlength="35" />

                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Location <font style="color: red;">*</font></label>

                                                    <input type="text" id="location" name="location" class="form-control" required />

                                                </div>



                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Comment<font style="color: red;">*</font></label>

                                                    <textarea id="comment" name="comment" class="form-control" required></textarea>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Image <font style="color: red;">*</font></label>

                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-preview thumbnail" ></div>
                                                        <div>
                                                            <span class="btn btn-file btn-info"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="imag" id="imag" required /></span>
                                                            <a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>

                                                        </div>
                                                    </div>
                                                    <div class="alert alert-info alert-dismissable col-md-12"><strong>Note:</strong> Please add image of size 89 x 89 px</div>
                                                </div>
                                                <div class="form-actions no-margin-bottom col-md-12" style="text-align:center;">
                                                    <a href="<?php echo base_url() . 'about/stories'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left"></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info"><i class="mdi mdi-check "></i> Save Changes</button>
                                                </div>

                                                <div id="msgbox" class=" col-md-12"></div>
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


    <?php echo $jsfile; ?>


    <script>
        $(function() {
            $('#organization_validate').validate({
                ignore: [],
                rules: {
                    orderno: "required",
                    name: "required",
                    editor: "required",

                    /*editor: {
                      required:true
                    }*/
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

    <script type="text/javascript">
        var empty_string = /^\s*$/;

        function validate() { //alert(0);
            if ($("#organization_validate").valid()) {
                $("#alert").remove();
                $("#msgbox").append("<div class='alert' id='alert'></div>");
                $("#alert").removeClass().addClass('alert').html('Validating....').fadeIn(1000);
                var imag = document.getElementById('imag').value;
                var imgstat = document.getElementById('imgstat').value;
                //alert(imgstat);		
                var rebatestr = "";
                //category
                if (empty_string.test(imag) && imgstat == "0") {

                    $("#alert").html("<button type='button' class='close' data-dismiss='alert'>&times;</button>Select Image").addClass('alert-danger').fadeTo(900, 1);
                    return false;
                } else {
                    $("#alert").html("<button type='button' class='close' data-dismiss='alert'>&times;</button>Please Wait Processing").addClass('alert-success').fadeTo(900, 1);
                    return true;
                }
            }
        }
    </script>

</body>
<!-- END BODY-->

</html>