@php use Carbon\Carbon; @endphp
    <!DOCTYPE html>
<html>
<head>
    <title>Báo cáo giao dịch</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
        }

        .text-center {
            text-align: center;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .fw-bold {
            font-weight: bold;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .thead-light th {
            background-color: #f8f9fa;
        }

        .bg-secondary {
            background-color: #6c757d;
            color: white;
        }

        .text-white {
            color: white;
        }

        .text-end {
            text-align: right;
        }

        .mb-4 {
            margin-bottom: 16px;
        }

        .mt-3 {
            margin-top: 16px;
        }
    </style>
</head>
<body>
<div class="container pt-4" style="background-color: white">
    <div class="text-center mb-4">
        <h2 class="fw-bold">HLC Group</h2>
        <h4 class="text-uppercase">Báo cáo giao dịch đặt cọc theo dự án và phân khu</h4>
        <p>Thời gian: <strong>Từ ngày {{ Carbon::parse($start_date)->format('d/m/Y') }}</strong> đến
            <strong>{{ Carbon::parse($end_date)->format('d/m/Y') }}</strong></p>
    </div>
    <div class="table-container" style="max-width: 90%; margin: auto;">
        <table class="table table-bordered text-center">
            <thead class="thead-light">
            <tr>
                <th>Dự án</th>
                <th>Mã phân khu</th>
                <th>Phân khu</th>
                <th>Tên khu đất</th>
                <th>Thời gian giao dịch</th>
                <th>Số tiền đặt cọc</th>
            </tr>
            </thead>
            <tbody>
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
                        <td colspan="5"><strong>Tổng giao dịch:</strong></td>
                        <td><strong>{{ number_format( $totalProjectDeposits ) }}</strong></td>
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
            <p><strong>Tổng giao dịch:</strong> {{ number_format( $totalDeposits ) }} VND</p>
        </div>
    </div>
</div>
</body>
</html>
