<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
    <head>
       <?php include("../content/start.php"); ?>
        <?php include("../content/meta.html"); ?>
        <?php include("../content/css.html"); ?>
        <?php include("../content/js.html"); ?>
      <script src="../js/add-youtube-page.js"></script>
       						  <script src="../js/serviceadmin.js"></script>
    </head>
    <body>

    
     <?php include("../content/site-logo.html"); ?>
     
                     <br/><br/><br/>
                              		 <div class="span3"> 
									 <?php include("../script/addons.html"); ?> 
									 </div>
										
										<div class="span6" >
										
                            <div class="row-fluid center">   
                            
     <div class="row-fluid">
          <div class="control-group warning ">
          <span class="help-inline span6 ">Channel Name </span>
          <input id="userid" type="text" class="span6" placeholder="">
          </div>
     </div>
     
      <div class="row-fluid">
          <div class="control-group warning ">
          <a id="addbutton" class="btn btn-primary" onclick="createyoutubeuser();">Create Youtube User</a>
          </div>
     </div>
              
                         
            </div>
                            <div class="row-fluid"> <div class="">   <?php include("../script/youtubeusers.html"); ?>  </div></div>
<br/><br/><br/>
        					</div>
		<div class="span3">
		<?php include("../script/youtubetags.html"); ?>
		</div>
		
							 </div>
							 
							 
        <div class="row-fluid statusbar btn-warning">
            <div class='span6 offset3' id="statusinfodiv">
                 <?php echo include("../content/end.php"); ?>
            </div>
        </div>

    </body>
</html>
