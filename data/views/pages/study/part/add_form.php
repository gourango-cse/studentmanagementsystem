 <div class="box ">
              
                <div class="box-body">
                    <div class="box-header add_class_msg text-red">
                              <div class="server_msg"></div>
                    </div>
      <?php echo form_open("", array( 'id' => 'addMaterial', 'name' => 'add_material' ));?>
<!--                    <form action="<?php //echo base_url(); ?>subject/manage/add" name="add_subject" id="add_subject" method="post" accept-charset="utf-8">-->
                        
                          <div class="form-group has-feedback">
                            <label>Select Class*</label>
                            <select id="class_id" name ="class_id" class="form-control select_class" style="width: 100%;" tabindex="-1" aria-hidden="true">

                                <option value="0"  >Null</option>
                                 <?php 
                       
                            
                  foreach($class_lists as $class){
                      
                   echo '<option  value="'.$class->id.'">'.$class->name.'</option>';
      }
                 ?>
                               
                            </select>
                        </div>
              
                   
                    <div id="list_subject_form">
                            
                        </div>
                       

                    <?php echo form_close();?>


                </div>


            </div>

<script type="text/javascript">
  <?php if($this->sms->is_allowed('Teacher')){ ?>
      $('#addMaterial').submit(function (e) {
            //$('.loader').show("slow");
        e.preventDefault();
        var formData = new FormData($(this)[0]);
       var frm = document.getElementsByName('addMaterial')[0];
      
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
                        
                     $.notify("Successfully Added", "success");
                   $(".error_msg").empty();
                            
                            $(".error_msg").append(response.server_msg);
                   // $('#the-message').fadeIn('slow');
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                    frm.reset();
                  $("#file").val("");
                    

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
  <?php  } ?>
    $(".select_class").change(function () {
        class_id = $(this).val();
       
        if(class_id==0){
              $('#initial').show();
              $('#listMaterial').empty();
          
        }else{
            
        $.ajax({
            url: "<?php echo base_url("study/home/list_subject"); ?>",
            method: "post",
            data: {class_id: class_id, csrf: csrf_token},
            dataType: 'text',
            success: function (data) {
                $('#list_subject_form').empty();
                $('#list_subject_form').html(data);
                
            }
        });}
    });
   


</script>


