<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class AuthController extends Controller
{
    public function showLogin(): View|Factory|Application
    {
        return view('auth.login');
    }

    public function showRegister(): View|Factory|Application
    {
        return view('auth.register');
    }
}
