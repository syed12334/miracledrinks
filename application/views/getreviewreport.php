<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl. No.</th>
            <th>Category</th>
            <th>Product</th>
            <th>Product Image</th>
            <th>Posted By</th>
            <th>Email ID</th>
            <th>Rating</th>
            <th>Posted Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>


        <?php
        if (count($result) > 0) {
            $i = 1;
            foreach ($result as $b) {
                $cls = "";
				if($b->status=='0')
			{
				$status="<span class='btn btn-info btn-sm btn-grad'>Approved</span>";
				$chng="<button class='btn btn-primary btn-sm btn-grad' onclick='changestatus(1,".$b->id.")'><i class='icon-remove'></i> Reject </button>";
			}
			else if($b->status=='1')
			{
				$status="<span class='btn btn-primary btn-sm btn-grad'>Rejected</span>";
				$chng="<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(0,".$b->id.")'><i class='icon-ok'></i> Approve </button>";
			}
			else if($b->status=='2')
			{
				$status="<span class='btn btn-warning btn-sm btn-grad'>Pending</span>";
				$chng="<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(0,".$b->id.")'><i class='icon-ok'></i> Approve </button> <button class='btn btn-primary btn-sm btn-grad' onclick='changestatus(1,".$b->id.")'><i class='icon-remove'></i> Reject </button>";
			}
			else if($b->status=='3')
			{
				$status="<span class='badge badge-dark'>New</span>";
				$chng="<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(0,".$b->id.")'><i class='icon-ok'></i> Approve </button> <button class='btn btn-primary btn-sm btn-grad' onclick='changestatus(1,".$b->id.")'><i class='icon-remove'></i> Reject </button>";
			}

			$image = "";

			if(!empty($b->path)){
				$image = "<img src='".front_url()."".$b->path."' width='80'>";
				//	$image="<img src='".base_url().$s->img1."' width='80'>";
			}

               
				
				
				$edit="<button class='btn btn-primary btn-sm btn-grad' onclick='view(".$b->id.",`".''."`)'><i class='fas fa-eye'></i> View </button>";

        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $b->cname; ?></td>
                    <td><?php echo $b->pname;?></td>
                    <td><?php echo $image; ?></td>
                    <td><?php echo $b->name; ?></td>
                    <td><?php echo $b->email; ?></td>
                    <td><?php echo $b->rating; ?></td>
                    <td><?php echo $b->created_date; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><?php echo $chng; ?><?php echo $edit; ?></td>
                    
                </tr>
        <?php $i++;
            }
        } ?>


    </tbody>
</table>