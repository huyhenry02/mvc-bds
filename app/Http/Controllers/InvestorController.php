<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class InvestorController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        return view('admin.page.investor.index');
    }

    public function showCreate(): View|Factory|Application
    {
        return view('admin.page.investor.create');
    }

    public function showUpdate(): View|Factory|Application
    {
        return view('admin.page.investor.update');
    }
}
