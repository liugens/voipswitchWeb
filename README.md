voipswitchWeb
=============

voipswitch web管理系统是一个voipswitch软交换系统的回拨管理网页平台，分为代理商平台和用户平台
代理商平台可以自己创建下级代理商，发卡，给用户充值
用户平台分为智能机平台和功能机WAP平台，可以自主修改主叫号码，通讯录，充值能功能

运行sqlupdate.exe建立初始总代帐号，升级部分数据库结构

修改web\Conf\config.php
user\Conf\config.php
wap\Conf\config.php
三个配置文件里的数据库信息和对接信息
代理访问页面 http://ip/web/
用户智能机访问页面 http://ip/user/
用户功能机访问页面 http://ip/wap/

问题反馈：http://www.voippub.com/forum-8-1.html