<?php
include_once "CoNFigUraTIon/dB_ConFIGUratiON.php";
$qrcode = $_POST['qrcode'];
$captcha = $_POST['captcha'];

#Validation below
$error = false;
if($qrcode == "") $error = true;
if($captcha == "") $error = true;
$qrcode = filter_var($qrcode, FILTER_SANITIZE_STRING);
if(strlen($qrcode) != 5) $error = true;
if(!ctype_alnum($qrcode)) $error = true;
#Validation End
if($error == false)
{
	session_start();
	if($_SESSION['digit'] == $_POST['captcha'])
	{
		$_SESSION['digit'] = $qrcode;
		$randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 20, 40);
		copy("ScoreCard.php",$randomString.".php");
		header("location:".$randomString.".php");
	}
	else
	{
		session_destroy();
		header("location:index.php");
	}
}
else
{
	session_destroy();
	header("location:index.php");
}
?>