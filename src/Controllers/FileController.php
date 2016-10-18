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
        
        $files = json_encode(Files::all());

        return $this->view->render($response, 'templates/files.twig', [
            'files' => $files,
            'username' => $user->username
        ]);
    }

}