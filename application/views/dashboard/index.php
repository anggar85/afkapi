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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css" integrity="sha256-JHRpjLIhLC03YGajXw6DoTtjpo64HQbY5Zu6+iiwRIc=" crossorigin="anonymous" />
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
        <!-- <select class="form-control" name="ambiente" id="ambiente">
          <option value="L">Local</option>
          <option value="S">Staging</option>
          <option value="P">Production</option>
        </select> -->
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
        <a class="nav-link" id="cargarListaDeHeroes" href="#">
          <i class="fas fa-fw fa-list-alt"></i>
          <span>Hero List</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-user-alt"></i>
          <span>New Hero</span>
        </a>
      </li>
      <!-- <li class="nav-item dropdown">
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
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
        </li> -->
      <li class="nav-item">
        <a class="nav-link" id="backUpDatabase" href="#">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>DB Backup</span></a>
      </li>
    </ul>

    <div id="content-wrapper">
      <!-- <button type="button" id="addNewHero" class="btn btn-md  btn-primary pull-right">+ Add Heroe</button> -->
       <br>
      <div class="container-fluid">


        <div id="mainSpace" class="row"></div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer"> 
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © AFKAPIGUIDE 2019</span>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>


  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.js" integrity="sha256-FmcrRIeUicq2hy0eo5tD5h2Iv76IBfc3A51x8r9xeIY=" crossorigin="anonymous"></script>  <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/handlebars-v4.1.0.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/busdriver.js"></script>

</body>

</html>




<script id="detalleHeroe_hb" type="text/x-handlebars-template">


 <div class="container">
    <div class="row">
   
        <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           <button id="listHeroes" class="btn btn-outline-info"> Heroes List</button>
       <br>
       <br>
      
        </div> -->
        
      </div>
      <div class="row">
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          
          <div class="container">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" id="basi_info_li" href="#home">Basic Info</a></li>
            <li><a data-toggle="tab" id="strengthweakness_li" href="#menu2">Strengths & Weakness</a></li>
            <li><a data-toggle="tab" href="#menu3">Skills</a></li>
            <li><a data-toggle="tab" href="#menu4">Tier Data</a></li>
          </ul>

          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
              <!-- BASIC INFO -->
              <h3>Basic Info for {{name}}</h3>
              <table class="table" id="tableDataOfHeroe">
                 <tbody>
                    <tr>
                      <th>Name *</th>
                      <th>Image ICON (JPG)</th>
                      <th>Group</th>
                      <th>Type</th>
                    </tr>
                    <tr>
                      <td><input class="form-control" type="text" readonly name="name" value="{{name}}"></td>
                      <td>
                        <center><a target="new" href="{{smallImage}}?time={{random}}"><img width="100px" src="{{smallImage}}?time={{random}}" /></a></center>
                        <br>
                        <input class="form-control" placeholder="URL for icon of hero" type="text" name="image_icon" />
                      </td>
                      <td><input class="form-control" type="text" name="group" value="{{group}}"></td>
                      <td>
                        <input class="form-control" type="text" value="{{type}}" name="type" id="type" />
                        <input class="form-control" hidden type="number" value="{{id}}" name="id" id="idHeroe" readonly />
                      </td>
                    </tr>
                    
                   <tr>
                     <th>Description</th>
                     <th>Rarity *</th>
                     <th>Race *</th>
                     <th>Role</th>
                    </tr>
                    <tr>
                      <td><textarea class="form-control"  name="desc">{{desc}}</textarea></td>
                      <td>
                         {{{select_rarity_value rarity}}}
                       <input readonly class="form-control" hidden type="text" name="rarity" id="rarity" value="{{rarity}}">
                     </td>
                     <td>
                         {{{select_race_value race}}}
                         <input readonly class="form-control" hidden type="number" id="race" name="race" value="{{race}}">
                    </td>
                    <td><input class="form-control" type="text" name="role" value="{{role}}"></td>
                   
                   </tr>
                   <tr>
                     <th>Synergy</th>
                     <th>Position</th>
                     <th>Artifact</th>
                     <th>Union</th>
                    </tr>
                    <tr>
                      <td>
                        {{{select_listado_heroes}}}
                      </td>
                      <td>{{{select_position_value position}}}</td>
                      <td>
                        
                        <select name="artifact[]" multiple="multiple" id="inputartifact" class="form-control">
                          <option value="nothing">Select Artifact</option>
                          <option value="Dura's Grace">Dura's Grace</option>
                          <option value="Dura's Eye">Dura's Eye</option>
                          <option value="Dura's Call">Dura's Call</option>
                          <option value="Dura's Drape">Dura's Drape</option>
                          <option value="Dura's Blade">Dura's Blade</option>
                          <option value="Dura's Chalice of Vitality">Dura's Chalice of Vitality</option>
                          <option value="Dura's Conviction">Dura's Conviction</option>
                        </select>
                      </td>
                      <td>{{{select_union_value union}}}</td>
                   </tr>
                   
                   <tr>
                     <th>Class *</th>
                     <th>Introduction</th>
                     <th>Lore</th>
                     <th>Status</th>
                    </tr>
                    <tr>
                      <td>{{{select_class_value classe}}}</td>
                      <td><textarea class="form-control"  name="introduction" >{{introduction}}</textarea></td>
                      <td><input class="form-control" type="text" name="lore" value="{{lore}}"></td>
                      <td><input class="form-control" type="number" name="status" value="{{status}}"></td>
                   </tr>
                   <tr>
                     <td colspan="4">
                       <center>
                       <input class="btn btn-success" type="button" id="updateData" value="Update Information">
                       </center>
                     </td>
                   </tr>
                 </tbody>
               </table>


               <!-- BASIC INFO -->
              
            </div>
            <div id="menu2" class="tab-pane fade">
              <h3>Strengths & Weakness of {{name}}</h3>
              <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <span class="streweakness_1">Strengths</span>
                
                <button type="button" onclick="createStrengthWeakness(1)" class="btn btn-xs btn-primary pull-right">Add</button>
                
                <table class="table" id="tablaStrengths">
                    {{#each strengths}}
                    <tr id="streweakness{{id}}">
                      <td>{{desc}} 
                      <button onclick="deleteStrengtWeakness('{{id}}')" type="button" class="btn btn-xs btn-danger">x</button>
                      </td>
                    </tr>
                    {{/each}}
                </table>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <span class="streweakness_2">Weakness</span>
                <button type="button" onclick="createStrengthWeakness(2)" class="btn btn-xs btn-primary">Add</button>
                <table class="table" id="tableWeakness">
                    {{#each weaknesses}}
                    <tr id="streweakness{{id}}">
                      <td>{{desc}} 
                      <button onclick="deleteStrengtWeakness('{{id}}')" type="button" class="btn btn-xs btn-danger">x</button>
                      </td>
                    </tr>
                    {{/each}}
                </table>
                </div>
              </div>
            </div>
            <div id="menu3" class="tab-pane fade">
              <h3>Skills of {{name}}</h3>
              <!-- SKILLS -->
              {{#each skills}}
              <div class="skillsDiv">
              <button data-toggle="collapse" class="btn btn-primary btn-block btn-sm" data-target="#skill{{id}}"><h5>{{skill}}</h5></button>
                          <input hidden type="number" class="form-control" name="id" value="{{id}}" readonly/>
               <table class="table border border-primary rounded skilltable collapse" id="skill{{id}}">
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
            <div id="menu4" class="tab-pane fade">
              <h3>Tier Data of {{name}}</h3>
              <table class="table" id="tier_list_earlies">
                <tr><th colspan="6"><b>Early Game</b></th></tr>
                  <tr>
                    <th>Overall</th>
                    <th>PVP</th>
                    <th>PVE</th>
                    <th>LAB</th>
                    <th>Wrizz</th>
                    <th>Soren</th>
                  </tr>
                  <tr>
                    <td>{{{listado_tier early.overall "tier_list_earlies"}}}</td>
                    <td>{{{listado_tier early.pvp "tier_list_earlies"}}}</td>
                    <td>{{{listado_tier early.pve "tier_list_earlies"}}}</td>
                    <td>{{{listado_tier early.lab "tier_list_earlies"}}}</td>
                    <td>{{{listado_tier early.wrizz "tier_list_earlies"}}}</td>
                    <td>{{{listado_tier early.soren "tier_list_earlies"}}}</td>
                  </tr>
                  <tr>
                    <th colspan="6">
                      <center>
                        <button onclick="updateTierData('tier_list_earlies', '{{name}}')" class="btn btn-xs btn-primary">Update Tier Data</button>
                      </center>
                    </th>
                  </tr>
              </table>
              <table class="table" id="tier_list_mids">
                <tr><th colspan="6"><b>Mid Game</b></th></tr>
                  <tr>
                    <th>Overall</th>
                    <th>PVP</th>
                    <th>PVE</th>
                    <th>LAB</th>
                    <th>Wrizz</th>
                    <th>Soren</th>
                  </tr>
                  <tr>
                    <td>{{{listado_tier mid.overall "tier_list_mids"}}}</td>
                    <td>{{{listado_tier mid.pvp "tier_list_mids"}}}</td>
                    <td>{{{listado_tier mid.pve "tier_list_mids"}}}</td>
                    <td>{{{listado_tier mid.lab "tier_list_mids"}}}</td>
                    <td>{{{listado_tier mid.wrizz "tier_list_mids"}}}</td>
                    <td>{{{listado_tier mid.soren "tier_list_mids"}}}</td>
                  </tr>
                  <tr>
                    <th colspan="6">
                      <center>
                        <button onclick="updateTierData('tier_list_mids', '{{name}}')" class="btn btn-xs btn-primary">Update Tier Data</button>
                      </center>
                    </th>
                  </tr>
              </table>
              {{#if late.overall}}
              <table class="table" id="tier_list_lates">
                <tr><th colspan="6"><b>Late Game</b></th></tr>
                  <tr>
                    <th>Overall</th>
                    <th>PVP</th>
                    <th>PVE</th>
                    <th>LAB</th>
                    <th>Wrizz</th>
                    <th>Soren</th>
                  </tr>
                  <tr>
                    <td>{{{listado_tier late.overall "tier_list_lates"}}}</td>
                    <td>{{{listado_tier late.pvp "tier_list_lates"}}}</td>
                    <td>{{{listado_tier late.pve "tier_list_lates"}}}</td>
                    <td>{{{listado_tier late.lab "tier_list_lates"}}}</td>
                    <td>{{{listado_tier late.wrizz "tier_list_lates"}}}</td>
                    <td>{{{listado_tier late.soren "tier_list_lates"}}}</td>
                  </tr>
                  <tr>
                    <th colspan="6">
                      <center>
                        <button onclick="updateTierData('tier_list_lates', '{{name}}')" class="btn btn-xs btn-primary">Update Tier Data</button>
                      </center>
                    </th>
                  </tr>
              </table>
              {{/if}}
            </div>
          </div>
          
        </div>
        
      </div>
 </div>


</script>

<div>






</div>