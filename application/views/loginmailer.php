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
   <link href="<?php echo asset_url();?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo asset_url();?>js/jquery.min.js"></script>
    <style type="text/css">


        .has-error {
            color: #f50200;
            border-color: #f50015 !important;

            box-shadow: none;
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
                 <li class="active">Others</li>
                 <li class="active">Login Emailer</li>
                 
            </ol>
            <h2 class="page-header">Login Emailer</h2>
           <?php if($type=='edit'): ?>
						<div class="col-lg-11">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-th-large"></i></div>
                                    <h5>Edit Login Emailer</h5>
                                    
								 </header>
                                 <?php 
	                                 $ser = "";
                                 $head="";
	                                 if(is_array($data)){
										$ser = $data[0]->ltext;
                                         $head = $data[0]->lheader;
									 }
//                                 ?>
                                <?php echo $this->session->flashdata('message');?>
                                <div id="collapseOne" class="accordion-body collapse in body">
                  		<form action="<?php echo base_url().'others/login_emailer_save';?>" class="form-horizontal" id="form" method="post" enctype="multipart/form-data" >

                            <div class="form-group">
                                <label class="control-label col-lg-3">Login Header<font style="color: red;">*</font></label>
                                <div class="col-lg-4">
                                    <input type="text" value="<?php echo $head?>" id="head" title="Enter Login Header" name="head" class="form-control" placeholder="Header" required="required"/>
                                    <label for="head" class="has-error"></label>
                                </div>
                            </div>
								
                                 <div class="form-group">
                                    <label class="control-label col-lg-3">Login Text<font style="color: red;">*</font></label>
                                        <div class="col-lg-8">

                                         <textarea id="text" name="text" required title="Enter Login Text" class="form-control ckeditor" ><?php echo $ser; ?></textarea>
                                            <label for="text" class="has-error"></label>
                                        </div>
                                 </div>
                                 


                                 
                                 
    
                                <div class="form-actions no-margin-bottom" style="text-align:center;">
                                    
                                    <button type="submit" class="btn btn-info btn-sm "><i class="icon-save "></i> Save Changes</button>
                               </div>
                            </form>
                        </div>
                    </div>
                </div>
  	 <?php endif;?>
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
    <script src="<?php echo asset_url();?>plugins/jasny/js/bootstrap-fileupload.js"></script>
    <script src="<?php echo asset_url();?>plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script>
    	
    $(document).ready(function(){
    	 CKEDITOR.config.toolbar = [
    	   	       	              	{ name: 'document', groups: [ 'mode', 'document' ], items: [ 'Source', '-', 'Save', 'Preview', 'Print' ] },
    	   	       	              	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo' ] },
    	   	       	              	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
    	   	       	              	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike'] },
    	   	       	              	{ name: 'paragraph', groups: [ 'list', 'indent','align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
    	   	       	              	{ name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] }
    	   	       	              	
    	   	       	              ];

   
  CKEDITOR.replace('text',{width:600,height:225});

    });
    </script>
    
      <script>
          $("#form").validate({
              ignore: [],
              errorClass: "has-error",
              rules: {

                  text: {
                      required: function () {
                          CKEDITOR.instances.text.updateElement();
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
