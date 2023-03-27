<?php
   //echo "<pre>";print_r($tests);exit;
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- BEGIN HEAD-->

<head>

    <meta charset="UTF-8" />
    <title>Blood Parameters</title>
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
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/select2.css" />
    <script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.min.js"></script>
   
    <?php echo $updatelogin; ?>
    <style type="text/css">
        .mininwidth {
            width: 120px;
        }
        .btn-danger {
            background: #dc3545!important;
            color:#fff!important;
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
                        <?php
                        if ($type == 'edit') { 
                            ?>
                            <h3 class="text-themecolor mb-0">Edit Blood Parameters</h3>
                            <?php
                        }else {
                            ?>
                            <h3 class="text-themecolor mb-0">Add Blood Parameters</h3>
                            <?php
                        }
                        ?>
                        
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
                            <li class="breadcrumb-item active">Add Blood Parameters</li>
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
                                <?php if ($type == 'edit') { 
                                    ?>
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Edit Blood Parameters</h5>
                                            </div>
                                            <div id="collapseOne" class="card-body">
                                                <form action="<?php echo base_url() . 'master/bloodparameters_edit'; ?>" class="form-horizontal form-material" enctype="multipart/form-data" id="brand-validate" method="post">
                                                    <input type="hidden" value="<?php echo $details[0]->id; ?>" name="aid">
                                                    <div class="row">
                                                       
                                                        <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Tests<font style="color: red;">*</font></label>
                                                           <select name="tests" id="tests" class="form-control" required>
                                                             <option value="">Select Tests</option>
                                                             <?php
                                                                if(count($tests) >0) {
                                                                    foreach ($tests as $key => $value) {
                                                                        ?>
                                                                        <option value="<?= $value->tid;?>" <?php if($value->tid == $details[0]->tid)  {echo "selected";}?>><?= $value->title;?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                             ?>

                                                         </select>
                                                         
                                                    </div>
                                                    </div>
                                                    <div class="col-md-5"  id="addpimages">
                                                    <div class="form-group">
    <label class="control-label">Title</label>
    <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?= $details[0]->title;?>" required>
 </div>
                                                    </div>
                                               <div class="col-md-3"></div>     
                                               <div class="clearfix"></div>     
                                                        
                                                        <div class="col-md-12">


                                                        <div class="form-actions" style="text-align:center;">

                                                            <a href="<?php echo base_url() . 'master/states'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info"><i class="mdi mdi-check "></i> Save Changes</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <?php } else { ?>
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Add Blood Parameters</h5>
                                            </div>
                                            <div id="collapseOne" class="card-body">
                                                <form action="<?php echo base_url() . 'master/savebloodparameters'; ?>" class="form-horizontal form-material" method="post">
                                                   
                                                    <div class="row">
 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Tests<font style="color: red;">*</font></label>
                                                         <select name="tests" id="tests" class="form-control" required>
                                                             <option value="">Select Tests</option>
                                                             <?php
                                                                if(count($tests) >0) {
                                                                    foreach ($tests as $key => $value) {
                                                                        ?>
                                                                        <option value="<?= $value->id;?>"><?= $value->title;?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                             ?>

                                                         </select>
                                                         
                                                    </div>
                                                    </div>
                                                        <div class="col-md-5"  id="addpimages">
                                                    <div class="form-group">
    <label class="control-label">Title</label>
    <input type="text" name="title[]" class="form-control" placeholder="Enter Title" required>
 </div>
                                                    </div>
                                                  
<div class="col-md-3" style="margin-top:22px">
                     <button type="button" id="imagesadd" class="btn btn-warning"><i class="fas fa-plus"></i> Add Title </button>                               
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-4">
                                                              
                                                    </div>
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4"></div>
                                                    <div class="clearfix"></div>
                                                     
                                                    <div class="col-md-6">
                                               
                                                                                                                                                                        </div>
                                                       <div class="col-md-12">

                                                        <div class="form-actions no-margin-bottom" style="text-align:center;">

                                                            <a href="<?php echo base_url() . 'master/bloodparameters'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info"><i class="mdi mdi-check "></i> Add Blood Parameters</button>
                                                        </div>
                                                        </div>
 </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
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
 <script type="text/javascript" src="<?php echo asset_url(); ?>js/select2.full.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url(); ?>js/select2-searchInputPlaceholder.js"></script>
            <script>
                $(document).ready(function() {
                     $('select').select2().on('select2:open', function(e){
                        $('.select2-search__field').attr('placeholder', 'Search here...');
                    });
                     var i=0;
                     $(document).on('click',"#imagesadd",function() {
   i++;
    var data = '<div class="form-group" id="rimg'+i+'"><label class="control-label">Title</label><input type="text" name="title[]" class="form-control" placeholder="Enter Title" style="width:89%"><button type="button" class="btn btn-danger" style="float:right;margin-top:-35px" onclick="removeTitle('+i+')"><i class="fas fa-minus"></i> </button></div>';
    $('#addpimages').append(data);
});


                });
                                     function removeTitle(trid)
{
  $("#rimg"+trid).fadeOut(500, function () { $("#rimg"+trid).remove(); });
}
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
            </script>

</body>
<!-- END BODY-->

</html>