<?php
/// ---voipswitch WEB 2011.07.28
//------/COPYRIGHT Liugens QQ:89344790
///-----http://www.voippub.com
class IndexAction extends Action
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
        $this->display();
    }

    ///-------------------------------------------------------
	 public function login()
    {
		 //
		   if(empty($_POST['userName']))
	  {
		   $this->error('代理手机错误.！');
	  }
	   elseif (empty($_POST['passWord']))
		{
			$this->error('密码必须！.');
		}
		$username=$_POST['userName'];
		$pwd=$_POST['passWord'];
		if($username==C('admin') &&$pwd==C('password'))
		{
		$_SESSION['admin']=1;
        $_SESSION['adminID']=$username;
			$this->display('admin_main');
		}
		$User=M("agent");
		$list=$User->where("PhoneNum='$username'")->find();
       if(empty($list))
		{
		   $this->error('代理手机不存在！.');
		}
		elseif($list['pass']!=$pwd)
		{
			$this->error('代理密码错误！.');
		}
		$id_tariff=$list['tariffid'];
		$Tarif=M("tariffsnames");
		$mytar=$Tarif->where("id_tariff='$id_tariff'")->find();
		if(!empty($mytar))
		{
			$_SESSION['tariff_name']=$mytar['description'];

		}


        $_SESSION['agent']=1;
        $_SESSION['agentID']=$username;
		$_SESSION['id_tariff']=$id_tariff;
		$_SESSION['agentname']=$list['UserName'];
		$_SESSION['money']=$list['Money'];;

        $this->display('main');
    }
///-------------------------------------------------------
public function myinfo()
	{
	
	   $this->checkRight();
		$this->assign('agentname',$_SESSION['agentname']);
		$this->assign('money',$_SESSION['money']);
		$this->assign('tariff_name',$_SESSION['tariff_name']);

	  $this->display();
	}
//----------------------------------
	public function topagent()
	{
		$this->checkAdmin();
		 import("@.ORG.Page"); //导入分页类
	  $CUser=M("agent");
	  $User=new Model();
      $sqlstr="select agent.PhoneNum,agent.pass,agent.UserName,agent.Money,tf.description  from agent left join tariffsnames as tf on agent.tariffid=tf.id_tariff where  isnull(parentNum)";
	   $count = $CUser->where("isnull(parentNum)" )->count();    //计算总数
	   $p = new Page ($count, 15 );
	   $sqlstr=$sqlstr."limit $p->firstRow,$p->listRows";

	  $list=$User->query($sqlstr);
	   $p->setConfig('header','篇记录');
			$p->setConfig('prev',"<");
			$p->setConfig('next','>');
			$p->setConfig('first','<<');
			$p->setConfig('last','>>');
			$page = $p->show ();

	  $this->assign('agentname',$_SESSION['agentname']);
	  $this->assign('list',$list);
	  $this->assign( "pagenum", $page );
	  $this->display();

	}
///-------------------------------------------------------
public function myagent()
	{
	  $this->checkRight();
	  $username=$_SESSION['agentID'];
	  import("@.ORG.Page"); //导入分页类
	  $User=M("agent");
	   $count = $User->where("parentNum=$username" )->count();    //计算总数
	   $p = new Page ($count, 15 );
	  $list=$User->where("parentNum=$username")->limit($p->firstRow.','.$p->listRows)->order('Money desc')->findAll();
	   $p->setConfig('header','篇记录');
			$p->setConfig('prev',"<");
			$p->setConfig('next','>');
			$p->setConfig('first','<<');
			$p->setConfig('last','>>');
			$page = $p->show ();

	  $this->assign('agentname',$_SESSION['agentname']);
	  $this->assign('list',$list);
	  $this->assign( "pagenum", $page );
	  $this->display();

	}
///////////----------------------------------------
public function agent2user()
	{
	$this->checkRight();
	 $username=$_SESSION['agentID'];
	 $phone=$_GET['phone'];
	 $cardnum=$_GET['cardnum'];
	 $cardpwd=$_GET['cardpwd'];
	
	 if($phone=='')
		{
		 $phone=$_POST['phone'];
		}
 
	if($phone!='')
	{
		//$phone=$_POST['phone'];
		$usermoney=1.0;
		$cardnum=$_POST['cardnum'];
	 $cardpwd=$_POST['cardpwd'];
		
	if($cardnum!='' && $cardpwd!='')
		{
		
           $ret= $this->activeCard($cardnum,$cardpwd,$phone);
		   if($ret==1)
			{
			   $acardret="充值成功"; 
			  
			}
			elseif($ret==-2)
			{
				$acardret='充值卡密码错误！.';
			}
			elseif($ret==-3)
			{
				$acardret='充值卡号不存在！.';
			}
			else
			{
				$acardret="充值失败";
			}
		} 
		$this->assign('acardret',$acardret);
		$usermoney=$this->getUserMoney($phone);

		$this->assign('usermoney',$usermoney);

	}
	$this->assign('phone',$phone);
   $this->assign('cardnum',$cardnum);
   $this->assign('cardpwd',$cardpwd);
   
   
   $this->display();
	}
///-------------------------------------------------------
public function activeCard($cardid,$cardpwd,$phone)
	{
	   $Card=M("card");
		$list=$Card->where("cardNo='$cardid' and flag=0")->find();
       if(empty($list))
		{
		 //  $this->error('充值卡号不存在！.');
		 return -3;
		}
		elseif($list['pass']!=$cardpwd)
		{
			//$this->error('充值卡密码错误！.');
			return -2;
		}
		$tariffid=$list['tariffid'];
		$money=$list['money'];
		/*elseif($list['tariffid']!=$_SESSION['id_tariff'])
		{
			$this->error('充值卡费率错误！.');
		}*/

		$ret=$this->addUM($phone,$money,$tariffid);
		if($ret==1)
		{
			$Model = new Model();
			$Model->execute("update card set flag=1,bindphone='$phone' where cardno=$cardid");
			return 1;

		}
		else
			return 0;
		//$User=M("clientsshared");
		
	}
//-------------------------------------------------------
public function agent2useret()
	{
     $this->checkRight();
	 $username=$_SESSION['agentID'];
	 $tariffid=$_SESSION['id_tariff'];
	 $phone=$_POST['phone'];
	 $money=$_POST['money'];
	 if($money<10) $this->error('至少充值10元！.');
     if($phone=='') $this->error('输入号码！.');
     $amoney=$this->getAMbyPhone($username);
	 if($amoney<$money)
		{
		 $this->error("您的余额是:$amoney,余额不足$money！.");
		}
    $ret= $this->addUM($phone,$money,$tariffid);
	if($ret==1)
		{
		  $User=M("agent");
		  $User->execute("update agent set money=money-$money where PhoneNum='$username'");
		  $cm=$amoney-$money;
////////////
          $Log=M('c_log');
		  $ldata['AgentPhoneNum']=$username;
		  $ldata['phone']=$phone;
		  $ldata['money']=$money;
		   $ldata['ddate']=date('Y-m-d H:i:s'); 

		  $Log->add($ldata);

		  $this->success("充值成功！,代理余额为:$cm .");
		}
		else
			$this->error('充值失败！.');

	}
///-------------------------------------------------------
public function addUM($phone,$money,$tariffid)
	{
        
		$sqlstr="select id_client,login,password,account_state,id_tariff  from clientsshared where id_client in ";
	  $sqlstr=$sqlstr."(select id_client from  clientscallbackphones where  phone_number='$phone')";
      $User=new Model();
	  $list=$User->query($sqlstr);
	  if(empty($list))
		{ 
		  $this->error('号码没有bind！.');
		}

      $id_client=$list[0]['id_client'];
	  if($tariffid!=$list[0]['id_tariff']) $this->error('当前代理费率与用户费率不同,不能互充！.');
	  $list=$User->execute("update clientsshared set account_state=account_state+$money where id_client=$id_client ");
	  if($list!==false) return 1;
	  else
		  return 0;

	}
///-------------------------------------------------------
public function getUserMoney($phone)
	{
	
	  $sqlstr="select login,password,account_state  from clientsshared where id_client in ";
	  $sqlstr=$sqlstr."(select id_client from  clientscallbackphones where  phone_number='$phone')";
	 // echo $sqlstr;
	  $User=new Model();
	  $list=$User->query($sqlstr);
	  if(empty($list))
		{
		  $money=$phone."没有绑定帐号";
		}
	   else
		{
		   //echo ;
		    $money="账户".$list[0]['login'].",绑定$phone 余额:".$list[0]['account_state']."元。";
		}
		return $money;

	}
///-------------------------------------------------------
public function myuser()
	{
	$this->checkRight();
	  $username=$_SESSION['agentID'];
	  $phone=$_POST['phone'];
	 import("@.ORG.Page"); //导入分页类
	 $CUser=M("c_user");
	 $count = $CUser->where("AgentPhoneNum='$username'" )->count();    //计算总数
	 
	  $sqlstr="select c_user.PhoneNum,c_user.qq,c_user.email,c.login,c.password,c.account_state,c.id_tariff from clientsshared as c  left join c_user on c.id_client=c_user.client_id where c_user.AgentPhoneNum='$username'";
       if($phone!="")
		{
		   $sqlstr=$sqlstr." and c_user.phoneNum='$phone'";
		   $count = 1;  
		}
$p = new Page ($count, 15 );
$sqlstr=$sqlstr."limit $p->firstRow,$p->listRows";
	  $User= new Model() ;
	  $list=$User->query($sqlstr);
	  $p->setConfig('header','篇记录');
			$p->setConfig('prev',"<");
			$p->setConfig('next','>');
			$p->setConfig('first','<<');
			$p->setConfig('last','>>');
			$page = $p->show ();
	  $this->assign('agentname',$_SESSION['agentname']);
	  $this->assign('list',$list);
	  $this->assign( "pagenum", $page );
	  $this->display();
	}
///------------------------------------------------------
public function alluser()
	{
	$this->checkAdmin();
	
	  $phone=$_POST['phone'];
	 import("@.ORG.Page"); //导入分页类
	 $CUser=M("c_user");
	 $count = $CUser->count();    //计算总数
	 
	  $sqlstr="select c_user.PhoneNum,c_user.qq,c_user.email,c_user.AgentPhoneNum,c.login,c.password,c.account_state,c.id_tariff ,tr.description from clientsshared as c  left join c_user on c.id_client=c_user.client_id left join tariffsnames as tr on c.id_tariff=tr.id_tariff ";
       if($phone!="")
		{
		   $sqlstr=$sqlstr." where c_user.phoneNum='$phone'";
		   $count = 1;  
		}
$p = new Page ($count, 15 );
$sqlstr=$sqlstr."limit $p->firstRow,$p->listRows";
	  $User= new Model() ;
	  $list=$User->query($sqlstr);
	  $p->setConfig('header','篇记录');
			$p->setConfig('prev',"<");
			$p->setConfig('next','>');
			$p->setConfig('first','<<');
			$p->setConfig('last','>>');
			$page = $p->show ();
	  $this->assign('agentname',$_SESSION['agentname']);
	  $this->assign('list',$list);
	  $this->assign( "pagenum", $page );
	  $this->display();
	}
///------------------------------------------------------
	public function agentlog()
	{
	  $this->checkRight();
	  $username=$_SESSION['agentID'];
	 $User=M("c_log");
	 import("@.ORG.Page"); //导入分页类
	 $count = $User->where("AgentPhoneNum='$username'" )->count();    //计算总数
	 $p = new Page ($count, 15 );
	$list=$User->where("AgentPhoneNum='$username'" )->limit($p->firstRow.','.$p->listRows)->order("ddate desc")->findAll(); 
	$p->setConfig('header','篇记录');
			$p->setConfig('prev',"<");
			$p->setConfig('next','>');
			$p->setConfig('first','<<');
			$p->setConfig('last','>>');
			$page = $p->show ();
$asum=$User->where("AgentPhoneNum='$username'" )->sum('money');   
	$this->assign('list',$list);
	 $this->assign( "pagenum", $page );
	 $this->assign( "asum", $asum );
	$this->display();

	}
///------------------------------------------------------
public function listcard()
	{
	$this->checkRight();
	$username=$_SESSION['agentID'];
	$User=M("card");
	$list=$User->where("AgentPhoneNum='$username'and flag=0" )->order("cardNo desc")->select(); 
	$this->assign('list',$list);
	$this->assign('cr',"\r\n");
	$this->display('','','text/plain');

	}
///------------------------------------------------------
public function mycard()
	{
	$this->checkRight();
	 $username=$_SESSION['agentID'];

$action=$_GET['action'];
$prex=substr($username,-4);
$start=$_POST['start'];
if($action=='add' && $start>0)
		{
	      
		   $cardnum=$_POST['cardnum'];
		    $money=$_POST['money'];
	          $amoney=$this->getAMbyPhone($username);
	if($amoney<$money*$cardnum)
		$msg="代理余额不足";
	else
		{
		$this->addcards($start,$cardnum,$money);
		$msg="充值卡生成 $cardnum 张";
		$_SESSION['money']=$amoney-$money*$cardnum;
			}
$this->assign('addmsg',$msg);

		}
$Card= new Model() ; 

$list2=$Card-> query("select mid(cardNo,5,4) as num from card where AgentPhoneNum='$username' order by cardno desc limit 1");
$User=M("card");
  $count = $User->where("AgentPhoneNum='$username' and flag=0" )->count();    //计算总数
	
	import("@.ORG.Page"); //导入分页类

			$p = new Page ($count, 15 );
  $list=$User->where("AgentPhoneNum='$username'and flag=0" )->limit($p->firstRow.','.$p->listRows)->order('cardNo desc')->findAll();
	  $p->setConfig('header','篇记录');
			$p->setConfig('prev',"<");
			$p->setConfig('next','>');
			$p->setConfig('first','<<');
			$p->setConfig('last','>>');
			$page = $p->show ();
	  $sta=$list2[0]['num'] +1 ;
		
		
	 $this->assign('agentname',$_SESSION['agentname']);
	  $this->assign('list',$list);
	  $this->assign('sta',$sta);
	  $this->assign('cardprx',$prex);
	  $this->assign( "pagenum", $page );
	  $this->display();
	  
	}
///-------------------------------------------------------
public function addcards($bi,$num,$money)
	{
	   $this->checkRight();
	 $username=$_SESSION['agentID'];
     $prex=substr($username,-4);
	 $User=M("card");
     for($i=0;$i<$num;$i++)
		{
            $k=$i+$bi;
			$data['cardNo']=sprintf("%s%04d",$prex,$k);
			$pasm=mt_rand(1000000,9999999);
			$pasm=$pasm.mt_rand(100,999);

			$data['pass']=$pasm;
			$data['money']=$money;
			$data['AgentPhoneNum']= $username;
			$data['tariffid']=$_SESSION['id_tariff'];
			$data['flag']=0;
			$User->add($data);

		}
		$Model=M("agent");
		$subm=$money*$num ;
		$Model->execute("update agent set money=money-$subm  where PhoneNum='$username'");

	}
	/////////

///-------------------------------------------------------
public function agentxg()
	{
	  $this->checkRight();
	  $username=$_SESSION['agentID'];
	  
	  //$User=M("agent");
	  if(!empty($_GET['phone'])) $phone=$_GET['phone'];
       $action=$_GET['action'];
	   if($action=='md')
		{
		   $User=M("agent");
		  $agpwd=$_POST['agpwd'];
		  $agname=$_POST['agname'];
		  if($agpwd!='') 
			{
			  
			  $data['pass']=$agpwd;
			}
			if($agname!='') 
			{
				$data['UserName']=$agname;
			}	
			if(!empty($data))
			{
				$User->where ("PhoneNum=$phone")->data($data)->save();

			}
			$str="修改完成";
          $this->assign('adret',$str);
		}
	  $this->assign('phone',$phone);
	  $this->display();

	}
///-------------------------------------------------------
public function topagentcz()
	{
	 $phone=$_GET['phone'];
	 $User=M("tariffsnames");
	 $list=$User->select();
	 if($phone!="")
		{
	      $Agent=M("agent");
		  $alist=$Agent->where("PhoneNum='$phone'")->find(); 
		  $this->assign('alist',$alist);
		}


	 $this->assign('list',$list);
	

	  $this->assign('phone',$phone);
	  $this->display();
	}
///-------------------------------------------------------
public function topaddagentret()
	{
	$this->checkAdmin();
	
	$agtphone=$_POST['agtphone'];
	$agpwd=$_POST['agpwd'];
	$agname=$_POST['agname'];
	$money=$_POST['money'];
	$id_tariff=$_POST['tariffid'];
      if($agtphone=="")
		{
	       $this->error("输入代理手机!");
		}
	if($agpwd=="")
		{
	       $this->error("输入代理密码!");
		}
	   $User=M("agent");
	 $data['PhoneNum']=$agtphone;
     $data['pass']=$agpwd;
     $data['Money']=$money;
     $data['UserName']=$agname;
  
     $data['tariffid']=$id_tariff;
       $ret=$User->add($data);
        if($ret!=false)
		{
		$this->success('增加代理成功！');
		}
		else
		{
			$this->error($User->getError());
		}
	}
	  

///////-----------------
public function topagentxg()
	{
	   $this->checkAdmin();
	   $agtphone=$_POST['agtphone'];
	$agpwd=$_POST['agpwd'];
	$agname=$_POST['agname'];
	$money=$_POST['money'];
	$id_tariff=$_POST['tariffid'];
      if($agtphone=="")
		{
	       $this->error("输入代理手机!");
		}
	if($agpwd=="")
		{
	       $this->error("输入代理密码!");
		}
	   $User=M("agent");
	 //$data['PhoneNum']=$agtphone;
     $data['pass']=$agpwd;
     $data['Money']=$money;
     $data['UserName']=$agname;
  
     $data['tariffid']=$id_tariff;
	 $ret=$User->where("PhoneNum='$agtphone'")->save($data);
	  if($ret!=false)
		{
		$this->success('代理修改成功！');
		}
		else
		{
			$this->error($User->getError());
		}

	}
///-------------------------------------------------------
public function agentcz()
	{
	  $phone=$_GET['phone'];
	  $this->assign('phone',$phone);
	  $this->display();
	}
///-------------------------------------------------------
public function agentczret()
	{
	$this->checkRight();
	$username=$_SESSION['agentID'];
	$agtphone=$_POST['agtphone'];
	$money=$_POST['money'];
	if($agtphone=="")
		{
	       $this->error("输入代理手机!");
		}
	$User=M("agent");
	if($money<100) $this->error("代理至少充值100元!");
	$amoney=$this->getAMbyPhone($username);
	
	$list=$User->where("PhoneNum='$agtphone'")->find();
	if(empty($list)) 
		{
		$this->error("代理手机号码错误\n没有该代理号码!");
		}
		$a_traif=$list['tariffid'];
		
		if($a_traif!=$_SESSION['id_tariff'])
		{
			$this->error("代理费率不同,不同互充!");
		}
		if($money>$amoney)
		{
		$this->error("代理余额不足!");
		}


   $data['Money']=$money;

$User->execute("update agent set money=money-$money where PhoneNum='$username'");

$ret=$User->execute("update agent set money=money+$money where PhoneNum='$agtphone'"); //$User->where("PhoneNum='$agtphone'")->save($data);
if($ret!=false)
	{
	$Log=M('c_log');
		  $ldata['AgentPhoneNum']=$username;
		  $ldata['phone']="DL".$agtphone;
		  $ldata['money']=$money;
		   $ldata['ddate']=date('Y-m-d H:i:s'); 

		  $Log->add($ldata);
		  $alm=$amoney-$money;
          $_SESSION['money']=$alm;
		$this->success("代理充值成功 $money 元,您的余额是:$alm 元.");
	}
	else
	{
		$this->error($User->getError());
	}
	}
///-------------------------------------------------------
public function addagentret()
	{
	$this->checkRight();
	$username=$_SESSION['agentID'];
	$agtphone=$_POST['agtphone'];
	$agpwd=$_POST['agpwd'];
	$agname=$_POST['agname'];
	$money=$_POST['money'];
   if($agtphone=="")
		{
	       $this->error("输入代理手机!");
		}
	if($agpwd=="")
		{
	       $this->error("输入代理密码!");
		}
	$User=M("agent");
	$amoney=$this->getAMbyPhone($username);
	if($money>$amoney)
		{
		$this->error("代理余额不足!");
		}
    $data['PhoneNum']=$agtphone;
  $data['pass']=$agpwd;
 $data['Money']=$money;
  $data['UserName']=$agname;
   $data['parentNum']=$username;
  $data['tariffid']=$_SESSION['id_tariff'];
$_SESSION['money']=$amoney-$money;
$User->execute("update agent set money=money-$money where PhoneNum='$username'");
$ret=$User->add($data);
if($ret!=false)
		{
		$this->success('增加代理成功！');
		}
		else
		{
			$this->error($User->getError());
		}
	}
///-------------------------------------------------------
public function getAMbyPhone($agent)
	{
	  $User=M("agent");
	  $list=$User->where("PhoneNum='$agent'")->find();
	  if(!empty($list))
		{
		  return $list['Money'];
		}

	}
///-------------------------------------------------------
public function agentMduser()
	{
	$phone=$_GET['phone'];
	$uphone=$_POST['uphone'];
	$this->checkRight();
    $CUser=M("c_user");
	if($uphone!='')
		{
		   $qq=$_POST['qq'];
		   $email=$_POST['email'];
		   $data['QQ']=$qq;
		   $data['email']=$email;
		   $ret=$CUser->where("phoneNum='$phone'" )->save($data);
		   if($ret!=false)
			{
			   $adret="修改成功";
			}
			else
				$adret="修改失败";


		}
	 $list=$CUser->where("phoneNum='$phone'" )->find();
   /* if(!empty($list))
		{
		$email=$list['email'];
		$qq=
		}
		*/
	$this->assign( "adret", $adret );
	$this->assign( "phone", $phone );
	$this->assign('list',$list);
	  $this->display();

	}
///-------------------------------------------------------
public function agxg()
	{
	   $this->checkRight();
	   if($_POST['pwd1']!=$_POST['pwd2'])
		{
			$this->error('两次密码不一样！.');
		}
		$username=$_SESSION['agentID'];
		if($username=='13838282625')
		{
			$this->error('本测试13838282625不允许修改密码！.');
		}
		$User=M("agent");
		$data['pass']=$_POST['pwd1'];
        $list=$User->where("PhoneNum=$username")->data($data)->save();
        if($list!==false){
				$this->success('密码修改成功！');
			}else{
				$this->error("密码修改失败!");
			}		


	}
///-------------------------------------------------------
	public function checkRight()
	{
       if(empty($_SESSION['agent']))
		{
		  $this->error('重新登录.'); 
		}
	}

///-------------------------------------------------------
public function checkAdmin()
	{
       if(empty($_SESSION['admin']))
		{
		  $this->error('重新登录.'); 
		}
	}
///-------------------------------------------------------
}
?>