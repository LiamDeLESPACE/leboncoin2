<?php

namespace App\Http\Controllers;

use App\Models\CreateAccount;
use Illuminate\Http\Request;

class CreateAccountController extends Controller
{
    public function showCreateAccount(Request $request) {
        
       

        

        return view('create-account');
    }
}
