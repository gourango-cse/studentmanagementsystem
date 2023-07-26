<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (count($feeds)==0) {
    echo "<div class='alert alert-warning text-white'>Selected subject does not have any materials!!<div>";
}
foreach ($feeds as $feed){
?>
<!-- Visit "codeastro.com" for more projects! -->
<div id="material<?= $feed->id; ?>" class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                  <img class="img-circle" src="<?php echo base_url() ?>uploads/pro_pic/<?= $this->sms->get_user($feed->user_id)->pro_pic; ?>" alt="User Image">
                  <span class="username"><a href="<?php if(!$this->sms->is_admin()){ echo base_url("student/").$this->sms->get_user($feed->user_id)->name;} ?>"><?= $this->sms->get_user($feed->user_id)->full_name; ?></a></span>
                <span class="description"><?php echo $this->sms->get_user($feed->user_id)->role; ?> - <?= $feed->created_at; ?></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                  <?php if($this->sms->is_allowed('Teacher')){ ?>
                <button type="button" onclick="delMaterial(<?= $feed->id; ?>,'<?= $feed->file; ?>')" class="btn btn-box-tool" data-toggle="tooltip" title="Delete Post">
                  <i class="fa fa-circle-o"></i></button>
                  <?php } ?>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                  <button type="button"  class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->
              <?= $feed->detail; ?>

<hr/>
              <!-- Attachment -->
              <div class="attachment-block clearfix">
               
       <img class="attachment-img" src="<?= base_url('uploads/materials/'.$feed->file) ?>" alt="Attachment File">
        
               

                <div class="attachment-pushed">
                  <h4 class="attachment-heading">Subject: <?= $this->subject->get_subject($feed->subject_id)->name;  ?></h4>
                   
                  <div class="attachment-text">
                      <p><?= $feed->name; ?></p>
                  </div>
                  <!-- /.attachment-text -->
                </div>
                <!-- /.attachment-pushed -->
              </div>
              <!-- /.attachment-block -->

              <!-- Social sharing buttons -->
<!--              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-flag-o"></i> Report</button>-->
              <button id="optionIt<?= $feed->id; ?>" type="button" class="btn btn-danger"  onclick="downloadIt(<?php echo $feed->id; ?>,<?php echo $feed->count; ?>,'<?php echo $feed->file; ?>')"><i class="fa fa-download"></i> Download</button>
              <span class="pull-right text-muted">Total Downloads (<i id='countIt<?= $feed->id; ?>'><?= $feed->count; ?></i>)</span>
            </div>
<!--             /.box-body 
            <div class="box-footer box-comments">
              <div class="box-comment">
                 User image 
                <img class="img-circle img-sm" src="<?php //echo base_url() ?>assets/dist/img/user3-128x128.jpg" alt="User Image">

                <div class="comment-text">
                      <span class="username">
                        Maria Gonzales
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span> /.username 
                  It is a long established fact that a reader will be distracted
                  by the readable content of a page when looking at its layout.
                </div>
                 /.comment-text 
              </div>
               /.box-comment 
              <div class="box-comment">
                 User image 
                <img class="img-circle img-sm" src="<?php //echo base_url() ?>assets/dist/img/user5-128x128.jpg" alt="User Image">

                <div class="comment-text">
                      <span class="username">
                        Nora Havisham
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span> /.username 
                  The point of using Lorem Ipsum is that it has a more-or-less
                  normal distribution of letters, as opposed to using
                  'Content here, content here', making it look like readable English.
                </div>
                 /.comment-text 
              </div>
               /.box-comment 
            </div>
             /.box-footer -->
<!--            <div class="box-footer">
              <form action="#" method="post">
                <img class="img-responsive img-circle img-sm" src="<?php echo base_url() ?>assets/dist/img/user4-128x128.jpg" alt="Alt Text">
                 .img-push is used to add margin to elements next to floating images 
                <div class="img-push">
                  <input class="form-control input-sm" placeholder="Press enter to post comment" type="text">
                </div>
              </form>
            </div>-->
            <!-- /.box-footer -->
          </div>

<?php }?>
<!-- Visit "codeastro.com" for more projects! -->

