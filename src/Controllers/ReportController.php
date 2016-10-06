<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 10/6/16
 * Time: 11:17 AM
 */

namespace App\Controllers;


class ReportController extends BaseController
{

    public function getPage($request, $response){

        return $this->view->render($response, 'templates/reports.twig');
    }
}
