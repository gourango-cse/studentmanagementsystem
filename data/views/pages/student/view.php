<?php
/*
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
?>
<!-- Visit "codeastro.com" for more projects! -->
<section class="content-header">
    <h1>
<?php echo $page_title; ?>
        <small><?php if (isset($page_slogan)) {
    echo $page_slogan;
} ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

    </ol>
</section>
<!-- Visit "codeastro.com" for more projects! -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
               <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fa fa-play"></i></span>

                <div class="info-box-content">
                    <div class="form-group">
                        <label>Running Session</label>
                        <select id="select2" class="form-control select2 select2-hidden-accessible view_session" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option selected  disabled>(<?php echo $running_session; ?>)</option>
                            <optgroup >                   
                                <?php
                                foreach ($list_sessions as $session) {
                                    if ($running_session == $session->session) {
                                        $c = " Recent";
                                    } else {
                                        $c = NULL;
                                    }
                                    echo '<option  value="' . $session->id . '">' . $session->session . $c . '</option>';
                                }
                                ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <!-- /.info-box-content -->
            </div>
       <!-- Visit "codeastro.com" for more projects! -->
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
                 <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fa fa-th"></i></span>

                <div class="info-box-content">
                    <div class="form-group">
                        <label>Select Class</label>
                        <select id="select2" class="form-control select2 select2-hidden-accessible class_list" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option selected value="0">Select Class</option>
                            <?php foreach ($list_class as $l_class): ?>
                                <option value="<?php echo $l_class->id; ?>"><?php echo $l_class->name; ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                </div>
                <!-- /.info-box-content -->
            </div>
      
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fa fa-th"></i></span>

                <div class="info-box-content">
                    <div class="form-group">
                        <label>Select Section</label>
                        <select id="select2" class="form-control  section_list" style="width: 100%;" tabindex="-1" aria-hidden="true">

                        </select>
                    </div>
                </div>
                <!-- /.info-box-content -->
            </div>
           
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
                <span class="info-box-icon bg-olive"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Student</span>
                    <span class="info-box-number count_student"><?php echo $total_student; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
    <div class="box ">
        <div class="box-header">
            <h3 class="box-title">List of Students</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body" id="students">
            <table id="example1" class="table table-bordered table-hover table-striped container-fluid">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Roll</th>
                        <th>Address</th>
                        <th>Gender</th>
                     
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody id ='list_here'>

                    <?php foreach ($list_student as $student){ ?>

                    <tr>
                            <td><img  class="image img-md img-rounded img-responsive" src="<?php echo base_url("uploads/pro_pic/") . "/" . $student->pro_pic; ?>"</td>
                            <td><?php echo $student->full_name ?></td>
                            <td><?php echo $student->email ?></td>
                            <td><?php echo $this->sms_class->get_class_name_by_id($student->class_id); ?></td>
                            <td><?php echo $this->sms_class->get_section_name_by_id($student->section_id); ?></td>
                            <td><?php echo $student->roll ?></td>
                            <td><?php echo $student->address ?></td>
                            <td><?php echo $student->gender ?></td>
                          
                            <td><div class="btn-group">
                  <button type="button" class="btn btn-primary">Action</button>
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                      <li><a href="<?php echo base_url('student/'.$student->name); ?>" target="_blank">View</a></li>
                      <?php if($this->session->userdata('id')!=$student->id){ ?>
                    <li><a href="<?php echo base_url('mail/compose/'.$student->id); ?>"> Send Mail</a></li>
                    <?php } ?>
                    <?php if($this->sms->is_allowed('Teacher')){ ?>
                    <li class="divider"></li>
                    <li><a href="#" onclick="banUser('<?php echo $this->encrypt->encode($student->id) ?>')">Banned Student</a></li>
                    <?php } ?>
                  </ul>
                </div></td>
                        </tr>
                    <?php } ?>



                </tbody>

            </table>
        </div>
        <!-- /.box-body -->
    </div>
</section>

<script type="text/javascript">

function count_student(class_id, section_id){
    
    $.ajax({
            url: "<?php echo base_url("student/view/count"); ?>",
            method: "post",
            data: {class_id: class_id, section_id: section_id,csrf:csrf_token},
            dataType: 'text',
            success: function (data) {
                
                 $('.count_student').empty();
                $('.count_student').append(data);
            }
        });
  
}

    $(".class_list").change(function () {
        class_id = $(this).val();

        $.ajax({
            url: "<?php echo base_url("student/list_section"); ?>",
            method: "post",
            data: {class_id: class_id,csrf:csrf_token},
            dataType: 'text',
            success: function (data) {
                $('.section_list').html(data);
                
            }
        });
    });

/////fetch student list


    $(".section_list").change(function () {
       section_id = $(this).val();

        $.ajax({
            url: "<?php echo base_url("student/list_student"); ?>",
            method: "post",
            data: {class_id: class_id, section_id: section_id,csrf:csrf_token},
            dataType: 'text',
            success: function (data) {
               
                $('#list_here').html(data);
                count_student(class_id, section_id);
        
            }
        });
    });
   
</script>