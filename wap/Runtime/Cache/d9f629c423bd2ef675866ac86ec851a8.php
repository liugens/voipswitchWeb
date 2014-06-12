<?php if (!defined('THINK_PATH')) exit();?><?xml version="1.0" encoding="utf-8"?><!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>

<card id="main" title="账户充值" >
<p align="left" mode="wrap"><?php echo ($login); ?>账户充值 
<br/>

卡号:<input type="text" name="cardid"  value=""/> <br/>
密码:<input type="text" name="cardpwd"  value=""/> <br/>

<anchor title="充值">&#x3010;充值&#x3011;
 <br/><go method="get" href="__URL__/activeRet/">
<postfield name="cardid" value="$cardid"/>
<postfield name="cardpwd" value="$cardpwd"/>

</go></anchor><br/>

 <br/>
 <anchor>返回首页<go href="__URL__/main/" method="get">
</go></anchor>
</p></card>
</wml>