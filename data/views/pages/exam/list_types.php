  <!-- Visit "codeastro.com" for more projects! -->
<div class="box"> 
      <div class="box-header">
                    <h4>Exam LIst</h4>
                    <p class="server_msg text-red"></p>
                </div>


<div class="box-body">
                   

<table class="table table-hover table-bordered" id="exam_table">
  <tr>
    <th>Exams</th>
  
  </tr>
  <?php if($types!=FALSE){ 
    foreach ($types as $type) {
      
    
    ?>
  <tr id="<?php echo  $type->id ;?>" >
    <td <?= "id='id".$type->id."'" ?> <?php 
    echo "onmouseenter='showEditBox(".$type->id.",\"".$type->name."\",\"".$this->security->get_csrf_hash()."\")'";
    ?> ><?= $type->name; ?></td>
   
  </tr>
  <tr> </tr>
<?php }} ?>
</table>
</div>
</div>


<script type="text/javascript">
   
     
      function showEditBox(id,edit_type,token){
       // console.log(id+name);
        
        //var edit_type = String(edit_type);
      

       $('#id'+id).mouseleave(function(){
               $('#id'+id).empty(); 
               $('#id'+id).append(" "+ String(edit_type));
       });
      $('#id'+id).empty();  
      
       $("<div class='form-group has-feedback'><input type='text' id='edit_type' class='form-inline form-control' value='"+edit_type+"'>\n\
<div id='subject_id'></div></div> <button id='save_edit' onclick='saveIt("+id+",&#34;"+token+"&#34;)' class='btn btn-success form-inline'>Save</button>\n\
 <button id='save_edit' onclick='deleteIt("+id+",&#34;"+token+"&#34;)' class=' form-inline btn btn-danger form-inline'>Delete</button>").appendTo('#id'+id);
     
    }
     function saveIt(id,token){
   

       edit_type = $("#edit_type").val();

        $.ajax({
            url: "<?php echo base_url("exam/manage/operation/update"); ?>",
            type: 'post',
            data: {id:id, edit_type:edit_type,csrf:token },
            dataType: 'json',
            success: function (response) {
              
                if (response.success == true) {
//                   

                
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                     
                    $.notify("Exam Updated!","success");
                                   $('#'+id).empty();
                   $('#'+id).append('<td id="id'+id+'" onmouseenter="showEditBox('+id+', &#34;'+edit_type+'&#34;,&#34;'+token+'&#34;) ">'+edit_type+'</td>');
     // list_types();

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
            url: "<?php echo base_url("exam/manage/operation/delete"); ?>",
            type: 'post',
            data: {id:id, csrf:token},
            dataType: 'json',
            success: function (response) {
              console.log(response);
                if (response.success == true) {
                
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                     
                    $.notify("Exam Deleted!","success");
                        $('#id'+id).fadeOut("slow"); 
                       //list_types();
                    

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

  
     // $('select2').select2();
   
    </script>