<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 8/5/16
 * Time: 11:54 AM
 */

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class VerifyAccountException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'User Account does not exist'
        ]
    ];

}