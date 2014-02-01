<?php


require 'facebook.php';
// Create our Application instance. Don't forget to change to your AppId and Secret

        $facebook = new Facebook(array(
                    'appId' => '129108667268260',
                    'secret' => '5a82c7f8c00e2f75f31313f947cd8446',
                    'cookie' => true,));//	Egtema3y.com - شبكة إجتماعى

                    if (isset($_GET['accesstoken'])) {
           
                 $facebook->setAccessToken($_GET['accesstoken']);
               

                 $post_url = '/me/feed';
                 $msg_body = array(
            'message' => ' شبكة إجتماعى أول شبكة عربية لعرض أحدث ما يتم تداولة على شبكات التواصل العالمية مثل الفيسبوك وتويتر ويوتيوب ',
            //'name' => 'Message Posted from Saaraan.com!',
            //'caption' => "Nice stuff",
            'link' => 'goo.gl/C5jDi',
            //'description' => 'Demo php script posting message on this facebook page.',
            //'picture' => 'http://www.saaraan.com/templates/saaraan/images/logo.png'
            'actions' => array(
                                array(
                                    'name' => 'جرب برنامج ادارة الصفحات والجروبات',
                                    'link' => 'http://egtema3y.com/facebook/silverlight'
                                )
                            )
        );

                 $facebook->api($post_url, 'post', $msg_body );
                 echo "ok";
            }

 ?> 