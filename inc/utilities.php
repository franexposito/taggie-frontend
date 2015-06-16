<?php
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

  function menu() {
    echo '
      <nav class="navbar-taggie col-sm-6 col-sm-offset-3">
        <div class="idiomas">
          <img src="img/spanish_flag.png" >
          <img src="img/italian_flag.png" >
        </div>
        <div class="logo col-sm-12">
          <h4>Taggie</h4>
          <img src="img/logo_red.png" alt="logo" />
        </div>

        <div class="col-sm-12">
          <ul class="nav-taggie">
            <li><a href="equipo">';
      echo translate('Equipo', it);
      echo '
        </a></li>
          <li><a href="ayuda">';
      echo translate('Ayuda', it);
      echo '
          </a></li>
          <li><a target="_blank" href="policy">Policy</a></li>
        </ul>
        </div>
      </nav>';
    }
?>
