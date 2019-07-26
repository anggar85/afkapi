<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Manifest Capture System</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.simple-dtpicker.css">

  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/busdriver.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo-gac-310x84-rev.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo-gac-310x84-rev.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-view-list"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item d-none d-lg-block">
            <div class="input-group">
              Welcome <?php echo $this->session->userdata('username'); ?>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
          <a href="#" id="btn_logout" class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-view-list"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item sidebarSelectedOption" id="loadManifests">
            <a class="nav-link" href="#">
              <i class="ti-view-list-alt menu-icon"></i>
              <span class="menu-title">Manifests</span>
            </a>
          </li>
          <li class="nav-item" id="userAccount">
            <a class="nav-link" href="#">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">Account</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 col-xl-12" id="content">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          
        <!-- content-wrapper ends -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <input type="hidden" id="userId" value="<?php echo $this->session->userdata('id'); ?>">
  <!-- plugins:js -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="<?php echo base_url(); ?>assets/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?php echo base_url(); ?>assets/js/hoverable-collapse.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
    <script src="<?php echo base_url(); ?>assets/js/off-canvas.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.simple-dtpicker.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.1.2/handlebars.min.js" integrity="sha256-ngJY93C4H39YbmrWhnLzSyiepRuQDVKDNCWO2iyMzFw=" crossorigin="anonymous"></script>
  <script src="<?php echo base_url(); ?>assets/js/busdriver.js"></script>
  <!-- <script src="js/dashboard.js"></script> -->
  <!-- End custom js for this page-->
</body>

</html>


<!-- Trigger the modal with a button -->

<!-- Modal -->
<div id="modalManifest" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulo_modal">Create Manifest</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <table class="table table-condensed borderless" id="table_manifest_data">
                    <tr>
                        <th colspan="2" class="text-center"><h4>Manifest Information</h4></th>
                    </tr>
                    <tr>
                        <th>Arriving Date</th>
                        <td><p id="showDate"></p><input type="text" name="date" id="date" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Charter Company</th>
                        <td><input type="text" id="charter_company" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Group Name</th>
                        <td><input type="text" id="group_name" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Passenger Total</th>
                        <td><input type="number" id="passenger_total" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Pickup Location</th>
                        <td><input type="text" id="pickup_location" class="form-control"></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center"><h4>Coordinator Information</h4></th>
                    </tr>
                    <tr>
                        <th>Coordinator Name</th>
                        <td><input type="text" id="coordinator_name" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Coordinator Phone Number</th>
                        <td><input type="text" id="coordinator_phone_number" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Notes</th>
                        <td><textarea id="notes" class="form-control"></textarea></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="saveNewManifest">Create Manifest</button>
                <button type="button" class="btn btn-sm btn-danger" style="display:none" id="cancelManifest">Request Cancelation</button>
            </div>
        </div>

    </div>
</div>


<script id="user_manifest_list_template" type="text/x-handlebars-template">
    <h3>Manifests</h3>
    <table id="tableDataTable" class="display compact" style="width:100%">
        <thead>
        <tr>
        <th># RN</th>
        <th>Charter Company</th>
        <th>Group Name</th>
        <th>Passengers</th>
        <th>Pickup Location</th>
        <th>Coordinator Phone</th>
        <th>Coordinator Name</th>
        <th>Notes</th>
        <th>Date</th>
        <th>Status</th>
        </tr>
        </thead>
        <tbody id="body_table_manifest">
            {{#each this}}
            <tr data-id="{{reservation_number}}" class="pointerMouse reservation_number">
                <td class="pointerMouse reservation_number"><i class="ti-notepad" aria-hidden="true"></i> <b class="">{{reservation_number}}</b></td>
                <td>{{miniString charter_company 10}}</td>
                <td>{{miniString group_name 10}}</td>
                <td>{{passengers_total}}</td>
                <td>{{miniString pickup_location 10}}</td>
                <td>{{coordinator_phone_number}}</td>
                <td>{{miniString coordinator_name 10}}</td>
                <td>{{miniString notes 10}}</td>
                <td>{{date}}</td>
                <td>{{{statusChecker status}}}</td>
            </tr>
            {{/each}}
        </tbody>
    </table>

</script>

<script id="user_information_template" type="text/x-handlebars-template">
    <h3>{{name}}</h3>

<table class="table table-hover">
    <tr>
      <th>Name </th>
      <td>
      <input type="text" id="name" class="form-control" value="{{name}}">
      </td>
    </tr>
    <tr>
      <th>Lastname </th>
      <td>
      <input type="text" id="lastname" class="form-control" value="{{lastname}}">
      </td>
    </tr>
    <tr>
      <th>Phone </th>
      <td>
      <input type="text" id="phone" class="form-control" value="{{phone}}">
      </td>
    </tr>
    <tr>
      <th>Email</th>
      <td>
      <input type="text" disabled class="form-control" value="{{email}}">
      </td>
    </tr>
    <tr>
      <td>
        <button type="button" id="updateUserInformation" class="btn btn-sm btn-primary">Update information</button>
      </td>
    </tr>
    <tr>
      <th colspan="2">Change Password </th>
    </tr>
    <tr>
      <th>Old Password </th>
      <td>
        <input type="password" id="password" class="form-control">
      </td>
    </tr>
    <tr>
      <th>New Password </th>
      <td>
        <input type="password" id="newpassword" class="form-control">
      </td>
    </tr>
    <tr>
      <th>Confirm Password </th>
      <td>
        <input type="password" id="newconfirmpassword" class="form-control">
      </td>
    </tr>

    <tr>
      <td>
        <button type="button" id="changePassword" class="btn btn-sm btn-primary">Change Password</button>
      </td>
    </tr>
</table>
      
</script>



