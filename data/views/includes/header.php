<?php
/*
 *  Author: Ronash Dhakal
 *  Project: Hotel Management NBPI
 *  Group: Ronash, Bikash, Dipendra, Sumit
 */
?>
<script type="text/javascript">
  var  csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<header class="main-header">
    <!-- Logo --><!-- Visit "codeastro.com" for more projects! -->
    <a href="<?php echo base_url(); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">S<b>M</b>S</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg" style="font-size: 15px;">School Management System</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope"></i>
                        <span class="label label-danger" id="count_msg"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header" id="count_msg1"></li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu mail_notification">
                              <!-- Visit "codeastro.com" for more projects! -->
                               <?php 
                               
       $mails = $this->sms->list_pms(4,0,$this->session->userdata('id'));
       if($mails!=NULL){
       foreach ($mails as $mail) {
           $sender = $this->sms->get_user($mail->sender_id);
           echo' <li>
                                    <a href="mail">
                                        <div class="pull-left">
                                            <img src="'.base_url('uploads/pro_pic').'/'.$sender->pro_pic.'" class="img-circle" alt="User Image">
                                        </div>
                                        <h4>
                                            '.$sender->full_name.'
                                            <small><i class="fa fa-clock-o"></i> '.$mail->date_sent.'</small>
                                        </h4>
                                        <p>'.$mail->title.'</p>
                                    </a>
                                </li>';
       }
       }else{
          echo" <li>
                        You don't have any mail!
                                </li>";  
       }
                               ?>
                             
                                <!-- end message -->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                </li>
               
<!--                 Notifications: style can be found in dropdown.less 
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                             inner menu: contains the actual data 
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>-->
                <!-- Tasks: style can be found in dropdown.less -->
<!--                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 9 order request</li>
                        <li>
                             inner menu: contains the actual data 
                            <ul class="menu">
                                <li> Task item 
                                    <a href="#">
                                        <h3>
                                            Hotel yak and yeti
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                 end task item 
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all orders</a>
                        </li>
                    </ul>
                </li>-->
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url(); ?>uploads/pro_pic/<?php echo $this->session->userdata('pro_pic'); ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"> <?php echo $this->session->userdata('name'); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo base_url(); ?>uploads/pro_pic/<?php echo $this->session->userdata('pro_pic'); ?>" class="img-circle" alt="User Image">

                            <p>
                                <?php echo $this->session->userdata('full_name'); ?>
                                <small> Last session: <?php echo $this->session->userdata('last_login'); ?></small>
                            </p>
                        </li><!-- Visit "codeastro.com" for more projects! -->
                        <!-- Menu Body -->
<!--                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Users</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Groups</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Permissions</a>
                                </div>
                            </div>
                             /.row 
                        </li>-->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo base_url();
                               if($this->sms->is_member('Admin')){echo "admin/";} else if($this->sms->is_member('Teacher')){echo "teacher/";}else if($this->sms->is_member("Student")){echo "student/";}else if ($this->sms->is_member("Parent")){echo "parent/";}
                               echo $this->session->userdata('name');
                                ?>" class="btn btn-github btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url(); ?>logout" class="btn btn-danger btn-flat">Log out</a>
                            </div>
                        </li>
                    </ul>
                </li>
<!--                 Control Sidebar Toggle Button 
                <li>
                   
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>-->
            </ul>
        </div>
    </nav>
</header>

<!-- Visit "codeastro.com" for more projects! -->

