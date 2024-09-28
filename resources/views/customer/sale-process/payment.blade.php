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
                                    <span>انتخاب نوع پرداخت </span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>

                        @foreach ($errors->all() as $item)
                            <section class="mt-2"><span class="text-danger">{{ $item }}</span></section>
                        @endforeach

                        <section class="row mt-4">
                            <section class="col-9">
                                <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                    <!-- start vontent header -->
                                    <section class="content-header mb-3">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h2 class="content-header-title content-header-title-small">
                                                کد تخفیف
                                            </h2>
                                            <section class="content-header-link">
                                                <!--<a href="#">مشاهده همه</a>-->
                                            </section>
                                        </section>
                                    </section>

                                    <section class="payment-alert alert alert-primary d-flex align-items-center p-2"
                                        role="alert">
                                        <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                        <secrion>
                                            کد تخفیف خود را در این بخش وارد کنید.
                                        </secrion>
                                    </section>

                                    <section class="row">

                                        <section class="col-md-5">
                                            <section class="input-group input-group-sm">
                                                <input type="text" name="copan" class="form-control" form="form-copan"
                                                    placeholder="کد تخفیف را وارد کنید">
                                                <button class="btn btn-primary" type="button"
                                                    onclick="document.getElementById('form-copan').submit()">اعمال
                                                    کد</button>
                                            </section>
                                        </section>

                                    </section>
                                </section>

                                <form action="{{ route('customer.sale-process.payment.check-copan') }}" id="form-copan"
                                    method="POST">
                                    @csrf
                                </form>


                                <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                    <!-- start vontent header -->
                                    <section class="content-header mb-3">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h2 class="content-header-title content-header-title-small">
                                                انتخاب نوع پرداخت
                                            </h2>
                                            <section class="content-header-link">
                                                <!--<a href="#">مشاهده همه</a>-->
                                            </section>
                                        </section>
                                    </section>
                                    <section class="payment-select">

                                        <section class="payment-alert alert alert-primary d-flex align-items-center p-2"
                                            role="alert">
                                            <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                            <secrion>
                                                برای پیشگیری از انتقال ویروس کرونا پیشنهاد می کنیم روش پرداخت اینترنتی رو
                                                پرداخت کنید.
                                            </secrion>
                                        </section>

                                        <input type="radio" name="payment_type" value="1" form="form-buy" id="d1" />
                                        <label for="d1" class="col-4 payment-wrapper mb-2 pt-2">
                                            <section class="mb-2">
                                                <i class="fa fa-credit-card mx-1"></i>
                                                پرداخت آنلاین
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-calendar-alt mx-1"></i>
                                                درگاه پرداخت زرین پال
                                            </section>
                                        </label>

                                        <section class="mb-2"></section>

                                        <input type="radio" name="payment_type" value="2" form="form-buy" id="d2" />
                                        <label for="d2" class="col-4 payment-wrapper mb-2 pt-2">
                                            <section class="mb-2">
                                                <i class="fa fa-id-card-alt mx-1"></i>
                                                پرداخت آفلاین
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-calendar-alt mx-1"></i>
                                                حداکثر در 2 روز کاری بررسی می شود
                                            </section>
                                        </label>

                                        <section class="mb-2"></section>

                                        <input type="radio" name="payment_type" value="3" form="form-buy" id="d3" />
                                        <label for="d3" class="col-4 payment-wrapper mb-2 pt-2">
                                            <section class="mb-2">
                                                <i class="fa fa-money-check mx-1"></i>
                                                پرداخت در محل
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-calendar-alt mx-1"></i>
                                                پرداخت به پیک هنگام دریافت کالا
                                            </section>
                                        </label>


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
                                        <p class="text-danger fw-bolder">{{ priceFormat($totalProductDiscount) }} تومان</p>
                                    </section>

                                    @if ($order->common_discount_id != null)
                                        <section class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted">مناسبت تخفیف عمومی</p>
                                            <p class="text-success">{{ $order->common_discount_object['title'] }}</p>
                                        </section>

                                        <section class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted">تخفیف اعمال شده مناسبت</p>
                                            <p class="text-success">{{ priceFormat($order->order_common_discount_amount) }}
                                                تومان </p>
                                        </section>
                                    @endif

                                    <section class="border-bottom mb-3"></section>

                                    @if ($order->copan_id != null)
                                        <section class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted">میزان کد تخفیف</p>
                                            <p class="text-danger">{{ priceFormat($order->copan_object['discount']) }}

                                                @if ($order->copan_object['amount_type'] == 1)
                                                    تومان
                                                @else
                                                    درصد
                                                @endif

                                            </p>
                                        </section>

                                        <section class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted">تخفیف اعمال شده کد تخفیف</p>
                                            <p class="text-danger">{{ priceFormat($order->order_copan_discount_amount) }}
                                                تومان </p>
                                        </section>
                                    @endif

                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">هزینه ارسال</p>
                                        <p class="text-warning" id="price_delivery">{{ priceFormat($order->delivery_object["amount"]) }} تومان </p>
                                    </section>

                                    <p class="my-3">
                                        <i class="fa fa-info-circle me-1"></i> کاربر گرامی کالاها بر اساس نوع ارسالی که
                                        انتخاب می کنید در مدت زمان ذکر شده ارسال می شود.
                                    </p>

                                    <section class="border-bottom mb-3"></section>

                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">مبلغ قابل پرداخت</p>
                                        <p class="fw-bold">{{ priceFormat($order->order_final_amount) }} تومان</p>
                                    </section>

                                    <section class="">
                                        <section id="payment-button"
                                            class="text-warning border border-warning text-center py-2 pointer rounded-2 d-block">
                                            نوع پرداخت را انتخاب کن</section>
                                        <button id="final-level" class="btn btn-danger col-12 d-none" onclick="document.getElementById('form-buy').submit()">ثبت سفارش
                                            و گرفتن کد رهگیری</button>
                                    </section>
                                </section>

                                <form action="{{ route('customer.sale-process.payment.buy') }}" method="POST" id="form-buy">
                                    @csrf
                                </form>

                            </section>

                        </section>
                    </section>
                </section>

            </section>
        </section>
        <!-- end cart -->

    </main>
    <!-- end main one col -->
@endsection
