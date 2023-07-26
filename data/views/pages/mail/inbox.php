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
        Mailbox
        <small id="count_msg4"></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="#" onclick="compose()" class="btn btn-success btn-block margin-bottom">Compose</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                  <li class="active"><a onclick="showIt()"href="#"><i class="fa fa-inbox"></i> Inbox
                        <?php if($count_unread!=0): ?>
                        <span class="label label-primary pull-right" id="count_msg3"><?php echo $count_unread; ?></span><?php endif; ?></a></li>
<!--                <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
                </li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>-->
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
<!--          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Labels</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
              </ul>
            </div>
             /.box-body 
          </div>-->
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div id="readMsg">
            </div>
                <div id="inboxAll">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
  
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
            
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table  class="table table-hover table-bordered table-striped">
                  <tbody>
                      <?php
                      if($list_inbox!=NULL){
                      
                      foreach ($list_inbox as $inbox){
                        $data =   $this->sms->get_user($inbox->sender_id);
                          ?>
                      
                  <tr>
                    <td><input type="checkbox"></td>
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                    <td class="mailbox-name"><a href="#" onclick="readIt(<?= $inbox->id?>)"><?php echo $data->full_name; ?></a>  &neArr; <sup><?php echo $data->role; ?></sup></td>
                    <td class="mailbox-subject"><b><?php echo $inbox->title; ?></b> - <?php echo substr($inbox->message, 0, 30) ?>...
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date"><?php echo$inbox->date_sent; ?></td>
                  </tr>
                      <?php } } else { ?>
                  <tr>
                      <td>You have not any mail in your inbox</td>
                  </tr>
                  <?php  }  ?>                    
                      

                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
               
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        
      </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    
    
    
    
    <script>
        
        function compose(){
              $.ajax({
            url: "<?= base_url()?>mail/message/compose",
            method: "get",
           
            dataType: 'text',
            success: function (data) {
                $("#inboxAll").hide();
               $("#readMsg").empty();
                 $("#readMsg").append(data);
              
               
        }
    });
    }
        function readIt(id){
           
              $.ajax({
            url: "<?= base_url()?>mail/read",
            method: "post",
            data:{csrf:csrf_token, id:id },
            dataType: 'text',
            success: function (data) {
                $("#inboxAll").hide();
               $("#readMsg").empty();
                 $("#readMsg").append(data);
              
                
            }
        });
        
        }
          
        function showIt(){
            
            $("#inboxAll").show();
               $("#readMsg").empty();
                
              
        
        }
        
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>