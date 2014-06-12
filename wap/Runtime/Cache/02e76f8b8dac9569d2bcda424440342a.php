<?php if (!defined('THINK_PATH')) exit();?><?xml version="1.0" encoding="utf-8"?><!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>
<head><meta http-equiv="Cache-Control" content="max-age=0" forua="true"/></head>
<card id="main" title="查询余额" >
<p align="left" mode="wrap"><?php echo ($login); ?>,欢迎使用VOIP电话系统 
<br/>
您的余额是:<?php echo ($account_state); ?>元.
<br/>

 <br/>
 <anchor>返回首页<go href="__URL__/main/" method="get">
</go></anchor>
 </p></card>
</wml>