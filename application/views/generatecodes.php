<?php 
if(!empty($cnt) && !empty($prefix)){?>
<br><br>
	<div class="form-group">
       <label class="control-label col-lg-12">Voucher Codes</label>
       <div class="col-lg-5" <?php if($cnt > 12){?> style="overflow-y:scroll;height:500px;"<?php }?>>
       		<table class="table table-striped table-bordered table-hover" >
       			<thead><th>Sl No</th><th>Coupon Code</th></thead>
                <tbody>
                                        
                                        
<?php
	for($i=0; $i<$cnt; $i++){
		
		$code = $prefix.str_pad(mt_rand(00000, 99999), 6, "0", STR_PAD_LEFT);
		$check = $this->master_db->getcontent1('voucher_code','code',$code);
		if($check == 0){
		?>
		<tr><td><?php echo $i+1;?></td><td><input type="hidden"  name="finalcode[]" value="<?php echo $code?>"><?php echo $code?></td></tr>
		<?php 
		
		}
		else{
			$i--;
		}
	}
	?>
		</tbody>
   </table>
   </div>
   </div>
   <?php if($val == "0"){?>
   <div class="form-actions no-margin-bottom" style="text-align:center;">
        <a href="<?php echo base_url().'voucher/gift_vouchers';?>" class="btn btn-primary btn-sm"><i class="icon-reply "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info btn-sm "><i class="icon-save"></i> Save Details</button>  
   </div>
	<?php 
	}
}
?>