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

<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/flexigrid.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url();?>flexigrid.js"></script>
<style type="text/css">
.showhide {
    cursor: pointer;
    float: right;
}
</style>

<script type="text/javascript">

$(document).ready(function(){

	 $('#productadd').submit(function (){

		$('#flex1').flexOptions({newp: 1}).flexReload();

		return false;

		});

		

	 $('#resetbtn').click(function (){ 
		 $('#productadd')[0].reset();
		 $('#flex1').flexOptions({newp: 1}).flexReload();
		 return false;
		 });
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
	
	$(document).ready(function(){  
		                                       
    var base_url = '<?php echo base_url();?>';   
    $("#flex1").flexigrid({
		url: '<?php echo base_url();?>register/agent_table',
		dataType: 'json',
		colModel : [
					{display: 'Sl.No.', width : 45, sortable : false,  align: 'center'},
			    	{display: 'Name', name : 'name',width : 150, sortable : false, align: 'center'},
			    	{display: 'Email ID',name : 'email', width : 150, sortable : false, align: 'center'},
			    	{display: 'Contact No.',name : 'phone', width : 120, sortable : false, align: 'center'},
			    	{display: 'City', name : 'cname',width : 150, sortable : false, align: 'center'},
			    	{display: 'State', name : 'sname',width : 150, sortable : false, align: 'center'},
			    	{display: 'Country', name : 'ctname',width : 120, sortable : false, align: 'center'},
			    	{display: 'Registered date', name:'a.created_date',width : 120, sortable : false, align: 'center'},
			    	{display: 'Status', name : 'status', width : 120, sortable : true, align: 'center'},
			    	{display: 'Action',  width : 230, sortable : false, align: 'center'}
					],
					buttons : [
				                {name: 'Register', bclass: 'add', onpress : test},
				                {separator: true}
				                ],
				onError: function(data){
					               for (var i in data){ 
					              alert("Header: " + i +"\nMessage: " + data[i]); 
					            } 
					           },
				success: function(data){
					               for (var i in data){ 
					              alert("Header: " + i +"\nMessage: " + data[i]); 
					            } 
					            },
	
					sortname: "a.id",
					sortorder: "desc",
					onSubmit: addFormData,
	
					usepager: true,
					useRp: true,
					rp: 10,
					showTableToggleBtn: false,
					width: 1000,
					height: 255
            		}
            		);
			});

function test(com,grid)
{

	if(com=='Register')
	{
	     var base_url = '<?php echo base_url();?>';
	    document.location.href = base_url+"register/agent_add";
	}
}

function editRecord(id){
    var base_url = '<?php echo base_url();?>';
    document.location.href =base_url+"register/agent_edit/"+id;
}


function changestatus(id,st)
{
	if(confirm('Are you sure?'))
	   {
		   $.ajax({
			   type: "POST",
			   dataType: "json",
			   url: "<?php echo base_url();?>register/agent_status",
			   data: {items:id,status:st},
			   success: function(data)
			   {
				   closethisanddintRedirect();
				   $("#flex1").flexOptions({newp: $("#flex1").flexGetPageNumber()}).flexReload();   
			   },
			   error: function(data){
	               for (var i in data){ 
	              alert("Header: " + i +"\nMessage: " + data[i]); 
	            } 
	            }
			 });
		}
}

function addFormData(){

	//passing a form object to serializeArray will get the valid data from all the objects, but, if the you pass a non-form object, you have to specify the input elements that the data will come from
	var dt = $('#productadd').serializeArray();
	$("#flex1").flexOptions({params: dt});
	return true;

}

function viewRecord(id)
{
	var docHeight = $(document).height();
	$("body").append("<div id='overlay'></div>");
	$("#overlay").height(docHeight).removeClass().addClass("addoverlay");
	$("body").append("<div id='mask' style='position:fixed; top:8%; left:25%; z-index:10000; height:100%;'></div>");
	$("#mask").html('<div class="alpha30" style="margin-left:50%; margin-top:50%;"><div class="white"><img src="<?php echo asset_url();?>images/36.gif" /></div></div>');
	$("#mask").load('<?php echo base_url();?>register/agent_view/'+id, function(data){});
}

function submitfilterstatus(ststaus)
{
$("#choosestatus").val(ststaus);
//$("#choosestatus option[value='"+ststaus+"']").attr("disabled", false);
$('#flex1').flexOptions({newp: 1}).flexReload();
//reloadColorsdashboard();
return false;
}



function closethisanddintRedirect()
{
$("#mask").html("");
$("#overlay").height(0).removeClass();
$("#flex1").flexOptions({newp: $("#flex1").flexGetPageNumber()}).flexReload();   
//reloadColorsdashboard();
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

            <div class="inner" style="min-height:1200px;">
            <div class="row">
            <div class="col-lg-12">
			<ol class="breadcrumb">
                 <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                 <li class="active">Register Agents</li>
            </ol>
                        <h2 class="page-header">Register Agents</h2>
                        <?php echo $message;?>
                        
                     <form  id="productadd" method="post" action="">	                   

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
		
							<td>Agent Name:</td>
		
							<td><input type="text" name="name"  id="name"  class="form-control"  style="width:50%;"></td>
		
						    </tr>
						    
						    						    
						    <tr>
		
							<td>Email ID:</td>
		
							<td><input type="text" name="email"  id="email"  class="form-control"  style="width:50%;"></td>
		
						    </tr>
						    
						    <tr>
		
							<td>Contact No.:</td>
		
							<td><input type="text" name="phone"  id="phone"  class="form-control"  style="width:50%;"></td>
		
						    </tr>
						    
						    
						    <tr>
		
							<td>Country:</td>
		
							<td>
							<select name="country"  id="country"  class="form-control"  style="width:50%;" onchange="getstates(this.value);" >
								<option value="">--Select--</option>
								<?php if(is_array($country)){
										foreach ($country as $st){
									?>
										<option value="<?php echo $st->id?>"><?php echo $st->name?></option>
								<?php }}?>
							</select>
							</td>
		
						    </tr>
						    
						    <tr>
		
							<td>State:</td>
		
							<td>
							<select name="state"  id="state"  class="form-control"  style="width:50%;" onchange="getcity(this.value);" >
								<option value="">--Select--</option>
							</select>
							</td>
		
						    </tr>
						    
						    <tr>
		
							<td>City:</td>
		
							<td>
							<select name="city"  id="city"  class="form-control"  style="width:50%;">
								<option value="">--Select--</option>
							</select>
							</td>
		
						    </tr>
						    						    
						    
						    <tr>
		
							<td>Status:</td>
		
							<td>
		
							    <select name="choosestatus" id="choosestatus" class="form-control" style="width:50%;">
		
								<option value="" selected>All</option>
		
								<option value="0">Active</option>
		
								<option value="1">In-Active</option>
		
							    </select>
		
							</td>
		
		                    </tr>
		
						    <tr>
		
							<td colspan="2">
		
							    <button type="submit" class="btn btn-primary"><i class="icon-search"></i> Search</button>
		
							    <button type="reset" class="btn" id="resetbtn"><i class="icon-refresh"></i> Reset</button>
							    
							    <!-- <button type="button" class="btn btn-info" onclick="download();"><i class="icon-download-alt"></i> Export</button> -->
		
							</td>
		
							
		
						  </tr>
		
						</tbody>
		
					</table>

			</form>
                        <table id="flex1"></table>


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
    <!-- END GLOBAL SCRIPTS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">

 	 <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>



	<script>

	$(function() {

		$("#fromdate").datepicker();
	
		$("#todate").datepicker();

	});

	function getcity(id)
    {          
		$.post('<?php echo base_url();?>register/getcity',{cid: id},function(data) { 

             $('#city').html(data);
             
         });
    }

	function getstates(id){
  	  $.post('<?php echo base_url();?>master/getstate',{cid: id},function(data) { 

            $('#state').html(data);
            
        });
    }

 	</script>
</body>
    <!-- END BODY-->
    
</html>
