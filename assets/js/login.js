function eventsPassRecovery() {
    $("#btn_send_reset_password").unbind('click').click(function (e) {
        e.preventDefault();
        var email       = $("#email_recovery").val();
        info = {
            "meta": {
                "token": 123456,
                "enviroment": "P"
            },
            "data":{
                "login":{
                    "email": email
                }
            }
        }
        $.ajax({
            type: "POST",
            url: "api/v1/auth/password_recovery",
            data: JSON.stringify(info),
            dataType: "JSON",
            success: function (response) {
                if (!response.error) {
                    Swal.fire({
                        title: 'Great!',
                        text: response.msg,
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Continue!'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }else{
                            location.reload();
                        }
                    })
                } else {
                    Swal.fire('Oops!',response.msg,'error');
                }
            }
        });

    })
}

$(document).ready(function(){

    $("#btn_login").click(function (e) {
        e.preventDefault();
        logearUsuario()
    })


    $("#btn_dont_remeber_pass").unbind('click').click(function (e) {
        e.preventDefault()
        $("#div_login").hide()
        $("#div_reset_password").show()
        eventsPassRecovery();
    })

    $("#btn_login_hide").unbind('click').click(function (e) {
        e.preventDefault()
        $("#div_login").show()
        $("#div_reset_password").hide()
    })

});


function logearUsuario() {
    var email       = $("#email").val();
    var password    = $("#password").val();
    info = {
            "meta": {
                "token": 123456,
                "enviroment": "P"
            },
            "data":{
                "login":{
                    "email": email,
                    "password": password
                }
            }
        }
    $.ajax({
        type: "POST",
        url: "api/v1/auth/login",
        data: JSON.stringify(info),
        dataType: "JSON",
        success: function (response) {
            if (!response.error) {
                Swal.fire({
                    title: 'Great!',
                    text: response.msg,
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Continue!'
                  }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }else{
                        location.reload();
                    }
                  })
            } else {
                Swal.fire('Oops!',response.msg,'error');
            }
        }
    });
}