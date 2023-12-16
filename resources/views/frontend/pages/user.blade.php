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
    <div class="user-background">
        <div class="order" style="padding: 20px 0;">
            <div class="middleCart">
                <div class="userheader">
                    <strong style="color:black">Thông tin cá nhân</strong>
                </div>
                <div class="usercontent" style="margin-top: 20px;">
                    <form id="user-form">
                        <div class="info-user">
                            <div class="info-user-header">
                                <label for="">
                                    <span>
                                        <span>
                                            <strong>Họ và tên:</strong>
                                        </span>
                                    </span>
                                </label>
                                <input type="text" class="info-user-input" value="{{ $user->name }}">
                            </div>
                            <div class="info-user-header">
                                <label for="">
                                    <span>
                                        <span>
                                            <strong>SĐT:</strong>
                                        </span>
                                    </span>
                                </label>
                                <input type="text" class="info-user-input" value="{{ $user->phone }}">
                            </div>
                            <div class="info-user-header">
                                <label for="">
                                    <span>
                                        <span>
                                            <strong>Địa chỉ:</strong>
                                        </span>
                                    </span>
                                </label>
                                <div class="deli-address info-user-input">
                                    <div class="text-address">
                                        <div class="text-address__selection visible">
                                            <label>{{ $user->address }}</label>
                                        </div>
                                        <div class="text-address__other-addresses">
                                            <small class="text-addresses__item add-more add_address">Thêm địa chỉ khác</small>
                                        </div>
                                    </div>
                                    <div class="cntry-district">
                                        <select name="city" id="select-city" class="select-address"></select>
                                        <select name="district" id="select-district" class="select-address"></select>
                                        <select name="ward" id="select-ward" class="select-address"></select>
                                        <input name="address" class="select-address" type="text"
                                            placeholder="Số nhà, tên đường" required>
                                    </div>
                                </div>
                            </div>
                            <div class="info-user-header">
                                <label for="">
                                    <span>
                                        <span>
                                            <strong>Mật Khẩu</strong>
                                        </span>
                                    </span>
                                </label>
                                <button class="reserpass">Thay đổi mật khẩu</button>
                            </div>
                        </div>
                        <button type="submit" class="user-save">Lưu</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('jscustom')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
        $('.cntry-district').hide();
        $('.add_address').click(function() {
            $('.cntry-district').show();
            $('.text-address').hide();
        })
    </script>
@endpush
