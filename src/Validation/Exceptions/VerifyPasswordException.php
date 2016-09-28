<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 8/5/16
 * Time: 11:55 AM
 */

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class VerifyPasswordException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Invalid Phone/Password Combination'
        ]
    ];

}