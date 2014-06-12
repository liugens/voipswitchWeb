<?php
class c_userModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(
		array('client_id','require','卡号名必须！'),
		array('phoneNum','require','绑定号码！'),
		
		);
	// 自动填充设置
	protected $_auto	 =	 array(		
		array('AgentPhoneNum','root',self::MODEL_INSERT,'string'),
		
		);

}
?>