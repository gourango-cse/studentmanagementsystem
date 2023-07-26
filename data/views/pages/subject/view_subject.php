<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
   if($list_subject!=NULL){  
?>
 <!-- Visit "codeastro.com" for more projects! -->
<div class="box">
    
    <div class="box-header"><b>List of Subjects</b></div>
    <div class="well" id="recently_added" style="display:none"  >
        <h4>Recently Added Subject</h4>
    </div>
<table class="table table-hover table-bordered">
    <tr>
        <th>Subject</th>
      
        <th>Teacher</th>
       
    </tr>
    <?php
 
        foreach ($list_subject as $sub){   
            $sub_id= $sub->id;
            //$sub_id = $this->encrypt->encode($sub->id); ?>
  
    <tr >
        <td  id="id<?php echo $sub_id; ?>"  onmouseenter=showEditBox("<?php echo $sub_id; ?>","<?php echo $sub->name; ?>",&#34;<?php echo $this->security->get_csrf_hash(); ?>&#34;) >   <?php echo $sub->name;  ?></td>
        
        <td> <?php //echo $this->sms->get_user($sub->teacher_id)->full_name; 
     if($sub->teacher_id!=0){
        echo $this->sms->get_user($sub->teacher_id)->full_name;
     } else{
         echo "N/A";
     }
        ?></td>
       
    </tr>
    <script type="text/javascript">
    function showEditBox(id,edit_subject_name,token){
       // console.log(id+name);
       $('#id'+id).mouseleave(function(){
               $('#id'+id).empty(); 
               $('#id'+id).append(" "+edit_subject_name);
       });
      $('#id'+id).empty();  

       $("<div class='form-group has-feedback'><input type='text' id='edit_subject_name' class='form-inline form-control' value="+edit_subject_name+">\n\
<div id='subject_id'></div></div> <button id='save_edit' onclick='saveIt("+id+",&#34;"+token+"&#34;)' class='btn btn-success form-inline'>Save</button>\n\
 <button id='save_edit' onclick='deleteIt("+id+",&#34;"+token+"&#34;)' class=' form-inline btn btn-danger form-inline'>Delete</button>").appendTo('#id'+id);
     
    }
    
     
    
    
    function saveIt(id,token){
   

       edit_subject_name = $("#edit_subject_name").val();
       
        $.ajax({
            url: "<?php echo base_url("subject/manage/edit"); ?>",
            type: 'post',
            data: {subject_id:id, edit_subject_name:edit_subject_name,csrf:token },
            dataType: 'json',
            success: function (response) {
              
                if (response.success == true) {
                 $('#id'+id).empty();
                    $('#id'+id).html(" "+edit_subject_name+" Updated! Re-triger the class to view change!");
                
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                     
                    $.notify("Subject Updated!","success");
                   
                    

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
     

    var r = confirm("You are about to delete current subject");
     if(r==true){
        $.ajax({
            url: "<?php echo base_url("subject/manage/delete"); ?>",
            type: 'post',
            data: {edit_subject_name:id, csrf:token},
            dataType: 'json',
            success: function (response) {
              
                if (response.success == true) {
                 $('#id'+id).empty();
                 
                               $('#id'+id).append("Re-triger the class to view change!"); 
                             
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                     
                    $.notify("Subject Deleted!","success");
                   
                    

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
    }
    </script>
    <?php   }?>
   
</table>
   
</div>
   <?php  }else {echo "Subject is not assign yet!";}?>