@extends('frontend.layout.index')
@push('csscustom')
    <style>
        .owl-dot.active {
            border: 3px solid #2997ff;
        }

        .owl-dot {
            display: inline-block;
            vertical-align: middle;
            margin: 0 10px 0 0;
            border-radius: 8px;
            background: #fff;
            height: 80px !important;
            width: 80px;
            padding: 4px !important;
            border: 3px solid transparent;
            /* position: relative; */

        }

        .product-detail-slide {
            position: relative;
            z-index: 1;
        }

        .owl-dots {
            width: 100%;
            white-space: nowrap;
            overflow-x: scroll;
            /* Cho phép cuộn ngang */
            margin: 20px 0 0;
            position: relative;
        }

        .owl-dots::-webkit-scrollbar {
            display: none;
        }
    </style>
@endpush
@section('content')
    <div class="content">
        <div style="padding-top: 20px"></div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="product-detail-slide owl-carousel owl-theme">
                    @foreach ($image as $atribute)
                        @foreach ($atribute->color->image as $key => $value)
                            <div class="item">
                                <img class="product-detail--img" src="{{ route('image', ['image' => $value->image]) }}"
                                    alt="">
                            </div>
                        @endforeach
                    @endforeach
                </div>
                <ul id='carousel-custom-dots' class='owl-dots'>
                    @foreach ($image as $atribute)
                        @foreach ($atribute->color->image as $key => $value)
                            <button class='owl-dot'><img src='{{ route('image', ['image' => $value->image]) }}'
                                    alt='' class='img-fluid' /></button>
                        @endforeach
                    @endforeach
                </ul>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="detail-des">
                    <form id="add-cart">
                        <h1 class="product-detail--name">{{ $product_detail->name }}</h1>
                        <div class="product-size">
                            <ul>
                                @foreach ($capacity as $key => $item)
                                    @if (currentURL() == route('product.detail', ['product_type' => $item]))
                                        <li class="product-size--option active"><a
                                                href="{{ route('product.detail', ['product_type' => $item]) }}">{{ $key }}</a>
                                        </li>
                                    @else
                                        <li class="product-size--option"><a
                                                href="{{ route('product.detail', ['product_type' => $item]) }}">{{ $key }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="product-color">
                            <span>Màu </span>
                            <ul>
                                @foreach ($color as $key => $item)
                                    <li><a data-id="{{ $item->id }}"style="background-color: #{{ $item->value }}"
                                            class="product-color--option"
                                            href="{{ route('product.detail', ['product_type' => $product_type, 'color_id' => $item->id]) }}"></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <strong class="product-detail--price">{{ number_format($price[0], 0, '.', '.') }}₫</strong>
                        <div class="btn-group">

                            <div id="user-info" data-is-logged-in="{{ Auth::check() }}"
                                data-user-id="{{ Auth::id() }}"></div>
                            <button type="submit" class="btn-detail btn-detail--buy">Mua ngay</button>
                        </div>
                </div>
                </form>
            </div>
        </div>

    </div>
    <div class="product_detail--info">
        <div class="info_tab">
            <h2 class="info_tab--item active">Mô tả</h2>
            <h2 class="info_tab--item">Thông số kỹ nhất</h2>
            <h2 class="info_tab--item">Đánh giá sản phẩm</h2>
        </div>
        <div class="info_tab--contentbox">
            <div class="info_tab--content">
                <button data-toggle="collapse" data-target="#collapse1" aria-expanded="true"
                    aria-controls="collapseExample">
                    Màn hình
                </button>
                <div id="collapse1" class="collapse show">
                    <div class="card-body">
                        <!-- Content inside the collapse panel -->
                        <ul>
                            <li>
                                <aside>
                                    <strong>Công nghệ màn hình:</strong>
                                </aside>
                                <aside>
                                    <strong>OLED</strong>
                                </aside>
                            </li>
                            <li>
                                <aside>
                                    <strong>Độ phân giải:</strong>
                                </aside>
                                <aside>
                                    <strong>2796 x 1290 Pixels</strong>
                                </aside>
                            </li>
                            <li>
                                <aside>
                                    <strong>Công nghệ màn hình:</strong>
                                </aside>
                                <aside>
                                    <strong>OLED</strong>
                                </aside>
                            </li>
                            <li>
                                <aside>
                                    <strong>Công nghệ màn hình:</strong>
                                </aside>
                                <aside>
                                    <strong>OLED</strong>
                                </aside>
                            </li>
                            <li>
                                <aside>
                                    <strong>Công nghệ màn hình:</strong>
                                </aside>
                                <aside>
                                    <strong>OLED</strong>
                                </aside>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="info_tab--content active">
                <button data-toggle="collapse" data-target="#collapse2" aria-expanded="true"
                    aria-controls="collapseExample">
                    Camera sau
                </button>
                <div id="collapse2" class="collapse">
                    <div class="card-body">
                        <!-- Content inside the collapse panel -->
                        <p>This is the collapsible content!</p>
                    </div>
                </div>
            </div>
            <div class="info_tab--content">
                <button data-toggle="collapse" data-target="#collapse3" aria-expanded="true"
                    aria-controls="collapseExample">
                    Click to Collapse
                </button>
                <div id="collapse3" class="collapse">
                    <div class="card-body">
                        <!-- Content inside the collapse panel -->
                        <p>This is the collapsible content!</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('jscustom')
    <script>
        $(document).ready(function() {
            window.addEventListener('message', function(event) {
                if (event.data === 'login_success') {
                    // Đóng tab đăng nhập
                    window.close();

                    // Reload trang gốc
                    location.reload();
                }
            });
            var url = window.location.href;
            var url_colorid = url.split('?');
            // console.log(url_colorid[1].split('='));
            if (url_colorid.length == 2) {
                var color_id = url_colorid[1].split('=');
                $('.product-color--option').each(function() {
                    if ($(this).data('id') == color_id[1]) {
                        $(this).closest('li').addClass('active');
                    }
                });
            } else {
                // get first child of class product-color--option
                $('.product-color--option').first().closest('li').addClass('active');
            }
            $('.product-detail-slide').owlCarousel({
                // loop: true,
                nav: true,
                // dots: true,
                items: 1,
                // autoplay: true,
                // autoplayTimeout: 3000,
                autoplayHoverPause: true,
                navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
                dotsContainer: '#carousel-custom-dots'
            })
            $('.owl-dot').click(function() {
                var dotIndex = $(this).index();
                var dotsContainer = $('#carousel-custom-dots');
                var dotWidth = $(this).width();
                var containerWidth = dotsContainer.width();
                var scrollLeft = dotIndex * dotWidth - (containerWidth / 2) + (dotWidth / 2);
                dotsContainer.animate({
                    scrollLeft: scrollLeft
                }, 300);

                $('.product-detail-slide').trigger('to.owl.carousel', [$(this).index(), 300]);
                // make current dot to center

            });
            $('.btn-detail--buy').click(function(e) {
                e.preventDefault();
                var userInfo = document.getElementById('user-info');
                var isLoggedIn = userInfo.getAttribute('data-is-logged-in');
                var userId = userInfo.getAttribute('data-user-id');
                let color_id = $('li.active .product-color--option').data('id');
                var id = {{ $product_detail->id }};
                var url =
                    "{{ route('postCart', ['user' => 'user_id', 'product' => 'id', 'color' => 'color_id']) }}";
                if (isLoggedIn) {
                    url = url.replace('user_id', userId);
                    url = url.replace('id', id);
                    url = url.replace('color_id', color_id);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        method: "POST",
                        data: {
                            product_id: id,
                            color_id: color_id,
                            quantity: 1,
                            user_id: userId
                        },
                        success: function(data) {
                            if (data.type == 'success') {
                                window.location.href = "{{ route('cart', '') }}" + '/' + userId;
                            }
                        }
                    })
                } else {
                    // open new window to login
                    window.open("{{ route('login') }}", "_blank");
                    var checkLoginInterval = setInterval(function() {
                        if (loginWindow.closed) {
                            clearInterval(checkLoginInterval); // Dừng việc kiểm tra khi tab đã đóng

                            // Reload trang gốc sau khi đăng nhập thành công
                            location.reload();
                        }
                    }, 1000);
                }
            })
        })
    </script>
@endpush
