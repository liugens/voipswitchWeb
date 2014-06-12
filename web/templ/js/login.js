var frmName;
var frm;
frmName = "LoginForm";
function checkdate(){
	var frm;
	frm = LoginForm;
	if(!Check_Field(frm.txtUser,"string",frm.txtUser.value,false,iMaxLen,"请输入正确的用户名"))
		return;
	if(!Check_Field(frm.p2,"string",frm.p2.value,false,iMaxLen,"请输入正确的密码"))
		return;

	frm.txtPswd.value = frm.p2.value;
	frm.submit()
}
function bodyload(){
	on_load();
	frm.p2.value = "";
	frm.txtPswd.value="";
}
function key_press(){
	if(event.keyCode==13)
		checkdate();
}