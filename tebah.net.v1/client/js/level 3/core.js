var db = function()
{
};

db.select_option_tmp = '<script type="text/x-jquery-tmpl"><option class=" ${css}" value="${value}">${text}</option></script>';
db.gender = [
{
	text : "male",
	value : 1,
},
{
	text : "female",
	value : 2,
}];

CORE = function()
{

	if (this === window)
	{
		return new CORE();
	}

	this.data =
	{
	};

};

core = new CORE();
window.__ = window.core;

if ( typeof String.prototype.startsWith != 'function')
{

	String.prototype.startsWith = function(str)
	{
		return this.indexOf(str) == 0;
	};
}

$(function()
{

	CORE.prototype.to$ = function(name)
	{

		if ( typeof name === 'string')
		{
			if (name.startsWith('<'))
			{
				return $(name);
			}

			if (name.startsWith('#') || name.startsWith('.'))
			{
			}
			else
			{
				name = '#' + name;
			}
			return $(name);
		}
		return $(name);
	};

	CORE.prototype.call = function(fn_name)
	{

	};
	CORE.prototype.tmp = function()
	{

	};
	CORE.prototype.trigger = function(event, data, func, callback)
	{

		if (!!func)
		{
			$(document).on(event, function(e, args)
			{
				func(args);
			});
		}
		else
		{
			$(document).trigger(event, data);
		}

	};
	CORE.prototype.isDevelopmentMode = function()
	{
		return __SITEDATA.config.isDevelopmentMode;
	};
	CORE.prototype.isOnlineMode = function()
	{
		return __SITEDATA.config.isOnlineMode;
	};
	CORE.prototype.isDemoMode = function()
	{
		return __SITEDATA.config.isDemoMode;
	};
	CORE.prototype.webSiteURL = function()
	{
		return __SITEDATA.config.webSiteURL;
	};
	CORE.prototype.webServicesURL = function()
	{
		return __SITEDATA.config.webServicesURL;
	};

	CORE.prototype.log = function(msg)
	{
		if (this.isDevelopmentMode())
		{
			console.log(msg);
		}
	};
	CORE.prototype.logErr = function(msg)
	{
		if (this.isDevelopmentMode())
		{
			console.error(msg);
		}
	};
	CORE.prototype.logWarn = function(msg)
	{
		if (this.isDevelopmentMode())
		{
			console.warn(msg);
		}
	};
	CORE.prototype.logInfo = function(msg)
	{
		if (this.isDevelopmentMode())
		{
			console.info(msg);
		}
	};
	CORE.prototype.logAction = function(arg)
	{
		__.log("log Action  : " + arg + "");
	};
	CORE.prototype.logEvent = function(arg)
	{
		__.logInfo("log Event  : " + arg);
	};

	CORE.prototype.ajax = function(option, onSuccess, onError, OnComplete)
	{

		if (!!option && !!option.serviceName)
		{
			var _url = __.webServicesURL() + "/" + option.serviceName + ".php";
		}
		else
		{
			return false;
		}

		__.log("service post : " + _url);

		$.ajax(
		{
			url : _url,
			data : option,
			type : "POST",
			dataType : "json",
			crossDomain : true,
			timeout : 60000,
			success : function(data, textStatus, jqXHR)
			{
				if (!!data && !!onSuccess)
				{
					onSuccess(data, textStatus, jqXHR);
				}

			},
			error : function(jqXHR, textStatus, errorThrown)
			{
				if (!!onError)
				{
					onError(errorThrown, textStatus, jqXHR);
				}

				__.logErr("__.ajax Error on [" + option.serviceName + "]   for : " + errorThrown);
			},
			complete : function(jqXHR, textStatus)
			{
				if (!!OnComplete)
				{
					OnComplete(textStatus, jqXHR);
				}

				__.logInfo("__.ajax  Complete on [" + option.serviceName + "]  with : " + textStatus);
			}
		});
		return true;

	};

	CORE.prototype.layoutBodyDiv = function()
	{
		__.logErr('Not Implement...');
	};
	CORE.prototype.layoutHeaderDiv = function()
	{
		__.logErr('Not Implement...');
	};
	CORE.prototype.layoutLeftDiv = function()
	{
		__.logErr('Not Implement...');
	};
	CORE.prototype.layoutContentDiv = function()
	{
		__.logErr('Not Implement...');
	};
	CORE.prototype.layoutRightDiv = function()
	{
		__.logErr('Not Implement...');
	};
	CORE.prototype.layoutFooterDiv = function()
	{
		__.logErr('Not Implement...');
	};

	CORE.prototype.hideContentDiv = function()
	{
		__.logErr('Not Implement...');
	};
	CORE.prototype.showContentDiv = function()
	{
		__.logErr('Not Implement...');
	};
	CORE.prototype.appendToContentDiv = function(obj)
	{
		__.logErr('Not Implement...');
	};
	CORE.prototype.getLoadingImage = function()
	{
		__.logErr('Not Implement...');
	};

	CORE.prototype.soon = function()
	{
		__.logErr('Not Implement...');
	};
	CORE.prototype.activateSecurity = function()
	{
		__.logErr('Not Implement...');
	};
	CORE.prototype.getMemberId = function()
	{
		__.logErr('Not Implement...');
	};

	CORE.prototype.updateInterface = function()
	{
		__.logErr('Not Implement... [updateInterface]');
	};
	CORE.prototype.updateTheme = function(name)
	{
		__.logErr('Not Implement... [updateTheme]');
	};
	CORE.prototype.updateLanguage = function(name)
	{
		__.logErr('Not Implement... [updateLanguage]');
	};

	CORE.prototype.spy = function(data)
	{

		return hash(data);
	};
	CORE.prototype.unspy = function(data)
	{

		return unhash(data);
	};

	CORE.prototype.getParameterByName = function(name)
	{
		name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
		var regexS = "[\\?&]" + name + "=([^&#]*)";
		var regex = new RegExp(regexS);
		var results = regex.exec(window.location.search);
		if (results === null)
		{
			return "";
		}
		else
			return decodeURIComponent(results[1].replace(/\+/g, " "));
	};
	CORE.prototype.urlMaker = function(str)
	{
		if (str === null)
			return null;
		var str2 = str;

		str2 = str.replace(/\b((http|https|ftp):\/\/\S+)/g, '<a href="$1" target="_blank">$1</a>');

		if (str2 === str)
		{
			str2 = str.replace(/\b((www)\.\S+)/g, '<a href="http://$1" target="_blank">$1</a>');
		}

		str2 = str2.replace('\n', '          ');
		//str2 = str2.replace(/\b#\S+/g, '<a href="https://twitter.com/search?q=$1"
		// target="_blank">$1</a>');

		return str2;
	};
	CORE.prototype.relativeTime = function(delta)
	{

		delta = (delta * 1000) - (1 * 60 * 60 * 1000);

		if (delta <= 10000)
		{
			return 'منذ قليل';
		}

		var units = null;

		var conversions =
		{
			millisecond : 1,
			ثانية : 1000,
			دقيقة : 60,
			ساعة : 60,
			يوم : 24,
			شهر : 30,
			سنة : 12
		};

		for (var key in conversions)
		{
			if (delta < conversions[key])
			{
				break;
			}
			else
			{
				units = key;
				delta = delta / conversions[key];
			}
		}

		delta = Math.floor(delta);

		return [" منذ ", delta, units].join(' ');

	};
	CORE.prototype.setCookie = function(c_name, value, exdays)
	{
		var exdate = new Date();
		exdate.setDate(exdate.getDate() + exdays);
		var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
		document.cookie = c_name + "=" + c_value;
	};
	CORE.prototype.getCookie = function(c_name)
	{
		var c_value = document.cookie;
		var c_start = c_value.indexOf(" " + c_name + "=");
		if (c_start == -1)
		{
			c_start = c_value.indexOf(c_name + "=");
		}
		if (c_start == -1)
		{
			c_value = null;
		}
		else
		{
			c_start = c_value.indexOf("=", c_start) + 1;
			var c_end = c_value.indexOf(";", c_start);
			if (c_end == -1)
			{
				c_end = c_value.length;
			}
			c_value = unescape(c_value.substring(c_start, c_end));
		}

		return c_value;
	};

	CORE.prototype.getValue = function(name)
	{
		if (!!__.getParameterByName(name))
		{
			return __.getParameterByName(name);
		}
		if (!!__.getCookie(name))
		{
			return __.unspy(__.getCookie(name));
		}

	};
	CORE.prototype.setValue = function(name, value)
	{
		__.setCookie(name, __.spy(value), 365);
	};

	CORE.prototype.newGuid = function()
	{
		return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c)
		{
			var r = Math.random() * 16 | 0, v = c == 'x' ? r : r & 0x3 | 0x8;
			return v.toString(16);
		});
	};
	CORE.prototype.newKey = function()
	{
		return hash(newGuid());
	};
	CORE.prototype.tmp2html = function(tmpName, data)
	{

		tmpName = __.to$(tmpName);

		var divtmp = tmpName.tmpl(data);
		return divtmp;
	};

	CORE.prototype.setSelect = function(selectId, value)
	{

		selectId = __.to$(selectId);

		selectId.find("option").filter(function()
		{
			return $(this).text() == value;
		}).attr('selected', true);
	};

	CORE.prototype.setSelect_val = function(selectId, value)
	{

		selectId = __.to$(selectId);

		selectId.find("option").filter(function()
		{
			return $(this).val() == value;
		}).attr('selected', true);
	};

	CORE.prototype.activateMaxLength = function()
	{
		return;
		$('input[maxlength]').maxlength(
		{
			alwaysShow : true,
			//  threshold: 10,
			//  warningClass: "label label-success",
			// limitReachedClass: "label label-important",
			//  separator: ' of ',
			//   preText: 'You have ',
			//  postText: ' chars remaining.',
			//  validate: true,
			placement : 'bottom'
		});
		this.log(" activateMaxLength();");
	};

	$(document).ajaxStart(function()
	{
		//__.logWarn("Triggered ajaxStart handler.");
	});
	$(document).ajaxSend(function(event, jqxhr, settings)
	{
		//__.logWarn("Triggered ajaxSend handler.");
	});
	$(document).ajaxSuccess(function(event, xhr, settings)
	{
		//__.logWarn("Triggered ajaxSuccess handler.");
	});
	$(document).ajaxError(function(event, jqxhr, settings, exception)
	{
		//__.logWarn("Triggered ajaxError handler.");
	});
	$(document).ajaxComplete(function(event, xhr, settings)
	{
		//__.logWarn("Triggered ajaxComplete handler.");
	});
	$(document).ajaxStop(function()
	{
		//__.logWarn("Triggered ajaxStop handler.");
	});

	__.trigger("template/activated", null, function(args)
	{
		__.logInfo("New Template Activated :  " + args + "  ...");
	});

	__.trigger("site/newContent", null, function()
	{
		__.activateMaxLength();
		$("[tooltip-ar]").tooltip(
		{
			placement : 'bottom',
			html : true
		});
		$("[tooltip-en]").tooltip(
		{
			placement : 'bottom',
			html : true
		});
	});

	__.trigger("site/goto/top", null, function(argument)
	{
		$('html, body').animate(
		{
			scrollTop : '0px'
		}, 200);
	});

	__.trigger("site/data/reset", null, function function_name(argument)
	{
		__.ajax(
		{
			serviceName : "site.data",
			method : "all"
		}, function(data)
		{
			__SITEDATA = data;
			__.data = __SITEDATA;
			__.trigger('site/data');
		});
	});

});
