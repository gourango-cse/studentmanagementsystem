  <!-- Visit "codeastro.com" for more projects! -->
<div class="box"> 
      <div class="box-header">
                    <h4>Running Class</h4>
                    <p class="server_msg text-red"></p>
                </div>
<table class=" table table-hover table-bordered">
    <tr>
        <th><h4>Class</h4></th><th><h4>Section</h4></th><th><h4>Class Teacher</h4><th colspan="2"><h4>Option</h4></th>
    </tr>
  <?php 
  
  $list_class =  $this->sms_class->list_class();
 if($list_class!=FALSE){
  foreach ($list_class as $ls) {
       $section =  $this->sms_class->list_section($ls->id);
       echo "<tr>";
       echo "<td id='id".$ls->id."' onmouseenter='showEditBox(".$ls->id.",\"".$ls->name."\",\"".$this->security->get_csrf_hash()."\")'>".$ls->name."</td>";
      echo "<td>";
     if($section!=FALSE){
               foreach ($section as $sec) {
           echo "|".$sec->name."|"."  ";
     }}else{
         echo "Has not been initialized yet";
     }
       echo "</td>";
       echo "<td>";
       if($this->sms->get_user($ls->teacher_id, "Teacher") !=FALSE){
              echo $this->sms->get_user($ls->teacher_id, "Teacher")->full_name;
          }else{
          echo "N/A";
          }
       echo "</td>";
    
       ?>
     <td><div class="btn-group">
                  <button type="button" class="btn btn-primary">Action</button>
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                      <li><a href="<?php echo base_url("class")."/".strtolower($ls->name);?>" >View Class</a></li>
                      <?php if($this->sms->is_admin()){ ?>
                      <?php if($section!=FALSE){
                       
                          foreach ($this->sms_class->list_section($ls->id) as $section): 
                         if($this->sms_class->is_student_on_section($section->id)==FALSE){ ?>
                      <li><a onclick="javascript:delete_section('<?php echo $section->id ?>',csrf_token)"><?php echo "Delete Section ".$section->name ?></a></li>
                      <?php } endforeach; }}?>
                  </ul>
                </div></td>
    <?php
       echo "</tr>";
       
  
       
       }?>
 <?php } ?>
</table>
</div>
<!-- Visit "codeastro.com" for more projects! -->


<script type="text/javascript">
   
     
      function showEditBox(id,edit_class_name,token){
       // console.log(id+name);
        
       $('#id'+id).mouseleave(function(){
               $('#id'+id).empty(); 
               $('#id'+id).append(" "+edit_class_name);
       });
      $('#id'+id).empty();  
      
       $("<div class='form-group has-feedback'><input type='text' id='edit_class_name' class='form-inline form-control' value="+edit_class_name+">\n\
<div id='subject_id'></div></div> <button id='save_edit' onclick='saveIt("+id+",&#34;"+token+"&#34;)' class='btn btn-success form-inline'>Save</button>\n\
 <button id='save_edit' onclick='deleteIt("+id+",&#34;"+token+"&#34;)' class=' form-inline btn btn-danger form-inline'>Delete</button>").appendTo('#id'+id);
     
    }
     function saveIt(id,token){
   

       edit_class_name = $("#edit_class_name").val();
       
        $.ajax({
            url: "<?php echo base_url("class/manage/edit"); ?>",
            type: 'post',
            data: {list_class_id:id, edit_class_name:edit_class_name,csrf:token },
            dataType: 'json',
            success: function (response) {
              
                if (response.success == true) {
//                   
//                 $('#id'+id).empty();
//                    $('#id'+id).html(" "+edit_class_name);
                
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                     
                    $.notify("Class Updated!","success");
                   
                    list_class();

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
            url: "<?php echo base_url("class/manage/delete"); ?>",
            type: 'post',
            data: {edit_class_name:id, csrf:token},
            dataType: 'json',
            success: function (response) {
              
                if (response.success == true) {
                
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                     
                    $.notify("Class Deleted!","success");
                   list_class();
                    

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
                        
                      $('.server_msg').empty();
                      $('.server_msg').append(value);

                    });
                 
                }
            }
        });
    }
    }
     
 function delete_section(id,csrf_token){
    $.ajax({
            url: "<?php echo base_url('class/manage/delete_section'); ?>",
            type: 'post',
            data: {id:id,csrf:csrf_token},
            dataType: 'text',
            success: function (response) {
                if(response==true){
                list_class();
               
                    $.notify("Successfully Deleted!","success");

                } else {
                                 
                $.notify("You Cannot delete this section","error");
              
                }
            }
        });
 }
  
     // $('select2').select2();
   
    </script>