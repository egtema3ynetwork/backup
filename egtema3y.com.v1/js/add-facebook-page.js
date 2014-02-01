function createpage() {
    $('#addbutton').html('Loading ...');
    var pageid = $('#pageid').val();
    var pagetags = $('#pagetags').val();
    

    var _url = '../api/add.php?object=facebookuser&_fullinfo=yes&pageid=' + pageid + '&pagetags=' + pagetags ;
    console.log("call service : " + _url);
    $.getJSON(_url, function (data) {
        if (data.data === "succeed") {
            $('#pageid').val('');
          
            $('#addbutton').html('ok - Create another Facebook Page');
            clearfacebookuserdiv();loadfacebookuser(0, '');
        }
        else {
            $('#addbutton').html('error - try again');
        }

    });
}


function deletefacebookpagebyid(wallid) {
    $('#deletefacebook_' + wallid).html('Loading ...');

    var _url = '../api/delete.php?object=facebookuser&_fullinfo=yes&wallid=' + wallid;
    console.log("call service : " + _url);
    $.getJSON(_url, function (data) {
        if (data.count > 0) {

            $('#deletefacebook_' + wallid).html('ok - page deleted ' + data.count);
        }
        else {
            $('#deletefacebook_' + wallid).html('error delete page');
        }

    });
}


function savefacebookpagebyid(wallid) {
    $('#savetags_' + wallid).html('Loading ...');
    var tags = $('#txt_tags_' + wallid).val();
	var publicview = $('#txt_publicview_' + wallid).val();
    var _url = '../api/edit.php?object=facebookuser&_fullinfo=yes&wallid=' + wallid + '&tags=' + tags + '&publicview=' + publicview;
    console.log("call service : " + _url);
    $.getJSON(_url, function (data) {
        if (data.count > 0) {

            $('#savetags_' + wallid).html('ok - saved ');
        }
        else {
            $('#savetags_' + wallid).html('error edit ');
        }

    });
}