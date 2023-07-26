<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
   

?>
<!-- Visit "codeastro.com" for more projects! -->
 
     <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Message</h3>
            </div>
            <!-- /.box-header -->
             <form action="<?php echo base_url(); ?>mail/message/send" name="sendmsg" id="sendmsg" method="post" accept-charset="utf-8">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <div class="box-body">

               <div class="form-group">
                            <label>Select User</label>
                            <select id="user_id" name ="user_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">

                                <option value="0" selected="selected">Null</option>
                                 <?php 
                                 
                              
                                
                  foreach($list_user as $user){
                      if($this->sms->get_user()->id == $user->id){
                          $status= "disabled";
                      }else{
                         $status= ""; 
                      }
                   echo '<option '.$status.'  value="'.$user->id.'">'.$user->full_name.'</option>';
                  }
                 ?>
                               
                            </select>
                        </div>
              <div class="form-group">
                  <input name="subject" id="subject" class="form-control" placeholder="Subject:">
              </div>
              <div class="form-group">
                  <textarea id="message" class="textarea" name="message" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              
              </div>
            
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
          
                <button type="submit" class="btn btn-success"><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i> Discard</button>
            </div>
            <!-- /.box-footer -->
            </form>
          </div>
    <!-- /.content -->
    <!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script type="text/javascript">
         $('#sendmsg').submit(function (e) {
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
                   
                    $.notify("Successfully send!","success");
                   
                    

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
     $(".textarea").wysihtml5();
        $(".select2").select2();
     </script>
   
 