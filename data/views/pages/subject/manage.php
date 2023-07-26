<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */


?><!-- Visit "codeastro.com" for more projects! -->
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
        <li><a><i class="fa fa-user"></i>Subject</a></li>
        <li><a><i class="fa fa-user-plus active"></i> Manage Subject</a></li>

    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">



    <!-- /.box-header -->

    <div class="row">

        <div class="col-sm-12 col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#subject_home" data-toggle="tab">Add Subject</a></li>

                    <li><a href="#assign_teacher" data-toggle="tab">Assign Teacher</a></li>
                   

                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="subject_home">
                        <!-- Post -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div id="add_subject_box">
                                   
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="list_subject">
                                    <h4>Select Class to view current subjects</h4>
                                </div>
                            </div>
                        </div>
                       
                        <!-- /.post -->

                    </div>

                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="assign_teacher">
  <div class="row">
                            <div class="col-sm-6">
                                 <div id="assign_subject_teacher_box"></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="list_subject1">
                                    <h4>Select Class to view current subjects</h4>
                                </div>
                            </div>
                        </div>
  
                    </div>
             
              

                </div>
                <!-- /.tab-content -->
            </div>
        </div>
<!--        <div class="row container-fluid" id="editBox" style="display: none">
            <div class="col-sm-6">
                <div class="box">
                    <div class="box-tools pull-right">
               
                        <button type="button" class="btn btn-box-tool" onclick="cancelIt()"><i class="fa fa-times"></i></button>
              </div>
                    <div class="box-body">
                <form action="#<?php //echo base_url("subject/manage/edit"); ?>" method="post">
                       <div class="form-group has-feedback">
                            <label>Edit Subject</label>
                             <input class="form-control" name="name" id="subject_name "value=""/>
                            <span class="fa fa-terminal form-control-feedback"></span>
                            <div id="name"></div>
                        </div>
                         <div class="form-group">
                           
                             <input type="hidden" id="subject_id" name="id" value=""/>
                           
                            
                        </div>
                     <div class="form-group has-feedback">
                           <button type="submit" class="btn btn-success" >Save</button>
                            
                           <button type="button" class="btn btn-danger" onclick="alert('are you sure to delete?')" class="btn btn-Danger" >Delete</button>
                           <button type="button" onclick="cancelIt()" class="btn btn-primary" data-widget="hide">Cancel</button>
                        </div>
                  
                    
                   
                </form>
                    </div></div>
            </div>
            </div>-->
        </div>

    </div>
    
</section>
<script type="text/javascript">
   
     $('#add_subject_post').submit(function (l) {
        l.preventDefault();
        var me9 = $(this);
         var frm = document.getElementsByName('add_subject_post')[0];

        $.ajax({
            url: me9.attr('action'),
            type: 'post',
            data: me9.serialize(),
            dataType: 'json',
            success: function (response) {
                
                if (response.success == true) {
                 
                  
                     
                    $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                    $('.text-danger').remove();
                    
                     frm.reset();
                    $.notify("Subject Added!","success");
                   
                    

                } else {
                          if(response.server_msg!=''){
            $('.add_subject_msg').empty(); 
             $('.add_subject_msg').append(response.server_msg); 
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

    });
    </script>
<script type="text/javascript">
  
      $( document ).ready(function() {
  add_subject_box();
   assign_subject_teacher_box();
});
function add_subject_box(){
        $.get("<?php echo base_url("subject/views/add_subject_box") ?>",function(data){
               $( "#add_subject_box" ).empty( data );
         $( "#add_subject_box" ).html( data );
    });
}
function assign_subject_teacher_box(){
        $.get("<?php echo base_url("subject/views/assign_subject_teacher_box") ?>",function(data){
               $( "#assign_subject_teacher_box" ).empty( data );
         $( "#assign_subject_teacher_box" ).html( data );
    });
}


  
    </script>
    