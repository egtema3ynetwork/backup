<?php

ob_start();
 require 'shared/facebook.php';
  require "shared/setting.php";
  require "shared/parameters.php";

    
if (isset($_GET['accesstoken'])) {
    try {
        $facebook->setAccessToken($_GET['accesstoken']);
        $groups = $facebook->api('/me/groups');

          $out = array();
            $accesstoken = $facebook->getAccessToken();
         
        $out['accesstoken'] = $accesstoken;
          $out['infos'] = array();
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

