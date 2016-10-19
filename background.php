<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 10/19/16
 * Time: 10:54 AM
 */
require __DIR__ . '/bootstrap/app.php';
use App\Models\Campaign;
use App\Models\Files;

$now = date('Y-m-d');

$campaigns = Campaign::all();

//print_r($campaigns);

foreach ($campaigns as $value) {
    if ($value->created_at < $now) {
        $value->deactivate();
        $file = Files::where('file_path', $value->file_path);
        unlink("/var/lib/asterisk/sounds/files/" . $value->username . '/' . $file->name);
    }
}