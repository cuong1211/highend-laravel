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
        <div class="order" style="padding: 20px 0;">
            <div class="middleCart">
                <div class="alertsuccess">
                    <i class="cartnew-success"></i>
                    <strong>Đặt hàng thành công!</strong>
                </div>
                <div class="ordercontent">
                    <div>
                        <p>Cảm ơn Khách hàng <b>{{$order_complete->name}}</b> đã mua sản phẩm của chúng tôi.</p>
                    </div>
                    <div class="info-order">
                        <div class="info-order-header">
                            <div>
                                <h4>
                                    Đơn hàng
                                    <span>
                                        {{$order}}
                                    </span>
                                </h4>
                            </div>
                            <div class="header-right">
                                <a href="">Quản lý đơn hàng</a>
                                <div class="cancel-order-new">
                                    <div>
                                        <div class="cancel-order-new"><span style="margin: 0px 8px;">•</span><a
                                                href="javascript:;">Hủy</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="">
                            <span>
                                <i class="info-order__dot-icon"></i>
                                <span>
                                    <strong>Người nhận:</strong>
                                    {{$order_complete->name}}, {{$order_complete->phone}}
                                </span>
                            </span>
                        </label>
                        <label for="">
                            <span>
                                <i class="info-order__dot-icon"></i>
                                <span>
                                    <strong>Giao đến:</strong>
                                    {{$order_complete->address}}
                                </span>
                            </span>
                        </label>
                        <label for="">
                            <span>
                                <i class="info-order__dot-icon"></i>
                                <span>
                                    <strong>Tổng tiền:</strong>
                                    {{$total}}
                                </span>
                            </span>
                        </label>
                    </div>
                    <hr>
                    <div class="timetakegoods">
                        <h4>Thông tin sản phẩm</h4>
                        <div class="delivery-product-info">
                            <div class="box-order">
                                <ul>
                                    @foreach($product as $item)
                                    <li>
                                        <a href="" class="img-order">
                                            <img src="{{route('image',['image'=>$item->image])}}" alt="">
                                        </a>
                                        <div class="text-order">
                                            <a href="" class="text-order__product-name">{{$item->product_name}}</a>
                                            <div class="amount-color">
                                                <small>
                                                    Màu:
                                                    <small>
                                                        {{$item->label}}
                                                    </small>
                                                </small>
                                                <small>
                                                    Số lượng:
                                                    <small>
                                                        {{$item->quantity}}
                                                    </small>
                                                </small>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="lastrow"></div>
                            </div>
                        </div>
                        <a href="" class="buyanotherNew">Về trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
