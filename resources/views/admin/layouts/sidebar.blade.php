<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <ul class="nav nav-secondary">
            <li class="nav-item">
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
                <div id="dashboard">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('user.showIndex') }}">
                                <span class="sub-item">Danh sách người dùng</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.showCreate') }}">
                                <span class="sub-item">Thêm mới người dùng</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a
                    data-bs-toggle="collapse"
                    href="#project"
                    class="collapsed"
                    aria-expanded="false"
                >
                    <i class="fas fa-bars"></i>
                    <p>Quản lý dự án</p>
                    <span class="caret"></span>
                </a>
                <div id="project">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('project.showIndex') }}">
                                <span class="sub-item">Danh sách dự án</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('project.showCreate') }}">
                                <span class="sub-item">Thêm mới dự án</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a
                    data-bs-toggle="collapse"
                    href="#investor"
                    class="collapsed"
                    aria-expanded="false"
                >
                    <i class="fas fa-bars"></i>
                    <p>Quản lý chủ đầu tư</p>
                    <span class="caret"></span>
                </a>
                <div id="investor">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('investor.showIndex') }}">
                                <span class="sub-item">Danh sách đầu tư</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('investor.showCreate') }}">
                                <span class="sub-item">Thêm mới đầu tư</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
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
                <div id="zone">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('zone.showIndex') }}">
                                <span class="sub-item">Danh sách phân khu</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('zone.showCreate') }}">
                                <span class="sub-item">Thêm mới phân khu</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
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
                <div id="plot">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('plot.showIndex') }}">
                                <span class="sub-item">Danh sách khu đất</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('plot.showCreate') }}">
                                <span class="sub-item">Thêm mới khu đất</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
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
                <div id="transaction">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('transaction.showIndex') }}">
                                <span class="sub-item">Danh sách giao dịch</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
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
                <div id="statistic">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('report.showReportUser') }}">
                                <span class="sub-item">Thống kê người dùng</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
