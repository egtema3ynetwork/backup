<?php

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_startup_errors',1);  

$appid = isset($_GET['appid']) ? $_GET['appid'] : null;
$appsecret = isset($_GET['appsecret']) ? $_GET['appsecret'] : null;
$appname = isset($_GET['appname']) ? $_GET['appname'] : null;
$appaccesstoken = isset($_GET['appaccesstoken']) ? $_GET['appaccesstoken'] : null;
$redirect_uri = isset($_GET['redirect_uri']) ? $_GET['redirect_uri'] : null;


$usercode = isset($_GET['code']) ? $_GET['code'] : null;
$useraccesstoken = isset($_GET['accesstoken']) ? $_GET['accesstoken'] : null;
$userid = isset($_GET['userid']) ? $_GET['userid'] : null;
$user_profile = null;

$facebook = null;

$outdata = array();

function GetUserProfile() {
    global $outdata;
    global $useraccesstoken;
    global $facebook;
    global $user_profile;

    try {
        if ($useraccesstoken != null && $facebook != null) {
            $facebook->setAccessToken($useraccesstoken);
            $outdata[] = "set facebook accesstoken from GetUserProfile";
            $user_profile = $facebook->api('/me', 'GET');
            $outdata[] = "get user Profile";
            return $user_profile;
        }
    } catch (Exception $ex) {
        $outdata[] = "error = " . $ex->getMessage();
        return null;
    }
    return null;
}

function BeginActions() {

    global $outdata;

    global $appid;
    global $appsecret;
    global $appaccesstoken;
    global $usercode;
    global $useraccesstoken;
    global $facebook;


    try {


        if ($appid != null && $appsecret != null) {
            $config = array();
            $config['appId'] = $appid;
            $config['secret'] = $appsecret;
            $config['fileUpload'] = false;
            $facebook = new Facebook($config);
            $outdata[] = "set facebook instanse";

            if ($appaccesstoken == null) {
                $appaccesstoken = GetAppAccessToken();
                $outdata[] = "get app accesstoken";
            }

            if ($usercode != null && $useraccesstoken == null) {
                $useraccesstoken = GetAccessTokenFromCode();
                $outdata[] = "get user accesstoken from code";
            }

            if ($useraccesstoken != null) {
                $useraccesstoken = GetNewAccessToken();
                $outdata[] = "get new user accesstoken";
            }
        }
    } catch (Exception $ex) {
        $outdata[] = "error = " . $ex->getMessage();
    }
}

function GetAccessTokenFromCode() {
    global $outdata;

    global $appid;
    global $appsecret;
    global $usercode;
    global $redirect_uri;

    global $useraccesstoken;

    try {
        /*
          $ret_obj = $facebook->api('/oauth/access_token', 'GET',
          array(
          'client_id' => $appid,
          'client_secret' => $appsecret,
          'redirect_uri' => $redirect_uri,
          'code' => $usercode
          ));
         */

        if ($appid == null || $appsecret == null || $redirect_uri == null || $usercode == null) {
            $outdata[] = "GetAccessTokenFromCode() return null;";
            return null;
        }

        $string = LoadFromFacebook("https://graph.facebook.com/oauth/access_token?client_id=$appid&redirect_uri=$redirect_uri&client_secret=$appsecret&code=$usercode");

        $outdata[] = "string return from GetAccessTokenFromCode() = " . $string;

        $pieces = explode("&expires=", $string);
        $useraccesstoken = str_replace("access_token=", "", $pieces[0]);
        return $useraccesstoken;
    } catch (Exception $ex) {
        $outdata[] = "error = " . $ex->getMessage();
        return null;
    }
    return null;
}

function GetAccessTokenInfo() {
    global $outdata;

    global $appaccesstoken;
    global $useraccesstoken;


    try {


        if ($appaccesstoken == null || $useraccesstoken == null) {
            return null;
        }

        $jsonstring = LoadFromFacebook("https://graph.facebook.com/debug_token?input_token=$useraccesstoken&access_token=$appaccesstoken");
        $decoded = json_decode($jsonstring);
        return $decoded;
    } catch (Exception $ex) {
        $outdata[] = "error = " . $ex->getMessage();
        return null;
    }
    return null;
}

function LoadFromFacebook($url) {
    global $outdata;



    try {


        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: graph.facebook.com'));
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    } catch (Exception $ex) {
        $outdata[] = "error = " . $ex->getMessage();
        return null;
    }
}

function GetAppAccessToken() {

    global $outdata;

    global $appid;
    global $appsecret;

    try {

        if ($appid == null || $appsecret == null) {
            return null;
        }

        $appaccesstoken = LoadFromFacebook("https://graph.facebook.com/oauth/access_token?client_id=$appid&client_secret=$appsecret&grant_type=client_credentials");
        $appaccesstoken = str_replace("access_token=", "", $appaccesstoken);
    } catch (Exception $ex) {
        $outdata[] = "error = " . $ex->getMessage();
        return null;
    }
    return $appaccesstoken;
}

function GetNewAccessToken() {
    global $outdata;

    global $appid;
    global $appsecret;
    global $useraccesstoken;

    try {
        if ($appid == null || $appsecret == null || $useraccesstoken == null) {
            return null;
        }

        $string = LoadFromFacebook("https://graph.facebook.com/oauth/access_token?client_id=$appid&client_secret=$appsecret&grant_type=fb_exchange_token&fb_exchange_token=$useraccesstoken");
        $outdata[] = "GetNewAccessToken string = " . $string;
        $pieces = explode("&expires=", $string);
        $useraccesstoken = str_replace("access_token=", "", $pieces[0]);
    } catch (Exception $ex) {
        $outdata[] = "error = " . $ex->getMessage();
        return null;
    }

    return $useraccesstoken;
}

?>