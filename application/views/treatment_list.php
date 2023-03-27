
<!DOCTYPE html>
<html>

<head>
	<!-- set the encoding of your site -->
	<meta charset="utf-8">
	<!-- set the viewport width and initial-scale on mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- set the HandheldFriendly -->
	<meta name="HandheldFriendly" content="True">
	<!-- set the description -->
	<meta name="description" content="">
	<!-- set the Keyword -->
	<meta name="keywords" content="">
	<meta name="author" content="">
	<!-- set the page title -->
	<title></title>
	<!-- include google roboto font cdn link -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

	<!-- include the site bootstrap stylesheet -->
	<link rel="stylesheet" href="<?= base_url();?>assets/main/css/bootstrap.css">
	<!-- include the site stylesheet -->
	
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="<?= base_url();?>assets/main/css/style.css">
	<!-- include the site responsive stylesheet -->
	<link rel="stylesheet" href="<?= base_url();?>assets/main/css/responsive.css">
	<style type="text/css">
		html {
			background: transparent!important
		}
		body {
			font-family: 'Poppins', sans-serif!important;

		}
		h1,h2,div,span,h3,h4,h5,h6,section,p,a,ul,li {
			font-family: 'Poppins', sans-serif!important;
		}
		@media screen and (max-width:570px) {
			.professionals-block {
			padding-top: 0px!important;
			}
			.text-info-block {
				padding-bottom: 15px!important;
			}
			.publication p {
				margin-bottom: 0px!important;
				margin-top:-15px!important;
			}
		}
		
	</style>
</head>
<body>
	<!-- main container of all the page elements -->
	<div id="wrapper">
		<!-- header of the page -->
		<?php
			if(count($data) >0) {
				?>
				<main id="main">
			
			<!-- text info block -->
			<article class="container text-info-block">
             <header class="seperator-head">
					<h2><?= $data[0]->title;?> </h2>
				</header>
                
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<img src="<?= base_url().$data[0]->image;?>" class="element-block image"  alt="image description">
					</div>
				</div>
			</article>
						
                            
			<!-- professionals block -->
			<section class="container professionals-block">
				<div class="row">
					 <div class="publication">
    
                      <ul class="nav nav-tabs" role="tablist">
    
                        <li role="presentation" class="active"><a href="#Education" aria-controls="Education" role="tab" data-toggle="tab">Recommended Diet</a></li>
                        <li role="presentation"><a href="#Research_Interests" aria-controls="Research_Interests" role="tab" data-toggle="tab">Things to keep in Mind</a></li>
						<li role="presentation"><a href="#Awards_and_Recognitions" aria-controls="Awards_and_Recognitions" role="tab" data-toggle="tab">Morning </a></li>
						<li role="presentation"><a href="#Fellow_Or_Membership_of_Professional_Bodies" aria-controls="Fellow_Or_Membership_of_Professional_Bodies" role="tab" data-toggle="tab">Afternoon </a></li>
						<li role="presentation"><a href="#Brief_Profile_of_Professional_Career" aria-controls="Brief_Profile_of_Professional_Career" role="tab" data-toggle="tab">Evening </a></li>
						

                      </ul>
    
    
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="Education">
                        		
                             	
								 
                                  <p><?= $data[0]->rdiet;?>
									</p>	
                        </div>
						
                        
                        <div role="tabpanel" class="tab-pane " id="Research_Interests">
                        	

                           
								 
                                  <p><?= $data[0]->things;?>
									</p>	

                      </div>
                        
                      
                        
						<div role="tabpanel" class="tab-pane " id="Awards_and_Recognitions">
                                      
                                       
								 
                                  <p><?= $data[0]->morning;?> 
									</p>	
                                            
                            </div>
							
                            <div role="tabpanel" class="tab-pane " id="Fellow_Or_Membership_of_Professional_Bodies">
							
							   
								 
                                  <p><?= $data[0]->afternoon;?>
									</p>	
						    </div>
									  
					      <div role="tabpanel" class="tab-pane " id="Brief_Profile_of_Professional_Career">

                            
								 
                                  <p><?= $data[0]->evening;?> 
									</p>														
									
					</div>
					
					
                      
                      
                 </div><!-- publication -->      
        
        
        
                    
				</div>
			</section>
		</main>
				<?php
			}else {
				echo "No data found";
			}
		?>
		
		<!-- footer area container -->
		
		<!-- back top of the page -->
		
	</div>
	
	<!-- include jQuery -->
	<script src="<?= base_url();?>assets/main/js/jquery.js"></script>
	<!-- include jQuery -->
	<script src="<?= base_url();?>assets/main/js/plugins.js"></script>
	<!-- include jQuery -->
	<script src="<?= base_url();?>assets/main/js/jquery.main.js"></script>
	<!-- include jQuery -->
	<script type="text/javascript" src="<?= base_url();?>assets/main/js/init.js"></script>
</body>

</html>