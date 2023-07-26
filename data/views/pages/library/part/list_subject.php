<!-- Visit "codeastro.com" for more projects! -->
<?php

 if($subjects){
        
              
              
              
              echo ''
        . ' <div class="form-group">
                            <label>Subject</label>
                            <select   name="subject_id" class="form-control list_subject" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="0" selected="selected">Select Subject</option>';
     
        foreach ($subjects as $subject){
           
            echo '<option value="' . $subject->id . '">' . $subject->name.'</option>';
            
       
            
        }
        
        echo ''
        . ' </select>
                            <div id="subject_id"></div>
                        </div>';
      
       
 }else{
     echo "<h5 class='text-danger'>Subject does not exists!</h5><a target='_blank' href='".base_url()."subject/manage'>Click here</a> to add subject</br>";
 }

?>

<script>
      $(".list_subject").change(function () {
        subject_id = $(this).val();
       
        if(subject_id==0){
             alert("Please chose class id first");
        }else{

           
            
        $.ajax({
            url: "<?php if($this->sms->is_allowed('Admin')){echo base_url("library/manage/viewBook");} else { echo base_url("library/home/viewBook"); }; ?>",
            method: "post",
            data: {subject_id: subject_id, class_id: <?php  echo $class; ?> , csrf: csrf_token},
            dataType: 'text',
            success: function (data) {
                   $('#initial').hide();
                     $('#listBooks').show();
                
                $('#listBooks').empty();
                $('#listBooks').html(data);
                
            }
        });

    }
    });

</script>