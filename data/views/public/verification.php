
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>School Management System | Verification</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
        <!-- jQuery 2.2.0 -->
        <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <!-- notify -->
        <script src="<?php echo base_url(); ?>assets/notify.js" type="text/javascript"></script>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?php echo base_url(); ?>"><b>SMS</b>Account verification</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">School management System</p>
                <div class="alert alert-danger " id="status" style="display: none;"></div>
                 <div class="alert alert-success " id="statuss" style="display: none;"></div>
                <form action="<?php echo base_url(); ?>session/change_password" id="login" method="post">
                    <div class="form-group has-feedback">
                        <input id="email" type="text" name="email" class="form-control" placeholder="Username/Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input id="password" type="password" name="password" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember" value="TRUE"> Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button id="submit" type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

              
            </div>
            <!-- /.login-box-body -->

        </div>
        <!-- /.login-box -->

        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->

        <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
        <script>
        
    function member(){
   window.location = "<?php echo base_url(); ?>home";
}

                        $(function () {
                            $('input').iCheck({
                                checkboxClass: 'icheckbox_square-blue',
                                radioClass: 'iradio_square-blue',
                                increaseArea: '25%' // optional
                            });
                        });
//                        
                        // Form submit
                        (function ($) {
                            $("body").on("submit", "#login", function (e) {
                                e.preventDefault();
                                var form = $(e.target);
                                $.post(form.attr("action"), form.serialize(), function (status) {
                                    if (status == 1) {
                                        $("#statuss").fadeIn('slow');
                                           $("#statuss").empty();
                                        $("#statuss").html('Welcome To School Management System');
                                        $.notify("Request Verified!","success");
                                       setTimeout(member, 2000);
                                    } 
                                    else {
                                            $("#status").fadeIn('slow');
                                           $("#status").empty();
                                        $("#status").html(status);
                                        $.notify("Login Failed!", "error");
                                        


                                    }
                                });
                            });
                        })(jQuery);

                        // $.get("<?php //echo base_url()  ?>session/msg_log", function(msg_log){
                        //           $("#status_msg").append(msg_log);
                        //    });
        </script>

    </body>
</html>



