<?php  
session_start();
include "../config/db_config.inc.php";
$old = $_POST['old_pass'];
$new = $_POST['new_pass'];
$re = $_POST['re_pass'];
#Validation below
$error = false;
foreach($_POST as $v)
{
	if($v == "") $error = true;
}
if($new != $re) $error = true;
if($_SESSION['user_pass'] != $old) $error = true;
#Validation End

if($error == false)
{
	$uname = $_SESSION['user_uname'];
	$stm = $mysqli->prepare("update admin set pass=? where uname=?");
	$stm->bind_param("ss",$new,$uname);
	$stm->execute();
	$stm->close();
	$mysqli->close();
	session_destroy();
	echo "<h3 style='text-align:center; width:100%;'>Password Changed..<br>Login again to apply changes.</h3>";
	header("refresh:2;url=../login.php");
}
else
{
	echo "<h3 style='text-align:center; width:100%;'>Something went wrong.</h3>";
	header("refresh:2;url=../editProfile.php");
}
?>