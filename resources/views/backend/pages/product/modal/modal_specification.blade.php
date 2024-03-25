<div class="modal fade" id="" tabindex="-1" aria-hidden="true">
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