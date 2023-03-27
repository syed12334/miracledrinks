<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Pincode</th>
            <th>Delivery Charges</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>


        <?php
        $pincode = $this->home_db->getRecords('pincodes');
        if (count($pincode) > 0) {
            $i = 1;
            foreach ($pincode as $b) {
                $cls = "";
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $b->pincode; ?></td>
                    <td><?php echo $b->charges; ?></td>
                    <td>
                        <button type="button" class="btn btn-circle btn-info" title="Edit" onclick="edit('<?php echo $b->id; ?>')"><i class="mdi mdi-border-color"></i></button>
                    </td>
                </tr>
        <?php $i++;
            }
        } ?>


    </tbody>
</table>