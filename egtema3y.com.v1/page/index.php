<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
    <head>
       <?php include("../content/start.php"); ?>
        <?php include("../content/meta.html"); ?>
        <?php include("../content/css.html"); ?>
        <?php include("../content/js.html"); ?>

        <style>
        .facebooktools
        {
            visibility: collapse;
        }
        </style>

    </head>
    <body>

 <?php include("../script/analyticstracking.html");  header("Location: facebook.php");  ?>
       

        <?php include("../content/site-logo.html"); ?>
        <?php include("../content/mainmenu.html"); ?>
       <br/><br/><br/><br/><br/><br/>
        

                  <div class="row-fluid">
		
		<div class="span3"> <?php include("../script/addons.html"); ?> </div>
		<div class="span9"> <?php include("../content/info.html"); ?>  </div>
		<div class=""></div>
		
		</div>
		
       

<br/><br/><br/>
                       
        <!--<div class="row-fluid statusbar btn-warning">
            <div class='span6 offset3' id="statusinfodiv">
                 <?php echo include("../content/end.php"); ?>
            </div>
        </div>        -->

    </body>
</html>

