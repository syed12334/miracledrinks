<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Email</th>
			<th>Subscribed Date</th>
        </tr>
    </thead>
    <tbody>


        <?php
        $newsletter = $this->home_db->getRecords('newsletter',array(),'*','id desc');
        if (count($newsletter) > 0) {
            $i = 1;
            foreach ($newsletter as $b) {
                $cls = "";

               
			
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $b->email; ?></td>
					<td><?php echo date_format(date_create($b->subscribed_date), 'd-m-Y g:i A'); ?></td>
                    
                </tr>
        <?php $i++;
            }
        } ?>


    </tbody>
</table>