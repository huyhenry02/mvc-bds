@extends('customer.layouts.main')
@section('content')
    <section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight"
             data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="overlay-2"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 mb-5 text-center">
                    <h1 class="mb-3 bread">{{ $project->name ?? '' }}</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('customer.showIndex') }}">Trang chủ <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Chi tiết dự án</span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-property-details">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="property-details">
                        <div class="img rounded"
                             style="background-image: url({{ $project->image_project ?? '' }});"></div>
                        <div class="text">
                            <h2>{{ $project->name ?? '' }}</h2>
                            <span class="subheading">{{ $project->specific_address ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pills">
                    <div class="bd-example bd-example-tabs">
                        <div class="d-flex">
                            <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" id="all-tab" data-toggle="pill"
                                       href="#all" role="tab" aria-controls="all"
                                       aria-expanded="true">Tất cả</a>
                                </li>
                                @foreach( $zones as $zone)
                                    <li class="nav-item">
                                        <a class="nav-link" id="{{ $zone->code }}-tab" data-toggle="pill"
                                           href="#{{ $zone->code }}" role="tab" aria-controls="{{ $zone->code }}"
                                           aria-expanded="true">{{ $zone->code ?? '' }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="tab-content" id="all-tabContent">
                            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                @foreach($zones as $zone)
                                    <div class="zone-section mb-1">
                                        <h5 class="zone-title">{{ $zone->name }}</h5>
                                        <div id="zone-carousel-{{ $zone->id }}" class="carousel slide"
                                             data-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach( $zone->plots->chunk(3) as $chunkIndex => $plotChunk)
                                                    <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                                                        <div class="row">
                                                            @foreach( $plotChunk as $plot )
                                                                <div class="col-md-4">
                                                                    <div class="property-wrap ftco-animate">
                                                                        <img src="{{ $plot->main_image ?? '' }}"
                                                                             class="img" alt="">
                                                                        <div class="text">
                                                                            <p class="price"><span class="orig-price">{{ number_format($plot->price) }} VNĐ</span>
                                                                            </p>
                                                                            <h3>
                                                                                {{ $plot->name }}
                                                                            </h3>
                                                                            <span
                                                                                class="location">{{ $plot->specific_address ?? 'Không xác định' }}</span>
                                                                            <ul class="property_list">
                                                                                <li><span
                                                                                        class="flaticon-floor-plan"></span>{{ $plot->size }}
                                                                                    m²
                                                                                </li>
                                                                            </ul>
                                                                            <div
                                                                                class="d-flex justify-content-center mt-3">
                                                                                <button
                                                                                    class="btn btn-primary w-50 view-deposits"
                                                                                    data-bs-toggle="modal"
                                                                                    data-account_holder="{{ $project->account_holder }}"
                                                                                    data-account_number="{{ $project->account_number }}"
                                                                                    data-bank="{{ $project->bank }}"
                                                                                    data-qr_code="{{ $project->qr_code }}"
                                                                                    data-deposit_price="{{ $plot->deposit }}"
                                                                                    data-plot_id="{{ $plot->id }}"
                                                                                    data-bs-target="#depositModal">
                                                                                    Đặt cọc
                                                                                </button>
                                                                                <button
                                                                                    class="btn btn-secondary w-50 ml-2 view-details"
                                                                                    data-bs-toggle="modal"
                                                                                    data-name="{{ $plot->name }}"
                                                                                    data-size="{{ $plot->size }}"
                                                                                    data-price="{{ $plot->price }}"
                                                                                    data-deposit="{{ $plot->deposit }}"
                                                                                    data-specific_address="{{ $plot->specific_address }}"
                                                                                    data-status="{{ $plot->status }}"
                                                                                    data-description="{{ $plot->description }}"
                                                                                    data-main_image="{{ $plot->main_image }}"
                                                                                    data-sub_image_1="{{ $plot->sub_image_1 }}"
                                                                                    data-sub_image_2="{{ $plot->sub_image_2 }}"
                                                                                    data-sub_image_3="{{ $plot->sub_image_3 }}"
                                                                                    data-plot_id="{{ $plot->id }}"
                                                                                    data-bs-target="#detailModal">
                                                                                    Xem chi tiết
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#zone-carousel-{{ $zone->id }}"
                                               role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#zone-carousel-{{ $zone->id }}"
                                               role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @foreach( $zones as $zone )
                                <div class="tab-pane fade" id="{{ $zone->code }}" role="tabpanel"
                                     aria-labelledby="{{ $zone->code }}-tab">
                                    <div class="row">
                                        @foreach( $zone->plots as $plot)
                                            <div class="col-md-4">
                                                <div class="property-wrap ftco-animate">
                                                    <img src="{{ $plot->main_image ?? '' }}"
                                                         class="img" alt="">
                                                    <div class="text">
                                                        <p class="price"><span class="orig-price">{{ number_format($plot->price) }} VNĐ</span>
                                                        </p>
                                                        <h3><a href="">{{ $plot->name ?? '' }}</a></h3>
                                                        <span class="location">{{ $plot->zone?->name ?? '' }}</span>
                                                        <ul class="property_list">
                                                            <li><span
                                                                    class="flatiron-floor-plan"></span>{{ $plot->size }}
                                                                m2
                                                            </li>
                                                        </ul>
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <button class="btn btn-primary w-50 view-deposits"
                                                                    data-bs-toggle="modal"
                                                                    data-account_holder="{{ $project->account_holder }}"
                                                                    data-account_number="{{ $project->account_number }}"
                                                                    data-bank="{{ $project->bank }}"
                                                                    data-qr_code="{{ $project->qr_code }}"
                                                                    data-deposit_price="{{ $plot->deposit }}"
                                                                    data-plot_id="{{ $plot->id }}"
                                                                    data-bs-target="#depositModal">
                                                                Đặt cọc
                                                            </button>
                                                            <button
                                                                class="btn btn-secondary w-50 ml-2 view-details"
                                                                data-bs-toggle="modal"
                                                                data-name="{{ $plot->name }}"
                                                                data-size="{{ $plot->size }}"
                                                                data-price="{{ $plot->price }}"
                                                                data-deposit="{{ $plot->deposit }}"
                                                                data-specific_address="{{ $plot->specific_address }}"
                                                                data-status="{{ $plot->status }}"
                                                                data-description="{{ $plot->description }}"
                                                                data-main_image="{{ $plot->main_image }}"
                                                                data-sub_image_1="{{ $plot->sub_image_1 }}"
                                                                data-sub_image_2="{{ $plot->sub_image_2 }}"
                                                                data-sub_image_3="{{ $plot->sub_image_3 }}"
                                                                data-plot_id="{{ $plot->id }}"
                                                                data-bs-target="#detailModal">Xem
                                                                chi tiết
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('customer.modals.plot-detail')
    @include('customer.modals.plot-deposit')

    <style>
        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 8px;
            transition: background-color 0.3s ease;
        }

        .carousel-control-prev-icon {
            margin-right: 90px;
        }

        .carousel-control-next-icon {
            margin-left: 90px;
        }

        .carousel-control-prev-icon:hover,
        .carousel-control-next-icon:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .carousel-inner {
            padding-top: 15px;
        }

        .countdown-timer {
            font-size: 25px;
            margin-left: 310px;
            font-weight: bold;
            color: #836b33;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function () {
                const name = this.getAttribute('data-name');
                const size = this.getAttribute('data-size');
                const price = this.getAttribute('data-price');
                const deposit = this.getAttribute('data-deposit');
                const specific_address = this.getAttribute('data-specific_address');
                const status = this.getAttribute('data-status');
                const description = this.getAttribute('data-description');
                const main_image = this.getAttribute('data-main_image');
                const sub_image_1 = this.getAttribute('data-sub_image_1');
                const sub_image_2 = this.getAttribute('data-sub_image_2');
                const sub_image_3 = this.getAttribute('data-sub_image_3');
                const plot_id = this.getAttribute('data-plot_id');


                const priceFormatted = new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(price);
                const depositFormatted = new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(deposit);
                document.getElementById('plot-name').textContent = name;
                document.getElementById('plot-size').textContent = size;
                document.getElementById('plot-price').textContent = priceFormatted;
                document.getElementById('plot-deposit').textContent = depositFormatted;
                document.getElementById('plot-specific_address').textContent = specific_address;
                document.getElementById('plot-status').textContent = status;
                document.getElementById('plot-description').textContent = description;
                document.getElementById('plot-main_image').src = main_image;
                document.getElementById('plot-sub_image_1').src = sub_image_1;
                document.getElementById('plot-sub_image_2').src = sub_image_2;
                document.getElementById('plot-sub_image_3').src = sub_image_3;

                const statusElement = document.getElementById('plot-status');
                let statusHTML = '';

                switch (status) {
                    case 'deposited':
                        statusHTML = '<span class="badge bg-success">Đã đặt cọc</span>';
                        break;
                    case 'empty':
                        statusHTML = '<span class="badge bg-primary">Trống</span>';
                        break;
                    case 'sold':
                        statusHTML = '<span class="badge bg-warning">Đã bán</span>';
                        break;
                    default:
                        statusHTML = '<span class="badge bg-secondary">Chưa xác định</span>';
                }

                statusElement.innerHTML = statusHTML;
                const depositButton = document.querySelector('#detailModal .view-deposits');
                depositButton.setAttribute('data-deposit_price', deposit);
                depositButton.setAttribute('data-plot_id', plot_id);
            });
        });
        let countdownInterval;

        document.querySelectorAll('.view-deposits').forEach(button => {
            button.addEventListener('click', function () {
                const deposit_price = this.getAttribute('data-deposit_price');
                const plot_id = this.getAttribute('data-plot_id');
                document.getElementById('transaction-deposit_price').textContent = new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(deposit_price);
                document.getElementById('transaction-plot_id').value = plot_id;
                startCountdown();
            });
        });

        function startCountdown() {
            let time = 30 * 60;
            const countdownElement = document.getElementById('countdownTimer');
            clearInterval(countdownInterval);
            countdownInterval = setInterval(function () {
                const minutes = Math.floor(time / 60);
                const seconds = time % 60;
                countdownElement.textContent = `${minutes} phút ${seconds.toString().padStart(2, '0')} giây`;
                if (time <= 0) {
                    clearInterval(countdownInterval);
                    countdownElement.textContent = "Hết thời gian!";
                }
                time--;
            }, 1000);
        }

        document.getElementById('cancelButton').addEventListener('click', function () {
            clearInterval(countdownInterval);
            document.getElementById('countdownTimer').textContent = "30 phút 00 giây";
        });

        document.querySelector('.btn-close').addEventListener('click', function () {
            clearInterval(countdownInterval);
            document.getElementById('countdownTimer').textContent = "30 phút 00 giây";
        });

    </script>
@endsection
