 <!-- Visit "codeastro.com" for more projects! -->
 <div class="box ">
                <div class="box-header bg-olive">
                    <h4>Assign <?php echo $type; ?> Teacher</h4>

                </div>
                <div class="box-body">
                    <div class="box-header assign_techer_msg text-red"></div>
                   <?php
                   if($type=='class'){
                     ?>  
                     <form action="<?php echo base_url(); ?>class/manage/class_teacher" name="assign_class_teacher" id="assign_class_teacher" method="post" accept-charset="utf-8">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                   <?php }else{
                       
                       ?>
                         <form action="<?php echo base_url(); ?>class/manage/section_teacher" name="assign_section_teacher" id="assign_section_teacher" method="post" accept-charset="utf-8">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                   <?php }
                   ?>
                    
                     
                       <div class="form-group">
                            <label>Select <?php echo $type; ?></label>
                            <select id="<?php echo $type; ?>_id" name ="<?php echo $type; ?>_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">

                                <option value="0" selected="selected">Null</option>
                                 <?php 
                                 if($type=="class"){
                                   $list_class =  $this->sms_class->list_class();   
                                 }else if($type=="section"){
                                 $list_class =  $this->sms_class->list_section($profile1->id);
                                 }
                  foreach($list_class as $classl){
                      
                   echo '<option  value="'.$classl->id.'">'.$classl->name.'</option>';
      }
                 ?>
                               
                            </select>
                        </div>
                                             
                        <div class="form-group">
                            <label>Class Teacher</label>
                            <select id="teacher_id" name ="teacher_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">

                                <option value="0" selected="selected">Null</option>
                                 <?php 
                foreach ($list_teachers as $teacher) {
    if ($this->sms_class->is_class_teacher($teacher->id, TRUE) != FALSE AND $this->sms_class->is_section_teacher($teacher->id,TRUE) != FALSE) {
            $ctorst = "(CT=>".$this->sms_class->is_class_teacher($teacher->id, TRUE).") AND "."(ST=>".$this->sms_class->is_section_teacher($teacher->id, TRUE).")";
            $choose = "disabled";
            
    }else if ($this->sms_class->is_class_teacher($teacher->id, TRUE) != FALSE) {
        $ctorst = "(CT=>".$this->sms_class->is_class_teacher($teacher->id, TRUE).")";
        $choose = "disabled";
    }
        else{
            $ctorst = NULL;
            $choose = NULL;
        }
     echo '<option '.$choose.' value="' . $teacher->id . '">' . $teacher->full_name." ".$ctorst . '</option>';
}
                 ?>
                               
                            </select>
                        </div>

                        <div class="form-group has-feedback">
                            <button class="btn btn-success" type="submit" > Save </button>
                        </div>     



                    </form>


                </div>


            </div>
<!-- Visit "codeastro.com" for more projects! -->
<script type="text/javascript">
   $('select').select2();
 
    $('#assign_class_teacher').submit(function (g) {
        g.preventDefault();
        var me2 = $(this);

        $.ajax({
            url: me2.attr('action'),
            type: 'post',
            data: me2.serialize(),
            dataType: 'json',
            success: function (response) {
               
                if (response.success == true) {

                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                    me2[0].reset();
                    $.notify("<?php echo $type; ?> Teacher Updated","success");
                     list_class();
                assign_class_teacher_box();
                add_class_box();

                } else {
                        if(response.server_msg!=''){
            $('.assign_techer_msg').empty(); 
             $('.assign_techer_msg').append(response.server_msg); 
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
     $('#assign_section_teacher').submit(function (g) {
        g.preventDefault();
        var me2 = $(this);

        $.ajax({
            url: me2.attr('action'),
            type: 'post',
            data: me2.serialize(),
            dataType: 'json',
            success: function (response) {
               
                if (response.success == true) {

                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                    me2[0].reset();
                    $.notify("<?php echo $type; ?> Teacher Updated","success");
                   view_class_summary_box();
                   assign_section_teacher_box();

                } else {
                        if(response.server_msg!=''){
            $('.assign_techer_msg').empty(); 
             $('.assign_techer_msg').append(response.server_msg); 
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