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
                        <strong class="product-detail--price">{{ number_format($price[0], 0, '.', '.') }}₫</strong>
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
                            <span>Màu: </span>
                            <ul>
                                @foreach ($color as $key => $item)
                                    <li><a data-id="{{ $item->id }}"style="background-color: #{{ $item->value }}"
                                            class="product-color--option"
                                            href="{{ route('product.detail', ['product_type' => $product_type, 'color_id' => $item->id]) }}"></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="promotion-detail">
                            <span>Khuyến mãi</span>
                            <div class="content-promo">
                                <p>
                                    <i></i>
                                    <b>
                                        Bảo Hành 24 tháng (12 tháng chính hãng + 12 tháng tại TopCare)
                                    </b>
                                </p>
                                <p>
                                    <i></i>
                                    <b>
                                        Thu cũ Đổi mới: Giảm đến 2 triệu (Tuỳ model máy cũ, Không kèm thanh toán qua cổng
                                        online, mua kèm)
                                    </b>
                                </p>
                                <p>
                                    <i></i>
                                    <b>
                                        Nhập mã VNPAYTGDD2 giảm ngay 1% (tối đa 200.000đ) khi thanh toán qua VNPAY-QR, áp
                                        dụng cho đơn hàng từ 3 Triệu
                                    </b>
                                </p>
                            </div>
                        </div>
                        <div class="btn-group">

                            <div id="user-info" data-is-logged-in="{{ Auth::check() }}"
                                data-user-id="{{ Auth::id() }}"></div>
                            <button type="submit" class="btn-detail btn-detail--buy">Mua ngay</button>
                        </div>
                        <ul class="policy-product">
                            <li>
                                <span><i class="fa-solid fa-box"></i>Bộ sản phẩm gồm: Hộp, Sách hướng dẫn, Cây lấy
                                    sim, Cáp Type C</span>
                            </li>
                            <li>

                                <span><i class="fas fa-check-circle"></i>Hư gì đổi nấy 12 tháng tại cơ sở trên
                                    toàn quốc</span>
                            </li>
                            <li>

                                <span><i class="fa-solid fa-shield-halved"></i>Bảo hành chính hãng 1 năm</span>
                            </li>
                            <li>

                                <span><i class="fa-solid fa-truck-fast"></i>Giao hàng nhanh toàn quốc</span>
                            </li>
                            <li>

                                <span><i class="fa-solid fa-phone"></i>Tổng đài: 1900.9696.42 (7:30 - 22:00)</span>
                            </li>
                        </ul>

                    </form>
                </div>

            </div>
        </div>

    </div>
    <div class="product_detail--info">
        <div class="access-needbuy">
            <div class="an-title">
                <strong class="sg-access">
                    Sản phẩm nên mua kèm
                </strong>

            </div>
            <div class="access-sg">
                <div class="item">
                    <a href="">
                        <div class="img-access-sg">
                            <img src="https://cdn.tgdd.vn/Products/Images/9499/230315/s16/adapter-sac-type-c-20w-cho-iphone-ipad-apple-mhje3-101021-023343-650x650.png"
                                alt="">
                        </div>
                    </a>
                    <h3>Adapter sạc Apple USB-C 20W</h3>
                    <span>
                        <b>550.000đ</b>
                    </span>
                </div>
            </div>
        </div>
        <div class="info_tab">
            <h2 class="info_tab--item description active" onclick="openContent('description')">Mô tả</h2>
            <h2 class="info_tab--item specification" onclick="openContent('specification')">Thông số kỹ nhất</h2>
            <h2 class="info_tab--item" onclick="openContent('info')">Đánh giá sản phẩm</h2>
        </div>
        <div class="info_tab--contentbox">
            <div class="info_tab--content active" id="description">
                {!! $description->description !!}
                <div class="bg-article"></div>
                <a class="read-more-button">Xem thêm</a>
            </div>

            <div class="info_tab--content" style="display: none" id="specification">
                @foreach ($specification as $item)
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id }}"
                        aria-expanded="false" aria-controls="collapse{{ $item->id }}">
                        {{ $item->name }}
                    </button>
                    <div id="collapse{{ $item->id }}" class="collapse">
                        <div class="card-body">
                            <!-- Content inside the collapse panel -->
                            <ul>
                                @foreach ($item->specification_detail as $item2)
                                    <li>
                                        <aside>
                                            <strong>{{ $item2->label }}:</strong>
                                        </aside>
                                        <aside>
                                            <strong>{{ $item2->value }}</strong>
                                        </aside>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- <div class="info_tab--content active">
                {!! $preview->preview !!}
            </div> --}}

        </div>
        <div class="wrap_rating wrap_border">
            <div class="rating-topzone rc-topzone">
                <div class="rating-topzone rc-topzone">
                    <div class="rating-topzonecmt-hascmt">
                        <div class="boxrate rate-topzone">
                            <h2 class="boxrate__title">Đánh giá iPhone 15 Pro Max</h2>
                            <div class="boxrate__top">
                                <div class="box-star">
                                    <div class="point">
                                        <p>3.7</p>
                                        <i class="iconcmt-allstar"></i>
                                        <i class="iconcmt-allstar"></i>
                                        <i class="iconcmt-allstar"></i>
                                        <i class="iconcmt-allhalfstar"></i>
                                        <i class="iconcmt-allunstar"></i>
                                        <a href="/iphone/iphone-15-pro-max/danh-gia" data-total="6" data-site="16"
                                            style="cursor: pointer" class="total-cmtrt">6 đánh giá </a>
                                    </div>
                                    <ul class="rate-list">
                                        <li>
                                            <div class="number-star">
                                                5<i class="iconcmt-blackstar"></i>
                                            </div>
                                            <div class="timeline-star">
                                                <p class="timing" style="width: 50%"></p>
                                            </div>
                                            <span class="number-percent">50%</span>
                                        </li>
                                        <li>
                                            <div class="number-star">
                                                4<i class="iconcmt-blackstar"></i>
                                            </div>
                                            <div class="timeline-star">
                                                <p class="timing" style="width: 0%"></p>
                                            </div>
                                            <span class="number-percent">0%</span>
                                        </li>
                                        <li>
                                            <div class="number-star">
                                                3<i class="iconcmt-blackstar"></i>
                                            </div>
                                            <div class="timeline-star">
                                                <p class="timing" style="width: 17%"></p>
                                            </div>
                                            <p class="number-percent dsp">17%</p>
                                        </li>
                                        <li>
                                            <div class="number-star">
                                                2<i class="iconcmt-blackstar"></i>
                                            </div>
                                            <div class="timeline-star">
                                                <p class="timing" style="width: 33%"></p>
                                            </div>
                                            <p class="number-percent dsp">33%</p>
                                        </li>
                                        <li>
                                            <div class="number-star">
                                                1<i class="iconcmt-blackstar"></i>
                                            </div>
                                            <div class="timeline-star">
                                                <p class="timing" style="width: 0%"></p>
                                            </div>
                                            <p class="number-percent dsp">0%</p>
                                        </li>
                                    </ul>
                                </div>


                                <div class="popup-rating-topzone" style="display: none;">
                                    <div class="close-rate"></div>
                                    <p class="txt">Đánh giá sản phẩm</p>
                                    <div class="bproduct">
                                        <div class="img">
                                            <img src="https://cdn.tgdd.vn/Products/Images/42/305658/s16/iphone-15-pro-max-blue-1-2-650x650.png"
                                                alt="iPhone 15 Pro Max">
                                        </div>

                                        <h3>iPhone 15 Pro Max</h3>
                                    </div>
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
                                    {{-- <form action="" class="form-rate" style="display: none;">
                                        <div class="inputrating__group">
                                            <textarea class="fRContent" name="fRContent" placeholder="Mời bạn chia sẻ thêm cảm nhận..."></textarea>
                                            <div class="txtcount__box">
                                                <span class="ct" style="display: none;">0 chữ</span>
                                            </div>
                                        </div>

                                        <div class="form-column">


                                            <div class="upload__box  ">
                                                <div class="upload__btn-box">
                                                    <label class="upload__btn">
                                                        <a href="javascript:void(0)" class="send-img">
                                                            <i class="iconcmt-camera"></i>
                                                            <p>Gửi ảnh thực tế <span>(tối đa 3 ảnh)</span></p>
                                                        </a>
                                                        <input id="hdFileRatingUpload" name="hdfRatingImg" type="file"
                                                            multiple="" accept="image/x-png, image/gif, image/jpeg"
                                                            data-max_length="3" class="upload__inputfile hide">

                                                        <input type="hidden" name="hdfRatingImg" id="hdfRatingImg"
                                                            class="hdfRatingImg" value="">
                                                        <input type="hidden" name="hdUrl"
                                                            value="http://www.topzone.vn/iphone/iphone-15-pro-max">
                                                    </label>
                                                </div>
                                                <div class="upload__img-wrap hide"></div>
                                            </div>

                                            <div class="agree"><span></span>
                                                <p>Tôi sẽ giới thiệu sản phẩm cho bạn bè, người thân</p>
                                            </div>
                                        </div>

                                        <div class="item">
                                            <input type="text" class="fRName" name="fRName"
                                                placeholder="Họ tên (bắt buộc)">
                                            <input type="text" class="fRPhone" onkeypress="validateOnlyNumber(event)"
                                                name="fRPhone" placeholder="Số điện thoại (bắt buộc)">
                                            <input type="hidden" name="hdfProductID" value="305658">
                                            <input name="submit" type="hidden">
                                            <p class="formrate__information">
                                                <i class="iconcmt-shield"></i>
                                                TopZone cam kết bảo mật số điện thoại của bạn
                                            </p>

                                        </div>

                                        <button type="button" id="submitrt" class="submit send-rate disabled"
                                            style="display: none;">Gửi đánh giá</button>
                                        <div class="dcap"><button type="button" id="submitrt"
                                                class="submit send-rate disabled">Gửi đánh giá</button></div>

                                        <p class="intro-txt"><a target="&quot;_blank&quot;"
                                                href="/quy-dinh-dang-binh-luan">Quy định đánh giá</a><a
                                                href="/bao-mat-thong-tin">Chính sách bảo mật thông tin</a></p>

                                        <div><input id="g-recaptcha-response_captcha_595027132"
                                                name="g-recaptcha-response" type="hidden">
                                            <script>
                                                var onloadCallbackcaptcha_595027132 = function() {
                                                    var form = $('input[id="g-recaptcha-response_captcha_595027132"]').closest('form');
                                                    var btn = $(form.find('.submit')[0]);
                                                    btn.after("<div class='dcap'></div>");

                                                    var loaded = false;
                                                    var isBusy = false;
                                                    btn.clone(false, false).unbind('click').on('click', function(e) {

                                                            if (!isBusy) {
                                                                isBusy = true;
                                                                grecaptcha.execute('6LdjGgcaAAAAAJQ8ucRoMhdyKXlUxGdrEycRnACr', {
                                                                    'action': 'SubmitRatingComment'
                                                                }).then(function(token) {
                                                                    $('#g-recaptcha-response_captcha_595027132', form).val(token);
                                                                    loaded = true;
                                                                    isBusy = false;
                                                                    btn.click();
                                                                });
                                                            }
                                                            return loaded;
                                                        })
                                                        .prependTo(form.find('.dcap')[0]).each(function() {
                                                            btn.hide();
                                                        });

                                                }
                                            </script>
                                            <script async="" defer=""
                                                src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackcaptcha_595027132&amp;render=6LdjGgcaAAAAAJQ8ucRoMhdyKXlUxGdrEycRnACr&amp;hl=vi">
                                            </script>
                                            <style>
                                                .grecaptcha-badge {
                                                    display: none !important;
                                                }
                                            </style>
                                        </div>

                                    </form> --}}
                                </div>
                                <div class="bgcover-errorForm"></div>

                                {{-- <div class="popup-errorForm">
                                    <p class="content">Cảm nhận về sản phẩm chưa được nhập, bạn sẵn lòng chia sẻ thêm chứ?
                                    </p>
                                    <div class="btn-errorForm">
                                        <span class="unsend-rate" onclick="popupNotiHide()">Không, gửi đánh giá</span>
                                        <span class="ctnsend-rate ctnsend-continue">Có, viết cảm nhận</span>
                                    </div>
                                </div>

                                <div class="popup-errorForm popup-incomplete">
                                    <p class="content">Chờ đã! Bạn chưa gửi đánh giá của mình, bạn có muốn gửi đi không?
                                    </p>
                                    <div class="btn-errorForm">
                                        <span class="unsend-rate" onclick="popupNotiHide()">Có</span>
                                        <span class="ctnsend-rate">Không</span>
                                    </div>
                                </div>


                                <div class="bgcover-success"></div>
                                <div class="popup-success">
                                    <h3 class="txt"><b>Cảm ơn bạn đã đánh giá sản phẩm</b></h3>
                                    <p class="content">Hệ thống sẽ kiểm duyệt đánh giá của bạn về <b>iPhone 15 Pro Max</b>
                                        và đăng lên sau 24h nếu phù hợp với <a href="/quy-dinh-dang-binh-luan">quy định
                                            đánh giá</a></p>
                                    <div class="close-popup-success" onclick="popupSuccessHide()">Đóng</div>
                                </div> --}}

                            </div>
                          
                            {{-- <div class="bg-galleryImg rt"></div>
                            <div class="gallery rt  ">
                                <div class="gallery__top">
                                    <p class="gallery__title">0 ảnh từ khách hàng</p>
                                    <div class="gallery-close rt btn-closepopup"></div>
                                </div>
                                <div class="gallery-wrap">
                                    <div class="gallery__tab">
                                        <a href="#all" class="act">Tất cả</a>
                                        <a href="#sao5">5 <i class="iconcmt-starfilter-og"></i> </a>
                                        <a href="#sao4">4 <i class="iconcmt-starfilter-og"></i></a>
                                        <a href="#sao3">3 <i class="iconcmt-starfilter-og"></i></a>
                                        <a href="#sao2">2 <i class="iconcmt-starfilter-og"></i></a>
                                        <a href="#sao1">1 <i class="iconcmt-starfilter-og"></i></a>
                                    </div>
                                    <ul class="gallery__content">
                                    </ul>
                                </div>
                            </div> --}}


                            <div class="rt-list">
                                <ul class="comment-list">
                                    <li id="r-56788593" class="par">
                                        <div class="cmt-top">
                                            <p class="cmt-top-name">Nguyễn Thị Quỳnh Như</p>
                                            <div class="confirm-buy">
                                                <i class="iconcmt-confirm"></i>
                                                Đã mua tại TopZone
                                            </div>

                                        </div>
                                        <div class="cmt-intro">
                                            <div class="cmt-top-star">
                                                <i class="iconcmt-starbuy"></i>
                                                <i class="iconcmt-starbuy"></i>
                                                <i class="iconcmt-starbuy"></i>
                                                <i class="iconcmt-unstarbuy"></i>
                                                <i class="iconcmt-unstarbuy"></i>
                                            </div>

                                        </div>
                                        <div class="cmt-content ">
                                            <p class="cmt-txt">m mới mua đt được 3 ngày, mỗi lần vô app Shopee hay sạc đt
                                                đều nóng lên bất thường, rất nóng.Shop cho m hỏi lỗi đó có được đổi máy mới
                                                không.Máy đã cập nhật ios 17.4.1</p>
                                        </div>

                                        
                                    </li>
                                    <li id="r-56766120" class="par">
                                        <div class="cmt-top">
                                            <p class="cmt-top-name">Bùi tấn khải</p>
                                            <div class="confirm-buy">
                                                <i class="iconcmt-confirm"></i>
                                                Đã mua tại TopZone
                                            </div>

                                        </div>
                                        <div class="cmt-intro">
                                            <div class="cmt-top-star">
                                                <i class="iconcmt-starbuy"></i>
                                                <i class="iconcmt-starbuy"></i>
                                                <i class="iconcmt-unstarbuy"></i>
                                                <i class="iconcmt-unstarbuy"></i>
                                                <i class="iconcmt-unstarbuy"></i>
                                            </div>

                                        </div>
                                        <div class="cmt-content ">
                                            <p class="cmt-txt">Vừa mua dc 2 ngày ms để ý lỏng nút giảm âm lượng, mấy nút
                                                khác rất chắc chắn , nút giảm bị lỏng như hàng dỏm ý</p>
                                        </div>

                                        
                                    </li>

                                </ul>
                                <div class="box-flex">
                                    <a href="/iphone/iphone-15-pro-max/danh-gia" class="c-btn-rate btn-view-all">Xem 6
                                        đánh giá</a>
                                    <div class="c-btn-rate btn-write">Viết đánh giá</div>

                                </div>
                            </div>


                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
@push('jscustom')
    <script>
        function openContent(content) {
            var i;
            var blockContent = document.getElementsByClassName("info_tab--content");
            var clickedElements = document.getElementsByClassName(content);
            var navbarItem = document.getElementsByClassName("info_tab--item");
            for (i = 0; i < blockContent.length; i++) {
                blockContent[i].style.display = "none";
            }
            for (i = 0; i < navbarItem.length; i++) {
                navbarItem[i].classList.remove("active");
            }
            for (i = 0; i < clickedElements.length; i++) {
                clickedElements[i].classList.add("active");
            }
            document.getElementById(content).style.display = "block";
        }
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
                                window.location.href = "{{ route('cart', '') }}" + '/' +
                                    userId;
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
