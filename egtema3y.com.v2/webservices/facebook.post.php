<?php

ob_start();
set_time_limit(0);

require 'core.php';
require 'shared/facebook.php';

$outdata;
$outdata->data = array();
$outdata->errors = array();
$outdata->error ="";
$outdata->messages = array();
$outdata -> time = time();

$accesstoken = isset($_REQUEST['accesstoken']) ?$_REQUEST['accesstoken']:"";

if (!!$accesstoken) {

	$accesstoken = $_REQUEST['accesstoken'];
	$accesstoken = unspy($accesstoken);
	$facebook -> setAccessToken($accesstoken);

	$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : '';
	$message = unspy($message);

	$link = isset($_REQUEST['link']) ? $_REQUEST['link'] : '';
	$link = unspy($link);

	$name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
	$name = unspy($name);

	$caption = isset($_REQUEST['caption']) ? $_REQUEST['caption'] : '';
	$caption = unspy($caption);

	$picture = isset($_REQUEST['picture']) ? $_REQUEST['picture'] : '';
	$picture = unspy($picture);

	$description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
	$description = unspy($description);

	$action = "";//json_encode(array('name' => 'شبكة إجتماعى' , 'link' => 'http://v2.egtema3y.com/index.php'));

	if ($message == ""  && $link == "" ) {
		$errors[] = "no message write ...";
		$outdata -> errors = $errors;
		$outdata -> messages[] = "لا يوجد رساله لارسالها";
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($outdata);
		die();
	}

	$msg_body = array('message' => $message, 'name' => $name, 'caption' => $caption, 'link' => $link, 'description' => $description, 'picture' => $picture, 'actions' => $action);

	$type = isset($_REQUEST['type']) ? unspy($_REQUEST['type']) : 'me';

	if ($type == "me") {

		try {
			$post_url = '/me/feed';
			$facebook -> api($post_url, 'post', $msg_body);
			$outdata -> messages[] = "تم نشر الرساله على حائطك بنجاح";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($outdata);
			die();
		} catch (Exception $e) {
			$error = $e -> getMessage();
			$error = BlockSQL($error);
			$errors[] = $error;
			$outdata -> errors = $errors;
			$outdata -> messages[] = "لم يتم التنفيذ لحدوث هذا الخطأ ==>" . $error;
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($outdata);
		}
	}

	if ($type == "groups") {

		$msg_body = array('message' => $message, 'name' => $name, 'caption' => $caption, 'link' => $link, 'description' => $description, 'picture' => $picture);
		

		$groups = $facebook -> api('/me/groups');

		$i = 0;

		foreach ($groups['data'] as $group) {
			$feedid = $group['id'];

			$i += 1;

			$batchPost[] = array('method' => 'POST', 'relative_url' => "/$feedid/feed", 'body' => http_build_query($msg_body));

			if ($i == 30) {
				try {
					$multiPostResponse = $facebook -> api('?batch=' . urlencode(json_encode($batchPost)), 'POST');
					//$outdata -> messages[] = "------------------------------";
					$goodid = 0;
					$badid = 0;
					if (is_array($multiPostResponse)) {
						foreach ($multiPostResponse as $singleResponse) {
							$temp = json_decode($singleResponse['body'], true);
							if (isset($temp['id'])) {
								$splitId = explode("_", $temp['id']);
								if (!empty($splitId[1])) {
									// $outdata->messages[] = "تم الارسال الى ".$splitId[0];
									$goodid += 1;
								}
							} elseif (isset($temp['error'])) {
								// $outdata->messages[] = (print_r($temp['error'], true));
								$badid += 1;
							}
						}
					}

					$outdata -> messages[] = "تم الارسال الى " . $goodid . " جروب وأخطأ الارسال الى " . $badid . " جروب من أصل 30 جروب";
				} catch (Exception $e) {
					$error = $e -> getMessage();
					$error = BlockSQL($error);
					$errors[] = $error;
					$outdata -> messages[] = "لم يتم التنفيذ لحدوث هذا الخطأ ==>" . $error;
				}
				$i = 0;
				unset($batchPost);
			}
		}

		if (isset($batchPost) && count($batchPost) > 0) {
			$goodid = 0;
			$badid = 0;

			try {
				$multiPostResponse = $facebook -> api('?batch=' . urlencode(json_encode($batchPost)), 'POST');
				$outdata -> messages[] = "------------------------------";

				if (is_array($multiPostResponse)) {
					foreach ($multiPostResponse as $singleResponse) {
						$temp = json_decode($singleResponse['body'], true);
						if (isset($temp['id'])) {
							$splitId = explode("_", $temp['id']);
							if (!empty($splitId[1])) {
								// $outdata->messages[] = "تم الارسال الى ".$splitId[0];
								$goodid += 1;
							}
						} elseif (isset($temp['error'])) {
							// $outdata->messages[] = (print_r($temp['error'], true));
							$badid += 1;
						}
					}
				}

				$outdata -> messages[] = "تم الارسال الى " . $goodid . " جروب وأخطأ الارسال الى " . $badid . " جروب من أصل  " . count($batchPost) . " جروب ";
			} catch (Exception $e) {
				$error = $e -> getMessage();
				$error = BlockSQL($error);
				$errors[] = $error;
				$outdata -> messages[] = "لم يتم التنفيذ لحدوث هذا الخطأ ==>" . $error;
			}
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($outdata);
		die();
	}

	if ($type == "accounts") {
		$pages = $facebook -> api('/me/accounts');

		foreach ($pages['data'] as $page) {
			$feedid = $page['id'];
			$facebook -> setAccessToken($page['access_token']);

			try {
				$post_url = "/$feedid/feed";
				$facebook -> api($post_url, 'post', $msg_body);
				$outdata -> messages[] = "تم الارسال بنجاح الى صفحة " . $page['name'];
			} catch (Exception $e) {
				$error = $e -> getMessage();
				$error = BlockSQL($error);
				$errors[] = $error;
				$outdata -> errors = $errors;
				$outdata -> messages[] = "لم يتم التنفيذ لحدوث هذا الخطأ ==>" . $error;
			}
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($outdata);
		die();
	}
} else {
	$errors[] = "no accesstoken send ...";
	$outdata -> errors = $errors;
	$outdata -> messages[] = "لم يتم التنفيذ سجل دخول باستخدام حساب الفيسبوك  اولا ";

	header('Content-type: application/json; charset=utf-8');
	echo json_encode($outdata);
	die();
}
?>