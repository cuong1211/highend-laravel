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
                data: 'type.name',
                render: function(data, type, row, meta) {
                    return data;
                }
            },
            {
                data: 'null',
                render: function(data, type, row, meta) {
                    var route = "{{ url('admin') }}" + "/" + row.slug + "/color";
                    var html = '<a class="btn btn-dark" href="' + route + '">Truy cập</a>';
                    return html;
                }
            },
            {
                data: 'null',
                render: function(data, type, row, meta) {
                    var route = "{{ url('admin') }}" + "/" + row.slug + "/product_type";
                    var html = '<a class="btn btn-dark" href="' + route + '">Truy cập</a>';
                    return html;
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
        $('.block-content').remove();
        $("#kt_create_account_form").trigger("reset");
        index_edit = 0;
        index_add = 0;

    }
    $(document).on('click', '.btn-add', function(e) {
        console.log('add')
        e.preventDefault();
        form_reset();
        form_status = 'add';
        $('.modal-title').text('Thêm sản phẩm');
        let modal = $('#kt_create_account_form');
        modal.find('input[name=id]').val('');
    });
    $(document).on('click', '.btn-edit', function(e) {
        console.log('edit')
        e.preventDefault();
        form_reset();
        $('.modal-title').text('Sửa sản phẩm');
        let data = $(this).data('data');
        form_status = 'edit';
        console.log(data);
        let modal = $('#kt_create_account_form');
        modal.find('input[name=id]').val(data.id);
        modal.find('input[name=name]').val(data.name);
        modal.find('input[name=slug]').val(data.slug);
        modal.find('textarea[name=description]').val(data.description);
        modal.find('select[name=type_id]').val(data.type_id);
        modal.find('textarea[name=preview]').val(data.preview);
        var specification_detail = data.specification[0];
        if (data.specification.length > 0) {
            for (let i = 0; i < data.specification.length; i++) {
                var specificationClass = 'specification-section-' + Date.now();
                $('#specification-input').append(
                    '<div class="d-flex block-content">' +
                    '<div class="w-100 ' + specificationClass + '">' +
                    '<div class="fv-row mb-8">' +
                    '<label class="required fs-6 fw-bold mb-2">Name:</label>' +
                    '<input type="text" class="form-control form-control-solid" placeholder="" name="specification_name[' +
                    i + ']" value="' +
                    data.specification[i].name + '"/>' +
                    '</div>' +
                    '<div class="table-responsive">' +
                    '<table id="kt_create_new_custom_fields" class="table align-middle table-row-dashed fw-bold fs-6 gy-5 dataTable no-footer ' +
                    specificationClass + '">' +
                    '<thead>' +
                    '<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">' +
                    '<th class="pt-0 sorting_disabled required" rowspan="1" colspan="1" style="width: 280.734px;">Label</th>' +
                    '<th class="pt-0 sorting_disabled required" rowspan="1" colspan="1" style="width: 280.734px;">Value</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody id="' + specificationClass + '">' +
                    '<input type="hidden" class="block-id" value="' + i + '">' +
                    '</tbody>' +
                    '</table>' +
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
                    '</div>' +
                    '</div>'
                );
                // Thêm tất cả các giá trị từ specification_detail vào tbody
                for (let j = 0; j < data.specification[i].specification_detail.length; j++) {
                    $('#' + specificationClass).append(
                        '<tr class="odd">' +
                        '<td>' +
                        '<input type="text" class="form-control form-control-lg form-control-solid required-input" name="specification_label[' +
                        i + '][]" value="' + data.specification[i].specification_detail[j].label + '">' +
                        '</td>' +
                        '<td>' +
                        '<input type="text" class="form-control form-control-lg form-control-solid required-input" name="specification_value[' +
                        i + '][]" value="' + data.specification[i].specification_detail[j].value + '">' +
                        '</td>' +
                        '<td class="text-end">' +
                        '<button type="button" class="btn btn-icon btn-flex btn-primary w-30px h-30px me-3 row-add">' +
                        '<span class="svg-icon svg-icon-2">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
                        '<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black">' +
                        '</rect>' +
                        '<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black">' +
                        '</rect>' +
                        '</svg>' +
                        '</span>' +
                        '</button>' +
                        '<button type="button" class="btn btn-icon btn-flex btn-active-light-primary row-delete w-30px h-30px me-3">' +
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
                        '</td>' +
                        '</tr>'
                    );
                }
                index_edit++;

                updateButtonVisibility(specificationClass);
            }
            console.log(index_edit);
        }

    });

    $('#kt_create_account_form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let type = 'POST',
            url = "{{ route('product.store') }}",
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
