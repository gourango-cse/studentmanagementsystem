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
        404 NOT FOUND!
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $this->uri->segment(1); ?></a></li>
        <li class="active">404 error</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="error-page" style="margin-top: 150px;">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! <?php echo $page_title;?>.</h3>
          <br>
          <p>
              We could not find the <?php if(isset($type)){echo $type;}else{ echo "page";} ?> you were looking for.
            Meanwhile, you may <a href="<?php echo base_url('home'); ?>">return to dashboard</a>.
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