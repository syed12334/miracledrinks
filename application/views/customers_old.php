<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->



<!-- BEGIN HEAD-->

<head>

   

     <meta charset="UTF-8" />

    <title><?php echo title;?></title>

     <meta content="width=device-width, initial-scale=1.0" name="viewport" />

	<meta content="" name="description" />

	<meta content="" name="author" />

     <!--[if IE]>

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <![endif]-->

    <!-- GLOBAL STYLES -->

    <!-- GLOBAL STYLES -->
	<link rel="stylesheet" href="<?php echo asset_url(); ?>css/style.min.css" />
    <link rel="stylesheet" href="<?php echo asset_url();?>plugins/bootstrap/css/bootstrap.css" />

    <link rel="stylesheet" href="<?php echo asset_url();?>css/main.css" />

    <link rel="stylesheet" href="<?php echo asset_url();?>css/theme.css" />

    <link rel="stylesheet" href="<?php echo asset_url();?>css/MoneAdmin.css" />

    <link rel="stylesheet" href="<?php echo asset_url();?>plugins/Font-Awesome/css/font-awesome.css" />
<?php echo $updatelogin;?>
    
<?php echo $popcss;?>
    



    <style>

    .updatedetail{width: 350px !important;height: 66px !important;}

    .flex-Failed {

    background: none repeat scroll 0 0 #B94A48;

    color: #FFFFFF;

    height: 100%;

    margin-right: 1px;

    padding: 2px;

    text-align: center;

    width: 100%;

    }

    .flex-Completed {

    background: none repeat scroll 0 0 #468847;

    color: #FFFFFF;

    height: 100%;

    margin-right: 1px;

    padding: 2px;

    text-align: center;

    width: 100%;

    }

    .imagewh

    {

    height:20px;

    width:20px;

    }

    </style>



    <style>

    .badge-orange

    {

    background-color: #FE5E00;

    }

    .showhide

    {

    float:right;

    cursor:pointer;



    }

    </style>





<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->

<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/flexigrid.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo asset_url();?>flexigrid.js"></script>

<?php $id=$this->uri->segment(3);?>

<script type="text/javascript">

$(document).ready(function(){



<?php 

    if($id){

    echo "submitfilterstatus(".$id.");";

    }

?>



 $('#productadd').submit(function (){

	$('#flex1').flexOptions({newp: 1}).flexReload();

	return false;

	});

	

 $('#resetbtn').click(function (){ 
	 document.getElementById("productadd").reset();
	 $('#flex1').flexReload();
  return false;});
});



var filterhiden=1;

function showfilter()

{

    if(filterhiden==1) 

    { 

	

	$("#filterbody").show(); filterhiden=0;

	$('#toggleimage').attr('src',"<?php echo asset_url();?>images/minus-sign.png");



    }

    else 

    { 

	$("#filterbody").hide(); filterhiden=1; 

	$('#toggleimage').attr('src',"<?php echo asset_url();?>images/plus-sign.png");

    }



}

$(document).ready(function(){

    $("#filterbody").hide();

});		



var base_url = '<?php echo base_url();?>';	

$(document).ready(function(){								

										

	$("#flex1").flexigrid({

				url: base_url+'reports/customersTable',

				dataType: 'json',

				colModel : [

							{display: 'Sl.No.', width : 40, sortable : false,  align: 'center'},
							{display: 'Name', width : 130,name:'first_name', sortable : true,  align: 'center'},
							{display: 'Email ID', width : 120,name:'emailid', sortable : true,  align: 'center'},
							{display: 'Contact No.',name:'phone', width : 100, sortable : true,  align: 'center'},

			                {display: 'Town',name:'town', width : 120, sortable : true,  align: 'center'},
			                {display: 'Zip',name:'zip', width : 120, sortable : true,  align: 'center'},
			                {display: 'State',name:'state', width : 120, sortable : true,  align: 'center'},
			                {display: 'Country',name:'country', width : 120, sortable : true,  align: 'center'},
			                {display: 'Registered Date',name:'created_date', width : 100, sortable : true,  align: 'center'},
			    			{display: 'Actions', width : 120, align: 'center'}	  
							],
							showToggleBtn: false,

                onError: function(data){

	                for (var i in data){ 
	
	                   alert("Header: " + i +"\nMessage: " + data[i]); 
	
	                } 

                },			

				sortname: "id",
		
				sortorder: "desc",
		
				onSubmit: addFormData,
		
				usepager: true,

				useRp: true,
	
				rp: 10,
	
				showTableToggleBtn: false,
	
				width: 1000,
	
				height: 300

			});   
});

function closethisanddintRedirect()
{
$("#mask").html("");
$("#overlay").height(0).removeClass();
$("#flex1").flexOptions({newp: $("#flex1").flexGetPageNumber()}).flexReload();   
//reloadColorsdashboard();
}



function addFormData(){

	//passing a form object to serializeArray will get the valid data from all the objects, but, if the you pass a non-form object, you have to specify the input elements that the data will come from

	var dt = $('#productadd').serializeArray();

	$("#flex1").flexOptions({params: dt});

	return true;

}

function submitfilterstatus(ststaus)
{
	$("#choosestatus").val(ststaus);

	$('#flex1').flexOptions({newp: 1}).flexReload();
	
	return false;

}


function view(id){
	var docHeight = $(document).height();
	$("body").append("<div id='overlay'></div>");
	$("#overlay").height(docHeight).removeClass().addClass("addoverlay");
	$("body").append("<div id='mask' style='position:fixed; top:8%; left:25%; z-index:10000; height:100%;'></div>");
	$("#mask").html('<div class="alpha30" style="margin-left:50%; margin-top:50%;"><div class="white"><img src="<?php echo asset_url();?>images/36.gif" /></div></div>');
	$("#mask").load('<?php echo base_url();?>reports/customer_view/'+id, function(data){});

}

function download(){
	document.location.href="<?php echo base_url()?>reports/exportcust?fromdate="+$("#fromdate").val()+"&todate="+$("#todate").val()+"&email="+$("#email").val()+"&name="+$("#name").val()+"&contact="+$("#contact").val()+"&company="+$("#company").val()+"&town="+$("#town").val()+"&zip="+$("#zip").val()+"&state="+$("#state").val()+"&country="+$("#country").val();
}


</script>

</head>

    <!-- END  HEAD-->

    <!-- BEGIN BODY-->

<body class="padTop53 " >



     <!-- MAIN WRAPPER -->

    <div id="wrap">

       <!-- HEADER SECTION -->

       <?php echo $header;?>

       <!-- END HEADER SECTION -->

       <!-- MENU SECTION -->

       <?php echo $left;?>

       <!--END MENU SECTION -->

        <!--PAGE CONTENT -->

        <div id="content">



            <div class="inner" style="min-height:700px;">

                <div class="row">

                    <div class="col-lg-12">

                    <ol class="breadcrumb">

                 <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>

                 <li class="active">Reports</li>

                 <li class="active">Registered Customers</li>

                 

            </ol>

                        <h2 class="page-header">Registered Customers</h2>


			<form  id="productadd" method="post">	                   

			    <table class="table table-bordered table-striped">

				<thead>

				    <tr>

					  <th colspan="2" onClick="showfilter()" style="cursor:pointer;">Search <div class="showhide" onClick="showfilter()"><img src="<?php echo asset_url();?>images/plus-sign.png" id="toggleimage" onClick="showfilter()"></div></th>

				    </tr>

				</thead>

				<tbody  id="filterbody">

                
				    <tr>

					<td>From Date:</td>

					<td><input type="text" name="fromdate"  id="fromdate"  class="form-control" readonly style="width:50%;"></td>

				    </tr>

				    <tr>

					<td>To Date:</td>

					<td><input type="text" name="todate"  id="todate"  class="form-control" readonly style="width:50%;"></td>

				    </tr>
				    
				    <tr>

					<td>Name:</td>

					<td><input type="text" name="name"  id="name"  class="form-control"  style="width:50%;"></td>

				    </tr>
				    
				    <tr>

					<td>Email ID:</td>

					<td><input type="text" name="email"  id="email"  class="form-control"  style="width:50%;"></td>

				    </tr>
				    
				    <tr>

					<td>Contact No.:</td>

					<td><input type="text" name="contact"  id="contact"  class="form-control"  style="width:50%;"></td>

				    </tr>
				    
				    

				    
				    <tr>

					<td>Town:</td>

					<td><input type="text" name="town"  id="town"  class="form-control"  style="width:50%;"></td>

				    </tr>
				    
				    <tr>

					<td>Zip:</td>

					<td><input type="text" name="zip"  id="zip"  class="form-control"  style="width:50%;"></td>

				    </tr>
				    
				    <tr>

					<td>State:</td>

					<td><input type="text" name="state"  id="state"  class="form-control"  style="width:50%;"></td>

				    </tr>
				    
				    <tr>

					<td>Country:</td>

					<td><input type="text" name="country"  id="country"  class="form-control"  style="width:50%;"></td>

				    </tr>
				    
				    

				    <tr>

					<td colspan="2">

					    <button type="submit" class="btn btn-primary"><i class="icon-search"></i> Search</button>

					    <button type="reset" class="btn" id="resetbtn"><i class="icon-refresh"></i> Reset</button>
						<button type="button" class="btn btn-info" onclick="download();"><i class="icon-download-alt"></i> Export</button>
					</td>

					

				  </tr>

				</tbody>

			</table>

			</form>       

	<table id="flex1"></table>

    

                <div class="col-lg-12">

                        <div class="modal fade" id="uiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                                

                        </div>

                </div>


                    </div>

                </div>



                <hr />

            </div>

       </div>

       <!--END PAGE CONTENT -->
    </div>



     <!--END MAIN WRAPPER -->



   <!-- FOOTER -->

    <div id="footer">

        <p>&copy;  <?php echo fottertitle;?></p>

    </div>

    <!--END FOOTER -->

    

     <!-- GLOBAL SCRIPTS -->

     <script src="<?php echo asset_url();?>plugins/bootstrap/js/bootstrap.min.js"></script>

     <script src="<?php echo asset_url();?>plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">

 	 <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>



	<script>

	$(function() {

		$("#fromdate").datepicker();
	
		$("#todate").datepicker();

	});

 	</script>

    <!-- END GLOBAL SCRIPTS -->

    

</body>

    <!-- END BODY-->

    

</html>

