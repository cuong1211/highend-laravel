<div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-1000px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Title-->
                <h2 class="modal-title">Create product</h2>
                <!--end::Title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y m-5">
                <!--begin::Stepper-->
                <div class="stepper stepper-links d-flex flex-column" id="kt_create_account_stepper">
                    <!--begin::Nav-->
                    <div class="stepper-nav py-5">
                        <div class="stepper-item info current" onclick="openContent('info')" style="cursor: pointer">
                            <h3 class="stepper-title">Thông tin</h3>
                        </div>
                        <div class="stepper-item description" onclick="openContent('description')"
                            style="cursor: pointer">
                            <h3 class="stepper-title">Thông tin mô tả</h3>
                        </div>
                        <!--end::Step 4-->
                        <div class="stepper-item specification" onclick="openContent('specification')"
                            style="cursor: pointer">
                            <h3 class="stepper-title">Thông số kĩ thuật</h3>
                        </div>
                        <div class="stepper-item preview" onclick="openContent('preview')" style="cursor: pointer">
                            <h3 class="stepper-title">Đánh giá sản phẩm</h3>
                        </div>
                    </div>
                    <!--end::Nav-->
                    <!--begin::Form-->
                    <form class="mx-auto mw-600px w-100" novalidate="novalidate" id="kt_create_account_form"
                        enctype="multipart/form-data">
                        <div class="content current" id="info">
                            <div class="w-100">
                                <input type="hidden" name="id" value="">
                                <!--begin::Input group-->
                                <div class="fv-row mb-8">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">Tên sản phẩm</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder=""
                                        name="name" id="name" />
                                    <!--end::Input-->
                                </div>
                                <div class="fv-row mb-8">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold mb-2">Slug</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder=""
                                        name="slug" readonly />
                                    <!--end::Input-->
                                </div>
                                <input type="hidden" name="type_id">
                            </div>
                        </div>
                        <div class="content " id="description" style="display:none">
                            <textarea class="summernote" name="description"></textarea>
                        </div>
                        <div class="content" id="specification" style="display:none">
                            <div id="specification-input">
                                {{-- <div class="w-100">
                                    <input type="hidden" name="id" value="">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-8">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Name:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                            name="specification_name" />
                                        <!--end::Input-->
                                    </div>
                                    <div class="table-responsive">
                                        <table id="kt_create_new_custom_fields"
                                            class="table align-middle table-row-dashed fw-bold fs-6 gy-5 dataTable no-footer">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="pt-0 sorting_disabled required" rowspan="1"
                                                        colspan="1" style="width: 280.734px;">Label
                                                    </th>
                                                    <th class="pt-0 sorting_disabled required" rowspan="1"
                                                        colspan="1" style="width: 280.734px;">Value</th>
                                                </tr>
                                            </thead>
                                            <tbody id="specification-detail_input">
                                                <tr class="odd other">
                                                    <td>
                                                        <input type="text"
                                                            class="form-control form-control-lg form-control-solid"
                                                            name="specification_label[]" value="">
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                            class="form-control form-control-lg form-control-solid"
                                                            name="specification_value[]" value="">
                                                    </td>
                                                    <td class="text-end">
                                                        <button type="button"
                                                            class="btn btn-icon btn-flex btn-primary w-30px h-30px me-3 row-add">
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24"
                                                                    fill="none">
                                                                    <rect opacity="0.5" x="11.364" y="20.364"
                                                                        width="16" height="2" rx="1"
                                                                        transform="rotate(-90 11.364 20.364)"
                                                                        fill="black"></rect>
                                                                    <rect x="4.36396" y="11.364" width="16"
                                                                        height="2" rx="1" fill="black">
                                                                    </rect>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> --}}
                            </div>
                            <button type="button" class="btn btn-light-primary me-auto" id="add_specification">Add
                                Specification</button>
                        </div>
                        <div class="content" id="preview" style="display:none">
                            <textarea class="summernote" name="preview"></textarea>
                        </div>
                        <!--begin::Actions-->
                        <div class="d-flex flex-stack pt-15">
                            <!--begin::Wrapper-->
                            <div>
                                <button type="submit" class="btn btn-lg btn-primary me-3">
                                    <span class="indicator-label">Submit
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        <span class="svg-icon svg-icon-3 ms-2 me-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="18" y="13" width="13" height="2"
                                                    rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                <path
                                                    d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon--></span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Stepper-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
</div>
@push('jscustom')
    <script>
        function openContent(content) {
            var i;
            var blockContent = document.getElementsByClassName("content");
            var clickedElements = document.getElementsByClassName(content);
            var navbarItem = document.getElementsByClassName("stepper-item");
            for (i = 0; i < blockContent.length; i++) {
                blockContent[i].style.display = "none";
            }
            for (i = 0; i < navbarItem.length; i++) {
                navbarItem[i].classList.remove("current");
            }
            for (i = 0; i < clickedElements.length; i++) {
                clickedElements[i].classList.add("current");
            }
            document.getElementById(content).style.display = "block";
        }

        function convertToSlug(name) {
            $.ajax({
                type: 'get',
                url: '{{ route('slug') }}',
                dataType: 'json',
                data: {
                    name,
                    modelType: 'product'
                },
                success: function(response) {
                    console.log(response);
                    $('input[name="slug"]').val(response.slug);
                }
            });
        }
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 400,
                width: 600,
            });
            console.log(i);
            button_remove =
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
                '</button>';
            button_add =
                '<button type="button" class="btn btn-icon btn-flex btn-primary w-30px h-30px me-3 row-add">' +
                '<span class="svg-icon svg-icon-2">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
                '<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black">' +
                '</rect>' +
                '<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black">' +
                '</rect>' +
                '</svg>' +
                '</span>' +
                '</button>';
            var i = 0
            $("#add_specification").click(function() {
                var specificationClass = 'specification-section-' + Date.now();
                if (form_status == 'edit') {
                    i = index_edit;
                } else {
                    i = index_add;
                }
                var block_index = i + 1;
                $('#specification-input').append(
                    '<div class="d-flex block-content">' +
                    '<div class="w-100 ' + specificationClass + '">' +
                    '<div class="fv-row mb-8">' +
                    '<label class="required fs-6 fw-bold mb-2">' + block_index + ')Name:</label>' +
                    '<input type="text" class="form-control form-control-solid" placeholder="" name="specification_name[]" />' +
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
                    '<tr class="odd">' +
                    '<td>' +
                    '<input type="text" class="form-control form-control-lg form-control-solid required-input" name="specification_label[][]" value="" >' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" class="form-control form-control-lg form-control-solid required-input" name="specification_value[][]" value="">' +
                    '</td>' +
                    '<td class="text-end">' +
                    button_add +
                    button_remove +
                    '</td>' +
                    '</tr>' +
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
                    '</div>'
                );
                if (form_status == 'edit') {
                    index_edit++;
                } else {
                    index_add++
                }
                updateButtonVisibility(specificationClass);
                console.log(i);
            });
            $(document.body).on('click', '.row-delete', function(e) {
                e.preventDefault();
                // var element = document.getElementById("capacity_input");
                // var numberOfChildren = element.getElementsByTagName('tr').length;
                // var modal_title = $('#kt_modal_add_customer_form').find('.modal-title').text();
                // if (modal_title == 'Create Product') {
                //     if (numberOfChildren > 2) {
                //         $('.row-delete').show();
                //     } else {
                //         $('.row-delete').hide();
                //     }
                //     $(this).parents('tr').remove();
                // } else {

                // }
                $(this).parents('tr').remove();
            });
            $(document.body).on('click', '.div-delete', function(e) {
                e.preventDefault();
                $(this).parents('div.block-content').remove();
                // if (form_status == 'edit') {
                //     index_edit--;
                // } else {
                //     index_add--;
                // }
                // console.log(index_add, index_edit);
            });
            $(document.body).on('click', '.row-add', function(e) {
                var specificationClass = $(this).parents('tbody').attr('id');
                var block_id = $(this).parents('tbody').find('.block-id').val();
                $('#' + specificationClass).append(
                    '<tr class = "odd">' +
                    '<td>' +
                    '<input type="text" class="form-control form-control-lg form-control-solid" name="specification_label[' +
                    block_id + '][]" value="">' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" class="form-control form-control-lg form-control-solid" name="specification_value[' +
                    block_id + '][]"" value="">' +
                    '</td>' +
                    '<td class="text-end" >' +
                    button_add +
                    button_remove +
                    '</td> ' +
                    '</tr>')
                updateButtonVisibility(specificationClass);
            });

            (function(window) {
                function updateButtonVisibility(specificationClass) {
                    var rows = $('#' + specificationClass + ' tr');
                    rows.each(function(index) {
                        var addButton = $(this).find('.row-add');
                        var removeButton = $(this).find('.row-delete');
                        if (index === rows.length - 1) {
                            removeButton.hide();
                            addButton.show();
                        } else {
                            removeButton.show();
                            addButton.hide();
                        }
                    });
                }

                // Assign the function to the window object
                window.updateButtonVisibility = updateButtonVisibility;
            })(window);
            // Update button visibility on page load
            $('input[name="name"]').on('keyup', function() {
                var name = $(this).val();
                // console.log(name);
                convertToSlug(name);

            });

        });
    </script>
@endpush
