<?php
/*
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
?>
<!-- Visit "codeastro.com" for more projects! -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $page_title; ?>
        <small><?php
            if (isset($page_slogan)) {
                echo $page_slogan;
            }
            ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a><i class="fa fa-user"></i>View Result</a></li>
   

    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">



    <!-- /.box-header -->

    <div class="row">

        <div class="col-md-3 col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3>Get Result</h3>
            </div>
            <div class="box-body">
                <div id="error_msg"></div>
<div id="server_msg"></div>
              <form action="<?php echo base_url(); ?>exam/routine/add" name="routine" id="routine" method="post" accept-charset="utf-8">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                       
                          <div class="form-group has-feedback">
                            <label>Select Exam</label>
                            <select id="exam_id" name ="exam_id" class="form-control select_exam" style="width: 100%;" tabindex="-1" aria-hidden="true">

                                <option value="0">Null</option>
                                 <?php 
                       
                            
                  foreach($examTypes as $exam){
                      
                   echo '<option  value="'.$exam->id.'">'.$exam->name.'</option>';
      }
                 ?>
                               
                            </select>
                        </div>     


             <?php  if($this->sms->is_allowed('Admin')){?>  
 <div class="form-group has-feedback">
                            <label>Upload Routine</label>
                            <input type="file" name="file"/>
                        </div>  
<button class="btn btn-success" type="submit">Add</button>
             <?php } ?>
                    </form>
            </div>
          </div>
        </div>
          <div class="col-sm-9 col-xs-12">
           
<div id="listResult">

    <div class='alert alert-info'>Select exam to view Routine.</div>
    </div>
             
        </div>

    </div>
    
</section>


<script type="text/javascript">
 $(".select_exam").change(function () {
        exam_id = $(this).val();
       
        if(exam_id==0){
              $('#listResult').empty();
           
        }else{
            
        $.ajax({
            url: "<?php echo base_url("exam/routine/view"); ?>",
            method: "post",
            data: {exam_id: exam_id, csrf: csrf_token},
            dataType: 'text',
            success: function (data) {
                $('#listResult').empty();
                $('#listResult').html(data);
                
            }
        });}
    });
     $('#routine').submit(function (e) {
            //$('.loader').show("slow");
        e.preventDefault();
        var formData = new FormData($(this)[0]);
       var frm = document.getElementsByName('addSyllabus')[0];
      
        $.ajax({
            url: '<?php echo base_url('exam/routine/add'); ?>',
            type: 'post',
            data: formData,
            dataType: 'json',
             async: true,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                     beforeSend: function(){
            $('.loader').fadeIn("slow");
        },
            success: function (response) {
                $('.loader').fadeOut("slow");
                if (response.success == true) {
                        
                     $.notify("Successfully Added", "success");
                   $("#error_msg").empty();
                            
                            $("#error_msg").append(response.server_msg);
                   // $('#the-message').fadeIn('slow');
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                    frm.reset();
                  $("#file").val("");
                    

                } else {
                    
                    
                         if(response.server_msg){
                            $("#server_msg").empty();
                            
                            $("#server_msg").append(response.server_msg);
                         }
                    $.each(response.msg, function (key, value) {
                        var element = $('#' + key);
                        element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger').remove();
                        element.after(value);

                    });
                    $.notify("Failed", "error");
                }
            }
        });

    });
    
   
    </script>
