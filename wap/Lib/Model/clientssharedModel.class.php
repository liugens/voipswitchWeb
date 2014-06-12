<?php
class clientssharedModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(
		array('login','require','登录名必须！'),
		array('password','require','密码必须！'),
		array('type','require','必须'),
		array('login','','登录名已经存在',0,'unique',self::MODEL_INSERT),
		);
	// 自动填充设置
	protected $_auto	 =	 array(
		array('id_tariff','1',self::MODEL_INSERT),
		
		);

}
?>