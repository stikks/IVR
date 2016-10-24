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
use App\Services\Index;
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
//            array("name" => "Send Image", "value" => "send_image"),
//            array("name" => "Transfer Call", "value" => "transfer_call"),
//            array("name" => "Play File", "value" => "play_file")
        ];

        return $this->view->render($response, 'templates/forms/campaign.twig', [
            'files' => $files,
            'options' => $options,
            'user' => $user
        ]);
    }

    public function postData($request, $response){

        $user = $this->auth->user();

        $match = ['name' => $request->getParam('file'), 'username' => $user->username];


        $file = Files::where($match)->first();
        
        $match = ['file_path' => $file->file_path, 'username' => $user->username];
        
        $campaign = Campaign::where($match)->first();

        if ($campaign)
        {
            $files = Files::where('username', $user->username)->get();
            $options = [
                array("name" => "Send Url", "value" => "send_url"),
                array("name" => "Send Message", "value" => "send_message"),
            ];
            $error =  "A campaign using this audio file already exists";
            return $this->view->render($response, 'templates/forms/campaign.twig', [
                'files' => $files,
                'options' => $options,
                'user' => $user,
                'error' => $error
            ]);
        }

        $start_date = DateTime::createFromFormat('d/m/Y', $request->getParam('start_date'))->format('Y-m-d');
        $end_date = DateTime::createFromFormat('d/m/Y', $request->getParam('end_date'))->format('Y-m-d');

        $validation = $this->validator->validate($request, [
            'file' => Val::notEmpty()->verifyFile(),
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('register'));
        }

        $command = 'cp '. $file->file_path. ' '. "/var/lib/asterisk/sounds/files/" . $user->username . '/'. $file->name;

        shell_exec($command);

        $_script = $request->getParam('action');

        if ($_script == 'send_message') {
            $scr = "SendText(". $request->getParam('body') . ")";
        }
        else {
            $scr = "SendURL(". $request->getParam('body') . ")";
        }
        
        $campaign = Campaign::create([
            'username' => $user->username,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'name' => $request->getParam('name'),
            'file_path' => $file->file_path,
            'description' => $request->getParam('description'),
            'value' => $request->getParam('action'),
            'body' => $request->getParam('body'),
            'script' => $scr,
            'play_path' => "/var/lib/asterisk/sounds/files/" . $user->username . '/'. $file->name
        ]);
//        elseif ($_script == 'send_url') {
//            $scr = "SendImage(". $request->getParam('body') . ")";
//        }
        
//        Action::create([
//            'number' => $request->getParam('number'),
//            'value' => $request->getParam('action'),
//            'body' => $request->getParam('body'),
//            'campaign_id' => $campaign->id,
//            'script' => $scr
//        ]);

        Index::index('campaign', [
            'username' => $campaign->username,
            'start_date' => $campaign->start_date,
            'end_date' => $campaign->end_date,
            'name' => $campaign->name,
            'file_path' => $campaign->file_path,
            'play_path' => $campaign->play_path,
            'description' => $campaign->description,
            'id' => $campaign->id,
            'created_at' => $campaign->created_at->format('Y-m-d'),
            'updated_at' => $campaign->updated_at->format('Y-m-d'),
            'value' => $campaign->action,
            'body' => $campaign->body,
            'script' => $campaign->script,
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

        $action = Action::where('campaign_id', $campaign->id)->first();

        $options = [
            array("name" => "Send Url", "value" => "send_url"),
            array("name" => "Send Message", "value" => "send_message"),
//            array("name" => "Send Image", "value" => "send_image"),
//            array("name" => "Transfer Call", "value" => "transfer_call"),
//            array("name" => "Play File", "value" => "play_file")
        ];

        return $this->view->render($response, 'templates/forms/update_campaign.twig', [
            'campaign' => $campaign,
            'user' => $user,
            'files' => $files,
            'start' => $start,
            'end' => $end,
            'action' => $action,
            'options' => $options
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

        $action = Action::where('campaign_id', $campaign->id)->first();

        $_script = $request->getParam('action');

        if ($_script == 'send_message') {
            $scr = "SendText(". $request->getParam('body') . ")";
        }
        else {
            $scr = "SendURL(". $request->getParam('body') . ")";
        }

        $action->update([
            'number' => $request->getParam('number'),
            'value' => $request->getParam('action'),
            'body' => $request->getParam('body'),
            'script' => $scr
        ]);
        
        return $response->withRedirect($this->router->pathFor('campaigns'));

    }
}