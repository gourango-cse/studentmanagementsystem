<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */


?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Access Denied!
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $this->uri->segment(1); ?></a></li>
        <li class="active">Access Denied [<?php echo $warning; ?>]</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="error-page" style=" position: relative;margin-top: 150px;">
            <img class="image img-lg img-responsive" style=" position: absolute;margin-top: 0px;" src="<?php echo base_url();?>/uploads/access_denied.gif"/>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> You don't have permission to access this page!.</h3>
          <br>
          <?php if(isset($msg)){ ?>
          <p class="text-danger"><?php echo $msg; ?></p>
          <?php } else{?>
          <p>
              <strong>Visiting this page untill 10 times will banned your account. </strong>  If you think this is wrong than contact to system administrator. 
          </p>
          <?php } ?>
<!--          <form class="search-form">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                </button>
              </div>
            </div>
             /.input-group 
          </form>-->
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->