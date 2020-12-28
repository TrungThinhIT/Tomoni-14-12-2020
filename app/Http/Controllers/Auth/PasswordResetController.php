<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Services\Auth\PasswordResetService;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    protected $passwordResetService;

    public function __construct(PasswordResetService $passwordResetService)
    {
        $this->passwordResetService = $passwordResetService;
    }
    public function index(){
        return $this->passwordResetService->getIndex();
    }

    public function sendToken(Request $request){
        return $this->passwordResetService->doSendToken($request);
    }

    public function indexChangePassword($token){
        return $this->passwordResetService->getTokenChangePassword($token);
    }

    public function doChangePasswordReset(PasswordResetRequest $request){
        return $this->passwordResetService->doChangePasswordReset($request);
    }
}
