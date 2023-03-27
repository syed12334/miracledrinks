<?php
    if(count($data) >0) {
      foreach ($data as $keys => $bp) {
        $id =$bp->bid;
        $getbp = $this->master_db->getRecords('blood_parameters_details',['bid'=>$id,'status'=>0],'title,id');
        if(count($getbp) >0) {
          foreach ($getbp as $new => $value) {
               ?>
             <div class="col-xs-12 col-md-5 col-lg-5">
              <h4 style="font-size:15px!important;font-weight: normal!important"><?= $value->title;?></h4>
                <input type="hidden" name="sblood[<?= $bp->tid;?>][<?= $value->id;?>]" value="<?= $value->id;?>">
                                                          </div>
                                                          <div class="col-xs-12 col-md-3 col-lg-3">
                                                             <div class="form-group">
                                                              <input type="number" name="nvalue[<?= $bp->tid;?>][<?= $value->id;?>]" class="form-control" placeholder="Enter Value" min="0"
                                                  >
                                                            </div>
                                                          </div>
                                                          <div class="col-xs-12 col-md-4 col-lg-4">
                                                            <div class="form-group">
                                                              <input type="text" name="title[<?= $bp->tid;?>][<?= $value->id;?>]" class="form-control" placeholder="Enter Unit">
                                                            </div>
                                                          </div>
                                                          
            <?php
          }
        }
       
      }
    }
?>