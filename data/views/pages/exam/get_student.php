<?php
//foreach ($list_student as $ls){
//    echo $ls->full_name;
//}
$subjectId =  $subject->id; 
?>
<!-- Visit "codeastro.com" for more projects! -->
<div class="box">
    <div class="box-body">
    <?php foreach ($exam as $exm) {
        $examName =  $exm->name;
        $examID = $exm->id;
    }
?>
    <div class="page-header text-center"> <?= $examName?> - Marks of <?= $subject->name; ?></div>
     <form action="<?php echo base_url(); ?>exam/insert_marks/operation/insert"  id="insertMarks" method="post" accept-charset="utf-8">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                    <div id="errorIt">
                                        <div class="alert alert-warning">Be careful while inserting marks. <br> All field are required! Once the marks has been inserted you cannot update it. Attendance and marks should be fill-up carefully.  </div>
                                        
                                    </div>                        
    <table class="table table-responsive table-bordered table-hover table-striped">
        <tr>
            <th>Student</th>
            <th class="text-center">Attendance</th>
            <th class="text-center">Marks</th>
            
            
        </tr>
        <?php
foreach ($list_student as $ls){
 
        ?> 

        <tr>
            <td><?= $ls->full_name; ?></td>
            <td class="text-center"><input required="" type="checkbox" value="<?= $ls->student_id; ?>" name="attendance[]" /></td>
            <td class="text-center"><input required="" type="number" id="marks<?= $ls->id ?>"  name="marks[]" /></td>
        </tr>
    <?php }    ?>
        
       
    </table>
                                    <input type="hidden" value="<?= $examID ?>" name="exam_id"/>
                                    <input type="hidden" value="<?= $subjectId ?>" name="subject_id"/>
                                    <input type="hidden" value="<?= $class ?>" name="class_id"/>
                 <button type="submit" name="insertMarks" class="btn btn-success">Save</button>
                  <button type="reset" name="insertMarks" class="btn btn-danger" onclick='rese()'>Reset</button>
     </form>
    <br/><Br/>
    
</div>
</div>


<script>
    function rese(){
          $('#errorIt').empty();
    }
    
  $('#insertMarks').submit(function (e) {
        e.preventDefault();
        var me = $(this);

        $.ajax({
            url: me.attr('action'),
            type: 'post',
            data: me.serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    me[0].reset();
                $('#errorIt').empty();
                    $('#errorIt').html('<div class="alert alert-success">Successfully Inserted.</div>');
                    $.notify("Marks Successfully Inserted", "success");
//                    setTimeout(function() {
//                        window.location="base_url()."class/".$class->name."/".$profile->name ?>";
//                    }, 2500);
                       
                }else{
                    $('#errorIt').empty();
                    $('#errorIt').html('<div class="alert alert-danger">'+response.msg+'</div>');
            }
            }
        });

    });
    </script>