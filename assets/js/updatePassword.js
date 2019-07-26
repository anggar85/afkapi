function eventsPassRecovery() {
    $("#btn_change_my_password").unbind('click').click(function (e) {
        e.preventDefault();
        updateUserPassword();

    })
}


$(document).ready(function (e) {
    eventsPassRecovery()
});


function updateUserPassword() {
    let newpassword = $('#password').val();
    let newconfirmpassword = $('#password_confirm').val();

    if(newpassword === ""){
        Swal.fire("Oops", "Enter new password", 'error');
        return false;
    }

    if(password.length  < 8){
        Swal.fire("Oops", "Password must have minimum 8 characters", 'error');
        return false;
    }

    if(newconfirmpassword === ""){
        Swal.fire("Oops", "Please confirm password", 'error');
        return false;
    }
    if(newconfirmpassword !== newpassword){
        Swal.fire("Oops", "Your new password and confirmation aren't equals", 'error');
        return false;
    }


    let info = {
        "meta": {
            "token": 123456,
            "enviroment": "P"
        },
        "data": {
            "login": {
                "newpassword": newpassword,
                "newconfirmpassword": newconfirmpassword
            }
        }
    };

    $.ajax({
        type: "POST",
        url: "api/v1/auth/set_new_password",
        data: JSON.stringify(info),
        dataType: "JSON",
        success: function (response) {
            if (!response.error) {
                Swal.fire("Great!", response.msg, 'success');
                window.top.location.href = "/goldenacorncasino";
            } else {
                Swal.fire("Oops", response.msg, 'error')
            }
        }
    });
}
