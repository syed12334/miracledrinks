<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Action</th>
            <th>User name</th>
            <th>Message</th>
            <th>Date</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        $sizes = $this->home_db->sqlExecute('select f.sid,u.name,f.msg,f.created_at from support f left join users u on u.id=f.user_id order by f.sid DESC');
        if (count($sizes) > 0) {
            $i = 1;
            foreach ($sizes as $b) {
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                        <a href="<?= base_url().'master/editsupport/'.$b->sid;?>" class="btn btn-circle btn-info" title="Edit" ><i class="mdi mdi-border-color"></i></a>
                        <a href="<?= base_url().'master/viewsupport/'.$b->sid;?>" class="btn btn-circle btn-primary" title="View Support Reply" ><i class=" fas fa-eye" ></i></a>
                    </td>
                    <td><?php echo ucfirst($b->name); ?></td>
                    <td><?php echo $b->msg; ?></td>
                    <td><?php echo date('d-m-Y h:i A',strtotime($b->created_at)); ?></td>
                </tr>
        <?php $i++;
            }
        } ?>
    </tbody>
</table>