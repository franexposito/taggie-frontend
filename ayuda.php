<?php
  include('inc/utilities.php');
  $lan = getLang();
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taggie. Equipo de proyecto</title>

    <!-- CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- navigation -->
    <?php menu(3, $lan); ?>
    <!-- navigation -->

    <main class="container-fluid">
      <!-- -->
      <div class="col-sm-12">
        <div class="home-cont col-sm-6 col-sm-offset-3">
          <h2>A continuación te mostraremos un pequeño tutorial con los primeros pasos para usar Taggie.</h2>
        </div>
        <?php
          /*foreach ($json as $a => $b) {
            echo $b;
          }*/
        ?>
        <div class="col-sm-6 col-sm-offset-3">
          <div class="help-cont col-sm-12">
            <img src="http://taggie.me/help/img/t1.png" />
          </div>
          <!--<div class="text-help col-sm-12">
            <p>Esta es la pantalla principal de Taggie.<br/>Para empezar a utilizarla debes loguearte con tu cuenta de
              Facebook.</p>-->
          </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
          <div class="help-cont col-sm-12">
            <img src="http://taggie.me/help/img/t2.png" />
          </div>
          <!--<div class="text-help col-sm-12">
            <p>Esta es la pantalla principal de Taggie.<br/>Para empezar a utilizarla debes loguearte con tu cuenta de
              Facebook.</p>-->
          </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
          <div class="help-cont col-sm-12">
            <img src="http://taggie.me/help/img/t3.png" />
          </div>
          <!--<div class="text-help col-sm-12">
            <p>Esta es la pantalla principal de Taggie.<br/>Para empezar a utilizarla debes loguearte con tu cuenta de
              Facebook.</p>-->
          </div>
        </div>
      </div>
      <!-- -->
    </main>

    <!-- footer -->
    <footer>
        <p>@2015 <strong>MakeYourApp LTD</strong>.</p>
    </footer>
    <!-- fin footer -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  </body>
</html>
