<?php include("../content/start.php"); ?>
<?php

require "../global/setting.php";

function getShortenUrl($url) {
    if ($url == "") {
        return "";
    }
    $shorten = LoadJson('http://share2.in/webservices/shortenurl.php?spyurl=' . spy($url) . "&memberid=1");
    $shorten = json_decode($shorten);
    return _nullify($shorten, 'shorturl');
}

function shortenAllLinks($str) {
    $regex = '/https?\:\/\/[^\" ]+/i';
    preg_match_all($regex, $str, $matches);
    $urls = $matches[0];
    foreach ($urls as $url) {
        $str = str_replace($url, getShortenUrl($url), $str);
    }
    return $str;
}

function addfeedfromfacebook($feed, $tags, $publicview) {
    global $responseobject;
    global $access_token;
    global $databasename;
    global $tablename;
    global $con;

    try {

        $fromid = $feed->from->id;
        $fromname = $feed->from->name;

        $created_time = _nullify($feed, 'created_time');
        $postmessage = _nullify($feed, 'message');
        $story = _nullify($feed, 'story');

        $postimage = _nullify($feed, 'picture');
        if ($postimage) {
            $postimage = preg_replace("/_s./", "_n.", $postimage);
        }

        $postlinkname = _nullify($feed, 'name');
        $postlinkurl = _nullify($feed, 'link');
        $postcaption = _nullify($feed, 'caption');
        $postdescription = _nullify($feed, 'description');
        $frompicture = "";
        $postid = _nullify($feed, 'id');


        if (strpos($postmessage, '/fanned_pages/') !== false) {
            return;
        }

        $postmessage = shortenAllLinks($postmessage);
        $postlinkurl = getShortenUrl($postlinkurl);


        $fromid = BlockSQL($fromid);
        $fromname = BlockSQL($fromname);

        $postmessage = BlockSQL($postmessage);
        $story = BlockSQL($story);
        $postimage = BlockSQL($postimage);

        $postlinkname = BlockSQL($postlinkname);
        $postlinkurl = BlockSQL($postlinkurl);
        $postcaption = BlockSQL($postcaption);
        $postdescription = BlockSQL($postdescription);

        $oldposts = mysql_query("select `postid` from `{$databasename}`.`" . TABLE_NAME_FACEBOOKFEED . $tags . "` where `postid`='$postid'") or $responseobject->errors[] = mysql_error();
        if ($oldposts == null) {
            $responseobject->notes[] = ' null oldpost return';
            return;
        }

        $num_rows = mysql_num_rows($oldposts);
        if ($num_rows > 0) {
            //$responseobject->notes[] = $postid . ' exists';
            return;
        }
        mysql_free_result($oldposts);

        $sql = "INSERT INTO `{$databasename}`.`" . TABLE_NAME_FACEBOOKFEED . $tags . "` (
				`id` ,
				`time` ,
				`wallid` ,
				`wallname` ,
				`wallimageurl` ,
				`postid` ,
				`postmessage` ,
				`postmessage2` ,
				`postlinkname` ,
				`postlinkurl` ,
				`postcaption` ,
				`postdescription` ,
				`postimage` ,
				`tags`,
				`publicview`
				)
				VALUES (
				NULL ,
				'{$created_time}' , '{$fromid}', '{$fromname}', '{$frompicture}', '{$postid}',
				'{$postmessage}' , '{$story}' , '{$postlinkname}','{$postlinkurl}' , '{$postcaption}' , '{$postdescription}' , '{$postimage}','{$tags}',{$publicview}
				);
				";

        if (mysql_query($sql)) {
            $responseobject->count += 1;
        } else {
            $responseobject->errors[] = mysql_error();
        }
    } catch (Exception $ex) {
        $responseobject->errors[] = $ex->getMessage();
    }
}

function addfeedfromtwitter($feed, $tags, $publicview) {

    global $responseobject;
    global $access_token;
    global $databasename;
    global $tablename;
    global $con;

    try {


        $postid = _nullify($feed, 'id_str');
        $created_time1 = strtotime(_nullify($feed, 'created_at'));
        $created_time = date('Y-m-d H:i:s', $created_time1);

        $fromid = "";
        $fromname = "";
        $frompicture = "";

        if (_nullify($feed, 'user') != null) {
            $fromid = _nullify($feed->user, 'screen_name');
            $fromname = _nullify($feed->user, 'name');
            $frompicture = _nullify($feed->user, 'profile_image_url');
        }

        $postmessage = _nullify($feed, 'text');



        $oldposts = mysql_query("select `postid` from `{$databasename}`.`" . TABLE_NAME_TWITTERFEED . $tags . "` where `postid`='$postid'", $con);
        $num_rows = mysql_num_rows($oldposts);
        if ($num_rows > 0) {
            //$responseobject->notes[] = $postid . ' exists';
            return;
        }


        $sql = "INSERT INTO `{$databasename}`.`" . TABLE_NAME_TWITTERFEED . $tags . "` (
				`id` ,
				`time` ,
				`wallid` ,
				`wallname` ,
				`wallimageurl` ,
				`postid` ,

				`postmessage` 	 ,
				`tags`,
				`publicview`

				)
				VALUES (
				NULL ,
				'{$created_time}' , '{$fromid}', '{$fromname}', '{$frompicture}', '{$postid}', '{$postmessage}'	,'{$tags}','{$publicview}'
				);
				";

        if (mysql_query($sql, $con)) {
            $responseobject->count += 1;
        } else {
            $responseobject->errors[] = mysql_error();
        }
    } catch (Exception $ex) {
        $responseobject->errors[] = $ex->getMessage();
    }
}

function addfeedfromyoutube($feed, $tags, $publicview, $channelimageurl) {

    global $responseobject;
    global $access_token;
    global $databasename;
    global $tablename;
    global $con;

    try {


        $videoid = _nullify($feed, 'id');
        $created_time1 = strtotime(_nullify($feed, 'uploaded'));
        $created_time = date('Y-m-d H:i:s', $created_time1);
        $channelname = _nullify($feed, 'uploader');
        $title = _nullify($feed, 'title');
        $description = _nullify($feed, 'description');

        $youtubeimageurl = "";
        if (_nullify($feed, 'thumbnail') != null) {
            $youtubeimageurl = _nullify($feed->thumbnail, 'sqDefault');
        }



        $oldposts = mysql_query("select `videoid` from `{$databasename}`.`" . TABLE_NAME_YOUTUBEFEED . $tags . "` where `videoid`='$videoid'", $con);
        if ($oldposts == null) {
            //return;
        }
        $num_rows = mysql_num_rows($oldposts);
        if ($num_rows > 0) {
            //$responseobject->notes[] = $postid . ' exists';
            return;
        }


        $sql = "INSERT INTO `{$databasename}`.`" . TABLE_NAME_YOUTUBEFEED . $tags . "`(`id`, `channelname`, `videoid`, `time`, `title`, `description`, `imageurl`, `publicview`, `tags`,`channelimageurl`)
			VALUES (
			null,
			'{$channelname}',
			'{$videoid}',
			'{$created_time}',
			'{$title}',
			'{$description}',
			'{$youtubeimageurl}',
			{$publicview},
			{$tags},
			'{$channelimageurl}'
			)
			";

        if (mysql_query($sql, $con)) {
            $responseobject->count += 1;
        } else {
            $responseobject->errors[] = mysql_error();
        }
    } catch (Exception $ex) {
        $responseobject->errors[] = $ex->getMessage();
    }
}

function AutoLoadFeedsFromFacebook() {


    try {
        global $responseobject;
        global $access_token;
        global $databasename;
        global $tablename;
        global $con;

        $sql = "select `wallid`,`tags`,`wallpublicview` from `{$databasename}`.`" . TABLE_NAME_FACEBOOKUSER . "` where 1 and `wallautoupdate` = 1 ";
        if (isset($_GET['wallid']) && $_GET['wallid'] != '') {
            $sql .= " and wallid='" . $_GET['wallid'] . "' ";
        }
        if (isset($_GET['tags']) && $_GET['tags'] != '') {
            $sql .= " and `tags`='" . $_GET['tags'] . "' ";
        }

        //$responseobject->notes[] = $sql;
        $allpage = mysql_query($sql, $con);

        if ($allpage != null) {
            while ($r = mysql_fetch_assoc($allpage)) {
                $responseobject->count2 += 1;
                $pageid = $r["wallid"];
                $data = LoadJsonFromFacebook("https://graph.facebook.com/" . $pageid . "/feed/?access_token=" . GET_ACCESSTOKEN . "&limit=" . UPDATE_FEED_LIMIT);

                $decoded = json_decode($data);
                if ($decoded != null) {
                    if (_nullify($decoded, 'data')) {

                        foreach ($decoded->data as $feed) {
                            if ($feed->from->id == $pageid) {
                                addfeedfromfacebook($feed, $r["tags"], $r["wallpublicview"]);
                            }
                        }
                    }
                }
            }
        }
    } catch (Exception $ex) {
        $responseobject->errors[] = $ex->getMessage();
    }
}

function AutoLoadFeedsFromTwitter() {
    try {
        global $responseobject;
        global $access_token;
        global $databasename;
        global $tablename;
        global $con;

        $sql = "select `twitterscreenname`,`tags`,`publicview` from `{$databasename}`.`" . TABLE_NAME_TWITTERUSER . "` where 1 and `autoupdate` = 1";
        if (isset($_GET['twitterscreenname']) && $_GET['twitterscreenname'] != '') {
            $sql .= " and twitterscreenname='" . $_GET['twitterscreenname'] . "' ";
        }



        $result = mysql_query($sql, $con);

        if ($result != null) {

            while ($r = mysql_fetch_assoc($result)) {
                $responseobject->count2+=1;
                $data = LoadJsonFromTwitter("https://api.twitter.com/1/" . $r['twitterscreenname'] . ".json?callback=?&count=" . UPDATE_FEED_LIMIT);
                $decoded = json_decode($data);

                if ($decoded != null) {

                    foreach ($decoded as $feed) {
                        addfeedfromtwitter($feed, $r['tags'], $r['publicview']);
                    }
                }
            }
        } else {
            $responseobject->errors[] = mysql_error();
        }
    } catch (Exception $ex) {
        $responseobject->errors[] = $ex->getMessage();
    }
}

function AutoLoadFeedsFromYoutube() {
    try {
        global $responseobject;
        global $access_token;
        global $databasename;
        global $tablename;
        global $con;

        $sql = "select `channelname`,`tags`,`publicview` ,`youtubeimageurl` from `{$databasename}`.`" . TABLE_NAME_YOUTUBEUSER . "` where 1 and `autoupdate` = 1";
        if (isset($_GET['channelname']) && $_GET['channelname'] != '') {
            $sql .= " and channelname='" . $_GET['channelname'] . "' ";
        }



        $result = mysql_query($sql, $con);

        if ($result != null) {

            while ($r = mysql_fetch_assoc($result)) {
                $responseobject->count2+=1;
                $data = LoadJsonFromYoutube("https://gdata.youtube.com/feeds/api/videos?q=" . $r['channelname'] . "&v=2&alt=jsonc");
                $decoded = json_decode($data);

                if ($decoded != null) {

                    foreach ($decoded->data->items as $feed) {
                        addfeedfromyoutube($feed, $r['tags'], $r['publicview'], $r['youtubeimageurl']);
                    }
                }
            }
        } else {
            $responseobject->errors[] = mysql_error();
        }
    } catch (Exception $ex) {
        $responseobject->errors[] = $ex->getMessage();
    }
}

try {


    if ($object == "facebook") {
        $responseobject->notes[] = "facebook";
        while (true) {
            $sql = "select `loop` from `" . DB_NAME . "`.`service` where `actionname`='update_facebook'";
            $services = mysql_query($sql, $link) or $responseobject->errors[] = mysql_error();
            if ($services == null) {
                $responseobject->notes[] = ' null service return';
                break;
            }
            $num_rows = mysql_num_rows($services);
            if ($num_rows > 0) {
                $loop = mysql_fetch_assoc($services);
                if ($loop['loop'] == 1) {

                    AutoLoadFeedsFromFacebook();
                } else {
                    $responseobject->notes[] = "service stop now ..";
                    AutoLoadFeedsFromFacebook();
                    break;
                }
            }
            mysql_free_result($services);
        }
    } else if ($object == "twitter") {
        $responseobject->notes[] = "twitter";
        while (true) {
            $sql = "select `loop` from `" . DB_NAME . "`.`service` where `actionname`='update_twitter'";
            $services = mysql_query($sql, $link) or $responseobject->errors[] = mysql_error();
            if ($services == null) {
                $responseobject->notes[] = ' null service return';
                break;
            }
            $num_rows = mysql_num_rows($services);
            if ($num_rows > 0) {
                $loop = mysql_fetch_assoc($services);
                if ($loop['loop'] == 1) {

                    AutoLoadFeedsFromTwitter();
                } else {
                    $responseobject->notes[] = "service stop now ..";
                    AutoLoadFeedsFromTwitter();
                    break;
                }
            }
            mysql_free_result($services);
        }
    } else if ($object == "youtube") {
        $responseobject->notes[] = "youtube";
        while (true) {
            $sql = "select `loop` from `" . DB_NAME . "`.`service` where `actionname`='update_youtube'";
            $services = mysql_query($sql, $link) or $responseobject->errors[] = mysql_error();
            if ($services == null) {
                $responseobject->notes[] = ' null service return';
                break;
            }
            $num_rows = mysql_num_rows($services);
            if ($num_rows > 0) {
                $loop = mysql_fetch_assoc($services);
                if ($loop['loop'] == 1) {

                    AutoLoadFeedsFromYoutube();
                } else {
                    $responseobject->notes[] = "service stop now ..";
                    AutoLoadFeedsFromYoutube();
                    break;
                }
            }
            mysql_free_result($services);
        }
    }
} catch (Exception $ex) {
    $responseobject->errors[] = $ex->getMessage();
}


$responseobject->timeexcuted = include("../content/end.php");
;

header('Content-type: application/json; charset=utf-8');
echo json_encode($responseobject);
?>