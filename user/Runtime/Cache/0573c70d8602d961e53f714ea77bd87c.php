<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>voippubWeb For voipswitch by liugens</title>
<link href="__PUBLIC__/css/voippub.css" rel="stylesheet" type="text/css"/></head>
<body>
<div class="main"><div class="msgDiv">
<h3>voippubWeb </h3>
<form class="form" name="PreIndex" method="get" action="__URL__/checkLogin/">
<p>
卡号:<input type="text" name="login"  value="" size="15" maxlength="15"/> <br />
密码:<input type="text" name="password"  value="" size="12" maxlength="12"/><br />
<input name="Submit" class="submit" type="submit" value="登录"/>
<br />
<a href="__URL__/reg/" >注册</a> &nbsp;<a href="__URL__/lostpwd/" >忘记密码</a><br />
<a href="__URL__/dcall/" >预约</a>&nbsp;<a href="__URL__/getba/" >查余额</a>
</p>

</form> 
</div>
</div>
</body>
</html>