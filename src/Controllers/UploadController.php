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
require_once(__DIR__. '/../../getID3/getid3/getid3.php');
use getID3;

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
                if (file_exists(realpath(__DIR__ . '/../..'). "/files/".$user->username. '/' . $_FILES["advert"]["name"]))
                {
                    $error =  $_FILES["advert"]["name"] . " already exists. ";
                    return $this->view->render($response, 'templates/upload.twig', [
                        'error' => $error
                    ]);
                }
                else
                {
                    move_uploaded_file($_FILES["advert"]["tmp_name"],
                        realpath(__DIR__ . '/../..'). "/files/" . $user->username . '/temp_' . $_FILES["advert"]["name"]);
//                    Converter::convert(realpath(__DIR__ . '/../..'). "/files/" . $user->username . '/temp_'. $_FILES["advert"]["name"], explode(".", $_FILES["advert"]["name"])[0], realpath(__DIR__ . '/../..'). "/files/"  . $user->username . '/');

                    $name = preg_replace('/\s+/', '', explode(".", $_FILES["advert"]["name"])[0]);

                    $address = '/usr/bin/ffmpeg -y -i '. realpath(__DIR__ . '/../..'). "/files/" . $user->username . '/temp_'. $_FILES["advert"]["name"] .' -acodec adpcm_ms '. realpath(__DIR__ . '/../..'). "/files/"  . $user->username . '/'. $name . '.wav';

                    shell_exec($address);

                    $file_path = realpath(__DIR__ . '/../..'). "/files/" . $user->username . '/' . explode(".", $_FILES["advert"]["name"])[0]. '.wav';

                    $getID3 = new getID3;
                    $info = $getID3->analyze( $file_path );
                    $play_time = $info['playtime_string'];

                    list($mins , $secs) = explode(':' , $play_time);

                    $hours = 0;

                    if($mins > 60)
                    {
                        $hours = intval($mins / 60);
                        $mins = $mins - $hours*60;
                    }

                    $play_time = sprintf("%02d:%02d:%02d" , $hours , $mins , $secs);

                    $file = Files::create([
                        "username" => $user->username,
                        "file_path" => $file_path,
                        "size" => (float)($_FILES["advert"]["size"] / 1024),
                        "name" => explode(".", $_FILES["advert"]["name"])[0] . '.wav',
                        "file_type" => "audio/x-wav",
                        "duration" => $play_time,
                        "description" => $request->getParam('description')
                    ]);
                    return $this->view->render($response, 'templates/upload.twig', [
                        "message" => $file->name . " was successfully uploaded"
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