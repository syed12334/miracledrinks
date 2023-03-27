 

 <div class="container">

                <div class="row">
                	<?php
                		if(count($gallery) >0) {
                				foreach ($gallery as $key => $value) {
                					?>
                					 <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
             <img src="<?= front_url().$value->gallery; ?>" class="img-responsive" style="width:100%">
          </div>
                					<?php
                				}
                		}else {

                		}
                	?>
               
        
                </div>
            </div>