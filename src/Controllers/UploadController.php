<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 9/29/16
 * Time: 12:08 PM
 */

namespace App\Controllers;
use App\Models\Files;
use App\Services\Converter;

class UploadController extends BaseController
{
    public function getPage($request, $response){

        $error = null;

        return $this->view->render($response, 'templates/upload.twig', [
            'error' => $error
        ]);
    }

    public function postData($request, $response){

        $user = $this->auth->user();
        
        if (($_FILES["advert"]["size"] < 20000000))

        {
            if ($_FILES["advert"]["error"] > 0)
            {
                $error =  $_FILES["advert"]["name"] . " is an invalid file, No audio codec provided";
                return $this->view->render($response, 'templates/upload.twig', [
                    'error' => $error
                ]);
            }
            else
            {
                if (file_exists("files/".$user->username. '/' . $_FILES["advert"]["name"]))
                {
                    $error =  $_FILES["advert"]["name"] . " already exists. ";
                    return $this->view->render($response, 'templates/upload.twig', [
                        'error' => $error
                    ]);
                }
                else
                {
                    move_uploaded_file($_FILES["advert"]["tmp_name"],
                        "files/" . $user->username . '/' . $_FILES["advert"]["name"]);
                    $file = Files::create([
                        "username" => $user->username,
                        "file_path" => "files/" . $_FILES["advert"]["name"],
                        "size" => (float)($_FILES["advert"]["size"] / 1024),
                        "name" => $_FILES["advert"]["name"],
                        "file_type" => $_FILES["advert"]["type"],
                        "duration" => null
                    ]);
                    Converter::convert("files/" . $_FILES["advert"]["name"], explode(".", $_FILES["advert"]["name"]));
                    return $this->view->render($response, 'templates/upload.twig', [
                        "message" => $file->name . "successfully uploaded"
                    ]);
                }
            }
        }
        else
        {
            $error =  $_FILES["advert"]["name"] . " is an invalid file, No audio codec provided";
            return $this->view->render($response, 'templates/upload.twig', [
                'error' => $error
            ]);
        }

    }
}