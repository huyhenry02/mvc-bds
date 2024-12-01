@extends('customer.layouts.main')
@section('content')
    <section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="overlay-2"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 mb-5 text-center">
                    <h1 class="mb-3 bread">Dự án</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('customer.showIndex') }}">Trang chủ <i class="ion-ios-arrow-forward"></i></a></span> <span>Dự án </span></p>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-wrap-1 ftco-animate">
                        <form id="search-form" class="search-property-1">
                            <div class="row">
                                <div class="col-lg align-items-end">
                                    <div class="form-group">
                                        <label for="#">Khu vực</label>
                                        <div class="form-field">
                                            <div class="select-wrap">
                                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                <select name="city_id" id="" class="form-control">
                                                    <option value="">Chọn Tỉnh/Thành phố</option>
                                                    @foreach( $cities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg align-items-end">
                                    <div class="form-group">
                                        <label for="#">Loại dự án</label>
                                        <div class="form-field">
                                            <div class="select-wrap">
                                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                <select name="category_id" id="" class="form-control">
                                                    <option value="">Chọn Loại dự án</option>
                                                    @foreach( $categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg align-items-end">
                                    <div class="form-group">
                                        <label for="#">Trạng thái dự án</label>
                                        <div class="form-field">
                                            <div class="select-wrap">
                                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                <select name="status" id="" class="form-control">
                                                    <option value="">Chọn Trạng thái dự án</option>
                                                    <option value="on_sale">Đang bán</option>
                                                    <option value="completed">Hoàn thành</option>
                                                    <option value="upcoming">Sắp diễn ra</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg align-self-end">
                                    <div class="form-group">
                                        <div class="form-field">
                                            <input type="submit" value="Tìm kiếm" class="form-control btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section goto-here">
        <div class="container">
            <div id="project-container" class="row">
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
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        <ul>
                            <li><a href="#">&lt;</a></li>
                            <li class="active"><span>1</span></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&gt;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#search-form').on('submit', function (e) {
                e.preventDefault();

                console.log('Search form submitted');

                const formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('customer.searchProjects') }}',
                    method: 'GET',
                    data: formData,
                    success: function (response) {
                        console.log('AJAX Success:', response);
                        $('#project-container').empty();

                        if (response.projects.length === 0) {
                            $('#project-container').append('<p>Không có dữ án theo điều kiện</p>');
                            return;
                        }

                        response.projects.forEach(function (project) {
                            const projectItem = `
                        <div class="col-md-4">
                            <div class="property-wrap ftco-animate fadeInUp ftco-animated">
                                <div class="img d-flex align-items-center justify-content-center" style="background-image: url(${project.image_project ?? ''})">
                                    <a href="/customer/project-detail/${project.id}" class="icon d-flex align-items-center justify-content-center btn-custom">
                                        <span class="ion-ios-link"></span>
                                    </a>
                                </div>
                                <div class="text">
                                    <h3 class="mb-0"><a href="/customer/project-detail/${project.id}">${project.name ?? ''}</a></h3>
                                    <span class="location d-inline-block mb-3"><i class="ion-ios-pin mr-2"></i>${project.specific_address ?? ''}</span>
                                </div>
                            </div>
                        </div>`;
                            $('#project-container').append(projectItem);
                        });
                    },
                    error: function (error) {
                        console.error('AJAX Error:', error);
                    }
                });
            });
        });
    </script>
@endsection
