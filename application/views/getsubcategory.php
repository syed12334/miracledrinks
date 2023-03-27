<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Order No</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>


        <?php
        $sizes = $this->master_db->sqlExecute('select c.name as cname,s.order_no,s.name as sname,s.id,s.status from subcategory s left join category c on s.category_id = c.id where s.status !=2 order by s.id desc');
        //echo "<pre>";print_r($sizes);exit;
        if (count($sizes) > 0) {
            $i = 1;
            foreach ($sizes as $b) {
                $cls = "";

                $id = $b->id;
        //echo $this->db->last_query();

                if ($b->status == '0') 
                {
                    $status = "<button type='button' class='text-warning'><i class='fa fa-remove'></i> Active</button>";
                    $chng = "<button class='btn btn-info btn-sm' onclick='changestatus(1," . $b->id . ")'  $cls> Active</button>";
                }
                 else
                  {
                   $status = "<button type='button' class='text-success'><i class='fa fa-check'></i> In-Active</button>";
                    $chng = "<button class='btn btn-primary btn-sm pl-3 pr-3' onclick='changestatus(0," . $b->id . ")'  $cls> In-Active</button>";
                }
				$name='';
				
               
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $b->order_no; ?></td>
                    
                    <td><?php echo $b->cname;?></td>
                    <td><?php echo $b->sname;?></td>
                    <td><?php echo $chng; ?><!--<br/><?php echo $chng1; ?>--></td>
                    <td>
                        <button type="button" class="btn btn-circle btn-info" title="Edit" onclick="edit('<?php echo $b->id; ?>')"><i class="mdi mdi-border-color"></i></button>
                        <button type="button" class="btn btn-circle btn-primary" title="Delete" onclick="changestatus(2,'<?php echo $b->id;?>')" ><i class=" fas fa-trash" ></i></button>
                    </td>
                </tr>
        <?php $i++;
            }
        } ?>


    </tbody>
</table>