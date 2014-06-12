<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>主叫变号</title>
<link href="__PUBLIC__/css/voippub.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="main"><div class="msgDiv">
<h3><?php echo ($login); ?>主叫变号 </h3>

<p>
<form class="form" name="PreIndex" method="post" action="__URL__/showCallerRet/">
<input type="text" name="phone_number"  value="<?php echo ($myphone); ?>"/> <br/>
<input type="hidden" name="id_client"  value="<?php echo ($id_client); ?>" /> <br/>

<input name="Submit" class="submit" type="submit" value="修改"/><br/>
<p><a href="javascript:history.go(-1);">前页</a>&nbsp;<a href="__URL__/main/" >首页</a></p></p>
</form> 
</div>
</div>
</body>
</html>