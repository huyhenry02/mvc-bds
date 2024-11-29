<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class IndexCustomerController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        return view('customer.page.index');
    }

    public function showProjects(): View|Factory|Application
    {
        return view('customer.page.projects');
    }

    public function showProjectDetail(): View|Factory|Application
    {
        return view('customer.page.project-detail');
    }

    public function showService(): View|Factory|Application
    {
        return view('customer.page.service');
    }

    public function showAbout(): View|Factory|Application
    {
        return view('customer.page.about');
    }
}
