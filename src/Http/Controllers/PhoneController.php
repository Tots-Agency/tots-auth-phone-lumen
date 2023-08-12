<?php

namespace Tots\AuthPhone\Http\Controllers;

use Illuminate\Http\Request;
use Tots\Auth\Repositories\TotsUserRepository;
use Tots\Auth\Services\AuthService;
use Tots\AuthPhone\Http\Requests\PhoneLoginRequest;
use Tots\AuthPhone\Http\Responses\PhoneLoginResponse;
use Tots\FirebaseAuth\Services\FirebaseAuthService;

class PhoneController extends \Laravel\Lumen\Routing\Controller
{

    /**
     *
     * @var AuthService
     */
    protected $service;
    protected FirebaseAuthService $firebase;
    protected TotsUserRepository $userRepository;

    public function __construct(AuthService $service, FirebaseAuthService $firebase, TotsUserRepository $userRepository)
    {
        $this->service = $service;
        $this->firebase = $firebase;
        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {
        $this->validate($request, PhoneLoginRequest::rules());
        // Validate if token is valid
        $firebaseUser = $this->firebase->getUserByIdToken($request->input('token'));
        // Get User by Phone
        $user = $this->userRepository->fetchUserByPhone($firebaseUser->phoneNumber);
        // Return response
        return PhoneLoginResponse::make($user, $this->service->generateAuthToken($user));
    }
}
