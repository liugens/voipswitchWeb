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
<script>

</script>
<body id="page">

<p><strong>用户号码过滤：</strong>
<form name="form1" method="post" action="?">
  <TABLE border=1>
  <TR>
	<TD colspan="3">查询选定用户号码，不用加0和+86</TD>
	</TR>
<TR>
  <TD width="100">用户号码</TD>
  <TD width="239"><input name="phone" type="text" id="phone" size="16" maxlength="16"></TD>
  <TD width="153"><input type="submit" name="查询" id="查询" value="查询"></TD>
</TR>
</TABLE>
</form>&nbsp;</p>
<p><strong>我的用户：</strong>
  
</p>
<TABLE border=1 onMouseOver="changeto()"  onmouseout="changeback()">
  <TR>
	<th width="110" >用户名</th>
	<th width="80">密码</th>
	<th width="80">绑定号</th>
    <th width="100" >余额</th>
	<th width="80">email</th>
	<th width="80">QQ</th>
    <th width="240">操作</th>
	</TR>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr>
<td><?php echo ($vo["login"]); ?> </td>
<td><?php echo ($vo["password"]); ?> </td>
<td><?php echo ($vo["PhoneNum"]); ?> </td>
<td><?php echo ($vo["account_state"]); ?> </td>
<td><?php echo ($vo["email"]); ?> </td>
<td><?php echo ($vo["qq"]); ?> </td>
<td><a href="__URL__/agent2user?phone=<?php echo ($vo["PhoneNum"]); ?>">充值</a>&nbsp;
<a href="__URL__/agentMduser?phone=<?php echo ($vo["PhoneNum"]); ?>">修改</a>
</td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</TABLE>
<TABLE border=1 width="840">
  <TR>
	<td>
	分页:<?php echo ($pagenum); ?>
	</td>
	</TR>

</TABLE>

</BODY>
</HTML>