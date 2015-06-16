$(document).ready(function() {
  if (navigator.appName == 'Netscape' || 'Microsoft Internet Explorer' || 'Opera') {
    var idioma = navigator.language;
  }
  else {
    var lenguaje = navigator.browserLanguage;
  }
  if (idioma.indexOf('it') > -1) {
    var jfile = "./info/help-it.json";
    putText(jfile);
  }
  else{
    var jfile = "./info/help-es.json";
    putText(jfile);
  }
});

function putText(jfile) {
  $.getJSON(jfile, function(json) {
    $.each(json, function(index) {
      var dev = '<div class="col-sm-12"><div class="col-sm-12"><img src="'+json[index].picture+'" /></div><div class="text-help col-sm-12"><p>'+json[index].description+'</p></div>';
      $('.help-cont').append(dev);
    });
  });
}
