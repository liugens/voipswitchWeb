<?php if (!defined('THINK_PATH')) exit();?><?xml version="1.0" encoding="utf-8"?><!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>

<card id="main" title="主叫变号" >
<p align="left" mode="wrap"><?php echo ($login); ?>,主叫变号 
<br/>
<input type="text" name="phone_number"  value="<?php echo ($myphone); ?>"/> <br/>
<anchor title="修改">&#x3010;修改&#x3011;
 <br/><go method="post" href="__URL__/showCallerRet/">
<postfield name="phone_number" value="$phone_number"/>
<postfield name="id_client" value="<?php echo ($id_client); ?>"/>
</go></anchor><br/>

 <br/>
 <anchor>返回首页<go href="__URL__/main/" method="get">
</go></anchor>
</p></card>
</wml>