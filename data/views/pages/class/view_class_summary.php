 <!-- Visit "codeastro.com" for more projects! -->
 <div class="box">
                                    <div class="box-header bg-purple">
                                        <h4>Class Summary</h4>

                                    </div>
                                    <div class="box-body ">
                                        <table class="table table-hover table-bordered table-responsive">
                                            <tr>
                                                <th class="text-center">Section</th>
                                                <th class="text-center">Section Teacher</th>
                                                <th class="text-center">Total Students</th>
                                            </tr>
<?php 
$list_section_index = $this->sms_class->list_section($profile->id);
if($list_section_index!=FALSE){
foreach ($list_section_index as $section):
    ?>
                                                <tr>
                                                    <td class="text-center"><a class="btn btn-primary btn-md" href="<?php echo base_url("class/" . strtolower($profile->name) . "/" . strtolower($section->name)) ?>"><b><?php echo $section->name ?></b></a></td>
                                                    <td class="text-center"><?php
                                            if($section->teacher_id!=NULL AND $section->teacher_id!=0){
                                           echo $this->sms_class->get_class_teacher($section->teacher_id)->full_name;
                                            }else{
                                                echo "N/A";
                                            }
                                            ?></td>
                                                    <td class="text-center"><?php 
                                                    
                                                    if($this->student->count($profile->id, $section->id)!=0){
                                                       echo $this->student->count($profile->id, $section->id);
                                                    }else{
                                                        if($this->sms->is_member('Teacher')){
                                                        echo "<a class='btn btn-danger' onclick='javascript:delete_section(\"".$section->id."\")'>Delete</a>";
                                                    }else{
                                                        echo "NULL";
                                                    }}
                                                    
                                                    ?></td>
                                                </tr>
<?php endforeach;}else{
echo "<tr><td class='text-center'>N/A</td>";
echo "<td class='text-center'>N/A</td>";
echo "<td class='text-center'>N/A</td> </tr>";

} ?>
                                        </table>
                                    </div>
                                </div>
<script type="text/javascript">
function delete_section(id){
    $.ajax({
            url: "<?php echo base_url('class/manage/delete_section'); ?>",
            type: 'post',
            data: {id:id,csrf:csrf_token},
            dataType: 'text',
            success: function (response) {
                if(response==true){
              view_class_summary_box();
              assign_section_teacher_box();
               
                    $.notify("Successfully Deleted!","success");

                } else {
                                 
                $.notify("You Cannot delete this section","error");
              
                }
            }
        });
 }
</script>