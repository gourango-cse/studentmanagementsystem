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
        <li><a><i class="fa fa-user"></i>Notice Board</a></li>
      

    </ol>
</section>
<section class="content container-fluid">
   	
  <div class="row">
<?php if($this->sms->is_allowed('Admin')){ ?>
     <div class="col-md-6 col-sm-12">
         <?php }else{?>
              <div class="col-sm-12">
         <?php } ?>
                <div class="box">
                <div class="box-body">   
              
         <div id="initial">
         <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
             <?php 
                     foreach ($notice as $nt){
             ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <?= $nt->title ?> - <?= $nt->created_at?>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
                  <?= $nt->body ?>

      </div>
    </div>
  </div>
                     <?php } ?>
</div>
         </div>
        
         <div id="listBooks"></div>
         </div> 
     </div>
  </div> 
    <?php if($this->sms->is_allowed('Admin')){ ?>
     <div class="col-md-6 col-sm-12">
         <?php }else{?>
              <div class="col-sm-12">
         <?php } ?>
                   <?php if($this->sms->is_allowed('Admin')){ ?>
         <div class="box">
         <div class="box-body">
             <div class="container-fluid">
                <form action="<?php echo base_url(); ?>notice/view/add" name="addNotice" id="addNotice" method="post" accept-charset="utf-8">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
 <div class="form-group has-feedback">
                            <label>Title</label>
                            <input   type="text" name="title" class="form-control" placeholder="Subject">
                            <span class="fa fa-terminal form-control-feedback"></span>
                            <div id="title"></div>
                        </div>   
<div class="form-group has-feedback">
                            <label>Body</label>
                            <textarea   type="text" name="description" class="form-control" placeholder="Subject"></textarea>
                            <span class="fa fa-terminal form-control-feedback"></span>
                            <div id="description"></div>
                        </div>
<button type="submit" name="addNOtice" class="btn btn-success" >Add</button>
             </div>
          
           
        
    </div>
         </div> 
         
                   <?php } ?>
     </div>
        </div>

        </div>

    </div>
</section>

 
<script>
   $('#addNotice').submit(function (e) {
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
                   
                    $.notify("Successfully Added","success");
                  setTimeout(function() {
                        window.location="<?= base_url()?>notice";
                    }, 2000);
                    

                } else {
                          if(response.server_msg!=''){
            $('.server_msg').empty(); 
             $('.server_msg').append(response.server_msg); 
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