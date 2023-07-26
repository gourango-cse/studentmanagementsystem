<!-- Visit "codeastro.com" for more projects! -->
<h3>Fee Status of <?php echo $student->full_name;  
if($total_amount!=FALSE){
                   $amount = $total_amount->amount;
               }else{
                   $amount = "Fees has not been decleared yet";
               } ?></h3>

<div class="panel">
    <?php echo "<h5>Class Monthly Fees: $".$amount."</h5>"; ?>
</div>

<div id="server"></div>
<table class="table table-hover table-bordered">
    <tr>
        <th>Month</th><th>Status</th><th class="text-center">Action </th>
        
    </tr>
    
        <?php
   
        foreach ($list_month as $month) {
            $check = $this->ac->check_fee_status($student->id, $month->id);
           if($check==FALSE){          
             
               $status = '<div class="row">'
                       . '<form action="'.  base_url("account/operation/add").'" method="post" name="pay" id="pay'.$month->id.'">'
                       . '<div class="form-group">'
                       . '<div class="col-sm-12 col-md-6">'
                       . ' <input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'. $this->security->get_csrf_hash().'">
'
                       . '<input type="hidden" value="'.$month->id.'" name="month"/>'
                      . '<input type="hidden" value="'.$student->id.'" name="student"/>'
                       . '<input id="fees" type="hidden" class="form-control" name="fees" value="'.$total_amount->amount.'" />'
                       . '</div>'
                       . '<div class="col-sm-12 col-md-6">'
                       . '<button class="btn btn-success" type="submit" name="pay'.$month->id.'">Pay</button>'
                       . '</div>'
                       . '</div>'
                       . '</form>'
                       . '</div>';
               
            echo '<tr><td id="'.$month->id.'">'.$month->name.'</td><td>Not Paid</td><td>'.$status.'</td> </tr>'; 
           ?>
                <script>
                       $('#pay<?php echo $month->id; ?>').submit(function (e) {
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
$.notify("Click on get status to view change!", "info");
                        $.notify("Successfully Paid!", "success");
                          
                    } else {
                        if (response.server_msg != '') {
                       
                            $('#server').append(response.server_msg);
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

        });</script>
 <?php 
           }   else{
             
              $status = "<button class='btn btn-danger' onmouseup='javascript:delpay(".$month->id.",".$student->id.")' >Paid</button>";  
             
 echo '<tr><td id="'.$month->id.'">'.$month->name.'</td><td>Paid</td><td>'.$status.'</td> </tr>';    
           }

         

       
        }
        ?>
                <script>
                function delpay(month, student){
                    
                     $.ajax({
                url: "operation/unpay",
                type: 'post',
                data: {csrf: csrf_token, month:month, student:student },
                dataType: 'text',
                success: function (response) {
                     $.notify(response, "success");
                      $.notify("Click on get status to view change!", "info");
                    
                }
                
            });
        }
                </script>
</table>
<!-- Visit "codeastro.com" for more projects! -->
