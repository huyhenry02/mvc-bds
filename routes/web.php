<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\PlotController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\IndexCustomerController;

Route::get('/', function () {
    return  redirect()->route('customer.showIndex');
});
Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.showRegister');
    Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('auth.showChangePassword');

    Route::post('/register', [AuthController::class, 'postRegister'])->name('auth.postRegister');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('auth.postLogin');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');
    Route::post('/change-password', [AuthController::class, 'postChangePassword'])->name('auth.postChangePassword')->middleware('auth');
});
Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth']
], function () {
    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::get('/', [UserController::class, 'showIndex'])->name('user.showIndex');
        Route::get('/create', [UserController::class, 'showCreate'])->name('user.showCreate');
        Route::get('/update/{user}', [UserController::class, 'showUpdate'])->name('user.showUpdate');

        Route::get('/admin/search-users', [UserController::class, 'searchUsers'])->name('admin.searchUsers');
        Route::post('/update/{user}', [UserController::class, 'postUpdate'])->name('user.postUpdate');

    });

    Route::group([
        'prefix' => 'investor'
    ], function () {
        Route::get('/', [InvestorController::class, 'showIndex'])->name('investor.showIndex');
        Route::get('/create', [InvestorController::class, 'showCreate'])->name('investor.showCreate');
        Route::get('/update/{investor}', [InvestorController::class, 'showUpdate'])->name('investor.showUpdate');
        Route::get('/admin/search-investors', [InvestorController::class, 'searchInvestors'])->name('admin.searchInvestors');

        Route::post('/create', [InvestorController::class, 'postCreate'])->name('investor.postCreate');
        Route::post('/update/{investor}', [InvestorController::class, 'postUpdate'])->name('investor.postUpdate');
        Route::get('/delete/{investor}', [InvestorController::class, 'delete'])->name('investor.delete');
    });

    Route::group([
        'prefix' => 'report'
    ], function () {
        Route::get('/user', [ReportController::class, 'showReportUser'])->name('report.showReportUser');
        Route::get('/transaction', [ReportController::class, 'showReportTransaction'])->name('report.showReportTransaction');
        Route::get('/project', [ReportController::class, 'showReportProject'])->name('report.showReportProject');
        Route::get('/preview-export', [ReportController::class, 'showPreviewExport'])->name('report.showPreviewExport');
        Route::post('/data-transaction', [ReportController::class, 'showDataTransaction'])->name('report.showDataTransaction');

        Route::post('/generate-pdf', [ReportController::class, 'generatePDF'])->name('report.generatePDF');
        Route::get('/data-chart/time_type={timeType}/type_chart={typeChart}', [ReportController::class, 'showDataChart'])->name('report.showDataUser');
    });

    Route::group([
        'prefix' => 'zone'
    ], function () {
        Route::get('/', [ZoneController::class, 'showIndex'])->name('zone.showIndex');
        Route::get('/create', [ZoneController::class, 'showCreate'])->name('zone.showCreate');
        Route::get('/update{zone}', [ZoneController::class, 'showUpdate'])->name('zone.showUpdate');
        Route::get('/admin/search-zones', [ZoneController::class, 'searchZones'])->name('admin.searchZones');

        Route::post('/create', [ZoneController::class, 'postCreate'])->name('zone.postCreate');
        Route::post('/update/{zone}', [ZoneController::class, 'postUpdate'])->name('zone.postUpdate');
        Route::get('/delete/{zone}', [ZoneController::class, 'delete'])->name('zone.delete');
    });

    Route::group([
        'prefix' => 'plot'
    ], function () {
        Route::get('/', [PlotController::class, 'showIndex'])->name('plot.showIndex');
        Route::get('/create', [PlotController::class, 'showCreate'])->name('plot.showCreate');
        Route::get('/update/{plot}', [PlotController::class, 'showUpdate'])->name('plot.showUpdate');
        Route::get('/get-zones-of-project', [PlotController::class, 'getZonesOfProject'])->name('plot.getZonesOfProject');
        Route::get('/admin/search-plots', [PlotController::class, 'searchPlots'])->name('admin.searchPlots');

        Route::post('/create', [PlotController::class, 'postCreate'])->name('plot.postCreate');
        Route::post('/update/{plot}', [PlotController::class, 'postUpdate'])->name('plot.postUpdate');
        Route::get('/delete/{plot}', [PlotController::class, 'delete'])->name('plot.delete');
    });

    Route::group([
        'prefix' => 'project'
    ], function () {
        Route::get('/', [ProjectController::class, 'showIndex'])->name('project.showIndex');
        Route::get('/create', [ProjectController::class, 'showCreate'])->name('project.showCreate');
        Route::get('/update/{project}', [ProjectController::class, 'showUpdate'])->name('project.showUpdate');
        Route::get('/get-districts', [ProjectController::class, 'getDistricts'])->name('project.getDistricts');
        Route::get('/admin/search-projects', [ProjectController::class, 'searchProjects'])->name('admin.searchProjects');

        Route::post('/create', [ProjectController::class, 'postCreate'])->name('project.postCreate');
        Route::post('/update/{project}', [ProjectController::class, 'postUpdate'])->name('project.postUpdate');
        Route::get('/delete/{project}', [ProjectController::class, 'delete'])->name('project.delete');
    });

    Route::group([
        'prefix' => 'transaction'
    ], function () {
        Route::get('/', [TransactionController::class, 'showIndex'])->name('transaction.showIndex');
        Route::get('/admin/search-transactions', [TransactionController::class, 'searchTransactions'])->name('admin.searchTransactions');

        Route::post('/update-status', [TransactionController::class, 'updateStatus'])->name('transaction.updateStatus');
    });
});
Route::group([
    'prefix' => 'customer'
], function () {
    Route::get('/index', [IndexCustomerController::class, 'showIndex'])->name('customer.showIndex');
    Route::get('/projects', [IndexCustomerController::class, 'showProjects'])->name('customer.showProjects');
    Route::get('/project-detail/{project}', [IndexCustomerController::class, 'showProjectDetail'])->name('customer.showProjectDetail');
    Route::get('/service', [IndexCustomerController::class, 'showService'])->name('customer.showService');
    Route::get('/about', [IndexCustomerController::class, 'showAbout'])->name('customer.showAbout');
    Route::get('/transaction', [IndexCustomerController::class, 'showTransaction'])->name('customer.showTransaction')->middleware('auth');
    Route::get('/projects/search', [IndexCustomerController::class, 'searchProjects'])->name('customer.searchProjects');


    Route::post('/transaction', [IndexCustomerController::class, 'postTransaction'])->name('customer.postTransaction')->middleware('auth');
});
