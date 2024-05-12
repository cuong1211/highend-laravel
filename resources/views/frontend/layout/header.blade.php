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
                                        <li><a href="{{ route('frontend.ordermanager', ['user' => Auth::user()->id]) }}">Đơn
                                                hàng</a></li>
                                        <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
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
    </script>
@endpush
