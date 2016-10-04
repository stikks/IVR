<?php

$c = fsockopen('127.0.0.1', 6379);

//$rawCommand = "*2\r\n\$4\r\nEcho\r\n\$12\r\nhello world!\r\n";

$raw = '*3\r\n$3\r\nSET\r\n$3\r\nkey\r\n$8\r\nmy value\r\n';

echo $raw;

$res = fwrite($c, $raw);

$rawResponse = fgets($c);
echo $rawResponse; // $12

//$rawResponse = fgets($c);
//echo $rawResponse;
