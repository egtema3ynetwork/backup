
<script type="text/javascript">

function utf8encode(strUni)
{

	if (!strUni)
		return "";

	var strUtf = strUni.replace(/[\u0080-\u07ff]/g, function(c)
	{
		var cc = c.charCodeAt(0);
		return String.fromCharCode(0xc0 | cc >> 6, 0x80 | cc & 0x3f);
	}).replace(/[\u0800-\uffff]/g, function(c)
	{
		var cc = c.charCodeAt(0);
		return String.fromCharCode(0xe0 | cc >> 12, 0x80 | cc >> 6 & 0x3F, 0x80 | cc & 0x3f);
	});
	return strUtf;
}

function utf8decode(strUtf)
{

	var strUni = strUtf.replace(/[\u00e0-\u00ef][\u0080-\u00bf][\u0080-\u00bf]/g, 

	function(c)
	{

		var cc = ((c.charCodeAt(0) & 0x0f) << 12) | ((c.charCodeAt(1) & 0x3f) << 6) | (c.charCodeAt(2) & 0x3f);
		return String.fromCharCode(cc);
	}).replace(/[\u00c0-\u00df][\u0080-\u00bf]/g, function(c)
	{

		var cc = (c.charCodeAt(0) & 0x1f) << 6 | c.charCodeAt(1) & 0x3f;
		return String.fromCharCode(cc);
	});
	return strUni;
}

function hash(input)
{
	if (!input)
		return "";

	input = utf8encode(input);

	var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

	var output = "";
	var chr1, chr2, chr3 = "";
	var enc1, enc2, enc3, enc4 = "";
	var i = 0;

	do
	{
		chr1 = input.charCodeAt(i++);
		chr2 = input.charCodeAt(i++);
		chr3 = input.charCodeAt(i++);

		enc1 = chr1 >> 2;
		enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
		enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
		enc4 = chr3 & 63;

		if (isNaN(chr2))
		{
			enc3 = enc4 = 64;
		}
		else if (isNaN(chr3))
		{
			enc4 = 64;
		}

		output = output + keyStr.charAt(enc1) + keyStr.charAt(enc2) + keyStr.charAt(enc3) + keyStr.charAt(enc4);
		chr1 = chr2 = chr3 = "";
		enc1 = enc2 = enc3 = enc4 = "";
	}
	while (i < input.length);

	return output;
}

function unhash(input)
{
	var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
	if (!input)
		return "";

	var output = "";
	var chr1, chr2, chr3 = "";
	var enc1, enc2, enc3, enc4 = "";
	var i = 0;

	input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

	do
	{
		enc1 = keyStr.indexOf(input.charAt(i++));
		enc2 = keyStr.indexOf(input.charAt(i++));
		enc3 = keyStr.indexOf(input.charAt(i++));
		enc4 = keyStr.indexOf(input.charAt(i++));

		chr1 = (enc1 << 2) | (enc2 >> 4);
		chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
		chr3 = ((enc3 & 3) << 6) | enc4;

		output = output + String.fromCharCode(chr1);

		if (enc3 != 64)
		{
			output = output + String.fromCharCode(chr2);
		}
		if (enc4 != 64)
		{
			output = output + String.fromCharCode(chr3);
		}

		chr1 = chr2 = chr3 = "";
		enc1 = enc2 = enc3 = enc4 = "";

	}
	while (i < input.length);
	output = utf8decode(output);
	return output;
}

</script>