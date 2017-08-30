<?php $controller = $this->request->params['controller'];
  $action = $this->request->params['action']; ?>  

<div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                       
                        <li class="nav-item <?php if($action=='dashboard') echo 'start active open'; ?>">
                            <a href="<?php echo HTTP_ROOT; ?>users/dashboard" class="nav-link ">
                                        <i class="fa fa-tachometer"></i>
                                        <span class="title">Dashboard </span>
                                        <span class="selected"></span>
                                    </a>    
                        </li> 
                      
                         <?php if (isset($authUser['role']) && in_array( $authUser['role'], ['1','2','3']) ) {
                       
                               if($action == "staffListing" ){
                                    $staffClass = "start active open";    
                                    $staffStyle = "style='display: block'";    
                               }else{
                                    $staffClass = "";  
                                    $staffStyle = "";  
                               }
                        ?>
                        <li class="nav-item  <?= $staffClass; ?>">
                            <a href="<?php echo HTTP_ROOT; ?>users/staff-listing" class="nav-link nav-toggle">
                                <i class="fa fa-user-secret"></i>
                                <span class="title">Officers</span>
                                <!--<span class="arrow <?= $staffClass; ?>"></span>-->
                                        <span class="selected"></span>
                            </a>
                            <!--<ul class="sub-menu"  <?= $staffStyle; ?> >
                                <li class="nav-item  ">
                                    <a href="<?php echo HTTP_ROOT; ?>users/staff-listing" class="nav-link ">
                                        <span class="title">Listing</span>
                                    </a>
                                </li>
                            </ul>-->
                        </li>
                        <?php }
                      ?>
                        <li class="nav-item <?= @$agentClass; ?>">
                            <a href="<?php echo HTTP_ROOT; ?>users/workers-listing" class="nav-link nav-toggle">
                                <i class="icon-users"></i>
                                <span class="title">Workers</span>
                                        <span class="selected"></span>
                                <!--<span class="arrow"></span>-->
                            </a>
                            <!--<ul class="sub-menu" <?= $agentStyle; ?> >
                                <li class="nav-item  ">
                                    <a href="<?php echo HTTP_ROOT; ?>users/agents-listing" class="nav-link ">
                                        <span class="title">Listing</span>
                                    </a>
                                </li>
                            </ul>-->
                        </li>
                      
                       
						
                         
                        <li class="nav-item <?= @$importClass; ?>">
                            <a href="<?php echo HTTP_ROOT; ?>anganwadis/listing" class="nav-link nav-toggle">
                                <i class="fa fa-building-o"></i>
                                <span class="title">Anganwadis</span>
                                        <span class="selected"></span>
                               
                            </a>
                         </li>
                         
                         <li class="nav-item <?= @$importClass; ?>">
                            <a href="<?php echo HTTP_ROOT; ?>children/listing" class="nav-link nav-toggle">
                                <i class="fa fa-child"></i>
                                <span class="title">Children Data</span>
                                        <span class="selected"></span>
                               
                            </a>
                         </li>
                         
                       
                         
                        
                          
                         
                        
                        
                         
                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
<style>
ul.sub-menu li.active {
  background: #397fae none repeat scroll 0 0 !important;
}
#order_id-error {
  color: yellow;
  font-size: 12px;
}
</style>
