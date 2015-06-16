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
    <?php menu(2, $lan); ?>
    <!-- navigation -->

    <main class="container-fluid">
      <!-- inicio -->
      <div class="home-cont col-md-12">
        <h2><?php echo translate("Equipo de Taggie", $lan); ?></h2>
      </div>

      <!-- equipo -->
      <div id="team">
        <div class="team-cont col-sm-12">
          <div class="devs col-sm-6 col-sm-offset-3">
            <h2>Rafael Ruiz Muñoz</h2>
            <p><?php echo translate("Ha estudiado la Licenciatura en Matemáticas entre 2008 y 2012 y un Máster en Tecnologías Multimedia en 2013.
                Conocimiento en ramas de ingeniería como informática, tecnologías móviles y visión por computadora.", $lan); ?></p>
            <p><?php echo translate("Actualmente reside en el Reino Unido, trabajando en Investigación y Desarrollo para una empresa privada y
                desarrollando aplicaciones e ideas propias con MakeYourApp LTD.", $lan); ?></p>
          </div>
          <div class="devs col-sm-6 col-sm-offset-3">
            <h2>Francisco Javier Expósito Cruz</h2>
            <p><?php echo translate("Ha estudiado Ingeniería Informática en la Universidad de Granada. Conocimiento en HTML5, CSS3, Javascript,
              PHP, Python, GAE, Boostrap 3, etc.", $lan); ?></p>
            <p><?php echo translate("Actualmente sigue cursando estudios en la Universidad de Granada y desarrollando aplicaciones para
              MakeYourApp LTD.
              ", $lan); ?></p>
          </div>
        </div>
      </div>
      <!-- fin equipo -->

      <!-- fin inicio -->
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
