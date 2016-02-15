<?php

include "db_config.php";
function getpacketloss($address, $count) {
    $pc = array();
    $command = 'ping -c %d %s';
    $output = shell_exec(sprintf($command, $count, $address));

    if (preg_match('/([0-9]*\.?[0-9]+)%(?:\s+packet)?\s+loss/', $output, $match) === 1) {
        $packetLoss = (float)$match[1]; 
    } else {
        throw new \Exception('Packet loss not found.');
    }
    return $packetLoss;
}

function getaveragedelay($address, $count)
{
    $pa = array("Label"=>"Value", "Delay"=>"");
    $command = 'ping -c '. $count .' '. $address .' | grep rtt | cut -d"/" -f5';
    $output = shell_exec($command);
    return preg_replace( "/\r|\n/", "", $output );
}

function getHostDetails($host)
{
    $data = array();
    if(isset($host))
    {
        $rs = $GLOBALS['db']->query("select *from host where pid='$host'");
    }
    else
    {
        $rs = $GLOBALS['db']->query("select *from host where pid=''");
    }
    while($row = $rs->fetch_assoc())
    {
        array_push($data, $row);
    }
    return $data;
}

function getInternetBandwidth()
{
    $f = fopen("python_engine/temp/speed.txt", "r");
    $speed = fgets($f);
    fclose($f);
    return $speed;
}
?>