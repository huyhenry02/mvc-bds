@extends('customer.layouts.main')
@section('content')
    <section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight"
             style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="overlay-2"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 mb-5 text-center">
                    <h1 class="mb-3 bread">Dịch vụ</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('customer.showIndex') }}">Trang chủ <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Dịch vụ</span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                    <span class="subheading">Dịch Vụ Của Chúng Tôi</span>
                    <h2 class="mb-2">Lựa Chọn Dịch Vụ Của Chúng Tôi</h2>
                </div>
            </div>
            <div class="row d-flex">
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center"><span
                                class="flaticon-piggy-bank"></span></div>
                        <div class="media-body py-md-4">
                            <h3>Không Cần Đặt Cọc</h3>
                            <p>Chúng tôi mang đến giải pháp linh hoạt, giúp bạn sở hữu bất động sản mà không cần phải
                                trả trước.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center"><span
                                class="flaticon-wallet"></span></div>
                        <div class="media-body py-md-4">
                            <h3>Ưu Đãi Thanh Toán Toàn Bộ</h3>
                            <p>Chúng tôi hỗ trợ các gói thanh toán linh hoạt để đáp ứng nhu cầu của bạn.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center"><span
                                class="flaticon-file"></span></div>
                        <div class="media-body py-md-4">
                            <h3>Chuyên Gia Đồng Hành</h3>
                            <p>Đội ngũ tư vấn giàu kinh nghiệm luôn sẵn sàng hỗ trợ bạn trong từng bước giao dịch.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center"><span
                                class="flaticon-locked"></span></div>
                        <div class="media-body py-md-4">
                            <h3>Giá Cố Định</h3>
                            <p>Đảm bảo giá bất động sản không thay đổi trong quá trình giao dịch.</p>
                        </div>
                    </div>
                </div>
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

@endsection
