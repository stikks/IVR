<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 8/5/16
 * Time: 11:51 AM
 */

namespace App\Validation\Rules;
use App\Models\User;
use Respect\Validation\Rules\AbstractRule;


class VerifyAccount extends AbstractRule
{

    public function validate($input)
    {
        // TODO: Implement validate() method.
        $user = User::where('phone', $input)->get();

        if ($user) {
            return true;
        }

        return false;
    }
}