<?php
/* 
 *  @package		Kodstack
 *  Author:         Ronash Dhakal
 */
?>
<!-- Visit "codeastro.com" for more projects! -->
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
        <li><a><i class="fa fa-user"></i>Account</a></li>
        <li><a><i class="fa fa-user-plus active"></i> Fees</a></li>

    </ol>
</section>
<section class="content container-fluid">
   <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#fee" data-toggle="tab">Monthly Fees</a></li>
<!--                <li><a href="#create_fee" data-toggle="tab">Admission</a></li>
                 <li><a href="#create_exam_fee" data-toggle="tab">Exam</a></li>-->
            
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="fee">
                <!-- Post -->
            
    <div class="row">

        <div class="col-md-4">
            <div class="box">
                <div class="box-header bg-purple">
                    <h3>Make Invoice</h3>
                </div>
                <div class="box-body">
                    <form class="form-group" action="<?php echo base_url("account/get_status") ?>" method="post" id="get_status" name="get_status">
                        <div class="form-group">
     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                           
                        </div>
                         <div class="form-group">
                             <h5>Payment Type: Monthly</h5>
                             <input type="hidden" name="type" value="2"/>
                        </div>
                        
                         <div class="form-group">
                            <label>Class</label>
                            <select   name="class_id" class="form-control select2 select2-hidden-accessible list_class" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="0" selected="selected">Select Class</option>
                                <?php
                                foreach ($list_class As $class) {

                                    echo '<option value="' . $class->id . '">' . $class->name . '</option>';
                                }
                                ?>

                            </select><!-- Visit "codeastro.com" for more projects! -->
                            <div id="class_id"></div>
                        </div>
                          <div id="student_list">
                          
                        </div>
                       
                    </form>
                    <script type="text/javascript">
                          $(".list_class").change(function () {
            class_id = $(this).val();
             
                         $.ajax({
                url: "<?php echo base_url("account/list_student"); ?>",
                method: "post",
                data: {csrf: csrf_token, class_id:class_id},
                dataType: 'text',
                success: function (data) {

                    $('#student_list').empty();
                    $('#student_list').html(data);

                }
            });
                 });
                 
                   
      
                 
              
                      $('#get_status').submit(function (e) {
            e.preventDefault();
            var me = $(this);
          

            $.ajax({
                url: me.attr('action'),
                type: 'post',
                data: me.serialize(),
                dataType: 'text',
                success: function (response) {
                   $('#server').empty();
                    $('#server').html(response);
                }
            });

        });</script>
                </div>
            </div>
            
        </div>
        <div class="col-md-8">
             <div id='server'>
               
            </div>
            
        </div>


    </div>
                <!-- /.post -->

              </div>
                
                 <div class="tab-pane" id="create_fee">
                <!-- Post -->
            
    <div class="row">
        <div class="col-md-6">
            <div class="box ">
                <div class="box-header bg-purple">
                    <h4>Manage Fees</h4>

                </div>
                <div class="box-body">
                    <div class="box-header add_class_msg text-red"></div>
                    <form action="<?php echo base_url(); ?>account/create/fees" name="create_fees" id="create_fees" method="post" accept-charset="utf-8">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                         <!-- Visit "codeastro.com" for more projects! -->
                        <div class="form-group">
                            <label>Class</label>
                            <select   name="class_id" class="form-control select2 select2-hidden-accessible list_class" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="0" selected="selected">Select Class</option>
                                <?php
                                foreach ($list_class As $class) {

                                    echo '<option value="' . $class->id . '">' . $class->name . '</option>';
                                }
                                ?>

                            </select>
                            <div id="class_id"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Account Type</label>
                             <select   name="ac_type" class="form-control select2 select2-hidden-accessible sel_ac_type" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="0" selected="selected">Select Account Type</option>
                                <optgroup id="select_ac_type">
 <?php
                                
                                foreach ($this->ac->list_type() As $lt) {

                                    echo '<option value="' . $lt->id . '">' . $lt->name . '</option>';
                                }
                                ?>
                                </optgroup>
                            </select>
                           
                            <div id="ac_type"></div>
                        </div> 
                        <div class="form-group has-feedback">
                            <label>Amount</label>
                            <input   type="text" name="amount" class="form-control" placeholder="Amount">
                            <span class="glyphicon glyphicon-menu-left form-control-feedback"></span>
                            <div id="amount"></div>
                        </div> 
                        <div class="form-group has-feedback">
                            <button class="btn btn-success" type="submit" name="create_fees" >Add</button>
                        </div>     



                    </form>


                </div>


            </div>
        </div>
        <!-- Visit "codeastro.com" for more projects! -->
        <div class="col-md-6">
             <div class='list_ac_fees_msg'>
             
            </div>
            <div class='list_ac_fees'>
                <h3>Select class to view Fees</h3>
                <hr/>
            </div>
        </div>
    </div>

    <script type="text/javascript">
      
        function listClass(class_id) {
            $.ajax({
                url: "<?php echo base_url("account/list/fees"); ?>",
                method: "post",
                data: {class_id: class_id, csrf: csrf_token},
                dataType: 'text',
                success: function (data) {

                    $('.list_ac_fees').empty();
                    $('.list_ac_fees').html(data);

                }
            });
        }

        $('#create_fees').submit(function (e) {
            e.preventDefault();
            var me = $(this);
            cid = $('.list_class option:selected').val();

            $.ajax({
                url: me.attr('action'),
                type: 'post',
                data: me.serialize(),
                dataType: 'json',
                success: function (response) {

                    if (response.success == true) {
                        $('.sel_ac_type').select2('val', '');
                        $('.list_class').select2('val', '');
                        $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                        $('.text-danger').remove();
                        me[0].reset();

                        $.notify("Successfully Added!", "success");


                        listClass(cid);


                    } else {
                        if (response.server_msg != '') {
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
                <!-- /.post -->

              </div>
             
            </div>
            <!-- /.tab-content -->
          </div>



</section>
<!-- Visit "codeastro.com" for more projects! -->