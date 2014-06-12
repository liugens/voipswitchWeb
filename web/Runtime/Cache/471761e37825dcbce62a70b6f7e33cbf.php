<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> skypecallback </TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<link href="__PUBLIC__/style/style.css" rel="stylesheet" type="text/css" />
</head>
<body id="page">

<p><table width="810" border="0">
  <tr>
    <td width="407"><strong>增加代理：</strong><form name="form2" method="post" action="__URL__/addagentret">
  <TABLE border=1>
  <TR>
	<TD width="115">代理手机：</TD>
	<TD width="160">
	  <input name="agtphone" type="text" id="agtphone" value="<?php echo ($phone); ?>" size="16" maxlength="16"></TD>
	</TR>
<TR>
	<TD>代理密码：</TD>
	<TD><input name="agpwd" type="password" id="agpwd" size="10" maxlength="10"></TD>
	</TR>
<TR>
	<TD>代理名称：</TD>
	<TD><input name="agname" type="text" id="agname" size="16" maxlength="16"></TD>
	</TR>
<TR>
	<TD>初始金额：</TD>
	<TD><input name="money" type="text" id="money" value="0" size="6" maxlength="6"></TD>
	</TR>
<TR>
	<TD>&nbsp;</TD>
	<TD><input type="submit" name="添加" id="添加" value="提交"></TD>
	</TR>
</TABLE>
</form></td>
    <td width="345" valign="top"><strong>给代理商充值：</strong>
<form name="form1" method="post" action="__URL__/agentczret">
  <TABLE border=1>
  <TR>
	<TD width="115">代理手机：</TD>
	<TD width="160">
	  <input name="agtphone" type="text" id="agtphone" value="<?php echo ($phone); ?>" size="16" maxlength="16"></TD>
	</TR>
<TR>
  <TD>充值金额：</TD>
  <TD><input name="money" type="text" id="money" value="10" size="6" maxlength="6"></TD>
</TR>
<TR>
	<TD>&nbsp;</TD>
	<TD><input type="submit" name="添加" id="添加" value="提交"></TD>
	</TR>
</TABLE>
</form>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table></p>


</BODY>
</HTML>