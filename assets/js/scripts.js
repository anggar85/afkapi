var list_heroes;

var errorsArray = [];

$(document).ready(function(){
    hero_list()
    Handlebars.registerPartial("basic_info", $("#hero_hb_information").html());
    Handlebars.registerPartial("images", $("#hero_hb_images").html());
    Handlebars.registerPartial("skills", $("#hero_hb_skills").html());

    Handlebars.registerPartial("stats", $("#hero_hb_stats").html());
    Handlebars.registerPartial("awakening", $("#hero_hb_awakening").html());
    Handlebars.registerPartial("memoryImprint", $("#hero_hb_memoryImprint").html());

    Handlebars.registerHelper('space_to_dash', function(a) {
        b =  a.replace(/\s+/g, '-').toLowerCase();
        b =  b.replace(/:/g, '-').toLowerCase();
        b =  b.replace(/,/g, '-').toLowerCase();
        b =  b.replace(/!/g, '-').toLowerCase();
        b =  b.replace(/♡/g, '-').toLowerCase();
        return b.replace(/'/g, '').toLowerCase();
    })

    Handlebars.registerHelper("randomNumber",function () {
        return Math.floor(Math.random() * 1000);
    })
    Handlebars.registerHelper("contador",function (numero) {
        return numero + 1;
    })



    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    eventosSideBar();


});

function hero_list() {
  $.ajax({
    type: "GET",
      url: "api/v1/data/hero_list?data[token]=1234567890",
    dataType: "json",
    success: function (response) {
      if (!response.error) {
          list_heroes = response.data.heroes;
        global_pinta_handlebars('hero_list', response.data.heroes, 'mainSpace', busquedaListener)
      //    Listener para cargar cada heroe
          $("#heroCardList a").click(function (e) {
              e.preventDefault();
              heroId = $(this).attr('id')
              heroInformation(heroId)
          });
      } else {
        alert(response.msg)
      }
    }
  });
}


function heroInformation(heroId) {
    $.ajax({
        type: "GET",
        url: "api/v1/data/hero?data[token]=1234567890&data[heroId]=" + heroId,
        dataType: "json",
        success: function (response) {
            if (!response.error) {
                global_pinta_handlebars('hero_modal_info', response.data, 'mainSpace')
                eventsSaveData() // Eventos para actualizarinformacion
            } else {
                alert(response.msg)
            }
        }
    });
}


function eventsSaveData() {
    $("select").chosen({max_selected_options: 3});



    $("#buttonUpdateBasicInformation").unbind('click').click(function (e) {
        e.preventDefault();
        saveBasicInformacion()
    });

    $("#button_UpdateImages").unbind('click').click(function (e) {
        e.preventDefault();
        var esEmpty = true;
        $("#table_images input").each(function(e){
            if (e != 0 && $(this).val() != ""){
                esEmpty = false;
            }
        })
        if (!esEmpty){
            $(this).attr('disabled', true)
            $("#ajax_loader").show()
            saveImages()
        } else{
            alert("No hay nada que guardar")
        }
    });

    // Escucha todos los focusOut que sucedan
    miniUpdate()
}

function saveBasicInformacion() {
    data = $("#table_basicInformation input").serialize();
    requestBase(data, 1)
}


function saveImages() {
    data = $("#table_images input").serialize();
    data = data + "&opcion=2";
    $.ajax({
        type: "POST",
        url: "api/v1/data/update_hero",
        data: data,
        dataType: "json",
        success: function (response) {
            if (!response.error) {
                toastr.success(response.msg)
                d = new Date();

                // Actualiza las imagenes con los neuvos links
                $("#icon").attr('href', response.img.icon);
                $("#icon img").remove();
                $("#icon").html('<img width="80px" src="' + response.img.icon +'?'+ d.getTime() +'">');


                $("#small").attr('href', response.img.small);
                $("#small img").remove();
                $("#small").html('<img width="80px" src="' + response.img.small +'?'+ d.getTime() +'">');


                $("#full").attr('href', response.img.full);
                $("#full img").remove();
                $("#full").html('<img width="80px" src="' + response.img.full +'?'+ d.getTime() +'">');


                $("#big").attr('href', response.img.big);
                $("#big img").remove();
                $("#big").html('<img width="80px" src="' + response.img.big +'?'+ d.getTime() +'">');


                $("#sk1").attr('href', response.img.sk1);
                $("#sk1 img").remove();
                $("#sk1").html('<img width="80px" src="' + response.img.sk1 +'?'+ d.getTime() +'">');


                $("#sk2").attr('href', response.img.sk2);
                $("#sk2 img").remove();
                $("#sk2").html('<img width="80px" src="' + response.img.sk2 +'?'+ d.getTime() +'">');


                $("#sk3").attr('href', response.img.sk3);
                $("#sk3 img").remove();
                $("#sk3").html('<img width="80px" src="' + response.img.sk3 +'?'+ d.getTime() +'">');


                $("#button_UpdateImages").attr('disabled', false)
                $("#table_images input").val("")
                $("#ajax_loader").hide()

            } else {
                alert(response.msg)
                $("#button_UpdateImages").attr('disabled', false)
                $("#ajax_loader").hide()
            }
        }
    });
}

function requestBase(data, opcion, extraParse = 0) {

    if (extraParse == 0){
        data = data + "&opcion=" +opcion
    } else{

    }
    $.ajax({
        type: "POST",
        url: "api/v1/data/update_hero",
        data: data,
        dataType: "json",
        success: function (response) {
            if (!response.error) {
                toastr.success(response.msg)
            } else {
                alert(response.msg)
            }
        }
    });
}


function busquedaListener() {
    $("#search").keyup(function() {
        var value = this.value;

        $("table").find("tr").each(function(index) {
            if (index === 0) return;

            var if_td_has = false; //boolean value to track if td had the entered key
            $(this).find('td').each(function () {
                if_td_has = if_td_has || $(this).text().toLowerCase().indexOf(value) !== -1; //Check if td's text matches key and then use OR to check it for all td's
            });

            $(this).toggle(if_td_has);

        });
    });
}


function updateSkillBasic(id) {
    data = $("#skill_basic_" + id +" input").serialize();
    data+="&aditionalEffects="+encodeURIComponent($("#skill_basic_" + id +" select").val())
    requestBase(data, 3)
}


function saveNewEvent() {
    // Save new event
    date    = $("#event_date").val()
    title   = $("#event_title").val()
    desc    = $("#event_desc").val()
    if (date == "" || title == "" || desc == ""){
        alert("Empty fields are not allowed!")
        return;
    }
    data =  {
        "created_at": date,
        "title": title,
        "description": desc
    }
    // Save te data into database
    $.ajax({
        type: "POST",
        url: "api/v1/data/create_event",
        data: data,
        dataType: "json",
        success: function (response) {
            if (!response.error) {
                $("#event_date").val("")
                $("#event_title").val("")
                $("#event_desc").val("")
                eventsList();

            } else {
                alert(response.msg)
            }
        }
    });

}

function delete_event(id) {
    data = {'id':id}
    $.ajax({
        type: "POST",
        url: "api/v1/data/delete_event",
        data: data,
        dataType: "json",
        success: function (response) {
            if (!response.error) {
                eventsList()
            } else {
                alert(response.msg)
            }
        }
    });
}

function eventsList() {
    $.ajax({
        type: "GET",
        url: "api/v1/data/get_events?data[token]=1234567890",
        // data: data,
        dataType: "json",
        success: function (response) {
            if (!response.error) {
                global_pinta_handlebars("hb_events_list", response.data, "mainSpace" )
                $("#addNewEvent").unbind('click').click(function (e) {
                    e.preventDefault();
                    // Open addnewevent Template
                    global_pinta_handlebars("hb_event_information", "", "event_information" )
                    $("#event_information_inputs input").removeAttr('data-fastupdate')
                    $("#saveNewEvent").unbind('click').click(function (e) {
                        e.preventDefault();
                        saveNewEvent()
                    });

                });
                $("#table_events tr").unbind('click').click(function (e) {
                    e.preventDefault();
                    event_information($(this).data('id'))
                });
            } else {
                alert(response.msg)
            }
        }
    });
}

function event_information(id) {
    $.ajax({
        type: "GET",
        url: "api/v1/data/get_event?data[token]=1234567890&data[event_id]=" + id,
        dataType: "json",
        success: function (response) {
            if (!response.error) {
                global_pinta_handlebars("hb_event_information", response.data, "event_information" )
                miniUpdate();
                // var editor = new Quill(container);

            } else {
                alert(response.msg)
            }
        }
    });
}

function artifacts_list() {
    $.ajax({
        type: "GET",
        url: "api/v1/data/artifacts_list?data[token]=1234567890",
        // data: data,
        dataType: "json",
        success: function (response) {
            if (!response.error) {
                global_pinta_handlebars("hb_artifacts_list", response.data.artifacts, "mainSpace" )
                $("#tablaArtifactsListado a").unbind('click').click(function (e) {
                    e.preventDefault();
                    artifact_information($(this).data('id'))
                });
            } else {
                alert(response.msg)
            }
        }
    });
}


function artifact_information(id) {
    $.ajax({
        type: "GET",
        url: "api/v1/data/artifact?data[token]=1234567890&data[artifact_id]=" + id,
        dataType: "json",
        success: function (response) {
            if (!response.error) {
                global_pinta_handlebars("hb_artifact_information", response.data.artifact, "artifactContent" )
                miniUpdate();
            } else {
                alert(response.msg)
            }
        }
    });
}

function eventosSideBar() {
    $("#menu_reportes").click(function (e) {
        e.preventDefault();
        // Inuyecta plantilla para reportes
        loadReportSection();

    })
    $("#menu_events").click(function (e) {
        e.preventDefault();
        // Inuyecta plantilla para events
        eventsList()

    })
    $("#BackHeroList").click(function (e) {
        e.preventDefault();
        // Inuyecta plantilla para events
        hero_list()

    })
    $("#artifactsList").click(function (e) {
        e.preventDefault();
        // Inuyecta plantilla para events
        artifacts_list()

    })
}

function loadReportSection() {
    global_pinta_handlebars("hb_report_list", errorsArray, "mainSpace" )
}



function imgError(imagen, fileId)
{
    errors = {
        'heroe': "",
        'image_icon': "",
        'image_small': "",
        'image_full': "",
        'image_big': "",
    }
    errors.heroe = fileId;
    errors.image_icon= imagen;
    errorsArray.push(errors)
}

function miniUpdate() {
    $('table input,table textarea ').focusout(function (e) {
        e.preventDefault();

        if ($(this).data('fastupdate') != undefined){
            // Solo entra cuando existe este data
            info = $(this).data('fastupdate').split("|")

            if (info[4] != undefined && info[4] != "" && info[4] == "extraparse"){
                nuevo_valor = $(this).val();
                data = {
                    "id": info[2],
                    "tabla": info[0],
                    "valor": nuevo_valor,
                    "columna": info[1],
                    "opcion": 5,
                    "extraParse": 1,
                }
                requestBase(data, 5, 1);
                // Actualiza la data con el nuevo valor
                $(this).attr('data-fastupdate', info[0] + "|" +info[1] + "|" +info[2] + "|" + nuevo_valor + "|extraparse");
                $(this).attr('value', nuevo_valor);
            } else{

                // Necesita parse especial
                nuevo_valor = $(this).val();
                // Arma la estructura
                data = "id=" + info[2] +
                    "&tabla=" + info[0] +
                    "&valor=" + nuevo_valor +
                    "&columna=" + info[1];

                requestBase(data, 5);
                // Actualiza la data con el nuevo valor
                $(this).attr('data-fastupdate', info[0] + "|" +info[1] + "|" +info[2] + "|" + nuevo_valor);
                $(this).attr('value', nuevo_valor);

            }

        }

    })
}

var entityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#39;',
    '/': '&#x2F;',
    '`': '&#x60;',
    '=': '&#x3D;'
};

function escapeHtml2(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

function escapeHtml (string) {
    return String(string).replace(/[&<>"'`=\/]/g, function (s) {
        return entityMap[s];
    });
}


//
// ──────────────────────────────────────────────────────────── I ──────────
//   :::::: H A N D L E B A R S : :  :   :    :     :        :          :
// ──────────────────────────────────────────────────────────────────────
//



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


  Handlebars.registerHelper('if_eq', function(a, b, opts) {
      if (a == b) {
          return opts.fn(this);
      } else {
          return opts.inverse(this);
      }
  })


  Handlebars.registerHelper('selectorCustom', function(seleccionados) {

      datos = ["Barrier","Continuous Heal","Critical Hit Resistance","Idol","Immortal",
                "Immune","Increase Attack","Increase Critical Hit Chance","Increase Defense",
          "Increase Speed","Invincible","Loveliness","Skill Nullifier","Stealth","Vigor",
          "Bleed","Burn","Cannot Buff","Decrease Attack","Decrease Defense","Decrease Hit Chance",
          "Decrease Speed","Magic Nail","Poison","Provoke","Silence","Sleep","Stun","Target","Unhealable","Vapiric Touch",
          "Revive","Increase Attack (Greater)","Increase Combat Readiness","Decrease Combat Readiness","Increase Evasion",
          "Clean Debuff","Remove Buff","Transfer Debuff","Extra Turn","Increase Cooldown","Decrease Cooldown","Reflect",
          "Counter Attack","Penetrate Defense","Dual Attack","Enrage"]
      opciones = ""
      if (seleccionados == undefined || seleccionados ==""){
          for (x=0; x < datos.length; x++){
              opciones+= "<option value='"+ datos[x] +"'>" + datos[x] +  "</option>"
          }
      } else{
          sel = seleccionados.split(",");
          for (x=0; x < datos.length; x++){
              flag = false;
              for (i=0;i<sel.length;i++){
                  if (sel[i] == datos[x]){
                      opciones+= "<option selected='selected'  value='"+ datos[x]+"'>" + datos[x]+  "</option>"
                      flag = true
                  }
              }
              if (!flag){
                  opciones+= "<option value='"+ datos[x] +"'>" + datos[x] +  "</option>"
              }
          }
      }
      return opciones;



  })


