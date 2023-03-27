<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo maintitle ?></title>
    <link href="<?php echo asset_url(); ?>css/artiiplants.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/artiiplantss.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/all.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/font-awesome.min1.css" rel="stylesheet">



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
    <?php echo $common; ?>
</head>

<body class="loginpage">


    <?php
    require_once 'Google/src/apiClient.php';
    require_once 'Google/src/contrib/apiPlusService.php';
    $client = new apiClient();
    $client->setApplicationName("Artiiplants");

    //*********** Replace with Your API Credentials **************
    $client->setClientId('827094241954-clrcq6dtma816jeonh978638nbldbbav.apps.googleusercontent.com');
    $client->setClientSecret('8P6sc7qXnjQLLiRDB6BHY1pD');
    $client->setRedirectUri(base_url() . 'home/google_login');
    $client->setApprovalPrompt("auto");
    $client->setDeveloperKey('composed-field-664');
    //************************************************************

    $client->setScopes(array('https://www.googleapis.com/auth/plus.profile.emails.read', ' https://www.googleapis.com/auth/plus.login'));
    $client->setAccesstype('online');
    $authUrl = $client->createAuthUrl();

    ?>

    <?php echo $header; ?>

    <div class="breadbg">
        <div class="container">
            <div class="row">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
                    <li><a href="#">Register</a></li>
                </ul>
            </div>
        </div>
    </div>




    <!-- <PAGE CONTENT> ================================= -->











    <div id="account-register" class="container acpage">
        <div class="row">
            <div id="content" class="col-sm-8 col-md-9 col-xs-12 colright">
                <div class="infobg">
                    <h1>NEW MEMBER SIGN UP</h1>
                    <p>If you already have an account with us, please <a href="<?php echo base_url()?>login" >Sign In</a>.</p> 
					

                    <form class="form form-horizontal" onsubmit="return false;">
                        <fieldset id="account">
                            <legend>Your Personal Details</legend>
                            <div id="rmsgbox"></div>
                       <div class="form-group required">
                                <label class="col-sm-3 col-xs-12 control-label">First Name</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" name="rname" id="rname" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'>
                                </div>
                            </div>
							 <div class="form-group required">
                                <label class="col-sm-3 col-xs-12 control-label">Second Name</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" name="sname" id="sname" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-3 col-xs-12 control-label">Email - Id</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" name="remail" id="remail" class="form-control">
                                </div>
                            </div>
							<div class="form-group required">
                                <label class="col-sm-3 col-xs-12 control-label">Phone Number</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" name="phone" id="phone" class="form-control onlynumbers" maxlength="10">
                                </div>
                            </div>
							  <fieldset>
                            <!--<legend>Your Password</legend>-->
                            <div class="form-group required">
                                <label class="col-sm-3 col-xs-12 control-label" for="input-password">Password</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="password" name="rpassword" id="rpassword" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-3 col-xs-12 control-label" for="input-confirm">Password
                                    Confirm</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="password" name="rconfpassword" id="rconfpassword" class="form-control">
                                </div>
                            </div>
							
                            <div class="buttons">
                                <div class="text-right acspace">
                                    <input type="submit" onclick="register();" value="Register" class="btn btn-primary">
                                   <!--<a href="<?php echo base_url() ?>home/facebook_login"><img src="<?php echo asset_url(); ?>images/facebook.png" width="35"></a>
                                    <a href="<?php echo $authUrl ?>"><img src="<?php echo asset_url(); ?>images/g.png"  width="35"></a>-->
                                </div>
                            </div>


                        </fieldset>

                           


                    </form>
                </div>
            </div>
            <aside id="column-right" class="col-sm-4 col-md-3 col-xs-12 hidden-xs">
                <div class="list-group accolumn">


                    <h3><svg class="" width="20px" height="20px">
                            <use xlink:href="#acluser"></use>
                        </svg>ACCOUNT SETTINGS</h3>
                    <a href="<?php echo base_url()?>login" class="list-group-item">Sign In</a>
                    <a href="<?php echo base_url()?>wholesaler" class="list-group-item">Premium Registeration</a>
                   <!-- <a href="<?php echo base_url()?>register" class="list-group-item">Register Premium</a>-->
                    <a href="<?php echo base_url()?>forgot" class="list-group-item">Forgot Password?</a>

                </div>
            </aside>
        </div>
    </div>


    <?php echo $footer; ?>


</body>
<script src="<?php echo asset_url() ?>js/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>js/jquery.elevatezoom.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>js/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>js/slick.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>js/animate.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>js/lightbox-2.6.min.js" type="text/javascript"></script>

<script src="<?php echo asset_url() ?>js/jquery-1.7.1.js" type="text/javascript"></script>
<?php echo $jsFile; ?>

</body>

</html>