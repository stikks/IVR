<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 9/29/16
 * Time: 12:08 PM
 */

namespace App\Controllers;


class UploadController extends BaseController
{
    public function getPage($request, $response){

        return $this->view->render($response, 'templates/upload.twig');
    }

    public function postData($request, $response){

        var_dump($request->getParams());
        exit();
    }
}