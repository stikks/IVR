<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 9/28/16
 * Time: 8:14 AM
 */

namespace App\Controllers;


class IndexController extends BaseController
{
    public function index($request, $response){

        return $this->view->render($response, 'templates/home.twig');
    }

}