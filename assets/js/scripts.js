$(document).ready(function () {

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
