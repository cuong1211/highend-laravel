@extends('frontend.layout.index')
@section('content')
    <div class="banner owl-carousel owl-theme">
        <div class="item"><img src="asset/img/banner-1.webp" alt=""></div>
        <div class="item"><img src="asset/img/banner-2.webp" alt=""></div>
        <div class="item"><img src="asset/img/banner-3.webp" alt=""></div>
        <div class="item"><img src="asset/img/banner-4.webp" alt=""></div>
        <div class="item"><img src="asset/img/banner-5.webp" alt=""></div>
        <div class="item"><img src="asset/img/banner-6.webp" alt=""></div>
    </div>
    {{-- <div class="flash-sale">
        <div class="flash-sale_title">
            <div class="flash-sale_icon">
                <div>
                    <img src="asset/img/icon-fs.png" alt="">
                </div>
                <div class="end-time">
                    <span>Thời gian còn lại</span>
                    <span class="time">12:00:00</span>
                </div>
            </div>
            <div class="list-time">
                <a href="" class="active">
                    <span class="list-time_title">Đang diễn ra</span>
                    <span class="time">12:00 - 11:00</span>
                </a>
                <a href="">
                    <span class="list-time_title">Sắp diễn ra</span>
                    <span class="time">12:00 - 11:00</span>
                </a>
            </div>
        </div>
        <div class="flash-sale_product owl-carousel owl-theme">
            <div class="item">
                <div class="product">
                    <div class="product-img">
                        <img src="asset/img/product.webp" alt="">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Iphone 12 Pro Max 512GB</div>
                        <strong class="product-price">
                            <span class="price">30.000.000₫</span>
                            <span class="price-old">35.000.000₫<span class="sale">-10%</span></span>
                        </strong>
                        <div class="product-buy">
                            <button class="btn-buy">Mua ngay</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <div class="product-img">
                        <img src="asset/img/product.webp" alt="">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Iphone 12 Pro Max 512GB</div>
                        <strong class="product-price">
                            <span class="price">30.000.000₫</span>
                            <span class="price-old">35.000.000₫<span class="sale">-10%</span></span>
                        </strong>
                        <div class="product-buy">
                            <button class="btn-buy">Mua ngay</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <div class="product-img">
                        <img src="asset/img/product.webp" alt="">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Iphone 12 Pro Max 512GB</div>
                        <strong class="product-price">
                            <span class="price">30.000.000₫</span>
                            <span class="price-old">35.000.000₫<span class="sale">-10%</span></span>
                        </strong>
                        <div class="product-buy">
                            <button class="btn-buy">Mua ngay</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <div class="product-img">
                        <img src="asset/img/product.webp" alt="">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Iphone 12 Pro Max 512GB</div>
                        <strong class="product-price">
                            <span class="price">30.000.000₫</span>
                            <span class="price-old">35.000.000₫<span class="sale">-10%</span></span>
                        </strong>
                        <div class="product-buy">
                            <button class="btn-buy">Mua ngay</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <div class="product-img">
                        <img src="asset/img/product.webp" alt="">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Iphone 12 Pro Max 512GB</div>
                        <strong class="product-price">
                            <span class="price">30.000.000₫</span>
                            <span class="price-old">35.000.000₫<span class="sale">-10%</span></span>
                        </strong>
                        <div class="product-buy">
                            <button class="btn-buy">Mua ngay</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <div class="product-img">
                        <img src="asset/img/product.webp" alt="">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Iphone 12 Pro Max 512GB</div>
                        <strong class="product-price">
                            <span class="price">30.000.000₫</span>
                            <span class="price-old">35.000.000₫<span class="sale">-10%</span></span>
                        </strong>
                        <div class="product-buy">
                            <button class="btn-buy">Mua ngay</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <div class="product-img">
                        <img src="asset/img/product.webp" alt="">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Iphone 12 Pro Max 512GB</div>
                        <strong class="product-price">
                            <span class="price">30.000.000₫</span>
                            <span class="price-old">35.000.000₫<span class="sale">-10%</span></span>
                        </strong>
                        <div class="product-buy">
                            <button class="btn-buy">Mua ngay</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <div class="product-img">
                        <img src="asset/img/product.webp" alt="">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Iphone 12 Pro Max 512GB</div>
                        <strong class="product-price">
                            <span class="price">30.000.000₫</span>
                            <span class="price-old">35.000.000₫<span class="sale">-10%</span></span>
                        </strong>
                        <div class="product-buy">
                            <button class="btn-buy">Mua ngay</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <div class="product-img">
                        <img src="asset/img/product.webp" alt="">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Iphone 12 Pro Max 512GB</div>
                        <strong class="product-price">
                            <span class="price">30.000.000₫</span>
                            <span class="price-old">35.000.000₫<span class="sale">-10%</span></span>
                        </strong>
                        <div class="product-buy">
                            <button class="btn-buy">Mua ngay</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <div class="product-img">
                        <img src="asset/img/product.webp" alt="">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Iphone 12 Pro Max 512GB</div>
                        <strong class="product-price">
                            <span class="price">30.000.000₫</span>
                            <span class="price-old">35.000.000₫<span class="sale">-10%</span></span>
                        </strong>
                        <div class="product-buy">
                            <button class="btn-buy">Mua ngay</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <div class="product-img">
                        <img src="asset/img/product.webp" alt="">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Iphone 12 Pro Max 512GB</div>
                        <strong class="product-price">
                            <span class="price">30.000.000₫</span>
                            <span class="price-old">35.000.000₫<span class="sale">-10%</span></span>
                        </strong>
                        <div class="product-buy">
                            <button class="btn-buy">Mua ngay</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <div class="product-img">
                        <img src="asset/img/product.webp" alt="">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Iphone 12 Pro Max 512GB</div>
                        <strong class="product-price">
                            <span class="price">30.000.000₫</span>
                            <span class="price-old">35.000.000₫<span class="sale">-10%</span></span>
                        </strong>
                        <div class="product-buy">
                            <button class="btn-buy">Mua ngay</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <div class="product-img">
                        <img src="asset/img/product.webp" alt="">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Iphone 12 Pro Max 512GB</div>
                        <strong class="product-price">
                            <span class="price">30.000.000₫</span>
                            <span class="price-old">35.000.000₫<span class="sale">-10%</span></span>
                        </strong>
                        <div class="product-buy">
                            <button class="btn-buy">Mua ngay</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <div class="product-img">
                        <img src="asset/img/product.webp" alt="">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Iphone 12 Pro Max 512GB</div>
                        <strong class="product-price">
                            <span class="price">30.000.000₫</span>
                            <span class="price-old">35.000.000₫<span class="sale">-10%</span></span>
                        </strong>
                        <div class="product-buy">
                            <button class="btn-buy">Mua ngay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    @if (Auth::check())
        <div class="category-box">
            <div>
                <a class="brand">
                    {{-- <img src="asset/img/apple.png" class="brand-icon"></i> --}}
                    <h2 class="brand-text">Sản phẩm dành cho bạn</h2>
                </a>
            </div>
            <div class="product-box">
                <div class="product-slide owl-carousel owl-theme">
                    @foreach ($product as $item)
                        {{-- @php
                        dd($item)
                    @endphp --}}
                        <div class="item">
                            <div class="product">
                                <a
                                    href="{{ route('product.detail', ['product_type' => $item['slug'], 'atribute' => $item['color_id']]) }}">
                                    <div class="product-img">
                                        <img src="{{ route('image', ['image' => $item['img']]) }}" alt="">
                                    </div>
                                    <div class="product-info">

                                        <div class="product-name">{{ $item['name'] }}</div>
                                        <strong class="product-price">
                                            <span class="price">{{ number_format($item['price'], 0, '.', '.') }}₫</span>
                                            {{-- <span class="price-old">35.000.000₫</span> --}}
                                        </strong>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @foreach ($home as $category)
        <div class="category-box">
            @if ($category->type->count() > 0)
                <div>
                    <a class="brand">
                        {{-- <img src="asset/img/apple.png" class="brand-icon"></i> --}}
                        <h2 class="brand-text">{{ $category->name }}</h2>
                    </a>
                </div>
            @endif
            <div class="product-box">
                <div class="product-slide owl-carousel owl-theme">
                    @if ($category->type != null)
                        @foreach ($category->type as $key1 => $type)
                            @foreach ($type->product as $key2 => $product)
                                @foreach ($product->product_type as $key3 => $product_type)
                                    @php
                                        $product_list = App\models\Product_type::where(
                                            'product_id',
                                            $product_type->product_id,
                                        )
                                            ->with([
                                                'atribute' => function ($q) use ($product_type) {
                                                    $q->select('product_type_id')->distinct();
                                                },
                                            ])
                                            ->first();

                                        $atribute = App\models\Atribute::where(
                                            'product_type_id',
                                            $product_list->atribute[0]->product_type_id,
                                        )
                                            ->with([
                                                'color.image' => function ($q) {
                                                    $q->where('is_thumbnail', 1)->first();
                                                },
                                            ])
                                            ->first();
                                    @endphp
                                    {{-- @foreach ($product_type->atribute as $key4 => $atribute)
                                        @if ($atribute->color)
                                            @foreach ($atribute->color->image as $item) --}}
                                    <div class="item">
                                        <div class="product">
                                            <a
                                                href="{{ route('product.detail', ['product_type' => $product_list->slug, 'atribute' => $atribute->color->id]) }}">
                                                <div class="product-img">
                                                    {{-- @php
                                                        dd($atribute->color);
                                                    @endphp --}}
                                                    <img src="{{ route('image', ['image' => $atribute->color->image[0]->image]) }}"
                                                        alt="">
                                                </div>
                                                <div class="product-info">

                                                    <div class="product-name">{{ $product_list->name }}</div>
                                                    <strong class="product-price">
                                                        <span
                                                            class="price">{{ number_format($atribute->price, 0, '.', '.') }}₫</span>
                                                        {{-- <span class="price-old">35.000.000₫</span> --}}
                                                    </strong>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    {{-- @endforeach
                                        @endif
                                    @endforeach --}}
                                @endforeach
                            @endforeach
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    <div class="policy">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="policy-icon">
                        <i class="fa-regular fa-circle-check"></i>
                    </div>
                    <span class="policy-title">Mẫu mã đa dạng</span>
                </div>
                <div class="col-3">
                    <div class="policy-icon">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <span class="policy-title">Giao hàng toàn quốc</span>
                </div>
                <div class="col-3">
                    <div class="policy-icon">
                        <i class="fa-solid fa-shield"></i>
                    </div>
                    <span class="policy-title">Bảo hành cam kết tới 12 tháng</span>
                </div>
                <div class="col-3">
                    <div class="policy-icon">
                        <i class="fa-solid fa-rotate-right"></i>
                    </div>
                    <span class="policy-title">Có thể đổi trả tại các chi nhanh toàn quốc</span>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('jscustom')
    <script>
        // $('.owl-nav').removeClass('disabled');
    </script>
@endpush
