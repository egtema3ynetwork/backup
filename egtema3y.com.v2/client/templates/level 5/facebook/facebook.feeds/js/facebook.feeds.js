$(function() {

	var _facebook_webservice = __.getWebServicesURL() + "/facebook.feed.php";

	__.facebook = function() {
	};
	__.facebook.display = function() {
		__.layout.content().html(' <div id="facebook-feeds-div" class="row-fluid " style="direction: rtl;margin-bottom: 30px;"></div>');
	};

	__.facebook.loadFeeds = function(_start, _tags, _maxtime, _wallid) {

		__.log("Start Load Feeds");

		start = !!_start ? _start : 0;
		tags = !!_tags ? _tags : "";
		maxtime = !!_maxtime ? _maxtime : "";
		wallid = !!_wallid ? _wallid : "";

		if ($('#facebook-feeds-div').length == 0 || start == 0) {
			__.facebook.display();
			$('html, body').animate({
				scrollTop : $('#facebook-feeds-div').offset().top - 200
			}, 500);
		}

		$('.btn_more').hide('slow');
		$('.btn_more').remove();
		$('<div class="loadtxt row-fluid" ><img src="./client/images/load.gif"/><div data-en="Loading Posts" data-ar="جارى تحميل البوستات من فضلك انتظر قليلا" > ' + 'جارى تحميل البوستات من فضلك انتظر قليلا   ' + '</div></div> ').appendTo($("#facebook-feeds-div"));
		$(document).trigger("site/newContent");

		var _url = _facebook_webservice;
		__.log("call service : " + _url);

		$.ajax({
			url : _url,
			data : {
				object : "facebook",
				method : "newfeeds",
				_fullinfo : "yes",
				sort : "time desc",
				tags : tags,
				maxtime : maxtime,
				start : start,
				wallid : wallid
			},
			type : "GET",
			dataType : "json",
			crossDomain : true,
			timeout : 30000,
			success : function(data, textStatus, jqXHR) {
				var faces = [];

				$.each(data.data, function() {
					this.wallimageurl = "https://graph.facebook.com/" + this.wallid + "/picture?type=square";
					this.time = __.relativeTime(this.timeago);

					this.postmessage_d = this.postmessage;
					this.postcaption_d = this.postcaption;
					this.postdescription_d = this.postdescription;

					this.postmessage = __.urlMaker(this.postmessage);
					this.postmessage2 = __.urlMaker(this.postmessage2);
					this.postcaption = __.urlMaker(this.postcaption);
					this.postdescription = __.urlMaker(this.postdescription);

					faces.push(this);
				});

				if (start == 60 || start == 61) {
					var tmp0 = __.tmp2html('site-help-start-tmp', [1]);
					$('#facebook-feeds-div').append(tmp0);
				}
				start += faces.length;

				if (!maxtime) {
					start = 1;
				}
				maxtime = data.mintime;

				$('.loadtxt').remove();
				$('#facebook-feeds-div').append(__.tmp2html('facebook-feeds-div-tmp', faces));

				if (start == 120 || start == 121) {
					var tmp2 = __.tmp2html('site-help-addpage-tmp', [1]);
					$('#facebook-feeds-div').append(tmp2);
				}

				if (faces.length > 0) {
					$("#facebook-feeds-div").append('<hr><center><button class="span8 offset2 btn-primary theme btn_more shadow " onclick="__.facebook.loadFeeds(' + start + ',\'' + tags + '\',\'' + maxtime + '\');" data-en="More Posts" data-ar="اعرض المزيد من البوستات" >اعرض المزيد من البوستات</button></center>');

				}

				if (start > 30) {
					$("body").scrollTop($("body").scrollTop() + 200);
				}

			},
			error : function(jqXHR, textStatus, errorThrown) {
				$('.loadtxt').html('<p style="color:red;" data-en="Server Error Connected " data-ar="يتعذر الاتصال بالسيرفر فى الوقت الحالى - حاول مرة اخرى بعد قليل" > ' + 'يتعذر الاتصال بالسيرفر فى الوقت الحالى - حاول مرة اخرى بعد قليل' + '</p>');
				$("#facebook-feeds-div").append('<hr><center><button class="span8 offset2 btn-primary theme btn_more shadow " onclick="__.facebook.loadFeeds(' + start + ',\'' + tags + '\',\'' + maxtime + '\'); " data-en="More Posts" data-ar="اعرض المزيد من البوستات" >اعرض المزيد من البوستات</button></center>');
				__.logErr("ajax facebook feed error : " + errorThrown);
				$(document).trigger("site/newContent");

			},
			complete : function(jqXHR, textStatus) {
				__.logInfo("ajax facebook feed  complete : " + textStatus);
				$(document).trigger("site/newContent");
			}
		});

	};
	__.facebook.autoUpdateFeeds = function() {
		__.layout.content().html('');
		$('<div class=" loadtxt span6 offset3"> ' + 'جارى تحديث البوستات ' + '<img src="./client/images/load.gif"/> </div>').appendTo(__.layout.content());

		var _facebook_webservice = __.getWebServicesURL() + "/facebook.feed.php";

		$.ajax({
			url : _facebook_webservice,
			data : {
				object : "facebook",
				method : "updatefeeds",
			},
			type : "POST",
			dataType : "json",
			crossDomain : true,

			success : function(data, textStatus, jqXHR) {
				__.layout.content().html('تم تحديث كل البوستات اوتوماتك' + "  واضافة " + data.newPostCount + " بوست ");

			}
		});

	};
	__.facebook.like = function(postid, tags) {
		var i = $('#liketxt_' + postid).html();
		i++;
		$('#liketxt_' + postid).html(i);
		$('#likebutton_' + postid).attr("disabled", "disabled");
		$('#likebutton_' + postid).removeAttr('onclick');
	};
	__.facebook.unlike = function(postid, tags) {
		var i = $('#unliketxt_' + postid).html();
		i++;
		$('#unliketxt_' + postid).html(i);
		$('#unlikebutton_' + postid).attr("disabled", "disabled");
		$('#unlikebutton_' + postid).removeAttr('onclick');
	};
	__.facebook.bad = function(postid, tags) {
		var i = $('#badtxt_' + postid).html();
		i++;
		$('#badtxt_' + postid).html(i);
		$('#badbutton_' + postid).attr("disabled", "disabled");
		$('#badbutton_' + postid).removeAttr('onclick');
	};

	__.facebook.share = function(postid) {

		__.facebooky.post.message = $('#message_' + postid).val();
		__.facebooky.post.link = $('#link_' + postid).val();
		__.facebooky.post.caption = $('#caption_' + postid).val();
		__.facebooky.post.linkname = $('#name_' + postid).val();
		__.facebooky.post.description = $('#description_' + postid).val();
		__.facebooky.post.picture = $('#picture_' + postid).val();

		__.facebooky.wallDisplay();
	};

	if (!(!!__.getValue("accesstoken") || !!__.getValue("member_name"))) {
		__.facebook.loadFeeds();
	}

	$(document).on("site/member/changed", function(e, args) {
		__.facebook.loadFeeds();
	});

});
