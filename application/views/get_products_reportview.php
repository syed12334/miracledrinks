<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Status</th>
            <th>Action</th>
            <th>Category</th>
            <th>Product Name</th>
            <th>Product Code</th>
            <th>Product Image</th>
            <th>Material</th>
            <th>Color</th>
            <th>Sizes</th>
        </tr>
    </thead>
    <tbody>


        <?php
        if (count($products) > 0) {
            $i = 1;
            foreach ($products as $b) {

                 if($b->home_page == 0){
                        $show = "<button class='btn btn-info btn-sm btn-grad' onclick='changestatus2(1,".$b->ppid.")'><i class='icon-ok'></i> Show In Home Page </button>";
                    } else {

                        $show="<button class='btn btn-primary btn-sm btn-grad' onclick='changestatus2(0,".$b->ppid.")'><i class='icon-remove'></i> Dont Show In Home Page </button>";

                    }


					if($b->pstatus=='0')
		            {
			            $status="<span class='btn btn-info btn-sm btn-grad'>Active</span>";
			            $chng="<button class='btn btn-primary btn-sm btn-grad' onclick='changestatus(1,".$b->ppid.")'><i class='icon-remove'></i> Deactivate </button>";

		            }
		            else
		            {
			            $status="<span class='btn btn-primary btn-sm btn-grad'>In-Active</span>";
			            $chng="<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(0,".$b->ppid.")'><i class='icon-ok'></i> Activate </button>";
		            }
		
					$image="<img src='".front_url()."".$b->image_path."' width='100px'>";	
					$size = "";
					$viewtable = $this->master_db->runsql('*',$b->cpage_url.'_product_view','where pid='.$b->ppid.'');
					
					if(is_array($viewtable)){
						$sizearr = array();
						foreach ($viewtable as $v){
							if($v->size_id == '0'){
								$sizearr[$v->sid] = 'No Size';
							}
							else{
								$sizearr[$v->sid] = $v->sname;
							}
						}
						$size = implode("<br>",$sizearr);
					}
					
					$edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$b->ppid.",`".$b->cpage_url."`)'><i class='icon-pencil icon-white'></i> Edit</button>";	
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><?php echo $chng; ?><?php echo $edit; ?><?php echo $show; ?></td>
                    <td><?php echo $b->cname;?></td>
                    <td><?php echo $b->pname;?></td>
                    <td><?php echo $b->pcode;?></td>
                    <td><?php echo $image;?></td>
                    <td><?php echo $b->mname; ?></td>
                    <td><?php echo $b->clname; ?></td>
                    <td><?php echo $size; ?></td>
                </tr>
        <?php $i++;
            }
        } ?>


    </tbody>
</table>