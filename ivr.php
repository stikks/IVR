#!/usr/local/bin/php -q
<?php
/**
 * @package phpAGI_examples
 * @version 2.0
 */

set_time_limit(30);
require('phpagi.php');
//include('agi-utils.php');

$agi = new AGI();
$ch = curl_init();

$url = 'http://localhost/marketing/cdr';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);

$body = array(
    "clid" => $agi->get_variable('CDR(clid)'),
    "src" => $agi->get_variable('CDR(src)'),
    "dst" => $agi->get_variable('CDR(dst)'),
    "dcontext" => $agi->get_variable('CDR(dcontext)'),
    "channel" => $agi->get_variable('CDR(channel)'),
    "dstchannel" => $agi->get_variable('CDR(dstchannel)'),
    "start" => $agi->get_variable('CDR(start)'),
    "answer" => $agi->get_variable('CDR(answer)'),
    "end" => $agi->get_variable('CDR(end)'),
    "duration" => $agi->get_variable('CDR(duration)'),
    "billsec" => $agi->get_variable('CDR(billsec)'),
    "disposition" => $agi->get_variable('CDR(disposition)'),
    "accountcode" => $agi->get_variable('CDR(accountcode)'),
    "uniqueid" => $agi->get_variable('CDR(uniqueid)'),
    "userfield" => $agi->get_variable('CDR(userfield)')
);

curl_setopt($ch, CURLOPT_POSTFIELDS,
    http_build_query($body));

$resp = curl_exec($ch);

curl_close($ch);

$agi->hangup();
?>

