<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: Hotel Management NBPI
 *  Group: Ronash, Bikash, Dipendra, Sumit
 * 
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
  
<!--   DataTables 
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">-->
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
<!-- jQuery 2.2.0 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- notify -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/notify.js">
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
 <link href="<?php echo base_url(); ?>assets/plugins/pace/pace.min.css" rel="stylesheet" type="text/css"/>
 <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body class="hold-transition skin-purple sidebar-mini  fixed">
<!-- Site wrapper -->
<div class="wrapper ">

 <?php $this->load->view("includes/header"); ?><!-- Visit "codeastro.com" for more projects! -->

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  
<?php $this->load->view("includes/sidebar"); ?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <img style="
    position: fixed;
    z-index: 9999;
    margin-top: 15%;
    margin-left: 31%;
   display: none;
    " class="loader"src="<?php echo base_url("assets/wifi.gif"); ?>"/>     
        
    
        
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


  </div><!-- Visit "codeastro.com" for more projects! -->
  <!-- /.content-wrapper -->

  <?php $this->load->view("includes/footer"); ?>

  <!-- Control Sidebar -->
  <?php $this->load->view("includes/aside"); ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg">
      
  </div>
  
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
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
 
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url(); ?>assets/dist/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url(); ?>assets/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

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


<script>
    $('#quick_msg').wysihtml5();
     $("#select2").select2();
//  $(function () {
//    $("#example1").DataTable();
////    $('#example2').DataTable({
////      "paging": true,
////      "lengthChange": false,
////      "searching": false,
////      "ordering": true,
////      "info": true,
////      "autoWidth": false
////    });
//  });
 $(document).ajaxStart(function() { Pace.restart(); });
</script>
</body>
</html>
