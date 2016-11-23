<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 9/28/16
 * Time: 8:14 AM
 */

namespace App\Controllers;
use App\Services\Index;
use App\Models\Settings;


class SettingsController extends BaseController
{

    public function getPage($request, $response) {

        return $this->view->render($response, 'templates/forms/settings.twig');
    }

    public function postData($request, $response){

        $settings = Settings::create([
            'limit' => $request->getParam('limit')
        ]);

        Index::index('settings', [
            'limit' => $settings->limit,
            'file_path' => $settings->file_path
            ]
        );

        return $response->withRedirect($this->router->pathFor('settings'));

    }
}