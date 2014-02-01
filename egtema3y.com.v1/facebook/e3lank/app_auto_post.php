<?php ob_start(); ?>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link href="http://egtema3y.com/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://egtema3y.com/css/bootstrap-responsive.min.css" rel="stylesheet">

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="http://egtema3y.com/js/bootstrap.min.js"></script>


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
        
    </style>
</head>
     <body >



<?php

//set_time_limit(0);
$exectime = microtime();
$exectime = explode(" ", $exectime);
$exectime = $exectime[1] + $exectime[0];
$starttime = $exectime;



 require 'app_setting.php';
 require 'facebook.php';

 $accesstoken = isset($_REQUEST['access_token']) ? $_REQUEST['access_token'] : APPACCESSTOKEN;
 $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : "";
 $action = (isset($_REQUEST['action']) ) ? "post" : "";
 $action = (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST" ) ? "post" :  $action;
  $filepath = isset($_REQUEST['filepath']) ? $_REQUEST['filepath'] : "";

  
 if($action == "post" && $password == "1230123")
 {

                  $message = isset($_REQUEST['message']) ? $_REQUEST['message'] : "";
                  $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : "";
                  $caption = isset($_REQUEST['caption']) ? $_REQUEST['caption'] : "";
                  $link = isset($_REQUEST['link']) ? $_REQUEST['link'] : "";
                  $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : "";
                  $picture = isset($_REQUEST['picture']) ? $_REQUEST['picture'] : "";

                  if($message == "" && $name == "" && $caption == "" && $link == "" && $description == "" && $picture == "")
                  {
                      
                  }
                  else
                  {

                 $allusers = mysql_query("select `userid` from `" . DB_NAME . "`.`".TABLE_NAME."` where `appid` ='".APP_ID."' ", $con);
                 $num_rows = mysql_num_rows($allusers);
                 $sendcount = 0;
                 $output = ""; 
                if ($num_rows > 0) {
                    while ($r = mysql_fetch_assoc($allusers)) {

                        $res =  PostFeed($r["userid"],$accesstoken);
                         if( $res == 1 )
       {
          $sendcount += 1 ;
       }
       else
       {
           $output .= "<br>".$res."<br>";
       }


                    }



                      $exectime = microtime();
                $exectime = explode(" ", $exectime);
                $exectime = $exectime[1] + $exectime[0];
                $endtime = $exectime;
                $totaltime = ($endtime - $starttime);
                $output .=   "<hr> we takes {$totaltime} seconds only to excute this script for you <br>";


                    $output .= "<hr>"." تم ارسال بنجاح الى ".$sendcount." مشترك من اصل ".$num_rows."<hr>";
                    echo $output;
                }

      
 }
 }


 

            function PostFeed($userid,$accesstoken)
            {
                try
                {
                    
                
                  $facebook = new Facebook(array(
                    'appId' => APP_ID,
                    'secret' => APP_SECRET,
                    'cookie' => true,));  
              
                 $facebook->setAccessToken($accesstoken);

                     $post_url = "/$userid/feed";

                  $message = isset($_REQUEST['message']) ? $_REQUEST['message'] : "";
                  $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : "";
                  $caption = isset($_REQUEST['caption']) ? $_REQUEST['caption'] : "";
                  $link = isset($_REQUEST['link']) ? $_REQUEST['link'] : "";
                  $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : "";
                  $picture = isset($_REQUEST['picture']) ? $_REQUEST['picture'] : "";

                  if($message == "" && $name == "" && $caption == "" && $link == "" && $description == "" && $picture == "")
                  {
                      return 0;
                  }

                   $msg_body = array(
            'message' => $message,
            'name' => $name,
            'caption' =>  $caption,
            'link' => $link,
            'description' => $description,
            'picture' => $picture
           
        );


                
                 $facebook->api($post_url, 'post', $msg_body );
                  return 1;

                }
                catch (FacebookApiException $e) {
              
                return $e->getMessage();
            }


            }

 ?> 



   

        <br><br><hr>
         <script>
             function btn_share_click() {
                 $('#btn_share').hide();
             }
         </script>

    <center>

  <form method="post" enctype="multipart/form-data" action="upload.php">
 <label class="label label-success" for="file">اختار صورة من جهازك ثم اضغط على استخدام الصورة</label>
 <input class="label label-success" type="file" name="file" id="file" />
 <br />
 <input type="submit" class="btn btn-primary" name="submit" value="استخدام الصورة " />
 </form>


</form>


<form method="post"  action="app_auto_post.php">
    <div class="row-fluid" >
        
        <div class="row-fluid">  <div  class="span2 " > الرسالة</div>        <div><textarea style="height:125px;" class="span8 " name="message"></textarea></div>            </div>
      
       <div class="row-fluid">   <div class="span2 "  > مسار اللينك </div>  <div><input style="height:25px;" class="span8 shadow" type="text" name="link" value="<?php echo  $filepath ; ?>"></div>               </div>
        <div class="row-fluid">   <div class="span2 "  > كود التفعيل </div>  <div><input style="height:25px;" class="span8 shadow" type="password" name="password" ></div>               </div>

         <div class="row-fluid"> <input id="btn_share" onclick="btn_share_click();" class="btn btn-primary shadow span6 offset3" type="submit" value=" ارسل الى كل المشتركيين">  </div>

          <div class="row-fluid" style="visibility: collapse;">  <div class="span2 "  > مسار الصورة </div>  <div><input style="height:25px;" class="span8 shadow" type="text" name="picture" ></div>            </div>
         <div class="row-fluid"  style="visibility: collapse;" >  <div class="span2 " > اسم اللينك </div>    <div><input style="height:25px;" class="span8 shadow" type="text" name="name"></div>              </div>
       <div class="row-fluid" style="visibility: collapse;" >   <div class="span2 "  > عنوان فرعى </div>   <div><input style="height:25px;" class="span8 shadow" type="text" name="caption"></div>           </div>
        <div class="row-fluid" style="visibility: collapse;" >  <div class="span2 "  > وصف تفصيلى </div>    <div><input style="height:25px;" class="span8 shadow" type="text" name="description"></div>       </div>
    </div>

   
</form>
        
</center>

        <hr>

    </body>
</html>
