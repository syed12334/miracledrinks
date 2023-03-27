<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->



<!-- BEGIN HEAD -->

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

    <!-- PAGE LEVEL STYLES -->
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/style.min.css" />
    <!-- <link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/bootstrap/css/bootstrap.css" />

     <link rel="stylesheet" href="<?php echo asset_url(); ?>css/main.css" />

    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/login.css" />

    <link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/magic/magic.css" /> -->

<style>

body {
    overflow-x: hidden;
    margin: 0;
    color: #36628b;
    background: #f8f1d4;
}
h2{
  font-size:21px;
}
.bg-info {
    background-color: #36628b!important;
}
</style>

    <!-- END PAGE LEVEL STYLES -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

    <![endif]-->

</head>

<!-- END HEAD -->



<!-- BEGIN BODY -->





<body>





    <div class="row auth-wrapper gx-0">
        <div class="col-lg-4 col-xl-3 bg-info auth-box-2 on-sidebar">
          <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="row justify-content-center text-center">
              <div class="col-md-7 col-lg-12 col-xl-9">
                <div>
                  <span class="db logo "><img src="<?php echo front_url(); ?>assets/images/logo.jpg" alt="logo"></span> 
                </div>
                <h2 class="text-white mt-4 fw-light">
                Admin Access only 
                </h2>
                <p class="op-5 text-white fs-4 mt-4">
                Don't share login credentials with anyone
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="
            col-lg-8 col-xl-9
            d-flex
            align-items-center
            justify-content-center
          ">
          <div class="row justify-content-center w-100 mt-4 mt-lg-0">
            <div class="col-lg-6 col-xl-3 col-md-7">
               
              <div class="card" id="loginform">
                <div class="card-body">
                 
                  <h4 class="row"> 
                     <div class="col-md-12 text-center"> <img src="<?php echo front_url(); ?>assets/images/logo.jpg" alt="logo" width="106px" ></div> 
                     <div class="col-md-12 text-center pt-4">Welcome to Admin</div></h4>
                  

                  <form class="form-horizontal mt-3 form-material" id="loginform" method="post" action="<?php echo base_url(); ?>">
                        <?php echo $this->session->flashdata('message'); ?>
                            <div class="form-group mb-3">
                                <div class="col-xs-12">
                                <input type="text" placeholder="Username" class="form-control" name="username" required="required" />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="col-xs-12">
                                <input type="password" placeholder="Password" class="form-control" name="password" required="required" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex">

                                    <div class="ml-auto">
                                        <a type="submit" name="forgotpassword" id="forgotpassword" href="<?php echo base_url(); ?>atpforgot/forgot" class="text-muted"><i class="fa fa-lock mr-1"></i> Forgot pwd?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center mt-3">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" name="login">Log In</button>
                                </div>
                            </div>

                        </form>

                </div>
              </div>
               
            </div>
          </div>
        </div>
      </div>


    <!--END PAGE CONTENT -->



    <!-- PAGE LEVEL SCRIPTS -->



    <script src="<?php echo asset_url(); ?>plugins/jquery-2.0.3.min.js"></script>

    <script src="<?php echo asset_url(); ?>plugins/bootstrap/js/bootstrap.js"></script>

    <script src="<?php echo asset_url(); ?>js/login.js"></script>



    <!--END PAGE LEVEL SCRIPTS -->



</body>

<!-- END BODY -->

</html>