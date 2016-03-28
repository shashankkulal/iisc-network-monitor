<?php

include "db_config.php";
function getSpeedCharacter($speed)
{
	if($speed > 30)
	{
		return "<span style='font-size:30px; color:#FDD017;'>&#9733;&#9733;&#9733;&#9733;&#9733; Excellent</span>";
	}
	else if($speed > 10 && $speed < 20)
	{
		return "<span style='font-size:30px; color:#736AFF;'>&#9733;&#9733; Fair</span>";
	}
	else if($speed > 20 && $speed < 30)
	{
		return "<span style='font-size:30px; color:#728C00;'>&#9733;&#9733;&#9733; Good</span>";
	}
	else
	{
		return "<span style='font-size:30px; color:red;'>&#9733; Poor</span>";
	}
}

function getpacketloss($address, $count) {
    $pc = array();
    $command = 'ping -c %d %s';
    $output = shell_exec(sprintf($command, $count, $address));

    if (preg_match('/([0-9]*\.?[0-9]+)%(?:\s+packet)?\s+loss/', $output, $match) === 1) {
        $packetLoss = (float)$match[1]; 
    }
    else
    {
        $packetLoss = 100;
    }
    return $packetLoss;
}

function getSinglePingStatus($ip)
{
	$ping_Array = array("id"=>"","ip"=>"","mi"=>"","mx"=>"","mx"=>"","av"=>"","pl"=>"","ut"=>"");
	$rs = $GLOBALS['db']->query("select *from clink_status where ip='$ip'");
	while($row = $rs->fetch_array())
	{
		$ping_Array['id'] = $row['id'];
		$ping_Array['ip'] = $row['ip']; 
		$ping_Array['mi'] = $row['mi']; 
		$ping_Array['mx'] = $row['mx']; 
                $ping_Array['av'] = $row['av'];  
                $ping_Array['pl'] = $row['pl'];
		$ping_Array['ut'] = $row['ut']; 
	}
	return $ping_Array;
}

function getTree($pid)
{
    $rs = $GLOBALS['db']->query("select *from tree where pid='$pid'");
    $child = array();
    $ips = array();
    $i = 0;
    while($row=$rs->fetch_array())
    {
        array_push($ips, $row['ip']);
        $child[$i] = array();
        $child[$i]['ip'] = $row['ip'];
        array_push($ips, $row['ip']);
        $child[$i]['id'] = getTree($row['id']);
        $i++;
    }
    #print json_encode($child);
    return $ips;
}

$parents = array();
function getParents($pid)
{
    $rs = $GLOBALS['db']->query("select *from tree where id='$pid'");
    while($row = $rs->fetch_array())
    {
       array_push($GLOBALS['parents'], $row);
        getParents($row['pid']);
    }
}

function getChildAverage($ips)
{
    $rs = $GLOBALS['db']->query("select id from tree where ip='$ips'");
    $row = $rs->fetch_array();
    $ips = $row['id'];
    $ips = getTree($ips);
    $ips = implode("','", $ips);
    $ips = "'".$ips."'";
    $mma = array("min"=>"","max"=>"","avg"=>"","ploss"=>"");
    $rs = $GLOBALS['db']->query("select MIN(mi),MAX(mx),AVG(av),AVG(pl) from clink_status where ip in (".$ips.")");
    while($row=$rs->fetch_array())
    {
        $mma['min'] = round($row[0],2);
        $mma['max'] = round($row[1],2);
        $mma['avg'] = round($row[2],2);
        $mma['ploss'] = round($row[3],2);
    }
    return $mma;
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

function getIpDetailsByIp($ip)
{
    $details = array("id"=>"","pid"=>"",""=>"ip","sname"=>"","fname"=>"","agent"=>"");
    $rs = $GLOBALS['db']->query("select *from tree where ip='$ip'");
    while($row = $rs->fetch_array())
    {
        $details['id'] = $row['id'];
        $details['pid'] = $row['pid'];
        $details['ip'] = $row['ip'];
        $details['sname'] = $row['sname'];
        $details['fname'] = $row['fname'];
	$details['agent'] = $row['agent'];
    }
    return $details;
}

function getInternetBandwidth()
{
    $f = fopen("python_engine/temp/speed.txt", "r");
    $speed = fgets($f);
    fclose($f);
    return $speed;
}

function timeInAgo($original) {
    // array of time period chunks
    $chunks = array(
    array(60 * 60 * 24 * 365 , 'year'),
    array(60 * 60 * 24 * 30 , 'month'),
    array(60 * 60 * 24 * 7, 'week'),
    array(60 * 60 * 24 , 'day'),
    array(60 * 60 , 'hour'),
    array(60 , 'min'),
    array(1 , 'sec'),
    );
    $today = time(); /* Current unix time  */
    $since = $today - $original;
    // $j saves performing the count function each time around the loop
    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
    $seconds = $chunks[$i][0];
    $name = $chunks[$i][1];
    // finding the biggest chunk (if the chunk fits, break)
    if (($count = floor($since / $seconds)) != 0) {
        break;
    }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    if ($i + 1 < $j) {
    // now getting the second item
    $seconds2 = $chunks[$i + 1][0];
    $name2 = $chunks[$i + 1][1];

    // add second item if its greater than 0
    if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
        $print .= ($count2 == 1) ? ', 1 '.$name2 : " $count2 {$name2}s";
    }
    }
    return $print;
}
?>
