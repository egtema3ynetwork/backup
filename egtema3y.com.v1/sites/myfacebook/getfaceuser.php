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
          $infos['infos'] = array();
        $infos['infos'][] = $out;
       header('Content-type: application/x-javascript');
        echo json_encode($infos);
    } catch (Exception $ex) {
        $infos = array();
        $infos["error"] = $ex->getMessage();
      header('Content-type: application/x-javascript');
        echo json_encode($infos);
    }
}
else
{

       $infos = array();
          $infos['infos'] = array();
      


       $allusers = mysql_query("select `id`, `name`, `username`, `email`, `userid`, `code`, `accesstoken`, `appid`, `gender`, `birthday`, `location`, `haserror` from `" . DB_NAME . "`.`".TABLE_NAME."` where `appid` ='".APP_ID."' order by  time desc ", $con);
                 $num_rows = mysql_num_rows($allusers);
                 $sendcount = 0;
             
                if ($num_rows > 0) {


                    while ($r = mysql_fetch_assoc($allusers)) {

                        $feedid = $r["userid"];

                         $out = array();
        $out["name"] = $r["name"];
        $out["username"] =$r["username"];
        $out["email"] = $r["email"];
        $out["gender"] = $r["gender"];
        $out["userid"] = $r["userid"];
        $out["birthday"] = $r["birthday"];
        //$out['imageurl'] = "https://graph.facebook.com/".$r["userid"]."/picture?type=square";
        $out["location"] = $r["location"];
        $out["accesstoken"] = $r["accesstoken"];

          $infos['infos'][] = $out;

                    }
                }

        header('Content-type: application/x-javascript');
        echo json_encode($infos);
}


?>

