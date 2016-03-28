<?php
ob_start();
include "../php_scripts/db_config.php";
    $sid = $_GET['action'];
    echo $sid;

    $db->query("update speedtest set status='0' where sid='$sid'");
    header("location:../internet_speed.php");
ob_flush();
?>