<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理界面</title>
<link href="__PUBLIC__/style/style.css" rel="stylesheet" type="text/css" />
</head>
<body id="login">
<form action="__URL__/Login/" id="loginForm" METHOD="POST" >
  <h3>管理系统</h3>
  <label for="userName"><span>代理手机号：</span>
    <input id="userName" name="userName" type="text" />
  </label>
  <label for="passWord"><span>密码：</span>
    <input name="passWord" id="passWord" type="password" />
  </label>
  <label id="submit">
    <input name="" type="submit" class="bt" value="确定" />
  </label>
</form>
<p id="siteCopyRight">版权所有：<a href="http://www.voippub.com">www.voippub.com</a></p>


</body>

</html>