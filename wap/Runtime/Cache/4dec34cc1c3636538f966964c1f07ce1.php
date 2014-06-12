<?php if (!defined('THINK_PATH')) exit();?><?xml version="1.0" encoding="utf-8"?><!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>

<card id="main" title="绑定号码" >
<p align="left" mode="wrap"><?php echo ($login); ?>,绑定号码 
<br/>

<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><?php echo ($vo["phone_number"]); ?> <anchor>删除<go href="__URL__/delPhone/" method="get">
<postfield name="id" value="<?php echo ($vo["id"]); ?>"/>
</go></anchor><br/><?php endforeach; endif; else: echo "" ;endif; ?>电话号码:<input type="text" name="phone_number"  value=""/> <br/>

<anchor title="绑定">&#x3010;绑定&#x3011;
 <br/><go method="post" href="__URL__/bdRet/">
<postfield name="phone_number" value="$phone_number"/>
<postfield name="id_client" value="<?php echo ($id_client); ?>"/>
</go></anchor><br/>

 <br/>
 <anchor>返回首页<go href="__URL__/main/" method="get">
</go></anchor>
</p></card>
</wml>