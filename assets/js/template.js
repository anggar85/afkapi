(function($) {
  'use strict';
  $(function() {
    var body = $('body');
    var contentWrapper = $('.content-wrapper');
    var scroller = $('.container-scroller');
    var footer = $('.footer');
    var sidebar = $('.sidebar');

    //Add active class to nav-link based on url dynamically
    //Active class can be hard coded directly in html file also as required

    function addActiveClass(element) {
      if (current === "") {
        //for root url
        if (element.attr('href').indexOf("index.html") !== -1) {
          element.parents('.nav-item').last().addClass('active');
          if (element.parents('.sub-menu').length) {
            element.closest('.collapse').addClass('show');
            element.addClass('active');
          }
        }
      } else {
        //for other url
        if (element.attr('href').indexOf(current) !== -1) {
          element.parents('.nav-item').last().addClass('active');
          if (element.parents('.sub-menu').length) {
            element.closest('.collapse').addClass('show');
            element.addClass('active');
          }
          if (element.parents('.submenu-item').length) {
            element.addClass('active');
          }
        }
      }
    }

    var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
    $('.nav li a', sidebar).each(function() {
      var $this = $(this);
      addActiveClass($this);
    })

    //Close other submenu in sidebar on opening any

    sidebar.on('show.bs.collapse', '.collapse', function() {
      sidebar.find('.collapse.show').collapse('hide');
    });


    //Change sidebar 
    $('[data-toggle="minimize"]').on("click", function() {
      body.toggleClass('sidebar-icon-only');
    });

    //checkbox and radios
    $(".form-check label,.form-radio label").append('<i class="input-helper"></i>');

  });

  // focus input when clicking on search icon
  $('#navbar-search-icon').click(function() {
    $("#navbar-search-input").focus();
  });
  
})(jQuery);





$(document).ready(function(){

  $("#btn_login").click(function (e) {
      e.preventDefault();
      logearUsuario()
  })

});

BASE_URL = "http://localhost/casino/";


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
      url: BASE_URL + "api/v1/auth/login",
      data: JSON.stringify(info),
      dataType: "JSON",
      success: function (response) {
          if (!response.error) {
              alert(response.msg)
              window.location.href = BASE_URL + "index.html";
          } else {
              alert(response.msg)
          }
      }
  });
}