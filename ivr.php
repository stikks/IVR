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

$url = 'http://localhost:4043/api/elasticsearch/cdr/create';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);

$body = array(
    "clid" => $agi->get_variable('CDR(clid)'),
    "src" => $agi->get_variable('CDR(src)'),
    "duration" => $agi->get_variable('CDR(duration)'),
    "billsec" => $agi->get_variable('CDR(billsec)'),
    "uniqueid" => $agi->get_variable('CDR(uniqueid)'),
    "userfield" => $agi->get_variable('CDR(userfield)')
);

curl_setopt($ch, CURLOPT_POSTFIELDS,
    http_build_query($body));

$resp = curl_exec($ch);

curl_close($ch);

$agi->hangup();
?>

