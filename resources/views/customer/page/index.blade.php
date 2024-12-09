@extends('customer.layouts.main')
@section('content')
    <div class="hero-wrap" style="background-image: url('/customer/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="overlay-2"></div>
        <div class="container">
            <div class="row no-gutters slider-text justify-content-center align-items-center">
                <div class="col-lg-8 col-md-6 ftco-animate d-flex align-items-end">
                    <div class="text text-center w-100">
                        <h1 class="mb-4">Tìm Bất Động Sản <br>Phù hợp với nhu cầu của bạn</h1>
                        <p><a href="#" class="btn btn-primary py-3 px-4">Tìm kiếm</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mouse">
            <a href="#" class="mouse-icon">
                <div class="mouse-wheel"><span class="ion-ios-arrow-round-down"></span></div>
            </a>
        </div>
    </div>
    <section class="ftco-section goto-here">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                    <span class="subheading">NHỮNG GÌ CHÚNG TÔI CUNG CẤP</span>
                    <h2 class="mb-2">Ưu đãi độc quyền dành cho bạn</h2>
                </div>
            </div>
            <div class="row">
                @foreach( $projects as $key => $project)
                    <div class="col-md-4">
                        <div class="property-wrap ftco-animate">
                            <div class="img d-flex align-items-center justify-content-center" style="background-image: url({{ $project->image_project ?? '' }})">
                                <a href="{{ route('customer.showProjectDetail', $project->id) }}" class="icon d-flex align-items-center justify-content-center btn-custom">
                                    <span class="ion-ios-link"></span>
                                </a>
                                <div class="list-agent d-flex align-items-center">
                                    <a href="{{ route('customer.showProjectDetail', $project->id) }}" class="agent-info d-flex align-items-center">
                                        <div class="img-2 rounded-circle" style="background-image: url(images/person_1.jpg);"></div>
                                        <h3 class="mb-0 ml-2">{{ $project->investor->full_name ?? '' }}</h3>
                                    </a>
                                </div>
                            </div>
                            <div class="text">
                                <h3 class="mb-0"><a href="">{{ $project->name ?? '' }}</a></h3>
                                <span class="location d-inline-block mb-3"><i class="ion-ios-pin mr-2"></i>{{ $project->specific_address ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-fullwidth">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                    <span class="subheading">Dịch Vụ</span>
                    <h2 class="mb-2">Tại Sao Chọn Chúng Tôi?</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid px-0">
            <div class="row d-md-flex text-wrapper align-items-stretch">
                <div class="one-half img d-flex align-self-stretch"
                     style="background-image: url('images/about.jpg');"></div>
                <div class="one-half half-text d-flex justify-content-end align-items-center">
                    <div class="text-inner pl-md-5">
                        <div class="row d-flex">
                            <div class="col-md-12 d-flex align-self-stretch ftco-animate">
                                <div class="media block-6 services-wrap d-flex">
                                    <div class="icon d-flex justify-content-center align-items-center"><span
                                            class="flaticon-wallet"></span></div>
                                    <div class="media-body pl-4">
                                        <h3>Ưu Đãi Thanh Toán Toàn Bộ</h3>
                                        <p>Chúng tôi hỗ trợ các gói thanh toán linh hoạt để đáp ứng nhu cầu của bạn.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-self-stretch ftco-animate">
                                <div class="media block-6 services-wrap d-flex">
                                    <div class="icon d-flex justify-content-center align-items-center"><span
                                            class="flaticon-file"></span></div>
                                    <div class="media-body pl-4">
                                        <h3>Chuyên Gia Đồng Hành</h3>
                                        <p>Đội ngũ tư vấn giàu kinh nghiệm luôn sẵn sàng hỗ trợ bạn trong từng bước giao
                                            dịch.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-self-stretch ftco-animate">
                                <div class="media block-6 services-wrap d-flex">
                                    <div class="icon d-flex justify-content-center align-items-center"><span
                                            class="flaticon-locked"></span></div>
                                    <div class="media-body pl-4">
                                        <h3>Giá Cố Định</h3>
                                        <p>Đảm bảo giá bất động sản không thay đổi trong quá trình giao dịch.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-counter ftco-section img" id="section-counter">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-4 mb-4">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="305">0</strong>
                            <span>Dân Số <br>Khu Vực</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-4 mb-4">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="1090">0</strong>
                            <span>Tổng Số <br>Dự Án</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-4 mb-4">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="209">0</strong>
                            <span>Nhà Ở <br>Trung Bình</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-4 mb-4">
                        <div class="text d-flex align-items-center">
                            <strong class="number" data-number="67">0</strong>
                            <span>Tổng Số <br>Chi Nhánh</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
