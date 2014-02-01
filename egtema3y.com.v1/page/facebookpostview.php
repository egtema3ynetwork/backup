<html lang="en" xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="https://www.facebook.com/2008/fbml">
    
<head>
<?php include("../content/start.php"); ?>


 <meta charset="utf-8">
    <title>تعليق احد الاصدقاء على خبر فى شبكة إجتماعى </title>
	<link rel="shortcut icon" type="image/x-icon" href="../img/rss.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta id="description" name="description" content="يمكنك قراءة هذا الخبر بالتفصيل على شبكة إجتماعى">
    <meta name="author" content="Egtema3y.com">
	<meta name="keywords" content="Facebook,Youtube,Twitter,Egtema3y,شبكة إجتماعى,محاكاة الفيسبوك,زيادة المعجبيين,ارسال رسائل متتعددة,ادارة الصفحات والجروبات">
   <META NAME="COPYRIGHT" CONTENT="&copy; 2013 Egtema3y.com">
   <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta property="fb:admins" content="amr0123060349" />
<meta property="fb:app_id" content="129108667268260" />
<meta property="og:image" content="../img/rss.ico" />
<link rel="image_src" href="../img/rss.ico"/>


  <?php include("../content/css.html"); ?>
   <link href="../css/facepostview.css" rel="stylesheet">
  <?php include("../content/js.html"); ?>
 			    <style>
        hr
        {
            visibility: collapse;
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
   <div id='facewall'><?php include("../script/facebookfeeds.html"); ?></div>
 </div>
 									<center>
   <div class="row-fluid facebooktools">
    <div class="fb-like row-fluid"  data-href="http://egtema3y.com/page/facebookpostview.php?postid=<?php echo $_GET['postid']?>&tags=<?php echo $_GET['tags']?>" data-send="true" data-width="450" data-show-faces="true"></div>
    <div class="fb-comments row-fluid" data-href="http://egtema3y.com/page/facebookpostview.php?postid=<?php echo $_GET['postid']?>&tags=<?php echo $_GET['tags']?>" data-width="470" data-num-posts="2"> </div>
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

