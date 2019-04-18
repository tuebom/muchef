<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <aside class="main-sidebar">
                <section class="sidebar">
<?php if ($admin_prefs['user_panel'] == TRUE): ?>
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url($avatar_dir . '/m_001.png'); ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $user_login['firstname'].$user_login['lastname']; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo lang('menu_online'); ?></a>
                        </div>
                    </div>

<?php endif; ?>
<?php if ($admin_prefs['sidebar_form'] == TRUE): ?>
                    <!-- Search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="<?php echo lang('menu_search'); ?>...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>

<?php endif; ?>
                    <!-- Sidebar menu -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="<?= $_SESSION['context'] == 1 ? site_url('equipment'): site_url('utensil'); ?>">
                                <i class="fa fa-home text-primary"></i> <span><?php echo lang('menu_access_website'); ?></span>
                            </a>
                        </li>

                        <li class="header text-uppercase"><?php echo lang('menu_main_navigation'); ?></li>
                        <li class="<?=active_link_controller('dashboard')?>">
                            <a href="<?php echo site_url('admin/dashboard'); ?>">
                                <i class="fa fa-dashboard"></i> <span><?php echo lang('menu_dashboard'); ?></span>
                            </a>
                        </li>
                        <li class="treeview" class="<?=active_link_controller('general')?>">
                            <a href="#">
                                <i class="fa fa-cogs"></i>
                                <span><?php echo lang('menu_general'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?=active_link_controller('banner')?>">
                                    <a href="<?php echo site_url('admin/banner'); ?>">
                                        <i class="fa fa-file"></i> <span><?php echo lang('menu_banner'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview <?=active_link_controller('products')?>">
                            <a href="#">
                                <i class="fa fa-cubes"></i>
                                <span><?php echo lang('menu_products'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <!-- <li class="<?=active_link_function('interfaces')?>"><a href="<?php echo site_url('admin/prefs/interfaces/admin'); ?>"><?php echo lang('menu_interfaces'); ?></a></li> -->
                                <li class="<?=active_link_controller('inventory')?>">
                                    <a href="<?php echo site_url('admin/inventory'); ?>">
                                        <i class="fa fa-shopping-cart"></i> <span><?php echo lang('menu_inventory'); ?></span>
                                    </a>
                                </li>
                                <li class="<?=active_link_controller('category')?>">
                                    <a href="<?php echo site_url('admin/categories'); ?>">
                                        <i class="fa fa-shopping-cart"></i> <span><?php echo lang('menu_categories'); ?></span>
                                    </a>
                                </li>
                                <li class="<?=active_link_controller('brands')?>">
                                    <a href="<?php echo site_url('admin/brands'); ?>">
                                        <i class="fa fa-tags"></i> <span><?php echo lang('menu_brands'); ?></span>
                                    </a>
                                </li>
                                <li class="<?=active_link_controller('carrier')?>">
                                    <a href="<?php echo site_url('admin/carrier'); ?>">
                                        <i class="fa fa-truck"></i> <span><?php echo lang('menu_carrier'); ?></span>
                                    </a>
                                </li>
                                <li class="<?=active_link_controller('reviews')?>">
                                    <a href="<?php echo site_url('admin/reviews'); ?>">
                                        <i class="fa fa-commenting"></i> <span><?php echo lang('menu_reviews'); ?></span>
                                    </a>
                                </li>
                                <!-- <li class="<?=active_link_controller('linkedproducts')?>">
                                    <a href="<?php echo site_url('admin/linkedproducts'); ?>">
                                        <i class="fa fa-share-alt"></i> <span><?php echo lang('menu_linkedproducts'); ?></span>
                                    </a>
                                </li> -->
                                <!-- <li class="<?=active_link_controller('attributes')?>">
                                    <a href="<?php echo site_url('admin/attributes'); ?>">
                                        <i class="fa fa-shapes"></i> <span><?php echo lang('menu_attributes'); ?></span>
                                    </a>
                                </li> -->
                            </ul>
                        </li>
                        
                        <!-- order menu -->
                        <li class="treeview <?=active_link_controller('orders')?>">
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span><?php echo lang('menu_orders'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?=active_link_controller('orders')?>">
                                    <a href="<?php echo site_url('admin/orders'); ?>">
                                        <i class="fa fa-book"></i> <span>Order List</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- shipping menu -->
                        <li class="treeview <?=active_link_controller('shipping')?>">
                            <a href="#">
                                <i class="fa fa-truck"></i>
                                <span><?php echo lang('menu_shipping'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?=active_link_controller('shipping')?>">
                                    <a href="<?php echo site_url('admin/shipping'); ?>">
                                        <i class="fa fa-truck"></i> <span><?php echo lang('menu_shipping'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- member menu -->
                        <!-- <li class="treeview <?=active_link_controller('members')?>">
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span><?php echo lang('menu_members'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?=active_link_controller('members')?>">
                                    <a href="<?php echo site_url('admin/members'); ?>">
                                        <i class="fa fa-book"></i> <span>Member List</span>
                                    </a>
                                </li>
                            </ul>
                        </li> -->

                        <li class="header text-uppercase"><?php echo lang('menu_administration'); ?></li>
                        <li class="<?=active_link_controller('users')?>">
                            <a href="<?php echo site_url('admin/users'); ?>">
                                <i class="fa fa-user"></i> <span><?php echo lang('menu_members'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('groups')?>">
                            <a href="<?php echo site_url('admin/groups'); ?>">
                                <i class="fa fa-shield"></i> <span><?php echo lang('menu_security_groups'); ?></span>
                            </a>
                        </li>
                        <li class="treeview <?=active_link_controller('prefs')?>">
                            <a href="#">
                                <i class="fa fa-cogs"></i>
                                <span><?php echo lang('menu_preferences'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?=active_link_function('interfaces')?>"><a href="<?php echo site_url('admin/prefs/interfaces/admin'); ?>"><?php echo lang('menu_interfaces'); ?></a></li>
                            </ul>
                        </li>
                        <!-- <li class="<?=active_link_controller('files')?>">
                            <a href="<?php echo site_url('admin/files'); ?>">
                                <i class="fa fa-file"></i> <span><?php echo lang('menu_files'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('database')?>">
                            <a href="<?php echo site_url('admin/database'); ?>">
                                <i class="fa fa-database"></i> <span><?php echo lang('menu_database_utility'); ?></span>
                            </a>
                        </li>


                        <li class="header text-uppercase"><?php echo $title; ?></li>
                        <li class="<?=active_link_controller('license')?>">
                            <a href="<?php echo site_url('admin/license'); ?>">
                                <i class="fa fa-legal"></i> <span><?php echo lang('menu_license'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('resources')?>">
                            <a href="<?php echo site_url('admin/resources'); ?>">
                                <i class="fa fa-cubes"></i> <span><?php echo lang('menu_resources'); ?></span>
                            </a>
                        </li> -->
                    </ul>
                </section>
            </aside>
