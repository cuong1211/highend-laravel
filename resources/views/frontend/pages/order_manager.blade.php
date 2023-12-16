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
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $order)
                                <tr>
                                    <th scope="row">{{ $order->id }}</th>
                                    <td>
                                        <div class="box-order">
                                            <ul>
                                                <li>
                                                    <a href="" class="img-order">
                                                        @foreach ($order->cart as $cart)
                                                            @foreach ($cart->color->image as $item)
                                                                <img src="{{ route('image', ['image' => $item->image]) }}"
                                                                    alt="">
                                                            @endforeach
                                                        @endforeach
                                                    </a>
                                                    <div class="text-order">
                                                        <a href="" class="text-order__product-name">
                                                            {{ $order->cart->map(function ($carts) {
                                                                $name = $carts->product_type->name;
                                                            })}}
                                                        </a>
                                                        <div class="amount-color">
                                                            <small>
                                                                Màu:
                                                                @foreach ($order->cart as $cart)
                                                                    @foreach ($cart->color as $item)
                                                                        <small>
                                                                            {{ $item }}
                                                                        </small>
                                                                    @endforeach
                                                                @endforeach

                                                            </small>
                                                            <small>
                                                                Số lượng:
                                                                <small>
                                                                    @foreach ($order->cart as $item)
                                                                        {{ $item->quantity }}
                                                                    @endforeach
                                                                </small>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="lastrow"></div>
                                        </div>
                                    </td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->address }}
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-secondary">Hủy</button>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
