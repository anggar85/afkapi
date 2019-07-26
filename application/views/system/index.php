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


  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.simple-dtpicker.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
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
        <ul class="navbar-nav mr-lg-2">
          <!-- <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="ti-search"></i>
                </span>
              </div>
              <input autocomplete="off" type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li> -->
        </ul>
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
              <span class="menu-title">Manifest</span>
            </a>
          </li>
          <li class="nav-item" id="loadUsers">
            <a class="nav-link" href="#">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">Users</span>
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
    <script src="<?php echo base_url(); ?>assets/js/printThis.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.simple-dtpicker.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.1.2/handlebars.min.js" integrity="sha256-ngJY93C4H39YbmrWhnLzSyiepRuQDVKDNCWO2iyMzFw=" crossorigin="anonymous"></script>
  <script src="<?php echo base_url(); ?>assets/js/scriptsAdmin.js"></script>
  <!-- <script src="js/dashboard.js"></script> -->
  <!-- End custom js for this page-->
</body>

</html>










<script id="admin_users_list_template" type="text/x-handlebars-template">

  <table id="tableUsersDataTable" class="display compact" style="width:100%">
      <thead>
          <tr>
              <th></th>
              <th>Email</th>
              <th>Name</th>
              <th>Last Name</th>
              <th>Notes</th>
              <th>Status</th>
          </tr>
      </thead>
      <tbody id="body_table_users">
          {{#each this}}
          <tr class="rowUser pointerMouse reservation_number" data-id="{{id}}">
              <td>
                  <button type="button" class="btn btn-xs btn-success" onclick="showUserInfo('{{id}}')"> Show</button>              
              </td>
              <td><i class="fa fa-user" aria-hidden="true"></i> {{miniString email 15}}</td>
              <td>{{miniString name 10}}</td>
              <td>{{miniString lastname 10}}</td>
              <td>{{miniString notes 10}}</td>
              <td>{{{statusChecker status}}}</td>
          </tr>
          {{/each}}
      </tbody>
  </table>

</script>

<script id="admin_manifest_list_template" type="text/x-handlebars-template">
  <table id="tableDataTable" class="display nowrap" style="width:100%">
      <thead>
      <tr>
      <th>Reservation #</th>
      <th></th>
          <th>Status</th>
          <th>Date</th>
          <th>Charter Company</th>
          <th>Group Name</th>
          <th>Passengers</th>
          <th>Driver Name</th>
          <th>Coordinator Name</th>
          <th>Coordinator Phone</th>
          <th>Pickup Location</th>
          <th>Notes</th>
      </tr>
      </thead>
      <tbody id="body_table_manifest">
          {{#each this}}
          <tr data-id="{{reservation_number}}" class="pointerMouse reservation_number">
              <td class="pointerMouse reservation_number"><i class="ti-notepad" aria-hidden="true"></i> <b class="">{{reservation_number}}</b></td>
              <td>
                <button type="button" class="btn btn-xs btn-success" onclick="showManifesInfo('{{reservation_number}}')"> Show</button>              
              </td>
              <td>{{{statusManifestChecker status}}}</td>
              <td>{{date}}</td>
              <td>{{miniString charter_company 10}}</td>
              <td>{{miniString group_name 10}}</td>
              <td>{{passengers_total}}</td>
              <td>{{miniString name 10}}</td>
              <td>{{miniString coordinator_name 10}}</td>
              <td>{{coordinator_phone_number}}</td>
              <td>{{miniString pickup_location 10}}</td>
              <td>{{miniString notes 10}}</td>
          </tr>
          {{/each}}
      </tbody>
  </table>

</script>


<script id="admin_manifest_information_template" type="text/x-handlebars-template">
<div class="row">
          <div class="col-md-6">
              <h4><i class="fa fa-user" aria-hidden="true"></i> {{name}}</h4>
              <p><i class="fa fa-envelope-o" aria-hidden="true"></i> {{email}}</p>
          </div>
          <div class="col-md-6">
              <p class="text-right textReservationNumber"><b>Reservation: {{reservation_number}}</b></p>
              <p class="text-right textDate"> Arriving Date: {{date}}</p>
              <p class="text-right textDate">Arriving Hour: {{hour}}</p>
          </div>
          <div class="col-md-12">
              <h4>Manifest Information</h4>
              <table class="table table-hover">
                  <tr>
                      <th><i class="fa fa-building" aria-hidden="true"></i> Charter Company</th>
                      <th><i class="fa fa-users" aria-hidden="true"></i> Group Name</th>
                  </tr>
                  <tr>
                      <td>{{charter_company}}</td>
                      <td>{{group_name}}</td>
                  </tr>
                  <tr>
                      <th><i class="fa fa-list-ol" aria-hidden="true"></i> Passengers Total</th>
                      <th><i class="fa fa-map-marker" aria-hidden="true"></i> Pickup Location</th>
                  </tr>
                  <tr>
                      <td>{{passengers_total}}</td>
                      <td>{{pickup_location}}</td>
                  </tr>
                  <tr>
                      <th colspan="2"><i class="fa fa-sticky-note-o" aria-hidden="true"></i> Notes</th>
                  </tr>
                  <tr>
                      <td  colspan="2">{{notes}}</td>
                  </tr>
                  </tbody>
              </table>
              
              <h4>Coordinator Information</h4>
              <table class="table table-hover">
                  <tr>
                      <th><i class="fa fa-user" aria-hidden="true"></i> Name</th>
                      <th><i class="fa fa-phone" aria-hidden="true"></i> Phone</th>
                  </tr>
                  <tr>
                      <td>{{coordinator_name}}</td>
                      <td>{{coordinator_phone_number}}</td>
                  </tr>
                  </tbody>
              </table>
          </div>
      </div>
</script>


<!-- Modal -->
<div id="modalManifest" class="modal fade" role="dialog">
  <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title text-center" id="titulo_modal">Manifest #####</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" id="manifestInformation">
              
          </div>
          <div class="modal-footer">
              <button type="button" id="btn_print_manifest" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-sm btn-danger" style="display:none" id="cancelManifest">Request of Cancelation</button>
          </div>
      </div>

  </div>
</div>



<!-- Modal -->
<div id="modalUser" class="modal fade" role="dialog">
  <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title text-left" id="titulo_modalUser">User Information</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" id="userInformation">
              
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-success"  id="createNewUser" >Create New User</button>
              <button type="button" class="btn btn-success"  id="updateUser" >Update User</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>

  </div>
</div>




<script id="admin_user_template" type="text/x-handlebars-template">
  <div class="row">
      <div class="col-md-12">
          <table class="table table-condensed borderless">
          <input autocomplete="off" type="text" id="userId"  hidden value="{{id}}" >
          <tr>
              <th>First Name</th>
              <th>Last Name</th>
          </tr>
          <tr>
              <td><input autocomplete="off" type="text" id="name" class="form-control" value="{{name}}" required="required"></td>
              <td><input autocomplete="off" type="text" id="lastname" class="form-control" value="{{lastname}}" required="required"></td>
          </tr>
          
          <tr>
              <th>
                  Email
              </th>
              <th>
                  Phone
              </th>
          </tr>
          <tr>
              <td>
                <input autocomplete="off" type="text" id="email" class="form-control" value="{{email}}" required="required">
                </td>
                  <td>
                        <input autocomplete="off" type="text" id="phone" class="form-control" value="{{phone}}" required="required">
              </td>
          </tr>
          <tr>
              <th colspan="2">
                  Notes
              </th>
          </tr>
          <tr>
              <td colspan="2">
                  <textarea id="notes"  class="form-control" rows="3">{{notes}}</textarea>
              </td>
          </tr>
          <tr class="advanceSettings">
              <th colspan="2">
                  Advanced Settings <i class="ti ti-settings"></i>
              </th>
          </tr>
          <tr class="advanceSettings_tr">
              <th colspan="2">
                  User Level
              </th>
          </tr>
          <tr  class="advanceSettings_tr">
              <td colspan="2">
              <label class="radio-inline"><input type="radio" name="level" {{validateSelected 1 level}} value="1">Driver</label>
              <label class="radio-inline"><input type="radio" name="level" {{validateSelected 5 level}} value="5">Admin</label>
              </td>
          </tr>


          <tr class="advanceSettings_tr">
              <th colspan="2">
                  Status
              </th>
          </tr>
          <tr class="advanceSettings_tr">
              <td colspan="2">
              <label class="radio-inline"><input type="radio" name="status"  {{validateSelected 1 status}} value="1">Enabled</label>
              <label class="radio-inline"><input type="radio" name="status"  {{validateSelected 0 status}} value="0">Disabled</label>
              </td>
          </tr>
          </table>
      </div>
  </div>
  
</script>
