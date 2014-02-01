<?php

 require 'app_setting.php';
 require 'facebook.php';

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


   $facebook = new Facebook(array(
                    'appId' => APP_ID,
                    'secret' => APP_SECRET,
                    'cookie' => true,));  

                      $allusers = mysql_query("select id,accesstoken,userid from `" . DB_NAME . "`.`".TABLE_NAME."` where `appid` ='".APP_ID."'  limit 100", $con);
                 $num_rows = mysql_num_rows($allusers);
                 $sendcount = 0;
             
                if ($num_rows > 0) {

                 $i = 0;
                    while ($r = mysql_fetch_assoc($allusers)) {
                          $id = $r["id"];
                        $feedid = $r["userid"];
                        $accesstoken =  $r["accesstoken"];

                       

                        $facebook->setAccessToken($accesstoken);
                       
                        $facebook-> setExtendedAccessToken();
                        $accesstoken2 = $facebook->getAccessToken();

                          if($accesstoken2 != $accesstoken)
                          {
                              $i += 1;
                              echo $i." - ".$id." - ".$accesstoken2."<br>";
                              echo "old - ".$accesstoken."<br>";
                          }
                    }
                }
?>

