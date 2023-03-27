	 <script src="<?= asset_url() ?>js/sweetalert2/dist/sweetalert2.all.min.js"></script>
	 <script src="<?= asset_url() ?>js/extra-libs/sweetalert2/sweet-alert.init.js"></script>
	 <script>
	 	$(document).ready(function() {
	 		$(".onlynumbers").keypress(function(evt) {
	 			var charCode = (evt.which) ? evt.which : event.keyCode
	 			if (charCode == 8) //back space
	 				return true;
	 			if (charCode < 48 || charCode > 57) //0-9
	 			{
	 				return false;
	 			}
	 			return true;
	 		});
	 	});

	 	$('.floatval').keypress(function(event) {
	 		var charCode = (event.which) ? event.which : event.keyCode
	 		if (charCode == 8 || charCode == 9) {

	 		} else if ((charCode != 46 || $(this).val().indexOf('.') != -1) && (charCode < 48 || charCode > 57)) {
	 			event.preventDefault();
	 		}
	 	});

	 	$(".remimage").click(function() {
	 		//alert("hjh");
	 		var val = $(this).attr('uid');
	 		$("#imgstat" + val).val(0);
	 		//alert($("#imgstat"+val).val());
	 	});
	 </script>