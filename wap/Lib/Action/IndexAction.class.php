<?php
// voipswitch wap 
//liugens QQ:89344790
//http://www.voippub.com
class IndexAction extends Action
{
   
    public function index()
    {
       $this->assign('hello','欢迎');
		
        $this->display();
	
    }
	///////
	public function reg()
    {
       $this->assign('hello','欢迎');
		
        $this->display();
	
    }
	////////////////
	public function regRet()
	{
		if(empty($_POST['uid']))
	  {
		   $this->error('请输入登录名.！');
	  }
	  elseif(empty($_POST['pwd']))
	  {
		   $this->error('请输入密码.！');
	  }
	  elseif(empty($_POST['phone']))
	  {
		   $this->error('绑定电话.！');
	  }
	  elseif(empty($_POST['email']))
	  {
		   $this->error('请输入email.！');
	  }
	  $Client=M("clientsshared");
	  $data['login']=$_POST['uid'];
	  $data['password']=$_POST['pwd'];
	 // $data['password']=$_POST['pwd'];
	  $data['type']=11665939; // 默认729 //如果默认723 11600403
	  $data['id_tariff']=C('id_tariff');  //注册费率
	  $data['tech_prefix']="SD:;ST:;DP:;TP:;CP:!$phone;SC:";
	  $ret=$Client->add($data);
	  if($ret!=false) //注册成功
		{
			$id_client=$ret;
			$C_user=M("c_user");
			$cdata['client_id']=$id_client;
			$cdata['phoneNum']=$_POST['phone'];
			$cdata['email']=$_POST['email'];;
			$cdata['qq']=$_POST['qq'];
			$cdata['AgentPhoneNum']='root';
			$C_user->add($cdata);
			
			$Mphone=M("clientscallbackphones");
			$pdata['id_client']=$id_client;
			$pdata['phone_number']=$_POST['phone'];
			$pdata['client_type']=32;
			$Mphone->add($pdata);/**/
			$this->success("注册成功！");

		}
		else
		{
			$this->error($Client->getError());

		}




	}
///////////////
  public function main()
    {
       
		if(empty($_SESSION['id_client']))
		{
		    
		   //$this->redirect('index');
		   redirect(__APP__);
		}
        $this->assign('id_client',$_SESSION['id_client']);
		$this->assign('login',$_SESSION['username']);
		$this->display('checkLogin');
    }
 /////////
 public function logout()
	{
	 $_SESSION['id_client']='';
	 redirect(__APP__);

	}
 ///////////
   public function checkLogin()
	{
	
	
      if(empty($_GET['login']))
	  {
		   $this->error('帐号错误.！');
	  }
	   elseif (empty($_GET['password']))
		{
			$this->error('密码必须！.');
		}
		$username=$_GET['login'];
		$pwd=$_GET['password'];

		$User=M("clientsshared");
		$list=$User->where("login='$username'")->find();
       if(empty($list))
		{
		   $this->error('用户名不存在！.');
		}
		elseif($list['password']!=$pwd)
		{
			$this->error('密码错误！.');
		}

		
		$id_client=$list['id_client'];
		
		$Form=M("clientscallbackphones");
		$list2=$Form->where("id_client=$id_client and client_type=32")->find();
		if(!empty($list2))
		{
			$phone=$list2['phone_number'];
		}

		$this->assign('id_client',$id_client);
		$this->assign('login',$username);
        $this->assign('password',$pwd);
		$_SESSION['username']=$username;
		$_SESSION['id_client']=$id_client;
		$_SESSION['id_tariff']=$list['id_tariff'];
		$_SESSION['phone']=$phone;

	$this->display();	
	}
//////////////////////////////
public function active()
	{
	    if(empty($_SESSION['id_client']))
		{
		 $this->error('请先登录！.');
		}
		
		$this->display();
	}
/////////////////////
public function activeRet()
	{
	   if(empty($_SESSION['id_client']))
		{
		   if(empty($_GET['phone'])) $this->error('请输入充值号码.');
		   $phone=$_GET['phone'];
		   $Caller=M("clientscallbackphones");
		   $ret=$Caller->where ("phone_number='$phone'")->find();
		   if(empty($ret))
			{
			   $this->error('号码未绑定.');
			}
			else
			{
				$id_client=$ret['id_client'];
				$User=M("clientsshared");
				$myret=$User->where("id_client=$id_client")->find();
				if(!empty($myret))
				{


				$_SESSION['id_client']=$ret['id_client'];
				$_SESSION['phone']=$phone;
				$_SESSION['username']=$myret['login'];
				$_SESSION['id_tariff']=$list['id_tariff'];

				}
				else
				{
					$this->error('找不到登录帐号.');
				}

			}
		}
		
		  $id_client=$_SESSION['id_client'];
		  $username=$_SESSION['username'];
		
		$cardid=$_GET['cardid'];
		$cardpwd=$_GET['cardpwd'];
		//if(!empty($_GET['phone'])) $phone=$_GET['phone'];
		if(!empty($_SESSION['phone'])) $phone=$_SESSION['phone'];
		else
		{
			$this->error("请先绑定！$phone.");
			//$phone=$username;

		}
		
        $Card=M("card");
		$list=$Card->where("cardNo='$cardid' and flag=0")->find();
       if(empty($list))
		{
		   $this->error('充值卡号不存在！.');
		}
		elseif($list['pass']!=$cardpwd)
		{
			$this->error('充值卡密码错误！.');
		}
		elseif($list['tariffid']!=$_SESSION['id_tariff'])
		{
			$this->error('充值卡费率错误！.');
		}
		$money=$list['money'];
		$agentid=$list['AgentPhoneNum'];
		$User=M("clientsshared");
		$data['account_state']=$money;
		$Model = new Model();
		$list=$Model->execute("update clientsshared set account_state=account_state+$money where id_client=$id_client ");
		$list2=$User->where("id_client=$id_client")->find();
        if($list!==false){
			$account_state=$list2['account_state'];
			$Model->execute("update card set flag=1,bindphone='$phone' where cardno=$cardid");
			$Model->execute("update c_user set AgentPhoneNum='$agentid' where client_id=$id_client");

				$this->success("账户充值$money元成功！，当前余额是:$account_state");
			}else{
				$this->error("账户充值失败!");
			}	
		
	}
///////////
public function showCaller()
	{
	    if(empty($_SESSION['id_client']))
		{
		 $this->error('请先登录！.');
		}
		$id_client=$_SESSION['id_client'];
		$username=$_SESSION['username'];
		$User=M("clientsshared");
		$list=$User->where("login='$username'")->find();
        if(empty($list))
		{
		   $this->error('用户名不存在！.');
		}
		$tech_prefix=$list['tech_prefix'];
		//$list_pre=split(";",$tech_prefix);
		$list_pre=preg_match("/CP:!([0-9]+);/",$tech_prefix,$matches);
		$myphone=$matches[1];
		$this->assign('login',$username);
        $this->assign('myphone',$myphone);
		$this->display();

        

	}
//////////////
public function showCallerRet()
	{
	if(empty($_SESSION['id_client']))
		{
		 $this->error('请先登录！.');
		}
		$id_client=$_SESSION['id_client'];
		$username=$_SESSION['username'];
		$User=M("clientsshared");
		$list=$User->where("login='$username'")->find();
        if(empty($list))
		{
		   $this->error('用户名不存在！.');
		}
		$tech_prefix=$list['tech_prefix'];
		$my=$_POST['phone_number'];
		$replacement="CP:!$my;";
		
		$data['tech_prefix']=preg_replace("/CP:!?([0-9]+)?;/", $replacement, $tech_prefix);
		$User->where("login='$username'")->save($data);
		$this->success("修改绑定成功!");



	}
//////////////////////////////////
 public function getCent()
	{
	 if(empty($_SESSION['id_client']))
		{
		 $this->error('请先登录！.');
		}
		$id_client=$_SESSION['id_client'];
		$username=$_SESSION['username'];
		$User=M("clientsshared");
		$list=$User->where("login='$username'")->find();
        if(empty($list))
		{
		   $this->error('用户名不存在！.');
		}
		$account_state=$list['account_state'];
		$this->assign('login',$username);
        $this->assign('account_state',$account_state);
		$this->display();

	}
	////////////////
	public function getba()
	{
		$this->display();
	}
	////////////////
	public function getbaRet()
	{
		$username=$_POST['uid'];
		$pwd=$_POST['pwd'];
		$User=M("clientsshared");
		$list=$User->where("login='$username'")->find();
        if(empty($list))
		{
		   $this->error('用户名不存在！.');
		}
		elseif($list['password']!=$pwd)
		{
			$this->error('密码错误！.');

		}
		$account_state=$list['account_state'];
		$this->assign('login',$username);
        $this->assign('account_state',$account_state);
		$this->display('getCent');

	}
	/////////////////
 public function chPwd()
	{
	 if(empty($_SESSION['id_client']))
		{
		 $this->error('请先登录！.');
		}
		$id_client=$_SESSION['id_client'];
		$username=$_SESSION['username'];
		
		$this->assign('login',$username);
        
		$this->display();

	}
	////////////////////
	public function changePwdRet()
	{
        if(empty($_SESSION['id_client']))
		{
		 $this->error('请先登录！.');
		}

		if($_POST['newpwd']!=$_POST['newpwd2'])
		{
			$this->error('两次密码不一样！.');
		}

		$id_client=$_SESSION['id_client'];
		$username=$_SESSION['username'];
		$User=M("clientsshared");
		$newpwd=$_POST['oldpwd'];
		$list=$User->where("login='$username' and password='$newpwd'")->find();
        if(empty($list))
		{
		   $this->error('用户名密码错误！.');
		}
		$data['password']=$_POST['newpwd'];
        $list=$User->where("id_client=$id_client")->data($data)->save();
        if($list!==false){
				$this->success('密码修改成功！');
			}else{
				$this->error("密码修改失败!");
			}		
	}
	///////////////
	public function callTo()
	{
		if(!empty($_GET['phone'])) $phone=$_GET['phone'];
		elseif(!empty($_SESSION['phone'])) $phone=$_SESSION['phone'];
		else
		{
			$this->error('请先输入主叫号码！.');
		}
		if(!empty($_GET['called'])) $called=$_GET['called'];
		else
		{
			$this->error('请先输入被叫号码！.');
		}
         $this->callVps($phone,$called);
         $this->success('正在呼叫...！');
	}
	///////////////
	public function callAB()
	{
		if(!empty($_GET['phone'])) $phone=$_GET['phone'];
		elseif(!empty($_SESSION['phone'])) $phone=$_SESSION['phone'];
		if(!empty($_GET['called'])) $called=$_GET['called'];
		 $this->assign('phone',$phone);
		 $this->assign('called',$called);

         $this->display();
	}
	////////////
	public function dcallRet()
	{
		$username=$_POST['uid'];
		$pwd=$_POST['pwd'];
		$phone=$_POST['phone'];
		$called=$_POST['called'];
		$User=M("clientsshared");
		$list=$User->where("login='$username'")->find();
        if(empty($list))
		{
		   $this->error('用户名不存在！.');
		}
		elseif($list['password']!=$pwd)
		{
			$this->error('密码错误！.');

		}

		$this->calltoVps($username,$pwd,$phone,$called);
		$this->success('正在呼叫...！');
	}
	///////////////////
    public	function callVps($caller,$called)
	{
		$User=new Model();//M('clientscallbackphones');
		$list=$User->query("select login,password  from clientsshared where id_client in (select id_client from clientscallbackphones where phone_number='$caller' and client_type=32)");
         if(empty($list))
		{
			 $this->error('号码没有绑定！.');
		}
		$uid=$list[0]['login'];
		$upwd=$list[0]['password'];
		$this->calltoVps($uid,$upwd,$caller,$called);

	   return;
	}
	public	function calltoVps($username,$pwd,$phone,$called)
	{
		$ip=C('v_ip');
		$port=C('v_port');
		$fp = fsockopen($ip, $port, $errno, $errstr, 10);
		if (!$fp) 
			{
         $this->error("$errstr ($errno)<br />\n");
		}
		$out="$username $pwd $phone $called";
		fwrite($fp, $out);
		fclose($fp);
		return ;
	}

	//////////////////////////
	 public function bindPhone()
	{
	 if(empty($_SESSION['id_client']))
		{
		 $this->error('请先登录！.');
		}
		$id_client=$_SESSION['id_client'];
		$username=$_SESSION['username'];
		$User=M("clientscallbackphones");
		$list=$User->where("id_client=$id_client and client_type=32")->limit(5)->select();
        $this->assign('list',$list);
		$this->assign('id_client',$id_client);
		$this->assign('login',$username);
       
		$this->display();

	}
	///////////////////////
	 public function bdRet()
	{
		 if(empty($_SESSION['id_client']))
		{
		 $this->error('请先登录！.');
		}
		$id_client=$_SESSION['id_client'];
		$username=$_SESSION['username'];
		$Form	=	D("clientscallbackphones");
		if($vo = $Form->create())
		{
			$list=$Form->add();
			if($list!=false)
				{
				$phone=$_POST['phone_number'];
				$_SESSION['phone']=$phone;
				$User=M("c_user");
				//$User->where("id_client=$id_client")->find();
				$data['phoneNum']=$phone;
				$User->where("id_client=$id_client")->save($data);

				$this->success('号码保存成功！');
			}else{
				$this->error('号码增加失败！');
			}
		}
		else
		{
			$this->error($Form->getError());
		}

	}
	/////////////////////
 public function delPhone()
	{
	 if(empty($_SESSION['id_client']))
		{
		 $this->error('请先登录！.');
		}
		
         $Form=M("clientscallbackphones");
			$result	=	$Form->delete($_GET['id']);
			if(false !== $result)
			{
				$this->success('删除成功！');
				
			}
			else
			{
				$this->error('删除出错！');
			}
		
	}
	//////////////////////////
	public function book()
	{
		if(empty($_SESSION['id_client']))
		{
		 $this->error('请先登录！.');
		}
		$username=$_SESSION['username'];
        $id_client=$_SESSION['id_client'];
		$User=M("addressbook");
		$tp=C('TMPL_TEMPLATE_SUFFIX');
		//if($tp!='wml')
		{
		$count = $User->where("id_client=$id_client" )->count();    //计算总数
		import("@.ORG.Page"); //导入分页类
		$p = new Page ($count, 10);
		$list=$User->where("id_client=$id_client")->limit($p->firstRow.','.$p->listRows)->order('id_address_book')->findAll();
		$p->setConfig('header','篇记录');
			$p->setConfig('prev',"&lt;");
			$p->setConfig('next','&gt;');
			$p->setConfig('first','&lt;&lt;');
			$p->setConfig('last','&gt;&gt;');
			$page = $p->show ();
			$this->assign( "pagenum", $page );
		}
		/*
		else
		{
			$list=$User->where("id_client=$id_client")->select();
			
		}*/
        $this->assign('list',$list);
		$this->assign('id_client',$id_client);
		$this->assign('login',$username);
        $this->assign('phone',$_SESSION['phone']);
		
		$this->display();

	}
	////////////////////////
	public function insertBook()
	{
		if(empty($_SESSION['id_client']))
		{
		 $this->error('请先登录！.');
		}
		$username=$_SESSION['username'];
        $id_client=$_SESSION['id_client'];
		$Form=D("addressbook");
if($vo = $Form->create())
		{
			$list=$Form->add();
			if($list!==false){
				$this->success('电话本保存成功！');
			}else{
				$this->error('号码增加失败！');
			}
		}
		else
		{
			$this->error($Form->getError());
		}
	}
	///////////////////////
public function delBook()
	{
	if(empty($_SESSION['id_client']))
		{
		 $this->error('请先登录！.');
		}
		$username=$_SESSION['username'];
        $id_client=$_SESSION['id_client'];
 $Form=M("addressbook");
			$result	=	$Form->delete($_GET['id_address_book']);
			if(false !== $result)
			{
				$this->success('删除成功！');
				
			}
			else
			{
				$this->error('删除出错！');
			}
	}
	////////////////////
	public function activelog()
	{
		if(empty($_SESSION['id_client']))
		{
		 $this->error('请先登录！.');
		}
		$username=$_SESSION['username'];
        $id_client=$_SESSION['id_client'];
		if(!empty($_SESSION['phone'])) $phone=$_SESSION['phone'];
		else $phone=$username;
		$Card=M("card");
		$list=$Card->where("bindphone='$phone'")->limit(10)->select();
		$this->assign('login',$username);
		$this->assign('phone',$phone);
		$this->assign('list',$list);
		$this->display();

	}
	///////////////////
	public function checkCard()
	{
		$this->display();
	}
	//////////
	public function checkCardRet()
	{
		$cardid=$_POST['cardid'];
		$cardpwd=$_POST['cardpwd'];
		if(empty($cardid))
		{
		 $this->error('请先输入充值卡号！.');
		}
		elseif(empty($cardpwd))
		{
		 $this->error('请先输入充值卡密码！.');
		}
		$Card=M("card");
		$list=$Card->where("cardNo='$cardid' and flag=0")->find();
		if(empty($list))
		{
		   $this->error('充值卡号不存在！.');
		}
		elseif($list['pass']!=$cardpwd)
		{
			$this->error('充值卡密码错误！.');
		}
		else
		{
			$money=$list['money'];
			$this->success("查询结果:充值卡可用,金额:$money 元!");
		}



	}
	////////////////////
	public function lastCalllog()
	{
		if(empty($_SESSION['id_client']))
		{
		 $this->error('请先登录！.');
		}
		$username=$_SESSION['username'];
        $id_client=$_SESSION['id_client'];
		if(!empty($_SESSION['phone'])) $phone=$_SESSION['phone'];
		else $phone=$username;
		$Card=M("calls");
		$list=$Card->where("id_client =$id_client")->order('id_call desc')->limit(20)->select();
		$this->assign('login',$username);
		$this->assign('phone',$phone);
		$this->assign('list',$list);
		$this->display();

	}
	////////////////////
	public function userInfo()
	{
      if(empty($_SESSION['id_client']))
		{
		 $this->error('请先登录！.');
		}
		$username=$_SESSION['username'];
        $id_client=$_SESSION['id_client'];
		$C_user=M("c_user");
		$list=$C_user->where("client_id=$id_client")->find();
		if(empty($list))
		{
		   $this->error('没有找到用户信息！.');

		}
		$qq=$list['QQ'];
		$email=$list['email'];
		$this->assign('login',$username);
		$this->assign('qq',$qq);
		$this->assign('email',$email);
$this->display();


	}
	//////////////////
	public function lostpwdRet()
	{
		require 'class.phpmailer.php';

		$email=$_POST['email'];
		if(strlen($email)<5 && strlen($email)>30)
		{
			$this->error('请先输入正确邮箱！.');
		}
		$C_user=M("c_user");
		$list=$C_user->where("email='$email'")->find();
		if(empty($list))
		{
		   $this->error("无此用户$email！.");

		}
		 $id_client=$list['client_id'];
		 
        //$Client=M("clientsshared");
		$Client=new Model();
		$cus=$Client->query("select c.login,c.password,c_user.email from clientsshared as c left join c_user on c.id_client =c_user.client_id where  c_user.email='$email'");
		//$cu=$Client->where("id_client=$id_client")->find();
		$message="";
		foreach($cus as $cu)  $message=$message."username:".$cu['login'].",password:".$cu['password'].".\r\n";
		$title="your lost password:";
		/*
		if (mail($email, $title, $message)) 
			{
     $this->sucess("Message successfully sent!");
       }
       else {
     $this->error("发送邮件失败");
}

//$this->error($id_client.$message);*/


	try{
        $mail = new PHPMailer(true); 
			$mail->IsSMTP();                           // tell the class to use SMTP
	   $mail->SMTPAuth   = true;                  // enable SMTP authentication
       $mail->SetFrom(C('SMTP_USER'), 'liugens');
	   $mail->Port       = 25;                    // set the SMTP server port
	$mail->Host       =C('SMTP_SERVER'); //"mail.liugens.com"; // SMTP server
	$mail->Username   =C('SMTP_USER'); // "support@liugens.com";     // SMTP server username
	$mail->Password   =C('SMTP_PWD'); // "voippub.";            // SMTP server password
	$mail->FromName   =C('SMTP_FROM'); // "Liugens";
	   $mail->Subject  =$title;
	   $mail->AddAddress($email);
	    $mail->WordWrap   = 80; // set word wrap
       $mail->MsgHTML($message);
	   $mail->IsHTML(false); // send as HTML
      $mail->Send();
	   $this->success("密码已经发送到邮箱(password successfully sent!)");
		}
		 catch (phpmailerException $e) {
			 $this->error("发送邮件失败");
		 }
		


	}
	///////////////////

}
?>