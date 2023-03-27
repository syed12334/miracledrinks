<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>User Type</th>
            <th>Name</th>
            <th>Email ID</th>
            <th>Contact No.</th>
            <th>Town</th>
            <th>Zip</th>
            <th>State</th>
            <th>Registered Date</th>
        </tr>
    </thead>
    <tbody>


        <?php
		$users = $this->home_db->getRecords('users', array("status !=" => 2), '*', 'id DESC');
        if (count($users) > 0) {
            $i = 1;
            foreach ($users as $b) {
                $cls = "";

              $edit="<button class='btn btn-primary btn-sm btn-grad' onclick='view(".$b->id.")'><i class='fas fa-eye'></i> View </button>";
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php if($b->user_type == '1')
						{
						echo 'B2C';
						}if($b->user_type == '2')
						{
						echo 'B2B';}?><br/>
						<?php echo $edit; ?></td>
                    <td><?php echo $b->name; ?></td>
                    <td><?php echo $b->emailid; ?></td>
                    <td><?php echo $b->phone; ?></td>
                    <td><?php echo $b->town_name; ?></td>
                    <td><?php echo $b->zip;?></td>
                    <td><?php echo $b->state_name;?></td>
                    <td><?php echo date('d-m-Y', strtotime($b->created_at));?></td>
                  
                </tr>
        <?php $i++;
            }
        } ?>


    </tbody>
</table>