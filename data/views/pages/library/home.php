<?php
/* 
 *  @package		Kodstack
 *  Author:         Ronash Dhakal
 */

?>
<!-- Visit "codeastro.com" for more projects! -->
<section class="content-header" >
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
        <li><a><i class="fa fa-user"></i>Library</a></li>
      

    </ol>
</section>
<section class="content container-fluid">
   	
  <div class="row">

     <div class="col-md-9">
                <div class="box">
                <div class="box-body">   
              
         <div id="initial">
             <table class="table table-hover table-bordered">
                 <tr>
                     <th>Name</th>
                     <th>Author</th>
                     <th>Publication</th>
                     <th>Subject</th>
                     <th>Class</th>
                 </tr>
                 <?php
foreach ($listall as $list) {
    ?>

    <tr>
        <td><?= $list->name; ?></td>
        <td><?= $list->author; ?></td>
        <td><?= $list->publication; ?></td>
        <td><?= $this->subject->get_subject($list->subject_id)->name; ?></td>
    
       <td><?= $this->sms_class->get_class($list->class_id)->name; ?></td>
    </tr>
    <?php
}
                  ?>
             </table>
         </div>
        
         <div id="listBooks"></div>
         </div> 
     </div>
  </div> 
     <div class="col-md-3">
         <div class="box">
         <div class="box-body">
             <div class="container-fluid">
                  <div class="form-group has-feedback">
                            <label>Choose Class</label>
                            <select id="class_id" name ="class_id" class="form-control select_class"  tabindex="-1" aria-hidden="true">

                                <option value="0" >Null</option>
                                 <?php 
                       
                            
                  foreach($class_lists as $class){
                      
                   echo '<option  value="'.$class->id.'">'.$class->name.'</option>';
      }
                 ?>
                               
                            </select>
                        </div>
             </div>
          
             <div class="container-fluid">
                  <div id="list_subject_form"></div>
             </div>
        
    </div>
         </div> 
         

     </div>
        </div>

        </div>

    </div>
</section>

 
<script>
     $(".select_class").change(function () {
        class_id = $(this).val();
       
        if(class_id==0){
              $('#initial').show();
              $("#listBooks").hide();
          
        }else{
            
        $.ajax({
            url: "<?php echo base_url("library/home/list_subject"); ?>",
            method: "post",
            data: {class_id: class_id, csrf: csrf_token},
            dataType: 'text',
            success: function (data) {
                $('#list_subject_form').empty();
                $('#list_subject_form').html(data);
                
            }
        });}
    });
</script>