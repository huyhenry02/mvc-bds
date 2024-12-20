<?php
$routesUser = [
    'user.showIndex',
    'user.showUpdate',
];

$routesInvestor = [
    'investor.showIndex',
    'investor.showCreate',
    'investor.showUpdate',
];

$routesProject = [
    'project.showIndex',
    'project.showCreate',
    'project.showUpdate',
    'investor.showIndex',
    'investor.showCreate',
    'investor.showUpdate',
];

$routesZone = [
    'zone.showIndex',
    'zone.showCreate',
    'zone.showUpdate',
];

$routesPlot = [
    'plot.showIndex',
    'plot.showCreate',
    'plot.showUpdate',
];

$routesTransaction = [
    'transaction.showIndex',
    'transaction.showCreate',
    'transaction.showUpdate',
];

$routesReport = [
    'report.showReportUser',
    'report.showReportTransaction',
    'report.showReportProject',
];

$isActiveUser = collect($routesUser)->contains(fn($route) => request()->routeIs($route));
$isActiveInvestor = collect($routesInvestor)->contains(fn($route) => request()->routeIs($route));
$isActiveProject = collect($routesProject)->contains(fn($route) => request()->routeIs($route));
$isActiveZone = collect($routesZone)->contains(fn($route) => request()->routeIs($route));
$isActivePlot = collect($routesPlot)->contains(fn($route) => request()->routeIs($route));
$isActiveTransaction = collect($routesTransaction)->contains(fn($route) => request()->routeIs($route));
$isActiveReport = collect($routesReport)->contains(fn($route) => request()->routeIs($route));
?>

<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <ul class="nav nav-secondary">
            <li class="nav-item {{ $isActiveUser ? 'active' : '' }}">
                <a
                    data-bs-toggle="collapse"
                    href="#dashboard"
                    class="collapsed"
                    aria-expanded="false"
                >
                    <i class="fas fa-bars"></i>
                    <p>Quản lý người dùng</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ $isActiveUser ? 'show' : '' }}" id="dashboard">
                    <ul class="nav nav-collapse">
                        <li class="{{ request()->routeIs('user.showIndex') ? 'active' : '' }}">
                            <a href="{{ route('user.showIndex') }}">
                                <span class="sub-item">Danh sách người dùng</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#submenu">
                    <i class="fas fa-bars"></i>
                    <p>Quản lý dự án</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse  {{ $isActiveProject ? 'show' : '' }}" id="submenu">
                    <ul class="nav nav-collapse">
                        <li class="{{ request()->routeIs('project.showIndex') ? 'active' : '' }}">
                            <a href="{{ route('project.showIndex') }}">
                                <span class="sub-item">Danh sách dự án</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('project.showCreate') ? 'active' : '' }}">
                            <a href="{{ route('project.showCreate') }}">
                                <span class="sub-item">Thêm mới dự án</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs(['investor.showIndex', 'investor.showCreate']) ? 'active' : '' }}">
                            <a data-bs-toggle="collapse" href="#subnav1">
                                <span class="sub-item">Danh mục nhà đầu tư</span>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse  {{ $routesInvestor ? 'show' : '' }}" id="subnav1">
                                <ul class="nav nav-collapse subnav">
                                    <li class="{{ request()->routeIs('investor.showIndex') ? 'active' : '' }}">
                                        <a href="{{ route('investor.showIndex') }}">
                                            <span class="sub-item">Danh sách nhà đầu tư</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->routeIs('investor.showCreate') ? 'active' : '' }}">
                                        <a href="{{ route('investor.showCreate') }}">
                                            <span class="sub-item">Thêm mới nhà đầu tư</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ $isActiveZone ? 'active' : '' }}">
                <a
                    data-bs-toggle="collapse"
                    href="#zone"
                    class="collapsed"
                    aria-expanded="false"
                >
                    <i class="fas fa-bars"></i>
                    <p>Quản lý phân khu</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ $isActiveZone ? 'show' : '' }}" id="zone">
                    <ul class="nav nav-collapse">
                        <li class="{{ request()->routeIs('zone.showIndex') ? 'active' : '' }}">
                            <a href="{{ route('zone.showIndex') }}">
                                <span class="sub-item">Danh sách phân khu</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('zone.showCreate') ? 'active' : '' }}">
                            <a href="{{ route('zone.showCreate') }}">
                                <span class="sub-item">Thêm mới phân khu</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ $isActivePlot ? 'active' : '' }}">
                <a
                    data-bs-toggle="collapse"
                    href="#plot"
                    class="collapsed"
                    aria-expanded="false"
                >
                    <i class="fas fa-bars"></i>
                    <p>Quản lý khu đất</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ $isActivePlot ? 'show' : '' }}" id="plot">
                    <ul class="nav nav-collapse">
                        <li class="{{ request()->routeIs('plot.showIndex') ? 'active' : '' }}">
                            <a href="{{ route('plot.showIndex') }}">
                                <span class="sub-item">Danh sách khu đất</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('plot.showCreate') ? 'active' : '' }}">
                            <a href="{{ route('plot.showCreate') }}">
                                <span class="sub-item">Thêm mới khu đất</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ $isActiveTransaction ? 'active' : '' }}">
                <a
                    data-bs-toggle="collapse"
                    href="#transaction"
                    class="collapsed"
                    aria-expanded="false"
                >
                    <i class="fas fa-bars"></i>
                    <p>Quản lý giao dịch</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ $isActiveTransaction ? 'show' : '' }}" id="transaction">
                    <ul class="nav nav-collapse">
                        <li class="{{ request()->routeIs('transaction.showIndex') ? 'active' : '' }}">
                            <a href="{{ route('transaction.showIndex') }}">
                                <span class="sub-item">Danh sách giao dịch</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ $isActiveReport ? 'active' : '' }}">
                <a
                    data-bs-toggle="collapse"
                    href="#statistic"
                    class="collapsed"
                    aria-expanded="false"
                >
                    <i class="fas fa-bars"></i>
                    <p>Thống kê, báo cáo</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ $isActiveReport ? 'show' : '' }}" id="statistic">
                    <ul class="nav nav-collapse">
                        <li class="{{ request()->routeIs('report.showReportTransaction') ? 'active' : '' }}">
                            <a href="{{ route('report.showReportTransaction') }}">
                                <span class="sub-item">Báo cáo giao dịch</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('report.showReportUser') ? 'active' : '' }}">
                            <a href="{{ route('report.showReportUser') }}">
                                <span class="sub-item">Thống kê người dùng</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('report.showReportProject') ? 'active' : '' }}">
                            <a href="{{ route('report.showReportProject') }}">
                                <span class="sub-item">Thống kê dự án</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
