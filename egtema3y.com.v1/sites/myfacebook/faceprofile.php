<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap-responsive.min.css" rel="stylesheet">

    <script src="jquery.js"></script>
     <script src="jquery.base64.js"></script>
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




        
    </style>
</head>
     <body >
         <?php include_once("analyticstracking.php") ?>
          <br> <br>
         <div class="row-fluid span8 offset2"> جرب موقع فيسبوكى بكل امكانياته بدون دعاية  بــ 10 جنيه فقط لمدة اسبوع 
        

          <p class="label label-inverse"> 01122354855</p>
     <p class="label label-inverse"> 01009526580</p>
</div>
         
          <br>
         <div class=" row-fluid" >
       

              <div class=" row-fluid span10 offset1 btn-inverse " style="height: 20px;">    </div>
            

       
             
             <div class=" row-fluid">
              
                  
                 <div class="row-fluid span6 offset1">
                    <br>
                   
                      <div id="TT_info"  class=" row-fluid label label-inverse"> </div>
                      <br> <br>
                     
                     
                 <div class="row-fluid " id="divcontent1"></div>
                 </div>

                     <div class="span3 offset1">

<?php include ("profile.tmp.html");?>

                  
                       <div id="div_controls" class="row-fluid span10 offset1">
                             <div class="row-fluid"><a id="BB__view_publicfeeds" style="width: 200px;" class="btn btn-inverse" onclick="loadpublicfacebookfeeds('');$('html, body').animate({ scrollTop: 0 }, 'fast');"> اعرض أخر الاخبار المتداولة على الفيسبوك </a></div>

                         <br>
            <div class="row-fluid"><a id="BB__share_mywall" style="width: 200px;" class="btn btn-inverse" onclick="show_mywall_div();$('html, body').animate({ scrollTop: 0 }, 'fast');"> اكتب على حائطى </a></div>

                         <br>
                           <div class="row-fluid"><a id="BB__share_mygroups" style="width: 200px;" class="btn btn-inverse" onclick="show_mygroups_post_div();$('html, body').animate({ scrollTop: 0 }, 'fast');"> اكتب على حائط الجروبات </a></div>
                           <br>
                             <div class="row-fluid"><a id="BB__share_myaccounts" style="width: 200px;" class="btn btn-inverse" onclick="show_myaccounts_post_div();$('html, body').animate({ scrollTop: 0 }, 'fast');"> اكتب على حائط الصفحات الخاصة </a></div>
                           <br>
         <div class="row-fluid"><a id="BB__ownpages" style="width: 200px;" class="btn btn-inverse" onclick=" loadfacebookownpages();$('html, body').animate({ scrollTop: 0 }, 'fast');"> اعرض صفحاتى الخاصة </a></div>
          <br>
                          <div class="row-fluid"><a id="BB__pages" style="width: 200px;" class="btn btn-inverse" onclick="loadfacebookpages();$('html, body').animate({ scrollTop: 0 }, 'fast');"> اعرض كل الصفحات </a></div>
                      <br>
                        <div class="row-fluid"><a id="BB__friends" style="width: 200px;" class="btn btn-inverse" onclick="loadfacebookfriends();$('html, body').animate({ scrollTop: 0 }, 'fast');"> اعرض أصدقائى </a></div>
      <br>
<div class="row-fluid"><a id="BB__groups" style="width: 200px;" class="btn btn-inverse" onclick="loadfacebookgroups(); $('html, body').animate({ scrollTop: 0 }, 'fast');"> اعرض جروباتى </a></div>

                         <br>
                               <div class="row-fluid"><a id="BB__view_publicfeeds" style="width: 200px;" class="btn btn-inverse" onclick="loadpublicfacebookfeeds('4');$('html, body').animate({ scrollTop: 0 }, 'fast');"> اعرض أخر مايتم تداوله على الصفحات الكوميديه والترفيهيه </a></div>

                         <br>
                            <div class="row-fluid"><a id="BB__view_publicfeeds" style="width: 200px;" class="btn btn-inverse" onclick="loadpublicfacebookfeeds('8');$('html, body').animate({ scrollTop: 0 }, 'fast');"> اعرض أخر مايتم تداوله على الصفحات الرياضية </a></div>

                         <br>
                           <div class="row-fluid"><a id="BB__view_publicfeeds" style="width: 200px;" class="btn btn-inverse" onclick="loadpublicfacebookfeeds('9');$('html, body').animate({ scrollTop: 0 }, 'fast');"> اعرض أخر مايتم تداوله على صفحات النساء والبنات </a></div>

                         <br>
                                    </div>


                        </div>
             </div>
         
       

         </div>



         <div class="row-fluid">
             
             <div class="span2">   <?php include ("ownpages.tmp.html"); ?></div>
               <div  class="span2"> <?php include ("groups.tmp.html");?></div>
                 <div  class="span2"><?php include ("friends.tmp.html");?></div>
                   <div  class="span2"> <?php include ("pages.tmp.html");?></div>
                       <div  class="span2"> <?php include ("postwall.tmp.html");?></div>
                       <div  class="span2"> <?php include ("postgroups.tmp.html");?></div>
               <div  class="span2"> <?php include ("postaccounts.tmp.html");?></div>
               <div  class="span2"> <?php include ("publicfeeds.tmp.html");?></div>
         </div>


         <script>
             show_mywall_div();
         </script>
     
    </body>
</html>

