$(document).ready(function () {
  loadManifestList();
  eventsSideBar();
})

BASE_URL = "http://localhost/casino/"

// MANIFEST
function loadManifestList() {
  $.ajax({
      type: "GET",
      url: BASE_URL + "api/v1/manifest/list_all_manifest",
      dataType: "JSON",
      success: function (response) {
          if (!response.error) {
              global_pinta_handlebars("admin_manifest_list_template", response.data.manifests, "content");
              var table = $('#tableDataTable').DataTable();
              $('#tableDataTable tbody').on('click', 'tr', function () {
                  var data = table.row(this).data();
                  row = $.parseHTML(data[0])
                  showManifesInfo(row[2].innerText)
              });
          } else {
              alert(response.msg)
          }
      }
  });
}

function showManifesInfo(manifestId) {
  info = {
      "meta": {
          "token": 123456,
          "enviroment": "P"
      },
      "data": {
          "manifest": {
              "reservation_number": manifestId
          }
      }
  }

  $.ajax({
      type: "POST",
      url: BASE_URL + "api/v1/manifest/show_manifest",
      dataType: "JSON",
      data: JSON.stringify(info),
      success: function (response) {
          if (!response.error) {
              // Pinta numero de manifest
              $("#titulo_modal").html("Manifest " + manifestId)
              // Levanta modal
              $("#modalManifest").modal({
                  backdrop: 'static',
                  keyboard: false
              })
              // Pinta la informacion
              global_pinta_handlebars("admin_manifest_information_template", response.data.manifest, "manifestInformation");
          } else {
              alert(response.msg)
          }
      }
  });
}

// USERS
function loadUsersList() {
  $.ajax({
      type: "GET",
      url: BASE_URL + "api/v1/users/users_list",
      dataType: "JSON",
      success: function (response) {
          if (!response.error) {
              global_pinta_handlebars("admin_users_list_template", response.data.users, "content");

              var table = $('#tableUsersDataTable').DataTable();
              $('#tableUsersDataTable tbody').on('click', 'tr', function () {
                  var id = table.row(this).selector.rows.attributes[1].value;
                  showUserInfo(id)
              });

              // Inyecta le boton para crear nuevos usuarios
              boton = "<button id='btn_create_new_user' class='btn btn-sm btn-primary' style='margin-right:10px;'> <i class='fa fa-plus-circle' aria-hidden='true'></i> Create New User</button>";
              $("#tableUsersDataTable_filter label").prepend(boton)

              $("#btn_create_new_user").unbind('click').click(function () { 
                  createUser()
               })

          } else {
              alert(response.msg)
          }
      }
  });
}



function showUserInfo(userId) {
  info = {
      "meta": {
          "token": 123456,
          "enviroment": "P"
      },
      "data": {
          "user": {
              "id": userId
          }
      }
  }

  $.ajax({
      type: "POST",
      url: BASE_URL + "api/v1/users/show_user",
      dataType: "JSON",
      data: JSON.stringify(info),
      success: function (response) {
          if (!response.error) {
              // Levanta modal
              $("#modalUser").modal({
                  backdrop: 'static',
                  keyboard: false
              })
              $("#titulo_modalUser").html("User information")

              // Pinta la informacion
              global_pinta_handlebars("admin_user_template", response.data.user, "userInformation");

              $("#updateUser").unbind('click').click(function (e) {
                  console.log("click")
                  e.preventDefault();
                  updateUserData();
              })
          } else {
              alert(response.msg)
          }
      }
  });
}


function createUser() {
  // Solo tiene el evento para levantar el modal
  $("#modalUser").modal({
      backdrop: 'static',
      keyboard: false
  })
  $("#titulo_modalUser").html("Create new user")
  // Pinta la informacion
  global_pinta_handlebars("admin_user_template", "", "userInformation");

  // Se recicla el boton, se le cambia el texto al boton y el evento ya no tira a actualizar,
  //  si no a aguardar
  $("#updateUser").html("Create New User")
  $("#updateUser").unbind('click').click(function (e) {
      console.log("click")
      e.preventDefault();
      saveNewUser();
  })
}

function saveNewUser() {
  // junta la informacion
  name = $("#name").val()
  lastname = $("#lastname").val()
  phone = $("#phone").val()
  email = $("#email").val()
  notes = $("#notes").val()
  level = $('input[name=level]:checked').val();
  status = $('input[name=status]:checked').val();

  info = {
      "meta": {
          "token": 123456,
          "enviroment": "P"
      },
      "data": {
          "user": {
              "id": 0,
              "name": name,
              "lastname": lastname,
              "phone": phone,
              "email": email,
              "notes": notes,
              "level": level,
              "status": status
          }
      }
  }

  if (validateUser(info.data.user)) {
      $.ajax({
          type: "POST",
          url: BASE_URL + "api/v1/users/create_user",
          dataType: "JSON",
          data: JSON.stringify(info),
          success: function (response) {
              if (!response.error) {
                  Swal.fire('Great!','User created!\nA Email has been sended to the new user','success');
                  $("#modalUser").modal('hide');
                  loadUsersList();
              } else {
                  Swal.fire(
                      'Oops!',
                      response.msg,
                      'error'
                  )
              }
          }
      });
  }
  
}

function updateUserData() {
  // junta la informacion
  userId = $("#userId").val()
  name = $("#name").val()
  lastname = $("#lastname").val()
  phone = $("#phone").val()
  email = $("#email").val()
  notes = $("#notes").val()
  level = $('input[name=level]:checked').val();
  status = $('input[name=status]:checked').val();

  info = {
      "meta": {
          "token": 123456,
          "enviroment": "P"
      },
      "data": {
          "user": {
              "id": userId,
              "name": name,
              "lastname": lastname,
              "phone": phone,
              "email": email,
              "notes": notes,
              "level": level,
              "status": status
          }
      }
  }
  if (validateUser(info.data.user)) {
      $.ajax({
          type: "POST",
          url: BASE_URL + "api/v1/users/update_user",
          dataType: "JSON",
          data: JSON.stringify(info),
          success: function (response) {
              if (!response.error) {
                  // console.log("updated")
                  Swal.fire('Great!','User updated','success');
                  $("#modalUser").modal('hide');
                  loadUsersList();
              } else {
                  Swal.fire(
                      'Oops!',
                      response.msg,
                      'error'
                  )
              }
          }
      });
  }
}

function validateUser(user) {
  if (isNaN(user.id)) {
      Swal.fire("Oops", "Empty user id", 'error')
      return false;
  }
  if (user.name == "") {
      Swal.fire("Oops", "Empty name", 'error')
      return false;
  }
  if (user.lastname == "") {
      Swal.fire("Oops", "Empty lastname", 'error')
      return false;
  }
  if (user.email == "") {
      Swal.fire("Oops", "Empty email", 'error')
      return false;
  }
  if (!validateEmail(user.email)) {
      Swal.fire("Oops", "Not valid email", 'error')
      return false;
  }
  if (user.level == "" || user.level == "undefined"|| user.level == undefined) {
      Swal.fire("Oops", "Empty level", 'error')
      return false;
  }
  if (user.status == "" || user.status == "undefined" || user.status == undefined) {
      Swal.fire("Oops", "Empty status", 'error')
      return false;
  }
  return true;
}


// INIT EVENTS

function eventsSideBar() {
  $(".side-nav li").click(function () {
      $(".side-nav li").removeClass()
      $(this).addClass("sidebarOptionSelected")
  })


  $("#loadManifests").click(function (e) {
      loadManifestList();
  })


  $("#loadUsers").click(function (e) {
      loadUsersList();
  })

}



// HANDLEBARS

function global_pinta_handlebars(plantilla, data, target) {
  var template;
  template = Handlebars.compile(document.getElementById(plantilla).innerHTML);
  $("#" + target).html(template(data));

}

Handlebars.registerHelper('validateSelected', function (opc1, opc2) {
  if (parseInt(opc1, 10) == parseInt(opc2, 10)) {
      return "checked"
  }
})

Handlebars.registerHelper('miniString', function (string, limit) {
  if (string == null) {
      return ""
  }
  if (string.length > limit) {
      return string.substring(0, limit) + "..."
  } else {
      return string
  }
})



// MISC
function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

// Models
user = {
  "id": "",
  "name": "",
  "lastname": "",
  "phone": "",
  "email": "",
  "notes": "",
  "level": "",
  "status": ""
}