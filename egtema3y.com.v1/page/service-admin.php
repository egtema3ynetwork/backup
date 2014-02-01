<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
    <head>
       <?php include("../content/start.php"); ?>
        <?php include("../content/meta.html"); ?>
        <?php include("../content/css.html"); ?>
        <?php include("../content/js.html"); ?>
      <script src="../js/serviceadmin.js"></script>
        
        
        <style>
        .facebooktools
        {
            visibility: collapse;
        }
        </style>

    </head>
    <body>

        <?php include("../content/site-logo.html"); ?>
                  <br/><br/><br/>
                  
             <div class="row-fluid">
            <div class="control-group warning ">
              <a  class="btn btn-primary" onclick="autoupdatefacebookpage();">Auto Update Facebook Page </a>
              <span id="autoupdatefacebook" >Click To Run Facebook Page Auto Update Feeds</span>
          </div>
          </div>

          
            <div class="row-fluid">
            <div class="control-group warning ">
              <a  class="btn btn-primary" onclick="autoupdatetwitterpage();">Auto Update Twitter Page </a>
              <span id="autoupdatetwitter" >Click To Run Twitter Page Auto Update Feeds</span>
          </div>
          </div>
		  
		   <div class="row-fluid">
            <div class="control-group warning ">
              <a  class="btn btn-primary" onclick="autoupdateyoutubepage();">Auto Update youtube Page </a>
              <span id="autoupdateyoutube" >Click To Run youtube Page Auto Update Feeds</span>
          </div>
          </div>


                       
       <div class="row-fluid statusbar btn-warning">
            <div class='span6 offset3' id="statusinfodiv">
                 <?php echo include("../content/end.php"); ?>
            </div>
        </div>       

    </body>
</html>