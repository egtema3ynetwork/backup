<?php ob_start(); 
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


function _nullify($object, $key) {
try
{
    if($object == NULL)return NULL;
     if($key == NULL)return NULL;

    if (property_exists($object, $key))
        return empty($object->$key) ? NULL : $object->$key;
    else
        return NULL;
		}
		catch(Exception $ex)
		{
		return NULL;
		}
}
// ---------------------------------------------------------------->

   $facebook = new Facebook(array(
                    'appId' => APP_ID,
                    'secret' => APP_SECRET,
                    'cookie' => true,));  

                     
 $accesstoken = isset($_REQUEST['access_token']) ? $_REQUEST['access_token'] : APPACCESSTOKEN;
 $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : "";
 $action = (isset($_REQUEST['action']) ) ? "post" : "";
 $action = (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST" ) ? "post" :  $action;
 $filepath = isset($_REQUEST['filepath']) ? $_REQUEST['filepath'] : "";

 $facebook->setAccessToken($accesstoken);
  
  $outdata->messages[] = "--------------";

  $totalsend = 0;
  $totalunsend = 0;
  $totalallsend = 0;

  try   
  {
       if($action == "post")
 {

                  $message = isset($_REQUEST['message']) ? $_REQUEST['message'] : "";
                  $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : "";
                  $caption = isset($_REQUEST['caption']) ? $_REQUEST['caption'] : "";
                  $link = isset($_REQUEST['link']) ? $_REQUEST['link'] : "";
                  $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : "";
                  $picture = isset($_REQUEST['picture']) ? $_REQUEST['picture'] : "";

                  $message_enc = $message;
                   if($message !== "")
                 {
                     $message = base64_decode($message);
                 }

                  if($message == "" && $name == "" && $caption == "" && $link == "" && $description == "" && $picture == "")
                  {
                      $outdata->messages[] =  "يجب كتابه رساله أولا";
                  }
                  else
                  {
                          $msg_body = array(
                                   'message' => $message,
                                   'name' =>$name ,
                                   'caption' => $caption,
                                   'link' => $link,
                                   'description' => $description,
                                   'picture' =>$picture,
                                  'actions' => json_encode(array('name' => 'نشر الكترونى ','link' => 'http://178.63.108.123/sites/myfacebook'))
                      
  
                                   );


                 $allusers = mysql_query("select `userid`,accesstoken from `" . DB_NAME . "`.`".TABLE_NAME."` where `appid` ='".APP_ID."'  ", $con);
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

                        

                                                      if($i == 30) {
            try {
               $multiPostResponse = $facebook->api('?batch='.urlencode(json_encode($batchPost)), 'POST');
                  $outdata->messages[] = "------------------------------";
                  $goodid = 0;
                  $badid = 0;
                if (is_array($multiPostResponse)) {
							foreach ($multiPostResponse as $singleResponse) {
								$temp = json_decode($singleResponse['body'], true);
								if (isset($temp['id'])) {
									$splitId = explode("_", $temp['id']);
									if (!empty($splitId[1])) 
                                    {
                                       // $outdata->messages[] = "تم الارسال الى ".$splitId[0];
                                          $goodid +=1;
                                    }   
								}elseif (isset($temp['error'])) {
									// $outdata->messages[] = (print_r($temp['error'], true));
                                     $badid +=1 ; 
								}
							}
						}

                        $totalsend += $goodid;
                        $totalunsend += $badid;
                        $totalallsend += 30;

                 $outdata->messages[] = "تم الارسال الى ".$goodid." مشترك وأخطأ الارسال الى ".$badid." مشترك من أصل 30 مشترك";
            } catch(Exception $e) {
                    $error = $e->getMessage();
                    $error = BlockSQL($error);
                    $errors[] = $error;
                     $outdata->messages[] = "لم يتم التنفيذ لحدوث هذا الخطأ ==>".$error;
            }
             $i=0;
            unset($batchPost);
           
        }


        
 //-------------------- READ RESPONSE MESSAGES
                      $pagemessages =   LoadPhp("http://178.63.108.123/sites/myfacebook/postfeedservice.php?type=accounts&accesstoken=".$r["accesstoken"]."&message=".$message_enc."&link=".$link );
                   
                     
                      try
                      {
                            $decoded = json_decode($pagemessages);
                          if ($decoded != null) {
                          if (_nullify($decoded, 'messages')) {
                       $outdata->messages[] = "[-----------------------------]";
                      foreach  ($decoded->messages as $key=>$value)
                         {
                           $outdata->messages[] = $value;
                         }
                            $outdata->messages[] = "[-----------------------------]";
                          }}
                       } catch(Exception $e){
                   $error = $e->getMessage();
                    $error = BlockSQL($error);
                    $errors[] = $error;
                     $outdata->messages[] = "لم يتم التنفيذ لحدوث هذا الخطأ ==>".$error;
        }
        //------------------------------ END
        

    }

                   if(isset($batchPost) && count($batchPost) > 0 ) {
          $goodid = 0;
          $badid = 0;

        try{
            $multiPostResponse = $facebook->api('?batch='.urlencode(json_encode($batchPost)), 'POST');
            $outdata->messages[] = "------------------------------";
          
             if (is_array($multiPostResponse)) {
							foreach ($multiPostResponse as $singleResponse) {
								$temp = json_decode($singleResponse['body'], true);
								if (isset($temp['id'])) {
									$splitId = explode("_", $temp['id']);
									if (!empty($splitId[1])) 
                                    {
                                       // $outdata->messages[] = "تم الارسال الى ".$splitId[0];
                                          $goodid +=1;
                                    }   
								}elseif (isset($temp['error'])) {
									// $outdata->messages[] = (print_r($temp['error'], true));
                                     $badid +=1 ; 
								}
							}
						}

                          $totalsend += $goodid;
                        $totalunsend += $badid;
                        $totalallsend += count($batchPost);

            $outdata->messages[] = "تم الارسال الى ".$goodid." مشترك وأخطأ الارسال الى ".$badid." مشترك من أصل  ".count($batchPost)." مشترك ";
        } catch(Exception $e){
                   $error = $e->getMessage();
                    $error = BlockSQL($error);
                    $errors[] = $error;
                     $outdata->messages[] = "لم يتم التنفيذ لحدوث هذا الخطأ ==>".$error;
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
                      $outdata->messages[] = "تم تنفيذ هذه العمليه فى حوالى => ".$totaltime." ثانيه ففط";
                      $outdata->messages[] = "**------------------------------**";
                      $outdata->messages[] = "**------------------------------**";
                      $outdata->messages[] = "تم الارسال الى ".$totalsend." مشترك وأخطأ الارسال الى ".$totalunsend." مشترك من أصل  ".$totalallsend." مشترك ";
                      $outdata->messages[] = "**------------------------------**";
                      $outdata->messages[] = "**------------------------------**";

                     header('Content-type: application/json; charset=utf-8');
                                  echo json_encode($outdata); die();

                }

      
 }
 
  }
  catch(Exception $ex)
  {
       $outdata->messages[] = $ex->getMessage();
         header('Content-type: application/json; charset=utf-8');
                                  echo json_encode($outdata); die();
  }

    header('Content-type: application/json; charset=utf-8');
                                  echo json_encode($outdata); die();






            function BlockSQL($str)
{
    if($str == null)
    {
        return null;
    }

$str = mysql_real_escape_string($str);//Escapes special characters in a string for use in an SQL statement
$str = htmlspecialchars($str); // will convert special chars like < to &lt;
$str = strip_tags($str); //  strip all tags out.
return $str;

}
// ---------------------------------------------------------------->


 ?> 



   