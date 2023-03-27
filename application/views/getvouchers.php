<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Coupon Type</th>
            <th>Coupon Title</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>No. of Coupons</th>
            <th>Discount (%)</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>


        <?php
        $vouchers = $this->home_db->getRecords('vouchers', array("status !=" => 2), '*', 'id DESC');
        if (count($vouchers) > 0) {
            $i = 1;
            foreach ($vouchers as $b) {
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
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $b->type; ?></td>
                    <td><?php echo $b->title;?></td>
                    <td><?php echo date_format(date_create($b->from_date), 'd-m-Y');?></td>
                    <td><?php echo date_format(date_create($b->to_date), 'd-m-Y');?></td>
                    <td><?php echo $b->no_of_coupons;?></td>
                    <td><?php echo $b->discount;?></td>
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