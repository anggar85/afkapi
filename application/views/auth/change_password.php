<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Golde Acorn Casino - Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico.png" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <!-- endinject -->
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <center>
                        <img src="<?php echo base_url(); ?>assets/images/logo-gac-310x84-rev.png" alt="" srcset="">
                        <br>
                        <br>
                    </center>
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5"  id="div_login">
                        <h4>Hello! let's get started</h4>
                        <h6 class="font-weight-light">Enter your new password.</h6>
                        <form class="pt-3">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg" value="<?php echo $this->session->userdata('email'); ?>" id="email" disabled id="email" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" id="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" id="password_confirm" placeholder="Password Confirmation">
                            </div>
                            <div class="mt-3">
                                <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" id="btn_change_my_password" href="#">Change my password</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/updatePassword.js"></script>
<!-- endinject -->
<!-- inject:js -->
<!-- endinject -->
</body>

</html>
