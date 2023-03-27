<?php
   // echo "<pre>";print_r($details);exit;
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
    <title>View Blood Parameters</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/style.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
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
            cursor: pointer!important
        }
        .mininwidth1 {
            width: 80px;
        }
        #processing {
            position: fixed;
            z-index: 9999999999999999!important;
            right:30px;
            top:30px;
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
<div id="processing"></div>
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
                        <h3 class="text-themecolor mb-0">View Health Record</h3>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
                            <li class="breadcrumb-item active">View Health Record</li>
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
                              
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>View Health Record</h5>
                                            </div>
                                            <div id="collapseOne" class="card-body">
                                                <form id="bloodParams" class="form-horizontal form-material" method="post">
                                                   <input type="hidden" name="bid" value="<?= miracleDcrypt($this->uri->segment(3))?>">
                                                   <input type="hidden" name="uid" value="<?php if(count($doctors) >0) {echo $doctors[0]->user_id;}?>">
                                                    <div class="row">
 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Visits<font style="color: red;">*</font></label>
                                                         <select name="visits" id="visits" class="form-control">
                                                             <option value="">Select Visits</option>
                                                             <option value="1">1st Visit</option>
                                                             <option value="2">2nd Visit</option>
                                                             <option value="3">3rd Visit</option>
                                                             <option value="4">4th Visit</option>
                                                             <option value="5">5th Visit</option>
                                                             <option value="6">6th Visit</option>
                                                         </select>
                                                         <span id="visits_error" class="text-danger"></span>
                                                    </div>
                                                    </div>
                                                        <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Date<font style="color: red;">*</font></label>
                                                        <input type="date" name="date" class="form-control" id="date">
                                                      <span id="date_error" class="text-danger"></span>
                                                         
                                                    </div>
                                                    </div>
                                                  
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Symptoms<font style="color: red;">*</font></label>
                                                         <select name="symptoms[]" id="symptoms" class="form-control" multiple >
                                                             <option value="">Select Symptoms</option>
                                                             <?php 
                                                                if(count($symptoms) >0) {
                                                                    foreach ($symptoms as $key => $value) {
                                                                        ?>
                                                                        <option value="<?= $value->id;?>"><?= $value->title;?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                             ?>
                                                         </select>
                                                         <span id="symptoms_error" class="text-danger"></span>
                                                    </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-12">
                                                      <div class="form-group">
                                                          <label>Problem Initiated </label>
                                                          <textarea cols="4" rows="4" class="form-control" name="problem" id="problem"></textarea>
                                                      </div> 
                                                      <div style="margin-bottom: 20px">
                                                          <h4>Blood Parameters</h4>
                                                      </div>
                                                       <button type="button" id="parameterbtn" class="btn btn-warning" style="float: right;margin-bottom: 25px"><i class="fas fa-plus"></i> Add Parameters </button>
                                                    </div>
                                                    
                                                    <div class="clearfix"></div>
                                                  <div style="width: 100%" class="row" id="addparameters">
                                                        <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Select Blood Paremeters</label>
                                                            <select id="sblood" name="sblood[]" class="form-control">
                                                                <option value="">Select Blood Parameters</option>
                                                                <?php 
                                                                    if(count($parameters) >0) {
                                                                        foreach ($parameters as $key => $value) {
                                                                            ?>
                                                                            <option value="<?= $value->id;?>"><?= $value->title;?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                            <span id="parameters_error" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                         <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Title</label>
                                                           <input type="text" name="title[]" class="form-control" placeholder="Enter Title">
                                                           <span id="title_error" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                         <div class="col-md-4">
                                                       <div class="form-group">
                                                            <label>Value</label>
                                                           <input type="text" name="value[]" class="form-control" placeholder="Enter Value">
                                                           <span id="value_error" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                        <div class="clearfix"></div>
                                                  </div>
                                                
                                                     
                                                    <div class="col-md-6">
                                               
                                                                                                                                                                        </div>
                                                       <div class="col-md-12">

                                                        <div class="form-actions no-margin-bottom" style="text-align:center;">

                                                            <a href="<?php echo base_url() . 'master/doctorpanel'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info"><i class="mdi mdi-check "></i>Submit</button>
                                                        </div>
                                                        </div>
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
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
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
         

</body>
<!-- END BODY-->

</html>