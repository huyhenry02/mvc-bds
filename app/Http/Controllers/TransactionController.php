<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class TransactionController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        return view('admin.page.transaction.index');
    }
}
