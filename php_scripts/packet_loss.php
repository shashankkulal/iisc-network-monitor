<?php


function getpacketloss($address, $count) {
    $pl = array("Label"=>"Value","Loss"=>"");
    $command = 'ping -c %d %s';
    $output = shell_exec(sprintf($command, $count, $address));

    if (preg_match('/([0-9]*\.?[0-9]+)%(?:\s+packet)?\s+loss/', $output, $match) === 1) {
        $packetLoss = (float)$match[1]; 
    } else {
        throw new \Exception('Packet loss not found.');
    }
    #$temp = array_keys($pl);
    $pl['Loss'] = $packetLoss;
    $send = json_encode(array($pl));
    return $send;
    #print $send;
}
#getpacketloss($_GET['ip'],$_GET['interval']);
#getpacketloss("10.114.1.10", 2);
function getaveragedelay($address, $count)
{
    $pa = array("Label"=>"Value", "Delay"=>"");
    $command = 'ping -c '. $count .' '. $address .' | grep rtt | cut -d"/" -f5';
    $output = shell_exec($command);
    #$pa['Delay'] = $output;
    #$send = json_encode(array($pa));
    #return $send;
    return $output;
}

#getaveragedelay('10.114.1.10', '1');

?>