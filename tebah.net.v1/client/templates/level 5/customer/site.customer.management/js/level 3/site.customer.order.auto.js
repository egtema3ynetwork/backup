$(function()
{

	__.customer.newOrderDisplay = function(type)
	{

		var tmp = __.tmp2html('tebah-order-new-tmp', [1]);

		__.trigger("layout/content/set", tmp);
		$("#service_provider_id_").append(__.tmp2html(db.select_option_tmp, __.customer.providers));

		$("#service_speed_id_").append(__.tmp2html(db.select_option_tmp, __.customer.speeds));

	};
	
	__.customer.requestNewService = function  (argument) {
		var data = {};
		
		data.email = __.spy( $('#' + 'service_useremail' ).val());
		data.name = __.spy($('#' + 'service_username' ).val());
		data.phone_code = __.spy($('#' + 'service_phone_code' ).val());
		data.phone = __.spy($('#' + 'service_phone' ).val());
		data.mobile = __.spy($('#' + 'service_mobile' ).val());
		data.service_provider =__.spy( $('#' + 'service_provider_id_' + " option:selected").text());
		data.speed =__.spy( $('#' + 'service_speed_id_' + " option:selected").text());
		data.address = __.spy($('#' + 'service_address' ).val());
		
		
		data.serviceName =  "site.customer";
		data.object = "service.order";
		data.method = "new.request";
		$('#tebah-order-new-addbutton').html('Waiting ...');
		__.ajax(data,function(data){
			if(data.success)
			{
				$('#tebah-order-new-div').hide();
				$('#service_error_div').html('تم ارسال طلبك وسيتم الرد عليك قريبا');
			}
			
		});
	  
	};

});
