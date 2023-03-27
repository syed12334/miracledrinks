<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> 
<html lang="en">
<!--<![endif]-->

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
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/flexigrid.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url();?>flexigrid.js"></script>
<script type="text/javascript">
$(document).ready(function(){
                                            
    var base_url = '<?php echo base_url();?>';                            
    $("#flex1").flexigrid
            (
            {
            url: base_url+'homepage/ourproducts_table',
            dataType: 'json',
            colModel : [
                {display: 'Sl No.', width : 70,  align: 'center'},
                {display: 'Order No.', width : 100, sortable : true,  align: 'center'},
                {display: 'Title', width : 150, sortable : true,  align: 'center'},

                {display: 'Image', width : 200, sortable : true,  align: 'center'},
                {display: 'Status',  width : 100, sortable : true, align: 'center'},
                {display: 'Actions', width : 200, align: 'center'},
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
            sortname: "order_no",
            sortorder: "asc",
            usepager: true,
            useRp: true,
            rp: 10,
            showTableToggleBtn: false,
            width: 950,
            height: 255
            }
            );   
    
});
function changestatus(st,id)
{
    var base_url = '<?php echo base_url();?>';
    if(confirm('Change status of the item?'))
           {
               $.ajax({
                   type: "POST",
                   dataType: "json",
                   url: base_url+"homepage/ourproducts_status",
                   data: {items:id,status:st},
                   success: function(data){
                   $("#flex1").flexReload();
                   }
                 });
            }
}

function edit(id){
    var base_url = '<?php echo base_url();?>';
    document.location.href =base_url+"homepage/ourproducts_edit?id="+id;
}
        
</script></head>
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
                 <li class="active">Home Page</li>
                 <li class="active">Our Products</li>
            </ol>
                        <h2 class="page-header">Our Products</h2>

                        
                        <?php echo $this->session->flashdata('message');?>
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
</body>
    <!-- END BODY-->
    
</html>
