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
                 <li class="active">My Profile</li>
                 
                 
            </ol>
                        <h2 class="page-header">My Profile</h2>

						<div class="col-lg-12">
						<?php echo $this->session->flashdata('message');?>
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-th-large"></i></div>
                                    <h5>Edit Profile</h5>
                                    <div class="toolbar">
                                        <ul class="nav">
                                            <li>
                                                <div class="btn-group">
                                                    
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </header>
                                
                                
                                <div id="collapseOne" class="accordion-body collapse in body">
                                    <form action="<?php echo base_url().'atpadmin/myprofile_edit_save';?>" class="form-horizontal" id="brand-validate" method="post" enctype="multipart/form-data">
											
											
										<div class="form-group">
                                            <label class="control-label col-lg-4">Name <font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                                <input type="text" id="name" name="name" class="form-control" value="<?php echo $details[0]->name;?>" title="Enter Name" />
                                            </div>
                                        </div>
                                       
                                        
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Email ID <font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                                <input type="email" id="email" name="email" class="form-control" maxlength="100" value="<?php echo $details[0]->email;?>"/>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Contact No. <font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                                <input type="text" id="contact" name="contact" class="form-control onlynumbers" value="<?php echo $details[0]->contact;?>"/>
                                            </div>
                                        </div>
                                        
                                         
                                         <div class="form-group">
                                            <label class="control-label col-lg-4">Existing Image </label>
                                            <div class="col-lg-4">
                                            <?php 
                                            if(empty($details[0]->profile_img))
                                            {
                                            ?>
                                            <img alt="" src="<?php echo asset_url();?>profile_images/profileimg.jpg" style="height: 120px;width: 120px;">
                                            <?php	
                                            }
                                            else 
                                            {
                                            ?>
                                            <img alt="" src="<?php echo base_url()."".$details[0]->profile_img?>" style="height: 150px;width: 150px;">	                                            
                                            <?php	
                                            }
                                            ?>
                                        </div>
                                        </div>
            
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Want to change Image?</label>
                                            <div class="col-lg-4">
                                                <div class="checkbox">
                                                    <label>
                                                        <input class="uniform" type="radio" name="optionsRadios" value="0" checked="checked" onClick="$('#imgh').fadeOut();document.getElementById('imag').required = '';" />
                                                        No
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input class="uniform" type="radio" name="optionsRadios" value="1" onClick="$('#imgh').fadeIn();document.getElementById('imag').setAttribute('required','required');" />
                                                        Yes
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" id="imgh" style="display:none;">
                                            <label class="control-label col-lg-4">Image Upload</label>
                                            <div class="col-lg-8">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                                                    <div>
                                                        <span class="btn btn-file btn-info"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="imag" id="imag" title="Select image to upload"/></span>
                                                        <a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-actions no-margin-bottom" style="text-align:center;">
                                         <a href="<?php echo base_url();?>" class="btn btn-primary btn-sm"><i class="icon-reply "></i> Back</a>   &nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info btn-sm "><i class="icon-save"></i> Save Changes</button>
                                        </div>

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
    
    
     <script src="<?php echo asset_url();?>plugins/validationengine/js/jquery.validationEngine.js"></script>
    <script src="<?php echo asset_url();?>plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
    <script src="<?php echo asset_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    <script src="<?php echo asset_url();?>js/additional-methods.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/jasny/js/bootstrap-fileupload.js"></script>
	<script>
	$(document).ready(function(){
	 	 $(".onlynumbers").keypress(function(evt) {
	 					var charCode = (evt.which) ? evt.which : event.keyCode
	 						 if(charCode==8)//back space
	 							return true;
	 						 if (charCode < 48 || charCode > 57)	//0-9
	 						 {
	 							return false;
	 						 }
	 						 return true;
	 					});	
	 	  });
	  
    $(function () { 
    	var base_url = '<?php echo base_url();?>';  
                              
       $('#brand-validate').validate({
        rules: {
            name: 
            {
		        required: true
		    },
		    contact: 
            {
		        required: true,
		        minlength: 10,
		        number:true
		    },
		    email: 
            {
		    	required: true,
		        email:true  
		    },
		   
		    imag:
		    {
		    	extension: "png|jpg|gif|GIF|PNG|JPG"
		    }
        },
        messages:{
        	
            	
        	contact:
            {
                minlength: "Enter Atleast 10 digit Number"
            },
           	email: 
            {
 		        email:"Enter Proper Email ID"
 		    },
		   imag: 
	       {
			   extension:"Upload valid image"
			}
        },
       
        errorClass: 'help-block',
        errorElement: 'span',
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
        }
    	}); 

       });
        </script>

</body>
    <!-- END BODY-->
    
</html>
