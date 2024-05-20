<header id="header">
    <div class="container">
        <div id="user-info" data-is-logged-in="{{ Auth::check() }}" data-user-id="{{ Auth::id() }}"></div>
        <div class="row">
            <div class="col-2">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img class="logo-img" src="{{ asset('frontend') }}/asset/img/logo.svg" alt="">
                    </a>
                </div>
            </div>
            <div class="col-8">
                <div class="category">
                    <ul class="category-list">
                        @foreach (getCategory() as $item)
                            <li class="category-item"><a
                                    href="{{ route('category', ['category' => $item->slug]) }}">{{ $item->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-2">
                <div class="search-cart">
                    <div class="search"><i class="fa-solid fa-magnifying-glass"></i></div>
                    <div class="">
                        <a href="" style="color: white" class="cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </div>
                    @if (Auth::check())
                        <div class="user">
                            <div class="user__avatar">
                                <span>{{ Auth::user()->name }}</span>
                                <div class="user-block">
                                    <ul>
                                        <li><a href="{{ route('profile', ['user' => Auth::user()->id]) }}">Thông tin</a>
                                        </li>
                                        <li><a
                                                href="{{ route('frontend.ordermanager', ['user' => Auth::user()->id]) }}">Đơn
                                                hàng</a></li>
                                        <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <form class="form-search" onsubmit="return false;">
                <div class="click-search active">
                    <i class="topzone-search"></i>
                    <input type="text" placeholder="Tìm kiếm sản phẩm" class="input-search">
                    <i class="topzone-delSearch"></i>
                </div>
                <button type="submit" class="submit-search" style="display:none">
                </button>
                <div class="sg-search active" style="display: none;"> <small>Sản phẩm gợi ý</small>
                    <ul class="list-sg-search">
                        {{-- <li>
                            <a href="/iphone/iphone-15-pro-512gb" class="main-contain" data-s="Nomal" data-site="16"
                                data-pro="3" data-cache="True" data-name="iPhone 15 Pro" data-id="303832"
                                data-brand="iPhone (Apple)" data-cate="iPhone" data-box="BoxHome">
                                <div class="img-search">
                                    <img src="https://cdn.tgdd.vn/Products/Images/42/303832/s16/iphone-15-pro-blue-1-2-650x650.png"
                                        alt="iPhone 15 Pro 512GB">
                                </div>
                                <div class="text-img">
                                    <span>iPhone 15 Pro 512GB</span>
                                    <p>
                                        <b>34.590.000₫</b>
                                        
                                    </p>
                                </div>
                            </a>
                        </li> --}}
                    </ul>




                </div>
            </form>
        </div>
    </div>
</header>
@push('jscustom')
    <script>
        $(document).ready(function() {
            var url = "{{ route('cart', ['user' => 'user_id']) }}";
            var userInfo = document.getElementById('user-info');
            var isLoggedIn = userInfo.getAttribute('data-is-logged-in');
            var userId = userInfo.getAttribute('data-user-id');
            // break;
            window.addEventListener('message', function(event) {
                if (event.data === 'login_success') {
                    location.reload();
                    window.close();
                    url = url.replace('user_id', userId);
                    // window.location.href = url;
                }
            });
            $('.cart').click(function(e) {
                e.preventDefault();
                if (isLoggedIn) {
                    url = url.replace('user_id', userId);
                    window.location.href = url;
                } else {
                    // open new window to login
                    window.open("{{ route('login') }}", "_blank");
                }
            });

        });
        $('.search').click(function() {
            $('.bg-sg').show();
            $('.form-search').addClass('active');
            $('.form-search input').focus();
            $('.category-list').hide();
            $('.logo-img').hide();
            $('.search-cart').hide();
            // disable scroll
            $('body').css('overflow', 'hidden');

        });
        $('.topzone-delSearch').click(function() {
            $('.form-search input').val('');
            $('.sg-search').hide();
        });
        // click oustide
        $(document).mouseup(function(e) {
            var container = $(".form-search");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                $('.bg-sg').hide();
                $('.form-search').removeClass('active');
                $('.category-list').show();
                $('.logo-img').show();
                $('.search-cart').show();
                // enable scroll
                $('body').css('overflow', 'auto');
            }
        });
        // wait 300ms to submit search

        let timeoutId;

        $('.input-search').on('keyup', function() {
            clearTimeout(timeoutId); // Xóa bộ đếm thời gian trước đó
            $('.list-sg-search').html("");
            var search = $(this).val();
            if (search.length == 0) {
                $('.sg-search').hide();
                $('.sg-search').hide();
            }
            // Đặt bộ đếm thời gian mới
            timeoutId = setTimeout(function() {
                $.ajax({
                    url: "{{ route('search') }}",
                    type: 'GET',
                    data: {
                        search: search
                    },
                    success: function(response) {
                        $('.sg-search').show();
                        let html = '';
                        response.content.forEach(element => {
                            var route =
                                "{{ route('product.detail', ['product_type' => ':slug', 'atribute' => ':color_id']) }}";
                            route = route.replace(':slug', element.slug);
                            route = route.replace(':color_id', element.color_id);
                            var img = "{{ route('image', ['image' => ':img']) }}";
                            img = img.replace(':img', element.img);
                            html +=
                                '<li>' +
                                '<a href="' + route + '" class="main-contain">' +
                                '<div class="img-search">' +
                                '<img src="' + img + '" alt="">' +
                                '</div>' +
                                '<div class="text-img">' +
                                '<span>' + element.name + '</span>' +
                                '<p>' +
                                '<b>' + element.price + '₫</b>' +
                                '</p>' +
                                '</div>' +
                                '</li>';
                        });
                        $('.list-sg-search').html(html);
                    }
                });
            }, 500); // 2000ms = 2s
        });
    </script>
@endpush
