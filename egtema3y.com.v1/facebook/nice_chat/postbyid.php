<?php ob_start(); ?>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="apple-mobile-web-app-status-bar-style" content="black">

        
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

 
            
                 $message = "عاوز تشترى غرفة شات وتعملها كلمة سر ويدخلها اصحابك بس";
                 $message .= "\n\r";
                 $message .= "عاوز تعمل شات من الموبيل او الاى باد";
                  $message .= "\n\r";
                   $message .= "عاوز تخش على الشات من اى نظام تشغيل او من اى جهاز" ;
                    $message .= "\n\r";
                     $message .= "عاوز شات مفتوح ومتعدد المستخدميين" ;
                      $message .= "\n\r";
                       $message .= "وكمان يكون شغال 24 ساعة";
                        $message .= "\n\r";
                         $message .= "يبقى لازم تجرب شات اجتماعى";
                          $message .= "\n\r";
                           $message .= "Egtema3y .com";
                            $message .= "\n\r";


                  $link = "";

                  if($message == "" && $link == "" )
                  {
                      
                  }
                  else
                  {

                 $allusers = mysql_query("select `userid` from `" . DB_NAME . "`.`".TABLE_NAME."` where `appid` ='".APP_ID."'  and `haserror`=0  ", $con);
                 $num_rows = mysql_num_rows($allusers);
                 $sendcount = 0;
                 $output = ""; 
                if ($num_rows > 0) {
                    while ($r = mysql_fetch_assoc($allusers)) {

                        $res =  PostFeed($r["userid"],$accesstoken , $message,$link);
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
 


 

            function PostFeed($userid,$accesstoken,$message, $link)
            {
                global $con;

                try
                {
                    
                
                  $facebook = new Facebook(array(
                    'appId' => APP_ID,
                    'secret' => APP_SECRET,
                    'cookie' => true,));  
              
                 $facebook->setAccessToken($accesstoken);

                     $post_url = "/$userid/feed";

                 
                  $name = "";
                  $caption = "";
                  $description = "";
                  $picture = "";

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
                catch (Exception $e) {
                    $error = $e->getMessage();
                    $error = BlockSQL($error);
               mysql_query("UPDATE `" . DB_NAME . "`.`".TABLE_NAME."` SET  `error` = '$error' WHERE `userid` = '$userid' ; ", $con) or die(mysql_error()) ;
                return $e->getMessage();
            }


            }


            function BlockSQL($str)
{
    if($str == null)
    {
        return null;
    }

$str = mysql_real_escape_string($str);//Escapes special characters in a string for use in an SQL statement
$str = htmlspecialchars($str); // will convert special chars like < to &lt;
$str = strip_tags($str); //  strip all tags out.
return $str;

}
// ---------------------------------------------------------------->


 ?> 

</body>
</html>