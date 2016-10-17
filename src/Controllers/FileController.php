<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 9/29/16
 * Time: 12:39 PM
 */

namespace App\Controllers;
use App\Models\Files;

class FileController extends BaseController
{
    public function getPage($request, $response){

        $user = $this->auth->user();

        $files = Files::where("username", $user->username)->get();

        var_dump($files);
        exit();

        return $this->view->render($response, 'templates/files.twig');
    }

}