$(document).ready(function () {
    loadManifestList();
    eventsSideBar();
})

// MANIFEST
function loadManifestList() {
    $.ajax({
        type: "GET",
        url: "api/v2/manifest/list_all_manifest",
        dataType: "JSON",
        success: function (response) {
            if (!response.error) {
                global_pinta_handlebars("admin_manifest_list_template", response.data.manifests, "content");
                var table = $('#tableDataTable').DataTable({
                    responsive: true,
                    "order": [[ 0, "desc" ]]
                });
                $("#tableDataTable_wrapper").addClass("tableDataTable_wrapper_custom")

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
        url: "api/v2/manifest/show_manifest",
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

                if (response.data.manifest.status == 5){
                    // Pinta numero de manifest y mensaje si esta cancelado
                    $("#titulo_modal").html("Manifest " + manifestId + " - <span style='color: red;'> CANCELLED</span>")
                }else{
                    $("#titulo_modal").html("Manifest " + manifestId)
                }

                $("#btn_print_manifest").unbind('click').click(function (e) {
                    // Se manda imprimir el div del manifest
                    titulo = "<h1>" + $("#titulo_modal").html() + "</h1>";
                    $('#manifestInformation').printThis({
                        header: titulo,
                        importCSS: true, 
                        loadCSS: "goldenacorncasino/assets/css/printStyle.css"
                    });
                })

                $("#cancelManifest").hide()
                if (response.data.manifest.status == 2) {
                    // cancelManifest
                    $("#cancelManifest").show()
                    $("#cancelManifest").click(function () { 
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Proceed to cancel this manifest!'
                          }).then((result) => {
                            if (result.value) {
                                aceptCancelation(response.data.manifest.manifestId)
                            }
                          })
                    });
                }


            } else {
                Swal('Oops',response.msg, 'error')
            }
        }
    });
}

function aceptCancelation(id) {
    isDisabled(true)
    info = {
        "meta": {
            "token": 123456,
            "enviroment": "P"
        },
        "data": {
            "manifest": {
                "id": id
            }
        }
    }
    $.ajax({
        type: "POST",
        url: "api/v2/manifest/acept_cancelation",
        data: JSON.stringify(info),
        dataType: "JSON",
        success: function (response) {
            if (!response.error) {
                Swal.fire('Manifest ' + id + ' canceled!','','success')
                $("#modalManifest").modal("hide")
                loadManifestList();
            } else {
                Swal.fire("Oops", response.msg, 'error')
            }
            isDisabled(false)
        }
    });
}

// USERS
function loadUsersList() {
    $.ajax({
        type: "GET",
        url: "api/v2/users/users_list",
        dataType: "JSON",
        success: function (response) {
            if (!response.error) {
                global_pinta_handlebars("admin_users_list_template", response.data.users, "content");

                var table = $('#tableUsersDataTable').DataTable({
                    responsive: true,
                    'columnDefs': [ {

                        'targets': [0,5], /* column index */

                        'orderable': false, /* true or false */

                    }]
                });
                $("#tableDataTable_wrapper").addClass("tableDataTable_wrapper_custom")


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
        url: "api/v2/users/show_user",
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

                $(".advanceSettings").click(function () { 
                    $(".advanceSettings_tr").toggle();
                 });
                $("#createNewUser").hide()
                $("#updateUser").show()
                $("#updateUser").unbind('click').click(function (e) {
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

    $("[name=level]").eq(0).prop('checked', true)
    $("[name=status]").eq(0).prop('checked', true)
    $(".advanceSettings").click(function () { 
        $(".advanceSettings_tr").toggle();
     });

    // Se recicla el boton, se le cambia el texto al boton y el evento ya no tira a actualizar,
    //  si no a aguardar
    $("#updateUser").hide()
    $("#createNewUser").show()
    $("#createNewUser").unbind('click').click(function (e) {
        e.preventDefault();
        saveNewUser();
    })
}

function saveNewUser() {
    isDisabled(true)
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
            url: "api/v2/users/create_user",
            dataType: "JSON",
            data: JSON.stringify(info),
            success: function (response) {
                if (!response.error) {
                    Swal.fire('Great!','User created!\nA Email has been sended to the new user','success');
                    $("#modalUser").modal('hide');
                    loadUsersList();
                    isDisabled(false)
                } else {
                    Swal.fire('Oops!',response.data.msg,'error')
                    isDisabled(false)
                }
            }
        });
    }else{
        isDisabled(false)
    }
    
}

function updateUserData() {
    isDisabled(true)
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
                "fromDriver": false,
                "level": level,
                "status": status
            }
        }
    }
    if (validateUser(info.data.user)) {
        $.ajax({
            type: "POST",
            url: "api/v2/users/update_user",
            dataType: "JSON",
            data: JSON.stringify(info),
            success: function (response) {
                if (!response.error) {
                    Swal.fire('Great!','User updated','success');
                    $("#modalUser").modal('hide');
                    loadUsersList();
                    isDisabled(false)
                } else {
                    Swal.fire(
                        'Oops!',
                        response.msg,
                        'error'
                    )
                    isDisabled(false)
                }
            }
        });
    }else{
        isDisabled(false)
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
    // if (!validateEmail(user.email)) {
    //     Swal.fire("Oops", "Not valid email", 'error')
    //     return false;
    // }
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
    $("#sidebar li").click(function () {
        $("#sidebar li").removeClass("sidebarSelectedOption")
        $(this).addClass("sidebarSelectedOption")
    })


    $("#btn_logout").click(function (e) {
        $.ajax({
            type: "GET",
            url: "api/v2/auth/logout",
            dataType: "JSON",
            success: function (response) {
                if (!response.error) {
                    location.reload();
                } else {
                    Swal.fire(
                        'Oops!',
                        response.msg,
                        'error'
                    )
                }
            }
        });
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


Handlebars.registerHelper('statusChecker', function (string) {
    if (string == "1"){
        return "<span style='background: #00CC00; font-size: 12px; border-radius: 25px;padding: 2px 6px; color: #f0f0f0;'>Enabled</span>";
    } else{
        return "<span style='background: #de0000;font-size: 12px; border-radius: 25px;padding: 2px 6px;  color: #f0f0f0;'>Disabled</span>";
    }
})

Handlebars.registerHelper('levelChecker', function (string) {
    if (string == "1"){
        return "<span style='background: #5f8bcc; font-size: 12px; border-radius: 25px;padding: 2px 6px; color: #f0f0f0;' class='fa fa-car'> Driver</span>";
    } else{
        return "<span style='background: #1adeaf;font-size: 12px; border-radius: 25px;padding: 2px 6px;  color: #f0f0f0;' class='fa fa-user-cog'>Admin</span>";
    }
})

Handlebars.registerHelper('statusManifestChecker', function (string) {
    if (string == "1"){
        return "<span style='background: #45cc7c; font-size: 12px; border-radius: 25px;padding: 2px 6px; color: #f0f0f0;' class='fa fa-car'>Accepted</span>";
    } else{
        return "<span style='background: #de0000;font-size: 12px; border-radius: 25px;padding: 2px 6px;  color: #f0f0f0;' class='fa fa-user-cog'>Cancelled</span>";
    }
})


// MISC
function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
  }


function isDisabled(isDisabled) {
    $(".modal button, .modal input, .modal textarea ").prop('disabled', isDisabled);
}


var check_session;
function CheckForSession() {
    $.ajax({
        type: "POST",
        url: "api/v2/auth/checksession",
        cache: false,
        success: function(res){
            console.log(res)
            if (!res.logged_in) {
                Swal.fire({
                    title: 'Oops',
                    text: "Session Expired!",
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    allowOutsideClick: false, 
                    allowEscapeKey: false 

                  }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                  })
            }
        }
    });
}
check_session = setInterval(CheckForSession, 3610000);
