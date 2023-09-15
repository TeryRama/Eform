<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>E-Form WHS | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/square/orange.css') ?>" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" type="image/ico" href="<?php echo base_url('assets/images/QAD-Bookmark.ico')?>">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

            
    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><img src="<?php echo base_url();?>assets/images/LogoQAD-1.png" align="center" width="290" alt="" /></a>
            </div><!-- /.login-logo -->
            <div class="login-box-body" >
                <p class="login-box-msg text-danger"><b>Register Expired Password</b></p>
                <form action="<?php echo base_url('C_expired_password') ?>" method="post">
                    <?php
                    if ($this->session->flashdata('pesan_gagal')) {
                        echo $this->session->flashdata('pesan_gagal');
                        }else{?>
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Warning!</strong>
                            <?php echo validation_errors(); ?>
                            <?php echo 'PASSWORD EXPIRED'; ?>
                        </div>
                    <?php } ?>
                    <div class="form-group has-feedback">
                        <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $username;?>" readonly="readonly"/>
                        <input type="hidden" name="post_userid" class="form-control" placeholder="post_userid" value="<?php echo $userid;?>" readonly="readonly"/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $password;?>" readonly="readonly"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                      <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Type New password" required="required" />
                      <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <!-- <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> Remember Me
                                </label>
                            </div> -->
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                        </div><!-- /.col -->
                    </div>
                </form>
<!--                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
                    <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
                </div> /.social-auth-links -->

<!--                <a href="#">I forgot my password</a><br>
                <a href="register.html" class="text-center">Register a new membership</a>-->

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
<!--                </form>

                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
                    <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
                </div> /.social-auth-links 

                <a href="#">I forgot my password</a><br>
                <a href="register.html" class="text-center">Register a new membership</a>

            </div> /.login-box-body 
        </div> /.login-box -->

        <!-- jQuery 2.1.3 -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).on('keyup', "input[type=text]", function () {
                    $(this).val(function (_, val) {
                        return val.toUpperCase();
                    });
                });

                 $('#new_password').change(function(){
                      var length_idpass = $(this).val().length;
                      if(length_idpass < 6){
                          alert('Maaf, Jumlah Character Password Minimal 6 Digit!!'); 
                          $(this).val('');
                          $(this).focus();
                      }else{
                          var val_idpass = $(this).val();
                         if (val_idpass.match(/[a-z].*[0-9]|[0-9].*[a-z]/i) ) {
                         }else{
                            alert('Maaf, Password merupakan kombinasi huruf dan angka!!');
                            $(this).val('');
                            $(this).focus();
                         }
                      }
                  });  
            });
        </script>
    </body>
</html>