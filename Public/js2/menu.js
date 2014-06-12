var imgPlus = 'images/plus.gif';
var imgSub = 'images/nofollow.gif';
var imgChild = 'images/jiantou.gif';
var menu_begin = '<tr  name="%id_td"><td height="20"  class="border"  valign="bottom">' 
	+ '<table onclick="menu_onclick(this)" onmouseover="menu_mouseover(this)" onmouseout="menu_mouseout(this)" width="100%" height="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="32" align="right" valign="top">' + '<img name="%id_img" onclick="childExpand(this)" style="display:none;cursor:hand" src="' + imgPlus 
	+ '"></td><td  valign="bottom">';
/*var menu_end = '</td></table></td></tr><tr style="display:none" id="%id_menu" >' + 
	'<td class="border" >' +
	'<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="40" align="right" valign="top">&nbsp;' + 
	'</td><td  id="%id_child" valign="bottom">' + 
	'</td></tr></table></td>';
*/
var menu_end = '</td></table></td></tr><tbody id="%id_menu" style="display:none"></tbody>';
var child_begin = '<table onclick="menu_onclick(this)" onmouseover="menu_mouseover(this)" onmouseout="menu_mouseout(this)" width="100%" height="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" align="right" valign="middle">'
	+ '<img name="%id_img" src="'
	+ imgChild 
	+ '"></td><td  valign="bottom">';
var child_end = '</td></tr></table>';
var menu_array = new Array();
var selected = null;
function menu_mouseover(e){
	e.bgColor = "#cccccc";
}
function menu_mouseout(e){
	if(selected != e)
		e.bgColor = "#f3f3f3";
	else
		e.bgColor = "#e3e7ea";

}
function menu_onclick(e){
	e.bgColor = "#e3e7ea";
	if(selected != null)
		selected.bgColor = "#f3f3f3";
	selected = e;
}
function childExpand(e){
	var Id = e.name;
	
	var name = Id.substring(0,Id.indexOf("_"));
	closeAll(name);
	var menu = eval(name+"_menu");
	if(menu.style.display=="none"){
		e.src = imgSub;
		menu.style.display="block";
	}else{
		e.src = imgPlus;
		menu.style.display="none";
	}

}
function MN_Head()
{
	document.write('<table width="189" height="109%"  border="0" cellpadding="0" cellspacing="0">');
	document.write('<tr>');
	document.write('<td height="18"><img src="images/caidan.jpg" width="189" height="18"></td>');
	document.write('</tr>');
	document.write('<tr>');
	document.write('<td height="349" valign="top"><table width="175"  border="0" align="center" cellpadding="0" cellspacing="0">');
}
function MN_Tail()
{
	document.write('</table></td>');
	document.write('</tr>');
	document.write('</table>');
}
function MN_Exit(){
	document.write('<tr  style="cursor:hand" onclick="exit_onclick()">');
	document.write('<td height="20" valign="bottom" class="border"><table  cellpadding="0" cellspacing="0"><tr><td width="16"></td><td ><img src="images/tuichu.gif" width="13" height="13">&nbsp;退&nbsp;&nbsp;出</td></table></td>');
	document.write('</tr>');
	document.write('<tr>');
    document.write('<td height="23" valign="middle"><table  cellpadding="0" cellspacing="0"><tr><td width="16"></td><td><img src="images/bottom_caidan.jpg" width="175" height="23"></td></table></td>');
    document.write('</tr>');
}
function MN_Father(MNTxt,id,sURL)
{
	var txt = MNTxt;
	if(sURL && sURL!='')
		txt = addUrl(MNTxt,sURL);
	
	var innerHTML = "";
	if(!MNTxt) MNTxt = "";
		innerHTML = menu_begin +txt + menu_end;
	if(id && id !='' )
		innerHTML = replaceAll(innerHTML,'%id',id);
	
	document.write(innerHTML);
	if(id && id !='' ){
		menu_array.push(id);
	}
}
function closeAll(Id){
	for(var i=0;i<menu_array.length;i++){
		if(menu_array[i] != Id){
			var e = eval(menu_array[i]+"_img");
			var menu = eval(menu_array[i]+"_menu");
			e.src = imgPlus;
			menu.style.display="none";
		}
	}
}
function addUrl(MNTxt,sURL){
	var txt = MNTxt;
	if(sURL.indexOf("java")==-1)
		txt = '<a href="' + sURL + '" target="main">' + txt + '</a>';
	else
		txt = '<a href="#" onclick=' + sURL + '>' + txt + '</a>';
	
	return txt;
}
function replaceAll(src,txt,replaceTxt){
	var tmp = src;
	while(tmp.indexOf(txt)>-1)
		tmp = tmp.replace(txt,replaceTxt);
	return tmp;
}

function MN_Child(MNTxt,fatherId,id,sURL)
{
	var txt = MNTxt;
	if(sURL && sURL!='')
		txt = addUrl(MNTxt,sURL);
	var img = eval(fatherId + "_img");
	img.style.display = "block";
	var menu = eval(fatherId + "_menu");
	
	menu.insertRow();
	var tr = menu.rows[menu.rows.length-1];
	tr.insertCell();
	var td = menu.rows(menu.rows.length-1).cells(0);
	td.height = 20;
	td.className = "border";
	var innerHTML = child_begin + "&nbsp;" + txt + child_end;
	if(id && id !='' )
		innerHTML = replaceAll(innerHTML,'%id',id);
	td.innerHTML = innerHTML;

}