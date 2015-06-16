<?php
  function getLang() {
    $lang = 'es';
    if ($_GET['lan']) {
      $lan = $_GET['lan'];
        switch ($lang) {
          case 'it':
            $lang = $lan;
            break;
        case 'es':
            $lang = $lan;
            break;
        default:
            $lang = 'es';
      }
    } else {
      substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }

    return $lang;

  }

  function translate($phrase, $lang) {
    $translation = null;
    switch ($lang) {
        case 'it':
            require('lang/it.php');
            $translation = $dicc[$phrase];
            break;
        case 'es':
            $translation = $phrase;
            break;
    }
    return $translation;
  }

  function menu($type, $lan) {
    switch ($type) {
      case 1:
        if ($_GET['lan'] == 'it') {
          $var1 = array('text' => translate('Equipo', $lan), 'url' => 'equipo?lan=it');
          $var2 = array('text' => translate('Ayuda', $lan), 'url' => 'ayuda?lan=it');
        } else {
          $var1 = array('text' => translate('Equipo', $lan), 'url' => 'equipo');
          $var2 = array('text' => translate('Ayuda', $lan), 'url' => 'ayuda');
        }

        break;
      case 2:
        if ($_GET['lan'] == 'it') {
          $var1 = array('text' => translate('Inicio', $lan), 'url' => '/help/?lan=it');
          $var2 = array('text' => translate('Ayuda', $lan), 'url' => 'ayuda?lan=it');
        } else {
          $var1 = array('text' => translate('Inicio', $lan), 'url' => '/help');
          $var2 = array('text' => translate('Ayuda', $lan), 'url' => 'ayuda');
        }

        break;
      case 3:
        if ($_GET['lan'] == 'it') {
          $var1 = array('text' => translate('Inicio', $lan), 'url' => '/help?lan=it');
          $var2 = array('text' => translate('Equipo', $lan), 'url' => 'equipo?lan=it');
        } else {
          $var1 = array('text' => translate('Inicio', $lan), 'url' => '/help');
          $var2 = array('text' => translate('Equipo', $lan), 'url' => 'equipo');
        }
        break;
    }

    echo '
      <nav class="navbar-taggie col-sm-6 col-sm-offset-3">
        <div class="idiomas">
          <a href="?lan=es"><img src="img/spanish_flag.png" ></a>
          <a href="?lan=it"><img src="img/italian_flag.png" ></a>
        </div>
        <div class="logo col-sm-12">
          <h4>Taggie</h4>
          <img src="img/logo_red.png" alt="logo" />
        </div>
        <div class="col-sm-12">
          <ul class="nav-taggie">
            <li><a href="'.$var1["url"].'">'.$var1["text"].'</a></li>
            <li><a href="'.$var2["url"].'">'.$var2["text"].'</a></li>
            <li><a target="_blank" href="policy">Policy</a></li>
          </ul>
        </div>
      </nav>';
    }
?>
