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
    
    
<style type="text/css">
    .mininwidth{
    width: 120px;
    }
     .mininwidth1{
    width: 80px;
    }
    </style>
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
                 <li class="active">Home Page</li>
                 <li class="active">Our Products</li>
            </ol>
                        <h2 class="page-header">Our Products</h2>
           <?php if($type=='edit'){ ?>
            

						<div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-th-large"></i></div>
                                    <h5>Edit Our Products</h5>
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
                                    <form action="<?php echo base_url().'homepage/ourproducts_edit';?>" class="form-horizontal" id="brand-validate" method="post" onsubmit="return validate();" enctype="multipart/form-data">
                                    <input type="hidden" id="aid" name="aid" class="form-control" required value="<?php echo $workdetail[0]->id;?>"/>
                                    
                                    <div class="alert alert-info alert-dismissable"><strong>Note:</strong> Please add image of size 244 x 124 px</div>
										<div class="form-group">
                                        <label class="control-label col-lg-4">Order no<font style="color: red;">*</font></label>
                                            <div class="col-lg-2">
                                            
                                                <input type="text" id="orderno" name="orderno" class="form-control onlynumbers"  required maxlength="3" value="<?php echo $workdetail[0]->order_no;?>"/>
                                            </div>
                                     </div>
										
										<div class="form-group">
                                            <label class="control-label col-lg-4">Title<font style="color: red;">*</font></label>
                                            <div class="col-lg-5">
                                                <input type="text" id="title" name="title" required class="form-control" value="<?php echo $workdetail[0]->title;?>"/>
                                            </div>
                                        </div> 
										
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Description<font style="color: red;">*</font></label>
                                            <div class="col-lg-5">
                                                <textarea rows="4" cols="50"  id="sub_title" name="sub_title" required class="form-control"> <?php echo $workdetail[0]->sub_title;?> </textarea>
                                            </div>
                                        </div> 
                                        
                                        

                                        <div class="form-group"  >
                                            <label class="control-label col-lg-4">Image</label>
                                            <div class="col-lg-8">
                                                <div class="fileupload fileupload-exists" data-provides="fileupload">													
                                                    <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo str_replace('/artii_manage','',base_url()).$workdetail[0]->image_path;?>"></div>
                                                    <div>

                                                        <span class="btn btn-file btn-info"><span class="fileupload-new selimage" uid="1">Select image</span><span class="fileupload-exists">Change</span>
                                                        <input type="file" name="imag" id="imag"  /></span>

                                                        <a href="#" class="btn btn-primary fileupload-exists remimage" uid="" data-dismiss="fileupload">Remove</a>
														<input type="hidden" id="imgstat" name="imgstat" value="1">
                                                    </div>

                                            	</div>
                                            </div>
                                        
                                        <div class="form-actions no-margin-bottom" style="text-align:center;">
                                            
                                            <a href="<?php echo base_url().'homepage/ourproducts';?>" class="btn btn-primary btn-sm"><i class="icon-reply "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info btn-sm "><i class="icon-save "></i> Save Changes</button>
                                        </div>
										<div id="msgbox"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                   
            <?php }?>
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
        <p>&copy;  <?php echo fottertitle;?> </p>
    </div>
    <!--END FOOTER -->
     <!-- GLOBAL SCRIPTS -->
     <script src="<?php echo asset_url();?>plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->
    
    <?php echo $jsfile;?>
     <script src="<?php echo asset_url();?>plugins/validationengine/js/jquery.validationEngine.js"></script>
    <script src="<?php echo asset_url();?>plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
    <script src="<?php echo asset_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
   
     <script src="<?php echo asset_url();?>plugins/jasny/js/bootstrap-fileupload.js"></script>
      <script>
    
        $(function () { 

        	
        	
           $('#brand-validate').validate({

            rules: {

                title: "required",

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
 
 <script type="text/javascript">
    var empty_string = /^\s*$/;
    function validate()
    { //alert(0);
    	if($("#brand-validate").valid()){
    	$("#alert").remove();
    	$("#msgbox").append( "<div class='alert' id='alert'></div>" );
    	$("#alert").removeClass().addClass('alert').html('Validating....').fadeIn(1000);
    	var imag = document.getElementById('imag').value;
    	var imgstat = document.getElementById('imgstat').value;    	
    	//alert(imgstat);		
    	var rebatestr="";
    	//category
    	if(empty_string.test(imag) && imgstat == "0"){
    	
    		$("#alert").html("<button type='button' class='close' data-dismiss='alert'>&times;</button>Select Banner Image").addClass('alert-danger').fadeTo(900,1);
    		return false;
    	}
    	else
    	{
    		$("#alert").html("<button type='button' class='close' data-dismiss='alert'>&times;</button>Please Wait Processing").addClass('alert-success').fadeTo(900,1);
    		return true;
    	}	
    	}	
    }

    </script> 
</body>
    <!-- END BODY-->
    
</html>
