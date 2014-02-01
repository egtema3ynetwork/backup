function createtwitteruser() {
    $('#addbutton').html('Loading ...');
    var userid = $('#userid').val();


    var _url = '../api/add.php?object=twitteruser&_fullinfo=yes&userid=' + userid ;
    console.log("call service : " + _url);
    $.getJSON(_url, function (data) {
        if (data.data === "succeed") {
            $('#userid').val('');
          
            $('#addbutton').html('ok - Create another twitter User');
            cleartwitteruserdiv();loadtwitteruser(0, '');
        }
        else {
            $('#addbutton').html('error - try again');
        }

    });
}


function deletetwitteruserbyid(twitterscreenname) {
    $('#deletetwitter_' + twitterscreenname).html('Loading ...');

    var _url = '../api/delete.php?object=twitteruser&_fullinfo=yes&twitterscreenname=' + twitterscreenname;
    console.log("call service : " + _url);
    $.getJSON(_url, function (data) {
        if (data.count > 0) {

            $('#deletetwitter_' + twitterscreenname).html('ok - page deleted ' + data.count);
        }
        else {
            $('#deletetwitter_' + twitterscreenname).html('error delete page');
        }

    });
}


function savetwitteruserbyid(twitterscreenname) {
    $('#savetags_' + twitterscreenname).html('Loading ...');
    var tags = $('#txt_tags_' + twitterscreenname).val();
	var publicview = $('#txt_publicview_' + twitterscreenname).val();
    var _url = '../api/edit.php?object=twitteruser&_fullinfo=yes&twitterscreenname=' + twitterscreenname + '&tags=' + tags + '&publicview=' + publicview;
    console.log("call service : " + _url);
    $.getJSON(_url, function (data) {
        if (data.count > 0) {

            $('#savetags_' + twitterscreenname).html('ok -  saved ');
        }
        else {
            $('#savetags_' + twitterscreenname).html('error edit ');
        }

    });
}