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
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a><i class="fa fa-user"></i>Library</a></li>

    </ol>
</section>
<section class="content container-fluid">
   	
  <div class="row">

        <div class="col-sm-12 col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#manage_book" data-toggle="tab">Library Book</a></li>

                 
                   

                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="manage_book">
                        <!-- Post -->
                        <div class="row">
                            <div class="col-sm-4">
                                <div id="add_book_form">
                                <?php 

                                   $this->load->view('pages/library/part/add_form');
                                   ?>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div id="initial">
                                   <div class="box">
                                         <div id="initial">
             <table class="table table-hover table-bordered">
                 <tr>
                     <th>Name</th>
                     <th>Author</th>
                     <th>Publication</th>
                     <th>Subject</th>
                     <th>Class</th>
                 </tr>
                 <?php
foreach ($listall as $list) {
    ?>

    <tr>
        <td><?= $list->name; ?></td>
        <td><?= $list->author; ?></td>
        <td><?= $list->publication; ?></td>
              <td><?= $this->subject->get_subject($list->subject_id)->name; ?></td>
        <td><?= $this->sms_class->get_class($list->class_id)->name; ?></td>
    </tr>
    <?php
}
                  ?>
             </table>
         </div>
                                   </div>
                                </div>
                                <div id="listBooks"></div>
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

 
