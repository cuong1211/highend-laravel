@extends('frontend.layout.index')
@push('csscustom')
    <style>
        footer {
            display: none;
        }
    </style>
@endpush
@section('content')
    <div class="order-background">
        <div class="order" style="padding: 20px 0;">
            <div class="middleCart">
                <div class="alertsuccess">
                    <i class="cartnew-success"></i>
                    <strong>Đặt hàng thành công!</strong>
                </div>
                <div class="ordercontent">
                    <div>
                        <p>Cảm ơn Khách hàng <b>{{ $order_complete->name }}</b> đã mua sản phẩm của chúng tôi.</p>
                    </div>
                    <div class="info-order">
                        <div class="info-order-header">
                            <div>
                                <h4>
                                    Đơn hàng
                                    <span>
                                        {{ $order }}
                                    </span>
                                </h4>
                            </div>
                            <div class="header-right">
                                <a href="{{ route('frontend.ordermanager', ['user' => $order_complete->id]) }}">Quản lý đơn
                                    hàng</a>
                                <div class="cancel-order-new">
                                    <div>
                                        <input type="hidden" name="order_id" value="{{ $order }}">
                                        <input type="hidden" name="user_id" value="{{ $order_complete->id }}">
                                        <div class="cancel-order-new"><span style="margin: 0px 8px;">•</span><a
                                                class="cancal-order" href="javascript:;">Hủy</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="">
                            <span>
                                <i class="info-order__dot-icon"></i>
                                <span>
                                    <strong>Người nhận:</strong>
                                    {{ $order_complete->name }}, {{ $order_complete->phone }}
                                </span>
                            </span>
                        </label>
                        <label for="">
                            <span>
                                <i class="info-order__dot-icon"></i>
                                <span>
                                    <strong>Giao đến:</strong>
                                    {{ $order_complete->address }}
                                </span>
                            </span>
                        </label>
                        <label for="">
                            <span>
                                <i class="info-order__dot-icon"></i>
                                <span>
                                    <strong>Tổng tiền:</strong>
                                    {{ $total }}
                                </span>
                            </span>
                        </label>
                    </div>
                    <hr>
                    <div class="timetakegoods">
                        <h4>Thông tin sản phẩm</h4>
                        <div class="delivery-product-info">
                            <div class="box-order">
                                <ul>
                                    @foreach ($product as $item)
                                        <li>
                                            <a href="" class="img-order">
                                                <img src="{{ route('image', ['image' => $item->image]) }}" alt="">
                                            </a>
                                            <div class="text-order">
                                                <a href=""
                                                    class="text-order__product-name">{{ $item->product_name }}</a>
                                                <div class="amount-color">
                                                    <small>
                                                        Màu:
                                                        <small>
                                                            {{ $item->label }}
                                                        </small>
                                                    </small>
                                                    <small>
                                                        Số lượng:
                                                        <small>
                                                            {{ $item->quantity }}
                                                        </small>
                                                    </small>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="lastrow"></div>
                            </div>
                        </div>
                        <a href="" class="buyanotherNew">Về trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('jscustom')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.cancal-order').click(function() {
                var id = $(this).parent().parent().find('input[name="order_id"]').val();
                var user_id = $(this).parent().parent().find('input[name="user_id"]').val();
                var url =
                    "{{ route('frontend.ordermanager.update', ['user' => 'user_id', 'order' => 'order_id']) }}";
                url = url.replace('user_id', user_id);
                url = url.replace('order_id', id);
                Swal.fire({
                    text: "Xác nhận hủy đơn hàng?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Có!",
                    cancelButtonText: "Không",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary",
                    }
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            method: "PUT",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                if (data.type == 'success') {
                                    Swal.fire({
                                        text: "Hủy đơn hàng thành công",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "OK",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function() {
                                        window.location.href =
                                            '{{ route('home') }}';
                                    });
                                } else {
                                    alert('Hủy đơn hàng thất bại');
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
