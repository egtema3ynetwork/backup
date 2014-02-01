function autoupdatefacebookpage() {
    $('#autoupdatefacebook').html('Loading ...');

    var _url = '../api/update.php?object=facebook&_fullinfo=yes';
    console.log("call service : " + _url);
    $.getJSON(_url, function (data) {
        if (data.count > 0) {

            $('#autoupdatefacebook').html('ok - feed updated count is ' + data.count);
        }
        else {
            $('#autoupdatefacebook').html('ok - no update');
        }

    });
}

function autoupdatefacebookpagebyid(wallid) {
    $('#autoupdatefacebook_' + wallid).html('Loading ...');

    var _url = '../api/update.php?object=facebook&_fullinfo=yes&wallid=' + wallid;
    console.log("call service : " + _url);
    $.getJSON(_url, function (data) {
        if (data.count > 0) {

            $('#autoupdatefacebook_' + wallid).html('ok - feed updated count is ' + data.count);
        }
        else {
            $('#autoupdatefacebook_' + wallid).html('ok - no update');
        }

    });
}

function autoupdatetwitterpage() {
    $('#autoupdatetwitter').html('Loading ...');

    var _url = '../api/update.php?object=twitter&_fullinfo=yes';
    console.log("call service : " + _url);
    $.getJSON(_url, function (data) {
        if (data.count > 0) {

            $('#autoupdatetwitter').html('ok - feed updated count is ' + data.count);
        }
        else {
            $('#autoupdatetwitter').html('ok - no update');
        }

    });
}

function autoupdatetwitteruserbyid(twitterscreenname) {
    $('#autoupdatetwitter_' + twitterscreenname).html('Loading ...');

    var _url = '../api/update.php?object=twitter&_fullinfo=yes&twitterscreenname=' + twitterscreenname;
    console.log("call service : " + _url);
    $.getJSON(_url, function (data) {
        if (data.count > 0) {

            $('#autoupdatetwitter_' + twitterscreenname).html('ok - feed updated count is ' + data.count);
        }
        else {
            $('#autoupdatetwitter_' + twitterscreenname).html('ok - no update');
        }

    });
}

function autoupdateyoutubepage() {
    $('#autoupdateyoutube').html('Loading ...');

    var _url = '../api/update.php?object=youtube&_fullinfo=yes';
    console.log("call service : " + _url);
    $.getJSON(_url, function (data) {
        if (data.count > 0) {

            $('#autoupdateyoutube').html('ok - feed updated count is ' + data.count);
        }
        else {
            $('#autoupdateyoutube').html('ok - no update');
        }

    });
}
function autoupdateyoutubeuserbyid(twitterscreenname) {
    $('#autoupdateyoutube_' + twitterscreenname).html('Loading ...');

    var _url = '../api/update.php?object=youtube&_fullinfo=yes&channelname=' + twitterscreenname;
    console.log("call service : " + _url);
    $.getJSON(_url, function (data) {
        if (data.count > 0) {

            $('#autoupdateyoutube_' + twitterscreenname).html('ok - feed updated count is ' + data.count);
        }
        else {
            $('#autoupdateyoutube_' + twitterscreenname).html('ok - no update');
        }

    });
}



