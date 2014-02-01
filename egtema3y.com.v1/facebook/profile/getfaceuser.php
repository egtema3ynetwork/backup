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
        $me = $facebook->api('/me');

        $name = isset($me['name']) ? $me['name'] : "";
        $username = isset($me['username']) ? $me['username'] : "";
        $email = isset($me['email']) ? $me['email'] : "";
        $gender = isset($me['gender']) ? $me['gender'] : "";
        $userid = isset($me['id']) ? $me['id'] : "";
        $birthday = isset($me['birthday']) ? $me['birthday'] : "";
        $location = "";
        $lo = isset($me['location']) ? $me['location'] : null;

        if ($lo) {
            $location = isset($lo['name']) ? $lo['name'] : "";
        }

        $accesstoken = $facebook->getAccessToken();

        $out = array();
        $out["name"] = $name;
        $out["username"] = $username;
        $out["email"] = $email;
        $out["gender"] = $gender;
        $out["userid"] = $userid;
        $out["birthday"] = $birthday;
        $out['imageurl'] = "https://graph.facebook.com/".$userid."/picture?type=square";
        $out["location"] = $location;
        $out["accesstoken"] = $accesstoken;
        
        $infos = array();
        $infos['infos'][] = $out;

        echo json_encode($infos);
    } catch (Exception $ex) {
        $infos = array();
        $infos["error"] = $ex->getMessage();
        echo json_encode($infos);
    }
}
else
{
      $out = array();
        $out["error"] ="no access token";
        echo json_encode($out);
}


?>

