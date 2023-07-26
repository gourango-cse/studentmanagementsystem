<?php

/* 
 *  @package		Kodstack
 *  Author:         Ronash Dhakal
 */

?>
<!-- Visit "codeastro.com" for more projects! -->
<div class="box">
           <div class="box-header">
             <h3 class="text-center"> Account Types </h3>
        </div>
            <!-- /.box-header -->
            <div class="box-body">
    <div class="row">
       
        <table class="table table-hover table-bordered">
            <thead>
            <th class="text-center">Type ID</th>
            <th class="text-center">Name</th>
            
            </thead>
            <tbody>
                <?php
                if($account_type!=FALSE){
                    
                foreach ($account_type as $tac){ ?>
                <tr id="actype<?php echo $tac->id;?>" onmouseenter="showEditBox(<?php echo $tac->id ?>,&#39;<?php echo $tac->name ?>&#39;,&#39;<?php echo $this->security->get_csrf_hash();?>&#39;)">
                    <td class="text-center" id="actypeid<?php echo $tac->id;?>" ><?php echo $tac->id ?></td>
                    <td class="text-center" id="actypename<?php echo $tac->id;?>" ><?php echo $tac->name ?></td>
          
                </tr>
                <?php }}else{ echo "<tr><td class='text-center'>Account Type has not been assign yet </td></tr>";} ?>
            </tbody>
        </table>
        
    </div>

            </div></div>
<!-- Visit "codeastro.com" for more projects! -->
<script>

      function showEditBox(id,name,token){
       // console.log(id+name);
       var name = name.toString();
       $('#actype'+id).mouseleave(function(){
               $('#actypename'+id).empty();
               $('#actypename'+id).append(" "+name);
       });
      $('#actypename'+id).empty();  

       $("<div class='form-group has-feedback'><input type='text' id='e_name' class='form-inline form-control' value='"+name+"'>\n\
</div> <button id='save_edit' onclick='saveIt("+id+",&#34;"+token+"&#34;)' class='btn btn-success form-inline'>Save</button>\n\
 <button  onclick='deleteIt("+id+",&#34;"+token+"&#34;)' class=' form-inline btn btn-danger form-inline'>Delete</button>").appendTo('#actypename'+id);
     
    }
     function saveIt(id,token){
   

       e_name = $("#e_name").val();
       
        $.ajax({
            url: "<?php echo base_url("account/type/update"); ?>",
            type: 'post',
            data: {id:id, e_name:e_name,csrf:token },
            dataType: 'json',
            success: function (response) {
              console.log(response);
                if (response.success == true) {
//                   
//                 $('#id'+id).empty();
//                    $('#id'+id).html(" "+edit_class_name);
                
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                     
                    $.notify("Account Type Updated!","success");
                   
                    listType();

                } else {
//                          if(response.server_msg!=''){
//            $('.add_subject_msg').empty(); 
//             $('.add_subject_msg').append(response.server_msg); 
//            }
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
    }
  function deleteIt(id,token){
     

    var r = confirm("You are about to delete current account type");
     if(r==true){
        $.ajax({
            url: "<?php echo base_url("account/type/delete"); ?>",
            type: 'post',
            data: {e_name:id, csrf:token},
            dataType: 'json',
            success: function (response) {
              
                if (response.success == true) {
                
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                     
                    $.notify("Class Deleted!","success");
                   listType();
                    

                } else {
//                          if(response.server_msg!=''){
//            $('.add_subject_msg').empty(); 
//             $('.add_subject_msg').append(response.server_msg); 
//            }
                    $.each(response.msg, function (key, value) {
                        var element = $('#' + key);
                        element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger').remove();
                        element.after(value);
                        
                      $('.list_ac_type_msg').empty();
                      $('.list_ac_type_msg').append(value);

                    });
                 
                }
            }
        });
    }
    }
</script>