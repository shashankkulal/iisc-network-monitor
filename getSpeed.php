<?php
#$id = $_GET['id'];
#exec("set http_proxy='http://proxy.iisc.ernet.in:3128/'");
$query = "python python_engine/speedtest_cli.py";
system($query, $out);
echo $out;
?>