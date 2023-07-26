 <div class="box ">
       <!-- Visit "codeastro.com" for more projects! -->
                <div class="box-body">
                    <div class="box-header add_class_msg text-red"></div>
                    <form action="<?php echo base_url(); ?>subject/manage/assign_subject_teacher" name="assign_subject_teacher" id="assign_subject_teacher" method="post" accept-charset="utf-8">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                         <div class="form-group">
                            <label>Select Class</label>
                            <select required=" " id="class_id" name ="class_id" class="form-control select2 select2-hidden-accessible class_list" style="width: 100%;" tabindex="-1" aria-hidden="true">

                                <option  value="0" selected="selected">Null</option>
                                 <?php 
                       
                            
                  foreach($class_list as $class){
                      
                   echo '<option  value="'.$class->id.'">'.$class->name.'</option>';
      }
                 ?>
                               
                            </select>
                        </div>
                       
                        <div class="form-group">
                            <label>Select Subject</label>
                            <select required="" id="subject_id" name ="subject_id" class="form-control  subject_list" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="0" selected="selected">Select Subject</option>
                            </select>
                        </div>
                               <div class="form-group">
                            <label>Select Teacher</label>
                            <select required="" id="teacher_id" name ="teacher_id" class="form-control select2 select2-hidden-accessible " style="width: 100%;" tabindex="-1" aria-hidden="true">

                                <option value="0" selected="selected">Null</option>
                                 <?php 
                       
                            
                  foreach($teacher_list as $master){
                      
                   echo '<option  value="'.$master->id.'">'.$master->full_name.'</option>';
      }
                 ?>
                               
                            </select>
                        </div>               
                   
                        <div class="form-group has-feedback">
                            <button class="btn btn-success" type="submit" >Assign Teacher</button>
                        </div>     



                    </form>


                </div>


            </div>
<script type="text/javascript">
    $(".class_list").change(function () {
        class_id = $(this).val();

        $.ajax({
            url: "<?php echo base_url("subject/manage/list_subject"); ?>",
            method: "post",
            data: {class_id: class_id,csrf:csrf_token},
            dataType: 'text',
          
            success: function (data) {
            //   $('.subject_list').empty();
                $('.subject_list').html(data);
                
            }
        });
    });
    
    
    
     $('#assign_subject_teacher').submit(function (p) {
        p.preventDefault();
        var p = $(this);

        $.ajax({
            url: p.attr('action'),
            type: 'post',
            data: p.serialize(),
            dataType: 'json',
            success: function (response) {
                
                if (response.success == true) {
                    
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                    p[0].reset();
                   $('#class_id').select2("val",0);
                    $('#subject_id').select2("val",0);
                     $('#teacher_id').select2("val",0);
                    $.notify("Teacher Updated!","success");
                   
                    

                } else {
                          if(response.server_msg!=''){
            $('.add_subject_msg').empty(); 
             $('.add_subject_msg').append(response.server_msg); 
            }
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
    $(".class_list").change(function () {
        class_id = $(this).val();
        if(class_id==0){
              $('.list_subject1').empty();
            $('.list_subject1').append("<h4>Select Class to view current subjects</h4>");
        }else{
        $.ajax({
            url: "<?php echo base_url("subject/views/view_subject"); ?>",
            method: "post",
            data: {class_id: class_id,csrf:csrf_token},
            dataType: 'text',
            success: function (data) {
                $('.list_subject1').empty();
                $('.list_subject1').html(data);
                
            }
        });}
    });
    $('select').select2();
    </script>