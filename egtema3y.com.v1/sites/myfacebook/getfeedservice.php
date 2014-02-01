<?php

function LoadJsonFromFacebook($url) {
    try {

       

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: graph.facebook.com'));
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    } catch (Exception $ex) {
      
        return null;
    }
}
// ---------------------------------------------------------------->
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

