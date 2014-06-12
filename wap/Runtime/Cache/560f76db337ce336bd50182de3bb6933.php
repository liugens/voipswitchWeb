<?php if (!defined('THINK_PATH')) exit();?><?xml version="1.0" encoding="utf-8"?><!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>

<card id="info" title="用户信息" >
<p align="left" mode="wrap"><?php echo ($login); ?>,欢迎使用VOIP电话系统 
<br/>
QQ:<?php echo ($qq); ?>.<br/>
Email:<?php echo ($email); ?>.
<br/>

 <br/>
 <anchor>返回首页<go href="__URL__/main/" method="get">
</go></anchor>
 </p></card>
</wml>