<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Student Name</th>
            <th>Parent Name</th>
            <th>Mobile Number</th>
            <th>Email</th>
            <th>Branch</th>
             <th>Grade</th>
            <th>Section</th>
            <th>Notification</th>
            <th>Created Date</th>
           
        </tr>
    </thead>
    <tbody>


        <?php
        $sizes = $this->home_db->getRecords('schools', array("status" => 0), '*', 's_id DESC');
        if (count($sizes) > 0) {
            $i = 1;
            foreach ($sizes as $b) {
        
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $b->sname; ?></td>
                    <td><?php echo $b->pname; ?></td>
                    <td><?php echo $b->mobile;?></td>
                    <td><?php echo $b->email;?></td>
                    <td><?php echo $b->branch;?></td>
                     <td><?php echo $b->grade; ?></td>
                    <td><?php echo $b->section; ?></td>
                   
                    <td><?php echo $b->notification; ?></td>
                    <td><?php echo date('d M y ',strtotime($b->created_at))."<br />".date('h:i:s A',strtotime($b->created_at)); ?></td>
                   
                </tr>
        <?php $i++;
            }
        } ?>


    </tbody>
</table>