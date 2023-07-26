<?php

/* 
 *  @package		Kodstack
 *  Author:         Ronash Dhakal
 */

?>
<!-- Visit "codeastro.com" for more projects! -->
     <div class="box">
           <div class="box-header">
             <h3 class="text-center"> Fees List </h3>
        </div>
            <!-- /.box-header -->
            <div class="box-body">
    <div class="row">
       
        <table class="table table-hover table-bordered">
            <thead>
            <th class="text-center">Type</th>
           
            <th class="text-center">Amount</th>
            </thead>
            <tbody>
                <?php
                if($account_fees!=FALSE){
                foreach ($account_fees as $fac){
                     $class_id = $fac->class_id;
                    $class_name = $this->sms_class->get_class_name_by_id($fac->class_id);
                    ?>
                <tr id="fctype<?php echo $fac->id;?>" onmouseenter="showEditBox(<?php echo $fac->id ?>,&#39;<?php echo $fac->amount ?>&#39;,&#39;<?php echo $this->security->get_csrf_hash();?>&#39;)">
                    <td class="text-center" id="fctypename<?php echo $fac->ac_type;?>" ><?php echo $this->ac->get_ac_type_name($fac->ac_type); ?></td>
<!--            <td class="text-center" id="actypeclass<?php // echo $fac->id;?>"><?php //echo $this->sms_class->get_class_name_by_id($fac->class_id); ?></td>-->
                                    <td class="text-center" id="fctypeamount<?php echo $fac->id;?>">$<?php echo $fac->amount ?></td>

                </tr>
                <?php }echo "<h4 class='text-center'>Class: <span id='class_name'>".$class_name."</span></h4>";}else{ echo "<tr><td class='text-center'>Fees has not been assign yet </td></tr>";} ?>
            </tbody>
        </table>
        
    </div>

            </div></div>

<script>

      function showEditBox(id,amount,token){
       // console.log(id+name);
   
       $('#fctype'+id).mouseleave(function(){
               $('#fctypeamount'+id).empty();
               $('#fctypeamount'+id).append(" "+amount);
       });
      $('#fctypeamount'+id).empty();  

       $("<div class='form-group has-feedback'><input type='text' id='e_amount' class='form-inline form-control' value='"+amount+"'>\n\
</div> <button id='save_edit' onclick='saveIt("+id+",&#34;"+token+"&#34;)' class='btn btn-success form-inline'>Save</button>\n\
 <button  onclick='deleteIt("+id+",&#34;"+token+"&#34;)' class=' form-inline btn btn-danger form-inline'>Delete</button>").appendTo('#fctypeamount'+id);
     
    }
     function saveIt(id,token){
   class_name = $("#class_name").text();

       e_amount = $("#e_amount").val();
       
        $.ajax({
            url: "<?php echo base_url("account/update/fees"); ?>",
            type: 'post',
            data: {id:id, e_amount:e_amount,csrf:token },
            dataType: 'json',
            success: function (response) {
              
                if (response.success == true) {
//                   
//                 $('#id'+id).empty();
//                    $('#id'+id).html(" "+edit_class_name);
                
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                     
                    $.notify("Account Type Updated!","success");
                   
                  listClass(class_name);

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
     
 class_name = $("#class_name").text();
    var r = confirm("You are about to delete current fees");
     if(r==true){
        $.ajax({
            url: "<?php echo base_url("account/delete/fees"); ?>",
            type: 'post',
            data: {e_amount:id, csrf:token},
            dataType: 'json',
            success: function (response) {
              
                if (response.success == true) {
                
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                     
                    $.notify("Fees Deleted!","success");
                      listClass(class_name);;
                    

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
                        
                      $('.list_ac_fees_msg').empty();
                      $('.list_ac_fees_msg').append(value);

                    });
                 
                }
            }
        });
    }
    }
</script>
<!-- Visit "codeastro.com" for more projects! -->