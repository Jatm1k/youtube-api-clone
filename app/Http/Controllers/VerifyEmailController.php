<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response([
                'message' => 'Email has been already verified.'
            ]);
        }

        $request->user()->markEmailAsVerified();

        return response([
            'message' => 'Email has been successfully verified.'
        ]);
    }
}
