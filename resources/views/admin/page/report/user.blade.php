@extends('admin.layouts.main')
@section('content')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Thống kê người dùng</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0"></div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-stats card-round">
                <div class="row card-header">
                    <div class="col-2">
                        <div class="form-inline">
                            <label for="timeType" class="mr-2">Chọn loại thời gian:</label>
                            <select id="timeType" class="form-control mt-2">
                                <option value="year">Theo Năm</option>
                                <option value="month">Theo Tháng</option>
                                <option value="week">Theo Tuần</option>
                                <option value="day">Theo Ngày</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <section class="chart-section container mt-5">
                        <div id="loading" class="text-center mb-4" style="display: none;">
                            <span>Đang tải dữ liệu...</span>
                        </div>
                        <canvas id="usersChart" class="w-100"></canvas>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .chart-section {
            background: #f8f9fa;
            padding: 5px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .chart-section h3 {
            font-weight: 600;
            color: #343a40;
        }

        canvas {
            max-height: 600px;
        }
    </style>
    <script>
        $(document).ready(function () {
            const ctx = document.getElementById('usersChart').getContext('2d');
            const usersChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Người dùng theo thời gian',
                        data: [],
                        backgroundColor: 'rgba(99,172,255,0.6)',
                        borderColor: 'rgb(99,167,255)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            $('#timeType').change(function () {
                const timeType = $(this).val();
                $('#loading').show();
                $.ajax({
                    url: `/admin/report/data-chart/time_type=${timeType}/type_chart=users`,
                    method: 'GET',
                    success: function (data) {
                        const parsedData = parseData(timeType, data);
                        updateChart(parsedData.labels, parsedData.counts);
                    },
                    error: function (error) {
                        console.error('Error fetching data:', error);
                        alert('Đã xảy ra lỗi khi tải dữ liệu.');
                    },
                    complete: function () {
                        $('#loading').hide();
                    }
                });
            });

            function parseData(type, data) {
                let labels = [];
                let counts = [];
                if (type === 'month') {
                    labels = Object.keys(data).map(month => `Tháng ${month}`);
                    counts = Object.values(data);
                } else if (type === 'week') {
                    labels = data.map(item => `Tuần ${item.week}`);
                    counts = data.map(item => item.count);
                } else if (type === 'year') {
                    labels = Object.keys(data);
                    counts = Object.values(data);
                } else if (type === 'day') {
                    labels = data.map(item => `Ngày ${item.date}`);
                    counts = data.map(item => item.count);
                }
                return { labels, counts };
            }

            function updateChart(labels, data) {
                usersChart.data.labels = labels;
                usersChart.data.datasets[0].data = data;
                usersChart.update();
            }
        });
    </script>
@endsection
