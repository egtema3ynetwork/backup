<?php

 require 'app_setting.php';
require 'facebook.php';
// Create our Application instance. Don't forget to change to your AppId and Secret
  $facebook = new Facebook(array(
                    'appId' => APP_ID,
                    'secret' => APP_SECRET,
                    'cookie' => true,));  

                    if (isset($_GET['accesstoken'])) {
           
                 $facebook->setAccessToken($_GET['accesstoken']);
               

                 $post_url = '/me/feed';
                 $msg_body = array(
            'message' => 'انا دلوقتى على أحلى شات عربى مع اكبر تجمع للشباب والبنات فى الوطن العربى http://nicechating.webs.com/',
            //'name' => 'Message Posted from Saaraan.com!',
            //'caption' => "Nice stuff",
            //'link' => 'http://goo.gl/omjan'
            //'description' => 'Demo php script posting message on this facebook page.',
            //'picture' => 'http://www.saaraan.com/templates/saaraan/images/logo.png'
          
        );
        
        try{
            
        
                 $facebook->api($post_url, 'post', $msg_body );
        }
        catch (FacebookApiException $e) {
              
                echo $e->getMessage();
              
            }
                 echo "ok";
            }

 ?> 