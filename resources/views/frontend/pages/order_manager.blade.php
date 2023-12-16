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
                                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
        });
    </script>
@endpush
