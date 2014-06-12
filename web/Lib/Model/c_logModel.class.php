<?php
class c_logModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(
		array('AgentPhoneNum','require','代理号必须！'),
		array('phone','require','绑定号码！'),
		
		);
	// 自动填充设置
	protected $_auto	 =	 array(		
		array('ddate','time',self::MODEL_INSERT,'function'),
		
		);

}
?>