<?php
ob_start();
    include "../php_scripts/db_config.php";
    $sid = $_POST['source'];
    $db->query("update speedtest set status='1' where sid='$sid'");
    header("location:../internet_speed.php");
ob_flush();
?>