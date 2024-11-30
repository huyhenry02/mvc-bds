<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class UserController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        $uses = User::all();
        return view('admin.page.user.index'
            , [
                'users' => $uses
            ]);
    }

    public function showCreate(): View|Factory|Application
    {
        return view('admin.page.user.create');
    }

    public function showUpdate(): View|Factory|Application
    {
        return view('admin.page.user.update');
    }
}
