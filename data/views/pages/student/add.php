<?php
/*
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
?>
<!-- Visit "codeastro.com" for more projects! -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
<?php echo $page_title; ?>
        <small><?php if (isset($page_slogan)) {
    echo $page_slogan;
} ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a><i class="fa fa-user"></i>Student</a></li>
        <li><a><i class="fa fa-user-plus active"></i> Add Student</a></li>

    </ol>
</section>
<!-- Visit "codeastro.com" for more projects! -->
<!-- Main content -->
<section class="content container-fluid">
    
   
         <div class="box">
             <div class="box-header">
                 <div class="alert alert-warning error_msg text-center"> ***All the fields are <b>required</b>***</div>
             </div>
            <!-- /.box-header  -->
            <div class="box-body">
    <div class="row">
          <?php echo form_open(base_url( 'student/list_section' ), array( 'id' => 'form_student', 'name' => 'form_student' ,'enctype'=>'multipart/form-data' ));?>
<!--        <form  name="form_student" id="form_student"  enctype="multipart/form-data" method="post" accept-charset="utf-8">-->
            <div class="col-sm-6 col-xs-12">


                <!--        Full Name-->
                
                <div class="form-group has-feedback">
<label>Full Name</label> 
                    <input type="text" name="full_name"  class="form-control" placeholder="Full Name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <div id="full_name"></div>
                </div>

                <!--username-->
               
                <div class="form-group has-feedback">
                     <label>Username</label>
                    <input   type="text" name="username" class="form-control" placeholder="Username">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <div id="username"></div>
                </div>
                <!--        E-mail-->
                
                <div class="form-group has-feedback">
                    <label>E-mail</label>
                    <input   type="email" name="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <div id="email"></div>
                </div>
                
                <!-- Date of Birth     -->
                
             
                <div class="form-group has-feedback">
                       <label>Date of Birth</label>
                    <input  id="datepicker" type="text" name="dob" class="form-control" placeholder="Date of Birth">
                    <span class="fa fa-calendar form-control-feedback"></span>
                    <div id="dob"></div>
                </div>


                <!--Address-->
               
                <div class="form-group has-feedback">
                     <label>Address</label>
                    <input  type="text" name="address" class="form-control" placeholder="Address"/>
                    <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
                    <div id="address"></div>
                </div>
                    
                <!-- contact number -->
                <div class="form-group">
                    <label>Contact</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" name="contact"  class="form-control" data-inputmask="&quot;mask&quot;: &quot;+(999) 9999-99999[9]&quot;" data-mask="" >

                    </div>
                    <div id="contact"></div>
                    <!-- /.input group  -->
                </div>

                 <div class="form-group has-feedback">
                            <label>Gender</label><br>
                            <label> Male
                                <input type="radio" name="gender" value="male" class="icheckbox_flat-aero" required >
                            </label>
                            <label> Female
                                <input type="radio" name="gender" value="female" class="icheckbox_flat-aero">
                            </label>
                          
                            <div id="gender"></div>
                            
                        </div>




            </div>

            <div class="col-sm-6 col-xs-12">
                
                
               
                <!-- Class-->

                <div class="form-group">
                    <label>Class</label>
                    <select   name="class_id" class="form-control select2 select2-hidden-accessible list_class" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="0" selected="selected">Select Class</option>
                        <?php foreach($list_class As $class){
                            
                             echo '<option value="'.$class->id.'">'.$class->name.'</option>';
                        }  ?>
                        
                    </select>
                    <div id="class_id"></div>
                </div>

                <!--Section-->
                <div class="form-group">
                    <label>Section</label>
                    <select id="list_section" name ="section_id" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      
                        
                        
                    </select>
                    <div  id="section_id"></div>
                </div>
                
                 <div class="form-group has-feedback">
                     <label>Roll</label>
                    <input  type="text" name="roll" class="form-control" placeholder="Roll Number"/>
                    <span class="fa fa-navicon form-control-feedback"></span>
                    <div id="roll"></div>
                </div>
                
                <!--Parent-->
                <div class="form-group">
                    <label>Parent</label>
                    <select   name="parent_id"class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="0" selected="selected">Select Parent</option>
                        <option value="1">Parent One</option>
                        <option value="2">Parent Two</option>
                        <option value="3">Parent Three</option>
                        
                    </select>
                    <div  id="parent_id"></div>
                </div>
                <!--Transport-->
                <div class="form-group">
                    <label>Transport</label>
                    <select id="transport" name="transport" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="0" selected="selected">Select Transport</option>
                        <option>Transport One</option>
                        <option>Transport Two</option>
                        <option>Transport Three</option>
                        <option>Transport Four</option>
                        <option>Transport Five</option>
                        <option>Transport Six</option>
                    </select>
                </div>
                <!--Parent-->
                <div class="form-group">
                    <label>Hostel</label>
                    <select  name="hostel" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="0" selected="selected">Select Hostel Room</option>
                        <option>Hostel One</option>
                        <option>Hostel Two</option>
                        <option>Hostel Three</option>
                        <option>Hostel Four</option>
                        <option>Hostel Five</option>
                        <option>Hostel Six</option>
                    </select>
                    <div id="hostel"></div>
                </div>
                <!--Profile picture-->

                <div class="form-group">
                    <label for="picture">Profile Picture</label>
                    <input type="file" id="picture" name="picture">
                  
                           <div class="error_msg"></div>   
                       
                </div>
                <div class="form-group right">
                    <button type="submit" class="btn btn-flat btn-success">Add Student</button>
                </div>
            </div>

        </form>
    </div>

            </div></div>
</section>
 <script type="text/javascript">
      
        $( ".list_class" ).change(function() {
             var data = $(this).val();
           
  $.ajax({
      url:"<?php echo base_url("student/list_section"); ?>",
      method: "post",
      data: {class_id: data , csrf:csrf_token },
      dataType: 'text',
      beforeSend: function(){
            $('.loader').fadeIn("slow");
        },
      success: function (data){
           $('.loader').fadeOut("slow");
     $('#list_section').html(data); 
    }
  });
});
       
   
    </script>
<script type="text/javascript">
    $('#form_student').submit(function (e) {
            //$('.loader').show("slow");
        e.preventDefault();
        var formData = new FormData($(this)[0]);
       var frm = document.getElementsByName('form_student')[0];
      
        $.ajax({
            url: '<?php echo base_url('student/add/post'); ?>',
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
                        
                     $.notify("Successfully Registered", "success");
                   $(".error_msg").empty();
                            
                            $(".error_msg").append(response.server_msg);
                   // $('#the-message').fadeIn('slow');
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                    frm.reset();
                   
                    

                } else {
                    
                    
                         if(response.server_msg!=''){
                            $(".error_msg").empty();
                            
                            $(".error_msg").append(response.server_msg);
                         }
                    $.each(response.msg, function (key, value) {
                        var element = $('#' + key);
                        element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger').remove();
                        element.after(value);

                    });
                    $.notify("Please verify your data!", "error");
                }
            }
        });

    });
</script>