function first(){
	var frm;
	frm = eval(frmName);
	if(parseInt(frm.pageth.value)<=1)
		return;
	frm.pageth.value = 1;
	frm.submit();
}
function pre(){
	var frm;
	frm = eval(frmName);
	if(parseInt(frm.pageth.value)<=1)
		return;
	frm.pageth.value = frm.pageth.value-1;
	frm.submit();
}
function next(){
	var frm;
	frm = eval(frmName);
	if(parseInt(frm.pageth.value)>=parseInt(frm.pageCnt.value))
		return;
	frm.pageth.value = parseInt(frm.pageth.value)+1;
	frm.submit();

}
function last(){
	var frm;
	frm = eval(frmName);
	if(parseInt(frm.pageth.value)>=parseInt(frm.pageCnt.value))
		return;
	frm.pageth.value = frm.pageCnt.value;
	frm.submit();
}
function del(){
	var frm;
	frm = eval(frmName);
	frm.action.value = "del";
	frm.submit();
}