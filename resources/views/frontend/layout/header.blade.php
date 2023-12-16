<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <div class="logo">
                    <a href="{{ route('home') }}"><i class="logo-img"></i></a>
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
                    @if (Auth::check())
                        <div class="cart">
                            <a href="{{ route('cart', ['user' => Auth::user()->id]) }}" style="color: white">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                        </div>
                        <div class="user">
                            <div class="user__avatar">
                                <span>Cuong</span>
                                <div class="user-block">
                                    <ul>
                                        <li><a href="{{ route('profile', ['user' => Auth::user()->id]) }}">Thông tin</a>
                                        </li>
                                        <li><a href="{{route('frontend.ordermanager',['user' => Auth::user()->id])}}">Đơn hàng</a></li>
                                        <li><a href="">Đăng xuất</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="cart">
                            <a href="{{ route('login') }}" style="color: white">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</header>
