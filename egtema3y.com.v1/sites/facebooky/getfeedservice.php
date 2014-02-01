<?php

 require 'app_setting.php';
 require 'shared/facebook.php';


  $accesstoken = isset($_GET['accesstoken']) ? $_GET['accesstoken'] : '';
  $feedid = isset($_GET['feedid']) ? $_GET['feedid'] : '';

	$data = LoadJsonFromFacebook("https://graph.facebook.com/" . $feedid . "/feed/?access_token=" .$accesstoken );
    $decoded = json_decode($data);

   $outdata = array();

					if ($decoded != null) {
						if (_nullify($decoded, 'data')) {
							
							foreach ($decoded->data as $feed) {
							

									 $entity->fromid = $feed->from->id;
			                         $entity->fromname = $feed->from->name;
			
			                        $entity->created_time = _nullify($feed, 'created_time');
			                        $entity->postmessage = _nullify($feed, 'message');
			                        $entity->postmessage2 = _nullify($feed, 'story');
			
			                        $entity->postimage = _nullify($feed, 'picture');
			if ( $entity->postimage) {
				 $entity->postimage = preg_replace("/_s./", "_n.",  $entity->postimage);
			}
			
			                         $entity->postlinkname = _nullify($feed, 'name');
			                         $entity->postlinkurl = _nullify($feed, 'link');
			                         $entity->postcaption = _nullify($feed, 'caption');
			                         $entity->postdescription = _nullify($feed, 'description');
			                         $entity->frompicture = "";
		                         	 $entity->postid = _nullify($feed, 'id');

							 $outdata [] = $entity;
							}
                            echo json_encode($responseobject);die();
						}
					}
?>

