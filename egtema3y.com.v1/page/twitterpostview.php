<html lang="en" xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="https://www.facebook.com/2008/fbml">
    
<head>
<?php include("../content/start.php"); ?>


  <?php include("../content/meta.html"); ?>
  <?php include("../content/css.html"); ?>
   <link href="../css/facepostview.css" rel="stylesheet">
  <?php include("../content/js.html"); ?>
 			    <style>
        hr
        {
            visibility: collapse;
        }
		.face_controlpanel {
    visibility: hidden;
}

.btn_more_twitter {
    visibility: hidden;
}

.form-search {
    visibility:hidden;
}
		
        </style>
  
</head>
<body>
 <?php include("../sdk/facebook/facebook-sdk.html"); ?>
 <?php include("../content/site-logo.html"); ?>
		 <?php include("../content/mainmenu.html"); ?>
		   <br/><br/><br/><br/><br/><br/>

<?php
function getcurrentpath()
{
    $curPageURL = "";
    //if ($_SERVER["HTTPS"] != "on")
        $curPageURL .= "http://";
    //else
    //    $curPageURL .= "https://" ;
    //if ($_SERVER["SERVER_PORT"] == "80")
        $curPageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    //else
    //    $curPageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    $count = strlen(basename($curPageURL));
    $path = substr($curPageURL,0, -$count);
    return $path ;
}


?>
   
    	  <div class="row-fluid">
		
		<div class="span3 "> 
		<?php include("../script/addons.html"); ?> 
		</div>
		<div class="span9">
					    <div class="row-fluid">
  
  <div >
   <div id='facewall'><?php include("../script/twitterfeeds.html"); ?></div>
 </div>
 									<center>
   <div class="row-fluid facebooktools">
    <div class="fb-like row-fluid"  data-href="<?php echo getcurrentpath()?>twitterpostview.php?postid=<?php echo $_GET['postid']?>&tags=<?php echo $_GET['tags']?>" data-send="true" data-width="450" data-show-faces="true"></div>
    <div class="fb-comments row-fluid" data-href="<?php echo getcurrentpath()?>twitterpostview.php?postid=<?php echo $_GET['postid']?>&tags=<?php echo $_GET['tags']?>" data-width="470" data-num-posts="2"> </div>
<!--<a class="btn btn-primary" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo getcurrentpath()?>facebookpostview.php?postid=<?php echo $_GET['postid']?>&tags=<?php echo $_GET['tags']?>" target="_blank">
  Share on Facebook
</a>-->   
   </div>
			</center>
			
 </div>
		 </div>
		
		
		</div>
    
    




<div class="row-fluid statusbar">
    <div id="statusinfodiv">
<?php include("../content/end.php"); ?>
?>
</div>
</div>

</body>
</html>

