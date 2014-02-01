<?php ob_start(); ?>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <link href="http://css.egtema3y.com/bootstrap.min.css" rel="stylesheet">
        <link href="http://css.egtema3y.com/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="http://css.egtema3y.com/egtema3y.css" rel="stylesheet">


        <script src="http://js.egtema3y.com/jquery.js"></script>
        <script src="http://js.egtema3y.com/bootstrap.min.js"></script>
        <script src="http://js.egtema3y.com/jquery.base64.js"></script>
        <script src="http://js.egtema3y.com/jquery.tmpl.js"></script>
        <script src="http://js.egtema3y.com/egtema3y.js"></script>

    </head>
    <body >
    
    <br/><br/><br/>
      <div class="row-fluid "> <div id="TT_info" class="  label label-success" ></div></div>
    <br/><br/>

      <div class="row-fluid ">  <input style="height:25px;" class="shadow span8" type="text" id="txtpageid" value=""></div>
         <br/>
         <div class="row-fluid"> <input id="btn_share" onclick="autoLoadInfo();" class="btn btn-inverse shadow span6 offset1" type="submit" value=" Load Info ">  </div>
       <br/>
       <div class="row-fluid ">  <input style="height:25px;" class="shadow span8" type="text" id="txtpageid2" value=""></div>
        <div class="row-fluid ">  <input style="height:25px;" class="shadow span8" type="text" id="txtpagename2" value=""></div>
         <div class="row-fluid ">  <input style="height:25px;" class="shadow span8" type="text" id="txtpageusername2" value=""></div>
         
            <br/>
     
       <div class="row-fluid"> <input id="btn_share" onclick="autoLoadPosts();" class="btn btn-inverse shadow span6 offset1" type="submit" value=" Load Posts ">  </div>
       <br/> 
       <div class="row-fluid "> <div id="TT_posts" class="  label label-inverse" ></div></div>
       
        <br/>  <br/> 
       <div class="row-fluid ">  <input style="height:25px;" class="shadow span8" type="text" id="txtpostid" value=""></div>
        <br/> 
  <div class="row-fluid"> <input  onclick="autoLikePost();" class="btn btn-inverse shadow span6 offset1" type="submit" value=" سجل اعجاب">  </div>
           
            <script>
            
                         function autoLoadPosts() {
            
              
                var pageid = $('#txtpageid2').val();
     
                var _url = "http://webservices.egtema3y.com/facebookapi.php?need=objectposts&objectid=" +pageid;

                console.log("call service : " + _url);

                $('#TT_info').html('جارى التحميل ....');
                 $('#TT_posts').html('');
                $.getJSON(_url, function (data) {
                
                         $('#TT_info').html('');
   
                    $.each(data.result.data, function () {
                      
                        
                         $('#TT_posts').html( $('#TT_posts').html() + this.post_id + " - " + this.message + "<br/>" );
                         
                    });

                   });


            }
            
            
            
             function autoLoadInfo() {
            
              
                var pageid = $('#txtpageid').val();
     
                var _url = "http://webservices.egtema3y.com/facebookapi.php?need=objectinfo&objectid=" +pageid;

                console.log("call service : " + _url);

                $('#TT_info').html('جارى التحميل ....');
                $.getJSON(_url, function (data) {
$('#TT_info').html('');

$('#txtpageid2').val(data.pageid);
$('#txtpagename2').val(data.pagename);
$('#txtpageusername2').val(data.pageusername);

   console.log(data.pageid);
    console.log(data.pagename);
     console.log(data.pageusername);
   
   
                    
                    $.each(data.messages, function () {
                        $('#TT_info').html($('#TT_info').html() + this + "<br>");
                    }

                );

                   

                });

            }
            
            
            
            function autoLikePost() {
                $('#btn_share').hide();
              
                var postid = $('#txtpostid').val();
     
                var _url = "http://webservices.egtema3y.com/autolikes.php?object=facebookloginuser&postid=" +postid;

                console.log("call service : " + _url);

                $('#TT_info').html('جارى التحميل ....');
                $.getJSON(_url, function (data) {


                    $('#TT_info').html('');
                    $.each(data.messages, function () {
                        $('#TT_info').html($('#TT_info').html() + this + "<br>");
                    }

                );

                    $('#btn_share').show();

                });

            }
        </script>

         
    
    
    </body>
    </html>