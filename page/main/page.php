<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Steel Server Web Chart</title>

    <?php
      //Load module files.
      require(SERVER_ROOT . '/module/html_head/module.php');
      require(SERVER_ROOT . '/module/create_formElem/module.php');
      require(SERVER_ROOT . '/module/axes/module.php');
      require(SERVER_ROOT . '/module/chart/module.php');
      require(SERVER_ROOT . '/module/html_foot/module.php');
    ?>


    <?php
      create_html_head(); //Create html_head module.
    ?>

    <link rel="stylesheet" media="screen" href="<?php echo WEB_ROOT . "/page/main/dist/style.min.css"; ?>">

  </head>



  <body>

    <div class="l-body">

      <div class="l-left">
        <?php
          create_axes();  //Create axes module.
        ?>
      </div>


      <div class="l-right">
        <?php
          create_chart(); //Create chart module.
        ?>
      </div>


		</div>



    <?php
      create_html_foot(); //Create html_foot module.
    ?>
    

    <script src="<?php echo WEB_ROOT . "/plugin/highcharts/highcharts.js"; ?>"></script>
    <script src="<?php echo WEB_ROOT . "/page/main/dist/script.min.js"; ?>"></script>


  </body>
</html>