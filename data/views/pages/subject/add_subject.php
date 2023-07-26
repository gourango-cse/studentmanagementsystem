 <div class="box ">
              <!-- Visit "codeastro.com" for more projects! -->
                <div class="box-body">
                    <div class="box-header add_class_msg text-red"></div>
      <?php echo form_open(base_url( 'subject/manage/add' ), array( 'id' => 'add_subject', 'name' => 'add_subject' ));?>
<!--                    <form action="<?php echo base_url(); ?>subject/manage/add" name="add_subject" id="add_subject" method="post" accept-charset="utf-8">-->
                        
                          <div class="form-group has-feedback">
                            <label>Select Class</label>
                            <select id="subject_class_id" name ="subject_class_id" class="form-control select_class" style="width: 100%;" tabindex="-1" aria-hidden="true">

                                <option value="0"  >Null</option>
                                 <?php 
                       
                            
                  foreach($class_lists as $class){
                      
                   echo '<option  value="'.$class->id.'">'.$class->name.'</option>';
      }
                 ?>
                               
                            </select>
                        </div>
                        
                        <div class="form-group has-feedback">
                            <label>Subject Name</label>
                            <input   type="text" name="name" id="name" class="form-control" placeholder="Subject Name">
                            <span class="fa fa-terminal form-control-feedback"></span>
                            <div id="name"></div>
                        </div>
                       
                                             
                   
                        <div class="form-group has-feedback">
                            <button class="btn btn-success" type="submit" name="add_subject" >Add Subject </button>
                        </div>     



                    <?php echo form_close();?>


                </div>


            </div>

<script type="text/javascript">
  
     $('#add_subject').submit(function (l) {
        l.preventDefault();
        var me9 = $(this);
       
          var name = $('#name').val();
        $.ajax({
            url: me9.attr('action'),
            type: 'post',
            data: me9.serialize(),
            dataType: 'json',
            success: function (response) {
              
                if (response.success == true) {
                 
                   
                
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                      $('#recently_added').fadeIn("slow");
                    $('#recently_added').append("<b> Subject Name: </b>"+name+"<br><hr>");
                     $('#name').val("");
                    $.notify("Subject Added!","success");
                   
                    

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
     
    $(".select_class").change(function () {
        class_id = $(this).val();
       
        if(class_id==0){
              $('.list_subject').empty();
            $('.list_subject').append("<h4>Select Class to view current subjects</h4>");
        }else{
            
        $.ajax({
            url: "<?php echo base_url("subject/views/view_subject"); ?>",
            method: "post",
            data: {class_id: class_id, csrf: csrf_token},
            dataType: 'text',
            success: function (data) {
                $('.list_subject').empty();
                $('.list_subject').html(data);
                
            }
        });}
    });
   

</script>