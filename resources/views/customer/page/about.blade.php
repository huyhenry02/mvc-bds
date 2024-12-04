@extends('customer.layouts.main')
@section('content')
    <section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="overlay-2"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 mb-5 text-center">
                    <h1 class="mb-3 bread">Về chúng tôi</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('customer.showIndex') }}">Trang chủ <i class="ion-ios-arrow-forward"></i></a></span> <span>Về chúng tôi</span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-md-6 img img-3 d-flex justify-content-center align-items-center" style="background-image: url(images/about.jpg);">
                </div>
                <div class="col-md-6 wrap-about pl-md-5 ftco-animate">
                    <div class="heading-section">
                        <h2 class="mb-4">Chào Mừng Đến Với HLC - Công Ty Bất Động Sản</h2>

                        <p>HLC tự hào là đơn vị đầu tư bất động sản chuyên nghiệp, tập trung tại địa bàn thành phố Hà Nội. Chúng tôi luôn nhận được sự hài lòng, tin tưởng hợp tác từ những khách hàng khó tính nhất.</p>
                        <p>HLC tự hào là đơn vị đầu tư bất động sản chuyên nghiệp, tập trung tại địa bàn thành phố Hà Nội. Chúng tôi luôn nhận được sự hài lòng, tin tưởng hợp tác từ những khách hàng khó tính nhất.</p>
                        <p><a href="#" class="btn btn-primary">Tìm Dự Án</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-counter ftco-section ftco-no-pt ftco-no-pb img" id="section-counter">
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

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3 style="font-weight: 600; font-size: 20px;">Sứ Mệnh Của Chúng Tôi</h3>
                    <p>HLC Group luôn nỗ lực tạo ra những đột phá trong tư duy, kết nối và hợp tác với  chất xám cao, giá trị sử dụng lớn cho xã hội những mối liên kết bền chắc.</p>
                </div>
                <div class="col-md-4">
                    <h3 style="font-weight: 600; font-size: 20px;">Tầm Nhìn Của Chúng Tôi</h3>
                    <p> Tại HLC Group, triết lý cùng nhau phát triển được hình thành dựa trên nền tảng chia sẻ lợi ích và tập hợp sức mạnh. Mỗi thành viên, đối tác, khách hàng đều nhận được những giá trị tương ứng.</p>
                </div>
                <div class="col-md-4">
                    <h3 style="font-weight: 600; font-size: 20px;">Giá Trị Của Chúng Tôi</h3>
                    <p>Chúng tôi tin rằng, “Giúp Khách Hàng Thành Công / Helping Clients Succeed” sẽ giúp HLC Group thành công.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
