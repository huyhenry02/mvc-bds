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
    return view('customer.layouts.main');
});
Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.showRegister');
});
Route::group([
    'prefix' => 'admin'
], function () {
    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::get('/', [UserController::class, 'showIndex'])->name('user.showIndex');
        Route::get('/create', [UserController::class, 'showCreate'])->name('user.showCreate');
        Route::get('/update', [UserController::class, 'showUpdate'])->name('user.showUpdate');
    });

    Route::group([
        'prefix' => 'investor'
    ], function () {
        Route::get('/', [InvestorController::class, 'showIndex'])->name('investor.showIndex');
        Route::get('/create', [InvestorController::class, 'showCreate'])->name('investor.showCreate');
        Route::get('/update', [InvestorController::class, 'showUpdate'])->name('investor.showUpdate');
    });

    Route::group([
        'prefix' => 'report'
    ], function () {
        Route::get('/user', [ReportController::class, 'showReportUser'])->name('report.showReportUser');
    });

    Route::group([
        'prefix' => 'zone'
    ], function () {
        Route::get('/', [ZoneController::class, 'showIndex'])->name('zone.showIndex');
        Route::get('/create', [ZoneController::class, 'showCreate'])->name('zone.showCreate');
        Route::get('/update', [ZoneController::class, 'showUpdate'])->name('zone.showUpdate');
    });

    Route::group([
        'prefix' => 'plot'
    ], function () {
        Route::get('/', [PlotController::class, 'showIndex'])->name('plot.showIndex');
        Route::get('/create', [PlotController::class, 'showCreate'])->name('plot.showCreate');
        Route::get('/update', [PlotController::class, 'showUpdate'])->name('plot.showUpdate');
    });

    Route::group([
        'prefix' => 'project'
    ], function () {
        Route::get('/', [ProjectController::class, 'showIndex'])->name('project.showIndex');
        Route::get('/create', [ProjectController::class, 'showCreate'])->name('project.showCreate');
        Route::get('/update', [ProjectController::class, 'showUpdate'])->name('project.showUpdate');
    });

    Route::group([
        'prefix' => 'transaction'
    ], function () {
        Route::get('/', [TransactionController::class, 'showIndex'])->name('transaction.showIndex');
    });
});
Route::group([
    'prefix' => 'customer'
], function () {
    Route::get('/index', [IndexCustomerController::class, 'showIndex'])->name('customer.showIndex');
    Route::get('/projects', [IndexCustomerController::class, 'showProjects'])->name('customer.showProjects');
    Route::get('/project-detail', [IndexCustomerController::class, 'showProjectDetail'])->name('customer.showProjectDetail');
    Route::get('/service', [IndexCustomerController::class, 'showService'])->name('customer.showService');
    Route::get('/about', [IndexCustomerController::class, 'showAbout'])->name('customer.showAbout');
});
