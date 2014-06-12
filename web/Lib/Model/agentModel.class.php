<?php
class agentModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(
		array('PhoneNum','require','代理手机名必须！'),
		array('pass','require','密码必须！'),
		
		);
	// 自动填充设置
	protected $_auto	 =	 array(
	
		array('tariffid','1',self::MODEL_INSERT),
		array('money','0',self::MODEL_INSERT),
		);

}
?>