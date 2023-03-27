<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Image</th>
            <th>Title</th>
          
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>


        <?php
        $sizes = $this->home_db->getRecords('articles', array("status !=" => 2), '*', 'art_id DESC');
        if (count($sizes) > 0) {
            $i = 1;
            foreach ($sizes as $b) {
                $cls = "";$image ="";

                if ($b->status == '0') 
                {
                    $status = "<button type='button' class='text-warning'><i class='fa fa-remove'></i> Active</button>";
                    $chng = "<button class='btn btn-info btn-sm' onclick='changestatus(1," . $b->art_id . ")'  $cls> Active</button>";
                }
                 else
                  {
                   $status = "<button type='button' class='text-success'><i class='fa fa-check'></i> In-Active</button>";
                    $chng = "<button class='btn btn-primary btn-sm pl-3 pr-3' onclick='changestatus(0," . $b->art_id . ")'  $cls> In-Active</button>";
                }
                if(!empty($b->image)) {
                    $image .="<img src='".base_url().$b->image."' style='width:100px'/>";
                }
				
              
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $image; ?></td>
                    <td><?php echo $b->title; ?></td>
                
                    <td><?php echo $chng; ?><!--<br/><?php echo $chng1; ?>--></td>
                    <td>
                        <button type="button" class="btn btn-circle btn-info" title="Edit" onclick="edit('<?php echo $b->art_id; ?>')"><i class="mdi mdi-border-color"></i></button>
                        <button type="button" class="btn btn-circle btn-primary" title="Delete" onclick="changestatus(2,'<?php echo $b->art_id;?>')" ><i class=" fas fa-trash" ></i></button>
                    </td>
                </tr>
        <?php $i++;
            }
        } ?>


    </tbody>
</table>