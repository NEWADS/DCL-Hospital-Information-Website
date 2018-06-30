<?
//This is a temporary file to test php and Sql
// 16.4.16/13:35
require_once("php_function.php");
require_once('email.class.php');

function check_if_login()
{
	if( isset($_SESSION["loginsuc"]) == TRUE)
	{
		echo "<script> alert('你已登陆，请勿重复登陆');parent.location.href='index.html'; </script>";

		EXIT;
	}
}

check_if_login();

if(isset($_POST["username"]) && isset($_POST["password"])&& isset($_POST["yanzheng"]))
{
	if(md5($_POST["yanzheng"])!=$_SESSION["verification"])		
	{echo "<script> alert('验证码不正确');parent.location.href='login.html'; </script>"; exit;}
	
		 
	 
	connect_mysql();
	
	//判断是谁登陆
	if($_POST["doctor"])
	{
		$_SESSION["doctor"]=True;
		
		$sql=sprintf("SELECT * FROM doctor WHERE Username='%s' AND Password='%s'",
												mysql_real_escape_string($_POST["username"]),
												mysql_real_escape_string($_POST["password"]));

		$result=mysql_query($sql);
		
		if($result=== FALSE)
				die("can not query database:". mysql_error());

		//find if i have a line 
			if (mysql_num_rows($result)==1)
			{
				
				$doctor=mysql_fetch_array($result);
				$_SESSION["doctorid"]= $doctor["Hospital_ID"];
				$_SESSION["loginsuc"] = $_POST["username"];
				
				//发邮件
				$doid= $_SESSION["doctorid"];
				
				$query=mysql_query("SELECT COUNT(ID) FROM hospital_2 WHERE doctorname='$doid' AND post=0");
				if(mysql_num_rows( $query)){
				$rs=mysql_fetch_array($query); //统计结果
				$count=$rs[0];  
				}

				for($i=0;$i<$count;$i++){
				$query2=mysql_query("SELECT duedate FROM hospital_2 WHERE doctorname='$doid' AND post=0  ");
                                @$duedate=mysql_result($query2,$i);
                                $endtime = strtotime($duedate);
				$nowtime = time();
				$lefttime = $endtime-$nowtime;//以秒记
				$week=round($lefttime/604800);//四舍五入取整
                                
                               
				$bd=mysql_query("SELECT Email FROM user AS A ,(SELECT ID  FROM hospital_2 WHERE doctorname='$doid' AND post=0) AS U  WHERE A.ID=U.ID  ");
                                
                                if($week<20&&$week>0){
                                $smtpserver = "smtp.163.com";//SMTP服务器
	                        $smtpserverport =25;//SMTP服务器端口
	                        $smtpusermail = "liqingneng123@163.com";//SMTP服务器的用户邮箱
	                        $smtpemailto=mysql_result($bd,$i);;//发送给谁
	                        $smtpuser = "liqingneng123";//SMTP服务器的用户帐号
	                        $smtppass = "stu060206";//SMTP服务器的用户密码
	                        $mailtitle = "产检通知";//邮件主题
	                        $mailcontent = "距离您的预产期还有".$week."周，建议您近期去医院检查身体";//邮件内容
	                        $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	                      //************************ 配置信息 ****************************
	                        $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	                        $smtp->debug = false;//是否显示发送的调试信息
	                        $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
				if($state=="0") echo "<script>alert('动态提醒成功')</script>";
                                else echo "<script>alert('动态提醒成功')</script>";
				}
				$p=mysql_query("UPDATE hospital_2 SET post=1");
                                
				}
				 
				echo "<script> alert('你好，医生！登陆成功');parent.location.href='doctor.html'; </script>"; 
				 
			}
			else 
			{
				
				echo "<script> alert('your password is not right, please try it again');parent.location.href='login.html'; </script>"; 
				
			}
	}
	else
	{
		$_SESSION["doctor"]=FALSE;	
			//decline the dangerous 
		$sql=sprintf("SELECT 1 FROM user WHERE Username='%s' AND Password='%s'",
												mysql_real_escape_string($_POST["username"]),
												mysql_real_escape_string($_POST["password"]));

		$result=mysql_query($sql);
		//to search if the password is right
			if($result=== FALSE)
				die("can not query database:". mysql_error());

		//find if i have a line 
			if (mysql_num_rows($result)==1)
			{
				 
				$sql = sprintf("SELECT ID FROM user WHERE Username ='%s'",mysql_real_escape_string($_POST["username"]));  

			   $result=mysql_query($sql);
			   
			   if($result=== FALSE)
			   die("can not query database:". mysql_error());
		   
				$row=mysql_fetch_array($result);
				
				$_SESSION["userid"]=$row["ID"];
				$_SESSION["loginsuc"] = $_POST["username"];
				
				if(isset($_SESSION["userid"]))
					echo "<script> alert('登陆成功！');parent.location.href='index.html'; </script>"; 
				else
					die("没有查询到数据");
				 
			}
			else 
			{
				
				echo "<script> alert('你的用户名或密码不正确，请重新登陆');parent.location.href='login.html'; </script>"; 
				
			}
	}
}

?>
