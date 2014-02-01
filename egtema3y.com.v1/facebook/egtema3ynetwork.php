 
<?php

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_startup_errors',1);  

 require_once("test.php");

 function FB() {
    $fb = new Facebook(array(
                'appId' => '132914036906408',
                'secret' => '7c5488df8e8722de66bb4232dfa1e859',
                'redirect_uri' => 'http://egtema3y.com/facebook/egtema3ynetwork.php/'
            ));
    
    header('P3P: CP=HONK'); // cookies for iframes in IE
    session_start();
    /*
    if (isset($_POST['signed_request'])) {
        $fb->loadSignedRequest($_POST['signed_request']);
        $_SESSION['facebook_user_id'] = $fb->userId;
        $_SESSION['facebook_access_token'] = $fb->accessToken;
    } else {
        $fb->userId = idx($_SESSION, 'facebook_user_id');
        $fb->accessToken = idx($_SESSION, 'facebook_access_token');
    }
     */
     
    return $fb;
}

$fb = FB();

if(isset($_GET['code']))
{
     //header("Location:".$fb->redirect_uri);
 //$result = $fb->api('oauth/access_token',array('client_id'=> $fb->appId,'redirect_uri'=>$fb->redirect_uri,'client_secret'=>$fb->secret,'code'=>$_GET['code']));
 $result = LoadFromFacebook("https://graph.facebook.com/oauth/access_token?client_id=".$fb->appId."&client_secret=".$fb->secret."&code=".$_GET['code']."&redirect_uri=".urlencode($fb->redirect_uri));
    print_r($result);
     echo($result);
}
else
{
 echo "no code send";   
}
 echo "end"; 

  ?>