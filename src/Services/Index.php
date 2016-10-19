<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 10/19/16
 * Time: 6:13 PM
 */

namespace App\Services;


class Index
{
    public function index() {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"http://localhost:4043/tester.phtml");
        curl_setopt($ch, CURLOPT_POST, 1);
         curl_setopt($ch, CURLOPT_POSTFIELDS, 
                  http_build_query(array('postvar1' => 'value1')));
        
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        curl_close ($ch);

    // further processing ....
        if ($server_output == "OK") { ... } else { ... }
    }

}