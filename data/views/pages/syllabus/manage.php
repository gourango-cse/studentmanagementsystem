<?php
/* 
 *  @package		Kodstack
 *  Author:         Ronash Dhakal
 */

?>
<!-- Visit "codeastro.com" for more projects! -->
<section class="content-header" >
    <h1>
<?php echo $page_title; ?>
        <small><?php
        if (isset($page_slogan)) {
            echo $page_slogan;
        }
        ?></small>
    </h1><!-- Visit "codeastro.com" for more projects! -->
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a><i class="fa fa-user"></i> Manage Syllabus</a></li>

    </ol>
</section>
<section class="content container-fluid">
   	
  <div class="row">

        <div class="col-sm-12 col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#syllabus" data-toggle="tab">Syllabus</a></li>

                 
                   

                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="syllabus">
                        <!-- Post -->
                        <div class="row">
                            <div class="col-sm-4">
                                <div id="add_syllabus_form">
                                <?php 

                                   $this->load->view('pages/syllabus/part/add_form');
                                   ?>
                                </div>
                            </div>
                            <div class="col-sm-8">
                             
                                <div id="listSyllabus">
                                    <h3>Select Class and Subject to view syllabus.</h3>
                                </div>
                            </div>
                        </div>
                       
                        <!-- /.post -->

                    </div>

                   
  
                    </div>
             
              

                </div>
                <!-- /.tab-content -->
            </div>
        </div>

        </div>

    </div>
</section>

 
