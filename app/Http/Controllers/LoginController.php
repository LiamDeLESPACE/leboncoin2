<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin(Request $request) {
        
        return view('login');
    }
}
