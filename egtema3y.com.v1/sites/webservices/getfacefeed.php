<?php

require 'shared/facebook.php';
  require "shared/setting.php";
  require "shared/functions.php";



  $accesstoken = isset($_GET['accesstoken']) ? $_GET['accesstoken'] : '';
  $feedid = isset($_GET['feedid']) ? $_GET['feedid'] : 'me';
  $responseobject->status = "start";
  $responseobject->data = array();
  if($feedid == "")
  {
      $feedid="me";
  }

    if($accesstoken != "" && $feedid !="")
    {


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

							 $outdata [] = clone $entity;

							}

                            $responseobject->data =  $outdata;
                          
						}
					}
}
  echo json_encode($responseobject);die();

?>

