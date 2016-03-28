<?php
    include "db_config.php";
    $color = $_POST['favcolor'];
    if(preg_match('/^#[a-f0-9]{6}$/i', $color)) //hex color is valid
    {
        $db->query("update settings set color='$color' where id='1'");
    }
header("location:../settings.php?id=1");
?>