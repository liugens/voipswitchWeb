<?php
class cardModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(
		array('cardNo','require','卡号名必须！'),
		array('pass','require','密码必须！'),
		array('money','require','金额必须！'),
		);
	// 自动填充设置
	protected $_auto	 =	 array(
		array('flag','0',self::MODEL_INSERT),
		array('tariffid','1',self::MODEL_INSERT),
		
		);

}
?>