@php use Carbon\Carbon; @endphp
@extends('admin.layouts.main')
@section('content')
    <div class="text-center mb-4">
        <form id="generatePdfForm" action="{{ route('report.generatePDF') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="start_date" value="{{ $start_date }}">
            <input type="hidden" name="end_date" value="{{ $end_date }}">
            <input type="hidden" name="projects" value="{{ implode(',', $projects) }}">
            <input type="hidden" name="status" value="{{ $status }}">
        </form>

        <a class="btn btn-info" href="#" onclick="document.getElementById('generatePdfForm').submit();">
            <i class="fas fa-download me-2"></i>Xuất PDF
        </a>
    </div>
    <div class="container pt-4" style="background-color: white">
        <div class="text-center mb-4">
            <h2 class="fw-bold">HLC Group</h2>
            <h4 class="text-uppercase">Báo cáo giao dịch đặt cọc theo dự án và phân khu</h4>
            <p>Thời gian: <strong>Từ ngày {{ Carbon::parse($start_date)->format('d/m/Y') }}</strong> đến
                <strong>{{ Carbon::parse($end_date)->format('d/m/Y') }}</strong></p>
        </div>
        <div class="table-container" style="max-width: 90%; margin: auto;">
            <table class="table table-bordered" id="transaction-table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Dự án</th>
                    <th scope="col">Mã phân khu</th>
                    <th scope="col">Phân khu</th>
                    <th scope="col">Tên khu đất</th>
                    <th scope="col">Thời gian giao dịch</th>
                    <th scope="col" class="text-center">Số tiền đặt cọc</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $totalDeposits = 0
                @endphp
                @if( count($data) > 0 )
                    @php
                        $totalDeposits = collect($data)->sum(fn($zones) => collect($zones)->sum(fn($plots) => collect($plots)->sum('deposit')));
                    @endphp
                    @foreach ( $data as $projectName => $zones )
                        @php
                            $totalProjectDeposits = collect($zones)->sum(fn($plots) => collect($plots)->sum('deposit'));
                            $totalPlots = collect($zones)->sum(fn($plots) => count($plots));
                            $isFirstProjectRow = true;
                        @endphp
                        @foreach ( $zones as $zoneKey => $plots )
                            @foreach ($plots as $index => $plot)
                                <tr>
                                    @if ( $isFirstProjectRow )
                                        <td rowspan="{{ $totalPlots }}">{{ $projectName }}</td>
                                        @php $isFirstProjectRow = false; @endphp
                                    @endif

                                    @if ( $index === 0 )
                                        <td rowspan="{{ count($plots) }}">{{ $zoneKey }}</td>
                                    @endif

                                    <td>{{ $plot['plot_name'] }}</td>
                                    <td>{{ $plot['zone_name'] }}</td>
                                    <td>{{ $plot['transaction_date'] }}</td>
                                    <td class="text-center">{{ number_format($plot['deposit']) }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                        <tr>
                            <td colspan="5" class="text-center"><strong>Tổng giao dịch:</strong></td>
                            <td class="text-center"><strong>{{ number_format($totalProjectDeposits) }}</strong></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6"> Không có dữ liệu</td>
                    </tr>
                @endif
                </tbody>
            </table>
            <div class="text-end mt-3">
                <p><strong>Tổng giao dịch:</strong> {{ number_format($totalDeposits) }}</p>
            </div>
        </div>
    </div>
@endsection
