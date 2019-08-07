$(document).ready(function () {
    URL_HOST = document.location.origin + "/afkapi/";

    synergySelect();
    artifactSelect();
    
    
});



function synergySelect() {
    synergyValue = $("#input_synergy").val().split(",");
    heroes_list = $("#heroes_list").val().split(",");

    $("#synergiSelect").val(synergyValue).select2({
        tags: true,
        // data: heroes_list,
        placeholder: "Select Heroes",
        selectOnClose: false
    });
}


function artifactSelect() {
    artifactValue = $("#input_artifac").val().split(",");

    $("#artifactSelect").val(artifactValue).select2({
        tags: true,
        placeholder: "Select Artifacts",
        selectOnClose: false
    });
}


function createStrengthWeakness(opc) {
    idHeroe = $("#idHeroe").val()
    Swal.fire({
        title: "Write something",
        input: 'text',
        confirmButtonText: 'Save',
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "GET",
                url: URL_HOST + "hero/create_strength_weakness?token=1234567890",
                dataType: "json",
                data: {'id':idHeroe, 'desc': result.value, 'type':opc},
                success: function (response) {
                    if (!response.error) {
                        // $("#streweakness" + id).remove()
                        Swal.fire("Great!",response.msg, "success").then((result) => {
                            location.reload();
                          })
                    } else {
                        Swal.fire("Oops!",response.msg, "error")
                    }
                }
            });
        }
      })
}