     <!-- Visit "codeastro.com" for more projects! -->
     <div class="box box-profile ">
                            <div class="box-header bg-purple">
                                <h4>Add Section</h4>
                                <p class="add_section_msg text-red"></p>
                            </div>
                            <div class="box-body">

                                <form action="<?php echo base_url(); ?>class/manage/add_section"  id="add_section_post" method="post" accept-charset="utf-8">
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                    <div class="form-group has-feedback">
                                        <label>Select Class</label>
                                        <select  name ="class_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">

                                           <?php
foreach ($list_class as $cls) {
   
 if($profile->name==$cls->name){
                           $do = "selected";
                       }else{
                           $do = "disabled";
                       }
    echo '<option '.$do.' value="' . $cls->id . '">' . $cls->name . '</option>';
}
?>

                                        </select>
                                        <div id="class_id">

                                        </div></div>
                                    
                                    <div class="form-group has-feedback">
                                        <label>Section Aplhabetical Name</label>
                                        <input   type="text" name="section_name" class="form-control" placeholder="Section Name">
                                        <span class="fa fa-terminal form-control-feedback"></span>
                                        <div id="section_name"></div>
                                    </div>
                                    

                                   

                                    <div class="form-group has-feedback">
                                        <button class="btn btn-success" type="submit" >Add Section </button>
                                    </div>     



                                </form>


                            </div><!-- Visit "codeastro.com" for more projects! -->


                        </div>
<script type="text/javascript">
     $('select').select2();
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
                    $.notify("Section Added!", "success");
                    view_class_summary_box();
                    assign_section_teacher_box();

                } else {
 if(response.server_msg!=''){
            $('.add_section_msg').empty(); 
             $('.add_section_msg').append(response.server_msg); 
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