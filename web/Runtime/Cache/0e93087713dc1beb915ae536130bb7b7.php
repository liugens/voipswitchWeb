<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>voippub web </TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<link href="__PUBLIC__/style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/style/js2.js"></script>
</head>

<body id="page">
<table width="764" border="0">
  <tr>
    <td width="386" height="208"><strong>给用户充值：</strong><br>
    <form name="form1" method="post" action="__URL__/agent2useret">
<TABLE border=1>
  <TR>
	<TD width="115">用户手机：</TD>
	<TD width="160">
	  <input name="phone" type="text" id="agtphone" value="<?php echo ($phone); ?>" size="16" maxlength="16"></TD>
	</TR>
<TR>
  <TD>初始金额：</TD>
  <TD><input name="money" type="text" id="money" value="10" size="6" maxlength="6"></TD>
</TR>
<TR>
	<TD><input type="submit" name="添加" id="添加" value="提交"></TD>
	<TD>&nbsp;</TD>
	</TR>
</TABLE>
</form></td>
    <td width="384"><strong>查询用户余额：</strong><br>
    <form name="form2" method="post" action="__URL__/agent2user">
      <TABLE border=1>
        <TR>
          <TD width="86">用户手机：</TD>
          <TD width="233"><input name="phone" type="text" id="agtphone" value="<?php echo ($phone); ?>" size="16" maxlength="16"></TD>
        </TR>
        <TR>
          <TD height="55">用户余额：</TD>
          <TD><font color="red"><?php echo ($usermoney); ?></font></TD>
        </TR>
        <TR>
          <TD>&nbsp;</TD>
          <TD><input type="submit" name="查询" id="查询" value="查询"></TD>
        </TR>
      </TABLE>
    </form></td>
  </tr>
  <tr>
    <td height="90"><strong>给用户充值：</strong><br>
    <form name="form3" method="post" action="__URL__/agent2user">
<TABLE border=1>
  <TR>
	<TD width="115">用户手机：</TD>
	<TD width="160">
	  <input name="phone" type="text" id="agtphone" value="<?php echo ($phone); ?>" size="16" maxlength="16"></TD>
	</TR>
<TR>
  <TD>充值卡号：</TD>
  <TD><input name="cardnum" type="text" id="cardnum" value="<?php echo ($cardnum); ?>" size="10" maxlength="10"></TD>
</TR>
<TR>
	<TD>充值卡密码</TD>
	<TD><input name="cardpwd" type="text" id="cardpwd" value="<?php echo ($cardpwd); ?>" size="10" maxlength="10"></TD>
	</TR>
<TR>
  <TD><input type="submit" name="充值" id="充值" value="提交"></TD>
  <TD><font  color="#FF0000" ><?php echo ($acardret); ?></font></TD>
</TR>
</TABLE>
</form>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>




</BODY>
</HTML>