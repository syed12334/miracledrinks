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
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-wysihtml5-hack.css" />
    <script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.min.js"></script>  -->

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
                        <h3 class="text-themecolor mb-0">Contact Details</h3>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Footer</a></li>
                            <li class="breadcrumb-item active">Contact Details</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-12 align-self-center d-none d-md-block">

                    </div>
                </div>

                <div class="container-fluid" id="content">
                    <div class="inner" style="min-height:1200px;">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">

                                    <div id="collapseOne" class="card-body">
                                        <?php
                                        if (empty($info)) {
                                            $address = "";
                                            $contact = "";
                                            $email = "";
                                            $iframe = $time = "";
                                        } else {
                                            $address = $info[0]->address;
                                            $contact = $info[0]->phone;
                                            $email = $info[0]->email;
                                            $time = $info[0]->time;
                                            $iframe = $info[0]->iframe;
                                        }

                                        ?>
                                        <form id="form" action="<?php echo base_url() . 'footer/contact_save'; ?>" class="form-horizontal form-material row" method="post" enctype="multipart/form-data">
                                            <?php if (isset($message)) {
                                                echo $this->session->flashdata('message');
                                            } ?>



                                            <div class="form-group col-md-4">
                                                <label class="control-label">Contact No<font style="color: red;">*</font></label>
                                                <input required="required" type="text" id="phone" name="phone" class="form-control" maxlength="20" value="<?php echo $contact; ?>">
                                                <span class="badge badge-primary bg-primary text-white p-2 mt-2">Note: You can enter comma separated values</span>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label class="control-label">Contact Time<font style="color: red;">*</font></label>
                                                <input type="text" id="time" name="time" class="form-control" value="<?php echo $time; ?>" required="required" />
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label class="control-label">Email-Id<font style="color: red;">*</font></label>
                                                <input type="email" required="required" id="email" name="email" class="form-control" value="<?php echo $email; ?>">
                                                <span class="badge badge-primary bg-primary text-white p-2 mt-2">Note: You can enter comma separated values</span>
                                            </div>


                                           <!-- <div class="form-group col-md-12">
                                                <label class="control-label">Iframe</label>
                                                <textarea id="iframe" name="iframe" rows="4" cols="82" class="form-control" ><?php echo $iframe; ?></textarea>
                                            </div>-->


                                            <div class="form-group col-md-12">
                                                <label class="control-label">Address<font style="color: red;">*</font></label>
                                                <textarea required="required" rows="5" cols="5" id="address" name="address" class="form-control mymce"><?php echo $address; ?></textarea>
                                                <label for="address" class="has-error"></label>
                                            </div>





                                            <div class="form-actions no-margin-bottom col-md-12" style="text-align:center;">
                                                <label class="control-label"></label>
                                                <div class="">
                                                    <span id='error' style="width: 100%;"></span>
                                                </div>
                                                <button type="submit" class="btn btn-info "><i class="mdi mdi-check "></i> Save Changes</button>
                                            </div>
                                        </form>
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
        <p>&copy; <?php echo title; ?> &nbsp;2015 &nbsp;</p>
    </div>

    <!--END FOOTER -->

    <!-- GLOBAL SCRIPTS -->
 <script src="<?php echo asset_url(); ?>libs/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/bootstrap/js/bootstrap.min.js"></script>

    <script src="<?php echo asset_url(); ?>plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <!-- END GLOBAL SCRIPTS -->

    <script src="<?php echo asset_url(); ?>plugins/validationengine/js/jquery.validationEngine.js"></script>

    <script src="<?php echo asset_url(); ?>plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>

    <script src="<?php echo asset_url(); ?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/jasny/js/bootstrap-fileupload.js"></script>

   
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

    <script src="<?php echo asset_url(); ?>plugins/ckeditor/ckeditor.js" type="text/javascript"></script>

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
            CKEDITOR.config.width = "780px";
            CKEDITOR.config.height = "250px";
        });

        function validate() {
            $("#error").html("");
            var contact = document.getElementById("phone_no").value;
            var email_id = document.getElementById("email").value;
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

            if (CKEDITOR.instances.address.getData() == '') {
                $("#error").html("<div class='alert alert-danger alert-dismissable'><button class='close close-red' aria-hidden='true' data-dismiss='alert' type='button'>X</button>Enter Address</div>");
                return false;
            } else if (contact == "") {
                $("#error").html("<div class='alert alert-danger alert-dismissable'><button class='close close-red' aria-hidden='true' data-dismiss='alert' type='button'>X</button>Enter Contact No</div>");
                $("#phone_no").focus();
                return false;
            } else if (email_id == "") {
                $("#error").html("<div class='alert alert-danger alert-dismissable'><button class='close close-red' aria-hidden='true' data-dismiss='alert' type='button'>X</button>Enter Email Id</div>");
                $("#email").focus();
                return false;
            } else if (!emailReg.test(email_id)) {
                $("#error").html("<div class='alert alert-danger alert-dismissable'><button class='close close-red' aria-hidden='true' data-dismiss='alert' type='button'>X</button>Enter Valid Email Id</div>");
                $("#email").focus();
                return false;
            }

            return true;
        }
    </script>


    <script>
        $("#form").validate({
            ignore: [],
            errorClass: "has-error",
            rules: {

                address: {
                    required: function() {
                        CKEDITOR.instances.address.updateElement();
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