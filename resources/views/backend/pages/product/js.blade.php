<script>
    // Private functions

    var dt = $("#kt_customers_table").DataTable({
        serverSide: true,
        select: {
            style: 'multi',
            selector: 'td:first-child',
            className: 'row-selected'
        },
        ajax: {

            url: "{{ route('product.show', 'get-list') }}",
            type: 'GET'
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
                data: 'price',
                render: function(data, type, row, meta) {
                    return data;
                }
            },
            {
                data: 'slug',
                render: function(data, type, row, meta) {
                    return data;
                }
            },
            {
                data: 'description',
                render: function(data, type, row, meta) {
                    if (data == null) {
                        return '';
                    } else {
                        return AddReadMore(data);
                    }
                }
            },
            {
                data: 'image',
                render: function(data, type, row, meta) {
                    return '<img src="{{ route('image', '') }}/' + data +
                        ' " width="100" height="100" />';
                }
            },
            {
                data: 'category.name',
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
        $("#kt_modal_add_customer_form").trigger("reset");

    }
    $(document).on('click', '.btn-edit', function(e) {
        console.log('edit')
        e.preventDefault();
        form_reset();
        let data = $(this).data('data');
        let modal = $('#kt_modal_add_customer_form');
        modal.find('.modal-title').text('Sửa thông tin');
        modal.find('input[name=id]').val(data.id);
        modal.find('input[name=name]').val(data.name);
        modal.find('input[name=price]').val(data.price);
        modal.find('input[name=slug]').val(data.slug);
        modal.find('textarea[name=description]').val(data.description);
        modal.find('select[name=category_id]').val(data.category_id);
        $('#image').attr('src', '{{ route('image', '') }}/' + data.image);
        let image = data.image;
        if (data.image == null) {
            $('#image').attr("src", "");
        }
    });
    $(document).on('click', '.btn-add', function(e) {
        console.log('add')
        e.preventDefault();
        form_reset();
        let modal = $('#kt_modal_add_customer_form');
        modal.find('.modal-title').text('Thêm sản phẩm');
        modal.find('input[name=id]').val('');
    });
    $('#kt_modal_add_customer_form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        let type = 'POST',
            url = "{{ route('product.store') }}",
            id = $('form#kt_modal_add_customer_form input[name=id]').val();
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
                    $('#kt_modal_add_customer_form').trigger('reset');
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
                    url: "{{ route('product.destroy', '') }}" + '/' + id,
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

    function AddReadMore(data) {
        var carLmt = 50;
        var readMoreTxt = " ...Read more";
        var readLessTxt = " Read less";
        if (data.length > carLmt) {
            var firstSet = data.substring(0, carLmt);
            var secdHalf = data.substring(carLmt, data.length);
            return "<span class='add-read-more show-less-content text-break column-beaty'>" + firstSet +
                "<span class='second-section column-beaty'  >" +
                secdHalf + "</span><span class='read-more text-dark'  title='Click to Show More'>" +
                readMoreTxt +
                "</span><span class='read-less text-dark' title='Click to Show Less'>" + readLessTxt +
                "</span></span>";
        }
        return "<span class='add-read-more '>" + data + "</span>";
    }
    $(document).on("click", ".read-more,.read-less", function() {
        $(this).closest(".add-read-more").toggleClass("show-less-content show-more-content");
    });
</script>
