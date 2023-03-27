<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Name</th>
            <th>Email ID</th>
            <th>Contact No.</th>
            <th>Town</th>
            <th>Zip</th>
            <th>State</th>
            <th>Country</th>
            <th>Registered Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>


        <?php
		//echo $this->db->last_query();exit;
        if (count($customer_data) > 0) {
            $i = 1;
			//print_r($customer_data);exit;
            foreach ($customer_data as $b) {
                $cls = "";

              $edit="<button class='btn btn-primary btn-sm btn-grad' onclick='view(".$b->id.")'><i class='fas fa-eye'></i> View </button>";
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $b->name; ?></td>
                    <td><?php echo $b->emailid; ?></td>
                    <td><?php echo $b->phone; ?></td>
                    <td><?php echo $b->town_name; ?></td>
                    <td><?php echo $b->zip;?></td>
                    <td><?php echo $b->state_name;?></td>
                    <td><?php echo $b->country;?></td>
                    <td><?php echo $b->created_date;?></td>
                    <td><?php echo $edit; ?></td>
                  
                </tr>
        <?php $i++;
            }
        } ?>


    </tbody>
</table>