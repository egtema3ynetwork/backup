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

       

           <br>  <br>  <br>
         <script>
             function btn_share_click() {
                 $('#btn_share').hide();
                 message = "";
                 var lines = $('#txtmessage').val().split('\n');
                 for (var i = 0; i < lines.length; i++) {
                     message += lines[i] + " \n\r ";
                 }

                 $.base64.utf8encode = true;
                 message = $.base64.encode(message);

                 var link = $('#txtlink').val();
                 var _url = "http://webservices.egtema3y.com/postmembersfeed.php?object=facebooky&action=post&message=" + message + "&link=" + link;

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

<center>
    <div class="row-fluid ">

        
        <br>
        <div id="TT_info" class="  label label-success" ></div>
        <br> <br> <br>






    <div class="span8 offset2" >
        
        <div class="row-fluid">  <div  class="span2 " > الرسالة</div>        <div><textarea style="height:125px;" class="span8 " id="txtmessage"></textarea></div>            </div>
      
       <div class="row-fluid">  
            <div class="span2 "  > مسار اللينك <div class="label label-warning small"> اختيارى</div>  </div>  
       
     <div  > 
<input style="height:25px;" class="shadow span8" type="text" id="txtlink" value="">
            <form method="post" enctype="multipart/form-data" action="upload.php" class="span8 offset2">
 <label class="btn btn-primary small"  for="file">اضغط هنا لاختيار صورة من جهازك ثم اضغط على استخدام الصورة</label>
 <input class="label label-success" type="file" name="file" id="file" />
 <br /><br />
 <input type="submit" class="span6 offset3 btn btn-primary small" name="submit" value="استخدام الصورة " />
 </form>


     </div>  
              </div>
       <br /><br /><br />
         <div class="row-fluid"> <input id="btn_share" onclick="btn_share_click();" class="btn btn-inverse shadow span6 offset1" type="submit" value=" ارسل الى كل المشتركيين">  </div>
        
         <div class="row-fluid" style="visibility: collapse;">   <div class="span2 "  > كود التفعيل </div>  <div><input style="height:25px;" class="span8 shadow" type="password" name="password" ></div>               </div>

        

          <div class="row-fluid" style="visibility: collapse;">  <div class="span2 "  > مسار الصورة </div>  <div><input style="height:25px;" class="span8 shadow" type="text" name="picture" ></div>            </div>
         <div class="row-fluid"  style="visibility: collapse;" >  <div class="span2 " > اسم اللينك </div>    <div><input style="height:25px;" class="span8 shadow" type="text" name="name"></div>              </div>
       <div class="row-fluid" style="visibility: collapse;" >   <div class="span2 "  > عنوان فرعى </div>   <div><input style="height:25px;" class="span8 shadow" type="text" name="caption"></div>           </div>
        <div class="row-fluid" style="visibility: collapse;" >  <div class="span2 "  > وصف تفصيلى </div>    <div><input style="height:25px;" class="span8 shadow" type="text" name="description"></div>       </div>
    </div>

   

        
</div>  
   

 <div class="span4"><?php include('profile.tmp.html');?></div>
</center>
         

    </body>
</html>
