<script>
    // Private functions
    let search_table = '';
    var dt = $("#kt_customers_table").DataTable({
        serverSide: true,
        select: {
            style: 'multi',
            selector: 'td:first-child',
            className: 'row-selected'
        },
        ajax: {
            url: "{{ route('product_type.show', ['product' => "${product_id}", 'product_type' => 'get-list']) }}",
            type: 'GET',
            data: function(d) {
                d.search_table = search_table;
            }
        },
        columns: [{
                data: 'null',
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {

                data: 'name',
                render: function(data, type, row, meta) {
                    return data;
                }
            },
            {
                data: null,
                className: 'text-end',
                render: function(data, type, row, meta) {
                    return '<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Thao tác \n' +
                        '<span class="svg-icon svg-icon-5 m-0"> \n' +
                        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> \n' +
                        '<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" /> \n' +
                        '</svg> \n' +
                        '</span> \n' +
                        '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true"> \n' +
                        '<div class="menu-item px-3"> \n' +
                        '<a href="" data-data=\'' + JSON.stringify(row) +
                        '\' class="menu-link px-3 btn-edit" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Sửa</a> \n' +
                        '</div> \n' +
                        '<div class="menu-item px-3"> \n' +
                        '<a href="#" data-id="' + row.id +
                        '" class="menu-link px-3 btn-delete" data-kt-customer-table-filter="delete_row">Xoá</a> \n' +
                        '</div> \n' +
                        '</div>';
                }
            }
        ]
    });
    dt.on('draw', function() {
        KTMenu.createInstances();
    });
    $('.btn-close').on('click', function() {
        form_reset();
        $('#kt_modal_add_customer').modal('hide');
        $('#kt_modal_status').modal('hide');
    });
    $(' #kt_modal_add_customer_cancel').on('click', function() {
        form_reset();
    });

    function form_reset() {
        $("#kt_modal_add_customer").modal({
            'backdrop': 'static',
            'keyboard': false
        });
        $("#kt_create_account_form").trigger("reset");
        edit_index = 0;
        add_index = 0;
        selectedOptions = [];
        $('#color-input').html('');

    }
    $(document).on('click', '.btn-add', function(e) {
        console.log('add')
        e.preventDefault();
        form_reset();
        let modal = $('#kt_create_account_form');
        modal.find('.modal-title').text('Thêm mặt hàng');
        modal.find('input[name=id]').val('');
        form_status = 'add';
        // $('#kt_create_account_form').modal('show'); 
    });
    $(document).on('click', '.btn-edit', function(e) {
        console.log('edit')
        e.preventDefault();
        form_reset();
        form_status = 'edit';
        let data = $(this).data('data');
        console.log(data);
        let modal = $('#kt_create_account_form');
        modal.find('.modal-title').text('Sửa thông tin');
        modal.find('input[name=id]').val(data.id);
        modal.find('input[name=name]').val(data.name);
        modal.find('input[name=slug]').val(data.slug);
        modal.find('input[name=capacity]').val(data.capacity);
        modal.find('input[name=product_id]').val(data.product_id);
        if (data.atribute.length > 0) {
            for (let i = 0; i < data.atribute.length; i++) {
                $('#color-input').append(
                    '<div class="d-flex block-content">' +
                    '<div id="kt_create_new_custom_fields_wrapper" class="w-100 mb-7" style="border-bottom: 1px dotted #fefeff">' +
                    '<div class="row">' +
                    '<div class="col-sm-12 col-md-12 col-lg-6 align-items-center justify-content-center justify-content-md-start">' +
                    '<label class="required fs-6 fw-bold mb-2">Name:</label>' +
                    '<select class="form-control form-control-solid color" name="color_id[]" >' +
                    '<option value="0" class="choose-select">--Chọn màu--</option>' +
                    '@foreach ($color_list as $color)' +
                    '<option value="{{ $color->id }}" ' + (data.atribute[i].color.id ==
                        {{ $color->id }} ? "selected" : '') +
                    '>{{ $color->label }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</div>' +
                    '<div class="col-sm-12 col-md-12 col-lg-6  align-items-center justify-content-center justify-content-md-end">' +
                    '<label class="required fs-6 fw-bold mb-2">Price: </label>' +
                    '<input type="text" class="form-control form-control-solid" placeholder="" name="color_price[]" value="' +
                    data.atribute[i].price + '"/>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<button type="button" class="btn btn-active-light-primary div-delete">' +
                    '<span class = "svg-icon svg-icon-3" >' +
                    '<svg xmlns = "http://www.w3.org/2000/svg"width = "24"height = "24"viewBox = "0 0 24 24"fill = "none" >' +
                    '<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" >' +
                    '</path>' +
                    '<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" >' +
                    '</path>' +
                    '<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" >' +
                    '</path>' +
                    '</svg>' +
                    '</span>' +
                    '</button>' +
                    '</div>'
                );
                
                edit_index++;
            }
        }
    });
    $('#kt_create_account_form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let type = 'POST',
            url = "{{ route('product_type.store', ['product' => "${product_id}"]) }}",
            id = $('form#kt_create_account_form input[name=id]').val();
        if (parseInt(id)) {
            console.log('edit');
            type = 'POST';
            formData.append('_method', 'PUT');
            url = url + '/' + id;
        }
        $.ajax({
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: type,
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                notification(data.type, data.title, data.content);
                if (data.type == 'success') {
                    dt.ajax.reload(null, false);
                    $('#kt_create_account_form').trigger('reset');
                    $('#kt_modal_add_customer').modal('hide');
                }
            },
            error: function(data) {
                let errors = data.responseJSON.errors;
                console.log(errors);
                $.each(errors, function(key, value) {
                    notification('error', 'Error', value);
                });
            }
        });
    });
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        Swal.fire({
            text: "Bạn có muốn xóa không ?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Có!",
            cancelButtonText: "Không",
            customClass: {
                confirmButton: "btn fw-bold btn-danger",
                cancelButton: "btn fw-bold btn-active-light-primary",
            }
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: "{{ route('product_type.destroy', ['product' => "${product_id}", '']) }}" +
                        '/' + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    success: function(data) {
                        notification(data.type, data.title, data.content);
                        if (data.type == 'success') {
                            dt.ajax.reload(null, false);
                        }
                    },
                    error: function(data) {
                        let errors = data.responseJSON.errors;
                        console.log(errors);
                        $.each(errors, function(key, value) {
                            notification('error', 'Error', value);
                        });
                    }
                });
            }
        });
    });
    $(".search_table").on('change', function() {
        let data = $(this).val();
        search_table = data;
        console.log(search_table);
        dt.ajax.reload();
    })
</script>
