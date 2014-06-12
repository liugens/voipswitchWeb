<?php if (!defined('THINK_PATH')) exit();?><?xml version="1.0" encoding="utf-8"?><!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>

<card id="main" title="我的充值记录" >
<p align="left" mode="wrap"><?php echo ($login); ?>的充值记录 ，绑定号码<?php echo ($phone); ?>
<br/>
卡号 &#160; &#160;密码 &#160; 金额<br/> 
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><?php echo ($vo["cardNo"]); ?> <?php echo ($vo["pass"]); ?> <?php echo ($vo["money"]); ?> <br/><?php endforeach; endif; else: echo "" ;endif; ?><br/>

 <br/>
 <anchor>返回首页<go href="__URL__/main/" method="get">
</go></anchor>
</p></card>
</wml>