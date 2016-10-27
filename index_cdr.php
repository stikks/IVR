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
$ch = curl_init();

$redis = new Client();

if (!$redis->exists("current")) {
    $redis->set('current', 'etisalat');
}

$current = $redis->get("current");

if ($current == "etisalat") {
    $name = 'etisalat';
    $current = $redis->set("current", "tm30");
}
else {
    $name = 'tm30';
    $current = $redis->set("current", "etisalat");
}

$files = glob("/var/lib/asterisk/sounds/files/" .$name. '/*.wav');
$file = array_rand($files);

$_file = explode("/", $files[$file]);
$_files = explode(".", end($_file));
$agi->stream_file("files/".$name."/".current($_files));

$file_path = "/var/lib/asterisk/sounds/files/" .$name. '/'. current($_files) . '.wav';

$url = 'http://localhost:4043/elastic/elasticsearch/cdr/create';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);

$body = array(
    "clid" => $agi->get_variable('CDR(clid)')['data'],
    "src" => $agi->get_variable('CDR(src)')['data'],
    "duration" => $agi->get_variable('CDR(duration)')['data'],
    "billsec" => $agi->get_variable('CDR(billsec)')['data'],
    "uniqueid" => $agi->get_variable('CDR(uniqueid)')['data'],
    "file_path" => $file_path
);

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));

$resp = curl_exec($ch);

if(curl_error($ch))
{
    echo 'error:' . curl_error($ch);
}
else {
    echo $content;  
}

curl_close($ch);

return 200;
?>


