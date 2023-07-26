<?php

/* 
 *  Project: School Managment System
 *  Team: Sandip Kumar And Gourango Mandal
 */


?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $this->uri->segment(1); ?></a></li>
        <li class="active">Under Construction</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="error-page" style=" position: relative;margin-top: 150px;">
            <img class="image img-lg img-responsive" style=" position: absolute;margin-top: 0px;" src="<?php echo base_url();?>/uploads/construction.gif"/>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> We Are Working On It!.</h3>
          <br>
          <p>
           <?php echo ucfirst($this->uri->segment(1)); ?> module will be available after finishing up the construction. Thank you! 
          </p>

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