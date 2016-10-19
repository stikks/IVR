<?php

date_default_timezone_set('Africa/Lagos');

require __DIR__ . '/bootstrap/app.php';
use App\Services\Index;
use App\Models\Campaign;

$campaign = Campaign::where('id', 6)->first();

$index = Index::index('campaign', [
    'username' => $campaign->username,
    'start_date' => $campaign->start_date,
    'end_date' => $campaign->end_date,
    'name' => $campaign->name,
    'file_path' => $campaign->file_path,
    'description' => $campaign->description,
    'id' => $campaign->id
]);

var_dump($index);
exit();