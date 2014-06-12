<?php if (!defined('THINK_PATH')) exit();?><?xml version="1.0" encoding="utf-8"?><!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>

<card id="mesg" title="<?php echo ($msgTitle); ?>" >
<p align="left" mode="wrap"><?php echo ($msgTitle); ?><br/>
<?php echo ($message); ?>

<br/>
<anchor>上一页<prev /></anchor>   <anchor>返回首页<go href="__URL__/main/" method="get"></go></anchor>
</p>
</card>
</wml>