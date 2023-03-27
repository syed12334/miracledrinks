<?php $active = $this->uri->segment(1);
$active1 = $this->uri->segment(2);
$active2 = $this->uri->segment(3);
?>

<aside class="left-sidebar">

    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
   
		
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link  waves-effect waves-dark" href="<?php echo base_url(); ?>" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i>
                        <span class="hide-menu">Dashboard </span>
                    </a>
                </li>

     


<?php
    if($newsess[0]->city_id ==2) {

    }else {
        ?>
          <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-database"></i><span class="hide-menu"> Masters </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                  
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/states'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> States</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/city'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Cities</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/pincodes'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Pincodes</span>
                            </a>
                        </li>
                           
                       </ul>
                    
                        
                          
                        
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-home-outline"></i><span class="hide-menu"> Knowledge Hub </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/awards'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Awards & Certificates</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/gallery'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Gallery</span>
                            </a>
                        </li>
                         <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/diy'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> DIY Recipes</span>
                            </a>
                        </li>
                            <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/articles'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Articles</span>
                            </a>
                        </li>
                         <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/herbal'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Herbal Literature</span>
                            </a>
                        </li>
                         <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/research'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Research Articles</span>
                            </a>
                        </li>
                    </ul>
                </li>
                   <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-home-outline"></i><span class="hide-menu"> Treatment & Diet's </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                         <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/diet'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Diet</span>
                            </a>
                        </li>
                           <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/treatment'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Treatment</span>
                            </a>
                        </li>
                         <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/tprotocol'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Protocol</span>
                            </a>
                        </li>
                    </ul>
                </li>
                 
 <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-home-outline"></i><span class="hide-menu"> E-Store </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/category'; ?>" class="sidebar-link">
                                <i class="mdi mdi-format-align-left"></i>
                                <span class="hide-menu"> Categories </span>
                            </a>
                        </li>
                       <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/subcategory'; ?>" class="sidebar-link">
                                <i class="mdi mdi-format-align-right"></i>
                                <span class="hide-menu"> SubCategories</span>
                            </a>
                        </li> 
                          <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'homepage/banner'; ?>" class="sidebar-link">
                                <i class="mdi mdi-format-align-left"></i>
                                <span class="hide-menu"> Banners </span>
                            </a>
                        </li>
                      
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/size'; ?>" class="sidebar-link">
                                <i class="mdi mdi-format-float-right"></i>
                                <span class="hide-menu"> Sizes</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/products'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Products</span>
                            </a>
                        </li>  
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'voucher/gift_vouchers'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Coupon</span>
                            </a>
                        </li> 
                    </ul>
                </li>
                 <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-home-outline"></i><span class="hide-menu">Appointments</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                      
                    </ul>
                </li>
        <?php
    }
?>
              

                           
                         
                         
                        
                         

         


                 <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-home-outline"></i><span class="hide-menu">Health Record</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                         <?php
                                if($newsess[0]->city_id ==2) {
                                    ?>
                                      <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/doctorpanel'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Add Treatment</span>
                            </a>
                        </li>
                                    <?php
                                }else {
                                    ?>
                                      <li class="sidebar-item">

                            <a href="<?php echo base_url() . 'master/disease'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Disease</span>
                            </a>
                        </li>
                           <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/tests'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Tests</span>
                            </a>
                        </li>
                        
                         <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/symptoms'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Symptoms</span>
                            </a>
                        </li>
                           <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/bloodparameters'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Blood Parameters</span>
                            </a>
                        </li>
                          <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/doctorpanel'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu"> Add Treatment</span>
                            </a>
                        </li>
                                    <?php
                                }
                            ?>
                      
                       
                       
                    </ul>
                </li>
               <?php
                                if($newsess[0]->city_id ==2) {
                                    
                                }else {
                                    ?>
                                         <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-home-outline"></i><span class="hide-menu">Videos</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                       <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/video'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu">Video</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-home-outline"></i><span class="hide-menu">Notification</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/notifications'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu">Notifications</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-home-outline"></i><span class="hide-menu">Blogs</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                         <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/blog'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu">Manage Blogs</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-home-outline"></i><span class="hide-menu">Feedback & Support</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                         <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/feedback'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu">Feedback</span>
                            </a>
                        </li>
                         <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'master/support'; ?>" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i>
                                <span class="hide-menu">Support</span>
                            </a>
                        </li>
                    </ul>
                </li>
                 


                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-content-copy"></i><span class="hide-menu"> Reports </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'reports/customers'; ?>" class="sidebar-link">
                                <i class="mdi mdi-format-align-left"></i>
                                <span class="hide-menu"> Registered Users </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'reports/reviews'; ?>" class="sidebar-link">
                                <i class="mdi mdi-format-align-left"></i>
                                <span class="hide-menu"> Customer Reviews </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() . 'reports/user_orders'; ?>" class="sidebar-link">
                                <i class="mdi mdi-format-align-left"></i>
                                <span class="hide-menu">Customer Orders Report </span>
                            </a>
                        </li>
                
                        
                    </ul>
                </li>

                                    <?php
                                }
                                ?>
               





    
            </ul>
        </nav>
    
    </div>
  
</aside>

<?php /*

<div id="left">
    <div class="media user-media well-small">
        <a class="user-link">
            <?php
            if (empty($detail[0]->profile_img)) {
            ?>
                <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo asset_url(); ?>img/user.gif" />
            <?php
            } else { ?>

                <!--<img class="media-object img-thumbnail user-img" alt="User Picture" src="--><?php //echo base_url().$detail[0]->profile_img;
                                                                                                ?>
                <!--" style="height: 120px;width: 120px;"/>-->

            <?php
            }
            ?>
        </a>
        <br />
        <div class="media-body">
            <h5 class="media-heading"><?php echo $detail[0]->name; ?></h5>
        </div>
        <br />
    </div>



    <ul id="menu" class="collapse">
        <li class="panel <?php if ($active == '' || ($active == 'atpadmin' && $active1 == "")) echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>">
                <i class="icon-desktop"></i> Dashboard
            </a>
        </li>

        <li class="panel <?php if ($active1 == 'settings') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>atpadmin/settings">
                <i class="icon-cog"></i> Settings
            </a>
        </li>


        <li class="panel <?php if ($active == 'master') echo 'active'; ?>">
            <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#master-nav">
                <i class="icon-th"></i> Masters
                <span class="pull-right">
                    <i class="icon-angle-down"></i>
                </span>
            </a>

            <ul class="<?php if ($active == 'master' || $active == 'voucher') echo 'in';
                        else echo 'collapse'; ?> " id="master-nav">
                <li><a href="<?php echo base_url() . 'master/material'; ?>">Materials </a></li>
                <li><a href="<?php echo base_url() . 'master/color'; ?>">Colors </a></li>
                <li><a href="<?php echo base_url() . 'master/size'; ?>">Sizes </a></li>
                <li><a href="<?php echo base_url() . 'master/category'; ?>">Categories </a></li>
                <!-- <li><a href="<?php echo base_url() . 'master/subcategory'; ?>">Sub Category </a></li> -->
                <li><a href="<?php echo base_url() . 'master/products'; ?>"> Products </a></li>
                <li><a href="<?php echo base_url() . 'voucher/gift_vouchers'; ?>"> Coupon </a></li>
            </ul>

        </li>


        <li class="panel <?php if ($active == 'homepage') echo 'active'; ?>">
            <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#homepage">
                <i class="icon-th"></i> Home Page
                <span class="pull-right">
                    <i class="icon-angle-down"></i>
                </span>
            </a>

            <ul class="<?php if ($active == 'homepage' || $active1 == "stories") echo 'in';
                        else echo 'collapse'; ?> " id="homepage">
                <li><a href="<?php echo base_url() . 'homepage/banner'; ?>">Banners </a></li>

                <li><a href="<?php echo base_url() . 'homepage/clientscategory'; ?>">Client Categories </a></li>
                <li><a href="<?php echo base_url() . 'homepage/client'; ?>">Clients </a></li>
                <li><a href="<?php echo base_url() . 'homepage/gifts'; ?>">Gifts </a></li>
                <li><a href="<?php echo base_url() . 'about/stories'; ?>">Testimonials</a></li>
            </ul>
        </li>

        <li class="panel <?php if ($active1 == 'settings') echo 'active'; ?>">
            <a href="<?php echo base_url() . 'about'; ?>">
                <i class="icon-th"></i> About Us
            </a>
        </li>

        <li class="panel <?php if ($active == 'freebies') echo 'active'; ?>">
            <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#freebies">
                <i class="icon-th"></i> Blog Posts
                <span class="pull-right">
                    <i class="icon-angle-down"></i>
                </span>
            </a>

            <ul class="<?php if ($active == 'blogposts') echo 'in';
                        else echo 'collapse'; ?> " id="freebies">
                <li><a href="<?php echo base_url() . 'blogposts'; ?>">Blog Posts </a></li>
                <li><a href="<?php echo base_url() . 'blogposts/blogposts_comments'; ?>">Blog Comments </a></li>
            </ul>
        </li>

        <!--<li class="panel <?php if ($active1 == 'settings') echo 'active'; ?>">

                    <a href="<?php echo base_url(); ?>voucher/gift_vouchers" >

                        <i class="icon-desktop"></i> Coupon

                    </a>                   

                </li>-->


        <li class="panel <?php if ($active == 'footer' || $active == 'sociallinks') echo 'active'; ?>">
            <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#footer">
                <i class="icon-th"></i> Footer
                <span class="pull-right">
                    <i class="icon-angle-down"></i>
                </span>
            </a>

            <ul class="<?php if ($active == 'footer' || $active == 'sociallinks') echo 'in';
                        else echo 'collapse'; ?> " id="footer">
                <li><a href="<?php echo base_url() . 'footer/deliveryinfo'; ?>">Delivery Info </a></li>
                <li><a href="<?php echo base_url() . 'footer/privacyPolicy'; ?>">Privacy Policy </a></li>
                <li><a href="<?php echo base_url() . 'footer/termsofUse'; ?>"> Disclaimer </a></li>
                <li><a href="<?php echo base_url() . 'footer/customerservice'; ?>"> Customer Service </a></li>
                <li><a href="<?php echo base_url() . 'footer/termsandconditions'; ?>"> Terms & Conditions</a></li>
                <li><a href="<?php echo base_url() . 'footer/contact'; ?>"> Contact Us </a></li>
                <li><a href="<?php echo base_url() . 'sociallinks'; ?>"> Social Links </a></li>
            </ul>
        </li>


        <li class="panel <?php if ($active == 'reports') echo 'active'; ?>">
            <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#reports">
                <i class="icon-th"></i> Reports
                <span class="pull-right">
                    <i class="icon-angle-down"></i>
                </span>
            </a>

            <ul class="<?php if ($active == 'reports') echo 'in';
                        else echo 'collapse'; ?> " id="reports">
                <li><a href="<?php echo base_url() . 'reports/customers'; ?>">Registered Users </a></li>
                <li><a href="<?php echo base_url() . 'reports/reviews'; ?>">Customer Reviews </a></li>
                <li><a href="<?php echo base_url() . 'reports/user_orders'; ?>">Orders Report </a></li>
            </ul>
        </li>

        <!--<li class="panel <?php if ($active1 == 'sociallinks') echo 'active'; ?>">

                    <a href="<?php echo base_url(); ?>sociallinks" >

                        <i class="icon-desktop"></i> Social Links

                    </a>

                </li>-->

        <!--<li class="panel <?php if ($active1 == 'others') echo 'active'; ?>">

                    <a href="<?php echo base_url(); ?>others" >

                        <i class="icon-cog"></i> News Letter

                    </a>

                </li>-->


        <li class="panel <?php if ($active == 'others') echo 'active'; ?>">
            <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#others">
                <i class="icon-th"></i> Others
                <span class="pull-right">
                    <i class="icon-angle-down"></i>
                </span>
            </a>

            <ul class="<?php if ($active == 'others') echo 'in';
                        else echo 'collapse'; ?> " id="others">
                <li><a href="<?php echo base_url() . 'others/pincode'; ?>">Pincodes </a></li>
                <li><a href="<?php echo base_url() . 'others/city'; ?>">City</a></li>
                <li><a href="<?php echo base_url() . 'others/state'; ?>">State</a></li>
                <li><a href="<?php echo base_url() . 'others'; ?>">News Letter</a></li>
            </ul>
        </li>

        <!--<li class="panel <?php if ($active == 'reports') echo 'active'; ?>">
                    <a  data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#reports">
                        <i class="icon-th"></i> Reports
                        <span class="pull-right">
                            <i class="icon-angle-down"></i>
                        </span>
                    </a>

                    <ul class="<?php if ($active == 'reports') echo 'in';
                                else echo 'collapse'; ?> " id="reports">
                        <li><a href="<?php echo base_url() . 'reports/fpincodes'; ?>">Failed Pincodes </a></li>
                        <li><a href="<?php echo base_url() . 'reports/customers'; ?>">Registered Customers </a></li>
                    </ul>
                </li>-->
    </ul>
</div>

*/ ?>