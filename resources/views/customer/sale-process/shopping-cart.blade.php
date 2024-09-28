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
                                    <span>سبد خرید شما</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>

                        @if (!$carts->isEmpty())
                            <section class="row mt-4" id="contents">

                                <section class="col-9">
                                    <section class="content-wrapper bg-white p-3 rounded-2">

                                        <form action="{{ route('customer.shopping.cart.update-carts') }}" method="POST"
                                            id="form">
                                            @csrf
                                            @method('put')
                                            @php
                                                $totalProductPrice = 0;
                                                $totalProductDiscount = 0;
                                            @endphp

                                            @foreach ($carts as $item)
                                                @php
                                                    $totalProductPrice += $item->itemFinalProductPrice();
                                                    $totalProductDiscount += $item->itemFinalProductDiscount();
                                                @endphp
                                                <section class="cart-item d-flex py-3">
                                                    <section class="cart-img align-self-start flex-shrink-1"><img
                                                            src="{{ asset($item->product->image) }}" alt="">
                                                    </section>
                                                    <section class="align-self-start w-100">
                                                        <p class="fw-bold">{{ $item->product->name }}</p>

                                                        <div class="mb-2">
                                                            @if (!empty($item->color))
                                                                <span style="background-color: {{ $item->color->color }};"
                                                                    class="cart-product-selected-color me-1 border">
                                                                </span>
                                                                <span> {{ $item->color->name_color }}</span>
                                                            @endif
                                                        </div>

                                                        <div class="mb-2">
                                                            @if (!empty($item->warranty))
                                                                <i
                                                                    class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                                                <span>{{ $item->warranty->name }}</span>
                                                            @endif
                                                        </div>

                                                        <div class="my-2">
                                                            @if ($item->product->marketable_number <= 0)
                                                                <i
                                                                    class="fa fa-store-alt cart-product-selected-store me-1 text-danger"></i><span>کالا
                                                                    موجود نیست</span>
                                                            @else
                                                                <i
                                                                    class="fa fa-store-alt cart-product-selected-store me-1"></i><span>کالا
                                                                    موجود در انبار</span>
                                                            @endif
                                                        </div>

                                                        <section>
                                                            <section class="cart-product-number d-inline-block ">
                                                                <button class="mines btn-sm btn-info"
                                                                    type="button">-</button>
                                                                <input class="number" name="number[{{ $item->id }}]"
                                                                    type="number" min="1" max="5"
                                                                    step="1" readonly="readonly"
                                                                    value="{{ $item->number }}"
                                                                    data-product-price="{{ $item->itemProductPrice() }}"
                                                                    data-product-discount="{{ $item->itemProductDiscount() }}">
                                                                <button class="plus btn-sm btn-primary"
                                                                    type="button">+</button>
                                                            </section>
                                                            <button class="ms-4 destroy btn btn-sm" type="button"
                                                                onclick="document.getElementById('destory').submit()">
                                                                <i class="fa fa-trash-alt"></i> حذف از سبد
                                                            </button>
                                                        </section>
                                                    </section>

                                                    @if ($item->itemProductDiscount() > 0)
                                                        <section class="align-self-end flex-shrink-1">
                                                            <p class="text-nowrap text-danger fw-bold">
                                                                {{ priceFormat($item->itemProductDiscount()) }} تخفیف</p>
                                                        </section>
                                                    @endif

                                                    <section class="align-self-end flex-shrink-1">
                                                        <span
                                                            class="text-nowrap fw-bold">{{ priceFormat($item->itemProductPrice()) }}
                                                            تومان</span>
                                                    </section>
                                                </section>
                                            @endforeach

                                    </section>
                                </section>

                                <section class="col-3">
                                    <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted">قیمت کالاها ({{ persianNumber($item->count()) }})</p>
                                            <p class="text-muted" id="total_price">{{ priceFormat($totalProductPrice) }}
                                                تومان
                                            </p>
                                        </section>

                                        <section class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted">تخفیف کالاها</p>
                                            <p class="text-danger fw-bolder" id="total_discount">
                                                {{ priceFormat($totalProductDiscount) }} تومان</p>
                                        </section>
                                        <section class="border-bottom mb-3"></section>
                                        <section class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted">جمع سبد خرید</p>
                                            <p class="fw-bolder" id="final_price">
                                                {{ priceFormat($totalProductPrice - $totalProductDiscount) }}
                                                تومان</p>
                                        </section>

                                        <p class="my-3">
                                            <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز نهایی نشده است.
                                            برای
                                            ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را
                                            انتخاب
                                            کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت
                                            پرداخت این سفارش صورت میگیرد.
                                        </p>

                                        </form>


                                        <section class="">
                                            <button class="btn btn-danger d-block col-12" type="button"
                                                onclick="document.getElementById('form').submit()">تکمیل فرآیند خرید</a>
                                        </section>

                                    </section>
                                </section>


                            </section>


                    </section>
                </section>

            </section>
        </section>
        <!-- end cart -->


        <form action="{{ route('customer.shopping.cart.destory', $item->id) }}" method="POST" class="d-inline-block"
            id="destory">
            @csrf
            @method('delete')
        </form>
    @else
        <section class="col-12 d-flex justify-content-center align-items-center p-5 m-2">
            <h1 class="text-dark">شما خریدی به سبد خود اضاف نکردید<i class="fa fa-sad-tear mx-2"></i></h1>
        </section>
        @endif

        <section class="mb-4">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span>کالاهای مرتبط با سبد خرید شما</span>
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <!-- start vontent header -->
                            <section class="lazyload-wrapper">
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                    @foreach ($products as $item)
                                        <section class="row">
                                            <section class="item">
                                                <section class="lazyload-item-wrapper">
                                                    <section class="product">
                                                        <section class="product-add-to-cart"><a href="#"
                                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                                title="افزودن به سبد خرید"><i
                                                                    class="fa fa-cart-plus"></i></a>
                                                        </section>

                                                        @auth
                                                            @if (auth()->user()->favorites()->find($item->id) == null)
                                                                <section class="product-add-to-favorite"
                                                                    data-url="{{ route('customer.product.change-status-favorite', $item->id) }}">
                                                                    <a data-bs-toggle="tooltip" data-bs-placement="left"
                                                                        title="افزودن به علاقه مندی"><i
                                                                            class="fa fa-heart"></i>
                                                                    </a>
                                                                </section>
                                                            @else
                                                                <section class="product-add-to-favorite"
                                                                    data-url="{{ route('customer.product.change-status-favorite', $item->id) }}">
                                                                    <a data-bs-toggle="tooltip" data-bs-placement="left"
                                                                        title="حذف از علاقه مندی"><i
                                                                            class="fa fa-heart product-add-to-favorite-active"></i>
                                                                    </a>
                                                                </section>
                                                            @endif
                                                        @endauth

                                                        @guest
                                                            <section class="product-add-to-favorite show-login">
                                                                <a data-bs-toggle="tooltip" data-bs-placement="left"
                                                                    title="افزودن به علاقه مندی"><i class="fa fa-heart"></i>
                                                                </a>
                                                            </section>
                                                        @endguest

                                                        <a class="product-link"
                                                            href="{{ route('customer.product.show', $item->slug) }}">
                                                            <section class="product-image">
                                                                <img class="" src="{{ asset($item->image) }}"
                                                                    alt="">
                                                            </section>
                                                            <section class="product-colors"></section>
                                                            <section class="product-name">
                                                                <h3>{{ $item->name }}</h3>
                                                            </section>
                                                            <section class="product-price-wrapper">
                                                                @if ($item->amazingSale()->first())
                                                                    <section class="product-discount">
                                                                        <span
                                                                            class="product-old-price">{{ priceFormat($item->price) }}</span>
                                                                        <span
                                                                            class="product-discount-amount">{{ persianNumber($item->amazingSale()->first()->percentage) }}%</span>
                                                                    </section>
                                                                @endif
                                                                <section class="product-price">
                                                                    {{ $item->amazingSale()->first() ? priceFormat(final_price_discount($item->price, $item->amazingSale()->first()->percentage)) : priceFormat($item->price) }}
                                                                    تومان</section>
                                                            </section>
                                                            <section class="product-colors">
                                                                @foreach ($item->productColor as $item)
                                                                    <section class="product-colors-item"
                                                                        style="background-color: {{ $item->color }};">
                                                                    </section>
                                                                @endforeach
                                                            </section>
                                                        </a>
                                                    </section>
                                                </section>
                                            </section>
                                        </section>
                                    @endforeach

                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>

    </main>
    <!-- end main one col -->
@endsection


@section('script')
    <script>
        $('.plus').click(function() {

            number = parseInt($(this).prev().val());

            if (number < 5) {
                $(this).prev().val(number + 1)
            }

            build();
        });

        $('.mines').click(function() {

            number = parseInt($(this).next().val());

            if (number > 1) {
                $(this).next().val(number - 1)
            }

            build();
        });

        function build() {

            var totalProductPrice = 0;
            var totalProductDiscount = 0;
            var finalPrice = 0;

            $(".number").each(function(index, element) {

                var productPrice = parseInt($(element).attr("data-product-price"));
                var productDiscount = parseInt($(element).attr("data-product-discount"));
                var number = parseInt($(element).val());

                totalProductPrice += productPrice * number;
                totalProductDiscount += productDiscount * number;

            });

            finalPrice = totalProductPrice - totalProductDiscount;

            $("#total_price").html(convertToPersianAndPriceFormat(totalProductPrice));
            $("#total_discount").html(convertToPersianAndPriceFormat(totalProductDiscount));
            $("#final_price").html(convertToPersianAndPriceFormat(finalPrice));

        }

        function convertToPersianAndPriceFormat(number) {
            const persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",").split('').map(function(e) {
                return persianNumbers[+e] || e;
            }).join('');
        }
    </script>

    <script>
        $(".product-add-to-favorite").click(function(e) {
            e.preventDefault();
            const el = $(this);

            $.ajax({
                url: $(el).attr("data-url"),
                success: function(response) {
                    if (response["status"] == 1) {

                        $(el).html(
                            '<a data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی"><i class="fa fa-heart product-add-to-favorite-active"></i></a>'
                        );

                    } else {

                        $(el).html(
                            '<a data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی"><i class="fa fa-heart"></i></a>'
                        );

                    }
                }
            });
        });
    </script>
@endsection
