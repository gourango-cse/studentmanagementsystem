
<table class="table table-hover table-bordered">
	<tr>
		<th class="text-center">File</th>
                <th>Downloaded</th>
              
		
    
    <th>Option</th>
 
	</tr>
	




	<?php 

	
foreach ($syllabus as $slbs) {
?>

<tr id="syllabus<?= $slbs->id ?>">
    <td class="text-center"><?= $slbs->name ?></td>
      <td id="count<?= $slbs->id; ?>"><?= $slbs->count; ?></td>

  	
   
      <td id="option<?= $slbs->id; ?>"><a onclick="downloadIt(<?php echo $slbs->id; ?>,<?php echo $slbs->count; ?>,'<?php echo $slbs->file; ?>')"  class="btn btn-sm btn-success" target="_blank" >Download</a>  <?php if($this->sms->is_allowed("Teacher")){ ?>| <button class="btn btn-danger"  onclick="javascript:del( <?= $slbs->id; ?>,' <?= $slbs->file; ?>')" >Delete</button> <?php } ?> </td>
   
	</tr>

<?php 
}
	?>
  <tbody id="new">
    
  </tbody>
	
</table>

<script>
    function downloadIt(id,count,file){
      
  window.location="<?php echo base_url("syllabus/download/".$slbs->id."/".$slbs->file); ?>";
  var iCount = count+1;

 
  $('#option'+id).empty();
   $('#count'+id).empty();
    $('#count'+id).append(iCount);
  $('#option'+id).append('<a onclick="downloadIt('+id+','+iCount+')"  class="btn btn-sm btn-success" target="_blank" >Download</a>  <?php if($this->sms->is_allowed("Teacher")){ ?> | <button class="btn btn-danger"  onclick="javascript:del('+id+',&#34;'+file+'&#34;)" >Delete</button> <?php } ?> ');
    }
    
</script>
 <?php if($this->sms->is_allowed("Teacher")){ ?>
<script>
  function del(id,file){


     $.ajax({
            url: "<?php echo base_url("syllabus/manage/delete_syllabus"); ?>",
            method: "post",
            data: {id: id, file:file, csrf: csrf_token},
            dataType: 'text',
            success: function (data) {
               $("#syllabus"+id).remove();
               $.notify("Syllabus Deleted!","success");
                
            }
        });
        
        }

   <?php } ?>


  
</script>