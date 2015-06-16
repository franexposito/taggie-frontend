var id = '';
var idFacebook;
var idMensaje;
var time;
var boton;
var tagsG;
var config = false;
var fromid;
var fromname;
var msg;
var linkCap;

function statusChangeCallback(response) {
  if (response.status === 'connected') {
    chooseGroup();
  } else if (response.status === 'not_authorized') {
    $('#login-container').css('display', 'block');
  } else {
    $('#login-container').css('display', 'block');
  }
}

function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}

window.fbAsyncInit = function() {
FB.init({
  appId      : '358107944353091',
  cookie     : true,
  xfbml      : true,
  version    : 'v2.2'
});

FB.getLoginStatus(function(response) {
  statusChangeCallback(response);
});

};


(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function loadComments(groupId, next) {
    FB.api('/'+groupId+'/'+next, function(response) {
      if (response.data.length > 0) {
        printComments(response.data);
        printPagination(response.paging);
        visiblePagination();
      }
    });
}

function printComments(response) {
  $('#body-comment').empty();
  $.each(response, function(key, index) {
    var idData = {'idPost':index.id};
    var link = "null";
    if (index.link != null) { link = index.link; }
    $.ajax({
      type: "GET",
      url: "inc/getPostTags.php",
      data: idData,
      dataType: 'json',
      success: function(data){
        if(data.result == true) {
          var tags = data.tags.split(',');
          var stringTags = '';
          var tipo = data.tipo;
          $.each(tags, function(key2, index2) {
            stringTags += '<span class="taggie"><a href="">'+index2+'</a></span>';
          });
          var message = 'This comment is empty';
          if (index.message != null) { message = index.message; }
          $('#body-comment').append('<div class="row"><div class="col-md-12 comenta-container"><div class="col-md-1 picture">'
          +'<img class="img-responsive" src="http://graph.facebook.com/'+index.from.id
          +'/picture?width=200&height=200" alt="user"></div><div class="col-md-11 comenta-content">'
          +'<div class="col-md-12 name"><h2>'+index.from.name+'</h2></div><div class="col-md-12 time"><h3>'+index.created_time
          +'</h3></div><div class="col-md-12 comentario"><p>'+message+'</p></div><div class="col-md-2 moderar">'
          +'<button data-id="'+index.id+'" data-link="'+link+'" data-date="'+index.created_time+'" data-fromid="'+index.from.id+'" data-fromname="'+index.from.name+'" class="btn btn-default set" data-tags="'+tags+'" data-tipo="'
          +tipo+'" data-toggle="modal" data-target=".modal-tag">Modificar</button></div><div class="col-md-1 tags-label"><h3>Tags:</h3></div>'
          +'<div class="col-md-9 tags">'+stringTags+'</div></div></div></div>');
        }
        else if(data.result == false) {
          var message = 'This comment is empty';
          if (index.message != null) { message = index.message; }
          stringTags = '';
          $('#body-comment').append('<div class="row"><div class="col-md-12 comenta-container"><div class="col-md-1 picture">'
          +'<img class="img-responsive" src="http://graph.facebook.com/'+index.from.id+'/picture?width=200&height=200" alt="user"></div>'
          +'<div class="col-md-11 comenta-content"><div class="col-md-12 name"><h2>'+index.from.name+'</h2></div><div class="col-md-12 time"><h3>'
          +index.created_time+'</h3></div><div class="col-md-12 comentario"><p>'+message+'</p></div><div class="col-md-2 moderar"><button data-id="'
          +index.id+'" data-link="'+link+'" data-date="'+index.created_time+'" data-fromid="'+index.from.id+'" data-fromname="'+index.from.name+'" class="btn btn-default mod" data-tags="" data-tipo="" data-toggle="modal" data-target=".modal-tag">'
          +'Moderar Tag</button></div><div class="col-md-1 tags-label"></div><div class="col-md-9 tags"></div></div></div></div>');

        }
        else {
          alert('Tenemos problemas. Inténtelo más tarde');
        }
      }
    });
  });
}

function printPagination(response) {
  var url = response.next.substr(response.next.indexOf('feed'), response.next.length);
  $('#next-a').attr('href', url);
  url = response.previous.substr(response.previous.indexOf('feed'), response.previous.length);
  $('#previous-a').attr('href', url);
}

function visiblePagination() {
  $('.pagination').css('display', 'block');
}

function invisiblePagination() {
  $('.pagination').css('display', 'none');
}

function showGoBack() {
  $('#goback-container').css('display', 'block');
}

function hideGoBack() {
  $('#goback-container').css('display', 'none');
}

function loginFB(){
  FB.login(function(response) {
    if (response.authResponse) {
      $('#login-container').css('display', 'none');
      checkLoginState();
    }else{

    }
  }, {scope: 'email,email,user_groups'});
}

function chooseGroup() {
  FB.api('/me/groups', function(response) {
    if (response.data.length > 0) {
      var contGroup = 0;
      $('#select-group').css('display', 'block');
      $.each(response.data, function(key, index) {
        var string = '<tr><td><h5>'+index.name+'</h5></td><td><a class="selected-group" href="" data-id="'+index.id+'"><span class="glyphicon glyphicon-ok"></span></a></td></tr>';
        $('#body-table').append(string);
      });
    }
  });
}

$(document).ready(function() {
  $('.page a').on('click', function(evt){
    var url = $(this).attr('href');
    loadComments(id, url);
    $('html, body').animate({ scrollTop: 0 }, 'slow');
    evt.preventDefault();
  });

  $('#body-table').on('click', '.selected-group', function(evt) {
    id = $(this).data('id')
    var dataString = {"idFacebook":idFacebook,"idGroup":id};
    $.ajax({
      type: "POST",
      url: "inc/addAdmin.php",
      data: dataString,
      dataType: 'json',
      success: function(data) {
        if(data.result == true) {
          $('#select-group').css('display', 'none');
          loadComments(id, "feed");
        }
        else {
          alert("Se ha producido un error. Vuelva a intentarlo");
        }
      }
    });
    evt.preventDefault();
  });

  $('.fb-button').on('click', function(evt) {
    loginFB();
    evt.preventDefault();
  });

  $('.modal-footer').on('click', '.mod', function(evt) {
    var tags = $('input#tag').val();
    if (tags == null || tags.length <= 0) {
      alert('Introduzca algún "tag" separado por comas');
    } else {
      var tipo = $('#type').val();
      var data = {'idPost':idMensaje,
                  'idGroup':id,
                  'tipo': tipo,
                  'tags': tags,
                  'timestamp': time,
                  'from_id': fromid,
                  'from_name': fromname,
                  'message': msg,
                  'link': linkCap};
      var url = '';
      if (config == true) {url = 'inc/updatePost.php';}
      else {url = 'inc/addPost.php';}
      $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: 'json',
        success: function(data) {
          if(data.result == true) {
            if (config == false) {
              $(boton).removeClass('mod');
              $(boton).addClass('set');
              $(boton).empty().append('Modificar');
              $(boton).data('tags', tags);
              $(boton).data('tipo', tipo);
              $(boton).parent().parent().children('.tags-label').append('<h3>Tags:</h3>');
              var stringTag = '';
              tags = tags.split(',');
              $.each(tags, function(key, index) {
                stringTag += '<span class="taggie"><a href="">'+index+'</a></span>';
              });
              $(boton).parent().parent().children('.tags').append(stringTag);
            }
            if(config == true) {
              $(boton).data('tags', tags);
              $(boton).parent().parent().children('.tags').empty();
              var stringTag = '';
              tags = tags.split(',');
              $.each(tags, function(key, index) {
                stringTag += '<span class="taggie"><a href="">'+index+'</a></span>';
              });
              $(boton).parent().parent().children('.tags').append(stringTag);
            }
            $('.modal-tag').modal('hide');
          }
          else {
            alert("Se ha producido un error. Vuelva a intentarlo");
          }
        }
      });
    }
    evt.preventDefault();
  });

  $('#body-comment').on('click', '.mod', function(evt) {
    $('#tag').val('');
    $('#type').val(1);
    boton = this;
    config = false;
    catchData(this);
  });

  $('#body-comment').on('click', '.set', function(evt) {
    $('#tag').val($(this).data('tags'));
    $('#type').val($(this).data('tipo'));
    boton = this;
    config = true;
    catchData(this);
  });

  $('#buscar-form').on('submit', function(){
    if (id == '') {
      alert('Selecciona un grupo');
    }else {
      var idToSearch = $('#idSearch').val();
      if (idToSearch.lenght <= 0) {
        alert('Introduce un id válido');
      }else {
        searchMessage(idToSearch);
      }
    }
    return false;
  });

  $('#goback-container').on('click', '#goback', function(evt){
    evt.preventDefault();
    loadComments(id, "feed");
    hideGoBack();
  });
});

function catchData(bt) {
  fromid = $(bt).data('fromid');
  fromname = $(bt).data('fromname');
  msg = $(bt).parent().parent().find('.comentario').text();
  time = $(bt).data('date');
  idMensaje = $(bt).data('id');
  linkCap = $(bt).data('link');
}

function searchMessage(idToSearch) {
  FB.api('/'+idToSearch, function(response) {
    if (response.id == null) {
      alert('El mensaje no se ha encontrado');
    }
    else if (response.to.data[0].id != id) {
      alert('El mensaje no pertenece a este grupo');
    }
    else {
      var data = [];
      data[0] = response;
      printComments(data);
      invisiblePagination();
      showGoBack();
    }

  });
}
