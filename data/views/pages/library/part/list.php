<!-- Visit "codeastro.com" for more projects! -->
<table class="table">
	<tr>
		<th class="text-center">Name</th>
		<th class="text-center">Author</th>
		<th class="text-center">Publication</th>
      <?php if($this->sms->is_allowed("Admin")){ ?>
    <th>Option</th>
    <?php  } ?>
	</tr>
	
<!-- Visit "codeastro.com" for more projects! -->



	<?php 

	
foreach ($books as $book) {
?>

<tr id="book<?= $book->id ?>">
		<td class="text-center"><?= $book->name ?></td>
		<td class="text-center"><?= $book->author ?> </td>
		<td class="text-center"><?= $book->publication ?></td>
    <?php if($this->sms->is_allowed("Admin")){ ?>
    <td><button class="btn btn-danger"  onclick="javascript:del( <?= $book->id; ?>)" >Delete</button></td>
    <?php } ?> 
	</tr>

<?php 
}
	?>
  <tbody id="new">
    
  </tbody>
	
</table>
 <?php if($this->sms->is_allowed("Admin")){ ?>
<script>
  function del(id){


     $.ajax({
            url: "<?php echo base_url("library/manage/delete_book"); ?>",
            method: "post",
            data: {id: id, csrf: csrf_token},
            dataType: 'text',
            success: function (data) {
               $("#book"+id).remove();
               $.notify("Book Deleted!","success");
                
            }
        });
        
        }

   <?php } ?>


  
</script>