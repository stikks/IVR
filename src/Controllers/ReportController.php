<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 10/6/16
 * Time: 11:17 AM
 */

namespace App\Controllers;
use App\Models\Campaign;

class ReportController extends BaseController
{

    public function getPage($request, $response){

        $user = $this->auth->user();

        return $this->view->render($response, 'templates/reports.twig',[
            'user' => $user
        ]);
    }

    public function getCampaign($request, $response, $args){

        $user = $this->auth->user();

        if (!isset($args['campaign_id'])) {
            return $response->withRedirect($this->router->pathFor('campaigns'));
        }

        $campaign_id = $args['campaign_id'];

        $campaign = Campaign::where('id', $campaign_id)->first();

        return $this->view->render($response, 'templates/campaign_report.twig', [
            'campaign_id' => $campaign->id
        ]);
    }
}
