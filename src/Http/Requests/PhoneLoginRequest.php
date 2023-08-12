<?php

namespace Tots\AuthPhone\Http\Requests;

/**
 * Description of Model
 *
 * @author matiascamiletti
 */
class PhoneLoginRequest
{
    static public function rules()
    {
        return [
            'email' => 'required|email',
            'token' => 'required|string',
        ];
    }
}