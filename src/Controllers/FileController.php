<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 9/29/16
 * Time: 12:39 PM
 */

namespace App\Controllers;


class FileController extends BaseController
{
    public function getPage($request, $response){

        return $this->view->render($response, 'templates/files.twig');
    }

}