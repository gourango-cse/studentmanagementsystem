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
        <li><a><i class="fa fa-user"></i>Class</a></li>
        <li><a><i class="fa fa-user-plus active"></i> Add Class</a></li>

    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">



    <!-- /.box-header -->

    <div class="row">

        <div class="col-sm-4 col-xs-12">
            <div id="add_class_box"></div>
             <hr>
             <div id="assign_class_teacher_box"></div>

        </div>
          <div class="col-sm-8 col-xs-12">
           
<div id="list_class">
  
    </div>
             
        </div>

    </div>
    
</section>
<!-- Visit "codeastro.com" for more projects! -->
<script type="text/javascript">
   function manage_class(id){
       alert(id);
   }
    $( document ).ready(function() {
    list_class();
    add_class_box();
    assign_class_teacher_box();
});
function assign_class_teacher_box(){
        $.get("<?php echo base_url("class/views/assign_class_teacher_box") ?>",function(data){
               $( "#assign_class_teacher_box" ).empty( data );
         $( "#assign_class_teacher_box" ).html( data );
    });
}
function add_class_box(){
        $.get("<?php echo base_url("class/views/add_class_box") ?>",function(data){
               $( "#add_class_box" ).empty( data );
         $( "#add_class_box" ).html( data );
    });
}
function list_class(){

   $.ajax({
      url:"<?php echo base_url("class/views") ?>",
      method: "get",
     
      dataType: 'text',
      beforeSend: function(){
            $('.loader').fadeIn("slow");
        },
      success: function (response) {
       $('.loader').fadeOut("slow");
    $( "#list_class" ).html( response );
    }
            
  });
 
}

  
    
    
   
</script>
