 <div class="box "><!-- Visit "codeastro.com" for more projects! -->
              
                <div class="box-body">
                    <div class="box-header add_class_msg text-red"></div>
      <?php echo form_open(base_url( 'library/manage/add_book' ), array( 'id' => 'add_book', 'name' => 'add_book' ));?>
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
                        <?php  if($this->sms->is_allowed('Admin')){?>
                        <div class="form-group has-feedback">
                            <label>Book Name*</label>
                            <input   type="text" name="name" id="name" class="form-control" placeholder="Book Name">
                            <span class="fa fa-terminal form-control-feedback"></span>
                            <div id="name"></div>
                        </div>
                        
                         <div class="form-group has-feedback">
                            <label>Book Author</label>
                            <input   type="text" name="author" id="author" class="form-control" placeholder="Author Name">
                            <span class="fa fa-terminal form-control-feedback"></span>
                            <div id="author"></div>
                        </div>

                        <div class="form-group has-feedback">
                            <label>Book Publication*</label>
                            <input   type="text" name="publication" id="publication" class="form-control" placeholder="Publication Name">
                            <span class="fa fa-terminal form-control-feedback"></span>
                            <div id="publication"></div>
                        </div>
                        
                       
                                             
                   
                        <div class="form-group has-feedback">
                            <button class="btn btn-success" type="submit" name="add_subject" >Add </button>
                        </div>     

                        <?php } ?>

                    <?php echo form_close();?>


                </div>


            </div>

<script type="text/javascript">
  
     $('#add_book').submit(function (l) {
        l.preventDefault();
        var me9 = $(this);
      var name =    $('#name').val();
        var publication =  $('#publication').val();
         var author =  $('#author').val();

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
                $('#add_book')[0].reset();
                    //   $('#recently_added').fadeIn("slow");
                    // $('#recently_added').append("<b> Book Name: </b>"+name+"<br><hr>");
                     $('#new').append("<tr id='book"+response.data+"'><td>"+name+"</td><td>"+author+"</td><td>"+publication+"</td><td><button class='btn btn-danger' onclick='javascript:del("+response.data+")' >Delete </button></td></tr>");
                    $.notify("Book Added!","success");
                   
                    

                } else {
                          if(response.server_msg!=''){
            $('.server_msg').empty(); 
             $('.server_msg').append(response.server_msg); 
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
              $('#initial').show();
              $("#listBooks").hide();
          
        }else{
            
        $.ajax({
            url: "<?php echo base_url("library/manage/list_subject"); ?>",
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


