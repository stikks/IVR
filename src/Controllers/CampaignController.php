<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 9/29/16
 * Time: 11:48 AM
 */

namespace App\Controllers;
use App\Models\Files;

class CampaignController extends BaseController
{
    public function getPage($request, $response){

        return $this->view->render($response, 'templates/campaigns.twig');
    }

    public function createCampaign($request, $response){

        $user = $this->auth->user();

        $files = Files::where('username', $user->username)->get();

        return $this->view->render($response, 'templates/forms/campaign.twig', [
            'files' => $files
        ]);
    }

    public function postData($request, $response){

        $user = $this->auth->user();

        $files = Files::where('username', $user->username)->get();

        var_dump($request->getParams());
        exit();
        
    }
}