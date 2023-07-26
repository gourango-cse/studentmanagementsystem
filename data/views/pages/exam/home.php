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
              <h3>Search Result</h3>
            </div>
            <div class="box-body">
              <form action="<?php echo base_url(); ?>exam/home/search" name="search" id="search" method="post" accept-charset="utf-8">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                       
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


                    </form>
            </div>
          </div>
        </div>
          <div class="col-sm-9 col-xs-12">
           
<div id="listResult">

    <div class='alert alert-info'>Select class, exam and subject to view your result.</div>
    </div>
             
        </div>

    </div>
    
</section>


<script type="text/javascript">
 $(".select_class").change(function () {
        class_id = $(this).val();
       
        if(class_id==0){
              $('#form').empty();
           
        }else{
            
        $.ajax({
            url: "<?php echo base_url("exam/home/form"); ?>",
            method: "post",
            data: {class_id: class_id, csrf: csrf_token},
            dataType: 'text',
            success: function (data) {
                $('#form').empty();
                $('#form').html(data);
                
            }
        });}
    });
 $('#search').submit(function (e) {
        e.preventDefault();
        var me = $(this);

        $.ajax({
            url: me.attr('action'),
            type: 'post',
            data: me.serialize(),
            dataType: 'text',
            success: function (response) {
                
               $('#listResult').empty();
                $('#listResult').html(response);
            }
        });

    });
    
   
    </script>
