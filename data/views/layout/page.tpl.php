<!DOCTYPE html>
<html>
<head><!-- Visit "codeastro.com" for more projects! -->
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
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  
  <!-- jQuery 2.2.0 -->
  <link href="<?php echo base_url(); ?>assets/plugins/pace/pace.min.css" rel="stylesheet" type="text/css"/>
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

 <?php $this->load->view("includes/header"); ?>

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
        
			   @yield('body')
        
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
             
  </div>
  
  <?php $this->load->view("includes/footer"); ?>

  <!-- Control Sidebar -->
  <?php $this->load->view("includes/aside"); ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
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
           
      
                   
   $.post("<?php echo base_url(); ?>session/view_session", { session_id: data})
  .done(function( data ) {
     location.reload();
  });
});
       
   
    </script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/pace/pace.min.js"></script>

<script src="<?php echo base_url(); ?>assets/dist/js/vue.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/vue-resource.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/data.js" type="text/javascript"></script>

<!-- page script -->
<script>
    
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
   $(document).ajaxStart(function() { Pace.restart(); });
</script>
</body>
</html>
