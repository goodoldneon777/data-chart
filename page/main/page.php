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
      require(SERVER_ROOT . '/module/form_elem/module.php');
      require(SERVER_ROOT . '/module/axes/module.php');
      require(SERVER_ROOT . '/module/filters/module.php');
      require(SERVER_ROOT . '/module/chart/module.php');
      require(SERVER_ROOT . '/module/html_foot/module.php');
    ?>


    <?php
      htmlHeadCreate(); //Create html_head module.
    ?>

    <link rel="stylesheet" media="screen" href="<?php echo WEB_ROOT . "/page/main/dist/style.min.css"; ?>">

  </head>



  <body>

    <div class="l-body">

      <div class="l-left">

        <button type="button" class="submitBtn btn btn-xlarge btn-success">Generate Chart</button>


        <div class="accordion panel-group" role="tablist" aria-multiselectable="true">

          <div class="panel panel-primary">
            <div class="panel-heading" role="button" data-toggle="collapse" data-parent=".accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <h4 class="panel-title">Main</h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                <?php
                  // axesCreate();  //Create axes module.
                  echo filtersCreate();  //Create filter module.
                ?>
              </div>
            </div>
          </div>

          <div class="panel panel-primary">
            <div class="panel-heading" role="button" data-toggle="collapse" data-parent=".accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <h4 class="panel-title">Filters</h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
              <div class="panel-body">
                <?php
                  echo filtersCreate();  //Create filter module.
                ?>
              </div>
            </div>
          </div>

          <div class="panel panel-primary">
            <div class="panel-heading" role="button" data-toggle="collapse" data-parent=".accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              <h4 class="panel-title">Appearance</h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
              <div class="panel-body">
                {appearance stuff here}
              </div>
            </div>
          </div>

          <div class="panel panel-primary">
            <div class="panel-heading" role="button" data-toggle="collapse" data-parent=".accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              <h4 class="panel-title">Regression</h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
              <div class="panel-body">
                {regression stuff here}
              </div>
            </div>
          </div>
   
        </div>

      </div>
      

      <div class="l-right">
        <?php
          chartCreate(); //Create chart module.
        ?>
      </div>


		</div>



    <?php
      htmlFootCreate(); //Create html_foot module.
    ?>
    

    <script src="<?php echo WEB_ROOT . "/plugin/highcharts/highcharts.js"; ?>"></script>
    <script src="<?php echo WEB_ROOT . "/page/main/dist/script.min.js"; ?>"></script>


  </body>
</html>