<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>AFK Arena API Interfaz</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">AFK Arena API Interfaz</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <select class="form-control" name="ambiente" id="ambiente">
          <option value="L">Local</option>
          <option value="S">Staging</option>
          <option value="P">Production</option>
        </select>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <!-- <span class="badge badge-danger">9+</span> -->
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <!-- <span class="badge badge-danger">7</span> -->
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Login Screens:</h6>
          <a class="dropdown-item" href="login.html">Login</a>
          <a class="dropdown-item" href="register.html">Register</a>
          <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Other Pages:</h6>
          <a class="dropdown-item" href="404.html">404 Page</a>
          <a class="dropdown-item" href="blank.html">Blank Page</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>
    </ul>

    <div id="content-wrapper">
      <button type="button" id="addNewHero" class="btn btn-md  btn-primary pull-right">+ Add Heroe</button>
      <br>
      <br>
      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <div id="mainSpace" class="row"></div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer"> 
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/handlebars-v4.1.0.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/busdriver.js"></script>

</body>

</html>




<script id="detalleHeroe_hb" type="text/x-handlebars-template">


 <div class="container">
    <div class="row">
   
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           <button id="listHeroes" class="btn btn-outline-info"> Heroes List</button>
       <br>
       <br>
      
        </div>
        
      </div>
      <div class="row">
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          
          <div class="container">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Basic Info</a></li>
            <li><a data-toggle="tab" href="#menu1">Artifacts</a></li>
            <li><a data-toggle="tab" href="#menu2">Strengths & Weakness</a></li>
            <li><a data-toggle="tab" href="#menu3">Skills</a></li>
          </ul>

          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
              <h3>Basic Info</h3>
              <!-- BASIC INFO -->
              <table class="xxccc" id="tableDataOfHeroe">
                 <tbody>
                    <tr>
                      <th>ID</th>
                      <td>
                        <input class="form-controls" type="number" value="{{id}}" name="id" id="idHeroe" disabled />
                      </td>
                    </tr>
                    <tr>
                      <th>Image Big (PNG)</th>
                      <td>
                        <img width="100px" src="{{smallImage}}?time={{random}}" />
                        <br>
                        <input class="form-controls" placeholder="URL for icon of hero" type="text" name="imagen_big" />
                      </td>
                    </tr>
                   <!-- <tr>
                     <th>Image Icon (JPG)</th>
                     <td>
                       <img width="100px" src="{{iconImage}}?time={{random}}" />
                       <br>
                       <input class="form-controls" type="text" name="imagen_icon" />
                     </td>
                   </tr> -->
                   <tr>
                     <th>Name *</th>
                     <td><input class="form-controls" type="text" name="name" value="{{name}}"></td>
                   </tr>
                   <tr>
                     <th>Group</th>
                     <td><input class="form-controls" type="text" name="group" value="{{group}}"></td>
                   </tr>
                   <!-- <tr>
                     <th>Race Name </th>
                     <td><input  disabled class="form-controls" type="text" name="race_name" value="{{race_name}}"></td>
                   </tr> -->
                   <tr>
                     <th>Description</th>
                     <td><textarea class="form-controls"  name="desc">{{desc}}</textarea></td>
                   </tr>
                   <tr>
                     <th>Rarity *</th>
                     <td>
                         <select class="form-controls" name="select_rarity_number" id="select_rarity_number">
                             <option value="0">Select Rarity</option>
                             <option value="Legendary+">Legendary+</option>
                             <option value="Common">Common</option>
                             <option value="Ascended">Ascended</option>
                           </select>
                       <input disabled class="form-controls" type="text" name="rarity" id="rarity" value="{{rarity}}">
                     </td>
                   </tr>
                   <tr>
                     <th>Race *</th>
                     <td>
                         <select class="form-controls" name="select_race_number" id="select_race_number">
                             <option value="0">Select Race</option>
                             <option value="1">LIGHTBEARERS</option>
                             <option value="2">MAULERS</option>
                             <option value="3">WILDERS</option>
                             <option value="4">GRAVEBORN</option>
                             <option value="5">CELESTIAL</option>
                             <option value="6">HYPOGEAN</option>
                         </select>
                       <input disabled class="form-controls" type="number" id="race" name="race" value="{{race}}">
                     </td>
                   </tr>
                   <tr>
                     <th>Role</th>
                     <td><input class="form-controls" type="text" name="role" value="{{role}}"></td>
                   </tr>
                   <tr>
                     <th>Synergy</th>
                     <td><input class="form-controls" type="text" name="synergy" value="{{synergy}}"></td>
                   </tr>
                   <tr>
                     <th>Position</th>
                     <td><input class="form-controls" type="text" name="position" value="{{position}}"></td>
                   </tr>
                   <tr>
                     <th>Artifact</th>
                     <td><input class="form-controls" type="text" name="artifact" value="{{artifact}}"></td>
                   </tr>
                   <tr>
                     <th>Union</th>
                     <td><input class="form-controls" type="text" name="union" value="{{union}}"></td>
                   </tr>
                   <tr>
                     <th>Class *</th>
                     <td><input class="form-controls" type="text" name="classe" value="{{classe}}"></td>
                   </tr>
                   <tr>
                     <th>Introduction</th>
                     <td><textarea class="form-controls"  name="introduction" >{{introduction}}</textarea></td>
                   </tr>
                   <tr>
                     <th>Lore</th>
                     <td><input class="form-controls" type="text" name="lore" value="{{lore}}"></td>
                   </tr>
                   <tr>
                     <th>Status</th>
                     <td><input class="form-controls" type="number" name="status" value="{{status}}"></td>
                   </tr>
                   <tr>
                     <td colspan="2">
                       <input class="btn btn-success" type="button" id="updateData" value="Update Information">
                     </td>
                   </tr>
                 </tbody>
               </table>
               <!-- BASIC INFO -->
              
            </div>
            <div id="menu1" class="tab-pane fade">
              <h3>Artifacts</h3>
              <p>Some content in menu 1.</p>
            </div>
            <div id="menu2" class="tab-pane fade">
              <h3>Strengths & Weakness</h3>
              <p>Some content in menu 2.</p>
            </div>
            <div id="menu3" class="tab-pane fade">
              <h3>Skills</h3>
              <!-- SKILLS -->
              {{#each skills}}
              <div class="skillsDiv">
              <button data-toggle="collapse" class="btn btn-primary btn-block btn-sm" data-target="#skill{{id}}"><h5>{{skill}}</h5></button>
               <table class="table border border-primary rounded skilltable collapse" id="skill{{id}}">
                  <tr>
                      <th>
                        ID
                      </th>
                      <td>
                          <input type="number" class="form-control" name="id" value="{{id}}" disabled/>
                      </td>
                    </tr>
                 <tr>
                   <th>Icon (PNG)</th>
                   <td><img width="80px" height="80px" src="{{skillIcon}}?time={{random}}"/></td>
               </tr>
               <tr>
                   <td colspan="2">
                   <input type="text" name="skillIcon" class="form-control">
                   </td>
                 </tr>
                 <tr>
                   <th>
                     Skill
                   </th>
                   <td>
                     <input class="form-control" type="text" name="skill" value="{{skill}}" />
                   </td>
                 </tr>
                 <tr>
                   <th>
                     Skill Order
                   </th>
                   <td>
                     <input class="form-control" type="number" name="skillOrder" value="{{skillOrder}}"/>
                   </td>
                 </tr>
                 <tr>
                   <th>
                     Desc
                   </th>
                   <td>
                     <textarea class="form-control" name="desc">{{desc}}</textarea>
                   </td>
                 </tr>
                 <tr>
                   <th>
                     lvlUpgrades
                   </th>
                   <td>
                       <textarea class="form-control" name="lvlUpgrades">{{lvlUpgrades}}</textarea>
                   </td>
                 </tr>
                 <tr>
                   <td colspan="2">
                     <center>
                       <button class="btn btn-success btn-sm btnActualizarSkill" onclick="actualizaSkill('{{id}}')">Update</button>
                     </center>
                   </td>
                 </tr>
               </table>
              </div>
               {{/each}}
              <!-- SkILLS -->
            </div>
          </div>
          
        </div>
        
      </div>
 </div>


</script>

<div>



</div>