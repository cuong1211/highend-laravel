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
        <div class="order__manager" style="padding: 20px 0;">
            <div class="middleCart">
                <div class="alertsuccess">
                    <i class="cartnew-success"></i>
                    <strong>Quản lý giỏ hàng</strong>
                </div>
                <div class="ordercontent">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">SĐT</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Ngày đặt hàng</th>
                                <th scope="col">Trang thái</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $order)
                                <tr>
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <th scope="row"><span>{{ $order->id }}</span></th>
                                    <td>
                                        {{-- @php
                                            $x = [];
                                            foreach ($order->cart as $item) {
                                                dd($item->color->label);
                                                foreach ($item->color as $item2) {
                                                }
                                            }
                                            dd($x);
                                        @endphp --}}
                                        <div class="box-order">
                                            <ul>
                                                @foreach ($order->cart as $cart)
                                                    {{-- @php
                                                    dd($cart);
                                                @endphp --}}
                                                    <input type="hidden" name="product_id[]"
                                                        value="{{ $cart->product_type->id }}">
                                                    <li>
                                                        @foreach ($cart->color->image as $item)
                                                            <a href="{{ route('product.detail', ['product_type' => $cart->product_type->slug, 'color_id' => $cart->color->id]) }}"
                                                                class="img-manager">
                                                                <img src="{{ route('image', ['image' => $item->image]) }}"
                                                                    alt="">
                                                            </a>
                                                        @endforeach
                                                        <div class="text-order">

                                                            <a href="{{ route('product.detail', ['product_type' => $cart->product_type->slug, 'color_id' => $cart->color->id]) }}"
                                                                class="text-order__product-name">
                                                                {{ $cart->product_type->name }}
                                                            </a>

                                                            <div class="amount-color">
                                                                <small>
                                                                    Màu:

                                                                    <small>
                                                                        {{ $cart->color->label }}
                                                                    </small>


                                                                </small>
                                                                <small>
                                                                    Số lượng:
                                                                    <small>
                                                                        {{ $cart->quantity }}
                                                                    </small>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->address }}
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($order->order_date)) }}</td>
                                    <td>
                                        @if ($order->status == 0)
                                            <span class="badge bg-warning text-dark">Đang chờ xử lý</span>
                                        @elseif($order->status == 1)
                                            <span class="badge bg-primary">Đang vận chuyển</span>
                                        @elseif($order->status == 2)
                                            <span class="badge bg-success">Đã giao hàng</span>
                                        @elseif($order->status == 3)
                                            <span class="badge bg-danger">Đã hủy</span>
                                        @elseif($order->status == 4)
                                            <span class="badge bg-secondary">Đã hủy đơn hàng</span>
                                        @endif
                                    </td>

                                    @if ($order->status == 0)
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <input type="hidden" name="user_id" value="{{ $user }}">
                                                <button type="button" class="btn btn-secondary cancal-order">Hủy</button>
                                            </div>
                                        </td>
                                    @endif
                                    @if ($order->status == 2 && $order->isRated == 0)
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <input type="hidden" name="user_id" value="{{ $user }}">

                                                <button type="button" class="btn btn-secondary rate-order"
                                                    style="background-color: #0071e3;
                                                    border: 1px solid #0071e3;
                                                    border-radius: 8px;
                                                    color: #fff;
                                                    cursor: pointer;
                                                    font-size: 15px;
                                                    display: block;
                                                    line-height: 17px;
                                                    padding: 14px 10px;
                                                    text-align: center;
                                                    transition: .3s;
                                                    width: 49%;">
                                                    Đánh giá sản phẩm

                                                </button>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class=" bg-coverrate" style="display: none;"></div>
                <div class="popup-rating-topzone" style="display: none;">
                    <div class="close-rate">X</div>
                    <p class="txt">Đánh giá sản phẩm</p>
                    <ul class="rating-topzonecr-star">
                        <li data-val="1">
                            <i class="iconcmt-unstarlist"></i>
                            <p data-val="1">Rất tệ</p>
                        </li>
                        <li data-val="2">
                            <i class="iconcmt-unstarlist"></i>
                            <p data-val="2">Tệ</p>
                        </li>
                        <li data-val="3">
                            <i class="iconcmt-unstarlist"></i>
                            <p data-val="3">Tạm ổn</p>
                        </li>
                        <li data-val="4">
                            <i class="iconcmt-unstarlist"></i>
                            <p data-val="4" class="">Tốt</p>
                        </li>
                        <li data-val="5">
                            <i class="iconcmt-unstarlist"></i>
                            <p data-val="5">Rất tốt</p>
                        </li>
                    </ul>
                    <form action="" class="form-rate">
                        <div class="inputrating__group">
                            <textarea class="fRContent" name="comment" placeholder="Mời bạn chia sẻ thêm cảm nhận..."></textarea>

                        </div>


                        <div class="dcap"><button type="submit"class="submit send-rate disabled">Gửi
                                đánh giá</button></div>

                    </form>
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
                var id = $(this).parents('tr').find('th').text();
                console.log(id);
                var user_id = $('input[name="user_id"]').val();
                console.log(user_id);
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
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
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
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        text: "Hủy đơn hàng thất bại",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "OK",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    });
                                }
                            }
                        });
                    }
                });
            });
            var product_id = [];
            var order_id;
            $('.rate-order').click(function() {
                $('.bg-coverrate').show();
                $('.popup-rating-topzone').show();
                // get product_id from input hidden of this click to array
                $(this).parents('tr').find('input[name="product_id[]"]').each(function() {
                    product_id.push($(this).val());
                });
                // get order_id from input hidden of this click
                order_id = $(this).parents('tr').find('input[name="order_id"]').val();
            })
            $('.close-rate').click(function() {
                $('.bg-coverrate').hide();
                $('.popup-rating-topzone').hide();
                // reset form
                $('.rating-topzonecr-star li i').removeClass('active');
                $('.fRContent').val('');
                $('.send-rate').addClass('disabled');
                // reset product_id array
                product_id = [];
                // reset order_id
                order_id = '';
            });
            // Khởi tạo biến để lưu giá trị của sao được click
            let selectedRating = 0;

            // Bắt sự kiện click trên các icon sao
            document.querySelectorAll('.iconcmt-unstarlist').forEach((star, index, stars) => {
                star.addEventListener('click', function() {
                    // Xóa class 'active' khỏi tất cả các sao
                    stars.forEach(s => s.classList.remove('active'));

                    // Thêm class 'active' cho các sao từ đầu đến vị trí được chọn
                    for (let i = 0; i <= index; i++) {
                        stars[i].classList.add('active');
                    }

                    // Lấy giá trị data-val từ thẻ li hoặc p gần nhất
                    const ratingValue = this.closest('li').getAttribute('data-val') || this.closest(
                        'p').getAttribute('data-val');
                    selectedRating = ratingValue;

                    // Hiển thị giá trị được chọn
                });
            });

            $('.form-rate').submit(function(e) {
                e.preventDefault();
                var comment = $('.fRContent').val();
                var user_id = $('input[name="user_id"]').val();
                var url = "{{ route('frontend.rate') }}";
                console.log(product_id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    url: url,
                    method: "POST",
                    data: {
                        order_id: order_id,
                        product_id: product_id,
                        user_id: user_id,
                        rating: selectedRating,
                        comment: comment
                    },
                    success: function(data) {
                        if (data.type == 'success') {
                            $('.bg-coverrate').hide();
                            $('.popup-rating-topzone').hide();
                            Swal.fire({
                                text: "Đánh giá sản phẩm thành công",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "OK",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                text: "Đánh giá sản phẩm thất bại",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "OK",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    }
                });
            });




        });
    </script>
@endpush
