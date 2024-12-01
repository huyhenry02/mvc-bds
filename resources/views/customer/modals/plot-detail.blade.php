<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Chi tiết khu đất</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="main-image">
                    <img id="plot-main_image" src="" alt="Main Image" class="img-fluid">
                </div>

                <div class="sub-images mt-3">
                    <div class="row">
                        <div class="col-4">
                            <img id="plot-sub_image_1" src="" alt="Sub Image 1" class="img-thumbnail mx-1">
                        </div>
                        <div class="col-4">
                            <img id="plot-sub_image_2" src="" alt="Sub Image 2" class="img-thumbnail mx-1">
                        </div>
                        <div class="col-4">
                            <img id="plot-sub_image_3" src="" alt="Sub Image 3" class="img-thumbnail mx-1">
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <p><strong>Tên khu đất:</strong> <span id="plot-name"></span></p>
                    <p><strong>Địa chỉ:</strong> <span id="plot-specific_address"></span></p>
                    <p><strong>Diện tích:</strong> <span id="plot-size"></span> m²</p>
                    <p><strong>Giá:</strong> <span id="plot-price"></span></p>
                    <p><strong>Đặt cọc:</strong> <span id="plot-deposit"></span></p>
                    <p><strong>Trạng thái:</strong> <span id="plot-status"></span></p>
                    <p><strong>Mô tả:</strong> <span id="plot-description"></span></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button class="btn btn-primary view-deposits"
                        data-bs-dismiss="modal"
                        data-bs-toggle="modal"
                        data-account_holder="{{ $project->account_holder }}"
                        data-account_number="{{ $project->account_number }}"
                        data-bank="{{ $project->bank }}"
                        data-qr_code="{{ $project->qr_code }}"
                        data-deposit_price=""
                        data-plot_id=""
                        data-bs-target="#depositModal">
                    Đặt cọc
                </button>
            </div>
        </div>
    </div>
</div>
