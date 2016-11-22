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

        $start_date = DateTime::createFromFormat('d/m/Y', $request->getParam('start_date'))->format('Y-m-d');
        $end_date = DateTime::createFromFormat('d/m/Y', $request->getParam('end_date'))->format('Y-m-d');

        $url = 'http://localhost:4043/elastic/campaign/'.$campaign_id.'/download';

        $params = [
            'start_date' => $start_date,
            'end_date' => $end_date
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec ($ch);

        curl_close ($ch);

        $value = json_decode($resp);
        $res = $value->result;

        $data = array();

        foreach ($res as $v) {
            array_push($data, array('date'=>$v->created_at,
                'impression_count'=>$v->impression_count, 'cdr_count'=>$v->cdr_count, 'success_count'=>$v->success_count));
        }

        $excel = new \PHPExcel();
        $excel->getProperties()
            ->setCreator('IVR Marketing Platform')
            ->setTitle('PHPExcel Demo')
            ->setSubject('PHP Excel manipulation');

        $worksheet = $excel->getSheet(0);
        $worksheet->setTitle('Sheet');
        $worksheet->setCellValue('a1', 'Date');
        $worksheet->setCellValue('b1', 'CDR Count');
        $worksheet->setCellValue('c1', 'Impression Count');
        $worksheet->setCellValue('d1', 'Success Count');

        $header = 'a1:d1';
        $style = array(
            'font' => array('bold' => true,),
            'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
        );
        $worksheet->getStyle($header)->applyFromArray($style);

        for ($col = ord('a'); $col <= ord('h'); $col++)
        {
            $worksheet->getColumnDimension(chr($col))->setAutoSize(true);
        }

        $worksheet->fromArray($data, ' ', 'A2');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='. $campaign->name. $start_date. '_'. $end_date.'".xls"');
        header('Cache-Control: max-age=0');

        $writer = \PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $writer->save('php://output');

        return $response->withRedirect($this->router->pathFor('campaigns'));
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

        $url = 'http://localhost:4043/elastic/campaign/'.$campaign_id.'/download';
        $campaign = Campaign::where('id', $campaign_id)->first();

        $params = [
            'start_date' => $start_date,
            'end_date' => $end_date
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec ($ch);

        curl_close ($ch);

        $value = json_decode($resp);
        $res = $value->result;

        $data = array();

        foreach ($res as $v) {
            array_push($data, array('date'=>$v->created_at,
                'impression_count'=>$v->impression_count, 'cdr_count'=>$v->cdr_count, 'success_count'=>$v->success_count));
        }

        $excel = new \PHPExcel();
        $excel->getProperties()
            ->setCreator('IVR Marketing Platform')
            ->setTitle('PHPExcel Demo')
            ->setSubject('PHP Excel manipulation');

        $worksheet = $excel->getSheet(0);
        $worksheet->setTitle('Sheet');
        $worksheet->setCellValue('a1', 'Date');
        $worksheet->setCellValue('b1', 'CDR Count');
        $worksheet->setCellValue('c1', 'Impression Count');
        $worksheet->setCellValue('d1', 'Success Count');

        $header = 'a1:d1';
        $style = array(
            'font' => array('bold' => true,),
            'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
        );
        $worksheet->getStyle($header)->applyFromArray($style);

        for ($col = ord('a'); $col <= ord('h'); $col++)
        {
            $worksheet->getColumnDimension(chr($col))->setAutoSize(true);
        }

        $worksheet->fromArray($data, ' ', 'A2');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='. $campaign->name. $start_date. '_'. $end_date.'".xls"');
        header('Cache-Control: max-age=0');

        $writer = \PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $writer->save('php://output');
//        $writer->save(''. $campaign->name. $start_date. '_'. $end_date. '.xlsx');

        return $response->withRedirect($this->router->pathFor('campaigns'));
    }
}
