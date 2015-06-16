$(document).ready(function() {
  if (navigator.appName == 'Netscape' || 'Microsoft Internet Explorer' || 'Opera') {
    var idioma = navigator.language;
  }
  else {
    var lenguaje = navigator.browserLanguage;
  }
  if (idioma.indexOf('it') > -1) {
    var jfile = "./info/team-it.json";
    putText(jfile);
    putQuien("./info/quienessomos-it.json");
  }
  else{
    var jfile = "./info/team-es.json";
    putText(jfile);
    putQuien("./info/quienessomos-es.json");
  }
});

function putText(jfile) {
  $.getJSON(jfile, function(json) {
      $("[data-translate='menu-inicio']").append(json[0].menu_inicio);
      $("[data-translate='menu-ayuda']").append(json[0].menu_ayuda);
      $("[data-translate='home1']").append(json[0].home1);
    });
}

function putQuien(jquien) {
  $.getJSON(jquien, function(json) {
    $.each(json, function(index) {
      var dev = '<div class="devs col-sm-6"><h2>'+json[index].name+'</h2><p>'+json[index].carrera+'</p><p>'+json[index].descripcion+'</p></div>';
      $('.team-cont').append(dev);
    });
  });
}
