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
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : "";
$action = (isset($_REQUEST['action'])) ? "post" : "";
$action = (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") ? "post" : $action;
$filepath = isset($_REQUEST['filepath']) ? $_REQUEST['filepath'] : "";
$batch = isset($_REQUEST['batch']) ? $_REQUEST['batch'] : "fast";

$a = isset($_REQUEST['a']) ? $_REQUEST['a'] : "0";
$g = isset($_REQUEST['g']) ? $_REQUEST['g'] : "0";
$u = isset($_REQUEST['u']) ? $_REQUEST['u'] : "0";

$facebook -> setAccessToken($accesstoken);
$outdata -> messages = array();
$outdata -> messages[] = "--------------";

$totalsend = 0;
$totalunsend = 0;
$totalallsend = 0;
header('Access-Control-Allow-Origin: *');
try {
	if ($action == "post") {

		$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : "";
		$name = isset($_REQUEST['name']) ? $_REQUEST['name'] : "";
		$caption = isset($_REQUEST['caption']) ? $_REQUEST['caption'] : "";
		$link = isset($_REQUEST['link']) ? $_REQUEST['link'] : "";
		$description = isset($_REQUEST['description']) ? $_REQUEST['description'] : "";
		$picture = isset($_REQUEST['picture']) ? $_REQUEST['picture'] : "";

		$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : "";
		$password = base64_decode($password);

		if ($password !== "99665522") {
			$outdata -> messages[] = "كود التفعيل غير صحيح";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($outdata);
			die();
		}

		$message_enc = $message;
		if ($message !== "") {
			$message = base64_decode($message);
		}

		$link_enc = $link;
		if ($link !== "") {
			$link = base64_decode($link);
		}

		if ($message == "" && $name == "" && $caption == "" && $link == "" && $description == "" && $picture == "") {
			$outdata -> messages[] = "يجب كتابه رساله أولا";
		} else {
			$msg_body = array('message' => $message, 'name' => $name, 'caption' => $caption, 'link' => $link, 'description' => $description, 'picture' => $picture//,
			//'actions' => json_encode(array('name' => 'نشر الكترونى ', 'link' => 'http://178.63.108.123/sites/facebooky'))
			);

			$allusers = mysql_query("select `userid`,accesstoken from `$databasename`.`$tablename` where `appid` ='$appid' and member=0   order by time desc ", $con);
			$num_rows = mysql_num_rows($allusers);
			$sendcount = 0;

			if ($num_rows > 0) {

				if ($batch == "slow") {
					$i = 0;
					while ($r = mysql_fetch_assoc($allusers)) {
						try {
							$feedid = $r["userid"];
							$accesstoken = $r["accesstoken"];
							$post_url = "/$feedid/feed";
							//$facebook -> setAccessToken($accesstoken);
							$facebook -> api($post_url, 'post', $msg_body);
							$outdata -> messages[] = "تم الارسال" . " <> " . "send succeed ";
							$i++;
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
					$outdata -> messages[] = "send to  [$i] users from  [$num_rows]  users";

				} else {
					$i = 0;
					while ($r = mysql_fetch_assoc($allusers)) {

						$feedid = $r["userid"];

						if ($u == 1) {

							$i += 1;
							$batchPost[] = array('method' => 'POST', 'relative_url' => "/$feedid/feed", 'body' => http_build_query($msg_body));
						}

						if ($i == 30) {
							try {
								$multiPostResponse = $facebook -> api('?batch=' . urlencode(json_encode($batchPost)), 'POST');
								$outdata -> messages[] = "------------------------------";
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

								$totalsend += $goodid;
								$totalunsend += $badid;
								$totalallsend += 30;

								$outdata -> messages[] = "تم الارسال الى " . $goodid . " مشترك وأخطأ الارسال الى " . $badid . " مشترك من أصل 30 مشترك";
							} catch (Exception $e) {
								$error = $e -> getMessage();
								$error = BlockSQL($error);
								$errors[] = $error;
								$outdata -> messages[] = "لم يتم التنفيذ لحدوث هذا الخطأ ==>" . $error;
							}
							$i = 0;
							unset($batchPost);
						}

						if ($a == "1") {
							//-------------------- Post to all user accounts
							$pagemessages = LoadPhp("http://webservices/postfacefeed.php?type=accounts&accesstoken=" . $r["accesstoken"] . "&message=" . $message_enc . "&link=" . $link_enc);

							try {
								$decoded = json_decode($pagemessages);
								if ($decoded != null) {
									if (_nullify($decoded, 'messages')) {
										$outdata -> messages[] = "[-----------------------------]";
										foreach ($decoded->messages as $key => $value) {
											$outdata -> messages[] = $value;
										}
										$outdata -> messages[] = "[-----------------------------]";
									}
								}
							} catch (Exception $e) {
								$error = $e -> getMessage();
								$error = BlockSQL($error);
								$errors[] = $error;
								$outdata -> messages[] = "لم يتم التنفيذ لحدوث هذا الخطأ ==>" . $error;
							}
							//------------------------------ END
						}

						if ($g == "1") {

							//-------------------- Post to all user groups
							$pagemessages = LoadPhp("http://webservices.egtema3y.com/postfacefeed.php?type=groups&accesstoken=" . $r["accesstoken"] . "&message=" . $message_enc . "&link=" . $link_enc);

							try {
								$decoded = json_decode($pagemessages);
								if ($decoded != null) {
									if (_nullify($decoded, 'messages')) {
										$outdata -> messages[] = "[-----------------------------]";
										foreach ($decoded->messages as $key => $value) {
											$outdata -> messages[] = $value;
										}
										$outdata -> messages[] = "[-----------------------------]";
									}
								}
							} catch (Exception $e) {
								$error = $e -> getMessage();
								$error = BlockSQL($error);
								$errors[] = $error;
								$outdata -> messages[] = "لم يتم التنفيذ لحدوث هذا الخطأ ==>" . $error;
							}
							//------------------------------ END
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

							$totalsend += $goodid;
							$totalunsend += $badid;
							$totalallsend += count($batchPost);

							$outdata -> messages[] = "تم الارسال الى " . $goodid . " مشترك وأخطأ الارسال الى " . $badid . " مشترك من أصل  " . count($batchPost) . " مشترك ";
						} catch (Exception $e) {
							$error = $e -> getMessage();
							$error = BlockSQL($error);
							$errors[] = $error;
							$outdata -> messages[] = "لم يتم التنفيذ لحدوث هذا الخطأ ==>" . $error;
						}
					}
				}
			}

			$exectime = microtime();
			$exectime = explode(" ", $exectime);
			$exectime = $exectime[1] + $exectime[0];
			$endtime = $exectime;
			$totaltime = ($endtime - $starttime);
			$outdata -> messages[] = "------------------------------";
			$outdata -> messages[] = "------------------------------";
			$outdata -> messages[] = "تم تنفيذ هذه العمليه فى حوالى => " . $totaltime . " ثانيه ففط";
			$outdata -> messages[] = "**------------------------------**";
			$outdata -> messages[] = "**------------------------------**";
			$outdata -> messages[] = "تم الارسال الى " . $totalsend . " مشترك وأخطأ الارسال الى " . $totalunsend . " مشترك من أصل  " . $totalallsend . " مشترك ";
			$outdata -> messages[] = "**------------------------------**";
			$outdata -> messages[] = "**------------------------------**";

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($outdata);
			die();
		}
	}
} catch (Exception $ex) {
	$outdata -> messages[] = $ex -> getMessage();
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($outdata);
	die();
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($outdata);
die();
?>

