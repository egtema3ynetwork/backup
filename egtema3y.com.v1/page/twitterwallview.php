<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<?php include("../content/start.php"); ?>


  <?php include("../content/meta.html"); ?>
  <?php include("../content/css.html"); ?>
 
  <?php include("../content/js.html"); ?>
 
  
  
</head>
<body>
 <?php //include("../sdk/facebook/facebook-sdk.html"); ?>
<?php include("../content/site-logo.html"); ?>
<?php
$pageid = isset($_GET['wallid']) ? $_GET['wallid'] : '';

if($pageid !="")
{
?>


<?php
}
?>
   
    
    
    
 <div class="row-fluid">
  
  <div class="span8 offset2">
    <div id='facewall'><?php include("../script/twitterfeeds.html"); ?></div>
 </div>
 
 </div>



<div class="row-fluid statusbar">
    <div id="statusinfodiv">
<?php include("../content/end.php"); ?>
</div>
</div>

</body>
</html>

