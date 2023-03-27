<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl. No.</th>
            <th>Actions</th>
            <th>Order No.</th>
            <th>Ordered Date</th>
            <th>Order Status</th>
            <th>Ordered By</th>
            <th>Email ID</th>
            <th>Phone</th>
            <th>Total Qty</th>
            <th>Total Qty</th>
        </tr>
    </thead>
    <tbody>


        <?php
        if (count($result) > 0) {
            $i = 1;
            foreach ($result as $b) {
				$arry_status = array(
				"",
				"<span class='badge badge-dark'>New</span>",
				"<span class='badge badge-danger'>In-Progress</span>",
				"<span class='btn btn-default btn-sm btn-grad'>Shipped</span>",
				"<span class='badge badge-success'>Delivered</span>");
				$arry_chngstatus = array(
					"",
					"<button class='btn btn-default btn-sm btn-grad' onclick='changestatus(3,".$b->id.")'><i class='mdi mdi-truck'></i> Change to Shipping </button>",
					"<button class='btn btn-default btn-sm btn-grad' onclick='changestatus(3,".$b->id.")'><i class='mdi mdi-truck'></i> Change to Shipping </button>",
					"<button class='btn btn-info btn-sm btn-grad' onclick='changestatus(4,".$b->id.")'><i class='icon-home'></i> Change to Delivered </button>","");
	
			if($b->status=='-1')
			{
				$status="<span class='btn btn-primary btn-sm btn-grad'>Failed</span>";
				$chng = "";
			}
			else
			{
				$status = $arry_status[$b->status];
				$chng = $arry_chngstatus[$b->status];
			}
			
			
			$view="<button class='btn btn-primary btn-sm btn-grad' onclick='view(`".$b->id."`)'><i class='fas fa-eye'></i> View </button>";

        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $view; ?>&nbsp;<?php echo $chng; ?></td>
                    <td><?php echo $b->orderid;?></td>
                    <td><?php echo $b->ordered_date; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><?php echo $b->name; ?></td>
                    <td><?php echo $b->emailid; ?></td>
                    <td><?php echo $b->phone; ?></td>
                    <td><?php echo $b->tot_qty; ?></td>
                    <td><?php echo number_format((float)$b->total_amt_paid, 2, '.', '');?></td>
                    
                </tr>
        <?php $i++;
            }
        } ?>


    </tbody>
</table>