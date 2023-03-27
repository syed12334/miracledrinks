<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD-->
<head>
   
     <meta charset="UTF-8" />
    <title><?php echo title;?></title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/style.min.css" />
    <link rel="stylesheet" href="<?php echo asset_url();?>plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo asset_url();?>css/main.css" />
    <link rel="stylesheet" href="<?php echo asset_url();?>css/theme.css" />
    <link rel="stylesheet" href="<?php echo asset_url();?>css/MoneAdmin.css" />
    <link rel="stylesheet" href="<?php echo asset_url();?>plugins/Font-Awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-fileupload.min.css" />
    <script type="text/javascript" src="<?php echo asset_url();?>js/jquery.min.js"></script> 
<?php echo $updatelogin;?>
</head>
    <!-- END  HEAD-->
    <!-- BEGIN BODY-->
<body class="padTop53 " >

     <!-- MAIN WRAPPER -->
    <div id="wrap">


         <!-- HEADER SECTION -->
       <?php echo $header;?>
        <!-- END HEADER SECTION -->



        <!-- MENU SECTION -->
       <?php echo $left;?>
        <!--END MENU SECTION -->


        <!--PAGE CONTENT -->
        <div id="content">
        <div class="inner" style="min-height:1200px;">
                <div class="row">
                    <div class="col-lg-12">
        <ol class="breadcrumb">
                 <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                 <li class="active">Change Password</li>
                 
                 
            </ol>
                        <h2 class="page-header">Change Password</h2>

						<div class="col-lg-12">
						<?php echo $this->session->flashdata('message');?>
                            <div class="box">
                                                               
                                
                                <div id="collapseOne" class="accordion-body collapse in body">
                                    <form action="<?php echo base_url().'atpadmin/edit_changepass';?>" class="form-horizontal" id="formname" method="post" enctype="multipart/form-data">
											
											
										<div class="form-group">
                                            <label class="control-label col-lg-4">Email ID/Username <font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                                <span><?php echo $details[0]->email;?></span>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Old Password <font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                                <input type="password" class="form-control" name="old_pass" id="old_pass" >
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">New Password <font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                                <input type="password" class="form-control" name="new_pass" id="new_pass" >
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Confirm Password <font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                                <input type="password" class="form-control" name="confirm_pass" id="confirm_pass" >
                                            </div>
                                        </div>
                                        
                                        <div class="form-actions no-margin-bottom" style="text-align:center;">
                                         <a href="<?php echo base_url();?>" class="btn btn-primary btn-sm"><i class="icon-reply "></i> Back</a>   &nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info btn-sm "><i class="icon-save"></i> Save Changes</button>
                                        </div><br><br>
										<div id="msgbox1"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
  </div>
                </div>

                <hr />




            </div>
        </div>
       <!--END PAGE CONTENT -->


    </div>

     <!--END MAIN WRAPPER -->

   <!-- FOOTER -->
    <div id="footer">
        <p>&copy;  <?php echo fottertitle;?></p>
    </div>
    <!--END FOOTER -->
     <!-- GLOBAL SCRIPTS -->
     <script src="<?php echo asset_url();?>plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->
	<script>
		    
    	$(function() {
			$( "#formname" ).submit(function( event ) {
	        	var old_pass = $("#old_pass").val();
				var new_pass = $("#new_pass").val();
				var confirm_pass = $("#confirm_pass").val();
								 
				$("#msgbox1").html('<div class="alert alert-warning alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Please wait...</div>');
				if($.trim(old_pass) == ""){
					$("#msgbox1").html('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Enter Old Password.</div>');
					return false;
				}
				else if(parseInt(isvaliddatapass(old_pass)) == 0){
					$("#msgbox1").html('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Invalid Old Password.</div>');
					return false;
				}
				else if($.trim(new_pass) == ""){
					$("#msgbox1").html('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Enter New Password.</div>');
					return false;
				}
				else if(new_pass.length < 6){
					$("#msgbox1").html('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>New Password must contain atleast 6 characters.</div>');
					return false;
				}
				else if($.trim(confirm_pass) == ""){
					$("#msgbox1").html('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Enter Confirm Password.</div>');
					return false;
				}
				else if(new_pass != confirm_pass){
					$("#msgbox1").html('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>New Password and Confirm Password does not match.</div>');
					return false;
				}
				else{
					return true;
				}
	        });	

       });

    function isvaliddatapass(oldpass)
	{

		var strURL="<?php echo base_url();?>atpadmin/check_password?oldpass="+oldpass;
		if (window.XMLHttpRequest)
	  	{// code for IE7+, Firefox, Chrome, Opera, Safari
	 		 req=new XMLHttpRequest();
	 	}
		else
	  	{// code for IE6, IE5
	  		req=new ActiveXObject("Microsoft.XMLHTTP");
	 	}
		
	  req.open("GET", strURL, false); //third parameter is set to false here
	  req.send(null);
	 
	   

	return req.responseText;
	 
	}
        </script>

</body>
    <!-- END BODY-->
    
</html>
