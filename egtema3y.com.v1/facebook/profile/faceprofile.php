<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap-responsive.min.css" rel="stylesheet">

    <script src="jquery.js"></script>
     <script src="jquery.tmpl.js"></script>
    <script src="bootstrap.min.js"></script>


    <style>
        
        .shadow {
    padding: 5px;
    -moz-box-shadow: 0 4px 8px rgba(0,0,0,0.5);
    -webkit-box-shadow: 0 4px 8px rgba(0,0,0,0.5);
    box-shadow: 0 4px 8px rgba(0,0,0,0.5);

    -webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;

}

.face_fromname {
    font-size: large;
    color: #0000FF;
    font-weight: bold;
    font-family: lucida grande,tahoma,verdana,arial,sans-serif;
}

.face_img {
  width: 48px;
height: 48px;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
    border: 0;
    -moz-box-shadow: 0 4px 8px rgba(0,0,0,0.5);
    -webkit-box-shadow: 0 4px 8px rgba(0,0,0,0.5);
    box-shadow: 0 4px 8px rgba(0,0,0,0.5);
}


.shadow {
    padding: 5px;
    -moz-box-shadow: 0 4px 8px rgba(0,0,0,0.5);
    -webkit-box-shadow: 0 4px 8px rgba(0,0,0,0.5);
    box-shadow: 0 4px 8px rgba(0,0,0,0.5);

    -webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;

}

        
    </style>
</head>
     <body >
         <div>
         <center> <div  class=" row-fluid label label-warning">   بياناتى  </div> </center>
         <center><div class=" row-fluid"> <div class="span3 offset5"><?php include ("profile.tmp.html");?></div></div></center>
         </div>

         <div class="row-fluid">
             
             <div class="span3">   <?php include ("ownpages.tmp.html"); ?></div>
               <div  class="span3"> <?php include ("groups.tmp.html");?></div>
                 <div  class="span3"><?php include ("friends.tmp.html");?></div>
                   <div  class="span3"> <?php include ("pages.tmp.html");?></div>
                   
                   
         </div>



     
    </body>
</html>

