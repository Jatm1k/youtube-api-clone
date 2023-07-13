<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response([
                'message' => 'Email has been already verified.'
            ]);
        }

        $request->user()->sendEmailVerificationNotification();

        return response([
            'message' => 'A new verification link has been sent.'
        ]);
    }
}
