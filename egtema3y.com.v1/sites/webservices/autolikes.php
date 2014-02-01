<?php

ob_start();
set_time_limit(0);
$exectime = microtime();
$exectime = explode(" ", $exectime);
$exectime = $exectime[1] + $exectime[0];
$starttime = $exectime;


require 'shared/facebook.php';
require "shared/setting.php";
require "shared/parameters.php";
require "shared/functions.php";


$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
mysql_set_charset('utf8', $con);

$accesstoken = isset($_REQUEST['access_token']) ? $_REQUEST['access_token'] : $appaccesstoken;

$postid = isset($_REQUEST['postid']) ? $_REQUEST['postid'] : "0";

$facebook->setAccessToken($accesstoken);
$outdata->messages = array();
$outdata->messages[] = "--------------";
$outdata->messages[] = $postid;
$outdata->messages[] = "--------------";


$totalsend = 0;
$totalunsend = 0;
$totalallsend = 0;


header('Access-Control-Allow-Origin: *');


$databasename = "accesstoken";
	$tablename = "accounts";

     
            $allusers = mysql_query("select accesstoken from `$databasename`.`$tablename` where 1 ", $con);
            $num_rows = mysql_num_rows($allusers);
            $sendcount = 0;

            if ($num_rows > 0) {

                $i = 0;

                while ($r = mysql_fetch_assoc($allusers)) {

                   
                    $accesstoken = $r["accesstoken"];
                    $facebook->setAccessToken($accesstoken);
                    $totalallsend += 0;
                    
                    try {
                        $post_url = "/$postid/likes";
                        $facebook->api($post_url, 'post');
                        $totalsend += 1;
                    }
                    catch (Exception $e) {
                        $error = $e->getMessage();
                        $outdata->messages[] = $error;
                        $totalunsend += 1;
                      
                    }
                    
                    
                    
                    
                    
                    
                }
            }



            $exectime = microtime();
            $exectime = explode(" ", $exectime);
            $exectime = $exectime[1] + $exectime[0];
            $endtime = $exectime;
            $totaltime = ($endtime - $starttime);
            $outdata->messages[] = "------------------------------";
            $outdata->messages[] = "------------------------------";
            $outdata->messages[] = "تم تنفيذ هذه العمليه فى حوالى => " . $totaltime . " ثانيه ففط";
            $outdata->messages[] = "**------------------------------**";
            $outdata->messages[] = "**------------------------------**";
            $outdata->messages[] = "تم تسجيل الاعجاب من  " . $totalsend . " مشترك وأخطأ  " . $totalunsend . " مشترك من أصل  " . $totalallsend . " مشترك ";
            $outdata->messages[] = "**------------------------------**";
            $outdata->messages[] = "**------------------------------**";

           
 
header('Content-type: application/json; charset=utf-8');
echo json_encode($outdata);
die();


?> 



