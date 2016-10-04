<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 9/30/16
 * Time: 3:00 PM
 */

namespace App\Controllers;


class CreateCampaignController extends BaseController
{

    public function getPage($request, $response){

        return $this->view->render($response, 'templates/forms/campaign.twig');
    }
}