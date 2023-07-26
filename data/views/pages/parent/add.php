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
<?php echo $page_title; ?>
        <small><?php if (isset($page_slogan)) {
    echo $page_slogan;
} ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a><i class="fa fa-user"></i>Parent</a></li>
        <li><a><i class="fa fa-user-plus active"></i> Add Parent</a></li>

    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
    
   
         <div class="box">
           <div class="box-header">
             <div class=" alert alert-warning error_msg text-center">***All fields are required***</div>
        </div>
            <!-- /.box-header -->
            <div class="box-body">
    <div class="row">
        <form  name="form_parent" id="form_parent"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
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
                
                <div class="form-group has-feedback">
                       <label>Date of Birth</label>
                    <input  id="datepicker" type="text" name="dob" class="form-control" placeholder="Date of Birth">
                    <span class="fa fa-calendar form-control-feedback"></span>
                    <div id="dob"></div>
                </div>

               
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

               

                <div class="form-group">
                    <label for="picture">Profile Picture</label>
                    <input type="file" id="picture" name="picture">
                    <div id="picture"></div>
                </div>
                <div class="form-group right">
                    <button  type="submit" class="btn btn-flat btn-success">Add Parent</button>
                </div>
            </div>

        </form>
    </div>

            </div></div>
</section>

<script type="text/javascript">
    $('#form_parent').submit(function (e) {
    
        e.preventDefault();
        var me = new FormData($(this)[0]);
       var frm = document.getElementsByName('form_parent')[0];
       
        $.ajax({
            url: '<?php echo base_url(); ?>parent/add/post',
            type: 'post',
            data: me,
            dataType: 'json',
             async: true,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                           beforeSend: function(){
            $('.loader').fadeIn("slow");
        },
            success: function (response) {
                if (response.success == true) {
                     $('.loader').fadeOut("slow");
                     $(".error_msg").hide();
                            
                           
                   // $('#the-message').fadeIn('slow');
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                    frm.reset();
                    $.notify("Successfully Registered", "success");
                    

                } else {
                        $('.loader').fadeOut("slow");
                         if(response.server_msg!=''){
                           $(".error_msg").empty();
                             $(".error_msg").removeClass('alert-info')
                                     .addClass("alert-danger")
                            $(".error_msg").append(response.server_msg);
                         }else{
                            $(".error_msg").hide();  
                         }
                    $.each(response.msg, function (key, value) {
                        var element = $('#' + key);
                        element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger').remove();
                        element.after(value);

                    });
                    $.notify("Validation error", "error");
                }
            }
        });

    });
</script>
