<?php

/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 10/13/16
 * Time: 2:35 PM
 */
namespace App\Services;

use FFMpeg;

class Converter
{
    protected $ffmpeg;

    static public function convert($file_path, $filename)
    {
        $ffmpeg = FFMpeg\FFMpeg::create();

        $audio = $ffmpeg->open($file_path);

        $format = new ADPCM();
        
        $format-> setAudioChannels(2)-> setAudioKiloBitrate(256);

        $audio->save($format, $filename . '.wav');
    }
}