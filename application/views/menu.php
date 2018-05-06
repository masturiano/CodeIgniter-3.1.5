<nav class="navbar navbar-inverse">
        <div class="container-fluid">

                <!-- LOGO -->
                <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                        </button>
                        <a href="#" class="navbar-brand"><img src="<? echo base_url('includes/images/website_logo.png'); ?>"></a>
                </div>

                <!-- MENU ITEMS -->
                <div class="collapse navbar-collapse" id="mainNavBar">

                        <!-- LEFT ALIGN -->
                        <ul class="nav navbar-nav">
                                <li class="active"><a href="<? echo site_url('home_controller/home'); ?>"><?php echo $this->lang->line('menu_home');?></a>
                                <li><a href="#"><?php echo $this->lang->line('menu_about');?></a></li>
                                <li><a href="#"><?php echo $this->lang->line('menu_contact');?></a></li>

                                <!-- DROPDOWN MENU -->
                                <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('menu_my_profile');?> <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                                <li><a href="#"><?php echo $this->lang->line('sub_menu_friends');?></a></li>
                                                <li><a href="#"><?php echo $this->lang->line('sub_menu_photos');?></a></li>
                                                <li><a href="#"><?php echo $this->lang->line('sub_menu_settings');?></a></li>
                                        </ul>
                                </li>

                                <!-- DROPDOWN MENU -->
                                <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('menu_maintenance');?> <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                                <li class="active"><a href="<? echo site_url('maintenance_controller/users'); ?>"><?php echo $this->lang->line('sub_menu_users');?></a>
                                        </ul>
                                </li>
                        </ul>
                        
                        <!-- RIGHT ALIGN -->
                        <ul class="nav navbar-nav navbar-right">
                                <?php 
                                if(empty($this->session->userdata('username'))){
                                ?>
                                        <li><a href="<? echo site_url('account_controller/login'); ?>"><?php echo $this->lang->line('menu_login');?></a></li>
                                <?php 
                                }
                                else{
                                ?>
                                        <li><a><span class="glyphicon glyphicon-user"></span>&nbsp;<?=$this->session->userdata('fullname');?></a></li>
                                        <li><a href="<? echo site_url('account_controller/logout'); ?>"><?php echo $this->lang->line('menu_logout');?></a></li>
                                <?php       
                                }
                                ?>
                                
                        </ul>
                </div>
        </div>
</nav>