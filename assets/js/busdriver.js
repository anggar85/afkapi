$(document).ready(function () {
    

    AMBIENTE = "";
    URL_HOST = "http://localhost/afkapi/";
    LISTADO_HEROES = [];
    LISTADO_HEROES_FLAG = false;

    listHeroes();


    $("#addNewHero").click(function (e) { 
        e.preventDefault();
        createNewHero()
    });

    $("#cargarListaDeHeroes").click(function (e) { 
        e.preventDefault();
        listHeroes();
    });

    $("#backUpDatabase").click(function (e) { 
        e.preventDefault();
        backUpDatabase();
    });
    
});

function createNewHero() {

    hero = {
        "artifact": "test artifact",
        "classe": "Intelligence",
        "desc": "text desc",
        "group": " grpou text",
        "iconImage": "https://www.mxl-apps.com/afk/heroes_staging/icons/Angelo.jpg",
        "id": 0,
        "introduction": "h6hh6h6hh",
        "lore": " Lore Lore Test",
        "name": "test Name hero",
        "position": "Back",
        "race": 1,
        "race_name": "LIGHTBEARERS",
        "rarity": "Legendary+",
        "role": "Support (Heal, Silence)",
        "smallImage": "https://www.mxl-apps.com/afk/heroes_staging/big/angelo.png",
        "status": 1,
        "synergy": "Tanks",
        "union": "Yes",
        "skills": [{"skillOrder": 1}, {"skillOrder": 2}, {"skillOrder": 3}, {"skillOrder": 4} ] 
    }

    global_pinta_handlebars("detalleHeroe_hb", hero, "mainSpace")

    $("#select_race_number").change(function (e) { 
        e.preventDefault();
        $("#race").val($(this).val())
        $("[name=race_name]").val($("#select_race_number option:selected").text())
    });

    $("#select_rarity_number").change(function (e) { 
        e.preventDefault();
        $("#rarity").val($(this).val())
    });

    $(".btnActualizarSkill").remove()
    $("#updateData").val("Create Heroe")

    
    $("#updateData").click(function (e) { 
        e.preventDefault();
        // valida ciertos campos, si todo esta bien, entonces envia la informacion al server para que se actualice
        if ($("[name=name]").val() =="") {
            alert("Campo obligatorio vacio")
            $("[name=name]").focus()
            return false;
        }
        if ($("[name=rarity]").val() =="" || $("[name=rarity]").val() == 0) {
            alert("Campo obligatorio vacio")
            $("[name=rarity]").focus()
            return false;
        }
        if ($("[name=race]").val() =="" || $("[name=race]").val() == 0) {
            alert("Campo obligatorio vacio")
            $("[name=race]").focus()
            return false;
        }
        if ($("[name=classe]").val() =="" || $("[name=classe]").val() == 0) {
            alert("Campo obligatorio vacio")
            $("[name=classe]").focus()
            return false;
        }
            
        datos = $("#tableDataOfHeroe input,#tableDataOfHeroe textarea").serialize()
        
        arraySkills = []

        for (let x = 0; x < $(".skilltable").length; x++) {
            skill ={
                "icon" : $(".skilltable").eq(x).find('input').eq(1).val(),
                "skill" : $(".skilltable").eq(x).find('input').eq(2).val(),
                "skillOrder" : $(".skilltable").eq(x).find('input').eq(2).val(),
                "desc" : $(".skilltable").eq(x).find('textarea').eq(0).val(),
                "lvlUpgrades" : $(".skilltable").eq(x).find('textarea').eq(1).val()
            }
            arraySkills.push(skill)
        }


        newHero = {
            "name": $("[name=name]").val(),
            "group": $("[name=group]").val(),
            "race_name": $("[name=race_name]").val(),
            "description": $("[name=description]").val(),
            "rarity": $("[name=rarity]").val(),
            "race": $("[name=race]").val(),
            "role": $("[name=role]").val(),
            "synergy": $("[name=synergy]").val(),
            "position": $("[name=position]").val(),
            "artifact": $("[name=artifact]").val(),
            "union": $("[name=union]").val(),
            "classe": $("[name=classe]").val(),
            "introduction": $("[name=introduction]").val(),
            "lore": $("[name=lore]").val(),
            "status": $("[name=status]").val(),
            "skills": arraySkills

        }


        $.ajax({
            type: "POST",
            url: URL_HOST + "hero/create_hero?token=1234567890&ambiente=" + AMBIENTE,
            data: newHero,
            dataType: "json",
            success: function (response) {
                if (!response.error) {
                    alert("Se creo el nuevo heroe")
                    listHeroes();
                } else {
                    alert(response.msg)
                }
            }
        });



    });

}




//     AMBIENTE = $("#ambiente").val()

//     if(AMBIENTE == "L"){
//         $(".floating-menu span").html('LOCAL')
//         URL_HOST = "http://localhost:3000/"
//     }else if (AMBIENTE == "S"){
//         $(".floating-menu span").html('STAGING')
//         URL_HOST = "https://afkarenastaging.herokuapp.com/"
//     }else if(AMBIENTE == "P"){
//         $(".floating-menu span").html('PRODUCCION')
//         URL_HOST = "https://afkarena.herokuapp.com/"
//     }else{
//         alert("No hay ambiente definido")
//     }
// }



hero = {
    artifact: "",
    classe: "",
    desc: "",
    id: "",
    name: "",
    position: "",
    race: "",
    race_name: "",
    rarity: "",
    role: "",
    smallImage: "",
    synergy: "",
    union: ""
}

function backUpDatabase() {
    $.getJSON(URL_HOST + "extras/dbBackup",
        function (data, textStatus, jqXHR) {
            if (!data.error) {
                Swal.fire("Great!","Database backup complete", "success")
            } else {
                Swal.fire("Oops!",data.msg, "error")
                
            }
        }
    );
}

function listHeroes() {
    $.get(URL_HOST + "api/v2/hero/list_all_interface", function(data){
        heroesDiv = ""
        if(data.error == false){
            for (const hro of data.data.heroes) {
                a = "<div class='col-md-1 pointerCursor imagenHeroe' id='" + hro.id + "'>";
                a+="<img width='100%' heigth='100%' src='" + hro.smallImage + "' /> ";
                a+=hro.name;
                a+="</div>";
                heroesDiv+=a
                if (!LISTADO_HEROES_FLAG) {
                    LISTADO_HEROES.push(hro.name);
                }
            }
            LISTADO_HEROES_FLAG = true;
            $("#mainSpace").html(heroesDiv)
            detalleHeroe()
        }else{
            alert("Hubo un error")
        }
        // console.log(hero.name)
    });
}

function detalleHeroe() {
    $(".imagenHeroe").click(function (e) { 
        e.preventDefault();
        id = $(this).attr('id')
        verDetalleHeroe(id)
        // console.log($(this).attr('id'))
    });
}

function verDetalleHeroe(id) {
    
    $.ajax({
        type: "GET",
        url: URL_HOST + "api/v2/hero/detail?hero_id=" + id,
        dataType: "json",
        success: function (data) {
            if(data.error == false){
                console.log(data.data.heroe)
                heroe = data.data.heroe
                global_pinta_handlebars("detalleHeroe_hb", data.data.heroe, "mainSpace")
                $("#basi_info_li").trigger("click")
                artifacts = []
                if (heroe.artifact != null && heroe.artifact.length  > 0) {
                    artifacts = heroe.artifact.split(",")
                }
                $("#inputartifact").val(artifacts).select2({
                    tags: true,
                    placeholder: "Select Artifacts",
                    selectOnClose: false
                });
                synergyData = [];
                if(heroe.synergy != null && heroe.synergy.length > 0){
                    synergyData = heroe.synergy.split(",")
                }
                $("#synergiSelect").val(synergyData).select2({
                    tags: true,
                    data: LISTADO_HEROES,
                    placeholder: "Select Heroes",
                    selectOnClose: false
                });
                // Ya que se pinta el heroe, se carga el listener para los select
                listenerDinamicoSelectores()
                $("#listHeroes").click(function (e) { 
                    e.preventDefault();
                    listHeroes();
                });
            }else{
                alert("Hubo un error")
            }
        }
    });
}

function updateTierData(gameLevel, heroName) {
    overall = $("#"+ gameLevel +" select").eq(0).val()
    pvp = $("#"+ gameLevel +" select").eq(1).val()
    pve = $("#"+ gameLevel +" select").eq(2).val()
    lab = $("#"+ gameLevel +" select").eq(3).val()
    wrizz = $("#"+ gameLevel +" select").eq(4).val()
    soren = $("#"+ gameLevel +" select").eq(5).val()

    data = {
        'heroName':heroName,
        'gameLevel':gameLevel,
        'overall': overall,
        'pvp': pvp,
        'pve': pve,
        'lab': lab,
        'wrizz': wrizz,
        'soren': soren
    }

    $.ajax({
        type: "GET",
        url: URL_HOST + "hero/updateTierData?token=1234567890",
        data: data,
        dataType: "json",
        success: function (response) {
            if (!response.error) {
                Swal.fire("Great!",response.msg, "success")
            } else {
                Swal.fire("Oops!",response.msg, "error")
            }
        }
    });


}

this.global_pinta_handlebars = function(plantilla, data, target, miMetodo) {
    var template;
    if (miMetodo == null) {
      miMetodo = false;
    }
    template = Handlebars.compile(document.getElementById(plantilla).innerHTML);
    $("#" + target).html(template(data));
    if (miMetodo !== false) {
      return miMetodo();
    }
  };


function listenerDinamicoSelectores() {
    $("#select_race_number").change(function (e) { 
        e.preventDefault();
        $("#race").val($(this).val())
    });

    $("#select_rarity_number").change(function (e) { 
        e.preventDefault();
        $("#rarity").val($(this).val())
    });


    $("#updateData").click(function (e) { 
        e.preventDefault();
        
        // if(AMBIENTE == "P"){
        //     var r = confirm("Actualizar en ambiente de PRODUCCION?");
        //     if (r == false) {
        //         return false;   
        //     }
        // }
        // valida ciertos campos, si todo esta bien, entonces envia la informacion al server para que se actualice
        // if ($("[name=name]").val() =="") {
        //     alert("Campo obligatorio vacio")
        //     $("[name=name]").focus()
        //     return false;
        // }
        // if ($("[name=rarity]").val() =="" || $("[name=rarity]").val() == 0) {
        //     alert("Campo obligatorio vacio")
        //     $("[name=rarity]").focus()
        //     return false;
        // }
        // if ($("[name=race]").val() =="" || $("[name=race]").val() == 0) {
        //     alert("Campo obligatorio vacio")
        //     $("[name=race]").focus()
        //     return false;
        // }
        // if ($("[name=classe]").val() =="" || $("[name=classe]").val() == 0) {
        //     alert("Campo obligatorio vacio")
        //     $("[name=classe]").focus()
        //     return false;
        // }
            
        datos = $("#tableDataOfHeroe input,#tableDataOfHeroe textarea,#tableDataOfHeroe select").serialize()
        console.log(datos)

        $.ajax({
            type: "POST",
            url: URL_HOST + "hero/update_hero_basic_info?token=1234567890",
            data: datos,
            dataType: "json",
            success: function (response) {
                console.log(response)
                if (!response.error) {
                    idHeroe = $("#idHeroe").val()
                    verDetalleHeroe(idHeroe)
                    Swal.fire("Great!","Hero Updated!", "success")
                } else {
                    Swal.fire("Oops!",response.msg, "error")
                    
                }
            }
        });



    });
}


function actualizaSkill(id) {
    datos = $("#skill" + id + " input, #skill" + id + " textarea").serialize()
    console.log(datos)
    $.ajax({
        type: "POST",
        url: URL_HOST + "hero/updateSkill?token=1234567890&id=" + id,
        data: datos,
        dataType: "json",
        success: function (response) {
            console.log(response)

            if (!response.error) {
                Swal.fire("Great!","Skill Updated!", "success")
            } else {
                Swal.fire("Oops!",response.msg, "error")
            }
        }
    });
}


Handlebars.registerHelper('random', function() {
    var d = new Date();
    var n = d.getTime();
      return n;
  });


  Handlebars.registerHelper('select_race_value', function(race) {

    races = [
        "LIGHTBEARERS",
        "MAULERS",
        "WILDERS",
        "GRAVEBORN",
        "CELESTIAL",
        "HYPOGEAN"]

    a ='<select class="form-control" name="select_race_number" id="select_race_number">'
    a+= '<option value="0">Select Race</option>';
    cont = 1;
    for (let x = 0; x < races.length; x++) {
        if (race == cont) {
            a+='<option value="' + races[x] + '" selected="selected">' + races[x] + '</option>'
        } else {
            a+='<option value="' + races[x] + '">' + races[x] + '</option>'
        }
        cont++
    }

    a+='</select>'
    return a;
  });


  Handlebars.registerHelper('select_rarity_value', function(rarityParams) {
    rarity = [
        "Legendary+",
        "Common",
        "Ascended"]

    a ='<select class="form-control" name="select_rarity_number" id="select_rarity_number">'
    a+= '<option value="0">Select Rarity</option>';
    for (let x = 0; x < rarity.length; x++) {
        if (rarityParams == rarity[x]) {
            a+='<option value="' + rarity[x] + '" selected="selected">' + rarity[x] + '</option>'
        } else {
            a+='<option value="' + rarity[x] + '">' + rarity[x] + '</option>'
        }
    }
    a+='</select>'
    return a;
  });


  Handlebars.registerHelper('select_union_value', function(unionParams) {
    unionArray = [
        "Yes",
        "No"]

    a ='<select class="form-control" name="union">'
    a+= '<option value="null">Union?</option>';
    for (let x = 0; x < unionArray.length; x++) {
        if (unionParams == unionArray[x]) {
            a+='<option value="' + unionArray[x] + '" selected="selected">' + unionArray[x] + '</option>'
        } else {
            a+='<option value="' + unionArray[x] + '">' + unionArray[x] + '</option>'
        }
    }
    a+='</select>'
    return a;
  });


  Handlebars.registerHelper('select_position_value', function(positionParams) {
    positionArray = [
        "Any",
        "Back",
        "Front"]

    a ='<select class="form-control" name="position">'
    a+= '<option value="null">Select position</option>';
    for (let x = 0; x < positionArray.length; x++) {
        if (positionParams == positionArray[x]) {
            a+='<option value="' + positionArray[x] + '" selected="selected">' + positionArray[x] + '</option>'
        } else {
            a+='<option value="' + positionArray[x] + '">' + positionArray[x] + '</option>'
        }
    }
    a+='</select>'
    return a;
  });



  Handlebars.registerHelper('select_class_value', function(classParams) {
    classesArray = [
        "Intelligence",
        "Agility",
        "Strength"]

    a ='<select class="form-control" name="classe">'
    a+= '<option value="null">Select hero class</option>';
    for (let x = 0; x < classesArray.length; x++) {
        if (classParams == classesArray[x]) {
            a+='<option value="' + classesArray[x] + '" selected="selected">' + classesArray[x] + '</option>'
        } else {
            a+='<option value="' + classesArray[x] + '">' + classesArray[x] + '</option>'
        }
    }
    a+='</select>'
    return a;
  });


  Handlebars.registerHelper('select_listado_heroes', function() {
    a ='<select class="form-control" multiple="multiple" id="synergiSelect" name="synergy[]">'
    a+= '<option value="null">Select hero</option>';
    for (let x = 0; x < LISTADO_HEROES.length; x++) {
        a+='<option value="' + LISTADO_HEROES[x] + '">' + LISTADO_HEROES[x] + '</option>'
    }
    a+='</select>'
    return a;
  });


  Handlebars.registerHelper('listado_tier', function(tier_value, seccion) {
    tier = ["S+","S","A","B","C","D","E","F"]
    a ='<select class="form-control" name="' + seccion + '">'
    a+= '<option value="0">Select Tier Value</option>';
    console.log(tier_value + "-"+seccion)
    tier_value = tier_value.split(">")[1].split("<")[0]
    for (let x = 0; x < tier.length; x++) {
        if (tier_value == tier[x]) {
            a+='<option value="' + tier[x] + '" selected="selected">' + tier[x] + '</option>'
        } else {
            a+='<option value="' + tier[x] + '">' + tier[x] + '</option>'
        }
    }

    a+='</select>'
    return a;
  });




  