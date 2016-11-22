<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 10/6/16
 * Time: 11:17 AM
 */

namespace App\Controllers;
use App\Models\Campaign;
use DateTime;

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

    public function DownloadCampaign($request, $response, $args){

        if (!isset($args['campaign_id'])) {
            return $response->withRedirect($this->router->pathFor('campaigns'));
        }

        $campaign_id = $args['campaign_id'];

        $campaign = Campaign::where('id', $campaign_id)->first();

        return $this->view->render($response, 'templates/download_campaign.twig', [
            'campaign_id' => $campaign->id
        ]);
    }

    public function postDownloadCampaign($request, $response, $args){

        if (!isset($args['campaign_id'])) {
            return $response->withRedirect($this->router->pathFor('campaigns'));
        }

        $campaign_id = $args['campaign_id'];

        $campaign = Campaign::where('id', $campaign_id)->first();

        return $this->view->render($response, 'templates/download_campaign.twig', [
            'campaign_id' => $campaign->id
        ]);
    }

    public function Download($request, $response){

        $campaigns = Campaign::all();

        return $this->view->render($response, 'templates/download.twig', [
            'campaigns' => $campaigns
        ]);
    }

    public function postDownload($request, $response){

        $campaign_id = $request->getParam('campaign_id');

        $start_date = DateTime::createFromFormat('d/m/Y', $request->getParam('start_date'))->format('Y-m-d');
        $end_date = DateTime::createFromFormat('d/m/Y', $request->getParam('end_date'))->format('Y-m-d');

        return $this->view->render($response, 'templates/download.twig');
    }
}
