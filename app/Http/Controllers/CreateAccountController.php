<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CreateAccountController extends Controller
{
    //---------------------------Affiche la page du type de compte à créer
    function showCreateAccount(){
        return view('create-account');
    }
} 