<div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" id="kt_modal_add_customer_form" enctype="multipart/form-data">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_customer_header">
                    <!--begin::Modal title-->
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <h2 class="fw-bolder modal-title"></h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary btn-close">
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
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_customer_header"
                        data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="product_id" value="">
                        <!--begin::Input group-->
                        <div class="row">
                            <div
                                class="col-sm-12 col-md-12 col-lg-6 align-items-center justify-content-center justify-content-md-start">
                                <label class="required fs-6 fw-bold mb-2">Name:</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder=""
                                    name="label" />

                            </div>
                            <div
                                class="col-sm-12 col-md-12 col-lg-6  align-items-center justify-content-center justify-content-md-between">
                                <label class="required fs-6 fw-bold mb-2">Hex code: </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder=""
                                    name="value" />
                            </div>
                        </div>
                        <div
                            class="col-sm-12 col-md-12 col-lg-12  align-items-center justify-content-center justify-content-md-start">
                            <label class="required fs-6 fw-bold mb-2">Image: </label>
                            <input type="file" class="form-control form-control-solid" name="image[]"
                                id="imageUpload" multiple accept="image/*"
                                onchange="previewImages(event,'imagePreview')">
                            <div id="imagePreview"></div>
                        </div>
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3">Mặc
                        định</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
                        <span class="indicator-label">Xác nhận</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
@push('jscustom')
    <script>
        function previewImages(event, previewContainerId) {
            var previewContainer = document.getElementById(previewContainerId);
            previewContainer.innerHTML = '';
            var files = event.target.files;
            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var image = document.createElement('img');
                    image.src = e.target.result;
                    image.style.width = '80px';
                    image.style.height = '80px';
                    image.style.marginTop = '20px';
                    image.style.marginRight = '5px';
                    image.style.marginBottom = '20px';
                    image.style.borderRadius = '5px';
                    image.style.border = '1px solid #ddd';
                    previewContainer.appendChild(image);
                };
                reader.readAsDataURL(files[i]);
            }
        }
    </script>
@endpush
