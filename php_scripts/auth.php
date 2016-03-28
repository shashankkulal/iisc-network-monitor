<?php
ob_start();
include "db_config.php";
$uname = $_POST['Username'];
$pass = $_POST['Password'];
$captcha = $_POST['captcha'];
session_start();
if($captcha == $_SESSION['digit'])
{
	$rs = $db->query("select *from admin where uname='$uname' and pass='$pass'");
	if($rs->num_rows == 1)
	{
    		$_SESSION['uname'] = $uname;
    		$_SESSION['pass'] = $pass;
    		header("location:../home.php");
	}
	else
	{
    		header("location:../index.php");
	}
}
else
{
	session_destroy();
	header("location:../login.php");
}
ob_flush();

?>
