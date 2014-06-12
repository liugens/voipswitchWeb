var xmlhttp = null;
function sendUrl(url,callback,parameter)
{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.setrequestheader("content-length",parameter.length); 

	xmlhttp.send(parameter);
	xmlhttp.onreadystatechange= callback;
}
function sendUrlGet(url,callback,parameter)
{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.open("GET",url + "?" + parameter, true);
	xmlhttp.send();
	xmlhttp.onreadystatechange= callback;
}

