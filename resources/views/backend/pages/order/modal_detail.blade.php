@push('csscustom')
    <style>
        @media print {
            body *{
                visibility: hidden;
            }

            #modal-detail,
            #modal-detail * {
                visibility: visible;
            }

            #modal-detail {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
@endpush

<div class="modal fade modal-detail" id="modal-detail">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <!--begin::Modal content-->
        <div class="modal-content">

            <!--begin::Post-->
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <!--begin::Container-->
                <div class="container-xxl">
                    <div class="modal-header pb-0 border-1">

                        <h2 class="fw-bolder modal-title">Thông tin đơn hàng</h2>
                        <div id="nonPrintable">
                            <button type="button" class="btn btn-success my-1 me-12" onclick="functionPrint()"
                                data-dismiss="modal">In hoá đơn</button>
                        </div>
                        <div class="btn btn-sm btn-icon btn-active-color-primary btn-close-modal-detail">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                        rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="black"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>

                        <!--begin::Close-->
                        <!--end::Close-->
                    </div>
                    <!--begin::Invoice 2 main-->

                    <div class="card modal-content" >
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Layout-->
                            <div class="d-flex flex-column flex-xl-row">
                                <!--begin::Content-->
                                <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
                                    <!--begin::Invoice 2 content-->
                                    <div class="mt-n1">
                                        <div class="d-flex flex-stack pb-10">
                                            <!--begin::Logo-->
                                            <a href="#">
                                                <img alt="Logo"
                                                    src="{{ asset('backend/assets/media/logos/logo-1.png') }}"
                                                    style="padding: 5px;
                                                width: 150px;" />
                                            </a>
                                            <!--end::Logo-->
                                            <!--begin::Action-->

                                            <!--end::Action-->
                                        </div>
                                        <div class="m-0">
                                            <!--begin::Label-->
                                            <!--end::Label-->
                                            <!--begin::Row-->
                                            <div class="row g-5 mb-12">
                                                <!--end::Col-->
                                                <div class="col-sm-12">
                                                    <!--end::Label-->
                                                    <div class="fw-bolder fs-5 text-gray-800 mb-1">Người gửi:
                                                        <div class="fw-bold fs-5 text-gray-600 pt-1">Checkcar.vn
                                                        </div>
                                                    </div>
                                                    <div class="fw-bolder fs-5 text-gray-800 mb-1">Người nhận:
                                                    </div>
                                                    <div class="fw-bold fs-5 text-gray-600 pt-1 mb-1" id="name">
                                                    </div>
                                                    <div class="fw-bolder fs-5 text-gray-800 mb-1">Ngày vận chuyển:
                                                    </div>
                                                    <div class="fw-bold fs-5 text-gray-600 pt-1 mb-1" id="date">
                                                    </div>
                                                    <!--end::Text-->
                                                    <br>
                                                    <div class="fw-bolder fs-5 text-gray-800 mb-1 mb-1">Ghi chú:
                                                    </div>
                                                    <!--end::Description-->
                                                    <div class="fw-bold fs-5 text-gray-600 pt-2" id="description">
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                            <!--begin::Content-->
                                            <div class="flex-grow-1">
                                                <!--begin::Table-->
                                                <div class="table-responsive border-bottom mb-9">
                                                    <table class="table mb-3">
                                                        <thead>
                                                            <tr class="border-bottom fs-5 fw-bolder text-muted">
                                                                <th class="min-w-175px pb-2">Sản phẩm</th>
                                                                <th class="min-w-70px text-left pb-2">Số lượng</th>
                                                                <th class="min-w-100px text-end pb-2">Tổng tiền</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tab-detail">

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--end::Table-->
                                                <!--begin::Container-->
                                                <div class="d-flex justify-content-end">
                                                    <!--begin::Section-->
                                                    <div class="mw-300px">
                                                        <!--begin::Item-->
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <div class="d-flex flex-stack">
                                                            <!--begin::Code-->
                                                            <div class="fw-bold pe-10 text-gray-700 fs-7">Thành tổng
                                                            </div>
                                                            <!--end::Code-->
                                                            <!--begin::Label-->
                                                            <div class="text-end fw-bolder fs-6 text-gray-800"
                                                                id="price"></div>
                                                            <!--end::Label-->
                                                        </div>
                                                        <!--end::Item-->
                                                    </div>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Container-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Invoice 2 content-->
                                </div>
                                <!--end::Content-->
                                <!--begin::Sidebar-->
                                <!--end::Sidebar-->
                            </div>
                            <!--end::Layout-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Invoice 2 main-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->

        </div>
    </div>
</div>