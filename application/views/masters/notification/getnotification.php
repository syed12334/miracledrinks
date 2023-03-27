<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Notification Message</th>
        </tr>
    </thead>
    <tbody>


        <?php
        $sizes = $this->home_db->getRecords('notification', array("status !=" => 2), '*', 'nid DESC');
        if (count($sizes) > 0) {
            $i = 1;
            foreach ($sizes as $b) {
                $cls = "";

                if ($b->status == '0') 
                {
                    $status = "<button type='button' class='text-warning'><i class='fa fa-remove'></i> Active</button>";
                   
                }
                 else
                  {
                   $status = "<button type='button' class='text-success'><i class='fa fa-check'></i> In-Active</button>";
                   
                }
				
              
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $b->msg; ?></td>
                    
                </tr>
        <?php $i++;
            }
        } ?>


    </tbody>
</table>