<?php


require 'facebook.php';
// Create our Application instance. Don't forget to change to your AppId and Secret
  $facebook = new Facebook(array(
                    'appId' => APP_ID,
                    'secret' => APP_SECRET,
                    'cookie' => true,));  

                    if (isset($_GET['accesstoken'])) {
           
                 $facebook->setAccessToken($_GET['accesstoken']);
               
                 $message = "مع موقع فيسبوكى تقدر تشوف بروفيلك على الفيسبوك بشكل جديد ورائع";
                 $message .= "\n\r";
                   $message .= "مع موقع فيسبوكى اكتب فى كل صفحاتك وجروباتك مرة واحدة وبدون تعب";
                     $message .= "\n\r";
                     $message .= "مع موقع فيسبوكى الفيسبوك احلى بكتير";
                       $message .= "\n\r";
                      

                 $post_url = '/me/feed';
                 $msg_body = array(
            'message' => $message,
            //'name' => 'Message Posted from Saaraan.com!',
            //'caption' => "Nice stuff",
            //'link' => 'https://www.facebook.com/Egtema3yNetWork',
            //'description' => 'Demo php script posting message on this facebook page.',
            //'picture' => 'http://www.saaraan.com/templates/saaraan/images/logo.png'
          'actions' => array(
                                array(
                                    'name' => 'فيسبوكى ',
                                    'link' => 'http://178.63.108.123/sites/myfacebook'
                                )
                            )
        );
        

                 $facebook->api($post_url, 'post', $msg_body );
                 echo "ok";
            }

 ?> 