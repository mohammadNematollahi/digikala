@extends('customer.layouts.app-one-col')


@section('content')
    <!-- start main one col -->
    <main id="main-body-one-col" class="main-body">

        <!-- start cart -->
        <section class="mb-4">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>تکمیل اطلاعات ارسال کالا (آدرس گیرنده، مشخصات گیرنده، نحوه ارسال) </span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>

                        <section class="mt-1">
                            @foreach ($errors->all() as $item)
                                <p class="text-danger">{{ $item }}</p>
                            @endforeach
                        </section>

                        <section class="row mt-4">
                            <section class="col-9">
                                <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                    <!-- start vontent header -->
                                    <section class="content-header mb-3">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h2 class="content-header-title content-header-title-small">
                                                انتخاب آدرس و مشخصات گیرنده
                                            </h2>
                                            <section class="content-header-link">
                                                <!--<a href="#">مشاهده همه</a>-->
                                            </section>
                                        </section>
                                    </section>

                                    <section class="address-alert alert alert-primary d-flex align-items-center p-2"
                                        role="alert">
                                        <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                        <secrion>
                                            پس از ایجاد آدرس، آدرس را انتخاب کنید.
                                        </secrion>
                                    </section>


                                    <section class="address-select position-relative">

                                        @foreach ($addresses as $item)
                                            <input type="radio" name="address" form="add-to-order"
                                                value="{{ $item->id }}" id="{{ $item->id }}" />
                                            <!--checked="checked"-->
                                            <label for="{{ $item->id }}" class="address-wrapper mb-2 p-2">
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
                                                <span class="address-selected">کالاها به این آدرس ارسال می شوند</span>
                                            </label>
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
                                                                action="{{ route('customer.address-delivery.add.address') }}"
                                                                method="POST">
                                                                @csrf
                                                                <section class="col-6 mb-2">
                                                                    <label for="province"
                                                                        class="form-label mb-1">استان</label>
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
                                                                    <label for="city"
                                                                        class="form-label mb-1">شهر</label>
                                                                    <select class="form-select form-select-sm city"
                                                                        id="city" name="city_id">
                                                                        <option selected>یک شهر را انتخاب کنید</option>
                                                                    </select>
                                                                </section>

                                                                <section class="col-12 mb-2">
                                                                    <label for="address"
                                                                        class="form-label mb-1">نشانی</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-sm" id="address"
                                                                        placeholder="نشانی" name="address">
                                                                </section>

                                                                <section class="col-6 mb-2">
                                                                    <label for="postal_code" class="form-label mb-1">کد
                                                                        پستی</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-sm"
                                                                        id="postal_code" placeholder="کد پستی"
                                                                        name="postal_code">
                                                                </section>

                                                                <section class="col-3 mb-2">
                                                                    <label for="no"
                                                                        class="form-label mb-1">پلاک</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-sm"
                                                                        id="no" placeholder="پلاک" name="no">
                                                                </section>

                                                                <section class="col-3 mb-2">
                                                                    <label for="unit"
                                                                        class="form-label mb-1">واحد</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-sm"
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
                                                                        <label for="first_name"
                                                                            class="form-label mb-1">نام
                                                                            گیرنده</label>
                                                                        <input type="text"
                                                                            class="form-control form-control-sm"
                                                                            id="first_name" placeholder="نام گیرنده"
                                                                            name="recipient_first_name">
                                                                    </section>

                                                                    <section class="col-6 mb-2">
                                                                        <label for="last_name" class="form-label mb-1">نام
                                                                            خانوادگی گیرنده</label>
                                                                        <input type="text"
                                                                            class="form-control form-control-sm"
                                                                            id="last_name"
                                                                            placeholder="نام خانوادگی گیرنده"
                                                                            name="recipient_last_name">
                                                                    </section>

                                                                    <section class="col-6 mb-2">
                                                                        <label for="mobile"
                                                                            class="form-label mb-1">شماره
                                                                            موبایل</label>
                                                                        <input type="text"
                                                                            class="form-control form-control-sm"
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
                                                        <select class="form-select form-select-sm city_update"
                                                            id="city_update" name="city_id">
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
                                                            id="postal_code_update" placeholder="کد پستی"
                                                            name="postal_code">
                                                    </section>

                                                    <section class="col-3 mb-2">
                                                        <label for="no_update" class="form-label mb-1">پلاک</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="no_update" placeholder="پلاک" name="no">
                                                    </section>

                                                    <section class="col-3 mb-2">
                                                        <label for="unit_update" class="form-label mb-1">واحد</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="unit_update" placeholder="واحد" name="unit">
                                                    </section>

                                                    <section class="border-bottom mt-2 mb-3"></section>

                                                    <section class="col-12 mb-2">
                                                        <section class="form-check">
                                                            <input class="form-check-input receiver_update"
                                                                name="receiver" type="checkbox" id="receiver_update">
                                                            <label class="form-check-label" for="receiver_update">
                                                                گیرنده سفارش خودم نیستم
                                                            </label>
                                                        </section>
                                                    </section>

                                                    <section id="box_receiver_update"
                                                        class="d-flex flex-wrap justify-content-between d-none box_receiver_update">

                                                        <section class="col-5 mb-2">
                                                            <label for="recipient_first_name_update"
                                                                class="form-label mb-1">نام
                                                                گیرنده</label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                id="recipient_first_name_update" placeholder="نام گیرنده"
                                                                name="recipient_first_name">
                                                        </section>

                                                        <section class="col-6 mb-2">
                                                            <label for="recipient_last_name_update"
                                                                class="form-label mb-1">نام
                                                                خانوادگی گیرنده</label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                id="recipient_last_name_update"
                                                                placeholder="نام خانوادگی گیرنده"
                                                                name="recipient_last_name">
                                                        </section>

                                                        <section class="col-6 mb-2">
                                                            <label for="mobile_update" class="form-label mb-1">شماره
                                                                موبایل</label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                id="mobile_update" placeholder="شماره موبایل"
                                                                name="mobile">
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


                                <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                    <!-- start vontent header -->
                                    <section class="content-header mb-3">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h2 class="content-header-title content-header-title-small">
                                                انتخاب نحوه ارسال
                                            </h2>
                                            <section class="content-header-link">
                                                <!--<a href="#">مشاهده همه</a>-->
                                            </section>
                                        </section>
                                    </section>
                                    <section class="delivery-select ">

                                        <section class="address-alert alert alert-primary d-flex align-items-center p-2"
                                            role="alert">
                                            <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                            <secrion>
                                                نحوه ارسال کالا را انتخاب کنید. هنگام انتخاب لطفا مدت زمان ارسال را در نظر
                                                بگیرید.
                                            </secrion>
                                        </section>

                                        @foreach ($delivery as $item)
                                            <input type="radio" class="delivery" form="add-to-order"
                                                name="delivery_type" value="{{ $item->id }}"
                                                id="delivery_{{ $item->id }}" data-amount="{{ $item->amount }}" />
                                            <label for="delivery_{{ $item->id }}"
                                                class="col-4 delivery-wrapper mb-2 pt-2">
                                                <section class="mb-2">
                                                    <i class="fa fa-shipping-fast mx-1"></i>
                                                    {{ $item->name }}
                                                </section>
                                                <section class="mb-2">
                                                    <i class="fa fa-calendar-alt mx-1"></i>
                                                    تامین کالا از {{ persianNumber($item->delivery_time) }}
                                                    {{ $item->delivery_time_unit }} کاری آینده
                                                </section>
                                            </label>
                                        @endforeach

                                    </section>
                                </section>




                            </section>
                            <section class="col-3">

                                @php
                                    $totalProductPrice = 0;
                                    $totalProductDiscount = 0;
                                @endphp

                                @foreach ($carts as $item)
                                    @php
                                        $totalProductPrice += $item->itemFinalProductPrice();
                                        $totalProductDiscount += $item->itemFinalProductDiscount();
                                    @endphp
                                @endforeach

                                <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">قیمت کالاها ({{ persianNumber($carts->count()) }})</p>
                                        <p class="text-muted">{{ priceFormat($totalProductPrice) }} تومان</p>
                                    </section>

                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">تخفیف کالاها</p>
                                        <p class="text-danger fw-bolder">{{ priceFormat($totalProductDiscount) }} تومان
                                        </p>
                                    </section>

                                    <section class="border-bottom mb-3"></section>

                                    <section class="d-flex justify-content-between align-items-center">

                                        @php
                                            $finalPrice = $totalProductPrice - $totalProductDiscount;
                                        @endphp
                                        <p class="text-muted">جمع سبد خرید</p>
                                        <p class="fw-bolder">{{ priceFormat($finalPrice) }} تومان</p>
                                    </section>

                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">هزینه ارسال</p>
                                        <p class="text-warning" id="price_delivery"></p>
                                    </section>

                                    <p class="my-3">
                                        <i class="fa fa-info-circle me-1"></i> کاربر گرامی کالاها بر اساس نوع ارسالی که
                                        انتخاب می کنید در مدت زمان ذکر شده ارسال می شود.
                                    </p>

                                    <section class="border-bottom mb-3"></section>

                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">مبلغ قابل پرداخت</p>
                                        <p class="fw-bold" id="final_price">{{ priceFormat($finalPrice) }} تومان</p>
                                    </section>

                                    <section class="">
                                        <section id="address-button"
                                            class="text-warning border border-warning text-center py-2 pointer rounded-2 d-block">
                                            آدرس و نحوه ارسال را انتخاب کن</section>
                                        <button id="next-level" type="button" class="btn btn-danger d-none col-12"
                                            onclick="document.getElementById('add-to-order').submit()">ادامه فرآیند
                                            خرید</button>
                                    </section>

                                </section>
                            </section>
                        </section>
                    </section>
                </section>

            </section>
        </section>
        <!-- end cart -->

        <form action="{{ route('customer.address-delivery.addToOrder') }}" id="add-to-order"
            method="POST">
            @csrf
        </form>

    </main>
    <!-- end main one col -->
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
        $(".delivery").click(function(e) {

            const finalPrice = {{ $finalPrice }};
            const amount = parseInt($(this).attr("data-amount"));

            $("#price_delivery").html(convertToPersianAndPriceFormat(amount) + " تومان ");


            let finalPriceWithDelivery = finalPrice + amount;
            $("#final_price").html(convertToPersianAndPriceFormat(finalPriceWithDelivery) + " تومان ");

        });

        function convertToPersianAndPriceFormat(number) {
            const persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",").split('').map(function(e) {
                return persianNumbers[+e] || e;
            }).join('');
        }
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
