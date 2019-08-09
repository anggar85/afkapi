<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>AFK Arena Guide - Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.css">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicon-16x16.png">

  <!-- endinject -->
</head>

<body>
  <div class="container">
    
    <div class="row">
    
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>

    
    <div class="col-lg-4" id="loginBox">
                <center>
                    <img width="200px" src="<?php echo base_url(); ?>assets/images/logo.png" alt="" srcset="">
                    <br>
                </center>
            <div class="auth-form-light text-left py-5 px-4 px-sm-5"  id="div_login">
              <form class="pt-3">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" placeholder="Password">
                </div>
                <div class="mt-3">
                  <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" id="btn_login" href="#">SIGN IN</a>
                    <!-- <br>
                    <center>
                        <a class="btn btn-block  btn-warning btn-xs" id="btn_dont_remeber_pass" href="#">Can't remeber my password</a>
                    </center> -->
                </div>
              </form>
            </div>
            <div class="auth-form-light text-left py-5 px-4 px-sm-5" id="div_reset_password" style="display: none;">
              <h4>Reset your password</h4>
              <h6 class="font-weight-light">Put your email</h6>
              <form class="pt-3">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email_recovery" placeholder="Email">
                </div>
                <div class="mt-3">
                  <a class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" id="btn_send_reset_password" href="#">Reset my password</a>
                    <br>
                    <a class="btn btn-block btn-primary btn-xs" id="btn_login_hide" href="#">SIGN IN</a>

                </div>
              </form>
            </div>
          </div>
    </div>


    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
    
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/login.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <!-- endinject -->
</body>

</html>
