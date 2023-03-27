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
  <!--         <link rel="stylesheet" href="<?= base_url(); ?>assets/main/css/bootstrap.css">
 --> <!-- include the site stylesheet -->

  <!-- include the site stylesheet -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/main/css/style.css">
  <!-- include the site responsive stylesheet -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/main/css/responsive.css">
  <script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.min.js"></script>

  <?php echo $updatelogin; ?>
  <style type="text/css">
    .mininwidth {
      width: 120px;
    }

    .btn-danger {
      background: #dc3545 !important;
      color: #fff !important;
      cursor: pointer !important
    }

    .mininwidth1 {
      width: 80px;
    }

    #processing {
      position: fixed;
      z-index: 9999999999999999 !important;
      right: 30px;
      top: 30px;
    }

    .text-danger p {
      color: red !important;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }

    .page-form h4{
      padding-left: 15px;
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

      <div class="page-wrapper page-form">
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
              <?php echo $this->session->flashdata('message'); ?>
              <div class="card" style="width: 100%">
                <div class="card-header">
                  <h5>View Health Record</h5>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3>Disease Name : <?= $doctors[0]->title; ?></h3>
              </div>
              <div class="clearfix"></div>

            </div>

            <div class="publication">

              <ul class="nav nav-tabs" role="tablist">

                <li role="presentation" class="active"><a href="#Education" aria-controls="Education" role="tab" data-toggle="tab">1st Visit</a></li>
                <li role="presentation"><a href="#Research_Interests" aria-controls="Research_Interests" role="tab" data-toggle="tab">2nd Visit</a></li>
                <li role="presentation"><a href="#Awards_and_Recognitions" aria-controls="Awards_and_Recognitions" role="tab" data-toggle="tab">3rd Visit </a></li>
                <li role="presentation"><a href="#Fellow_Or_Membership_of_Professional_Bodies" aria-controls="Fellow_Or_Membership_of_Professional_Bodies" role="tab" data-toggle="tab">4th Visit </a></li>
                <li role="presentation"><a href="#Brief_Profile_of_Professional_Career" aria-controls="Brief_Profile_of_Professional_Career" role="tab" data-toggle="tab">5th Visit </a></li>
                <li role="presentation"><a href="#sixth" aria-controls="sixth" role="tab" data-toggle="tab">6th Visit </a></li>


              </ul>


              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="Education">

                  <div class="col-lg-12">


                    <div>
                      <div class="card">

                        <div id="collapseOne" class="card-body">
                          <?php

                          ?>
                          <form id="bloodParams" class="form-horizontal" method="post">
                            <input type="hidden" name="bid" value="<?= miracleDcrypt($this->uri->segment(3)) ?>">
                            <input type="hidden" name="visit_id" value="<?php if (count($visit1) > 0) {
                                                                          echo $visit1[0]->id;
                                                                        } ?>">
                            <input type="hidden" name="did" value="<?php if (count($doctors) > 0) {
                                                                      echo $doctors[0]->disease_id;
                                                                    } ?>">
                            <input type="hidden" name="uid" value="<?php if (count($doctors) > 0) {
                                                                      echo $doctors[0]->user_id;
                                                                    } ?>">
                            <input type="hidden" name="visits" value="1">
                            <div class="row">

                            <div class="col-md-6">
                              <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="control-label">Date<font style="color: red;">*</font></label>
                                  <input type="date" name="date" class="form-control" id="date" value="<?php if (is_array($visit1) && !empty($visit1)) {
                                                                                                          echo $visit1[0]->vdate;
                                                                                                        } ?>">
                                  <span id="date_error" class="text-danger"></span>

                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Problem Initiated </label>
                                  <textarea cols="4" rows="4" class="form-control" name="problem" id="problem"><?php if (is_array($visit1) && !empty($visit1)) {
                                                                                                                  echo $visit1[0]->problems;
                                                                                                                } ?></textarea>
                                </div>


                              </div>
                            </div>
                              </div>

                              <div class="col-md-6 form-grop">
                                <label class="control-label">Symptoms<font style="color: red;">*</font></label>
                                <br />
                                <div class="form-group">


                                  <?php
                                  if (count($symptoms) > 0) {
                                    foreach ($symptoms as $key => $value) {
                                  ?>
<input type="hidden" name="symids[]" id="symids<?= $value->id;?>">
                                      <span>
                                        <label> <input type="checkbox" name="symptoms[]" value="<?= $value->id; ?>" class="symptoms" <?php
                                                                                                                                    if (count($psymptoms1) > 0 && is_array($psymptoms1)) {
                                                                                                                                      foreach ($psymptoms1 as $key => $sy) {
                                                                                                                                        if ($value->id == $sy->sid) {
                                                                                                                                          echo "checked";
                                                                                                                                        }
                                                                                                                                      }
                                                                                                                                    }

                                                                                                                                    ?>> <?= $value->title; ?></label>
                                      </span>

                                  <?php
                                    }
                                  }
                                  ?>



                                </div>
                                <span id="symptoms_error" class="text-danger"></span>
                              </div>



                              <div class="clearfix"></div>



                              <div class="col-md-12">
                                <div style="margin-bottom: 20px">
                                  <h4>Blood Parameters</h4>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <?php
                              if (count($tests) > 0) {
                                foreach ($tests as $key => $value) {
                                  $tid = $value->tid;
                                  $vids ="";
                                 if (count($visit1) > 0) {
                                    $vids .= " and vid=".$visit1[0]->id;
                                 } 
                              ?>
                              <input type="hidden" name="testids[]" id="testids<?=$value->tid; ?>">
                                  <div class="col-xs-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                      <input type="checkbox" name="tests[]" class="tests" value="<?= $value->tid; ?>" <?php
                                                                                                                      if (count($userblood1) > 0) {
                                                                                                                        foreach ($userblood1 as $key => $ub) {

                                                                                                                          if ($value->tid == $ub->tid) {
                                                                                                                            echo "checked";
                                                                                                                          }
                                                                                                                        }
                                                                                                                      }

                                                                                                                      ?>>
                                      <?php
                                      if (count($userblood1) > 0) {
                                        foreach ($userblood1 as $key => $ub) {
                                      ?>
                                          <input type="hidden" name="userbloodcount[]" value="">
                                      <?php
                                        }
                                      }
                                      ?>
                                      <span style="font-size:17px!important;font-weight: bold;"><?= $value->title; ?></span>
                                    </div>

                                  </div>
                                  <div class="col-xs-12 col-md-8 col-sm-8 col-lg-8">
                                    <div style="display: none">New</div>
                                  </div>
                                  <div class="clearfix"></div>
                                  <div class="row" id="appenrows<?= $value->tid; ?>" style="width: 100%;margin: 10px 5px;">
                                    <?php
                                    if (!empty($visit1) && is_array($visit1)) {

                                      $params = $this->master_db->sqlExecute('select uc.tid,ub.id,ub.title,ub.nvalue,ub.tid,bp.title as test_name from user_blood_parameters ub left join user_blood_parameters_count uc on uc.id= ub.pid left join blood_parameters_details bp on bp.id=ub.tid where uc.vid =' . $visit1[0]->id . ' and uc.tid=' . $tid . '');
                                      if (count($params) > 0 && is_array($params)) {

                                        foreach ($params as $new => $bp) {
                                          $tids =$bp->tid;
                                          // $paramsnew = $this->master_db->sqlExecute('select uc.tid,bp.title as test_name from user_blood_parameters_count uc left join blood_parameters_details bp on bp.id=ub.tid where uc.tid ! =' . $tids . ' ');
                                    ?>
                                    <input type="hidden" name="bparams[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->tid;?>">
                                          <div class="col-xs-12 col-md-5 col-lg-5">
                                            <h4 style="font-size:15px!important;font-weight: normal!important"><?= $bp->test_name; ?></h4>
                                            <input type="hidden" name="sblood[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->id; ?>">
                                            <input type="hidden" name="userbloodparams[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->id; ?>">
                                          </div>
                                          <div class="col-xs-12 col-md-3 col-lg-3">
                                            <div class="form-group">
                                              <input type="number" name="nvalue[<?= $value->tid; ?>][<?= $bp->id; ?>]" class="form-control" placeholder="Enter Value" min="0" value="<?= $bp->nvalue; ?>">
                                            </div>
                                          </div>
                                          <div class="col-xs-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                              <input type="text" name="title[<?= $value->tid; ?>][<?= $bp->id; ?>]" class="form-control" placeholder="Enter Unit" value="<?= $bp->title; ?>">
                                            </div>
                                          </div>

                                    <?php
                                        }
                                      }
                                    }


                                    ?>
                                  </div>
                              <?php
                                }
                              }
                              ?>



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


                <div role="tabpanel" class="tab-pane " id="Research_Interests">
                          <form id="bloodParams1" class="form-horizontal" method="post">
                            <input type="hidden" name="bid" value="<?= miracleDcrypt($this->uri->segment(3)) ?>">
                            <input type="hidden" name="visit_id" value="<?php if (count($visit2) > 0) {
                                                                          echo $visit2[0]->id;
                                                                        } ?>">
                            <input type="hidden" name="did" value="<?php if (count($doctors) > 0) {
                                                                      echo $doctors[0]->disease_id;
                                                                    } ?>">
                            <input type="hidden" name="uid" value="<?php if (count($doctors) > 0) {
                                                                      echo $doctors[0]->user_id;
                                                                    } ?>">
                            <input type="hidden" name="visits" value="2">
                            <div class="row">

                            <div class="col-md-6">
                              <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="control-label">Date<font style="color: red;">*</font></label>
                                  <input type="date" name="date" class="form-control" id="date" value="<?php if (is_array($visit2) && !empty($visit2)) {
                                                                                                          echo $visit2[0]->vdate;
                                                                                                        } ?>">
                                  <span id="date1_error" class="text-danger"></span>

                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Problem Initiated </label>
                                  <textarea cols="4" rows="4" class="form-control" name="problem" id="problem"><?php if (is_array($visit2) && !empty($visit2)) {
                                                                                                                  echo $visit2[0]->problems;
                                                                                                                } ?></textarea>
                                </div>


                              </div>
                            </div>
                              </div>

                              <div class="col-md-6 form-grop">
                                <label class="control-label">Symptoms<font style="color: red;">*</font></label>
                                <br />
                                <div class="form-group">


                                  <?php
                                  if (count($symptoms) > 0) {
                                    foreach ($symptoms as $key => $value) {
                                  ?>
<input type="hidden" name="symids[]" id="symids1<?= $value->id;?>">
                                      <span>
                                        <label> <input type="checkbox" name="symptoms[]" value="<?= $value->id; ?>" class="symptoms1" <?php
                                                                                                                                    if (count($psymptoms2) > 0 && is_array($psymptoms2)) {
                                                                                                                                      foreach ($psymptoms2 as $key => $sy) {
                                                                                                                                        if ($value->id == $sy->sid) {
                                                                                                                                          echo "checked";
                                                                                                                                        }
                                                                                                                                      }
                                                                                                                                    }

                                                                                                                                    ?>> <?= $value->title; ?></label>
                                      </span>

                                  <?php
                                    }
                                  }
                                  ?>



                                </div>
                                <span id="symptoms1_error" class="text-danger"></span>
                              </div>



                              <div class="clearfix"></div>



                              <div class="col-md-12">
                                <div style="margin-bottom: 20px">
                                  <h4>Blood Parameters</h4>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <?php
                              if (count($tests) > 0) {
                                foreach ($tests as $key => $value) {
                                  $tid = $value->tid;
                                  $vids ="";
                                 if (count($visit2) > 0) {
                                    $vids .= " and vid=".$visit2[0]->id;
                                 } 
                              ?>
                              <input type="hidden" name="testids[]" id="testids1<?=$value->tid; ?>">
                                  <div class="col-xs-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                      <input type="checkbox" name="tests[]" class="tests1" value="<?= $value->tid; ?>" <?php
                                                                                                                      if (count($userblood2) > 0) {
                                                                                                                        foreach ($userblood2 as $key => $ub) {

                                                                                                                          if ($value->tid == $ub->tid) {
                                                                                                                            echo "checked";
                                                                                                                          }
                                                                                                                        }
                                                                                                                      }

                                                                                                                      ?>>
                                      <?php
                                      if (count($userblood2) > 0) {
                                        foreach ($userblood2 as $key => $ub) {
                                      ?>
                                          <input type="hidden" name="userbloodcount[]" value="">
                                      <?php
                                        }
                                      }
                                      ?>
                                      <span style="font-size:17px!important;font-weight: bold;"><?= $value->title; ?></span>
                                    </div>

                                  </div>
                                  <div class="col-xs-12 col-md-8 col-sm-8 col-lg-8">
                                    <div style="display: none">New</div>
                                  </div>
                                  <div class="clearfix"></div>
                                  <div class="row" id="appenrows1<?= $value->tid; ?>" style="width: 100%;margin: 10px 5px;">
                                    <?php
                                    if (!empty($visit2) && is_array($visit2)) {

                                      $params = $this->master_db->sqlExecute('select uc.tid,ub.id,ub.title,ub.nvalue,ub.tid,bp.title as test_name from user_blood_parameters ub left join user_blood_parameters_count uc on uc.id= ub.pid left join blood_parameters_details bp on bp.id=ub.tid where uc.vid =' . $visit2[0]->id . '  and uc.tid=' . $tid . ' ');
                                      if (count($params) > 0 && is_array($params)) {

                                        foreach ($params as $new => $bp) {
                                          $tids =$bp->tid;
                                          // $paramsnew = $this->master_db->sqlExecute('select uc.tid,bp.title as test_name from user_blood_parameters_count uc left join blood_parameters_details bp on bp.id=ub.tid where uc.tid ! =' . $tids . ' ');
                                    ?>
                                    <input type="hidden" name="bparams[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->tid;?>">
                                          <div class="col-xs-12 col-md-5 col-lg-5">
                                            <h4 style="font-size:15px!important;font-weight: normal!important"><?= $bp->test_name; ?></h4>
                                            <input type="hidden" name="sblood[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->id; ?>">
                                            <input type="hidden" name="userbloodparams[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->id; ?>">
                                          </div>
                                          <div class="col-xs-12 col-md-3 col-lg-3">
                                            <div class="form-group">
                                              <input type="number" name="nvalue[<?= $value->tid; ?>][<?= $bp->id; ?>]" class="form-control" placeholder="Enter Value" min="0" value="<?= $bp->nvalue; ?>">
                                            </div>
                                          </div>
                                          <div class="col-xs-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                              <input type="text" name="title[<?= $value->tid; ?>][<?= $bp->id; ?>]" class="form-control" placeholder="Enter Unit" value="<?= $bp->title; ?>">
                                            </div>
                                          </div>

                                    <?php
                                        }
                                      }
                                    }


                                    ?>
                                  </div>
                              <?php
                                }
                              }
                              ?>



                              <div class="col-md-12">

                                <div class="form-actions no-margin-bottom" style="text-align:center;">

                                  <a href="<?php echo base_url() . 'master/doctorpanel'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info"><i class="mdi mdi-check "></i>Submit</button>
                                </div>
                              </div>
                            </div>
                          </form>

                </div>



                <div role="tabpanel" class="tab-pane " id="Awards_and_Recognitions">
  <form id="bloodParams2" class="form-horizontal" method="post">
                            <input type="hidden" name="bid" value="<?= miracleDcrypt($this->uri->segment(3)) ?>">
                            <input type="hidden" name="visit_id" value="<?php if (count($visit3) > 0) {
                                                                          echo $visit3[0]->id;
                                                                        } ?>">
                            <input type="hidden" name="did" value="<?php if (count($doctors) > 0) {
                                                                      echo $doctors[0]->disease_id;
                                                                    } ?>">
                            <input type="hidden" name="uid" value="<?php if (count($doctors) > 0) {
                                                                      echo $doctors[0]->user_id;
                                                                    } ?>">
                            <input type="hidden" name="visits" value="3">
                            <div class="row">

                            <div class="col-md-6">
                              <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="control-label">Date<font style="color: red;">*</font></label>
                                  <input type="date" name="date" class="form-control" id="date" value="<?php if (is_array($visit3) && !empty($visit3)) {
                                                                                                          echo $visit3[0]->vdate;
                                                                                                        } ?>">
                                  <span id="date2_error" class="text-danger"></span>

                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Problem Initiated </label>
                                  <textarea cols="4" rows="4" class="form-control" name="problem" id="problem"><?php if (is_array($visit3) && !empty($visit3)) {
                                                                                                                  echo $visit3[0]->problems;
                                                                                                                } ?></textarea>
                                </div>


                              </div>
                            </div>
                              </div>

                              <div class="col-md-6 form-grop">
                                <label class="control-label">Symptoms<font style="color: red;">*</font></label>
                                <br />
                                <div class="form-group">


                                  <?php
                                  if (count($symptoms) > 0) {
                                    foreach ($symptoms as $key => $value) {
                                  ?>
<input type="hidden" name="symids[]" id="symids2<?= $value->id;?>">
                                      <span>
                                        <label> <input type="checkbox" name="symptoms[]" value="<?= $value->id; ?>" class="symptoms2" <?php
                                                                                                                                    if (count($psymptoms3) > 0 && is_array($psymptoms3)) {
                                                                                                                                      foreach ($psymptoms3 as $key => $sy) {
                                                                                                                                        if ($value->id == $sy->sid) {
                                                                                                                                          echo "checked";
                                                                                                                                        }
                                                                                                                                      }
                                                                                                                                    }

                                                                                                                                    ?>> <?= $value->title; ?></label>
                                      </span>

                                  <?php
                                    }
                                  }
                                  ?>



                                </div>
                                <span id="symptoms2_error" class="text-danger"></span>
                              </div>



                              <div class="clearfix"></div>



                              <div class="col-md-12">
                                <div style="margin-bottom: 20px">
                                  <h4>Blood Parameters</h4>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <?php
                              if (count($tests) > 0) {
                                foreach ($tests as $key => $value) {
                                  $tid = $value->tid;
                                  $vids ="";
                                 if (count($visit3) > 0) {
                                    $vids .= " and vid=".$visit3[0]->id;
                                 } 
                              ?>
                              <input type="hidden" name="testids[]" id="testids2<?=$value->tid; ?>">
                                  <div class="col-xs-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                      <input type="checkbox" name="tests[]" class="tests2" value="<?= $value->tid; ?>" <?php
                                                                                                                      if (count($userblood3) > 0) {
                                                                                                                        foreach ($userblood3 as $key => $ub) {

                                                                                                                          if ($value->tid == $ub->tid) {
                                                                                                                            echo "checked";
                                                                                                                          }
                                                                                                                        }
                                                                                                                      }

                                                                                                                      ?>>
                                      <?php
                                      if (count($userblood3) > 0) {
                                        foreach ($userblood3 as $key => $ub) {
                                      ?>
                                          <input type="hidden" name="userbloodcount[]" value="">
                                      <?php
                                        }
                                      }
                                      ?>
                                      <span style="font-size:17px!important;font-weight: bold;"><?= $value->title; ?></span>
                                    </div>

                                  </div>
                                  <div class="col-xs-12 col-md-8 col-sm-8 col-lg-8">
                                    <div style="display: none">New</div>
                                  </div>
                                  <div class="clearfix"></div>
                                  <div class="row" id="appenrows2<?= $value->tid; ?>" style="width: 100%;margin: 10px 5px;">
                                    <?php
                                    if (!empty($visit3) && is_array($visit3)) {

                                      $params = $this->master_db->sqlExecute('select uc.tid,ub.id,ub.title,ub.nvalue,ub.tid,bp.title as test_name from user_blood_parameters ub left join user_blood_parameters_count uc on uc.id= ub.pid left join blood_parameters_details bp on bp.id=ub.tid where uc.vid =' . $visit3[0]->id . '  and uc.tid=' . $tid . ' ');
                                      if (count($params) > 0 && is_array($params)) {

                                        foreach ($params as $new => $bp) {
                                          $tids =$bp->tid;
                                          // $paramsnew = $this->master_db->sqlExecute('select uc.tid,bp.title as test_name from user_blood_parameters_count uc left join blood_parameters_details bp on bp.id=ub.tid where uc.tid ! =' . $tids . ' ');
                                    ?>
                                    <input type="hidden" name="bparams[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->tid;?>">
                                          <div class="col-xs-12 col-md-5 col-lg-5">
                                            <h4 style="font-size:15px!important;font-weight: normal!important"><?= $bp->test_name; ?></h4>
                                            <input type="hidden" name="sblood[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->id; ?>">
                                            <input type="hidden" name="userbloodparams[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->id; ?>">
                                          </div>
                                          <div class="col-xs-12 col-md-3 col-lg-3">
                                            <div class="form-group">
                                              <input type="number" name="nvalue[<?= $value->tid; ?>][<?= $bp->id; ?>]" class="form-control" placeholder="Enter Value" min="0" value="<?= $bp->nvalue; ?>">
                                            </div>
                                          </div>
                                          <div class="col-xs-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                              <input type="text" name="title[<?= $value->tid; ?>][<?= $bp->id; ?>]" class="form-control" placeholder="Enter Unit" value="<?= $bp->title; ?>">
                                            </div>
                                          </div>

                                    <?php
                                        }
                                      }
                                    }


                                    ?>
                                  </div>
                              <?php
                                }
                              }
                              ?>



                              <div class="col-md-12">

                                <div class="form-actions no-margin-bottom" style="text-align:center;">

                                  <a href="<?php echo base_url() . 'master/doctorpanel'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info"><i class="mdi mdi-check "></i>Submit</button>
                                </div>
                              </div>
                            </div>
                          </form>

                </div>

                <div role="tabpanel" class="tab-pane " id="Fellow_Or_Membership_of_Professional_Bodies">
                      <form id="bloodParams3" class="form-horizontal" method="post">
                            <input type="hidden" name="bid" value="<?= miracleDcrypt($this->uri->segment(3)) ?>">
                            <input type="hidden" name="visit_id" value="<?php if (count($visit4) > 0) {
                                                                          echo $visit4[0]->id;
                                                                        } ?>">
                            <input type="hidden" name="did" value="<?php if (count($doctors) > 0) {
                                                                      echo $doctors[0]->disease_id;
                                                                    } ?>">
                            <input type="hidden" name="uid" value="<?php if (count($doctors) > 0) {
                                                                      echo $doctors[0]->user_id;
                                                                    } ?>">
                            <input type="hidden" name="visits" value="4">
                            <div class="row">

                            <div class="col-md-6">
                              <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="control-label">Date<font style="color: red;">*</font></label>
                                  <input type="date" name="date" class="form-control" id="date" value="<?php if (is_array($visit4) && !empty($visit4)) {
                                                                                                          echo $visit4[0]->vdate;
                                                                                                        } ?>">
                                  <span id="date3_error" class="text-danger"></span>

                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Problem Initiated </label>
                                  <textarea cols="4" rows="4" class="form-control" name="problem" id="problem"><?php if (is_array($visit4) && !empty($visit4)) {
                                                                                                                  echo $visit4[0]->problems;
                                                                                                                } ?></textarea>
                                </div>


                              </div>
                            </div>
                              </div>

                              <div class="col-md-6 form-grop">
                                <label class="control-label">Symptoms<font style="color: red;">*</font></label>
                                <br />
                                <div class="form-group">


                                  <?php
                                  if (count($symptoms) > 0) {
                                    foreach ($symptoms as $key => $value) {
                                  ?>
<input type="hidden" name="symids[]" id="symids3<?= $value->id;?>">
                                      <span>
                                        <label> <input type="checkbox" name="symptoms[]" value="<?= $value->id; ?>" class="symptoms3" <?php
                                                                                                                                    if (count($psymptoms4) > 0 && is_array($psymptoms4)) {
                                                                                                                                      foreach ($psymptoms4 as $key => $sy) {
                                                                                                                                        if ($value->id == $sy->sid) {
                                                                                                                                          echo "checked";
                                                                                                                                        }
                                                                                                                                      }
                                                                                                                                    }

                                                                                                                                    ?>> <?= $value->title; ?></label>
                                      </span>

                                  <?php
                                    }
                                  }
                                  ?>



                                </div>
                                <span id="symptoms3_error" class="text-danger"></span>
                              </div>



                              <div class="clearfix"></div>



                              <div class="col-md-12">
                                <div style="margin-bottom: 20px">
                                  <h4>Blood Parameters</h4>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <?php
                              if (count($tests) > 0) {
                                foreach ($tests as $key => $value) {
                                  $tid = $value->tid;
                                  $vids ="";
                                 if (count($visit4) > 0) {
                                    $vids .= " and vid=".$visit4[0]->id;
                                 } 
                              ?>
                              <input type="hidden" name="testids[]" id="testids3<?=$value->tid; ?>">
                                  <div class="col-xs-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                      <input type="checkbox" name="tests[]" class="tests3" value="<?= $value->tid; ?>" <?php
                                                                                                                      if (count($userblood4) > 0) {
                                                                                                                        foreach ($userblood4 as $key => $ub) {

                                                                                                                          if ($value->tid == $ub->tid) {
                                                                                                                            echo "checked";
                                                                                                                          }
                                                                                                                        }
                                                                                                                      }

                                                                                                                      ?>>
                                      <?php
                                      if (count($userblood4) > 0) {
                                        foreach ($userblood4 as $key => $ub) {
                                      ?>
                                          <input type="hidden" name="userbloodcount[]" value="">
                                      <?php
                                        }
                                      }
                                      ?>
                                      <span style="font-size:17px!important;font-weight: bold;"><?= $value->title; ?></span>
                                    </div>

                                  </div>
                                  <div class="col-xs-12 col-md-8 col-sm-8 col-lg-8">
                                    <div style="display: none">New</div>
                                  </div>
                                  <div class="clearfix"></div>
                                  <div class="row" id="appenrows3<?= $value->tid; ?>" style="width: 100%;margin: 10px 5px;">
                                    <?php
                                    if (!empty($visit4) && is_array($visit4)) {

                                      $params = $this->master_db->sqlExecute('select uc.tid,ub.id,ub.title,ub.nvalue,ub.tid,bp.title as test_name from user_blood_parameters ub left join user_blood_parameters_count uc on uc.id= ub.pid left join blood_parameters_details bp on bp.id=ub.tid where uc.vid =' . $visit4[0]->id . '  and uc.tid=' . $tid . ' ');
                                      if (count($params) > 0 && is_array($params)) {

                                        foreach ($params as $new => $bp) {
                                          $tids =$bp->tid;
                                          // $paramsnew = $this->master_db->sqlExecute('select uc.tid,bp.title as test_name from user_blood_parameters_count uc left join blood_parameters_details bp on bp.id=ub.tid where uc.tid ! =' . $tids . ' ');
                                    ?>
                                    <input type="hidden" name="bparams[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->tid;?>">
                                          <div class="col-xs-12 col-md-5 col-lg-5">
                                            <h4 style="font-size:15px!important;font-weight: normal!important"><?= $bp->test_name; ?></h4>
                                            <input type="hidden" name="sblood[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->id; ?>">
                                            <input type="hidden" name="userbloodparams[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->id; ?>">
                                          </div>
                                          <div class="col-xs-12 col-md-3 col-lg-3">
                                            <div class="form-group">
                                              <input type="number" name="nvalue[<?= $value->tid; ?>][<?= $bp->id; ?>]" class="form-control" placeholder="Enter Value" min="0" value="<?= $bp->nvalue; ?>">
                                            </div>
                                          </div>
                                          <div class="col-xs-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                              <input type="text" name="title[<?= $value->tid; ?>][<?= $bp->id; ?>]" class="form-control" placeholder="Enter Unit" value="<?= $bp->title; ?>">
                                            </div>
                                          </div>

                                    <?php
                                        }
                                      }
                                    }


                                    ?>
                                  </div>
                              <?php
                                }
                              }
                              ?>



                              <div class="col-md-12">

                                <div class="form-actions no-margin-bottom" style="text-align:center;">

                                  <a href="<?php echo base_url() . 'master/doctorpanel'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info"><i class="mdi mdi-check "></i>Submit</button>
                                </div>
                              </div>
                            </div>
                          </form>
                </div>

                <div role="tabpanel" class="tab-pane " id="Brief_Profile_of_Professional_Career">

<form id="bloodParams4" class="form-horizontal" method="post">
                            <input type="hidden" name="bid" value="<?= miracleDcrypt($this->uri->segment(3)) ?>">
                            <input type="hidden" name="visit_id" value="<?php if (count($visit5) > 0) {
                                                                          echo $visit5[0]->id;
                                                                        } ?>">
                            <input type="hidden" name="did" value="<?php if (count($doctors) > 0) {
                                                                      echo $doctors[0]->disease_id;
                                                                    } ?>">
                            <input type="hidden" name="uid" value="<?php if (count($doctors) > 0) {
                                                                      echo $doctors[0]->user_id;
                                                                    } ?>">
                            <input type="hidden" name="visits" value="5">
                            <div class="row">

                            <div class="col-md-6">
                              <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="control-label">Date<font style="color: red;">*</font></label>
                                  <input type="date" name="date" class="form-control" id="date" value="<?php if (is_array($visit5) && !empty($visit5)) {
                                                                                                          echo $visit5[0]->vdate;
                                                                                                        } ?>">
                                  <span id="date4_error" class="text-danger"></span>

                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Problem Initiated </label>
                                  <textarea cols="4" rows="4" class="form-control" name="problem" id="problem"><?php if (is_array($visit5) && !empty($visit5)) {
                                                                                                                  echo $visit5[0]->problems;
                                                                                                                } ?></textarea>
                                </div>


                              </div>
                            </div>
                              </div>

                              <div class="col-md-6 form-grop">
                                <label class="control-label">Symptoms<font style="color: red;">*</font></label>
                                <br />
                                <div class="form-group">


                                  <?php
                                  if (count($symptoms) > 0) {
                                    foreach ($symptoms as $key => $value) {
                                  ?>
<input type="hidden" name="symids[]" id="symids4<?= $value->id;?>">
                                      <span>
                                        <label> <input type="checkbox" name="symptoms[]" value="<?= $value->id; ?>" class="symptoms4" <?php
                                                                                                                                    if (count($psymptoms5) > 0 && is_array($psymptoms5)) {
                                                                                                                                      foreach ($psymptoms5 as $key => $sy) {
                                                                                                                                        if ($value->id == $sy->sid) {
                                                                                                                                          echo "checked";
                                                                                                                                        }
                                                                                                                                      }
                                                                                                                                    }

                                                                                                                                    ?>> <?= $value->title; ?></label>
                                      </span>

                                  <?php
                                    }
                                  }
                                  ?>



                                </div>
                                <span id="symptoms4_error" class="text-danger"></span>
                              </div>



                              <div class="clearfix"></div>



                              <div class="col-md-12">
                                <div style="margin-bottom: 20px">
                                  <h4>Blood Parameters</h4>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <?php
                              if (count($tests) > 0) {
                                foreach ($tests as $key => $value) {
                                  $tid = $value->tid;
                                  $vids ="";
                                 if (count($visit5) > 0) {
                                    $vids .= " and vid=".$visit5[0]->id;
                                 } 
                              ?>
                              <input type="hidden" name="testids[]" id="testids4<?=$value->tid; ?>">
                                  <div class="col-xs-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                      <input type="checkbox" name="tests[]" class="tests4" value="<?= $value->tid; ?>" <?php
                                                                                                                      if (count($userblood5) > 0) {
                                                                                                                        foreach ($userblood5 as $key => $ub) {

                                                                                                                          if ($value->tid == $ub->tid) {
                                                                                                                            echo "checked";
                                                                                                                          }
                                                                                                                        }
                                                                                                                      }

                                                                                                                      ?>>
                                      <?php
                                      if (count($userblood5) > 0) {
                                        foreach ($userblood5 as $key => $ub) {
                                      ?>
                                          <input type="hidden" name="userbloodcount[]" value="">
                                      <?php
                                        }
                                      }
                                      ?>
                                      <span style="font-size:17px!important;font-weight: bold;"><?= $value->title; ?></span>
                                    </div>

                                  </div>
                                  <div class="col-xs-12 col-md-8 col-sm-8 col-lg-8">
                                    <div style="display: none">New</div>
                                  </div>
                                  <div class="clearfix"></div>
                                  <div class="row" id="appenrows4<?= $value->tid; ?>" style="width: 100%;margin: 10px 5px;">
                                    <?php
                                    if (!empty($visit5) && is_array($visit5)) {

                                      $params = $this->master_db->sqlExecute('select uc.tid,ub.id,ub.title,ub.nvalue,ub.tid,bp.title as test_name from user_blood_parameters ub left join user_blood_parameters_count uc on uc.id= ub.pid left join blood_parameters_details bp on bp.id=ub.tid where uc.vid =' . $visit5[0]->id . '  and uc.tid=' . $tid . ' ');
                                      if (count($params) > 0 && is_array($params)) {

                                        foreach ($params as $new => $bp) {
                                          $tids =$bp->tid;
                                          // $paramsnew = $this->master_db->sqlExecute('select uc.tid,bp.title as test_name from user_blood_parameters_count uc left join blood_parameters_details bp on bp.id=ub.tid where uc.tid ! =' . $tids . ' ');
                                    ?>
                                    <input type="hidden" name="bparams[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->tid;?>">
                                          <div class="col-xs-12 col-md-5 col-lg-5">
                                            <h4 style="font-size:15px!important;font-weight: normal!important"><?= $bp->test_name; ?></h4>
                                            <input type="hidden" name="sblood[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->id; ?>">
                                            <input type="hidden" name="userbloodparams[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->id; ?>">
                                          </div>
                                          <div class="col-xs-12 col-md-3 col-lg-3">
                                            <div class="form-group">
                                              <input type="number" name="nvalue[<?= $value->tid; ?>][<?= $bp->id; ?>]" class="form-control" placeholder="Enter Value" min="0" value="<?= $bp->nvalue; ?>">
                                            </div>
                                          </div>
                                          <div class="col-xs-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                              <input type="text" name="title[<?= $value->tid; ?>][<?= $bp->id; ?>]" class="form-control" placeholder="Enter Unit" value="<?= $bp->title; ?>">
                                            </div>
                                          </div>

                                    <?php
                                        }
                                      }
                                    }


                                    ?>
                                  </div>
                              <?php
                                }
                              }
                              ?>



                              <div class="col-md-12">

                                <div class="form-actions no-margin-bottom" style="text-align:center;">

                                  <a href="<?php echo base_url() . 'master/doctorpanel'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info"><i class="mdi mdi-check "></i>Submit</button>
                                </div>
                              </div>
                            </div>
                          </form>


                </div>
                <div role="tabpanel" class="tab-pane " id="sixth">

<form id="bloodParams5" class="form-horizontal" method="post">
                            <input type="hidden" name="bid" value="<?= miracleDcrypt($this->uri->segment(3)) ?>">
                            <input type="hidden" name="visit_id" value="<?php if (count($visit6) > 0) {
                                                                          echo $visit6[0]->id;
                                                                        } ?>">
                            <input type="hidden" name="did" value="<?php if (count($doctors) > 0) {
                                                                      echo $doctors[0]->disease_id;
                                                                    } ?>">
                            <input type="hidden" name="uid" value="<?php if (count($doctors) > 0) {
                                                                      echo $doctors[0]->user_id;
                                                                    } ?>">
                            <input type="hidden" name="visits" value="6">
                            <div class="row">

                            <div class="col-md-6">
                              <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="control-label">Date<font style="color: red;">*</font></label>
                                  <input type="date" name="date" class="form-control" id="date" value="<?php if (is_array($visit6) && !empty($visit6)) {
                                                                                                          echo $visit6[0]->vdate;
                                                                                                        } ?>">
                                  <span id="date5_error" class="text-danger"></span>

                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Problem Initiated </label>
                                  <textarea cols="4" rows="4" class="form-control" name="problem" id="problem"><?php if (is_array($visit6) && !empty($visit6)) {
                                                                                                                  echo $visit6[0]->problems;
                                                                                                                } ?></textarea>
                                </div>


                              </div>
                            </div>
                              </div>

                              <div class="col-md-6 form-grop">
                                <label class="control-label">Symptoms<font style="color: red;">*</font></label>
                                <br />
                                <div class="form-group">


                                  <?php
                                  if (count($symptoms) > 0) {
                                    foreach ($symptoms as $key => $value) {
                                  ?>
<input type="hidden" name="symids[]" id="symids5<?= $value->id;?>">
                                      <span>
                                        <label> <input type="checkbox" name="symptoms[]" value="<?= $value->id; ?>" class="symptoms5" <?php
                                                                                                                                    if (count($psymptoms6) > 0 && is_array($psymptoms6)) {
                                                                                                                                      foreach ($psymptoms6 as $key => $sy) {
                                                                                                                                        if ($value->id == $sy->sid) {
                                                                                                                                          echo "checked";
                                                                                                                                        }
                                                                                                                                      }
                                                                                                                                    }

                                                                                                                                    ?>> <?= $value->title; ?></label>
                                      </span>

                                  <?php
                                    }
                                  }
                                  ?>



                                </div>
                                <span id="symptoms5_error" class="text-danger"></span>
                              </div>



                              <div class="clearfix"></div>



                              <div class="col-md-12">
                                <div style="margin-bottom: 20px">
                                  <h4>Blood Parameters</h4>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <?php
                              if (count($tests) > 0) {
                                foreach ($tests as $key => $value) {
                                  $tid = $value->tid;
                                  $vids ="";
                                 if (count($visit6) > 0) {
                                    $vids .= " and vid=".$visit6[0]->id;
                                 } 
                              ?>
                              <input type="hidden" name="testids[]" id="testids5<?=$value->tid; ?>">
                                  <div class="col-xs-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                      <input type="checkbox" name="tests[]" class="tests5" value="<?= $value->tid; ?>" <?php
                                                                                                                      if (count($userblood6) > 0) {
                                                                                                                        foreach ($userblood6 as $key => $ub) {

                                                                                                                          if ($value->tid == $ub->tid) {
                                                                                                                            echo "checked";
                                                                                                                          }
                                                                                                                        }
                                                                                                                      }

                                                                                                                      ?>>
                                      <?php
                                      if (count($userblood6) > 0) {
                                        foreach ($userblood6 as $key => $ub) {
                                      ?>
                                          <input type="hidden" name="userbloodcount[]" value="">
                                      <?php
                                        }
                                      }
                                      ?>
                                      <span style="font-size:17px!important;font-weight: bold;"><?= $value->title; ?></span>
                                    </div>

                                  </div>
                                  <div class="col-xs-12 col-md-8 col-sm-8 col-lg-8">
                                    <div style="display: none">New</div>
                                  </div>
                                  <div class="clearfix"></div>
                                  <div class="row" id="appenrows5<?= $value->tid; ?>" style="width: 100%;margin: 10px 5px;">
                                    <?php
                                    if (!empty($visit6) && is_array($visit6)) {

                                      $params = $this->master_db->sqlExecute('select uc.tid,ub.id,ub.title,ub.nvalue,ub.tid,bp.title as test_name from user_blood_parameters ub left join user_blood_parameters_count uc on uc.id= ub.pid left join blood_parameters_details bp on bp.id=ub.tid where uc.vid =' . $visit6[0]->id . '  and uc.tid=' . $tid . ' ');
                                      if (count($params) > 0 && is_array($params)) {

                                        foreach ($params as $new => $bp) {
                                          $tids =$bp->tid;
                                          // $paramsnew = $this->master_db->sqlExecute('select uc.tid,bp.title as test_name from user_blood_parameters_count uc left join blood_parameters_details bp on bp.id=ub.tid where uc.tid ! =' . $tids . ' ');
                                    ?>
                                    <input type="hidden" name="bparams[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->tid;?>">
                                          <div class="col-xs-12 col-md-5 col-lg-5">
                                            <h4 style="font-size:15px!important;font-weight: normal!important"><?= $bp->test_name; ?></h4>
                                            <input type="hidden" name="sblood[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->id; ?>">
                                            <input type="hidden" name="userbloodparams[<?= $value->tid; ?>][<?= $bp->id; ?>]" value="<?= $bp->id; ?>">
                                          </div>
                                          <div class="col-xs-12 col-md-3 col-lg-3">
                                            <div class="form-group">
                                              <input type="number" name="nvalue[<?= $value->tid; ?>][<?= $bp->id; ?>]" class="form-control" placeholder="Enter Value" min="0" value="<?= $bp->nvalue; ?>">
                                            </div>
                                          </div>
                                          <div class="col-xs-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                              <input type="text" name="title[<?= $value->tid; ?>][<?= $bp->id; ?>]" class="form-control" placeholder="Enter Unit" value="<?= $bp->title; ?>">
                                            </div>
                                          </div>

                                    <?php
                                        }
                                      }
                                    }


                                    ?>
                                  </div>
                              <?php
                                }
                              }
                              ?>



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


        <!--END PAGE CONTENT -->


      </div>

      <!--END MAIN WRAPPER -->

      <!-- FOOTER -->
      <div id="footer">
        <p>&copy; Miracle Drinks </p>
      </div>
      <!--END FOOTER -->
      <!-- GLOBAL SCRIPTS -->
      <script src="<?= base_url(); ?>assets/main/js/jquery.js"></script>
      <!-- include jQuery -->
      <script src="<?= base_url(); ?>assets/main/js/plugins.js"></script>
      <!-- include jQuery -->
      <script src="<?= base_url(); ?>assets/main/js/jquery.main.js"></script>
      <!-- include jQuery -->
      <script type="text/javascript" src="<?= base_url(); ?>assets/main/js/init.js"></script>
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

      <?php $v_id = "";
      if (count($visit1) > 0) {
        $v_id .= $visit1[0]->id;
      }
      $url ="";

      ?>
      <script>
        $(document).ready(function() {
          // Click 1
          $(document).on("click", ".tests", function(e) {
            var tid = $(this).val();
            var newcheck = [];
            $("input:checkbox:checked").each(function() {
              newcheck.push($(this).val());
            });
            if (this.checked) {
              $.ajax({
                url: "<?= base_url() . 'master/getTests'; ?>",
                method: "post",
                data: {
                  tid: tid,
                  newcheck: newcheck,
                },
                dataType: "json",
                success: function(res) {
                  if (res.status == true) {
                    $("#appenrows" + tid).html(res.data);
                    $("#appenrows" + tid).show();
                  }
                }
              });
            } else {
              $("#testids"+tid).val(tid);
              $.ajax({
                url: "<?= base_url() . 'master/getTests'; ?>",
                method: "post",
                data: {
                  tid: tid,
                  newcheck: newcheck,
                },
                dataType: "json",
                success: function(res) {
                  if (res.status == true) {
                    $("#appenrows" + tid).hide();
                  }
                }
              });
            }
          });

           // Click 2
          $(document).on("click", ".tests1", function(e) {
            var tid = $(this).val();
            var newcheck = [];
            $("input:checkbox:checked").each(function() {
              newcheck.push($(this).val());
            });
            if (this.checked) {
              $.ajax({
                url: "<?= base_url() . 'master/getTests'; ?>",
                method: "post",
                data: {
                  tid: tid,
                  newcheck: newcheck,
                },
                dataType: "json",
                success: function(res) {
                  if (res.status == true) {
                    $("#appenrows1" + tid).html(res.data);
                    $("#appenrows1" + tid).show();
                  }
                }
              });
            } else {
              $("#testids1"+tid).val(tid);
              $.ajax({
                url: "<?= base_url() . 'master/getTests'; ?>",
                method: "post",
                data: {
                  tid: tid,
                  newcheck: newcheck,
                },
                dataType: "json",
                success: function(res) {
                  if (res.status == true) {
                    $("#appenrows1" + tid).hide();
                  }
                }
              });
            }
          });

            // Click 3
          $(document).on("click", ".tests2", function(e) {
            var tid = $(this).val();
            var newcheck = [];
            $("input:checkbox:checked").each(function() {
              newcheck.push($(this).val());
            });
            if (this.checked) {
              $.ajax({
                url: "<?= base_url() . 'master/getTests'; ?>",
                method: "post",
                data: {
                  tid: tid,
                  newcheck: newcheck,
                },
                dataType: "json",
                success: function(res) {
                  if (res.status == true) {
                    $("#appenrows2" + tid).html(res.data);
                    $("#appenrows2" + tid).show();
                  }
                }
              });
            } else {
              $("#testids2"+tid).val(tid);
              $.ajax({
                url: "<?= base_url() . 'master/getTests'; ?>",
                method: "post",
                data: {
                  tid: tid,
                  newcheck: newcheck,
                },
                dataType: "json",
                success: function(res) {
                  if (res.status == true) {
                    $("#appenrows2" + tid).hide();
                  }
                }
              });
            }
          });

            // Click 4
          $(document).on("click", ".tests3", function(e) {
            var tid = $(this).val();
            var newcheck = [];
            $("input:checkbox:checked").each(function() {
              newcheck.push($(this).val());
            });
            if (this.checked) {
              $.ajax({
                url: "<?= base_url() . 'master/getTests'; ?>",
                method: "post",
                data: {
                  tid: tid,
                  newcheck: newcheck,
                },
                dataType: "json",
                success: function(res) {
                  if (res.status == true) {
                    $("#appenrows3" + tid).html(res.data);
                    $("#appenrows3" + tid).show();
                  }
                }
              });
            } else {
              $("#testids3"+tid).val(tid);
              $.ajax({
                url: "<?= base_url() . 'master/getTests'; ?>",
                method: "post",
                data: {
                  tid: tid,
                  newcheck: newcheck,
                },
                dataType: "json",
                success: function(res) {
                  if (res.status == true) {
                    $("#appenrows3" + tid).hide();
                  }
                }
              });
            }
          });

            // Click 5
          $(document).on("click", ".tests4", function(e) {
            var tid = $(this).val();
            var newcheck = [];
            $("input:checkbox:checked").each(function() {
              newcheck.push($(this).val());
            });
            if (this.checked) {
              $.ajax({
                url: "<?= base_url() . 'master/getTests'; ?>",
                method: "post",
                data: {
                  tid: tid,
                  newcheck: newcheck,
                },
                dataType: "json",
                success: function(res) {
                  if (res.status == true) {
                    $("#appenrows4" + tid).html(res.data);
                    $("#appenrows4" + tid).show();
                  }
                }
              });
            } else {
              $("#testids4"+tid).val(tid);
              $.ajax({
                url: "<?= base_url() . 'master/getTests'; ?>",
                method: "post",
                data: {
                  tid: tid,
                  newcheck: newcheck,
                },
                dataType: "json",
                success: function(res) {
                  if (res.status == true) {
                    $("#appenrows4" + tid).hide();
                  }
                }
              });
            }
          });

            // Click 6
          $(document).on("click", ".tests5", function(e) {
            var tid = $(this).val();
            var newcheck = [];
            $("input:checkbox:checked").each(function() {
              newcheck.push($(this).val());
            });
            if (this.checked) {
              $.ajax({
                url: "<?= base_url() . 'master/getTests'; ?>",
                method: "post",
                data: {
                  tid: tid,
                  newcheck: newcheck,
                },
                dataType: "json",
                success: function(res) {
                  if (res.status == true) {
                    $("#appenrows5" + tid).html(res.data);
                    $("#appenrows5" + tid).show();
                  }
                }
              });
            } else {
              $("#testids5"+tid).val(tid);
              $.ajax({
                url: "<?= base_url() . 'master/getTests'; ?>",
                method: "post",
                data: {
                  tid: tid,
                  newcheck: newcheck,
                },
                dataType: "json",
                success: function(res) {
                  if (res.status == true) {
                    $("#appenrows5" + tid).hide();
                  }
                }
              });
            }
          });

          $(document).on("click", ".symptoms", function(e) {
            var tid = $(this).val();

            if (this.checked) {

            } else {
               $("#symids"+tid).val(tid);

            }
          });
           $(document).on("click", ".symptoms1", function(e) {
            var tid = $(this).val();

            if (this.checked) {

            } else {
               $("#symids1"+tid).val(tid);

            }
          });
            $(document).on("click", ".symptoms2", function(e) {
            var tid = $(this).val();

            if (this.checked) {

            } else {
               $("#symids2"+tid).val(tid);

            }
          });
             $(document).on("click", ".symptoms3", function(e) {
            var tid = $(this).val();

            if (this.checked) {

            } else {
               $("#symids3"+tid).val(tid);

            }
          });
              $(document).on("click", ".symptoms4", function(e) {
            var tid = $(this).val();

            if (this.checked) {

            } else {
               $("#symids4"+tid).val(tid);

            }
          });
               $(document).on("click", ".symptoms5", function(e) {
            var tid = $(this).val();

            if (this.checked) {

            } else {
               $("#symids5"+tid).val(tid);

            }
          });
          $("#bloodParams").on("submit", function(e) {
            e.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
              url: "<?= base_url(); ?>master/bloodparametersview_save",
              method: "post",
              dataType: "json",
              data: formdata,
              contentType: false,
              cache: false,
              processData: false,
              success: function(data) {
                if (data.formerror == false) {
                  $(".csrf_token").val(data.csrf_token);
                  if (data.title_error != '') {
                    $("#title_error").html(data.title_error);
                  } else {
                    $("#title_error").html('');
                  }
                  if (data.visits_error != '') {
                    $("#visits_error").html(data.visits_error);
                  } else {
                    $("#visits_error").html('');
                  }
                  if (data.value_error != '') {
                    $("#value_error").html(data.value_error);
                  } else {
                    $("#value_error").html('');
                  }
                  if (data.symptoms_error != '') {
                    $("#symptoms_error").html(data.symptoms_error);
                  } else {
                    $("#symptoms_error").html('');
                  }
                  if (data.date_error != '') {
                    $("#date_error").html(data.date_error);
                  } else {
                    $("#date_error").html('');
                  }
                  if (data.sblood_error !== '') {
                    $("#parameters_error").html(data.sblood_error);
                  } else {
                    $("#parameters_error").html('');
                  }
                  if (data.tests_error !== '') {
                    $("#tests_error").html(data.tests_error);
                  } else {
                    $("#tests_error").html('');
                  }

                } else if (data.status == false) {
                  $("#processing").html('<div class="alert alert-danger alert-dismissible"><i class="fas fa-ban"></i> ' + data.msg + '</div>').show().fadeOut(5000);
                } else if (data.status == true) {
                  $("#title_error").html('');
                  $("#date_error").html('');
                  $("#symptoms_error").html('');
                  $("#value_error").html('');
                  $("#visits_error").html('');
                  $("#tests_error").html('');
                  $("#parameters_error").html('');

                  $("#processing").html('<div class="alert alert-success alert-dismissible"><i class="fas fa-circle-check"></i> ' + data.msg + '</div>').fadeOut(5000);
                  setTimeout(function() {
                    window.location.href = "<?= base_url() . 'master/doctorpanel'; ?>";
                  }, 3000);
                }
              }
            });
          });

                    $("#bloodParams1").on("submit", function(e) {
            e.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
              url: "<?= base_url(); ?>master/bloodparametersview_save",
              method: "post",
              dataType: "json",
              data: formdata,
              contentType: false,
              cache: false,
              processData: false,
              success: function(data) {
                if (data.formerror == false) {
                  $(".csrf_token").val(data.csrf_token);
                  if (data.title_error != '') {
                    $("#title1_error").html(data.title_error);
                  } else {
                    $("#title1_error").html('');
                  }
                  if (data.visits_error != '') {
                    $("#visits1_error").html(data.visits_error);
                  } else {
                    $("#visits1_error").html('');
                  }
                  if (data.value_error != '') {
                    $("#value1_error").html(data.value_error);
                  } else {
                    $("#value1_error").html('');
                  }
                  if (data.symptoms_error != '') {
                    $("#symptoms1_error").html(data.symptoms_error);
                  } else {
                    $("#symptoms1_error").html('');
                  }
                  if (data.date_error != '') {
                    $("#date1_error").html(data.date_error);
                  } else {
                    $("#date1_error").html('');
                  }
                  if (data.sblood_error !== '') {
                    $("#parameters1_error").html(data.sblood_error);
                  } else {
                    $("#parameters1_error").html('');
                  }
                  if (data.tests_error !== '') {
                    $("#tests1_error").html(data.tests_error);
                  } else {
                    $("#tests1_error").html('');
                  }

                } else if (data.status == false) {
                  $("#processing").html('<div class="alert alert-danger alert-dismissible"><i class="fas fa-ban"></i> ' + data.msg + '</div>').show().fadeOut(5000);
                } else if (data.status == true) {
                  $("#title1_error").html('');
                  $("#date1_error").html('');
                  $("#symptoms1_error").html('');
                  $("#value1_error").html('');
                  $("#visits1_error").html('');
                  $("#tests1_error").html('');
                  $("#parameters1_error").html('');

                  $("#processing").html('<div class="alert alert-success alert-dismissible"><i class="fas fa-circle-check"></i> ' + data.msg + '</div>').fadeOut(5000);
                  setTimeout(function() {
                    window.location.href = "<?= base_url() . 'master/doctorpanel'; ?>";
                  }, 3000);
                }
              }
            });
          });

                      $("#bloodParams2").on("submit", function(e) {
            e.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
              url: "<?= base_url(); ?>master/bloodparametersview_save",
              method: "post",
              dataType: "json",
              data: formdata,
              contentType: false,
              cache: false,
              processData: false,
              success: function(data) {
                if (data.formerror == false) {
                  $(".csrf_token").val(data.csrf_token);
                  if (data.title_error != '') {
                    $("#title2_error").html(data.title_error);
                  } else {
                    $("#title2_error").html('');
                  }
                  if (data.visits_error != '') {
                    $("#visits2_error").html(data.visits_error);
                  } else {
                    $("#visits2_error").html('');
                  }
                  if (data.value_error != '') {
                    $("#value2_error").html(data.value_error);
                  } else {
                    $("#value2_error").html('');
                  }
                  if (data.symptoms_error != '') {
                    $("#symptoms2_error").html(data.symptoms_error);
                  } else {
                    $("#symptoms2_error").html('');
                  }
                  if (data.date_error != '') {
                    $("#date2_error").html(data.date_error);
                  } else {
                    $("#date2_error").html('');
                  }
                  if (data.sblood_error !== '') {
                    $("#parameters2_error").html(data.sblood_error);
                  } else {
                    $("#parameters2_error").html('');
                  }
                  if (data.tests_error !== '') {
                    $("#tests2_error").html(data.tests_error);
                  } else {
                    $("#tests2_error").html('');
                  }

                } else if (data.status == false) {
                  $("#processing").html('<div class="alert alert-danger alert-dismissible"><i class="fas fa-ban"></i> ' + data.msg + '</div>').show().fadeOut(5000);
                } else if (data.status == true) {
                  $("#title2_error").html('');
                  $("#date2_error").html('');
                  $("#symptoms2_error").html('');
                  $("#value2_error").html('');
                  $("#visits2_error").html('');
                  $("#tests2_error").html('');
                  $("#parameters2_error").html('');

                  $("#processing").html('<div class="alert alert-success alert-dismissible"><i class="fas fa-circle-check"></i> ' + data.msg + '</div>').fadeOut(5000);
                  setTimeout(function() {
                    window.location.href = "<?= base_url() . 'master/doctorpanel'; ?>";
                  }, 3000);
                }
              }
            });
          });

                        $("#bloodParams3").on("submit", function(e) {
            e.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
              url: "<?= base_url(); ?>master/bloodparametersview_save",
              method: "post",
              dataType: "json",
              data: formdata,
              contentType: false,
              cache: false,
              processData: false,
              success: function(data) {
                if (data.formerror == false) {
                  $(".csrf_token").val(data.csrf_token);
                  if (data.title_error != '') {
                    $("#title3_error").html(data.title_error);
                  } else {
                    $("#title3_error").html('');
                  }
                  if (data.visits_error != '') {
                    $("#visits3_error").html(data.visits_error);
                  } else {
                    $("#visits3_error").html('');
                  }
                  if (data.value_error != '') {
                    $("#value3_error").html(data.value_error);
                  } else {
                    $("#value3_error").html('');
                  }
                  if (data.symptoms_error != '') {
                    $("#symptoms3_error").html(data.symptoms_error);
                  } else {
                    $("#symptoms3_error").html('');
                  }
                  if (data.date_error != '') {
                    $("#date3_error").html(data.date_error);
                  } else {
                    $("#date3_error").html('');
                  }
                  if (data.sblood_error !== '') {
                    $("#parameters3_error").html(data.sblood_error);
                  } else {
                    $("#parameters3_error").html('');
                  }
                  if (data.tests_error !== '') {
                    $("#tests3_error").html(data.tests_error);
                  } else {
                    $("#tests3_error").html('');
                  }

                } else if (data.status == false) {
                  $("#processing").html('<div class="alert alert-danger alert-dismissible"><i class="fas fa-ban"></i> ' + data.msg + '</div>').show().fadeOut(5000);
                } else if (data.status == true) {
                  $("#title3_error").html('');
                  $("#date3_error").html('');
                  $("#symptoms3_error").html('');
                  $("#value3_error").html('');
                  $("#visits3_error").html('');
                  $("#tests3_error").html('');
                  $("#parameters3_error").html('');

                  $("#processing").html('<div class="alert alert-success alert-dismissible"><i class="fas fa-circle-check"></i> ' + data.msg + '</div>').fadeOut(5000);
                  setTimeout(function() {
                    window.location.href = "<?= base_url() . 'master/doctorpanel'; ?>";
                  }, 3000);
                }
              }
            });
          });

                          $("#bloodParams4").on("submit", function(e) {
            e.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
              url: "<?= base_url(); ?>master/bloodparametersview_save",
              method: "post",
              dataType: "json",
              data: formdata,
              contentType: false,
              cache: false,
              processData: false,
              success: function(data) {
                if (data.formerror == false) {
                  $(".csrf_token").val(data.csrf_token);
                  if (data.title_error != '') {
                    $("#title4_error").html(data.title_error);
                  } else {
                    $("#title4_error").html('');
                  }
                  if (data.visits_error != '') {
                    $("#visits4_error").html(data.visits_error);
                  } else {
                    $("#visits4_error").html('');
                  }
                  if (data.value_error != '') {
                    $("#value4_error").html(data.value_error);
                  } else {
                    $("#value4_error").html('');
                  }
                  if (data.symptoms_error != '') {
                    $("#symptoms4_error").html(data.symptoms_error);
                  } else {
                    $("#symptoms4_error").html('');
                  }
                  if (data.date_error != '') {
                    $("#date4_error").html(data.date_error);
                  } else {
                    $("#date4_error").html('');
                  }
                  if (data.sblood_error !== '') {
                    $("#parameters4_error").html(data.sblood_error);
                  } else {
                    $("#parameters4_error").html('');
                  }
                  if (data.tests_error !== '') {
                    $("#tests4_error").html(data.tests_error);
                  } else {
                    $("#tests4_error").html('');
                  }

                } else if (data.status == false) {
                  $("#processing").html('<div class="alert alert-danger alert-dismissible"><i class="fas fa-ban"></i> ' + data.msg + '</div>').show().fadeOut(5000);
                } else if (data.status == true) {
                  $("#title4_error").html('');
                  $("#date4_error").html('');
                  $("#symptoms4_error").html('');
                  $("#value4_error").html('');
                  $("#visits4_error").html('');
                  $("#tests4_error").html('');
                  $("#parameters4_error").html('');

                  $("#processing").html('<div class="alert alert-success alert-dismissible"><i class="fas fa-circle-check"></i> ' + data.msg + '</div>').fadeOut(5000);
                  setTimeout(function() {
                    window.location.href = "<?= base_url() . 'master/doctorpanel'; ?>";
                  }, 3000);
                }
              }
            });
          });


                           $("#bloodParams5").on("submit", function(e) {
            e.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
              url: "<?= base_url(); ?>master/bloodparametersview_save",
              method: "post",
              dataType: "json",
              data: formdata,
              contentType: false,
              cache: false,
              processData: false,
              success: function(data) {
                if (data.formerror == false) {
                  $(".csrf_token").val(data.csrf_token);
                  if (data.title_error != '') {
                    $("#title5_error").html(data.title_error);
                  } else {
                    $("#title5_error").html('');
                  }
                  if (data.visits_error != '') {
                    $("#visits5_error").html(data.visits_error);
                  } else {
                    $("#visits5_error").html('');
                  }
                  if (data.value_error != '') {
                    $("#value5_error").html(data.value_error);
                  } else {
                    $("#value5_error").html('');
                  }
                  if (data.symptoms_error != '') {
                    $("#symptoms5_error").html(data.symptoms_error);
                  } else {
                    $("#symptoms5_error").html('');
                  }
                  if (data.date_error != '') {
                    $("#date5_error").html(data.date_error);
                  } else {
                    $("#date5_error").html('');
                  }
                  if (data.sblood_error !== '') {
                    $("#parameters5_error").html(data.sblood_error);
                  } else {
                    $("#parameters5_error").html('');
                  }
                  if (data.tests_error !== '') {
                    $("#tests5_error").html(data.tests_error);
                  } else {
                    $("#tests5_error").html('');
                  }

                } else if (data.status == false) {
                  $("#processing").html('<div class="alert alert-danger alert-dismissible"><i class="fas fa-ban"></i> ' + data.msg + '</div>').show().fadeOut(5000);
                } else if (data.status == true) {
                  $("#title5_error").html('');
                  $("#date5_error").html('');
                  $("#symptoms5_error").html('');
                  $("#value5_error").html('');
                  $("#visits5_error").html('');
                  $("#tests5_error").html('');
                  $("#parameters5_error").html('');

                  $("#processing").html('<div class="alert alert-success alert-dismissible"><i class="fas fa-circle-check"></i> ' + data.msg + '</div>').fadeOut(5000);
                  setTimeout(function() {
                    window.location.href = "<?= base_url() . 'master/doctorpanel'; ?>";
                  }, 3000);
                }
              }
            });
          });



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
      </script>

</body>
<!-- END BODY-->

</html>