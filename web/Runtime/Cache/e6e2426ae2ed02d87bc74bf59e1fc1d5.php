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
<script type="text/javascript" src="__PUBLIC__/style/js2.js"></script>
</head>
<script language="javascript">
var msg;
msg="<?php echo ($addmsg); ?>";
if(msg!="") alert(msg);
</script>
<body id="page">
<form name="form1" method="post" action="?action=add">
<TABLE width="419" border=1>
  <TR>
	<TD width="165">您的充值卡前缀：</TD>
	<TD width="173"><?php echo ($cardprx); ?></TD>
	</TR>
  <TR>
    <TD>卡开始序号</TD>
    <TD><input name="start" type="text" id="start" value="<?php echo ($sta); ?>" size="5" maxlength="5"></TD>
  </TR>
  <TR>
  <TD>生成卡张数：</TD>
  <TD><input name="cardnum" type="text" id="agtphone" value="1" size="4" maxlength="4"></TD>
</TR>
<TR>
	<TD>金额：</TD>
	<TD><input name="money" type="text" id="money" value="10" size="6" maxlength="6"></TD>
	</TR>
<TR>
  <TD>&nbsp;</TD>
  <TD><input type="submit" name="添加" id="添加" value="生成充值卡"></TD>
</TR>
</TABLE>
</form>
<br><font color=red><b><?php echo ($addmsg); ?></b></font>
<br>
<strong>我的充值卡：<a href="__URL__/listcard"><font color="red">下载</font></a>到本地<br>

<TABLE border=1 onMouseOver="changeto()"  onmouseout="changeback()">
  <TR>
	<th width="110" >卡号</th>
	<th width="110">密码</th>
    <th width="100" >金额(元）</th>
	
    <th width="150">操作</th>
	</TR>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr>
<td><?php echo ($vo["cardNo"]); ?> </td>
<td><?php echo ($vo["pass"]); ?> </td>
<td><?php echo ($vo["money"]); ?> </td>

<td><a href="__URL__/agent2user?cardnum=<?php echo ($vo["cardNo"]); ?>&cardpwd=<?php echo ($vo["pass"]); ?>">充值</a></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</TABLE>

<TABLE border=1 width="640">
  <TR>
	<td>
	分页:<?php echo ($pagenum); ?>
	</td>
	</TR>

</TABLE>
</BODY>
</HTML>