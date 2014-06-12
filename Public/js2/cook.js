function writeCookie(name, value, hours){
	var expire = "";
	if(hours != null)
	{
		expire = new Date((new Date()).getTime() + hours * 3600000);
		expire = "; expires=" + expire.toGMTString();
	}
	document.cookie = name + "=" + escape(value) + expire;
}
function readCookie(name){
	var cookieValue = "";
	var search = name + "=";
	if(document.cookie.length > 0)
	{ 
		offset = document.cookie.indexOf(search);
		if (offset != -1)
		{ 
			offset += search.length;
			end = document.cookie.indexOf(";", offset);
			if (end == -1) end = document.cookie.length;
			cookieValue = unescape(document.cookie.substring(offset, end))
		}
	}
	return cookieValue;
}
function delCookie(name){
	document.cookie = sName + "=" + escape(sValue) + "; expires=Fri, 31 Dec 1999 23:59:59 GMT;";

}
var cookArray = new Array();
var CALL_LAST = "CALL_LAST";
var CALL_TODAY = "CALL_TODAY";
var CALL_CNT = "CALL_CNT";
var CALL_NUM = "CALL_NUM";
cookArray[cookArray.length - 1] = CALL_LAST;
cookArray[cookArray.length - 1] = CALL_TODAY;
cookArray[cookArray.length - 1] = CALL_CNT;
cookArray[cookArray.length - 1] = CALL_NUM;
function delAll(){
	for(var i=0;i<cookArray.length;i++)
		delCookie(cookArray[i]);
}