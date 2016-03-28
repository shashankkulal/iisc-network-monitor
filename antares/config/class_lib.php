<?php
include "db_config.inc.php";
class functions
{
    function getInternetBandwidth()
    {
        $f = fopen("http://10.114.5.65/python_engine/temp/speed.txt", "r");
        $speed = fgets($f);
        fclose($f);
        return $speed;
    }
    function getPacketLoss($address, $count) {
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
    function getAverageDelay($address, $count)
    {
        $pa = array("Label"=>"Value", "Delay"=>"");
        $command = 'ping -c '. $count .' '. $address .' | grep rtt | cut -d"/" -f5';
        $output = shell_exec($command);
        return preg_replace( "/\r|\n/", "", $output );
    }

    function getLSDelay($ip)
    {
        $rs = $GLOBALS['mysqli']->query("select *from clink_status where ip='$ip'");
        $data = array();
        if(mysqli_num_rows($rs) > 0)
        {
            while($row=$rs->fetch_assoc())
            {
                $data = $row;
            }
            return $data;
        }
        else
        {
            $data = array('id'=>'None','ip'=>'None','mi'=>'None','mx'=>'None','av'=>'None','pl'=>'None','ut'=>'None');
            return $data;
        }
    }

    function getIPDetails($ip)
    {
        $rs = $GLOBALS['mysqli']->query("select *from tree where ip='$ip'");
        $data = array();
        while($row = $rs->fetch_assoc())
        {
            $data = $row;
        }
        return $data;
    }

    function getTree($pid)
    {
        $rs = $GLOBALS['mysqli']->query("select *from tree where pid='$pid'");
        $child = array();
        $ips = array();
        $i = 0;
        while($row=$rs->fetch_array())
        {
            array_push($ips, $row['ip']);
            $child[$i] = array();
            $child[$i]['ip'] = $row['ip'];
            array_push($ips, $row['ip']);
            $child[$i]['id'] = $this->getTree($row['id']);
            $i++;
        }
        #print json_encode($child);
        return $ips;
    }

    
    function getChildAverage($ips)
    {
        $rs = $GLOBALS['mysqli']->query("select id from tree where ip='$ips'");
        $row = $rs->fetch_array();
        $ips = $row['id'];
        $ips = $this->getTree($ips);
        $ips = implode("','", $ips);
        $ips = "'".$ips."'";
        $mma = array("min"=>"","max"=>"","avg"=>"","ploss"=>"");
        $rs = $GLOBALS['mysqli']->query("select MIN(mi),MAX(mx),AVG(av),AVG(pl) from clink_status where ip in (".$ips.")");
        while($row=$rs->fetch_array())
        {
            $mma['min'] = round($row[0],2);
            $mma['max'] = round($row[1],2);
            $mma['avg'] = round($row[2],2);
            $mma['ploss'] = round($row[3],2);
        }
        return $mma;
    }

    function getGlobalInternetSpeed()
    {
        $rs = $GLOBALS['mysqli']->query("select avg(down),avg(up) from speedtest where status=1");
        $globalspeed = array("download"=>"","upload"=>"");
        while($row = $rs->fetch_array())
        {
            $globalspeed['download'] = round($row[0]/8, 2)." MB/s";
            $globalspeed['upload'] = round($row[1]/8, 2)." MB/s";
        }
        return $globalspeed;
    }
}

class extra
{
	function greeting()
    {
        if(date("H") < 12)
        {
            return "Good Morning";
 
        }
        elseif(date("H") > 11 && date("H") < 18)
        {
            return "Good Afternoon";
        }
        elseif(date("H") > 17)
        {
            return "Good Evening";
        }
 
    }

    function getUserData($uid)
    {
        $rs = $GLOBALS['mysqli']->query("select *from admin where uname='$uid'");
        $user = array();
        while($row = $rs->fetch_assoc())
        {
            $user = $row;
        }
        return $user;
    } 
}

class validation
{
    function check_empty($array)
    {
    	$check = True;
        foreach($array as $v)
        {
        	if(empty($v)) $check = False;
        }
        return $check;
    }
}


$parents = array();
    function getParents($pid)
    {
        $rs = $GLOBALS['mysqli']->query("select *from tree where id='$pid'");
        while($row = $rs->fetch_array())
        {
           array_push($GLOBALS['parents'], $row);
            getParents($row['pid']);
        }
    }

?>