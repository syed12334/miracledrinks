<script type="text/javascript">
	var interval = 60*1000 ; // set refresh interval to 1 minute
	interval = interval*10;// set refresh interval to 15 minute
	var ajax_call = function() {
		var strURL="<?php echo base_url()?>kimberadmin/updatelogin";
		if (window.XMLHttpRequest)
	  	{// code for IE7+, Firefox, Chrome, Opera, Safari
	 		 req=new XMLHttpRequest();
	 	}
		else
	  	{// code for IE6, IE5
	  		req=new ActiveXObject("Microsoft.XMLHTTP");
	 	}
		
	  req.open("GET", strURL, false); //third parameter is set to false here
	  req.send(null);
	};

	
	var myintr = setInterval(ajax_call, interval);//handler

	</script>