@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div>
            <h3 class="fw-bold mb-3">Thống kê Dự án</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
        </div>
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
                        <canvas id="projectsChart" class="w-100"></canvas>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- AJAX and Chart.js script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .chart-section {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .chart-section h3 {
            font-weight: 600;
            color: #343a40;
        }

        canvas {
            max-height: 400px;
        }

    </style>
    <script>
        const ctx = document.getElementById('projectsChart').getContext('2d');
        const projectsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['2018', '2019', '2020', '2021', '2022', '2023'], // Years
                datasets: [
                    {
                        label: 'Dự án theo thời gian',
                        data: [20, 25, 15, 35, 45, 50],
                        backgroundColor: 'rgba(99,172,255,0.6)',
                        borderColor: 'rgb(99,167,255)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
