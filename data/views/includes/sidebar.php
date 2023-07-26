<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: Hotel Management NBPI
 *  Group: Ronash, Bikash, Dipendra, Sumit

*/


?><!-- Visit "codeastro.com" for more projects! -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>uploads/pro_pic/<?php echo  $this->session->userdata('pro_pic');  ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo  $this->session->userdata('full_name'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo  $this->session->userdata('role'); ?></a>
        </div>
      </div><!-- Visit "codeastro.com" for more projects! -->
<!--       search form 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-is_allowed" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

          <li>
          <a href="<?php echo base_url() ?>">
            <i class="fa fa-dashboard"></i> <span>Home</span>
          </a>
          </li>
        <li class="treeview">
          <a href="#">
          <i class="fa fa fa-graduation-cap"></i>
            <span>Student</span>
            <span class="label label-primary pull-right"></span>
            <i class="fa fa fa-angle-down pull-right"></i>
          </a>
          <ul class="treeview-menu">
             <?php if($this->sms->is_allowed('Admin')){
    
?><!-- Visit "codeastro.com" for more projects! -->
            <li><a href="<?php echo base_url() ?>student/add"><i class="fa fa-user-plus"></i> Add Student</a></li>
             <?php } ?>
            <li><a href="<?php echo base_url() ?>student/view"><i class="fa fa-info"></i> View Student</a></li>
        <?php    if($this->sms->is_allowed('Admin')){
    
?>
           <!--<li><a href="<?php //echo base_url() ?>student/promotion"><i class="fa fa-user-secret"></i> Student Promotions</a></li>-->
          <?php } ?>
         
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa fa-users"></i>
            <span>Teacher</span>
            <span class="label label-primary pull-right"></span>
            <i class="fa fa fa-angle-down pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php  if($this->sms->is_allowed('Admin')){
    
?>
            <li><a href="<?php echo base_url() ?>teacher/add"><i class="fa fa-user-plus"></i> Add Teacher</a></li>
            <?php } ?>
            <li><a href="<?php echo base_url() ?>teacher/view"><i class="fa fa-info"></i> View Teacher</a></li>
          
         <!-- Visit "codeastro.com" for more projects! -->
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa fa-user"></i>
            <span>Parents</span>
            <span class="label label-primary pull-right"></span>
            <i class="fa fa fa-angle-down pull-right"></i>
          </a>
          <ul class="treeview-menu">
              <?php if($this->sms->is_allowed('Admin')){
    
?>
            <li><a href="<?php echo base_url() ?>parent/add"><i class="fa fa-user-plus"></i> Add Parents</a></li>
              <?php } ?>
             <li><a href="<?php echo base_url() ?>parent/view"><i class="fa fa-info"></i> View Parents</a></li>
          </ul>
        </li>
        <?php if($this->sms->is_allowed('Admin')){
         
?>
               <li class="treeview">
          <a href="#">
            <i class="fa fa fa-th"></i>
            <span>Classroom</span>
            <span class="label label-primary pull-right"></span>
            <i class="fa fa fa-angle-down pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>class/manage"><i class="fa fa-building"></i>Manage Class</a></li>
            <li><a href="<?php echo base_url() ?>subject/manage"><i class="fa fa-building"></i>Manage Subjects</a></li>
           
            <li><a href="<?php echo base_url() ?>syllabus"><i class="fa fa-book"></i>Manage Syllabus</a></li>
            
         <!-- Visit "codeastro.com" for more projects! -->
          </ul>
        </li>
      
        
         <li class="treeview">
          <a href="#">
            <i class="fa fa fa-sticky-note"></i>
            <span>Exam Section</span>
            <span class="label label-primary pull-right"></span>
            <i class="fa fa fa-angle-down pull-right"></i>
          </a>
          <ul class="treeview-menu">
               <?php if($this->sms->is_allowed('Admin')){
         
?>
               <li><a href="<?php echo base_url() ?>exam/manage"><i class="fa fa-file"></i>Manage Exam</a></li>
               <?php } ?>
                <?php if($this->sms->is_allowed('Teacher')){
         
?>
               <li><a href="<?php echo base_url() ?>exam/insert_marks"><i class="fa fa-file"></i>Entry Marks</a></li>
               <?php } ?>
            <!-- <li><a href="<?php echo base_url() ?>exam/routine"><i class="fa fa-file"></i>Exam Routine</a></li>
            <li><a href="<?php echo base_url() ?>exam"><i class="fa fa-file"></i>View Result</a></li> -->
           
          
         <!-- Visit "codeastro.com" for more projects! -->
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-file"></i>
            <span>Exam Routine & Result</span>
            <span class="label label-primary pull-right"></span>
            <i class="fa fa fa-angle-down pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>exam/routine"><i class="fa fa-file"></i>Exam Routine</a></li>
            <li><a href="<?php echo base_url() ?>exam"><i class="fa fa-file"></i>View Result</a></li>
        
           
         
          </ul>
        </li>

         <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Education</span>
            <span class="label label-primary pull-right"></span>
            <i class="fa fa fa-angle-down pull-right"></i>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo base_url() ?>syllabus"><i class="fa fa-book"></i>Syllabus</a></li>
             <li><a href="<?php echo base_url() ?>study"><i class="fa fa-file-pdf-o"></i><span> Study Material</span></a></li>
        
           <!-- Visit "codeastro.com" for more projects! -->
         
          </ul>
        </li>
          <?php
        }else{
            ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa fa-th"></i>
            <span>Classroom</span>
            <span class="label label-primary pull-right"></span>
            <i class="fa fa fa-angle-down pull-right"></i>
          </a>
          <ul class="treeview-menu">
              <?php foreach ($this->sms_class->list_class() as $class_menu): ?>
            <li><a href="<?php echo base_url("class/".$class_menu->name); ?>"><i class="fa fa-building"></i><?php echo $class_menu->name;  ?></a></li>
            <?php endforeach; ?>
         
          </ul>
        </li>
        
        <?php
        }
          if($this->sms->is_allowed('Admin')){
         
?>
         <li class="treeview">
          <a href="#">
            <i class="fa fa fa-usd"></i>
            <span>Accounting Section</span>
            <span class="label label-primary pull-right"></span>
            <i class="fa fa fa-angle-down pull-right"></i>
          </a>
          <ul class="treeview-menu">
               <li><a href="<?php echo base_url() ?>account/manage"><i class="fa fa-credit-card"></i>Manage Fees</a></li>
            <li><a href="<?php echo base_url() ?>account/fees"><i class="fa fa-credit-card"></i>Fees Payment</a></li>
           
          <!-- Visit "codeastro.com" for more projects! -->
         
          </ul>
        </li>
          <?php } ?>
        
        <?php  if($this->sms->is_allowed('Admin')){
         
?>
         <li class="treeview">
          <a href="#">
            <i class="fa fa fa-newspaper-o"></i>
            <span>Library</span>
            <span class="label label-primary pull-right"></span>
            <i class="fa fa fa-angle-down pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>library/manage"><i class="fa fa-save"></i>Manage Library</a></li>
                   <li><a href="<?php echo base_url() ?>library"><i class="fa fa-book"></i><span> Library</span></a></li>

          
         
          </ul>
        </li>
          <?php }else{ ?>
        <li><a href="<?php echo base_url() ?>library"><i class="fa fa-newspaper-o"></i><span> Library</span></a></li>
          <?php } ?>
<!--        <li><a href="<?php echo base_url() ?>transport"><i class="fa fa-bus"></i><span> Transport</span></a></li>
        <li><a href="<?php echo base_url() ?>hostel"><i class="fa fa-building"></i><span> Hostel</span></a></li>-->
       
        <li><a href="<?php echo base_url() ?>notice"><i class="fa fa-bullhorn"></i><span> Notice Board</span></a></li>
        <li><a href="<?php echo base_url() ?>mail"><i class="fa fa-envelope"></i> <span> Message</span></a></li>
      
           
           
<!--        <li>
          <a href="../widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <small class="label pull-right bg-green">Hot</small>
          </a>
        </li>-->

     <!-- Visit "codeastro.com" for more projects! -->

      </ul>
     
    </section>
    <!-- /.sidebar -->
  </aside>
