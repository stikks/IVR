<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 9/29/16
 * Time: 11:48 AM
 */

namespace App\Controllers;


class CampaignController extends BaseController
{
    public function getPage($request, $response){

        return $this->view->render($response, 'templates/campaigns.twig');
    }

}