#!/usr/local/bin/php -q
<?php
/**
 * @package phpAGI_examples
 * @version 2.0
 */

set_time_limit(30);
require('phpagi.php');
require('/var/www/html/marketing/vendor/predis/predis/autoload.php');
use Predis\Client;

$agi = new AGI();

$redis = new Client();

$value = $redis->hget($agi->get_variable('CDR(uniqueid)')['data'], "value");
$body = $redis->hget($agi->get_variable('CDR(uniqueid)')['data'], "body");

if ($value == 'send_message') {
   $agi->send_text($body);
} 

$ch = curl_init();
$url = 'http://localhost:4043/elastic/cdr/success';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);

$body = array(
    "uniqueid" => $agi->get_variable('CDR(uniqueid)')['data']
);

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));

$resp = curl_exec($ch);

curl_close($ch);

return 200;
?>


