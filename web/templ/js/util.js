var iMaxLen=32;
var MinMilli = 1000 * 60;       // 初始化变量。
var HrMilli = MinMilli * 60;
var DyMilli = HrMilli * 24;

function on_load(){
	frm = eval(frmName);
	if(frm.msg.value != "") {
		if(frm.msg.value=="error"){
			alert("您的配置文件有错误，请与杭州普博公司联系！");
		}else{
			alert(frm.msg.value);
		}
	}
	frm.msg.value="";
	if(frm.close)
		if(frm.close.value=="1")
			window.close();
	if(frm.sub){
		if(frm.sub.value=="1" && opener)
			opener.frm.submit();
	}
	
	try{
		if(parent != null && parent.version>=2){
			var table = t_main;
			var rows = table.rows;
			for(var i=1;i<rows.length;i++){
				if(i % 2==0){
					rows(i).bgColor ="#D5D5D5";
				}else{
					rows(i).bgColor ="#F3F3F3";
				}
				
			}
		}
	}catch(e){
	}
}
function addZero(num,len){
	var sNum = num;
	if(num.length>len){
		return num.substring(0,len);
	}
	for(var i=0;i<len-num.length;i++){
		sNum = "0" +"" + sNum;
	}
	return sNum;
}
function noExist(e){
	if(typeof(e)=='undefined')
		return true;
	else
		return false;
}
function setChkReadOnly(chk,readonly){
	var only;
	if(readonly==0)
		only = false;
	else
		only = true;
	if(noExist(chk.length)){
		chk.disabled = only;
	}else{
		for(var i=0;i<chk.length;i++){
			chk[i].disabled = only;
		}
	}
}
function setBitChk(chk,n){
	if(noExist(chk)){
		return "";
	}
	if(noExist(n))
		return "";
	if(noExist(chk.length)){
		if((chk.value & n)==0)
			chk.checked = false;
		else
			chk.checked = true;
		return;
	}

	for(var i=0;i<chk.length;i++){
		//alert('bb');
		if((chk[i].value & n)==0)
			chk[i].checked = false;
		else
			chk[i].checked = true;
	}
}
function getBitChk(chk){
	var n=0;
	if(!chk)
		return;
	if(!chk.length){
		if(chk.checked)
			n=n|chk.value;
		return n;
	}
	for(var i=0;i<chk.length;i++){
		if(chk[i].checked){
			n=n|chk[i].value;
		}
	}
	return n;
}

function setSchBitChk(chk,n){
	if(!chk)
		return;
	if(!n)
		return;
	if(noExist(chk.length)){
		if(chk.value == n)
			chk.checked = true;
		return;
	}
	var key = n.split(",");
	for(var i=0;i<chk.length;i++){
		for(var t=0;t<key.length;t++){
			if(chk[i].value == key[t])
				chk[i].checked = true;
		}
	}
}
function getSchBitChk(chk){
	if(!chk)
		return "";
	var n="";
	if(noExist(chk.length)){
		if(chk.checked)
			return chk.value;
		else
			return "";
	}
	for(var i=0;i<chk.length;i++){
		if(chk[i].checked){
			n=n + "," + chk[i].value;
		}
	}
	return n.substring(1);
}
function getDateTime(sInputName,iType){
	var o=eval(sInputName);
	var a=window.showModalDialog('calendar.jsp?type='+iType,null,'status:no;center:yes;help:no;minimize:no;maximize:no;border:thin;statusbar:no;dialogWidth:222px;dialogHeight:'+(iType==1?'295px':'321px'));
	if(a)
		o.value=a;
	else
		o.value="";
}
function getMonth(){
	var today=new Date;
	var month;
	month = today.getMonth() + 1;
	if(month < 10)
		month="0" + "" + month;
	return (today.getFullYear() + "-" + month +"-01");
}
function getLastMonth(){
	var today=new Date;
	today.setMonth(today.getMonth()-1);
	var month;
	month = today.getMonth() + 1;
	if(month < 10)
		month="0" + "" + month;
	return (today.getFullYear() + "-" + month +"-01");
}

function getToday(){
	var today=new Date;
	var month;
	month = today.getMonth() + 1;
	if(month < 10)
		month="0" + "" + month;
	var day =  today.getDate();
	if(day < 10)
		day="0" + "" + day;
	return (today.getFullYear() + "-" + month +"-" + day);
}
function getWeek(){
	var today=new Date;
	if(today.getDay()!=0)
		today.setDate(today.getDate()-(today.getDay()-1));
	else
		today.setDate(today.getDate()-6);
	var month;
	month = today.getMonth() + 1;
	if(month < 10)
		month="0" + "" + parseInt(month);
	var day;
	day = today.getDate();
	if(day < 10)
		day="0" + "" + parseInt(day);
	return (today.getFullYear() + "-" + month +"-"+day);
}
function formatDate(date){
	var today=date;
	var month;
	month = today.getMonth() + 1;
	if(month < 10)
		month="0" + "" + month;
	var day =  today.getDate();
	if(day < 10)
		day="0" + "" + day;
	return (month +"-" + day + "-" + today.getFullYear() + " " 
		+ today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds());
}
function isNull(s){
	if(s==null || s=="")
		return true;
	else
		return false;
}

var SER_CALLBACK = 2;
var SER_800 = 4;
function OptClick(c){

	if(!frm.chkOpt.length)
		return;
	if(c.value==SER_CALLBACK){
		for(var i=0;i<frm.chkOpt.length;i++){
			if(frm.chkOpt[i].value == SER_800 && c.checked)
				frm.chkOpt[i].checked = false;
		}
	}
	if(c.value==SER_800){
		for(var i=0;i<frm.chkOpt.length;i++){
			if(frm.chkOpt[i].value == SER_CALLBACK && c.checked)
				frm.chkOpt[i].checked = false;
		}
	}
}
function isTime(t){
	if(t.indexOf(":") != 2){
		return false;
	}
	if(isNaN(t.substring(0,2)) || isNaN(t.substring(3,5)))
		return false;
	//alert(t);
	//alert(t.substring(3,5));
	var hour = parseInt(t.substring(0,2));
	var mini = parseInt(t.substring(3,5));
	if(hour>23 || hour<0)
		return false;
	//alert(mini);
	if(mini>59 || mini<0)
		return false;
	return true;
}
function help(url){
	if(url!=null && url != "")
		window.open(url);
	else
		window.open("http://www.pooplesoft.com/help/"+frm.name + ".jsp");
}