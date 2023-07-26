<?php

//Visit "codeastro.com" for more projects!

?>
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $page_title; ?>
        <small><?php if(isset($page_slogan)){ echo $page_slogan;} ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
       
      </ol>
    </section>

    <!-- Main content -->
    <section class="content"><!-- Visit "codeastro.com" for more projects! -->
          <div class="row">
               <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fa fa-play"></i></span>

            <div class="info-box-content">
               <div class="form-group">
                <label>Running Session</label>
                <select id="select2" class="form-control select2 select2-hidden-accessible view_session" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    <option selected  disabled>(<?php echo $running_session;?>)</option>
                    <optgroup>                   
 <?php 
                  foreach($list_sessions as $session){
                       if( $running_session ==$session->session){
                           $c = " Recent";
                       }else{
                           $c = NULL;
                       }
                   echo '<option  value="'.$session->id.'">'.$session->session.$c.'</option>';
      }
                 ?>
                    </optgroup>
                </select>
               </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- Visit "codeastro.com" for more projects! -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-olive"><i class="fa fa-graduation-cap"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Student</span>
              <span class="info-box-number"><?php echo $this->student->count(); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-maroon"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Teacher</span>
              <span class="info-box-number"><?php echo $this->teacher->count(); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
           <span class="info-box-icon bg-orange"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Parents</span>
              <span class="info-box-number"><?php echo $this->parents->count(); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
      </div>

      <!-- Visit "codeastro.com" for more projects! -->

      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Today's Attendance</span>
              <span class="info-box-number"><?php $query = $this->db->query('SELECT * FROM sms_attendance WHERE dt = CURDATE()'); echo $query->num_rows();?> / <?php $query = $this->db->query('SELECT * FROM sms_users WHERE role = "Student"'); echo $query->num_rows();?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-sticky-note"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Exams</span>
              <span class="info-box-number"><?php $query = $this->db->query('SELECT * FROM sms_exam_type'); echo $query->num_rows();?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-teal"><i class="fa fa-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Study Materials</span>
              <span class="info-box-number"><?php $query = $this->db->query('SELECT * FROM sms_studymaterial'); echo $query->num_rows();?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <?php if($this->sms->is_allowed('Admin')){
          ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-usd"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Fees Collected</span>
              <span class="info-box-number">$<?php $query = $this->db->query('SELECT SUM( amount)as total FROM sms_account_monthly_payment')->row(); echo floatval($query->total);?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <?php }?>

          <!-- Visit "codeastro.com" for more projects! -->

      </div>
        
        <!-- Notice -->
        <!-- <div class="row container-fluid">
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Notice</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
             
            </div>
           
            <div class="box-body">
              Notice detail.
            </div>
           
          </div>
          
        </div> -->
        
        <div class="row">
            
             <div class=" col-sm-8 col-xs-12">
              
                <div class="box box-primary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
                    <div class="server_msg" ></div>
                    <form name="quick_mail1" action="<?php echo base_url('mail/send'); ?>" id="quick_mail1" method="post">
                         <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                   
                        <div class="box-body">
               <!-- Visit "codeastro.com" for more projects! -->
                <div class="form-group has-feedback ">
                  <input type="text" class="form-control" name="receiver_id" placeholder="Msg to:">
                <div id="receiver_id"></div>
                </div>
                <div class="form-group has-feedback">
                  <input type="text" class="form-control " name="title" placeholder="Subject">
                <div id="title"></div>
                </div>
                <div class="form-group">
                    <textarea type="text" id="quick_msg" class="form-control" name="mesage" placeholder="message"></textarea>
                    <div id="message"></div>
                </div>
            
            </div>
            <div class="box-footer clearfix">
              
              <button type="submit" class="pull-right btn btn-success" id="sendEmail" >Send
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
                      </form>
          </div> 
            </div>
            
            <div class=" col-sm-4 col-xs-12">
           
               <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-purple">
              <div class="widget-user-image">
                  <img class="img-circle" src="<?php echo base_url(); ?>uploads/pro_pic/<?php echo  $this->session->userdata('pro_pic'); ?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?php echo  $this->session->userdata('full_name'); ?></h3>
              <h5 class="widget-user-desc"><?php echo  $this->session->userdata('role'); ?></h5>
            </div>
            <?php  if($this->sms->is_allowed('Admin')){
    
              ?>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="syllabus">Syllabus</a></li>
                <li><a href="exam">Examination Result</a></li>
                <li><a href="account/manage">Accounting Department</a></li>
                <li><a href="class/manage">Class Management</a></li>
                <li><a href="study">Study Material</a></li>
                <li><a href="library/manage">Library</a></li>
              </ul>
            </div>
            <?php } ?>
          </div>
                  <!-- Visit "codeastro.com" for more projects! -->
<!--                <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Activity</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
             /.box-header 
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <li class="item">
                  <div class="product-img">
                    <img src="dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Samsung TV
                      <span class="label label-warning pull-right">$1800</span></a>
                        <span class="product-description">
                          Samsung 32" 1080p 60Hz LED Smart HDTV.
                        </span>
                  </div>
                </li>
                 /.item 
                <li class="item">
                  <div class="product-img">
                    <img src="dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Bicycle
                      <span class="label label-info pull-right">$700</span></a>
                        <span class="product-description">
                          26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                        </span>
                  </div>
                </li>
                 /.item 
                <li class="item">
                  <div class="product-img">
                    <img src="dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>
                        <span class="product-description">
                          Xbox One Console Bundle with Halo Master Chief Collection.
                        </span>
                  </div>
                </li>
                 /.item 
                <li class="item">
                  <div class="product-img">
                    <img src="dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">PlayStation 4
                      <span class="label label-success pull-right">$399</span></a>
                        <span class="product-description">
                          PlayStation 4 500GB Console (PS4)
                        </span>
                  </div>
                </li>
                 /.item 
              </ul>
            </div>
             /.box-body 
            <div class="box-footer text-center">
              <a href="javascript:void(0)" class="uppercase">View All Products</a>
            </div>
             /.box-footer 
          </div>-->
            </div>
            
           
              <!-- Visit "codeastro.com" for more projects! -->
        </div>
    </section>
    <script type="text/javascript">
        $('#quick_mail').submit(function (e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
       var frm = document.getElementsByName('quick_mail')[0];
     
        $.ajax({
            url: '<?php echo base_url('message/send'); ?>',
            type: 'post',
            data: formData,
            dataType: 'json',
             async: false,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
            success: function (response) {
               
                if (response.success == true) {
                     $.notify("Successfully Send", "success");
                   
                   // $('#the-message').fadeIn('slow');
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                    frm.reset();
                   
                    

                } else {
                    
                       $('.server_msg').html(response.server_msg);
                    $.each(response.msg, function (key, value) {
                        var element = $('#' + key);
                        element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger').remove();
                        element.after(value);

                    });
                    $.notify("Message sending failed", "error");
                }
            }
        });

    });
        </script>
        <!-- Visit "codeastro.com" for more projects! -->