<?php
ob_start();
include "db_config.php";



$uname = $_POST['Username'];
$pass = $_POST['Password'];

$rs = $db->query("select uname, pass from admin where uname='$uname' and pass='$pass'");
if($rs->num_rows == 1)
{
    session_start();
    $_SESSION['uname'] = $uname;
    $_SESSION['pass'] = $pass;
    header("location:../home.php");
}
else
{
    header("location:../index.php");
}
ob_flush();

?>