<?php
ob_start();
include "../config/db_config.inc.php";
include "../config/class_lib.php";
if(!isset($_SESSION)) session_start();
$username = $_POST['Username'];
$password = $_POST['Password'];
$captcha = $_POST['Captcha'];
$action = $_POST['Action'];

$val = new validation();

if($val->check_empty($_POST))
{
	if($_POST['Captcha'] == $_SESSION['digit'])
	{
		$username = $mysqli->escape_string($username);
		$password = $mysqli->escape_string($password);
		$rs = $mysqli->query("select *from admin where uname='$username' and pass='$password'");
		if($rs->num_rows == 1)
		{
			while($row = $rs->fetch_array())
			{
				$_SESSION['user_id'] = $row['id'];
				$_SESSION['user_uname'] = $row['uname'];
				$_SESSION['user_pass'] = $row['pass'];
				$_SESSION['user_fname'] = $row['fname'];
				$_SESSION['user_cdate'] = $row['cdate'];
				$_SESSION['user_pri'] = $row['privilege'];
				$_SESSION['user_des'] = $row['designation'];
				$_SESSION['user_pic'] = $row['photo'];
				$_SESSION['user_dep'] = $row['dep'];
				$_SESSION['user_lname'] = $row['lname'];
				$_SESSION['user_abt'] = $row['abt'];
				$_SESSION['user_email'] = $row['email'];
				$_SESSION['user_last'] = $row['last'];
			}
			$mysqli->query("update admin set last=now() where uname='$username'");
			header("location:../home.php");
			$ip = $_SERVER['REMOTE_ADDR'];
			$mysqli->query("insert into log_login(uname,ip,dt) values('$username','$ip',now())");
		}
		else
		{
			session_destroy();
			header("location:../login.php");
		}
	}
	else
	{
		session_destroy();
		header("location:../login.php");
	}
}
else
{
	session_destroy();
	header("location:../login.php");
}
ob_flush();
?>