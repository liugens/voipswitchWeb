<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> voippub </TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<link href="__PUBLIC__/style/style.css" rel="stylesheet" type="text/css" />
</head>
<body id="page">

<strong>修改代理：</strong>
<form name="form1" method="post" action="?phone=<?php echo ($phone); ?>&action=md">
<TABLE border=1>
  <TR>
	<TD width="115">代理手机：</TD>
	<TD width="160">
	  <input name="agtphone" type="text" id="agtphone" value="<?php echo ($phone); ?>" readonly="readonly" size="16" maxlength="16"></TD>
	</TR>
<TR>
	<TD>代理密码：不改密码请留空</TD>
	<TD><input name="agpwd" type="text" id="agpwd" size="10" maxlength="10"></TD>
	</TR>
<TR>
	<TD>代理名称：</TD>
	<TD><input name="agname" type="text" id="agname" size="16" maxlength="16"></TD>
	</TR>
<TR>
	<TD>&nbsp;</TD>
	<TD><?php echo ($adret); ?></TD>
	</TR>
	<TD>&nbsp;</TD>
	<TD><input type="submit" name="添加" id="添加" value="提交"></TD>
	</TR>
</TABLE>
</form>

</BODY>
</HTML>