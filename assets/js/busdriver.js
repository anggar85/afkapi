$(document).ready(function(){
    listofManifests();
    eventsSideBar();
});

function eventsSideBar() {
    $("#sidebar li").click(function () {
        $("#sidebar li").removeClass("sidebarSelectedOption")
        $(this).addClass("sidebarSelectedOption")
    })


    $("#loadManifests").click(function (e) {
        listofManifests();
    })
    

    $("#userAccount").click(function (e) {
        loadUserProfile();
    })

}


function loadUserProfile() {
    info = {
        "meta": {
            "token": 123456,
            "enviroment": "P"
        },
        "data": {
            "user": {
                "id": $("#userId").val()
            }
        }
    }

    $.ajax({
        type: "POST",
        url: "api/v1/users/show_user",
        data: JSON.stringify(info),
        dataType: "JSON",
        success: function (response) {
            if (!response.error) {
                global_pinta_handlebars("user_information_template", response.data.user, "content");
                eventsUpdatingUSerProfile()
            } else {
                alert(response.msg)
            }
        }
    });

}

function eventsUpdatingUSerProfile() {
    $("#updateUserInformation").click(function () { 
        updateUserInformation()        
     })

     $("#changePassword").click(function () { 
         updateUserPassword()
      })
}

function updateUserPassword() {
    let password = $("#password").val();
    let newpassword = $("#newpassword").val();
    let newconfirmpassword = $("#newconfirmpassword").val();

    if(password === ""){
        Swal.fire("Oops", "Enter current password", 'error')
        return false;
    }
    
    if(newpassword.length  < 8){
        Swal.fire("Oops", "Password must have minimum 8 characters", 'error')
        return false;
    }
    if(newpassword === ""){
        Swal.fire("Oops", "Enter new password", 'error')
        return false;
    }
    if(newconfirmpassword === ""){
        Swal.fire("Oops", "Please confirm password", 'error')
        return false;
    }
    if(newconfirmpassword !== newpassword){
        Swal.fire("Oops", "Your new password and confirmation aren't equals", 'error')
        return false;
    }
    

    info = {
        "meta": {
            "token": 123456,
            "enviroment": "P"
        },
        "data": {
            "user": {
                "id": $("#userId").val(),
                "password": password,
                "newpassword": newpassword,
                "newconfirmpassword": newconfirmpassword
            }
        }
    }

    $.ajax({
        type: "POST",
        url: "api/v1/users/update_user_password",
        data: JSON.stringify(info),
        dataType: "JSON",
        success: function (response) {
            if (!response.error) {
                Swal.fire("Great!", response.msg, 'success')
            } else {
                Swal.fire("Oops", response.msg, 'error')
            }
        }
    });
}

function updateUserInformation() {
    name = $("#name").val()
    lastname = $("#lastname").val()
    phone = $("#phone").val()

    if(name.length < 3){
        Swal.fire("Oops", "User name must be longer than 3 characters", 'error')
        return false;
    }
    
    if(lastname.length < 3){
        Swal.fire("Oops", "User lastname must be longer than 3 characters", 'error')
        return false;
    }
    

    info = {
        "meta": {
            "token": 123456,
            "enviroment": "P"
        },
        "data": {
            "user": {
                "id": $("#userId").val(),
                "name": name, 
                "lastname": lastname, 
                "phone": phone, 
                "fromDriver": true 
            }
        }
    }

    $.ajax({
        type: "POST",
        url: "api/v1/users/update_user",
        data: JSON.stringify(info),
        dataType: "JSON",
        success: function (response) {
            if (!response.error) {
                Swal.fire("Great!", response.msg, 'success')
            } else {
                Swal.fire("Oops", response.msg, 'error')
            }
        }
    });
}


function listofManifests() {
    $.ajax({
        type: "GET",
        url: "api/v1/manifest/list_all_manifest",
        dataType: "JSON",
        success: function (response) {
            if (!response.error) {
                global_pinta_handlebars("user_manifest_list_template", response.data.manifests, "content");


                
                var table = $('#tableDataTable').DataTable();
                $("#tableDataTable_wrapper").addClass("tableDataTable_wrapper_custom")
                // Inyecta le boton para crear nuevos usuarios
                boton = "<button id='createNewManifest' class='btn btn-sm btn-primary' style='margin-right:10px;'> <i class='fa fa-plus-circle' aria-hidden='true'></i> Create New Manifest</button>";
                $("#tableDataTable_filter label").prepend(boton)

                $('#tableDataTable tbody').on('click', 'tr', function () {
                    var data = table.row(this).data();
                    row = $.parseHTML(data[0])
                    showManifesInfo(row[2].innerText)
                });

                events()
            } else {
                alert(response.msg)
            }
        }
    });

}

function showManifesInfo(manifestId) {
    $(".modal button, .modal input ").prop('disabled', false);
    $("#saveNewManifest").hide()
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
        url: "api/v1/manifest/show_manifest",
        dataType: "JSON",
        data: JSON.stringify(info),
        success: function (response) {
            if (!response.error) {
                if (response.data.manifest.status == 5){
                    // Pinta numero de manifest y mensaje si esta cancelado
                    $("#titulo_modal").html("Manifest " + manifestId + " - <span style='color: red;'> CANCELLED</span>")
                }else{
                    $("#titulo_modal").html("Manifest " + manifestId)
                }
                // Levanta modal
                $("#modalManifest").modal()
                // Pinta la informacion
                $("#table_manifest_data input, #table_manifest_data textarea, #table_manifest_data button").prop('disabled', true);
                $("#date").hide()
                $("#showDate").show()
                $("#showDate").html(response.data.manifest.date + " " + response.data.manifest.hour)
                $("#charter_company").val(response.data.manifest.charter_company)
                $("#group_name").val(response.data.manifest.group_name)
                $("#passenger_total").val(response.data.manifest.passengers_total)
                $("#pickup_location").val(response.data.manifest.pickup_location)
                $("#coordinator_phone_number").val(response.data.manifest.coordinator_phone_number)
                $("#coordinator_name").val(response.data.manifest.coordinator_name)
                $("#notes").val(response.data.manifest.notes)

                date = response.data.manifest.created_at.split(" ")[0]
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                today = yyyy + '-' + mm + '-' + dd;
                
                $("#cancelManifest").hide()
                if (date == today && response.data.manifest.status == 1) {
                    // cancelManifest
                    $("#cancelManifest").show()
                    $("#cancelManifest").click(function () { 
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, request cancelation!'
                          }).then((result) => {
                            if (result.value) {
                                requestCancelation(response.data.manifest.manifestId)
                            }
                          })
                    });

                }

            } else {
                alert(response.msg)
            }
        }
    });
}

function requestCancelation(id) {
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
        url: "api/v1/manifest/request_cancelation",
        data: JSON.stringify(info),
        dataType: "JSON",
        success: function (response) {
            if (!response.error) {
                Swal.fire('Request sended!','Your request has been sended.','success')
                $("#modalManifest").modal("hide")
                listofManifests();
            } else {
                Swal.fire("Oops", response.msg, 'error')
            }
        }
    });
}


function events() {
    $("#createNewManifest").click(function (e) {
        $("#saveNewManifest").show()
        $("#cancelManifest").hide()

        $("#titulo_modal").html("Create new manifest")
        $("#date").show()
        $("#showDate").hide()
        $("#showDate").html("")
        $("#table_manifest_data input, #table_manifest_data textarea, #table_manifest_data button").prop('disabled', false);
        $("#table_manifest_data input, #table_manifest_data textarea").val('');
        e.preventDefault();
        $("#modalManifest").modal({
            backdrop: 'static',
            keyboard: false
        })
        $('*[name=date]').appendDtpicker({
            "dateFormat": "MM/DD/YYYY hh:mm",
            "amPmInTimeList": true,
            "futureOnly": false
        });
    })

    $("#saveNewManifest").unbind("click").click(function (e) {
        e.preventDefault();
        $(".modal button, .modal input ").prop('disabled', true);
        date = $("#date").val()
        charter_company = $("#charter_company").val()
        group_name = $("#group_name").val()
        passenger_total = $("#passenger_total").val()
        pickup_location = $("#pickup_location").val()
        coordinator_phone_number = $("#coordinator_phone_number").val()
        coordinator_name = $("#coordinator_name").val()
        notes = $("#notes").val()
        datos = {
                "meta": {
                    "token": 123456,
                    "enviroment": "P"
            },
                "data": {
                "manifest": {
                    "date":date,
                    "charter_company":charter_company,
                    "group_name":group_name,
                    "passenger_total":passenger_total,
                    "pickup_location":pickup_location,
                    "coordinator_phone_number":coordinator_phone_number,
                    "coordinator_name":coordinator_name,
                    "notes":notes
                }
            }
        }

        if (validateManifest(datos.data.manifest)) {
            $.ajax({
                type: "POST",
                url: "api/v1/manifest/create_manifest",
                data: JSON.stringify(datos),
                dataType: "JSON",
                success: function (response) {
                    if (!response.error) {
                        Swal.fire("Great!", "Manifest created!", 'success')
                        $("#modalManifest").modal("hide")
                        $(".modal button, .modal input ").prop('disabled', false);
                        listofManifests();
                    } else {
                        Swal.fire("Oops", response.msg, 'error')
                        $(".modal button, .modal input ").prop('disabled', false);
                    }
                }
            });
        }else{
            $(".modal button, .modal input ").prop('disabled', false);
        }
    })


    $("#btn_logout").click(function (e) {
        $.ajax({
            type: "GET",
            url: "api/v1/auth/logout",
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
}

function validateManifest(manifest) {


    if (manifest.date == "") {
        Swal.fire("Oops", "Please select a valid date", 'error')
        return false;
    }

    if (manifest.charter_company == "") {
        Swal.fire("Oops", "Empty Charter Company", 'error')
        return false;
    }
    if (manifest.group_name == "") {
        Swal.fire("Oops", "Empty Group Name", 'error')
        return false;
    }
    if (manifest.passenger_total == "") {
        Swal.fire("Oops", "Empty passengers total", 'error')
        return false;
    }
    // if (manifest.pickup_location == "") {
    //     Swal.fire("Oops", "Empty pickup location", 'error')
    //     return false;
    // }
    if (manifest.coordinator_name == "") {
        Swal.fire("Oops", "Empty coordinator name", 'error')
        return false;
    }
    if (manifest.coordinator_phone_number == "") {
        Swal.fire("Oops", "Empty coordinator phone number", 'error')
        return false;
    }
    
    return true;
}

// MISC
var check_session;
function CheckForSession() {
    $.ajax({
        type: "POST",
        url: "api/v1/auth/checksession",
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
        return "<span style='background: #45cc7c; font-size: 12px; border-radius: 25px;padding: 2px 6px; color: #f0f0f0;' class='fa fa-car'>Accepted</span>";
    } else{
        return "<span style='background: #de0000;font-size: 12px; border-radius: 25px;padding: 2px 6px;  color: #f0f0f0;' class='fa fa-user-cog'>Cancelled</span>";
    }
})