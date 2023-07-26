<?php
/*
 *  Author: Ronash Dhakal
 *  Project: Hotel Management NBPI
 *  Group: Ronash, Bikash, Dipendra, Sumit
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>School Management System | Register</title>
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
        <!--date picker-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">
        <!-- bootstrap datepicker js -->
        <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?php echo base_url(); ?>"><b>SMS</b>Registration (Debug Purpose only)</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">All fields are required!</p>

                <form action="<?php echo base_url(); ?>session/register" name="register" id="register"  action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  
                    <!--        Full Name-->

                    <div class="form-group has-feedback">
                        <input required id="full_name" type="text" name="full_name" class="form-control" placeholder="Full Name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                   
                    <!--username-->

                    <div class="form-group has-feedback">
                        <input required id="username" type="text" name="username" class="form-control" placeholder="Username">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <!--        E-mail-->
                    <div class="form-group has-feedback">
                        <input required id="email" type="email" name="email" class="form-control" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <!--password-->
                    <div class="form-group has-feedback">
                        <input minlength="6" required id="password" type="password" name="password" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <!--confirm password-->
                    <div class="form-group has-feedback">
                        <input minlength="6" required id="re-password" type="password" name="re-password" class="form-control" placeholder="Confirm Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                    <!-- Date of Birth     -->
                    <div class="form-group has-feedback">
                        <input required id="datepicker" type="text" name="dob" class="form-control" placeholder="Date of Birth">
                        <span class="fa fa-calendar form-control-feedback"></span>
                    </div>


                    <!--Address-->
                    <div class="form-group has-feedback">
                        <input required id="address" type="text" name="address" class="form-control" placeholder="Address">
                        <span class="
                              glyphicon glyphicon-globe form-control-feedback"></span>
                    </div>
                    <!-- contact number -->
                    <div class="form-group has-feedback">
                        <input minlength="9" maxlength="17"  required id="contact" type="tel" name="contact" class="form-control" placeholder="Contact Number">
                        <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                    </div>
                    <!--Profile picture-->
                    <div class="form-group">
                        <label for="picture">Profile Picture</label>
                        <input type="file" id="picture" name="picture">

                        <a class="help-block" data-toggle="modal" data-target=".profilepic">Click here for image requirement's</a>
                        <div class="modal fade profilepic" tabindex="-1" role="dialog" aria-labelledby="profilepicture">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title">Image Requirement</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Your picture is use for booking hotels.</p>
                                        <p>You must have to upload passport type image with clearly vision of two ears.</p>
                                        <p> Invalid image may canceled your account</p>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn  pull-right  btn-danger" data-dismiss="modal">Close</button>

                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="tac" value="1"> I accept <a  data-toggle="modal" data-target=".tac">terms and condition</a>
                                </label>
                            </div>

                            <div class="modal modal-info fade tac" tabindex="-1" role="dialog" aria-labelledby="profilepicture">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title">Terms And Conditions</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>These terms and conditions govern your use of this website; by using this website, you accept these terms and conditions in full.   If you disagree with these terms and conditions or any part of these terms and conditions, you must not use this website. 

[You must be at least [18] years of age to use this website.  By using this website [and by agreeing to these terms and conditions] you warrant and represent that you are at least [18] years of age.]

[This website uses cookies.  By using this website and agreeing to these terms and conditions, you consent to our GRS's use of cookies in accordance with the terms of GRS's [privacy policy / cookies policy].]
</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn  pull-right  btn-primary" data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>



                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button name="submit" id="submit" type="submit" class="btn btn-primary btn-block btn-flat">Sign up</button>
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
                        $.notify.defaults({className: "info"});
                        //first name
                        $("#first_name").click(function () {
                            $("#full_name").notify("Enter your full name", {position: "right"});
                        });
                        //last name
                        $("#last_name").click(function () {
                            $("#last_name").notify("Enter your family name", {position: "right"});
                        });
                        //E-mail
                        $("#email").click(function () {
                            $("#email").notify("Enter your E-mail", {position: "right"});
                        });
                        //password
                        $("#password").click(function () {
                            $("#password").notify("Enter your password. Should be min 6 length chars", {position: "right"});
                        });
                        //re password
                        $("#re-password").click(function () {
                            $("#re-password").notify("Confirm your password. Should be match above", {position: "right"});
                        });
                        //Date of birth

                        $("#dob").click(function () {
                            $("#dob").notify("Enter your Date of birth", {position: "right"});
                        });
                        //country

                        $("#country").click(function () {
                            $("#country").notify("Select your country", {position: "right"});
                        });

                        //address

                        $("#address").click(function () {
                            $("#address").notify("Enter your address", {position: "right"});
                        });

                        //contact
                        $("#contact").click(function () {
                            $("#contact").notify("Enter your valid contact number", {position: "right"});
                        });
                        //image
                        $("#picture").click(function () {
                            $("#picture").notify("Select your picture.", {position: "right"});
                        });

                        //username
                        $("#username").click(function () {
                            $("#username").notify("Enter your username", {position: "right"});
                        });





                        //Date picker
                        $('#datepicker').datepicker({
                            format: 'yyyy/mm/dd',
                            autoclose: true
                        });
                        $(function () {
                            $('input').iCheck({
                                checkboxClass: 'icheckbox_square-blue',
                                radioClass: 'iradio_square-blue',
                                increaseArea: '25%' // optional
                            });
                        });
                       
                        // Form submit
                        $(document).ready(function () {
                            $("form#register").submit(function (event) {

                                //disable the default form submission
                                event.preventDefault();
                                //grab all form data  
                                var formData = new FormData($(this)[0]);

                                $.ajax({
                                    url: '<?php echo base_url(); ?>session/register',
                                    type: 'POST',
                                    data: formData,
                                    async: false,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    success: function (status) {
                                        if (status == 1) {
                                            $("#register")[0].reset()
                                            window.location = "<?php echo base_url(); ?>login";

                                        } else {
                                            $.notify(status, "error");

                                        }

                                    },
                                    error: function () {
                                        $.notify("Please check your internet connection", "warning");
                                    }

                                });

                                return false;
                            });
                        });


                        // $.get("<?php //echo base_url()  ?>session/msg_log", function(msg_log){
                        //           $("#status_msg").append(msg_log);
                        //    });
                       
                       
                         window.load =  $.notify("Your account will verified instantly on localhost!", "info");
                        
        </script>

    </body>
</html>



