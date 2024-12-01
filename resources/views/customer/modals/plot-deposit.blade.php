<div class="modal fade" id="depositModal" tabindex="-1" aria-labelledby="depositModalLabel" aria-hidden="true"
     data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="depositModalLabel">Thông tin đặt cọc</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="countdown-timer" id="countdownTimer">30 phút 00 giây</div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="main-image" style="max-width: 555px">
                            <img id="transaction-qr_code" src="{{ $project->qr_code ?? '' }}" alt="qr_code"
                                 class="img-fluid">
                        </div>
                    </div>
                    <div class="col-6">
                        <div>
                            <p><strong>Ngân hàng thụ hưởng:</strong> <span>{{ $project->bank ?? '' }}</span></p>
                            <p><strong>Số tài khoản:</strong> <span>{{ $project->account_number ?? '' }}</span></p>
                            <p><strong>Số tiền:</strong> <span id="transaction-deposit_price"></span></p>
                            <p><strong>Người nhận:</strong> <span>{{ $project->account_holder ?? '' }}</span></p>
                            <p><strong>Nội dung:</strong> <span>[Số điện thoại] + [BDS]</span></p>
                        </div>
                        <div class="text-center mt-5 text-danger">
                            <p>Vui lòng chuyển đúng: Số tài khoản - số tiền - nội dung giao dịch để giao dịch được
                                ghi nhận </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <form action="{{ route('customer.postTransaction') }}" method="post">
                    @csrf
                    <input type="hidden" name="plot_id" value="" id="transaction-plot_id">
                    <button type="submit" class="btn btn-primary">Tôi đã chuyển khoản</button>
                </form>
            </div>
        </div>
    </div>
</div>
