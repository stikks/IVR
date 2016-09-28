<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 8/30/16
 * Time: 10:45 AM
 */

namespace App\Validation\Rules;
use App\Models\User;
use Respect\Validation\Rules\AbstractRule;

class PasswordCheck extends AbstractRule
{
    public function validate($input)
    {
        // TODO: Implement validate() method.
        return User::where('phone', $input)->count() === 0;
    }
}

