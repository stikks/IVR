<?php
$fp = fsockopen("127.0.0.1", 6379, $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    //$out = "*2\r\n\$4\r\nEcho\r\n\$4\r\n1000\r\n";
    //$out = "*3\r\n$3\r\nSET\r\nkey\r\n$4\r\nfred\r\n";
    //$out = "*5\r\n:1\r\n:2\r\n:3\r\n:4\r\n$6\r\nfoobar\r\n";
    //fwrite($fp, $out);
    $res = "*2\r\n$3\r\nGET\r\n$3\r\nkey\r\n";
    fwrite($fp, $res);
    if (!feof($fp)) {
        echo fgets($fp, 4096);
    }
    //for($i=0; $i<2; $i++) {
  	//echo fgets($fp);
    //}
    fclose($fp);
}
?>
