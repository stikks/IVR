<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 9/28/16
 * Time: 1:53 AM
 */

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$app->group('', function (){
    
    $this->get('/login', 'LoginController:getPage')->setName('login');
    
    $this->post('/login', 'LoginController:postData');

})->add(new GuestMiddleware($container));
    
$app->group('', function (){

    $this->get('/', 'IndexController:index')->setName('index');

    $this->get('/campaigns', 'CampaignController:getPage')->setName('campaigns');

    $this->get('/campaigns/create', 'CreateCampaignController:getPage')->setName('create_campaign');

    $this->get('/upload', 'UploadController:getPage')->setName('upload');

    $this->post('/upload', 'UploadController:postData');

    $this->get('/files', 'FileController:getPage')->setName('files');

    $this->post('/settings', 'SettingsController:postData');

    $this->get('/logout', 'IndexController:logOut')->setName('logout');

})->add(new AuthMiddleware($container));

