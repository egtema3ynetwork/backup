<?php

ob_start();
set_time_limit(0);

require 'shared/facebook.php';
require "shared/setting.php";
require "shared/parameters.php";
require "shared/functions.php";

$outdata->time = time();

if (isset($_GET['accesstoken'])) {


    $facebook->setAccessToken($_GET['accesstoken']);
    $accesstoken = $_GET['accesstoken'];



    $message = isset($_GET['message']) ? $_GET['message'] : '';
    if ($message !== "") {
        $message = base64_decode($message);
    }
    
    $link = isset($_GET['link']) ? $_GET['link'] : '';
     if ($link !== "") {
        $link = base64_decode($link);
    }
    
    $name = isset($_GET['name']) ? $_GET['name'] : '';
    $caption = isset($_GET['caption']) ? $_GET['caption'] : '';
    $description = isset($_GET['description']) ? $_GET['description'] : '';
    $picture = isset($_GET['picture']) ? $_GET['picture'] : '';

    if ($message == "" && $name == "" && $caption == "" && $link == "" && $description == "" && $picture == "") {
        $errors[] = "no message write ...";
        $outdata->errors = $errors;
        $outdata->messages[] = "لا يوجد رساله للارسالها";
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($outdata);
        die();
    }



    $msg_body = array(
        'message' => $message,
        'name' => $name,
        'caption' => $caption,
        'link' => $link,
        'description' => $description,
        'picture' => $picture//,
        //'actions' => json_encode(array('name' => 'فيسبوكى ', 'link' => 'http://178.63.108.123/sites/facebooky'))
    );


    $type = isset($_GET['type']) ? $_GET['type'] : 'me';
    
    
    if ($type == "me") {


        try {
            $post_url = '/me/feed';
            $facebook->api($post_url, 'post', $msg_body);
            $outdata->messages[] = "تم الارسال" . " <> " . "send succeed ";
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($outdata);
            die();
        } catch (Exception $e) {
            $error = $e->getMessage();
            $error = BlockSQL($error);
            $errors[] = $error;
            $outdata->errors = $errors;
            $outdata->messages[] = "لم يتم التنفيذ لحدوث هذا الخطأ ==>" . $error;
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($outdata);
        }
    }

    if ($type == "groups") {

        $msg_body = array(
            'message' => $message,
            'name' => $name,
            'caption' => $caption,
            'link' => $link,
            'description' => $description,
            'picture' => $picture//,
                //  'actions' => json_encode(array('name' => 'فيسبوكى ','link' => 'http://178.63.108.123/sites/myfacebook'))
        );


        $groups = $facebook->api('/me/groups');

        $i = 0;

        foreach ($groups['data'] as $group) {
            $feedid = $group['id'];

            $i+=1;

            $batchPost[] = array(
                'method' => 'POST',
                'relative_url' => "/$feedid/feed",
                'body' => http_build_query($msg_body)
            );


            if ($i == 30) {
                try {
                    $multiPostResponse = $facebook->api('?batch=' . urlencode(json_encode($batchPost)), 'POST');
                    $outdata->messages[] = "------------------------------";
                    $goodid = 0;
                    $badid = 0;
                    if (is_array($multiPostResponse)) {
                        foreach ($multiPostResponse as $singleResponse) {
                            $temp = json_decode($singleResponse['body'], true);
                            if (isset($temp['id'])) {
                                $splitId = explode("_", $temp['id']);
                                if (!empty($splitId[1])) {
                                    // $outdata->messages[] = "تم الارسال الى ".$splitId[0];
                                    $goodid +=1;
                                }
                            } elseif (isset($temp['error'])) {
                                // $outdata->messages[] = (print_r($temp['error'], true));
                                $badid +=1;
                            }
                        }
                    }


                    $outdata->messages[] = "تم الارسال الى " . $goodid . " جروب وأخطأ الارسال الى " . $badid . " جروب من أصل 30 جروب";
                } catch (Exception $e) {
                    $error = $e->getMessage();
                    $error = BlockSQL($error);
                    $errors[] = $error;
                    $outdata->messages[] = "لم يتم التنفيذ لحدوث هذا الخطأ ==>" . $error;
                }
                $i = 0;
                unset($batchPost);
            }
        }

        if (isset($batchPost) && count($batchPost) > 0) {
            $goodid = 0;
            $badid = 0;

            try {
                $multiPostResponse = $facebook->api('?batch=' . urlencode(json_encode($batchPost)), 'POST');
                $outdata->messages[] = "------------------------------";

                if (is_array($multiPostResponse)) {
                    foreach ($multiPostResponse as $singleResponse) {
                        $temp = json_decode($singleResponse['body'], true);
                        if (isset($temp['id'])) {
                            $splitId = explode("_", $temp['id']);
                            if (!empty($splitId[1])) {
                                // $outdata->messages[] = "تم الارسال الى ".$splitId[0];
                                $goodid +=1;
                            }
                        } elseif (isset($temp['error'])) {
                            // $outdata->messages[] = (print_r($temp['error'], true));
                            $badid +=1;
                        }
                    }
                }


                $outdata->messages[] = "تم الارسال الى " . $goodid . " جروب وأخطأ الارسال الى " . $badid . " جروب من أصل  " . count($batchPost) . " جروب ";
            } catch (Exception $e) {
                $error = $e->getMessage();
                $error = BlockSQL($error);
                $errors[] = $error;
                $outdata->messages[] = "لم يتم التنفيذ لحدوث هذا الخطأ ==>" . $error;
            }
        }



        header('Content-type: application/json; charset=utf-8');
        echo json_encode($outdata);
        die();
    }

    if ($type == "accounts") {
        $pages = $facebook->api('/me/accounts');


        foreach ($pages['data'] as $page) {
            $feedid = $page['id'];
            $facebook->setAccessToken($page['access_token']);

            try {
                $post_url = "/$feedid/feed";
                $facebook->api($post_url, 'post', $msg_body);
                $outdata->messages[] = "تم الارسال بنجاح الى صفحة " . $page['name'];
            } catch (Exception $e) {
                $error = $e->getMessage();
                $error = BlockSQL($error);
                $errors[] = $error;
                $outdata->errors = $errors;
                $outdata->messages[] = "لم يتم التنفيذ لحدوث هذا الخطأ ==>" . $error;
            }
        }


        header('Content-type: application/json; charset=utf-8');
        echo json_encode($outdata);
        die();
    }
} else {
    $errors[] = "no accesstoken send ...";
    $outdata->errors = $errors;
    $outdata->messages[] = "لم يتم التنفيذ سجل دخول اولا ";
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($outdata);
    die();
}
?> 