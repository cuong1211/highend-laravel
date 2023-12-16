<div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-1000px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Title-->
                <h2>Create product</h2>
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
                        <div class="stepper-item color" onclick="openContent('color')" style="cursor: pointer">
                            <h3 class="stepper-title">Màu sắc</h3>
                        </div>
                    </div>
                    <!--end::Nav-->
                    <!--begin::Form-->
                    <form class="mx-auto mw-600px w-100" novalidate="novalidate" id="kt_create_account_form">
                        <div class="content current" id="info">
                            <div class="w-100">
                                <input type="hidden" name="id" value="">
                                <input type="hidden" name="product_id" value="">
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
                                <div class="fv-row mb-8">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold mb-2">Dung Lượng</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder=""
                                        name="capacity" />
                                    <!--end::Input-->
                                </div>
                            </div>
                        </div>

                        <div class="content" id="color" style="display:none">
                            <div class="table-responsive" id="color-input">
                                {{-- <div id="kt_create_new_custom_fields_wrapper"
                                    class="dataTables_wrapper dt-bootstrap4 no-footer mb-7"
                                    style="border-bottom: 1px dotted #fefeff">
                                    <div class="row">
                                        <div
                                            class="col-sm-12 col-md-12 col-lg-4 align-items-center justify-content-center justify-content-md-start">
                                            <label class="required fs-6 fw-bold mb-2">Name:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="" name="name" id="name" />

                                        </div>
                                        <div
                                            class="col-sm-12 col-md-12 col-lg-4  align-items-center justify-content-center justify-content-md-between">
                                            <label class="required fs-6 fw-bold mb-2">Hex code: </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="" name="name" id="name" />
                                        </div>
                                        <div
                                            class="col-sm-12 col-md-12 col-lg-4  align-items-center justify-content-center justify-content-md-end">
                                            <label class="required fs-6 fw-bold mb-2">Price: </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="" name="name" id="name" />
                                        </div>


                                    </div>
                                    <div
                                        class="col-sm-12 col-md-12 col-lg-12  align-items-center justify-content-center justify-content-md-start">
                                        <label class="required fs-6 fw-bold mb-2">Image: </label>
                                        <input type="file" class="form-control form-control-solid"
                                            name="color_image[]" id="imageUpload" multiple accept="image/*"
                                            onchange="previewImages(event)">
                                        <div id="imagePreview"></div>
                                    </div>

                                </div> --}}
                            </div>
                            <div class="row">
                                <div
                                    class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                </div>
                                <div
                                    class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                </div>
                            </div>
                            <button type="button" class="btn btn-light-primary me-auto" id="add_color">Add
                                Color</button>
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
                    modelType: 'product_type'
                },
                success: function(response) {
                    console.log(response);
                    $('input[name="slug"]').val(response.slug);
                }
            });
        }
        $(document).ready(function() {
            var colorIndex = 0;

            $("#add_color").click(function() {
                if (form_status == 'edit') {
                    colorIndex = edit_index;
                } else {
                    colorIndex = add_index;
                }
                $('#color-input').append(
                    '<div class="d-flex block-content">' +
                    '<div id="kt_create_new_custom_fields_wrapper" class="w-100 mb-7" style="border-bottom: 1px dotted #fefeff">' +
                    '<div class="row">' +
                    '<div class="col-sm-12 col-md-12 col-lg-6 align-items-center justify-content-center justify-content-md-start">' +
                    '<label class="required fs-6 fw-bold mb-2">Màu:</label>' +
                    '<select class="form-control form-control-solid color" name="color_id[]" >' +
                    '<option value="0" class="choose-select">--Chọn màu--</option>' +
                    '@foreach ($color_list as $color)' +
                    '<option value="{{ $color->id }}">{{ $color->label }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</div>' +
                    '<div class="col-sm-12 col-md-12 col-lg-6  align-items-center justify-content-center justify-content-md-end">' +
                    '<label class="required fs-6 fw-bold mb-2">Price: </label>' +
                    '<input type="text" class="form-control form-control-solid" placeholder="" name="color_price[]"/>' +
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
                    '</button>'
                );
                if (form_status == 'edit') {
                    edit_index++;
                } else {
                    add_index++;
                }
                // $('#kt_create_account_form').find("option[value='0']").hide();
                check();
            });
            $(document.body).on('click', '.div-delete', function(e) {
                e.preventDefault();
                $(this).parents('div.block-content').remove();
                var id = $(this).parents('div').find('.color').find(":selected").val();
                selectedOptions = jQuery.grep(selectedOptions, function(value) {
                    return value != id;
                });
                check();
            });
            $('input[name="name"]').on('keyup', function() {
                var name = $(this).val();
                convertToSlug(name);

            });
            $(document).on('change', '.color', function() {
                var div = $(this).closest('div'); // Lấy dòng chứa phần tử sản phẩm được thay đổi
                var id = $(this).find(":selected").val();
                // set data-old-id for select
                var oldId = div.find('.color').attr('data-old-id');
                // remove old id in array selectedOptions
                var oldIdIndex = selectedOptions.indexOf(oldId);
                if (oldIdIndex !== -1) {
                    selectedOptions.splice(oldIdIndex, 1);
                }
                $(this).attr('data-old-id', id);
                selectedOptions.push(id);
                console.log(selectedOptions);
                check();
            });

            function check() {
                var allSelects = $('.color'); // Lấy tất cả các phần tử sản phẩm
                // Loop qua tất cả các select box
                allSelects.each(function() {
                    // hide option have value in array selectedOptions
                    $(this).find('option').each(function() {
                        if (jQuery.inArray($(this).val(), selectedOptions) !== -1) {
                            $(this).hide();
                        } else {
                            $(this).show();
                        }
                    });
                })
            }
        });
    </script>
@endpush
