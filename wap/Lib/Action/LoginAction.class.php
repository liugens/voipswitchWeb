<?php
// 本文档自动生成，仅供测试运行
class IndexAction extends Action
{
   
    public function index()
    {
       $this->assign('hello','欢迎');
		
       // $this->display();
		$this->display('','','text/vnd.wap.wml');
    }
///////////////////////
   public function checkLogin()
	{
      if(empty($_GET['login']))
	  {
		   $this->error('帐号错误！');
	  }
	   elseif (empty($_GET['password']))
		{
			$this->error('密码必须！');
		}
	$this->display('','','text/vnd.wap.wml');	
	}
///////////////////////////
}
?>