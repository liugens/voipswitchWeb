// JavaScript Document
var selectbox="";


function overbox(boxname)
{
	/*if(boxname=="qzzd")
	{
		alert("document.all."+boxname+".className='outlineOver';");
		return;
	}*/
	
	if(selectbox!=boxname)
	{
	eval("document.all."+boxname+".className='outlineOver';");
	}

return;	
}


function overoutbox(boxname)
{
	
	if(selectbox!=boxname)
	{
	eval("document.all."+boxname+".className='outlineNormal';");
	}

	return;	
}

function mousedownbox(boxname)
{
	
	if(selectbox!="")
	{
	eval("document.all."+selectbox+".className='outlineNormal';");
	}
	eval("document.all."+boxname+".className='outlineSelect';");
	selectbox=boxname;

	return;	
}

function swappic(picname)
{
	for(var i=0;i<objArr.length;i++){
		if(typeof(eval("document.all."+objArr[i]))!="undefined"){
			if(objArr[i]!=picname){
				eval("document.all."+objArr[i]+".src='img/plus.gif';");
				eval(objArr[i].replace("2","")+"smbox.style.display='none';");
			}
		}
	}
	var paths;
	var picpaths;
	paths="img/plus.gif";
	picpaths=eval("document.all."+picname+".src");
	picpaths=picpaths.toString();
	

	var smboxname;
	
	smboxname=picname.replace("2","")+"smbox";
	
	if(picpaths.indexOf(paths)>-1)
	{
	eval("document.all."+picname+".src='img/nofollow.gif';");
	eval(smboxname+".style.display='inline';");
	}
	else
	{
	eval("document.all."+picname+".src='img/plus.gif';");
	eval(smboxname+".style.display='none';");
	}
	
	
	return;
}



