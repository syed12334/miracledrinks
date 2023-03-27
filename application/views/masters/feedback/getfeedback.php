<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>User name</th>
            <th>Stars</th>
            <th>Feedback</th>
            <th>Date</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        $sizes = $this->home_db->sqlExecute('select u.name,f.feedback,f.star,f.created_at from feedback f left join users u on u.id=f.user_id order by f.fid DESC');
        if (count($sizes) > 0) {
            $i = 1;
            foreach ($sizes as $b) {
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo ucfirst($b->name); ?></td>
                    <td><?php echo $b->feedback; ?></td>
                    <td><?php echo $b->star; ?></td>
                    <td><?php echo date('d-m-Y h:i A',strtotime($b->created_at)); ?></td>
                </tr>
        <?php $i++;
            }
        } ?>
    </tbody>
</table>