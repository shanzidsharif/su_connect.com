<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $title['title'] = 'Dashboard';
        if(Auth::user()->user_type == 1)
        {
            return view('admin.admin.dashboard', $title);
        }
        else if(Auth::user()->user_type == 2)
        {
            return view('lecturer.dashboard', $title);
        }
        else if(Auth::user()->user_type == 3)
        {
            return view('student.dashboard', $title);
        }
    }

}
