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

            url: "{{ route('order.show', 'get-list') }}",
            type: 'GET'
        },
        columns: [{
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {

                data: 'name',
                render: function(data, type, row, meta) {
                    return '<a  class="text-dark fw-bolder text-hover-primary fs-6 btn-detail text-break" data-bs-toggle="modal" data-bs-target="#kt_modal_detail" data-data=\'' +
                        JSON.stringify(row) +
                        '\'>' + data + '</a>';
                }
            },
            {
                data: 'phone',
                render: function(data, type, row, meta) {
                    return data;
                }
            },
            {
                data: 'cart',
                render: function(data, type, row, meta) {
                    console.log(row);
                    if (row.cart.length == 0) {
                        return '';
                    }
                    var html = '';
                    row.cart.forEach(element => {
                        html +=
                            '<table>' +
                            '<thead>' +
                            '<tr>' +
                            '<th class="min-w-125px" style="display:none"></th>' +
                            '<th class="min-w-125px" style="display:none"></th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody class="fw-bold text-gray-600">' +
                            '<tr>' +
                            '<td class="text-break min-w-125px">' +
                            '<p>' + element.product_type.name + '(' + element.color.label +
                            ')' +
                            '</p>' +
                            '<p> Số lượng: ' + element.quantity + '</p>' +
                            '</td>' +
                            '</tr>' +
                            '</tbody>' +
                            '</table>';
                    });
                    return html;
                }
            },
            {
                data: 'note',
                render: function(data, type, row, meta) {
                    if (data == null) {
                        return 'Không có ghi chú';
                    }
                    return data;
                }
            },
            {
                data: 'created_at',
                render: function(data, type, row, meta) {
                    // format date form database to d/m/Y
                    var date = new Date(data);
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    return day + '/' + month + '/' + year;

                }
            },
            {
                data: 'status',
                render: function(data, type, row, meta) {
                    if (data == 0) {
                        return '<span class="badge badge-light-danger">Đang chờ</span>';
                    }
                    if (data == 1) {
                        return '<span class="badge badge-light-warning">Đang vận chuyển</span>';
                    }
                    if (data == 2) {
                        return '<span class="badge badge-light-success">Đã nhận</span>';
                    }
                    if (data == 3) {
                        return '<span class="badge badge-light-primary">Đã hủy</span>';
                    }
                    if (data == 4) {
                        return '<span class="badge badge-light-primary">Người dùng đã hủy</span>';
                    }
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
    $('.btn-close-modal-detail').on('click', function() {
        $('.modal-detail').modal('hide');
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
        modal.find('.modal-title').text('Cập nhập trạng thái');
        modal.find('input[name=id]').val(data.id);
        modal.find('select[name=status]').val(data.status);
    });
    $(document).on('click', '.btn-add', function(e) {
        console.log('add')
        e.preventDefault();
        form_reset();
        let modal = $('#kt_modal_add_customer_form');
        modal.find('.modal-title').text('Thêm nhà cung cấp');
        modal.find('input[name=id]').val('');
        modal.trigger('reset');
        // $('#kt_modal_add_customer_form').modal('show'); 
    });
    $('#kt_modal_add_customer_form').on('submit', function(e) {
        e.preventDefault();
        let data = $(this).serialize(),
            type = 'POST',
            url = "{{ route('order.store') }}",
            id = $('form#kt_modal_add_customer_form input[name=id]').val();
        if (parseInt(id)) {
            console.log('edit');
            type = 'PUT';
            url = "{{ route('order.update.status', '') }}" + '/' + id;
        }
        $.ajax({
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: type,
            data: data,
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
                    url: "{{ route('order.destroy', '') }}" + '/' + id,
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

    function formatToVND(number) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(number);
    }
    $(document).on('click', '.btn-detail', function(e) {
        e.preventDefault();
        $(".modal-detail").modal({
            'backdrop': 'static',
            'keyboard': false
        });
        $(".detal-product").remove();
        var data = $(this).data('data');
        if (data.order_date == null) {
            $('#date').text('Không có ngày đặt hàng');
        } else {
            var date = new Date(data.order_date);
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            $('#date').text(day + '/' + month + '/' + year);
        }
        $('#name').text("Tên khách hàng: " + data.name + " - SĐT: " + data.phone +
            " - Địa chỉ: " + data.address);
        // toán tử 3 ngôi ở description
        $('#description').text(data.note == null ? 'Không có ghi chú' : data.note);
        $('#price').text(formatToVND(data.total));
        console.log(data);
        for (let i = 0; i < data.cart.length; i++) {
            $('#tab-detail').append(
                '<tr class="fw-bolder text-gray-700 fs-5 text-end detal-product">' +
                '<td class="d-flex align-items-center pt-6 text-break" id="product" style="text-align:justify;">' +
                data.cart[i].product_type.name + "(" + data.cart[i].color.label + ")" +
                '</td>' +
                '<td class="pt-6" id="color" style="text-align:left;">' + data.cart[i].quantity +
                '</td>' +
                '<td class="pt-6 text-dark fw-boldest" id="quantity">' + formatToVND(data.cart[i].total) +
                '</td>' +
                '</tr>'
            );
        }
        $('.modal-detail').modal('show');
    });

    function functionPrint() {
        // Lấy modal theo id
        var modal = document.getElementById("modal-detail");

        // Lấy nội dung của modal
        var modalContent = modal.querySelector(".modal-content");

        // Ẩn các phần không muốn in
        var nonPrintable = document.getElementById("nonPrintable");
        nonPrintable.style.display = "none";

        // In nội dung của modal
        window.print();

        // Hiện lại các phần không muốn in sau khi in xong
        nonPrintable.style.display = "block";
    }
</script>
