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
                 <li class="active">Register Agent</li>
            </ol>
            <h2 class="page-header">Register Agent</h2>
           <?php if($type=='edit'): ?>
						<div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-th-large"></i></div>
                                    <h5>Edit Agent details</h5>
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
                 				 <form action="<?php echo base_url().'register/agent_edit_save';?>" class="form-horizontal" id="organization_validate" method="post" onsubmit="return validate();" enctype="multipart/form-data">
                  					<?php if(is_array($agent)){?>
								<input type="hidden" id="aid" name="aid" class="form-control" value="<?php echo $agent[0]->id;?>"/>

								     <div class="form-group">
                                            <label class="control-label col-lg-4">Name <font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                                <input type="text" id="name" name="name" class="form-control" value="<?php echo $agent[0]->name;?>" title="Enter Name" />
                                            </div>
                                        </div> 
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Email ID <font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                                <input type="email" id="email" name="email" class="form-control" maxlength="100" value="<?php echo $agent[0]->email;?>"/>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Contact No. <font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                                <input type="text" id="contact" name="contact" class="form-control onlynumbers" value="<?php echo $agent[0]->contact;?>" maxlength="13"/>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Country<font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                           		<select name="country" id="country" class="form-control" required onchange="getstates(this.value);">
                                           		<option value="">--Select--</option>
                                                <?php $st = $this->master_db->getcontent2('city','id',$agent[0]->city_id,'');
                                                	  $ct = $this->master_db->getcontent2('state','id',$st[0]->state_id,'');
                                                	if(is_array($country)){
														foreach ($country as $c){?>
														<option value="<?php echo $c->id;?>" <?php if($ct[0]->country_id == $c->id){?>selected="selected"<?php }?>><?php echo $c->name;?></option>
													<?php 
														}
													}
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">State<font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                           		<select name="state" id="state" class="form-control" required onchange="getcity(this.value);">
                                           		<option value="">--Select--</option>
                                                <?php $ct = $this->master_db->getcontent2('state','country_id',$ct[0]->country_id,'');
                                                	if(is_array($ct)){
														foreach ($ct as $c){?>
														<option value="<?php echo $c->id;?>" <?php if($st[0]->state_id == $c->id){?>selected="selected"<?php }?>><?php echo $c->name;?></option>
													<?php 
														}
													}
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">City<font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                           		<select name="city" id="city" class="form-control" required >
                                           		<option value="">--Select--</option>
                                           		<?php 
                                           		$st = $this->master_db->getcontent2('city','state_id',$st[0]->state_id,'');
                                           		if(is_array($st)){
                                           			foreach ($st as $c){?>
                                           				<option value="<?php echo $c->id;?>" <?php if($agent[0]->city_id == $c->id){?>selected="selected"<?php }?>><?php echo $c->name;?></option>
                                           		<?php }}?>
                                                </select>
                                            </div>
                                        </div>
            						<?php }
            						else{
										echo "Invalid Agent!!!";
									}?>
                                       
                                        <div class="form-actions no-margin-bottom" style="text-align:center;">
                                            <a href="<?php echo base_url().'register';?>" class="btn btn-primary btn-sm"><i class="icon-reply "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info btn-sm "><i class="icon-save "></i> Save Changes</button>
                                       </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                 

            <?php else: ?>

                        <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-th-large"></i></div>
                                    <h5>Add Agent details</h5>
                                    <div class="toolbar">
                                        <ul class="nav">
                                            <li>
                                                <div class="btn-group">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </header>
                                
                                <div id="collapseOne" class="accordion-body collapse in body" >
                              <form action="<?php echo base_url().'register/agent_save';?>" class="form-horizontal" id="organization_validate" method="post" enctype="multipart/form-data">
                                     
                                   <input type="hidden" id="aid" name="aid" class="form-control" value="0"/>
                                                                    
								    <div class="form-group">
                                            <label class="control-label col-lg-4">Name <font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                                <input type="text" id="name" name="name" class="form-control"  title="Enter Name" required="required"/>
                                            </div>
                                        </div> 
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Email ID <font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                                <input type="email" id="email" name="email" class="form-control" maxlength="100" required="required"/>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Contact No. <font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                                <input type="text" id="contact" name="contact" class="form-control onlynumbers" required="required" maxlength="13"/>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Country<font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                           		<select name="country" id="country" class="form-control" required onchange="getstates(this.value);">
                                           		<option value="">--Select--</option>
                                                <?php 
                                                	if(is_array($country)){
														foreach ($country as $c){?>
														<option value="<?php echo $c->id;?>"><?php echo $c->name;?></option>
													<?php 
														}
													}
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">State<font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                           		<select name="state" id="state" class="form-control" required onchange="getcity(this.value);">
                                           		<option value="">--Select--</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">City<font style="color: red;">*</font></label>
                                            <div class="col-lg-4">
                                           		<select name="city" id="city" class="form-control" required >
                                           		<option value="">--Select--</option>
                                                </select>
                                            </div>
                                        </div>
                                         

                                        <div class="form-actions no-margin-bottom" style="text-align:center;">
                                            <a href="<?php echo base_url().'register';?>" class="btn btn-primary btn-sm"><i class="icon-reply "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info btn-sm "><i class="icon-save"></i> Save Changes</button>  
                                        </div>
                                </div>
                                <div id="msgbox"></div>
                                    </form>
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
    <script>
    	
    $(document).ready(function(){

    	$('.onlynumbers').bind('keypress', function (evt) {
        	var charCode = (evt.which) ? evt.which : event.keyCode
        			
        		    if (charCode > 31 && (charCode < 48 || charCode > 57))
        		        return false;
        		    return true;
        
        });
        
    
    });

    function getcity(id)
    {          
		$.post('<?php echo base_url();?>register/getcity',{cid: id},function(data) { 

             $('#city').html(data);
             
         });
    }

    function getstates(id){
  	  $.post('<?php echo base_url();?>master/getstate',{cid: id},function(data) { 

            $('#state').html(data);
            
        });
    }
    </script>
   
   
    
   <script>
        $(function () { 
           $('#organization_validate').validate({
		   ignore: [],  
            rules: {
                orderno: "required",
				name: "required",
				editor: "required",
				
				/*editor: {
				  required:true
				}*/
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