<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 9/29/16
 * Time: 11:48 AM
 */

namespace App\Controllers;
use App\Models\Campaign;
use App\Models\Files;
use DateTime;
use Respect\Validation\Validator as Val;
use App\Models\Action;

class CampaignController extends BaseController
{
    public function getPage($request, $response){

        $user = $this->auth->user();

        $campaigns = json_encode(Campaign::all());

        return $this->view->render($response, 'templates/campaigns.twig', [
            'campaigns' => $campaigns,
            'username' => $user->username
        ]);
    }

    public function createCampaign($request, $response){

        $user = $this->auth->user();

        $files = Files::where('username', $user->username)->get();

        $options = [
            array("name" => "Send Url", "value" => "send_url"),
            array("name" => "Send Message", "value" => "send_message"),
            array("name" => "Send Image", "value" => "send_image"),
            array("name" => "Transfer Call", "value" => "transfer_call"),
            array("name" => "Play File", "value" => "play_file")
        ];

        return $this->view->render($response, 'templates/forms/campaign.twig', [
            'files' => $files,
            'options' => $options
        ]);
    }

    public function postData($request, $response){

        $user = $this->auth->user();

        $start_date = DateTime::createFromFormat('d/m/Y', $request->getParam('start_date'))->format('Y-m-d');
        $end_date = DateTime::createFromFormat('d/m/Y', $request->getParam('end_date'))->format('Y-m-d');

        $validation = $this->validator->validate($request, [
            'file' => Val::notEmpty()->verifyFile(),
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('register'));
        }

        $file = Files::where('name', $request->getParam('file'))->first();
        
        $campaign = Campaign::create([
            'username' => $user->username,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'name' => $request->getParam('name'),
            'file_path' => $file->file_path,
            'description' => $request->getParam('description')
        ]);
        
        Action::create([
            'number' => $request->getParam('number'),
            'value' => $request->getParam('action'),
            'body' => $request->getParam('body'),
            'campaign_id' => $campaign->id
        ]);
        
        return $response->withRedirect($this->router->pathFor('campaigns'));

    }

    public function updateCampaign($request, $response, $args){

        $user = $this->auth->user();

        if (!isset($args['campaign_id'])) {
            return $response->withRedirect($this->router->pathFor('campaigns'));
        }

        $files = Files::where('username', $user->username)->get();

        $campaign_id = $args['campaign_id'];

        $campaign = Campaign::where('id', $campaign_id)->first();

        $start_date = new DateTime($campaign->start_date);
        $start = $start_date->format('d/m/Y');


        $end_date = new DateTime($campaign->end_date);
        $end = $end_date->format('d/m/Y');
        
        return $this->view->render($response, 'templates/forms/update_campaign.twig', [
            'campaign' => $campaign,
            'user' => $user,
            'files' => $files,
            'start' => $start,
            'end' => $end
        ]);
    }

    public function postUpdate($request, $response, $args){

        if (!isset($args['campaign_id'])) {
            return $response->withRedirect($this->router->pathFor('campaigns'));
        }

        $campaign_id = $args['campaign_id'];

        $campaign = Campaign::where('id', $campaign_id)->first();

        $start_date = DateTime::createFromFormat('d/m/Y', $request->getParam('start_date'))->format('Y-m-d');
        $end_date = DateTime::createFromFormat('d/m/Y', $request->getParam('end_date'))->format('Y-m-d');

        $campaign->update([
            'name' => $request->getParam('name'),
            'description' => $request->getParam('description'),
            'start_date' => $start_date,
            'end_date' => $end_date
        ]);
        
        return $response->withRedirect($this->router->pathFor('campaigns'));

    }
}