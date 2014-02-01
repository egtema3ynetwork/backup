<?php

ob_start();
require 'facebook.php';
 require 'app_setting.php';
 
 
        $facebook = new Facebook(array(
                    'appId' => APP_ID,
                    'secret' => APP_SECRET,
                    'cookie' => true,));  
        
        
if (isset($_GET['accesstoken'])) {
    try {
        $facebook->setAccessToken($_GET['accesstoken']);
        $ownpages = $facebook->api('/me/accounts');

          $out = array();
            $accesstoken = $facebook->getAccessToken();
         
        $out['accesstoken'] = $accesstoken;
         $out['infos'] = array();
        // $groups = json_encode($groups);
          foreach ($ownpages['data'] as $ownpage) {
              $out['infos'][]  = $ownpage;
          }
        
       
      

        echo json_encode($out);
    } catch (Exception $ex) {
        $out = array();
        $out["error"] = $ex->getMessage();
        echo json_encode($out);
    }
}
else
{
      $out = array();
        $out["error"] ="no access token";
        echo json_encode($out);
}


?>

