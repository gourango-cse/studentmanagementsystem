<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */

?>
<!-- Visit "codeastro.com" for more projects! -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $page_title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  
 <!-- DataTables --><!-- Visit "codeastro.com" for more projects! -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
   <link href="<?php echo base_url(); ?>assets/plugins/pace/pace.min.css" rel="stylesheet" type="text/css"/>
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- jQuery 2.2.0 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>

<script src="<?php echo base_url(); ?>assets/notify.js" type="text/javascript"></script>
 


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body class="hold-transition skin-purple fixed sidebar-mini">
<div class="wrapper">

 <?php $this->load->view("includes/header"); ?><!-- Visit "codeastro.com" for more projects! -->
  <!-- Left side column. contains the logo and sidebar -->
 
 <?php $this->load->view("includes/sidebar"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <img style="
    position: fixed;
    z-index: 9999;
    margin-top: 15%;
    margin-left: 33%;
    display: none;
    " class="loader"src="<?php echo base_url("assets/wifi.gif"); ?>"/>

    <!-- Main content -->
     <?php $this->load->view($main_content); ?>
     <script type="text/javascript">
              function banUser(id){
                  alert(id);
              }
              function resend_code(id){
                  alert(id);
              }
               function unBanUser(id){
                  alert(id);
              }
              </script>
    <!-- /.content -->
    <div class="loader" style="
         position: fixed;
    top: 0;
    left: 0;
    background: rgba(96, 125, 139, 0.42);
    z-index: 5;
    width: 100%;
    height: 100%;
    display: none;
        ">         
    </div>
    
  </div>
  <?php $this->load->view("includes/footer"); ?>

  <!-- Control Sidebar -->
  <?php $this->load->view("includes/aside"); ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
 <script type="text/javascript">
      
        $( ".view_session" ).change(function() {
             var data = $(this).val();
              $('.loader').fadeIn("slow");
           
      
                   
   $.post("<?php echo base_url(); ?>session/view_session", { session_id: data})
  .done(function( data ) {
     location.reload();
  });
});
       
   
    </script>
  
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker 
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url(); ?>assets/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/pace/pace.min.js"></script>


<!-- Page script -->
<script type="text/javascript">
     //$("#example1").DataTable();
                        //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
                        </script>
<script>
    
   
  $(function () {
        $("#example1").DataTable();
    //Initialize Select2 Elements
    $(".select2").select2();

//    //Datemask dd/mm/yyyy
//    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
//    //Datemask2 mm/dd/yyyy
//    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
//    //Money Euro
   $("[data-mask]").inputmask();
//
//    //Date range picker
//    $('#reservation').daterangepicker();
//    //Date range picker with time picker
//    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
//    //Date range as a button
//    $('#daterange-btn').daterangepicker(
//        {
//          ranges: {
//            'Today': [moment(), moment()],
//            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
//            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//            'This Month': [moment().startOf('month'), moment().endOf('month')],
//            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//          },
//          startDate: moment().subtract(29, 'days'),
//          endDate: moment()
//        },
//        function (start, end) {
//          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
//        }
//    );
//
//    
//
//    //iCheck for checkbox and radio inputs
//    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
//      checkboxClass: 'icheckbox_minimal-blue',
//      radioClass: 'iradio_minimal-blue'
//    });
//    //Red color scheme for iCheck
//    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
//      checkboxClass: 'icheckbox_minimal-red',
//      radioClass: 'iradio_minimal-red'
//    });
//    //Flat red color scheme for iCheck
//    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
//      checkboxClass: 'icheckbox_flat-green',
//      radioClass: 'iradio_flat-green'
//    });
//
//    //Colorpicker
//    $(".my-colorpicker1").colorpicker();
//    //color picker with addon
//    $(".my-colorpicker2").colorpicker();
//
//    //Timepicker
//    $(".timepicker").timepicker({
//      showInputs: false
//    });
  });
   $(document).ajaxStart(function() { Pace.restart(); });
</script>
</body>
</html>
