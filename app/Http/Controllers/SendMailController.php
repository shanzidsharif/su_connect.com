<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SendMailController extends Controller
{
    public function index()
    {
        $user = User::getEmailCheck($request->email);
        $content = [
            'subject' => 'Reset Your Password Mail',
            'body' => 'Click here and reset your password.'
        ];

        Mail::to('$user->email')->send(new SampleMail($content, $user));

        return "Email has been sent.";
    }
}
