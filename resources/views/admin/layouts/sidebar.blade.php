<?php
$routesAccount = [
    'account.showIndex',
    'account.showCreate',
    'account.showUpdate',
    'account.showDetail',
];

$routesAdvertisement = [
    'advertisement.showIndex',
    'advertisement.showCreate',
    'advertisement.showUpdate',
    'advertisement.showDetail',
];

$routesCleaner = [
    'cleaner.showIndex',
    'cleaner.showCreate',
    'cleaner.showIndexContract',
    'cleaner.showUpdate',
    'cleaner.showDetail',
];

$routesCustomer = [
    'customer.showIndex',
    'customer.showCreate',
    'customer.showUpdate',
    'customer.showDetail',
];

$routesOrder = [
    'order.showIndex',
    'order.showComplainCustomer',
    'order.showComplainCleaner',
    'order.showDetailComplaint',
    'order.showCreate',
    'order.showUpdate',
    'order.showDetail',
];

$routesService = [
    'service.showIndex',
    'service.showCreate',
    'service.showUpdate',
    'service.showDetail',
];

$routesReport = [
    'report.showReportCustomer',
    'report.showReportOrder',
    'report.showReportRevenue',
];

$isActiveAccount = collect($routesAccount)->contains(fn($route) => request()->routeIs($route));
$isActiveAdvertisement = collect($routesAdvertisement)->contains(fn($route) => request()->routeIs($route));
$isActiveCleaner = collect($routesCleaner)->contains(fn($route) => request()->routeIs($route));
$isActiveCustomer = collect($routesCustomer)->contains(fn($route) => request()->routeIs($route));
$isActiveOrder = collect($routesOrder)->contains(fn($route) => request()->routeIs($route));
$isActiveService = collect($routesService)->contains(fn($route) => request()->routeIs($route));
$isActiveReport = collect($routesReport)->contains(fn($route) => request()->routeIs($route));
?>

<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <ul class="nav nav-secondary">
            <li class="nav-item {{ $isActiveReport ? 'active' : '' }}">
                <a
                    data-bs-toggle="collapse"
                    href="#dashboard"
                    class="collapsed"
                    aria-expanded="false"
                >
                    <i class="fas fa-home"></i>
                    <p>Báo cáo thống kê</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ $isActiveReport ? 'show' : '' }}" id="dashboard">
                    <ul class="nav nav-collapse">
                        <li class="{{ request()->routeIs('report.showReportRevenue') ? 'active' : '' }}">
                            <a href="{{ route('report.showReportRevenue') }}">
                                <span class="sub-item">Báo cáo Doanh số</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('report.showReportCustomer') ? 'active' : '' }}">
                            <a href="{{ route('report.showReportCustomer') }}">
                                <span class="sub-item">Báo cáo Khách hàng</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('report.showReportOrder') ? 'active' : '' }}">
                            <a href="{{ route('report.showReportOrder') }}">
                                <span class="sub-item">Báo cáo Đơn hàng</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ $isActiveAccount ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href=" #account">
                    <i class="fas fa-layer-group"></i>
                    <p>Quản lý tài khoản</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ $isActiveAccount ? 'show' : '' }}" id="account">
                    <ul class="nav nav-collapse show">
                        <li class="{{ request()->routeIs('account.showIndex') ? 'active' : '' }}">
                            <a href="{{ route('account.showIndex') }}">
                                <span class="sub-item">Danh sách tài khoản</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('account.showCreate') ? 'active' : '' }}">
                            <a href="{{ route('account.showCreate') }}">
                                <span class="sub-item">Thêm mới tài khoản</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item {{ $isActiveCleaner ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href=" #base">
                    <i class="fas fa-layer-group"></i>
                    <p>Quản lý Nhân viên</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ $isActiveCleaner ? 'show' : '' }}" id="base">
                    <ul class="nav nav-collapse show">
                        <li class="{{ request()->routeIs('cleaner.showIndex') ? 'active' : '' }}">
                            <a href="{{ route('cleaner.showIndex') }}">
                                <span class="sub-item">Danh sách Nhân viên</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('cleaner.showIndexContract') ? 'active' : '' }}">
                            <a href="{{ route('cleaner.showIndexContract') }}">
                                <span class="sub-item">Danh sách hợp đồng</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('cleaner.showCreate') ? 'active' : '' }}">
                            <a href="{{ route('cleaner.showCreate') }}">
                                <span class="sub-item">Thêm mới Nhân viên</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ $isActiveCustomer ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href=" #customer">
                    <i class="fas fa-layer-group"></i>
                    <p>Quản lý Khách hàng</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ $isActiveCustomer ? 'show' : '' }}" id="customer">
                    <ul class="nav nav-collapse show">
                        <li class="{{ request()->routeIs('customer.showIndex') ? 'active' : '' }}">
                            <a href="{{ route('customer.showIndex') }}">
                                <span class="sub-item">Danh sách Khách hàng</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ $isActiveOrder ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href=" #order">
                    <i class="fas fa-layer-group"></i>
                    <p>Quản lý đơn hàng</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ $isActiveOrder ? 'show' : '' }}" id="order">
                    <ul class="nav nav-collapse show">
                        <li class="{{ request()->routeIs('order.showIndex') ? 'active' : '' }}">
                            <a href="{{ route('order.showIndex') }}">
                                <span class="sub-item">Danh sách đơn hàng</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('order.showComplainCleaner') ? 'active' : '' }}">
                            <a href="{{ route('order.showComplainCleaner') }}">
                                <span class="sub-item">Khiếu nại của nhân viên</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('order.showComplainCustomer') ? 'active' : '' }}">
                            <a href="{{ route('order.showComplainCustomer') }}">
                                <span class="sub-item">Khiếu nại của khách hàng</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ $isActiveService ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href=" #service">
                    <i class="fas fa-layer-group"></i>
                    <p>Quản lý dịch vụ dọn dẹp</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ $isActiveService ? 'show' : '' }}" id="service">
                    <ul class="nav nav-collapse show">
                        <li class="{{ request()->routeIs('service.showIndex') ? 'active' : '' }}">
                            <a href="{{ route('service.showIndex') }}">
                                <span class="sub-item">Danh sách dịch vụ</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('service.showCreate') ? 'active' : '' }}">
                            <a href="{{ route('service.showCreate') }}">
                                <span class="sub-item">Thêm mới dịch vụ</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ $isActiveAdvertisement ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href=" #advertisement">
                    <i class="fas fa-layer-group"></i>
                    <p>Quản lý thông tin app</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse  {{ $isActiveAdvertisement ? 'show' : '' }}" id="advertisement">
                    <ul class="nav nav-collapse">
                        <li class="{{ request()->routeIs('advertisement.showIndex') ? 'active' : '' }}">
                            <a href="{{ route('advertisement.showIndex') }}">
                                <span class="sub-item">Danh sách thông tin app</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('advertisement.showCreate') ? 'active' : '' }}">
                            <a href="{{ route('advertisement.showCreate') }}">
                                <span class="sub-item">Thêm thông tin app</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
