<?php
class addressbookModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(
		array('id_client','require','登录名必须！'),
		array('telephone_number','require','手机号码必须！'),
		
		);
	// 自动填充设置
	protected $_auto	 =	 array(
		array('type','1',self::MODEL_INSERT),
		
		);

}
?>