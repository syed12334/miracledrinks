<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Order No.</th>
            <th>Name</th>
            <th>Category</th>
            <th>Client Image</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>


        <?php
        $clients = $this->home_db->getRecords('clients', array("status !=" => 2), '*', 'order_no DESC');
        if (count($clients) > 0) {
            $i = 1;
            foreach ($clients as $b) {
                $cls = "";

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
				$image="<img src='".front_url()."".$b->client_image."' width='150' width='100'>";
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $b->order_no; ?></td>
                    <td><?php echo $b->name; ?></td>
                    <td><?php echo $b->category; ?></td>
                    <td><?php echo $image; ?></td>
                    <td><?php echo $chng; ?></td>
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