<?php
class clientscallbackphonesModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(
		array('id_client','require','登录名必须！'),
		array('phone_number','require','手机号码必须！'),

		array('phone_number','','电话号码已经绑定',0,'unique',self::MODEL_INSERT),
		);
	// 自动填充设置
	protected $_auto	 =	 array(
		array('client_type','32',self::MODEL_INSERT),
	
		);

}
?>