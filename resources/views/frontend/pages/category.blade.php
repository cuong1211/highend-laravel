@extends('frontend.layout.index')
@section('content')
    <div class="content">
        <div>
            <div class="d-flex justify-content-center p-4">
                <img src="asset/img/apple.png" class="brand-icon"></i>
                <h2 class="brand-text">{{ $category->name }}</h2>
            </div>
        </div>
        <div>
            <img class="product-banner" src="asset/img/banner-3.webp" alt="">
        </div>
        <div class="filter ">
            <div class="filter-cate">
                <a href="{{ route('category', ['category' => $category->slug]) }}" class="active">Tất cả</a>
                @foreach ($type as $item)
                    <a
                        href="{{ route('category', ['category' => $category->slug, 'type' => $item->slug]) }}">{{ $item->name }}</a>
                @endforeach
            </div>
            <div class="filter-sort">
                <span>Sắp xếp theo</span>
                <select name="" id="">
                    <option value="">Mới nhất</option>
                    <option value="">Giá tăng dần</option>
                    <option value="">Giá giảm dần</option>
                </select>
            </div>
        </div>
        <div class="product-box">
            <div class="row">
                @foreach ($category->type as $key1 => $type)
                    @foreach ($type->product as $key2 => $product)
                        @foreach ($product->product_type as $key3 => $product_type)
                            @php
                                $product_list = App\models\Product_type::where('product_id', $product_type->product_id)
                                    ->with([
                                        'atribute' => function ($q) use ($product_type) {
                                            $q->select('product_type_id')->distinct();
                                        },
                                    ])
                                    ->first();
                                
                                $atribute = App\models\Atribute::where('product_type_id', $product_list->atribute[0]->product_type_id)
                                    ->with([
                                        'color.image' => function ($q) {
                                            $q->where('is_thumbnail', 1)->first();
                                        },
                                    ])
                                    ->orderBy('price', 'asc')
                                    ->first();
                                    // dd($atribute)
                            @endphp
                            <div class="col-4">
                                <div class="product">
                                    <a href="{{ route('product.detail', ['product_type' => $product_list->slug, 'atribute' => $atribute->color->id]) }}"
                                        style="text-decoration: none;">
                                        <div class="product-img">
                                            <img src="{{ route('image', ['image' => $atribute->color->image[0]->image]) }}"
                                                alt="">
                                        </div>
                                        <div class="product-info">
                                            <div class="product-name">{{ $product->name }}</div>
                                            <strong class="product-price">
                                                <span
                                                    class="price price-cate">{{ number_format($atribute->price, 0, '.', '.') }}₫</span>
                                                {{-- <span class="price-old">35.000.000₫<span class="sale">-10%</span></span> --}}
                                            </strong>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endforeach
                {{-- @endif --}}
            </div>
        </div>
    </div>
@endsection
