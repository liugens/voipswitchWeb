<?php if (!defined('THINK_PATH')) exit();?><?xml version="1.0" encoding="utf-8"?><!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>

<card id="main" title="通讯录" >
<p align="left" mode="wrap"><?php echo ($login); ?>的电话本 
<br/>

<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><?php echo ($vo["nickname"]); ?> <anchor><?php echo ($vo["telephone_number"]); ?><go href="__URL__/callAB/" method="get"> 
<postfield name="phone" value="<?php echo ($phone); ?>"/>
<postfield name="called" value="<?php echo ($vo["telephone_number"]); ?>"/></go></anchor>
<?php echo ($vo["speeddial"]); ?> <anchor>删除<go href="__URL__/delBook/" method="get">
<postfield name="id_address_book" value="<?php echo ($vo["id_address_book"]); ?>"/>
</go></anchor><br/><?php endforeach; endif; else: echo "" ;endif; ?><br/>
<?php echo ($pagenum); ?><br/>
姓名:<input type="text" name="nickname"  value=""/> <br/>
号码:<input type="text" name="telephone_number"  value=""/> <br/>
短号:<input type="text" name="speeddial"  value=""/> <br/>
<anchor title="增加">&#x3010;增加&#x3011;
 <br/><go method="post" href="__URL__/insertBook/">
<postfield name="telephone_number" value="$telephone_number"/>
<postfield name="nickname" value="$nickname"/>
<postfield name="speeddial" value="$speeddial"/>
<postfield name="id_client" value="<?php echo ($id_client); ?>"/>
</go></anchor><br/>

 <br/>
 <anchor>返回首页<go href="__URL__/main/" method="get">
</go></anchor>
</p></card>
</wml>