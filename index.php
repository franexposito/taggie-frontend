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
    <title>Taggie</title>

    <!-- CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <!-- navigation -->
    <?php menu(1, $lan); ?>
    <!-- navigation -->

    <!-- inicio -->
    <main class="container-fluid">
      <div class="home-cont col-md-6 col-md-offset-3">
        <h2><?php echo translate("La aplicación que gestionará los grupos de Facebook de 'Españoles en...'", $lan); ?></h2>
        <div class="col-xs-6 ios">
          <button class="btn btn-default"><?php echo translate('Descargar Taggie <br/>(iOS)', $lan); ?></button>
        </div>
        <div class="col-xs-6 and">
          <button class="btn btn-default"><?php echo translate('Descargar Taggie <br/>(Android)', $lan); ?></button>
        </div>
      </div>

      <!-- que es -->
      <div class="captura col-sm-12"></div>
      <!-- fin que es -->

      <div id="what">
        <div class="what-cont col-sm-12">
          <div class="col-sm-6 col-sm-offset-3 what1">
              <i class="fa fa-users fa-4x"></i>
              <h2><?php echo translate('Controla tus grupos', $lan); ?></h2>
              <p><?php echo translate("Gestiona los grupos del tipo 'Españoles en...' al que pertenezcas de una manera sencilla e intuitiva", $lan); ?></p>
            </div>
          <div class="col-sm-6 col-sm-offset-3 what2">
              <i class="fa fa-newspaper-o fa-4x"></i>
              <h2><?php echo translate("Filtra los contenidos", $lan); ?></h2>
              <p><?php echo translate("Filtra las entradas según su contenido. Puede introducir 'banco' y se mostrarán todas las entradas relativas a los bancos.", $lan); ?></p>
            </div>
          <div class="col-sm-6 col-sm-offset-3 what3">
              <i class="fa fa-clock-o fa-4x"></i>
              <h2><?php echo translate("No pierdas el tiempo", $lan); ?></h2>
              <p><?php echo translate("No pierdas el tiempo buscando entre todas las entradas de un grupo. Con Taggie lo tienes todo a mano.", $lan); ?></p>
            </div>
        </div>
      </div>
      <!-- fin inicio -->

    </main>
    <!-- -->

    <!-- footer -->
    <footer>
        <p>@2015 <strong>MakeYourApp LTD</strong>.</p>
    </footer>
    <!-- fin footer -->


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>
  </body>
</html>
