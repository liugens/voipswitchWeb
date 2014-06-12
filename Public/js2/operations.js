var operations = new Array();
var isPrint = {};
function Operation(operName,url,acctId){
	this.operName = operName;
	this.url = url;
	this.acctId = acctId;
}
function isOperExist (operName,oper){
	if(isPrint[operName]==null || isPrint["operName"]==""){
		isPrint[operName]=oper;
		return false;
	}else{
		return true;
	}
}