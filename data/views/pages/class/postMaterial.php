<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!-- Visit "codeastro.com" for more projects! -->
<style>
    textarea {
   resize: none;
}
    </style>
    <div class="server_msg"></div>
<div class="">
 
    <div class="box-body ">
         <?php echo form_open("", array( 'id' => 'post', 'name' => 'postMAterial' ));?>
<!--                    <form action="<?php //echo base_url(); ?>subject/manage/add" name="add_subject" id="add_subject" method="post" accept-charset="utf-8">-->
                        
                 <div class="row">
            <div class="col-sm-6">
                <br/>
                <p>Posting as <?php echo $this->sms->get_user()->full_name; ?></p>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                            <label>Select Subject</label>
                            <select id="subject_id" name ="subject_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">

                                <option value="0" selected="selected">Null</option>
                                 <?php 
                foreach ($this->subject->list_subject($class->id) as $subject) {
   
     echo '<option value="' . $subject->id . '">' . $subject->name.'</option>';
}
                 ?>
                               
                            </select>
                        </div>
            </div>
        </div>        
         
        
        
                        <div class="form-group has-feedback">
                           <textarea type="text" id="detail" class="form-control" name="detail" placeholder="Feeds"></textarea>
                    <div id="detail"></div>
                           
                        </div>
        <div class="row">
            <div class="col-sm-6">
                <input type="file" name="file" />
                <div id="file"></div>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-feedback" style="float: right">
                    <button type="reset" class=" btn btn-flat btn-danger">Reset</button>  
                            <button type="submit" name="post" class=" btn btn-success">Upload</button>
                           
                        </div>
            </div>
        </div>
                       
        <input type="hidden" value="<?php  echo $this->encrypt->encode($class->id); ?>" name="class_id"/>
         <input type="hidden" value="<?php  echo $this->encrypt->encode($profile->id); ?>" name="section_id"/>
        <input type="hidden" value="<?php  echo $this->encrypt->encode($this->sms->get_user()->id); ?>" name="user_id"/>
                    <?php echo form_close();?>
    </div>
   <!-- Visit "codeastro.com" for more projects! -->
</div>
    <script>
        
            $('#post').submit(function (e) {
            //$('.loader').show("slow");
        e.preventDefault();
        var formData = new FormData($(this)[0]);
       var frm = document.getElementsByName('post')[0];
      
        $.ajax({
            url: '<?php echo base_url('study/home/add'); ?>',
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
                            document.getElementById("post").reset(); 
                     $.notify("Successfully Added", "success");
                   $(".error_msg").empty();
                            
                            $(".error_msg").append(response.server_msg);
                   // $('#the-message').fadeIn('slow');
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                    frm.reset();
                    $("#subject_id").select2("val", "");
                    $('textarea').val('');
                    this.form.reset();
             
                    

                } else {
                    
                    
                         if(response.server_msg){
                            $(".server_msg").empty();
                            
                            $(".server_msg").append(response.server_msg);
                         }
                    $.each(response.msg, function (key, value) {
                        var element = $('#' + key);
                        element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger').remove();
                        element.after(value);

                    });
                    $.notify("Failed", "error");
                }
            }
        });

    });
        
        
        </script>
        <!-- Visit "codeastro.com" for more projects! -->