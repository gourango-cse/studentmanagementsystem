<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */


?><!-- Visit "codeastro.com" for more projects! -->
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
  <?php echo $page_title; ?>
      </h1>
      <ol class="breadcrumb">
          <li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('student'); ?>"><i class="fa fa-user-md"></i> Student</a></li>
        <li class="active">  <?php echo $profile->full_name."'s"; ?> profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
       <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="  <?php echo base_url('uploads/pro_pic/'.$profile->pro_pic); ?>" alt="  <?php echo $profile->full_name; ?> profile picture">

              <h3 class="profile-username text-center"><?php echo $profile->full_name; ?></h3>

              <p class="text-muted text-center"><?php echo $profile->role; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo $profile->email; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Contact</b> <a class="pull-right"><?php echo $profile->contact; ?></a>
                </li>
                <li class="list-group-item">
                  <b>DOB</b> <a class="pull-right"><?php echo $profile->dob; ?></a>
                </li>
              </ul><!-- Visit "codeastro.com" for more projects! -->
               <?php if($this->sms->is_admin()){
                   if(!$this->sms->is_banned($profile->id)){
                   ?>
              <button class="btn btn-danger btn-block" onclick="javascript:banUser('<?php echo $this->encrypt->encode( $profile->id) ?>')">Suspend <?php echo $profile->name; ?></button>
             
               <?php }else{ 
                   if($profile->verification_code !=NULL){ ?>
              <button class="btn btn-primary btn-block" onclick="javascript:resend_code('<?php echo $this->encrypt->encode( $profile->id)?>')">Inactive Profile </button>
             
               <?php  } else{?>
               <button class="btn btn-primary btn-block" onclick="javascript:unBanUser('<?php echo $this->encrypt->encode( $profile->id) ?>')">Unban User ?></button>
              
               <?php } }}else{ ?>
                <a href="#change_image_tab" data-toggle="tab" class="btn btn-primary btn-block"><b>Change Image</b></a>
                  <?php } ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div><!-- Visit "codeastro.com" for more projects! -->
        <!-- /.col -->
        <div class="col-md-6">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Home</a></li>
                <li><a href="#information" data-toggle="tab">Information</a></li>
             <?php if($this->sms->is_admin() OR $profile->id==$this->session->userdata('id')): ?>
              <li><a href="#change_password_tab" data-toggle="tab">Change Password</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
              <?php endif; ?>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
            
                <!-- /.post -->

              </div><!-- Visit "codeastro.com" for more projects! -->
                
                 <!-- /.tab-pane -->
                  <div class="tab-pane" id="information">
               
                      <table class="table table-hover table-bordered">
                          <tr>
                              <th>Name:</th><td><?php echo $profile->full_name; ?></td>
                          </tr>
                           <tr>
                              <th>Parent Name:</th><td><?php echo $profile->parent_id; ?></td>
                          </tr>
                           <tr>
                              <th>Gender:</th><td><?php echo $profile->gender; ?></td>
                          </tr>
                          <tr>
                              <th>Transport:</th><td><?php if($profile->transport_id !=0) { echo $profile->transport_id;} else{ echo  "N/A";}?></td>
                          </tr>
                           <tr>
                              <th>Hostel:</th><td><?php if($profile->hostel_id !=0) { echo $profile->hostel_id;} else{ echo  "N/A";}?></td>
                          </tr>
                          <?php if($this->sms->is_admin() OR $profile->id==$this->session->userdata('id')): ?>
                          <tr>
                              <th>Last Login:</th><td><?php echo $profile->last_login; ?></td>
                          </tr><!-- Visit "codeastro.com" for more projects! -->
                           <tr>
                              <th>Last Activity:</th><td><?php echo $profile->last_activity; ?></td>
                          </tr> 
                          <tr>
                              <th>Last Login Attempt:</th><td><?php echo $profile->last_login_attempt; ?></td>
                          </tr>
                           <tr>
                              <th>Remember Time:</th><td><?php echo $profile->remember_time; ?></td>
                          </tr>
                           <tr>
                              <th>Remember Expire:</th><td><?php echo $profile->remember_exp; ?></td>
                          </tr>
                           <tr>
                              <th>IP Address:</th><td><?php echo $profile->ip_address; ?></td>
                          </tr>
                           <tr>
                              <th>Login Attempts:</th><td><?php echo $profile->login_attempts; ?></td>
                          </tr>
                          <?php endif; ?>
                      </table>
              </div>
              <!-- Visit "codeastro.com" for more projects! -->
              <!-- /.tab-pane -->
                
               <?php if($this->sms->is_admin() OR $profile->id==$this->session->userdata('id')): ?>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="change_password_tab">
                <!-- The timeline -->
            <div class="well">
                      
                      <form class="form-horizontal" id="change_password" name="change_password" method="post">
                          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                  <div class="form-group">
                    <label for="new_password" class="col-sm-4 control-label">New Password</label>

                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="new_password" id="new_password" placeholder="**********">
                    </div>
                  </div>
                      <div class="form-group">
                    <label for="confirm_password" class="col-sm-4 control-label">Confirm Password</label>

                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="**********">
                    </div>
                  </div>
                      <div class="form-group">
                    <label for="password" class="col-sm-4 control-label">Recent Password</label>

                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" id="password" placeholder="**********">
                    </div>
                  </div>
                      <input type="hidden" name="user_id"value="<?php echo $this->encrypt->encode( $profile->id) ?>">
                  <div class="form-group">
                      <div class="col-sm-4"> </div>
                    <div class=" col-sm-8 ">
                        
                      <button type="submit" class="btn btn-danger">Change Password</button>
                    </div>
                       
                  </div>
                </form>
                       <script type="text/javascript">
                      $('#change_password').submit(function (e){
                      e.preventDefault();
        var formData = new FormData($(this)[0]);
       var frm = document.getElementsByName('change_password')[0];
      
        $.ajax({
            url: '<?php echo base_url('student/edit/'.$profile->id."/change_password") ?>',
            type: 'post',
            data: formData,
            dataType: 'json',
             async: true,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                     beforeSend: function(){
            $('.loader').fadeIn("slow");
        },
            success: function (response) {
                $('.loader').fadeOut("slow");
                if (response.success == true) {
                        
                     $.notify("Password Changed", "success");
                
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                    frm.reset();
                    //formData.reset();
                    

                } else {
                    
                    
                       $.each(response.msg, function (key, value) {
                        var element = $('#' + key);
                        element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger').remove();
                        element.after(value);

                    });
                    
                }
            }
        });

                      });
                              </script>
                  </div>
                  
              </div>
              <!-- /.tab-pane -->
              

              <div class="tab-pane" id="settings">
                    
                
                  <div class="well">
                      <form class="form-horizontal" name="update_profile" id="update_profile" method="post">
                          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                  <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo $profile->name; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" id="email" placeholder="<?php echo $profile->email; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="contact" class="col-sm-2 control-label">Contact</label>

                    <div class="col-sm-10">
                         <input type="text" name="contact" id="contact"  class="form-control" data-inputmask="&quot;mask&quot;: &quot;+(999) 9999-99999[9]&quot;" data-mask="" placeholder="<?php echo $profile->contact; ?>"
                                 >
                      <!-- Visit "codeastro.com" for more projects! -->
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="address"  class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                        <input type="text" name="address" class="form-control" id="address" value="<?php echo $profile->address; ?>">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                        <input type="password" name="rpassword" class="form-control" id="rpassword" placeholder="********">
                        <input type="hidden" name="user_id" value="<?php echo $this->encrypt->encode( $profile->id); ?>">
                    </div>
                  </div>
                
                  <div class="form-group">
                      <div class="col-sm-2"> </div>
                    <div class=" col-sm-10 ">
                        
                      <button type="submit" class="btn btn-danger">update</button>
                    </div>
                       
                  </div>
                </form>
                         <script type="text/javascript">
                      $('#update_profile').submit(function (f){
                      f.preventDefault();
        var formData = new FormData($(this)[0]);
       var frm = document.getElementsByName('update_profile')[0];
      
        $.ajax({
            url: '<?php echo base_url('student/edit/'.$profile->id."/update") ?>',
            type: 'post',
            data: formData,
            dataType: 'json',
             async: true,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                     beforeSend: function(){
            $('.loader').fadeIn("slow");
        },
            success: function (response) {
                $('.loader').fadeOut("slow");
                if (response.success == true) {
                        
                     $.notify("profile Updated", "success");
                
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                    frm.reset();
                    //formData.reset();
                 

                } else {
                    
                    
                       $.each(response.msg, function (key, value) {
                        var element = $('#' + key);
                        element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger').remove();
                        element.after(value);

                    });
                    
                }
            }
        });

                      });
                              </script>
                  </div>
                
                 
              </div>
              <!-- /.tab-pane -->
              <?php endif; ?>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        
         <div class="col-md-3">


          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
                <?php if($this->session->userdata('id')==$profile->id){ ?>
              <h3 class="box-title">About Me</h3>
                <?php } else{ ?>
               <h3 class="box-title">About <?php echo $profile->full_name; ?></h3>
                <?php } ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

            
              <table class="table table-hover table-bordered">
                  <tr>
                      <th>Class</th><th>Section</th><th>Roll</th>
                  </tr>
                  <tr>
                      <td><?php echo $this->sms_class->get_class_name_by_id($profile->class_id); ?></td><td><?php echo $this->sms_class->get_section_name_by_id($profile->section_id); ?></td><td><?php echo $profile->roll; ?></td>
                  </tr>
              </table>
                
             

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?php echo $profile->address; ?></p>

<!-- Visit "codeastro.com" for more projects! -->
     <hr>

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content --><!-- Visit "codeastro.com" for more projects! -->