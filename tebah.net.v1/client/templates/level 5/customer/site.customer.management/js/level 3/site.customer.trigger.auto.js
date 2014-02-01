$(function()
{

	__.trigger('customer/service/lookup/display', null, function(argument)
	{
		__.customer.serviceLookupDisplay();
	});

	__.trigger('customer/register/new/user', null, function(argument)
	{
		__.customer.newRegisterUser('');
	});

	__.trigger('customer/register/new', null, function(argument)
	{
		__.customer.newRegister('');
	});

	__.trigger('customer/manage', null, function(argument)
	{
		__.customer.manage();
	});

	__.trigger('customer/request/new', null, function(argument)
	{
		__.customer.newRequest('');
	});

});
