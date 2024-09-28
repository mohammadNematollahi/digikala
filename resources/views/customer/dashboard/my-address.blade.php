@extends('customer.layouts.app-one-col')

@section('content')
    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">

                @include('customer.layouts.parties.profile-sidebar')

                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <!-- start vontent header -->
                        <section class="content-header mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>آدرس های من</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->



                        <section class="my-addresses">

                            <section class="address-select position-relative">

                                @foreach ($user_addresses as $item)
                                    <div for="{{ $item->id }}" class="address-wrapper mb-2 p-2">
                                        <section class="mb-2">
                                            <i class="fa fa-map-marker-alt mx-1"></i>
                                            {{ $item->address }}
                                        </section>
                                        <section class="mb-2">
                                            <i class="fa fa-user-tag mx-1"></i>
                                            گیرنده : {{ $item->recipientFullName() }}
                                        </section>
                                        <section class="mb-2">
                                            <i class="fa fa-mobile-alt mx-1"></i>
                                            موبایل گیرنده :
                                            {{ persianNumber($item->mobile) == null ? persianNumber(auth()->user()->mobile) : persianNumber($item->mobile) }}
                                        </section>
                                        <button class="btn btn-sm btn-outline-success update position-absolute"
                                            style="top: 10px; left: 10px" type="button" data-bs-toggle="modal"
                                            data-url="{{ route('customer.address-delivery.edit.address', $item->id) }}"><i
                                                class="fa fa-edit"></i> ویرایش آدرس</button>
                                    </div>
                                @endforeach

                                <section class="address-add-wrapper">
                                    <button class="address-add-button" type="button" data-bs-toggle="modal"
                                        data-bs-target="#add-address"><i class="fa fa-plus"></i> ایجاد آدرس
                                        جدید</button>
                                    <!-- start add address Modal -->
                                    <section class="modal fade" id="add-address" tabindex="-1"
                                        aria-labelledby="add-address-label" aria-hidden="true">
                                        <section class="modal-dialog">
                                            <section class="modal-content">
                                                <section class="modal-header">
                                                    <h5 class="modal-title" id="add-address-label"><i
                                                            class="fa fa-plus"></i> ایجاد آدرس جدید</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </section>
                                                <section class="modal-body">
                                                    <form class="row" id="form_address"
                                                        action="{{ route('customer.address-delivery.add.address') }}" method="POST">
                                                        @csrf
                                                        <section class="col-6 mb-2">
                                                            <label for="province" class="form-label mb-1">استان</label>
                                                            <select class="form-select form-select-sm province"
                                                                id="province" name="province_id">
                                                                <option selected>استان را انتخاب کنید</option>
                                                                @foreach ($provinces as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        class="provice_{{ $item->id }}"
                                                                        data-url="{{ route('customer.address-delivery.set-city', $item->id) }}">
                                                                        {{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </section>

                                                        <section class="col-6 mb-2">
                                                            <label for="city" class="form-label mb-1">شهر</label>
                                                            <select class="form-select form-select-sm city" id="city"
                                                                name="city_id">
                                                                <option selected>یک شهر را انتخاب کنید</option>
                                                            </select>
                                                        </section>

                                                        <section class="col-12 mb-2">
                                                            <label for="address" class="form-label mb-1">نشانی</label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                id="address" placeholder="نشانی" name="address">
                                                        </section>

                                                        <section class="col-6 mb-2">
                                                            <label for="postal_code" class="form-label mb-1">کد
                                                                پستی</label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                id="postal_code" placeholder="کد پستی" name="postal_code">
                                                        </section>

                                                        <section class="col-3 mb-2">
                                                            <label for="no" class="form-label mb-1">پلاک</label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                id="no" placeholder="پلاک" name="no">
                                                        </section>

                                                        <section class="col-3 mb-2">
                                                            <label for="unit" class="form-label mb-1">واحد</label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                id="unit" placeholder="واحد" name="unit">
                                                        </section>

                                                        <section class="border-bottom mt-2 mb-3"></section>

                                                        <section class="col-12 mb-2">
                                                            <section class="form-check">
                                                                <input class="form-check-input" name="receiver"
                                                                    type="checkbox" id="receiver">
                                                                <label class="form-check-label" for="receiver">
                                                                    گیرنده سفارش خودم نیستم
                                                                </label>
                                                            </section>
                                                        </section>

                                                        <section id="box_receiver"
                                                            class="d-flex flex-wrap justify-content-between d-none">

                                                            <section class="col-5 mb-2">
                                                                <label for="first_name" class="form-label mb-1">نام
                                                                    گیرنده</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    id="first_name" placeholder="نام گیرنده"
                                                                    name="recipient_first_name">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="last_name" class="form-label mb-1">نام
                                                                    خانوادگی گیرنده</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    id="last_name" placeholder="نام خانوادگی گیرنده"
                                                                    name="recipient_last_name">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="mobile" class="form-label mb-1">شماره
                                                                    موبایل</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    id="mobile" placeholder="شماره موبایل"
                                                                    name="mobile">
                                                            </section>

                                                        </section>

                                                    </form>
                                                </section>
                                                <section class="modal-footer py-1">
                                                    <button type="button"
                                                        onclick="document.getElementById('form_address').submit()"
                                                        class="btn btn-sm btn-primary">ثبت
                                                        آدرس</button>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        data-bs-dismiss="modal">بستن</button>
                                                </section>
                                            </section>
                                        </section>
                                    </section>
                                    <!-- end add address Modal -->
                                </section>

                            </section>

                        </section>

                        <section class="modal fade" id="modal_update_address" tabindex="-1"
                            aria-labelledby="update-address-label" aria-hidden="true">
                            <section class="modal-dialog">
                                <section class="modal-content">
                                    <section class="modal-body">
                                        <form class="row" id="form_update_address" method="POST">
                                            @csrf
                                            @method('put')
                                            <section class="col-6 mb-2">
                                                <label for="province_update" class="form-label mb-1">استان</label>
                                                <select class="form-select form-select-sm province province_update"
                                                    id="province_update" name="province_id">
                                                    <option selected>استان را انتخاب کنید</option>
                                                    @foreach ($provinces as $item)
                                                        <option value="{{ $item->id }}"
                                                            class="provice_{{ $item->id }}"
                                                            data-url="{{ route('customer.address-delivery.set-city', $item->id) }}"
                                                            data-province-id="{{ $item->id }}">
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </section>

                                            <section class="col-6 mb-2">
                                                <label for="city_update" class="form-label mb-1">شهر</label>
                                                <select class="form-select form-select-sm city_update" id="city_update"
                                                    name="city_id">
                                                    <option selected>یک شهر را انتخاب کنید</option>
                                                </select>
                                            </section>

                                            <section class="col-12 mb-2">
                                                <label for="address_update" class="form-label mb-1">نشانی</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="address_update" placeholder="نشانی" name="address">
                                            </section>

                                            <section class="col-6 mb-2">
                                                <label for="postal_code_update" class="form-label mb-1">کد
                                                    پستی</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="postal_code_update" placeholder="کد پستی" name="postal_code">
                                            </section>

                                            <section class="col-3 mb-2">
                                                <label for="no_update" class="form-label mb-1">پلاک</label>
                                                <input type="text" class="form-control form-control-sm" id="no_update"
                                                    placeholder="پلاک" name="no">
                                            </section>

                                            <section class="col-3 mb-2">
                                                <label for="unit_update" class="form-label mb-1">واحد</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="unit_update" placeholder="واحد" name="unit">
                                            </section>

                                            <section class="border-bottom mt-2 mb-3"></section>

                                            <section class="col-12 mb-2">
                                                <section class="form-check">
                                                    <input class="form-check-input receiver_update" name="receiver"
                                                        type="checkbox" id="receiver_update">
                                                    <label class="form-check-label" for="receiver_update">
                                                        گیرنده سفارش خودم نیستم
                                                    </label>
                                                </section>
                                            </section>

                                            <section id="box_receiver_update"
                                                class="d-flex flex-wrap justify-content-between d-none box_receiver_update">

                                                <section class="col-5 mb-2">
                                                    <label for="recipient_first_name_update" class="form-label mb-1">نام
                                                        گیرنده</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="recipient_first_name_update" placeholder="نام گیرنده"
                                                        name="recipient_first_name">
                                                </section>

                                                <section class="col-6 mb-2">
                                                    <label for="recipient_last_name_update" class="form-label mb-1">نام
                                                        خانوادگی گیرنده</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="recipient_last_name_update" placeholder="نام خانوادگی گیرنده"
                                                        name="recipient_last_name">
                                                </section>

                                                <section class="col-6 mb-2">
                                                    <label for="mobile_update" class="form-label mb-1">شماره
                                                        موبایل</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="mobile_update" placeholder="شماره موبایل" name="mobile">
                                                </section>

                                            </section>

                                        </form>
                                    </section>
                                    <section class="modal-footer py-1">
                                        <button type="button"
                                            onclick="document.getElementById('form_update_address').submit()"
                                            class="btn btn-sm btn-primary">بروز رسانی
                                            آدرس</button>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            data-bs-dismiss="modal">بستن</button>
                                    </section>
                                </section>
                            </section>
                        </section>


                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection


@section('script')
    <script>
        $("#receiver").click(function(e) {

            const checked = $(this).is(":checked");

            if (checked) {
                $("#box_receiver").removeClass("d-none")
            } else {
                $("#box_receiver").addClass("d-none");
            }

        });
    </script>

    <script>
        $(".province").change(function(e) {

            const value = $(this).val();
            const url = $(".provice_" + value).attr("data-url");

            $.ajax({
                url: url,
                success: function(response) {

                    $(".city").empty();
                    $(".city").append("<option selected>یک شهر را انتخاب کنید</option>");

                    response.map((city) => {
                        $(".city").append(
                            `<option value="${city['id']}">${city['name']}</option>`);
                    });

                }
            });

        });
    </script>

    <script>
        $(".update").click(function(e) {

            e.preventDefault();

            const url = $(this).attr("data-url");

            $.ajax({
                url: url,
                success: function(response) {

                    $(".province_update option").each((index, element) => {

                        let province_id = $(element).attr("data-province-id");
                        const city_id = response["address"]["city_id"];

                        if (province_id == response["province"]["id"]) {
                            $(element).attr("selected", true);

                            const value = $(element).val();
                            const url = $(".provice_" + value).attr("data-url");

                            $.ajax({
                                url: url,
                                success: function(response) {

                                    $(".city_update").empty();

                                    response.map((city) => {
                                        $(".city_update").append(
                                            `<option value="${city['id']}" ${city['id'] == city_id ? "selected" : ""}> ${city['name']} </option>`
                                        );
                                    });

                                }
                            });

                        }

                    });


                    $("#address_update").val(response["address"]["address"]);
                    $("#postal_code_update").val(response["address"]["postal_code"]);
                    $("#no_update").val(response["address"]["no"]);
                    $("#unit_update").val(response["address"]["unit"]);
                    $("#recipient_first_name_update").val(response["address"]["recipient_first_name"]);
                    $("#recipient_last_name_update").val(response["address"]["recipient_last_name"]);
                    $("#mobile_update").val(response["address"]["mobile"]);

                    let first_name = response["address"]["recipient_first_name"];
                    let last_name = response["address"]["recipient_last_name"];
                    let mobile = response["address"]["mobile"];

                    if (first_name == null && last_name == null && mobile == null) {

                        $("#box_receiver_update").addClass("d-none");
                        $('.receiver_update').prop('checked', false);

                    } else {

                        $("#box_receiver_update").removeClass("d-none");
                        $('.receiver_update').prop('checked', true);

                    }

                    $("#form_update_address").attr("action", response["route"]);

                }

            });

            setTimeout(() => {
                $('#modal_update_address').modal('show');
            }, 1000);

        });


        $(".receiver_update").click(function(e) {

            const checked = $(this).is(":checked");

            if (checked) {
                $("#box_receiver_update").removeClass("d-none")
            } else {
                $("#box_receiver_update").addClass("d-none");
                $("#recipient_first_name_update").val(null);
                $("#recipient_last_name_update").val(null);
                $("#mobile_update").val(null);
            }

        });
    </script>
@endsection
