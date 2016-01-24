<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Steel Server Web Chart</title>

    <?php
      require(SERVER_ROOT . '/module/html_head/module.php');
      require(SERVER_ROOT . '/module/create_formElem/module.php');

      create_html_head();
    ?>


  </head>



  <body>

    <div class="l-body">

      <div class="l-left">
        <?php
          include(SERVER_ROOT . '/module/axes/module.php');

          create_axes();
        ?>
      </div>


		</div>



    <?php
      require(SERVER_ROOT . '/module/html_foot/module.php');

      create_html_foot();
    ?>
    

    <script src="<?php echo WEB_ROOT . "/page/test2/dist/script.min.js"; ?>"></script>


  </body>
</html>