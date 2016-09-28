<?php

/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 8/4/16
 * Time: 11:50 PM
 */
namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class PhoneAvailableException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Phone is already Taken'
        ]
    ];

}