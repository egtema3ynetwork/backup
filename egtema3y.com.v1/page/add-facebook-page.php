<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
    <head>
       <?php include("../content/start.php"); ?>
        <?php include("../content/meta.html"); ?>
        <?php include("../content/css.html"); ?>
        <?php include("../content/js.html"); ?>
                            <script src="../js/add-facebook-page.js"></script>
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
		<div class="span3">
							<?php include("../script/addons.html"); ?> 
							</div>
		<div class="span6" >
		
		 <div class="row-fluid center">   
                            
     <div class="row-fluid">
          <div class="control-group warning ">
          <span class="help-inline span6 ">Facebook Page  </span>
          <input id="pageid" type="text" class="span6" placeholder=" Id or User Name">
          </div>
     		 </div>
			
			 <div class="row-fluid">
          <div class="control-group warning ">
          <span class="help-inline span6 ">Facebook Page Tags </span>
          <input id="pagetags" type="text" class="span6" placeholder=" 1 or 2 or ...">
          </div>
     		 </div>
     
      <div class="row-fluid">
          <div class="control-group warning" >
          <a id="addbutton" class="btn btn-primary" onclick="createpage();">Create Facebook Page</a>
          </div>
     </div>
	
            </div>
			
			
                            <div class="row-fluid">    <?php include("../script/facebookusers.html"); ?>  </div>
								<br/><br/><br/>
		
		</div>
		<div class="span3">
		<?php include("../script/facebooktags.html"); ?> 
		</div>
		
							 </div>
                           
								

        
        <!--<div class="row-fluid statusbar btn-warning">
            <div class='span6 offset3' id="statusinfodiv">
                 <?php echo include("../content/end.php"); ?>
            </div>
        </div>-->

    </body>
</html>
