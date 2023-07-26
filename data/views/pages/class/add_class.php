 <!-- Visit "codeastro.com" for more projects! -->
 <div class="box ">
                <div class="box-header bg-purple">
                    <h4>Add Class</h4>

                </div>
                <div class="box-body">
                    <div class="box-header add_class_msg text-red"></div>
                    <form action="<?php echo base_url(); ?>class/manage/add_class" name="add_class" id="add_class" method="post" accept-charset="utf-8">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
 <div class="form-group has-feedback">
                            <label>Class In Numeric</label>
                            <input   type="text" name="class_number" class="form-control" placeholder="Class Numeric">
                            <span class="fa fa-terminal form-control-feedback"></span>
                            <div id="class_number"></div>
                        </div>                        
<div class="form-group has-feedback">
                            <label>Class Name</label>
                            <input   type="text" name="class_name" class="form-control" placeholder="Class Name">
                            <span class="fa fa-terminal form-control-feedback"></span>
                            <div id="class_name"></div>
                        </div>

                                             
                   
                        <div class="form-group has-feedback">
                            <button class="btn btn-success" type="submit" name="add_class" >Add Class </button>
                        </div>     



                    </form>


                </div>


            </div>
<!-- Visit "codeastro.com" for more projects! -->
<script type="text/javascript">
   $('select').select2();
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
                   
                    $.notify("Validation Success","success");
                    list_class();
                assign_class_teacher_box();
                    

                } else {
                          if(response.server_msg!=''){
            $('.add_class_msg').empty(); 
             $('.add_class_msg').append(response.server_msg); 
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
    
   
    </script>
    <!-- Visit "codeastro.com" for more projects! -->