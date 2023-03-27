<table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
    <thead>
        <tr>
            <th>Sl No.</th>
             <th>Actions</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Address</th>
            <th>Created Date</th>
           
        </tr>
    </thead>
    <tbody>


        <?php
        $sizes = $this->home_db->getRecords('templedetails', array("id !=" => -1), '*', 'id DESC');
        if (count($sizes) > 0) {
            $i = 1;
            foreach ($sizes as $b) {
                $cls = "";

                  
                   $status = "<button type='button' class='text-success' onclick='return viewGallery(".$b->id.")' style='border:1px solid #000; padding:6px;' title='View Gallery'><i class='fas fa-image' style='font-size:20px'></i> </button>";
                  
            
				
        
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><?php echo $b->name; ?></td>
                    <td><?php echo $b->mobile;?></td>
                    <td><?php echo $b->lat;?></td>
                    <td><?php echo $b->lng;?></td>
                    <td><?php echo $b->address; ?></td>
                    <td><?php echo date('d M y ',strtotime($b->created_at))."<br />".date('h:i:s A',strtotime($b->created_at)); ?></td>
                   
                </tr>
        <?php $i++;
            }
        } ?>


    </tbody>
</table>