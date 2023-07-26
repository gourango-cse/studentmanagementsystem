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
        <li><a href="<?php echo base_url('class/'); ?>"><i class="fa fa-user-md"></i> Class</a></li>
                <li><a href="<?php echo base_url('class/'.$this->uri->segment(2)); ?>"><i class="fa fa-user-md"></i> <?php echo $this->uri->segment(2); ?></a></li>
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

              <p class="text-muted text-center">Section <?php echo $ct->role; ?></p>

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
           
                <a href="#change_image_tab" data-toggle="tab" class="btn btn-primary btn-block"><b>Send Message</b></a>
                <!-- Visit "codeastro.com" for more projects! -->
            </div>
            <!-- /.box-body -->
          </div>
            <?php }else{?>
              <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fa fa-user"></i></span>

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
            
         


        </div>
        <!-- /.col -->
        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                     <li class="active"><a href="#home" data-toggle="tab">Feeds</a></li>
                             <li class=""><a href="#newMaterial" data-toggle="tab">Add Study Material</a></li>
                    <li class=""><a href="#student" data-toggle="tab">Student</a></li>

                
<?php if ($this->sms_class->is_section_teacher($this->sms->get_user()->id) OR $this->sms->is_admin()) {
    ?>
                  
                   
                    <li><a href="#attendance" data-toggle="tab">Attendance</a></li>
                       
<?php }?>
                </ul>
                
                
                <!-- Visit "codeastro.com" for more projects! -->
                
                
                <div class="tab-content">
                     <div class="active tab-pane" id="home">
                       
                         <h5 id='feedinfo'>Choose subject to view their feeds.</h5>
                         <div id='subjectFeeds'></div>
                    </div>
                    <div class=" tab-pane" id="newMaterial">
                        
                          <?php
                        $this->load->view('pages/class/postMaterial');
                        ?>
                    </div>
                    
                    <div class=" tab-pane" id="student">
                        <!-- Post -->
                        <div class="row">
                          
                            <div class="col-md-12">
                                <table  class="table table-hover table-bordered">
                                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Full Name</th>
                     
                        <th>Roll</th>
                     
                     
                       
                    </tr>
                </thead>
                <tbody >
                    <?php $list_student = $this->student->list_student($session = TRUE, $class->id, $profile->id, $roll = FALSE, $parent = FALSE, $transport = FALSE, $hostel = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = TRUE);
                  if($list_student!=FALSE){
                      foreach ($list_student as $list) {
                          echo '<tr>';
                        echo '<td> ';
                           echo '<img style="width:50px;" src="'.base_url('uploads/pro_pic/').'/'.$list->pro_pic.'"/> ';
                       
                           echo'</td>';
                     echo '<td>'.$list->full_name.'</td>';  
         
                    
                         echo '<td>'.$list->roll.'</td>';
                      
                          echo '<td>';
                          
                        
                         echo '</td>';
                         
                 echo '</tr>';
                      }
                  }
                    ?>
                    
                    
                </tbody>
               
                                </table>
                               
                            </div>
                           

                        </div>

                        <!-- /.post -->

                    </div>

                    <!-- /.tab-pane -->
                  
<?php if ($this->sms_class->is_section_teacher($this->sms->get_user()->id) OR $this->sms->is_admin()) {
    ?>
                       
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="attendance">
  <h4 class="text-center"> Today: <?= date("d") ?> <?=  date('M')?> <?=  date('Y')?>  </h4>
  <br/>
                        <div class="row ">
                          
                            <div class="col-sm-12 col-md-6">
                                      Total Number of Student: <b><?= count($list_student); ?> </b> 
                            
                                 
                            </div>
                             <div class="col-sm-12 col-md-6">
                            Total Number of Present Student: <b><?= $totalStudents ?> </b> 
                            </div>
                        </div>
                           <?php if($totalStudents==0 AND count($list_student)>0){ ?>
                                <form action="<?php echo base_url(); ?>class/attendance"  id="attend" method="post" accept-charset="utf-8">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                   
                                    <table class="table table-hover table-bordered">
                                        <tr>
                                            <th>Student</th>
                                            <th class="text-center">Roll Num.</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                           <?php 
                  if($list_student!=FALSE){
                      foreach ($list_student as $std) {
                  
                   
                    ?>
                                        <tr>
                                            <td ><?= $std->full_name;  ?></td>
                                            <td class="text-center"><?= $std->roll; ?></td>
                                         
                                            <td class="text-center" id='status<?= $std->student_id?>'>
                                           
                                                <input class="icheck" id='attendance' type="checkbox" value="<?= $std->id; ?>" name="attendance[]"/>
                                                <input type="hidden" value="<?= $class->id ?>" name="class_id"/>
                                                  <input type="hidden" value="<?= $profile->id ?>" name="section_id"/>
                                            </td>
                                           
                                        </tr>
                  <?php }} ?>
                                       
                                    </table>
                                            
                             

                                
                                         <button  onclick="return confirm('Are you sure to save todays attendace? If any student are left then it cannot be modified once it saved also attendance is done once a day. If you attend only one student and hit save then you cannot able to do others. So be carefull while saving it. ');" type="submit" name="post" class="btn btn-success" >Save Attendance</button>
                                 

                                </form>

                           <?php } ?>
                         

                        <!-- Visit "codeastro.com" for more projects! -->
                    

                    </div>

<script>
 $('#attend').submit(function (e) {
        e.preventDefault();
        var me = $(this);

        $.ajax({
            url: me.attr('action'),
            type: 'post',
            data: me.serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    me[0].reset();
                
                    $.notify("Today's Attendance Complete", "success");
                    setTimeout(function() {
                        window.location="<?= base_url()."class/".$class->name."/".$profile->name ?>";
                    }, 2500);
                       
                }
            }
        });

    });
</script>
                       
<?php }?>

                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>

        <div class="col-md-3">
            <div class="box">
                 <div class="box-header bg-olive">
                     <h4 class="text-center"> Subjects</h4>

                </div>
                <div class="box-body">
                     <table class="table table-hover table-bordered">
                            <tr>
                                <th class="text-center">Subject</th>
                                <th class="text-center">Teacher</th>
                                
                            </tr>
                            <?php if($this->subject->list_subject($class->id)!=FALSE){
     foreach ($this->subject->list_subject($class->id) as $subs){
         echo"<tr>";
         echo "<td class='text-center'><a href='#".$subs->name."' onclick='show(".$subs->id.",".$class->id.",".$profile->id.")' >".$subs->name."</a></td>";
         if($subs->teacher_id!=NULL AND $subs->teacher_id!=0){
              echo "<td class='text-center'>".$this->sms->get_user($subs->teacher_id)->full_name."</td>";
         }else{
             echo "<td class='text-center'>N/A</td>";
         }
         echo '</tr>';     
                  
     }
                            } ?>
                            
                        </table>
                </div><!-- Visit "codeastro.com" for more projects! -->
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->

<script type="text/javascript">
   
   function show(id,clas,profile){
         $.ajax({
            url: "<?= base_url("study/home/view")?>",
            type: 'post',
            data: { id:id,clas:clas, profile:profile, csrf: csrf_token },
            dataType: 'text',
            success: function (response) {
                
            $("#subjectFeeds").empty();
            if(response!=''){
                  $("#feedinfo").fadeOut("slow");
              $("#subjectFeeds").append(response);
            
        }else{
            $("#feedinfo").fadeIn("slow");
            $("#feedinfo").empty();
            $("#feedinfo").append("<div class='alert alert-warning text-white'>Selected subject does not have any materials<div>");
            }
        }
        });
   }

    $('#add_class').submit(function (e) {
        e.preventDefault();
        var me = $(this);

        $.ajax({
            url: me.attr('action'),
            type: 'post',
            data: me.serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {

                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                    me[0].reset();
                    $.notify("Validation Success", "success");

                } else {

                    $.each(response.msg, function (key, value) {
                        var element = $('#' + key);
                        element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger').remove();
                        element.after(value);



                    });
                    $.notify("Validation Failed", "error");
                }
            }
        });

    });

    $('#add_section_post').submit(function (f) {
        f.preventDefault();
        var me1 = $(this);

        $.ajax({
            url: me1.attr('action'),
            type: 'post',
            data: me1.serialize(),
            dataType: 'json',
            success: function (response) {
            
                if (response.success == true) {

                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                    me1[0].reset();
                    $.notify("Validation Success", "success");

                } else {

                    $.each(response.msg, function (key, value) {
                        var element = $('#' + key);
                        element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger').remove();
                        element.after(value);



                    });
                    $.notify("Validation Failed", "error");
                }
            }
        });

    });
</script>


<script>
    function downloadIt(id,count,file){
      
  window.location="<?php echo base_url(); ?>study/download/"+id+"/"+file;
  var iCount = count+1;

 

//   $('#optionIt'+id).empty();
   $('#countIt'+id).empty();
    $('#countIt'+id).append(iCount);
//  $('#optionIt'+id).append('<button onclick="downloadIt('+id+','+iCount+',&#34;'+file+'&#34;)"  class="btn btn-default btn-xs"  ><i class="fa fa-download"></i> Download</button>');
   }
    
</script>
 <?php if($this->sms->is_allowed("Teacher")){ ?>
<script>
  function delMaterial(id,file){


     $.ajax({
            url: "<?php echo base_url("study/home/delete"); ?>",
            method: "post",
            data: {id: id, file:file, csrf: csrf_token},
            dataType: 'json',
            success: function (data) {
                if(data.success==true){
               $("#material"+id).remove();
               $.notify("Material Deleted!","success");
           }else{
           $.notify("Bug Found!","info");
        }
            }
        });
        
        }

   <?php } ?>


  
</script>
<!-- Visit "codeastro.com" for more projects! -->