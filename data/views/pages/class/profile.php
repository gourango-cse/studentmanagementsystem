<?php
/*
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
$ct = $this->sms_class->get_class_teacher($profile->teacher_id);
?>
<!-- Visit "codeastro.com" for more projects! -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
<?php echo $page_title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('class'); ?>"><i class="fa fa-user-md"></i> Class</a></li>
        <li class="active">  <?php echo $profile->name; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
       <div class="col-md-3">
            <?php if ($ct!='N/A'){?>
             <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="  <?php echo base_url('uploads/pro_pic/'.$ct->pro_pic); ?>" alt="  <?php echo $profile->full_name; ?> profile picture">

              <h3 class="profile-username text-center"><?php echo $ct->full_name; ?></h3>

              <p class="text-muted text-center">Class <?php echo $ct->role; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo $ct->email; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Contact</b> <a class="pull-right"><?php echo $ct->contact; ?></a>
                </li>
                <li class="list-group-item">
                  <b>DOB</b> <a class="pull-right"><?php echo $ct->dob; ?></a>
                </li>
              </ul>
               <?php if($this->sms->is_admin()){
                   if(!$this->sms->is_banned($ct->id)){
                   ?>
              <button class="btn btn-danger btn-block" onclick="javascript:remove_class_teacher('<?php echo $this->encrypt->encode( $ct->id) ?>')">Remove From Class Teacher</button>
             
               <?php }else{ 
                   if($profile->verification_code !=NULL){ ?>
              <button class="btn btn-primary btn-block" onclick="javascript:resend_code('<?php echo $this->encrypt->encode( $ct->id)?>')">Inactive Profile </button>
             
               <?php  } else{?>
               <button class="btn btn-primary btn-block" onclick="javascript:unBanUser('<?php echo $this->encrypt->encode( $ct->id) ?>')">Unban User ?></button>
              
               <?php } }}else{ ?>
                <a href="#change_image_tab" data-toggle="tab" class="btn btn-primary btn-block"><b>Send Message</b></a>
                  <?php } ?>
            </div><!-- Visit "codeastro.com" for more projects! -->
            <!-- /.box-body -->
          </div>
            <?php }else{?>
              <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fa fa-graduation-cap"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Class Teacher</span>
                    <span class="info-box-number"><?php
        //echo $profile->teacher_id;
        echo $this->sms_class->get_class_teacher($profile->teacher_id);
?> </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <?php  }?>
           
           
        </div><!-- Visit "codeastro.com" for more projects! -->
       
        <!-- /.col -->
        <div class="col-md-<?php if($this->sms->is_member('Admin')){echo "6";}else{echo "9";} ?>">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">Home</a></li>

                    <li><a href="#subjects" data-toggle="tab">Subjects</a></li>
<?php if ($this->sms->is_member("Admin")) : ?>
                        <li><a href="#add_section" data-toggle="tab">Add Section</a></li>
                  
<?php endif; ?>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="home">
                        <!-- Post -->
                        <div class="row">
                            <div class="col-md-12">
                                <div id="view_class_summary_box"></div>
                            </div>
                            <div class="col-md-6">

                            </div>

                        </div>

                        <!-- /.post -->

                    </div>

                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="subjects">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th class="text-center">Subject</th>
                                <th class="text-center">Teacher</th>
                                
                            </tr>
                            <?php if($this->subject->list_subject($profile->id)!=FALSE){
     foreach ($this->subject->list_subject($profile->id) as $subs){
         echo"<tr>";
         echo "<td class='text-center'>".$subs->name."</td>";
         if($subs->teacher_id!=NULL AND $subs->teacher_id!=0){
              echo "<td class='text-center'>".$this->sms->get_user($subs->teacher_id)->full_name."</td>";
         }else{
             echo "<td class='text-center'>N/A</td>";
         }
         echo '</tr>';     
                  
     }
                            } ?>
                            
                        </table>

                    </div>
                    <!-- /.tab-pane -->
<?php if($this->sms->is_member('Admin')){ ?>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="add_section">

                        <div id="add_section_box"></div>

                    </div>
<?php } ?>
                 


                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <?php if($this->sms->is_member('Admin')): ?>
        <div class="col-md-3">
             <div id="assign_section_teacher_box"></div>
        </div>
        <?php endif; ?>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->

<script type="text/javascript">
     $( document ).ready(function() {
   view_class_summary_box();
   <?php if($this->sms->is_member('Admin')): ?>
   assign_section_teacher_box();
   add_section_box();
    <?php     endif; ?>
});
function view_class_summary_box(){
   
      $.ajax({
            url: '<?php echo base_url("class/views/view_class_summary_box") ?>',
            type: 'post',
            data: {id:"<?php echo $profile->name; ?>",csrf:csrf_token},
            dataType: 'text',
            success: function (response) {
                  $( "#view_class_summary_box" ).empty( response );
         $( "#view_class_summary_box" ).html( response );
            }
        });
       
}
<?php if($this->sms->is_member('Admin')): ?>
function add_section_box(){
     $.ajax({
            url: "<?php echo base_url("class/views/add_section_box") ?>",
            type: 'post',
            data: {class_id:"<?php echo $profile->id; ?>",csrf:csrf_token},
            dataType: 'text',
            success: function (data) {
               
                   $( "#add_section_box" ).empty( data );
         $( "#add_section_box" ).html( data );
            }
        });
    
}
function assign_section_teacher_box(){
     
      $.ajax({
            url: "<?php echo base_url("class/views/assign_section_teacher_box") ?>",
            type: 'post',
            data: {class_id:"<?php echo $profile->id; ?>",csrf:csrf_token},
            dataType: 'text',
            success: function (data) {
               
                   $( "#assign_section_teacher_box" ).empty( data );
         $( "#assign_section_teacher_box" ).html( data );
            }
        });
     
}

 <?php     endif; ?>
   
</script><!-- Visit "codeastro.com" for more projects! -->