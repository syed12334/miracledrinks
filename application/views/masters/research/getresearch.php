<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Title</th>
            <th>PDF Link</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>


        <?php
        $sizes = $this->home_db->getRecords('research', array("status !=" => 2), '*', 'rid DESC');
        if (count($sizes) > 0) {
            $i = 1;
            foreach ($sizes as $b) {
                $cls = "";

                if ($b->status == '0') 
                {
                    $status = "<button type='button' class='text-warning'><i class='fa fa-remove'></i> Active</button>";
                    $chng = "<button class='btn btn-info btn-sm' onclick='changestatus(1," . $b->rid . ")'  $cls> Active</button>";
                }
                 else
                  {
                   $status = "<button type='button' class='text-success'><i class='fa fa-check'></i> In-Active</button>";
                    $chng = "<button class='btn btn-primary btn-sm pl-3 pr-3' onclick='changestatus(0," . $b->rid . ")'  $cls> In-Active</button>";
                }
				
              
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $b->title; ?></td>
                    <td><?php if(!empty($b->pdf_link)) {echo '<a href="'.base_url().$b->pdf_link.'" target="_blank">PDF Link</a>';}else {echo "";}?></td>
                    <td><?php echo $chng; ?><!--<br/><?php echo $chng1; ?>--></td>
                    <td>
                        <button type="button" class="btn btn-circle btn-info" title="Edit" onclick="edit('<?php echo $b->rid; ?>')"><i class="mdi mdi-border-color"></i></button>
                        <button type="button" class="btn btn-circle btn-primary" title="Delete" onclick="changestatus(2,'<?php echo $b->rid;?>')" ><i class=" fas fa-trash" ></i></button>
                    </td>
                </tr>
        <?php $i++;
            }
        } ?>


    </tbody>
</table>