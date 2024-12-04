<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class ReportController extends Controller
{
    public function showReportUser(): View|Factory|Application
    {
        return view('admin.page.report.user');
    }

    public function showReportTransaction(): View|Factory|Application
    {
        return view('admin.page.report.transaction');
    }

    public function showReportProject(): View|Factory|Application
    {
        return view('admin.page.report.project');
    }

    public function showPreviewExport(): View|Factory|Application
    {
        return view('admin.page.report.preview_export');
    }
}
