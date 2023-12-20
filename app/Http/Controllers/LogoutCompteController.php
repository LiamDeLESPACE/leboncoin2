<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogoutCompteController extends Controller
{
   //--------------------------------Déconnexion de compte
   function logout(Request $request){
    Auth::logout();              
    return redirect('/');
}
}

