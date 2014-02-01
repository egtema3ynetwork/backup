<?php

require 'facebook.php';
// Create our Application instance. Don't forget to change to your AppId and Secret
$facebook = new Facebook(array(
    'appId' => APP_ID,
    'secret' => APP_SECRET,
    'cookie' => true,));

if (isset($_GET['accesstoken'])) {

    $facebook->setAccessToken($_GET['accesstoken']);

    $message = "#شبكة_إجتماعى تغطية مستمرة لمايتداول على شبكات التواصل الاجتماعى";
    $message .= "\n\r";
    $message .= "Egtema3y .com";
    $message .= "\n\r";
    $message .= "العنوان بدون مسافات طبعا";

    $post_url = '/me/feed';
    $msg_body = array(
        'message' => $message,
        //'name' => 'Message Posted from Saaraan.com!',
        //'caption' => "Nice stuff",
        // 'link' => 'https://www.facebook.com/Egtema3yNetWork',
        //'description' => 'Demo php script posting message on this facebook page.',
        //'picture' => 'http://www.saaraan.com/templates/saaraan/images/logo.png'
        'actions' => array(
            array(
                'name' => 'جرب الان شبكة إجتماعى',
                'link' => 'https://www.facebook.com/Egtema3yNetWork'
            )
        )
    );


    $facebook->api($post_url, 'post', $msg_body);
    echo "ok";
}
?>