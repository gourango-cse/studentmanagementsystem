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
        <li><a><i class="fa fa-user"></i>Exam</a></li>
        <li><a><i class="fa fa-user-plus active"></i> Insert Marks</a></li>

    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
<div class="row">
    <div class="col-sm-12 col-md-4">
         <div class="box ">
              
                <div class="box-body">
                    <div class="box-header add_class_msg text-red"></div>
      <?php echo form_open(base_url( 'exam/insert_marks/operation/view' ), array( 'id' => 'insert_marks', 'name' => 'insert_marks' ));?>
<!--                    <form action="<?php echo base_url(); ?>subject/manage/add" name="add_subject" id="add_subject" method="post" accept-charset="utf-8">-->
                        
                          <div class="form-group has-feedback">
                            <label>Select Class</label>
                            <select id="class_id" name ="class_id" class="form-control select_class" style="width: 100%;" tabindex="-1" aria-hidden="true">

                                <option value="0">Null</option>
                                 <?php 
                       
                            
                  foreach($class_lists as $class){
                      
                   echo '<option  value="'.$class->id.'">'.$class->name.'</option>';
      }
                 ?>
                               
                            </select>
                        </div>
                        
                       <div id="form">
                           
                       </div>
                       
                                             
                   
                        



                    <?php echo form_close();?>


                </div>


            </div>
    </div>
    <div class="col-sm-12 col-md-8" id="">
        <div id="viewIt">
            <div class="alert alert-info text-center"> Select class, exam and subject to insert marks</div>
        </div>
    </div>
</div>


<script type="text/javascript">
  
     $('#insert_marks').submit(function (l) {
        l.preventDefault();
        var me9 = $(this);
       
          var name = $('#name').val();
        $.ajax({
            url: me9.attr('action'),
            type: 'post',
            data: me9.serialize(),
            dataType: 'text',
            success: function (response) {
                $("#viewIt").empty();
                      $("#viewIt").html(response);
           
            }
        });

    });
     
    $(".select_class").change(function () {
        class_id = $(this).val();
       
        if(class_id==0){
              $('#form').empty();
           
        }else{
            
        $.ajax({
            url: "<?php echo base_url("exam/insert_marks/operation/form"); ?>",
            method: "post",
            data: {class_id: class_id, csrf: csrf_token},
            dataType: 'text',
            success: function (data) {
                $('#form').empty();
                $('#form').html(data);
                
            }
        });}
    });
   

</script>

    <!-- /.box-header -->

   
    
</section>

