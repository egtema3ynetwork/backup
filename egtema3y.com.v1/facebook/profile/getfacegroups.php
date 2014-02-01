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
        $groups = $facebook->api('/me/groups');

          $out = array();
            $accesstoken = $facebook->getAccessToken();
         
        $out['accesstoken'] = $accesstoken;
        // $groups = json_encode($groups);
          foreach ($groups['data'] as $group) {
              $group['imageurl'] =  "https://graph.facebook.com/".$group['id']."/picture?type=square";
              $out['infos'][]  = $group;
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

