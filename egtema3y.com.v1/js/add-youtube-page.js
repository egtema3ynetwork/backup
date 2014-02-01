function createyoutubeuser() {
    $('#addbutton').html('جارى التحقق ...');
    var userid = $('#userid').val();


    var _url = '../api/add.php?object=youtubeuser&_fullinfo=yes&channelname=' + userid ;
    console.log("call service : " + _url);
    $.getJSON(_url, function (data) {
        if (data.data === "succeed") {
            $('#userid').val('');
          
            $('#addbutton').html('ok - Create another youtube User');
            clearyoutubeuserdiv();loadyoutubeuser(0, '');
        }
        else {
            $('#addbutton').html('error - try again');
        }

    });
}


function deleteyoutubeuserbyid(youtubechannelname) {
    $('#deleteyoutube_' + youtubechannelname).html('Loading ...');

    var _url = '../api/delete.php?object=youtubeuser&_fullinfo=yes&channelname=' + youtubechannelname;
    console.log("call service : " + _url);
    $.getJSON(_url, function (data) {
        if (data.count > 0) {

            $('#deleteyoutube_' + youtubechannelname).html('ok - page deleted ' + data.count);
        }
        else {
            $('#deleteyoutube_' + youtubechannelname).html('error delete page');
        }

    });
}


function saveyoutubeuserbyid(youtubechannelname) {
    $('#savetags_' + youtubechannelname).html('Loading ...');
    var tags = $('#txt_tags_' + youtubechannelname).val();
	var publicview = $('#txt_publicview_' + youtubechannelname).val();
    var _url = '../api/edit.php?object=youtubeuser&_fullinfo=yes&channelname=' + youtubechannelname + '&tags=' + tags + '&publicview=' + publicview;
    console.log("call service : " + _url);
    $.getJSON(_url, function (data) {
        if (data.count > 0) {

            $('#savetags_' + youtubechannelname).html('ok -  saved ');
        }
        else {
            $('#savetags_' + youtubechannelname).html('error edit ');
        }

    });
}