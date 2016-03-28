<?php
ob_start();
include "../config/db_config.inc.php";
$sid = $_GET['sid'];
$mysqli->query("update speedtest set status='0' where sid='$sid'");
header("location:../home.php");
ob_flush();
?>
<script>
	alert("Data updated Successfully!");
</script>