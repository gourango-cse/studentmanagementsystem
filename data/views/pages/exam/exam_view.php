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
        <li><a><i class="fa fa-user-plus active"></i> Manage Exam</a></li>

    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">



    <!-- /.box-header -->

    <div class="row">

        <div class="col-sm-4 col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3>Manage Exam</h3>
            </div>
            <div class="box-body">
              <form action="<?php echo base_url(); ?>exam/manage/operation/add" name="add_types" id="add_types" method="post" accept-charset="utf-8">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
 <div class="form-group has-feedback">
                            <label>Name</label>
                            <input   type="text" name="exam_name" class="form-control" placeholder="Exam Name">
                            <span class="fa fa-terminal form-control-feedback"></span>
                            <div id="exam_name"></div>
                        </div>                        
                                           
                   
                        <div class="form-group has-feedback">
                            <button class="btn btn-success" type="submit" name="add_type" >Add</button>
                        </div>     



                    </form>
            </div>
          </div>
        </div>
          <div class="col-sm-8 col-xs-12">
           
<div id="list_types">

 
    </div>
             
        </div>

    </div>
    
</section>


<script type="text/javascript">
$( document ).ready(function() {
    list_types();
   
});
function list_types(){

   $.ajax({
      url:"<?php echo base_url("api/exam/type") ?>",
      method: "get",
     
      dataType: 'text',
      beforeSend: function(){
            $('.loader').fadeIn("slow");
        },
      success: function (response) {
        $('#list_types').empty();
       $('.loader').fadeOut("slow");
    $( "#list_types" ).html( response );
    }
            
  });
 
}
 $('#add_types').submit(function (e) {
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
                   
                    $.notify("Exam Added","success");
                  
                        list_types();

                } else {
                          if(response.server_msg!=''){
            $('.add_class_msg').empty(); 
             $('.add_class_msg').append(response.server_msg); 
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