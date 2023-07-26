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

                     
<!--                           <div class="form-group has-feedback">
                            <label>Name</label>
                            <input   type="file" name="file" id="file" class="form-control" >
                            <span class="fa fa-terminal form-control-feedback"></span>
                            <div id="file"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Upload File*</label>
                            <input   type="file" name="file" id="file" class="form-control" >
                            <span class="fa fa-terminal form-control-feedback"></span>
                            <div id="file"></div>
                        </div>
                        
                       
                                             
                   
                        <div class="form-group has-feedback">
                            <button class="btn btn-success" type="submit" name="add_sllabus" >Add </button>
                        </div>     -->
      

<script>
      $(".list_subject").change(function () {
        subject_id = $(this).val();
       
        if(subject_id==0){
            
        }else{

           
            
        $.ajax({
            url: "<?php echo base_url(); ?>study/home/viewMaterial",
            method: "post",
            data: {subject_id: subject_id, class_id: <?php  echo $class; ?> , csrf: csrf_token},
            dataType: 'text',
            success: function (data) {
                   $('#initial').hide();
                     $('#listMaterial').show();
                
                $('#listMaterial').empty();
                $('#listMaterial').html(data);
                
            }
        });

    }
    });

</script>