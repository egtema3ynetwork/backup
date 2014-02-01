$(function() {

	CORE.prototype.google_search = function() {

		var _url = "http://tebah.net/search.php";

		$.ajax({
			url : _url,
			data : {
				q : "egtema3y.com"
			},
			type : "POST",
			dataType : "json",
			crossDomain : true,
			timeout : 60000,
			success : function(data, textStatus, jqXHR) {

				var tmp = __.tmp2html('#google-search-tmp', [1]);
				__.layout.content().html(tmp);
				$.each(data.responseData.results, function() {
					$('#google_search').append(this.content + "<hr>");
				});

			},
			error : function(jqXHR, textStatus, errorThrown) {
				$('#google_search').html(errorThrown);
			},
			complete : function(jqXHR, textStatus) {
				__.logInfo("ajax complete : " + textStatus);
				$(document).trigger("site/newContent");
			}
		});

	};

});

