$(function()
{

	__.customer.regions = [];
	__.customer.centrals = [];
	__.customer.providers = [];
	__.customer.limits = [];
	__.customer.speeds = [];
	__.customer.ip_counts = [];
	__.customer.payment_types = [];
	__.customer.offers = [];
	__.customer.resellers = [];
	__.customer.isps = [];
	__.customer.branches = [];

	__.customer.loadLookup = function(object, onSuccess, onError, OnComplete)
	{

		__.ajax(
		{
			serviceName : "site.customer",
			object : object,
			method : "all"
		}, onSuccess, onError, OnComplete);
	};

	__.customer.loadalllookupdata = function()
	{

		__.customer.resellers = __.data.reseller_view_list;
		__.customer.isps = __.data.isp_view_list;
		__.customer.regions = __.data.region_view_list;
		__.customer.centrals = __.data.central_view_list;
		__.customer.providers = __.data.provider_view_list;
		__.customer.limits = __.data.limit_view_list;
		__.customer.speeds = __.data.speed_view_list;
		__.customer.ip_counts = __.data.ip_count_view_list;
		__.customer.payment_types = __.data.payment_types_view_list;
		__.customer.offers = __.data.offer_view_list;
		__.customer.branches = __.data.branch_view_list;

		return;

		__.customer.loadLookup("site.region", function(data)
		{
			$.each(data.data, function(index, value)
			{
				value["text"] = value["region_name"];
				value["value"] = value["id"];
			});
			__.customer.regions = data.data;
		});

		__.customer.loadLookup("site.central", function(data)
		{
			$.each(data.data, function(index, value)
			{
				value["text"] = value["central_name"];
				value["value"] = value["id"];
			});
			__.customer.centrals = data.data;
		});

		__.customer.loadLookup("site.provider", function(data)
		{
			$.each(data.data, function(index, value)
			{
				value["text"] = value["provider_name"];
				value["value"] = value["id"];
			});
			__.customer.providers = data.data;
		});

		__.customer.loadLookup("site.limit", function(data)
		{
			$.each(data.data, function(index, value)
			{
				value["text"] = value["limit_name"];
				value["value"] = value["id"];
			});
			__.customer.limits = data.data;
		});

		__.customer.loadLookup("site.speed", function(data)
		{
			$.each(data.data, function(index, value)
			{
				value["text"] = value["speed_name"];
				value["value"] = value["id"];
			});
			__.customer.speeds = data.data;
		});

		__.customer.loadLookup("site.ip_count", function(data)
		{
			$.each(data.data, function(index, value)
			{
				value["text"] = value["name"];
				value["value"] = value["id"];
			});
			__.customer.ip_counts = data.data;
		});

		__.customer.loadLookup("site.payment_type", function(data)
		{
			$.each(data.data, function(index, value)
			{
				value["text"] = value["name"];
				value["value"] = value["id"];
			});
			__.customer.payment_types = data.data;
		});

		__.customer.loadLookup("site.offer", function(data)
		{
			$.each(data.data, function(index, value)
			{
				value["text"] = value["name"];
				value["value"] = value["id"];
			});
			__.customer.offers = data.data;
		});

		__.customer.loadLookup("site.branch", function(data)
		{
			$.each(data.data, function(index, value)
			{
				value["text"] = value["name"];
				value["value"] = value["id"];
			});
			__.customer.branches = data.data;
		});

	};

	__.trigger('layout/ready', null, function(argument)
	{
		__.customer.loadalllookupdata();
	});

});
