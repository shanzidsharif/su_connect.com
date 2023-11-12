<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Mail;
use Str;

class AuthController extends Controller
{
    public function login()
    {
        if(!empty(Auth::check()))
        {
            if(Auth::user()->user_type == 1)
            {
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type == 2)
            {
                return redirect('lecturer/dashboard');
            }
            else if(Auth::user()->user_type == 3)
            {
                return redirect('student/dashboard');
            }
        }
        return view('auth.login');
    }


    public function authLogin(Request $request)
    {

        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
        {
            if(Auth::user()->user_type == 1)
            {

                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type == 2)
            {
                return redirect('lecturer/dashboard');
            }
            else if(Auth::user()->user_type == 3)
            {
                return redirect('student/dashboard');
            }

        }
        else
        {
            return redirect()->back()->with('error', 'Please Enter Valid Email and Password');
        }

    }


    public function forget()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $user = User::getEmailCheck($request->email);
        $content = [
            'subject' => 'Reset Your Password Mail',
            'body' => 'Click here and reset your password.'
        ];
        if(!empty($user))
        {
            $user->remember_token = Str::random(40);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($content, $user));
            return redirect()->back()->with('success', 'Check Your Email');
        }
        else
        {

            return redirect()->back()->with('error', 'Email Not found');
        }

    }

    public function resetPassword($p_token)
    {
        $user = User::getVerifyToken($p_token);
        if(!empty($user))
        {

            return view('auth.reset', [
                'user' => $user
            ]);
        }
        else
        {
            abort(404);
        }
    }

    public function postResetPassword($token, Request $request)
    {

        if($request->password == $request->confirm_password)
        {
            $user = User::getVerifyToken($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(40);
            $user->save();
            return redirect('')->with('success', 'Password changed Successfully');
        }
        else
        {
            return redirect()->back()->with('error', 'Password and Confirm Password does not matched!!!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }

}
