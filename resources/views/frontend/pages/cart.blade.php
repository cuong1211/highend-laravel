@extends('frontend.layout.index')
@push('csscustom')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        footer {
            display: none;
        }
    </style>
@endpush
@section('content')
    <div class="order-background">
        <div class="order">
            @if ($cart->count() === 0)
                <div class="cartempty"><i class="cartnew-empty"></i><span>Giỏ hàng của bạn chưa có sản phẩm nào!</span><a
                        href="{{ route('home') }}" class="backhome">Về trang chủ</a>
                    <p>Hỗ trợ: <a style="color: #288ad6" href="tel:1900969642">1900 9696 42</a> (08h00 - 21h30)</p>
                </div>
            @else
                <form id="form-order">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="total" value="{{ $total }}">
                    <div class="top-content d-flex justify-content-between">
                        <a href="{{ route('home') }}" class="buymore"><i class="fa-solid fa-arrow-left"></i>Mua thêm sản
                            phẩm
                            khác</a>
                        <span>Giỏ hàng của bạn</span>
                    </div>
                    <div class="middleCart">
                        <div style="padding: 10px;">
                        </div>
                        <ul class="listing-cart">
                            @foreach ($cart as $carts)
                                @php
                                    $product = App\models\Product_type::where('id', $carts->product_type_id)->first()->name;
                                    $image = App\models\Image::where('color_id', $carts->color_id)
                                        ->where('is_thumbnail', 1)
                                        ->first()->image;
                                    $color = App\models\Atribute::where('product_type_id', $carts->product_type_id)
                                        ->with('color')
                                        ->get();
                                @endphp
                                <li class="product-item">
                                    <input type="hidden" id="cart_id" value="{{ $carts->id }}">
                                    <div class="product-item_img">
                                        <a href="" target="_blank">
                                            <img src="{{ route('image', ['image' => $image]) }}" alt=""
                                                style="width: 80px;margin: auto;">
                                        </a>
                                        <div>
                                            <input type="hidden" value="{{ $carts->id }}">
                                            <button class="product-delete">Xoá</button>
                                        </div>
                                    </div>
                                    <div class="product-item_info">
                                        <div class="name-price">
                                            <div class="name-container">
                                                <a href="" class="product-item_name">{{ $product }}</a>
                                            </div>
                                            <span>
                                                {{ number_format($carts->price, 0, '.', '.') }}đ
                                                <strike>
                                                    16.000.000đ
                                                </strike>
                                            </span>
                                        </div>
                                        <div class="quantity-color">
                                            <div class="choose-color">
                                                <select name="" id="select-color">
                                                    @foreach ($color as $color)
                                                        <option value="{{ $color->color->id }}"
                                                            @if ($color->color->id == $carts->color_id) selected="selected" @endif>
                                                            <small>{{ $color->color->label }}</small>
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="choose-quantity">
                                                <input type="hidden" value="{{ $carts->id }}">
                                                <div class="minus btn-minus">
                                                    <i class="fa-solid fa-minus"></i>
                                                </div>
                                                <input type="text" class="number" value="{{ $carts->quantity }}">
                                                <div class="plus btn-plus">
                                                    <i class="fa-solid fa-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="total-provisional">
                            <span class="total-product-quantity">
                                <span class="total-label">Tạm tính</span>
                                ({{ $cart->count() }} sản phẩm):
                            </span>
                            <span class="total-money">
                                {{ number_format($total, 0, '.', '.') }}đ
                            </span>
                        </div>
                        <div class="customer-info">
                            <h4>Thông tin khách hàng</h4>
                            <form action="" class="customer-info-form">
                                <div class="field-name">
                                    <input type="text" name="name" placeholder="Họ và Tên"
                                        value="{{ $user->name }}" required>
                                </div>
                                <div class="field-name field-phone">
                                    <input type="text" name="phone" placeholder="Số điện thoại"
                                        value="{{ $user->phone }}" required>
                                </div>
                                <div class="delivery">

                                </div>
                            </form>
                        </div>
                        <div class="address-info">
                            <h4>Thông tin địa chỉ giao hàng</h4>
                            <div class="deli-address">
                                @if ($user->address)
                                    <div class="text-address">
                                        <div class="text-address__selection visible">
                                            <i class="cartnew-choose active"></i>
                                            <input type="radio" checked value="">
                                            <label class="user-address">{{ $user->address }}</label>
                                        </div>
                                        <div class="text-address__other-addresses">
                                            <small class="text-addresses__item add-more add_address">Thêm địa chỉ
                                                khác</small>
                                        </div>
                                    </div>
                                @endif
                                <div class="cntry-district">
                                    <select name="city" id="select-city" class="select-address"></select>
                                    <select name="district" id="select-district" class="select-address"></select>
                                    <select name="ward" id="select-ward" class="select-address"></select>
                                    <input name="address" class="select-address input-address" type="text"
                                        placeholder="Số nhà, tên đường">
                                </div>
                            </div>
                        </div>
                        <div class="anotheroption">
                            <div class="customer-note">
                                <input type="text" name="note" placeholder="Nhập ghi chú (nếu có)">
                            </div>
                        </div>
                        <div class="finaltotal">
                            <div class="total-price">
                                <strong>
                                    Tổng tiền:
                                </strong>
                                <strong>
                                    {{ number_format($total, 0, '.', '.') }}đ
                                </strong>
                            </div>
                            <button class="submitorder">
                                <b style="text-transform:uppercase">Đặt hàng</b>
                            </button>
                        </div>
                    </div>
                </form>

        </div>
        @endif
    </div>
@endsection
@push('jscustom')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        async function loadDistrict() {
            $('#select-district').empty();
            const path = $('#select-city option:selected').data('path');
            const response = await fetch('{{ asset('locations/') }}' + path);
            console.log(response);
            const districts = await response.json();
            // console.log(districts);
            $.each(districts.district, function(index, each) {
                $('#select-district').append(`<option data-path='${each.name}'>
                    ${each.name}
                </option>`);
            })
            $('#select-district').change(function() {
                loadWard();
            })
            loadWard();
        }
        async function loadWard() {
            $('#select-ward').empty();
            const path = $('#select-district option:selected').data('path');
            const path1 = $('#select-city option:selected').data('path');
            const response = await fetch('{{ asset('locations/') }}' + path1);
            const districts = await response.json();
            const selectedDistrict = districts.district.find(district => district.name === path);
            $.each(selectedDistrict.ward, function(index, each) {
                $('#select-ward').append(`<option>${each.name}</option>`);
            });

        }
        $(document).ready(async function() {
            $('#select-city').select2();
            $('#select-district').select2();
            $('#select-ward').select2();
            const response = await fetch('{{ asset('locations/index.json') }}');
            const cities = await response.json();
            $.each(cities, function(index, each) {
                $('#select-city').append(`<option data-path='${each.file_path}'>
                    ${index}
                    </option>`);
            })
            $('#select-city').change(function() {
                loadDistrict();
            })
            loadDistrict();
        });
        $(document).ready(function() {

            if ($('.number').val() == 1) {
                $('.btn-minus').addClass('disabled');
            } else {
                $('.btn-minus').removeClass('disabled');
            }
            $('.btn-plus').click(function() {
                var id = $(this).parent().find('input').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('frontend.cart.plus', '') }}" + '/' + id,
                    method: "PUT",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        // set total price
                        window.location.reload();

                    }
                });

            });
            $('.btn-minus').click(function() {
                var id = $(this).parent().find('input').val();
                if ($('.number').val() == 1) {
                    javascript: return false;
                }
                else {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('frontend.cart.minus', '') }}" + '/' + id,
                        method: "PUT",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            // $(this).attr('disabled', false);
                            window.location.reload();
                        }
                    });
                }
            });
            $('.product-delete').click(function() {
                var id = $(this).parent().find('input').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('frontend.cart.delete', '') }}" + '/' + id,
                    method: "DELETE",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        window.location.reload();
                    }
                });
            });
            $(document).on('change', '#select-color', function() {
                var id = $(document).find('#cart_id').val();
                var color_id = $(this).val();
                console.log(color_id, id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('frontend.cart.update', '') }}" + '/' + id,
                    method: "PUT",
                    data: {
                        id: id,
                        color_id: color_id,
                    },
                    success: function(data) {
                        window.location.reload();
                    }
                });
            });
            $('#form-order').on('submit', function(e) {

                e.preventDefault();
                console.log('submit');
                var name = $(this).find('input[name="name"]').val();
                var phone = $(this).find('input[name="phone"]').val();
                if ($('.user-address').text() != '') {
                    var user_address = $('.user-address').text();
                } else {
                    var city = $(this).find('select[name="city"]').val();
                    var district = $(this).find('select[name="district"]').val();
                    var ward = $(this).find('select[name="ward"]').val();
                    var address = $(this).find('input[name="address"]').val();
                    var user_address = address + ', ' + ward + ', ' + district + ', ' + city;
                }
                var note = $(this).find('input[name="note"]').val();
                var total = $(this).find('input[name="total"]').val();
                var user_id = $(this).find('input[name="user_id"]').val();
                Swal.fire({
                    text: "Xác nhận đặt hàng?(Vui lòng kiểm tra lại thông tin đơn hàng)",
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
                            url: "{{ route('postCheckout') }}",
                            method: "POST",
                            data: {
                                user_id: user_id,
                                name: name,
                                phone: phone,
                                address: user_address,
                                note: note,
                                total: total,
                            },
                            success: function(data) {
                                if (data.type == 'success') {
                                    var route = "{{ url('checkout') }}" + "/" + data
                                        .content +
                                        "/complete";
                                    window.location.href = route;
                                }

                            }
                        });
                    }
                });
            })

        });
        $('.cntry-district').hide();
        $('.add_address').click(function() {
            $('.cntry-district').show();
            $('.input-address').attr('required', true);
            $('.user-address').text('');
            $('.text-address').hide();
        })
    </script>
@endpush
