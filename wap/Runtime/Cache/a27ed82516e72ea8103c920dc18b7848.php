<?php if (!defined('THINK_PATH')) exit();?><?xml version="1.0" encoding="utf-8"?><!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>

<card id="main" title="预约" >
<p align="left" mode="wrap">输入主叫和被叫预约 
<br/>

主叫:<input type="text" name="phone"  value="<?php echo ($phone); ?>" format="*N" maxlength="13"/> <br/>
被叫:<input type="text" name="called"  value="<?php echo ($called); ?>" format="*N" maxlength="13"/> <br/>

<anchor title="预约">&#x3010;回铃&#x3011;
 <br/><go method="get" href="__URL__/callTo/">
<postfield name="phone" value="$phone"/>
<postfield name="called" value="$called"/>

</go></anchor><br/>

 <br/>
 <anchor>返回首页<go href="__URL__/main/" method="get">
</go></anchor>
</p></card>
</wml>