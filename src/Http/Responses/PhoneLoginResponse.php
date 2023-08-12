<?php

namespace Tots\AuthPhone\Http\Responses;

use Tots\Auth\Models\TotsUser;

/**
 * Description of Model
 *
 * @author matiascamiletti
 */
class PhoneLoginResponse
{
    static public function make(TotsUser $user, string $token)
    {
        $data = $user->toArray();
        $data['token_type'] = 'bearer';
        $data['access_token'] = $token;
        return $data;
    }
}