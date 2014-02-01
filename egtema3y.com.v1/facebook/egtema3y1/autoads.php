<?php

ob_start();


set_time_limit(0);
$exectime = microtime();
$exectime = explode(" ", $exectime);
$exectime = $exectime[1] + $exectime[0];
$starttime = $exectime;



require 'app_setting.php';
require 'facebook.php';

function LoadPhp($url) {
    try {

        global $responseobject;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: graph.facebook.com'));
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    } catch (Exception $ex) {
        $responseobject->errors = $ex;
        return null;
    }
}

// ---------------------------------------------------------------->
function _nullify($object, $key) {
    try {
        if ($object == NULL)
            return NULL;
        if ($key == NULL)
            return NULL;

        if (property_exists($object, $key))
            return empty($object->$key) ? NULL : $object->$key;
        else
            return NULL;
    } catch (Exception $ex) {
        return NULL;
    }
}

// ---------------------------------------------------------------->
function BlockSQL($str) {
    if ($str == null) {
        return null;
    }

    $str = mysql_real_escape_string($str); //Escapes special characters in a string for use in an SQL statement
    $str = htmlspecialchars($str); // will convert special chars like < to &lt;
    $str = strip_tags($str); //  strip all tags out.
    return $str;
}

// ---------------------------------------------------------------->


$facebook = new Facebook(array(
    'appId' => APP_ID,
    'secret' => APP_SECRET,
    'cookie' => true,));

$accesstoken = isset($_REQUEST['access_token']) ? $_REQUEST['access_token'] : APPACCESSTOKEN;
$facebook->setAccessToken($accesstoken);


$outdata->messages[] = "--------------";

$totalsend = 0;
$totalunsend = 0;
$totalallsend = 0;

$message = "#شبكة_إجتماعى تغطية مستمرة لمايتداول على شبكات التواصل الاجتماعى";
$message .= "\n\r";
$message .= "Egtema3y .com";
$message .= "\n\r";
$message .= "العنوان بدون مسافات طبعا";

$link = ""; //"https://www.facebook.com/Egtema3yNetWork";


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

if ($message == "" && $link == "") {

} else {

    $allusers = mysql_query("select `userid` from `" . DB_NAME . "`.`" . TABLE_NAME . "` where `appid` ='" . APP_ID . "' ", $con);
    $num_rows = mysql_num_rows($allusers);

    $sendcount = 0;

    if ($num_rows > 0) {

        $i = 0;

        while ($r = mysql_fetch_assoc($allusers)) {

            $feedid = $r["userid"];


            $i +=1;
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

                    $totalsend += $goodid;
                    $totalunsend += $badid;
                    $totalallsend += 30;

                    $outdata->messages[] = "Send To " . $goodid . " amd Error To " . $badid . " From 30 users";
                } catch (Exception $e) {
                    $error = $e->getMessage();
                    $error = BlockSQL($error);
                    $errors[] = $error;
                    $outdata->messages[] = "Error ==>" . $error;
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

                $totalsend += $goodid;
                $totalunsend += $badid;
                $totalallsend += count($batchPost);

                $outdata->messages[] = "Send To " . $goodid . " and Error To  " . $badid . " From " . count($batchPost) . " Users ";
            } catch (Exception $e) {
                $error = $e->getMessage();
                $error = BlockSQL($error);
                $errors[] = $error;
                $outdata->messages[] = "Error =>" . $error;
            }
        }
    }
}


header('Content-type: application/json; charset=utf-8');
echo json_encode($outdata);
die();

function PostFeed($userid, $accesstoken, $message, $link) {
    global $con;

    try {


        $facebook = new Facebook(array(
            'appId' => APP_ID,
            'secret' => APP_SECRET,
            'cookie' => true,));

        $facebook->setAccessToken($accesstoken);

        $post_url = "/$userid/feed";


        $name = "";
        $caption = "";
        $description = "";
        $picture = "";

        if ($message == "" && $name == "" && $caption == "" && $link == "" && $description == "" && $picture == "") {
            return 0;
        }

        $msg_body = array(
            'message' => $message,
            'name' => $name,
            'caption' => $caption,
            'link' => $link,
            'description' => $description,
            'picture' => $picture,
            'actions' => array(
                array(
                    'name' => 'شاهد أحدث الاخبار',
                    'link' => 'https://www.facebook.com/Egtema3yNetWork'
                )
            )
        );



        $facebook->api($post_url, 'post', $msg_body);
        return 1;
    } catch (Exception $e) {
        $error = $e->getMessage();
        $error = BlockSQL($error);
        mysql_query("UPDATE `" . DB_NAME . "`.`" . TABLE_NAME . "` SET  `error` = '$error' WHERE `userid` = '$userid' ; ", $con) or die(mysql_error());
        return $e->getMessage();
    }
}
?>
