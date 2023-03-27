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
    <style type="text/css">
        .mininwidth {
            width: 120px;
        }

        .mininwidth1 {
            width: 80px;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {

            // restrict phone input
            $('#limit').keypress(function(key) {
                if (key.charCode == 0) return true;
                if (key.charCode < 48 || key.charCode > 57) return false;
            });



        });
    </script>



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
                        <h3 class="text-themecolor mb-0">Treatment Edit</h3>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
                            <li class="breadcrumb-item active">Treatment Edit</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-12 align-self-center d-none d-md-block">

                    </div>
                </div>

                <div class="container-fluid" id="content">
                    <div class="inner" style="min-height:1200px;">
                        <div class="row">
                            <div class="col-lg-12">

                               

                                 
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Treatment</h5>
                                            </div>
                                            <div id="collapseOne" class="card-body">
                                                <div id="processing"></div>
                                               <?php
                                                if(count($edit) >0) {
                                                ?>
                                                     <form id="diets" class="form-horizontal form-material" enctype="multipart/form-data" method="post">
                                                    <input type="hidden" value="<?= $edit[0]->tid;?>" name="cid">
                                                   
                                                    <div class="row">
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                          <label class="control-label">Title.<font style="color: red;">*</font></label>
                                                            <input type="text" id="title" name="title" class="form-control" value="<?= $edit[0]->title;?>"/>
                                                            <span id="title_error" class="text-danger"></span>
                                                    </div>
                                                </div>
<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Banner<font style="color: red;">*</font></label>
                                                         

                                                            <input type="file" id="pdf" name="pdf"  class="form-control" value="" />
                                                            <span id="pdf_error" class="text-danger"></span>
                                                        <?php 
                                                            if(!empty($edit[0]->image)) {
                                                            ?>
                                                            <img src="<?= base_url().$edit[0]->image;?>" style="width:100px">
                                                            <?php
                                                        }

                                                         ?>
                                                    </div>
                                                    </div>
                                                   
                                                   <div class="clearfix"></div>
                                                 
                      <div class="col-md-6">
                           <div class="form-group">
                                                        <label class="control-label">Recommended Diet</label>
                                                        <textarea class="form-control" id="sdesc" name="sdesc"><?= $edit[0]->rdiet;?></textarea>
                                                        <span id="sdesc_error" class="text-danger"></span>
                                                    </div>
                      </div>   

                       <div class="col-md-6">
                           <div class="form-group">
                                                        <label class="control-label">Things to keep in Mind</label>
                                                        <textarea class="form-control" id="ldesc" name="ldesc"><?= $edit[0]->things;?></textarea>
                                                        <span id="ldesc_error" class="text-danger"></span>
                                                    </div>
                      </div>   
                      <div class="clearfix"></div>                          
                                 <div class="col-md-6">
                                      <div class="form-group">
                                                        <label class="control-label">Morning</label>
                                                        <textarea class="form-control" id="morning" name="morning"><?= $edit[0]->morning;?></textarea>
                                                        <span id="ldesc_error" class="text-danger"></span>
                                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                     <div class="form-group">
                                                        <label class="control-label">Afternoon</label>
                                                        <textarea class="form-control" id="afternoon" name="afternoon"><?= $edit[0]->afternoon;?></textarea>
                                                        <span id="ldesc_error" class="text-danger"></span>
                                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                                 <div class="col-md-6">
                                     <div class="form-group">
                                                        <label class="control-label">Evening</label>
                                                        <textarea class="form-control" id="evening" name="evening"><?= $edit[0]->evening;?></textarea>
                                                        <span id="ldesc_error" class="text-danger"></span>
                                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                   
                                 </div>
                                 <div class="clearfix"></div>
                                                       <div class="col-md-12">

                                                        <div class="form-actions no-margin-bottom" style="text-align:center;">

                                                            <a href="<?php echo base_url() . 'master/diet'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info"><i class="mdi mdi-check "></i> Save Changes</button>
                                                        </div>
                                                        </div>
 </div>
                                                </form>
                                                <?php
                                            }else {
                                            redirect(base_url().'master/articles');
                                        }

                                               ?>
                                           
                                            </div>
                                        </div>
                                    </div>
                        
                            </div>
                        </div>

                         



                    </div>

                </div>
                <!--END PAGE CONTENT -->


            </div>

            <!--END MAIN WRAPPER -->

            <!-- FOOTER -->
            <div id="footer">
                <p>&copy; <?php echo fottertitle; ?> </p>
            </div>
            <!--END FOOTER -->
            <!-- GLOBAL SCRIPTS -->
            <script src="<?php echo asset_url(); ?>plugins/bootstrap/js/bootstrap.min.js"></script>
            <script src="<?php echo asset_url(); ?>plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
            <!-- END GLOBAL SCRIPTS -->
            <?php echo $jsfile; ?>

            <script src="<?php echo asset_url(); ?>plugins/validationengine/js/jquery.validationEngine.js"></script>
            <script src="<?php echo asset_url(); ?>plugins/jasny/js/bootstrap-fileupload.js"></script>
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
            <script src="<?php echo asset_url(); ?>libs/tinymce/tinymce.min.js"></script>

            <script>

                 $(function() {
            if ($("#sdesc").length > 0) {
                tinymce.init({
                    selector: "textarea#sdesc",
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

                       $(function() {
            if ($("#ldesc").length > 0) {
                tinymce.init({
                    selector: "textarea#ldesc",
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

                         $(function() {
            if ($("#morning").length > 0) {
                tinymce.init({
                    selector: "textarea#morning",
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

                         $(function() {
            if ($("#afternoon").length > 0) {
                tinymce.init({
                    selector: "textarea#afternoon",
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

                            $(function() {
            if ($("#evening").length > 0) {
                tinymce.init({
                    selector: "textarea#evening",
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
                $(function() {

                    var v = $("#brand-validate").validate({
                        errorClass: "help-block",
                        errorElement: 'span',
                        onkeyup: false,
                        onblur: false,
                        rules: {

                            desc: {

                                minlength: 20,
                                maxlength: 140
                            }
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
                 $(document).ready(function() {
      $("#diets").on("submit",function(e) {
    e.preventDefault();
      var formdata =new FormData(this);
      $.ajax({
          url :"<?= base_url().'master/treatmentsave';?>",
          method :"post",
          dataType:"json",
          data :formdata,
          contentType: false,
            cache: false,
            processData:false,
            success:function(data) {
            if(data.formerror ==false) {
              $(".csrf_token").val(data.csrf_token);
              if(data.title_error !='') {
                $("#title_error").html(data.title_error);
              }else {
                $("#title_error").html('');
              }
              if(data.pdf_error !='') {
                $("#pdf_error").html(data.pdf_error);
              }else {
                $("#pdf_error").html('');
              }
              if(data.sdesc_error !='') {
                $("#sdesc_error").html(data.sdesc_error);
              }else {
                $("#sdesc_error").html('');
              }
              if(data.ldesc_error !='') {
                $("#ldesc_error").html(data.ldesc_error);
              }else {
                $("#ldesc_error").html('');
              }
              if(data.link_error !='') {
                $("#link_error").html(data.link_error);
              }else {
                $("#link_error").html('');
              }
              
            }
            else if(data.status ==false) {
              $("#processing").html('<div class="alert alert-danger alert-dismissible"><i class="fas fa-ban"></i> '+data.msg+'</div>').show();
            }
            else if(data.status ==true) {
               $("#title_error").html('');
               $("#pdf_error").html('');
               $("#sdesc_error").html('');
               $("#ldesc_error").html('');
              
               $("#processing").html('<div class="alert alert-success alert-dismissible"><i class="fas fa-circle-check"></i> '+data.msg+'</div>');
                setTimeout(function() {window.location.href="<?= base_url().'master/treatment';?>";}, 1000);
            }
          }
      });
  });
});
            </script>

</body>
<!-- END BODY-->

</html>