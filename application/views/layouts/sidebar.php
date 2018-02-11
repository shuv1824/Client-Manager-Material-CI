<div class="sidebar" data-color="purple" data-image="../assets/img/sidebar-1.jpg">
        <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
        -->
            <div class="logo">
                <a href="#" class="simple-text">
                    Client Manager
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <a href="<?php echo site_url() ?>">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="#product-submenu" data-toggle="collapse" class="collapsed">
                            <i class="material-icons">shopping_cart</i>
                            <p>
                                Products
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="product-submenu">
                            <ul class="nav">
                                <li>
                                    <a href="#">
                                        <i class="material-icons">format_list_numbered</i>
                                        <p>Product List</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="material-icons">add_shopping_cart</i>
                                        <p>Add Product</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#service-submenu" data-toggle="collapse" class="collapsed">
                            <i class="material-icons">assistant_photo</i>
                            <p>
                                Services
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="service-submenu">
                            <ul class="nav">
                                <li>
                                    <a href="#">
                                        <i class="material-icons">format_list_numbered</i>
                                        <p>Service List</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="material-icons">library_add</i>
                                        <p>Add Service</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#client-submenu" data-toggle="collapse" class="collapsed">
                            <i class="material-icons">people</i>
                            <p>
                                Clients
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="client-submenu">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url('clients'); ?>">
                                        <i class="material-icons">format_list_numbered</i>
                                        <p>Client List</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('client/add'); ?>">
                                        <i class="material-icons">group_add</i>
                                        <p>Add Client</p>
                                    </a>
                                </li>
                                <?php if(($this->session->userdata['role']=='super_admin') || ($this->session->userdata['role']=='admin')):?>
                                <!--<li>
                                    <a href="<?php echo base_url('clients/'.$this->session->userdata['id']); ?>">
                                        <i class="material-icons">supervisor_account</i>
                                        <p>Assigned Clients<p>
                                    </a>
                                </li>-->
                                <?php endif;?>
                                <li>
                                    <a href="<?php echo base_url('clients/assigned'); ?>">
                                        <i class="material-icons">supervisor_account</i>
                                        <p>My Clients<p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#assign-submenu" data-toggle="collapse" class="collapsed">
                            <i class="material-icons">assignment</i>
                            <p>
                                Meetings
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="assign-submenu">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url('assignments'); ?>">
                                        <i class="material-icons">format_list_numbered</i>
                                        <p>Meeting List</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('assignment/assign'); ?>">
                                        <i class="material-icons">assignment_ind</i>
                                        <p>Assign Meeting</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('assignments/assigned'); ?>">
                                        <i class="material-icons">assignment_returned</i>
                                        <p>My Meetings</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#user-submenu" data-toggle="collapse" class="collapsed">
                            <i class="material-icons">account_box</i>
                            <p>
                                Users
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="user-submenu">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url('users'); ?>">
                                        <i class="material-icons">format_list_numbered</i>
                                        <p>User List</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('user/add'); ?>">
                                        <i class="material-icons">person_add</i>
                                        <p>Add User</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#reports-submenu" data-toggle="collapse" class="collapsed">
                            <i class="material-icons">assessment</i>
                            <p>
                                Reports
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="reports-submenu">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url('users'); ?>">
                                        <i class="material-icons">format_list_numbered</i>
                                        <p>Report</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('user/add'); ?>">
                                        <i class="material-icons">person_add</i>
                                        <p>Report</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <i class="material-icons">settings_application</i>
                            <p>Settings</p>
                        </a>
                    </li>

                    <?php if($this->session->userdata['role'] == "super_admin"):?>
                    <li>
                        <a href="#">
                            <i class="material-icons text-gray">restore</i>
                            <p>Activity Log</p>
                        </a>
                    </li>
                    <?php endif;?>
                </ul>
            </div>
        </div>

        <div class="main-panel" style="min-height:100vh">
        <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> <?php echo $title ?> </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown" id="notification-box"></li>

                        <?php if($this->session->userdata('validated')):?>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">person</i>
                                <p class="hidden-lg hidden-md">Profile</p>
                            </a>
                            <div class="user-info-box dropdown-menu">
                                <strong><?php echo $this->session->userdata('username')?></strong><br>
                                <img src="<?php echo base_url('assets/img/users/'.$this->session->userdata['image'])?>" alt="Image" class="img-circle" height="80px" width="80px"><br><br>
                                <span><?php echo $this->session->userdata('role')?></span><hr>
                                <div class="row">
                                <div class="pull-left">
                                    <a href="<?php echo base_url('resetpassword')?>" class="btn btn-warning btn-simple" title="Password Reset">
                                        <i class="material-icons">settings_applications</i> Reset</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo base_url('logout')?>" class="btn btn-primary btn-simple btn-wd btn-logout" title="Logout from Application">
                                        <i class="material-icons">exit_to_app</i> Logout</a>
                                </div>
                                </div>
                            </div>
                        </li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </nav>
