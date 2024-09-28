@extends('customer.layouts.app-one-col')

@section('content')
    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>{{ $product->name }}</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <form action="{{ route('customer.shopping.cart.add-to-cart', $product->id) }}" method="POST">
                        @csrf
                        <section class="row mt-4">
                            <!-- start image gallery -->
                            <section class="col-md-4">
                                <section class="content-wrapper bg-white p-3 rounded-2 mb-4">
                                    <section class="product-gallery">
                                        <section class="product-gallery-selected-image mb-3">
                                            <img src="{{ asset($product->image) }}"
                                                alt="{{ $product->image . $product->id }}">
                                        </section>
                                        @if (!$product->productGallery->isEmpty())
                                            <section class="product-gallery-thumbs">
                                                <img class="product-gallery-thumb" src="{{ asset($product->image) }}"
                                                    alt="" data-input="{{ asset($product->image) }}">
                                                @foreach ($product->productGallery as $item)
                                                    <img class="product-gallery-thumb" src="{{ asset($item->image) }}"
                                                        alt="" data-input="{{ asset($item->image) }}">
                                                @endforeach
                                            </section>
                                        @endif
                                    </section>
                                </section>
                            </section>
                            <!-- end image gallery -->

                            <!-- start product info -->
                            <section class="col-md-5">

                                <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                    <!-- start vontent header -->
                                    <section class="content-header mb-3">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h2 class="content-header-title content-header-title-small">
                                                {{ $product->name }}
                                            </h2>
                                            <section class="content-header-link">
                                                <!--<a href="#">مشاهده همه</a>-->
                                            </section>
                                        </section>
                                    </section>

                                    <section class="product-info">

                                        @if (!$product->productColor->isEmpty())
                                            <div id="choose_color" class="my-1">
                                                <span id="name_color" class="d-block">رنگ انتخاب شده :</span>

                                                @foreach ($product->productColor as $item)
                                                    <input type="radio" class="d-none" id="{{ $item->color }}" name="color_id"
                                                        id="{{ $item->color }}" value="{{ $item->id }}"
                                                        title="{{ $item->color_name }}"
                                                        data-increase="{{ $item->price_increase }}">
                                                    <label for="{{ $item->color }}"
                                                        style="background-color: {{ $item->color }};"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        class="product-info-colors border my-1 pointer"></label>
                                                @endforeach

                                            </div>
                                        @endif

                                        @if (!$product->warranties->isEmpty())
                                            <div class="my-2">
                                                <label for="warranty">
                                                    <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                                    <span>گارانتی :</span>
                                                </label>
                                                <select name="warranty_id" id="warranty"
                                                    class="form-control-range border-0">
                                                    @foreach ($product->warranties as $item)
                                                        <option value="{{ $item->id }}"
                                                            data-increase="{{ $item->price_increase }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        <div class="my-2">
                                            @if ($product->marketable_number <= 0)
                                                <i class="fa fa-store-alt cart-product-selected-store me-1 text-danger"></i>
                                                <span class="text-danger"><b>در انبار موجود نیست</b></span>
                                            @else
                                                <i
                                                    class="fa fa-store-alt cart-product-selected-store me-1 text-success"></i>
                                                <span class="text-success"><b>در انبار موجود است</b></span>
                                            @endif
                                        </div>

                                        @auth
                                            @if (auth()->user()->favorites()->find($product->id) == null)
                                                <div class="mb-2">
                                                    <button type="button"
                                                        class="btn btn-light btn-sm text-decoration-none {{ $product->id }}">
                                                        <i class="fa fa-heart text-danger"></i> اضافه کردن به علاقه مندی ها
                                                    </button>
                                                </div>
                                            @else
                                                <div class="mb-2">
                                                    <button
                                                        class="btn btn-light btn-sm text-decoration-none {{ $product->id }}"
                                                        type="button">
                                                        <i class="fa fa-trash text-danger"></i> حذف کردن از علاقه مندی ها
                                                    </button>
                                                </div>
                                            @endif
                                        @endauth

                                        @guest
                                            <div class="mb-2">
                                                <button class="btn btn-light btn-sm text-decoration-none show-login"
                                                    type="button">
                                                    <i class="fa fa-heart text-danger"></i> اضافه کردن به علاقه مندی ها
                                                </button>
                                            </div>
                                        @endguest

                                        <section>
                                            <section class="cart-product-number d-inline-block">
                                                <button class="btn-sm btn-info" type="button" id="mines">-</button>
                                                <input id="number" type="number" min="1" max="5"
                                                    step="1" value="1" readonly="readonly" name="number">
                                                <button class="btn-sm btn-primary" type="button" id="plus">+</button>
                                            </section>
                                        </section>

                                        <p class="mb-3 mt-5">
                                            <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز نهایی نشده است.
                                            برای
                                            ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را
                                            انتخاب
                                            کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت
                                            پرداخت این سفارش صورت میگیرد. پس از ثبت سفارش کالا بر اساس نحوه ارسال که شما
                                            انتخاب
                                            کرده اید کالا برای شما در مدت زمان مذکور ارسال می گردد.
                                        </p>

                                    </section>

                                </section>

                            </section>
                            <!-- end product info -->

                            @if ($product->marketable_number != 0)
                                <section class="col-md-3">
                                    <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted">قیمت کالا</p>
                                            <p class="text-muted">{{ priceFormat($product->price) }}<span
                                                    class="small">تومان</span></p>
                                        </section>

                                        <section class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted">تخفیف کالا</p>
                                            <p class="text-danger fw-bolder">
                                                {{ $product->amazingSale()->first() ? priceFormat(discount($product->price, $product->amazingSale()->first()->percentage)) : '- ' }}<span
                                                    class="small">تومان</span></p>
                                        </section>

                                        <section class="border-bottom mb-3"></section>

                                        <section class="d-flex justify-content-end align-items-center">

                                            @php
                                                $final_price_discount = $product->amazingSale()->first()
                                                    ? final_price_discount(
                                                        $product->price,
                                                        $product->amazingSale()->first()->percentage,
                                                    )
                                                    : $product->price;
                                            @endphp

                                            <p class="fw-bolder">
                                                <span id="final_price"></span>
                                                <span class="small">تومان</span>
                                            </p>
                                        </section>

                                        <section class="">
                                            <button type="sunbmit" class="col-12 btn btn-danger d-block">افزودن به سبد
                                                خرید</button>
                                        </section>

                                    </section>
                                </section>
                            @endif
                        </section>

                    </form>

                </section>
            </section>
        </section>

    </section>
    </section>
    <!-- end cart -->

    <!-- start product lazy load -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>کالاهای مرتبط</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                @foreach ($product_same as $item)
                                    <section class="row">
                                        <section class="item">
                                            <section class="lazyload-item-wrapper">
                                                <section class="product">
                                                    <section class="product-add-to-cart"><a href="#"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a>
                                                    </section>

                                                    @auth
                                                        @if (auth()->user()->favorites()->find($item->id) == null)
                                                            <section
                                                                class="product-add-to-favorite {{ $item->id . '_heart' }}">
                                                                <a data-bs-toggle="tooltip" data-bs-placement="left"
                                                                    title="افزودن به علاقه مندی"><i class="fa fa-heart"></i>
                                                                </a>
                                                            </section>
                                                        @else
                                                            <section
                                                                class="product-add-to-favorite {{ $item->id . '_heart' }}">
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

    <!-- end product lazy load -->

    <!-- start description, features and comments -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start content header -->
                        <section id="introduction-features-comments" class="introduction-features-comments">
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span class="me-2"><a class="text-decoration-none text-dark"
                                                href="#introduction">معرفی</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark"
                                                href="#features">ویژگی ها</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark"
                                                href="#comments">دیدگاه ها</a></span>
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                        </section>
                        <!-- start content header -->

                        <section class="py-4">

                            <!-- start vontent header -->
                            <section id="introduction" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        معرفی
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-introduction mb-4">
                                {!! $product->introduction !!}
                            </section>

                            <!-- start vontent header -->
                            <section id="features" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        ویژگی ها
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-features mb-4 table-responsive">
                                <table class="table table-bordered border-white">
                                    @foreach ($product->productMeta as $item)
                                        <tr>
                                            <td>{{ $item->product_key }}</td>
                                            <td>{{ $item->product_value }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </section>

                            <!-- start vontent header -->
                            <section id="comments" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        دیدگاه ها
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-comments mb-4 d-flex flex-column align-items-end">

                                @auth
                                    <section class="comment-add-wrapper col-12">
                                        <button class="comment-add-button" type="button" data-bs-toggle="modal"
                                            data-bs-target="#add-comment"><i class="fa fa-plus"></i> افزودن
                                            دیدگاه</button>
                                        <!-- start add comment Modal -->
                                        <section class="modal fade" id="add-comment" tabindex="-1"
                                            aria-labelledby="add-comment-label" aria-hidden="true">
                                            <section class="modal-dialog">
                                                <section class="modal-content">
                                                    <section class="modal-header">
                                                        <h5 class="modal-title" id="add-comment-label"><i
                                                                class="fa fa-plus"></i> افزودن
                                                            دیدگاه</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </section>
                                                    <section class="modal-body">
                                                        <form class="row"
                                                            action="{{ route('customer.product.add-comment', $product->id) }}"
                                                            method="POST">
                                                            @csrf

                                                            <section class="col-12 mb-2">
                                                                <label for="comment" class="form-label mb-1">دیدگاه
                                                                    شما</label>
                                                                <textarea class="form-control form-control-sm" id="comment" name="body" placeholder="دیدگاه شما ..."
                                                                    rows="4">{{ old('body') }}</textarea>
                                                            </section>

                                                            @error('body')
                                                                <div class="mt-1">
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                </div>
                                                            @enderror

                                                            <section class="modal-footer py-1">
                                                                <button type="submit" class="btn btn-sm btn-primary">ثبت
                                                                    دیدگاه</button>
                                                                <button type="button" class="btn btn-sm btn-danger"
                                                                    data-bs-dismiss="modal">بستن</button>
                                                            </section>

                                                        </form>
                                                    </section>
                                                </section>
                                            </section>
                                        </section>
                                    </section>
                                @endauth

                                @guest
                                    <section class="col-12">
                                        <span class="px-1">برای ایجاد یک کامنت اول باید ثبت
                                            نام کنید</span>
                                        <a class="link-primary" href="{{ route('customer.login-register') }}"><i
                                                class="fa fa-plus"></i> ثبت نام کردن </a>
                                    </section>
                                @endguest

                                @if (!$product->activeComments()->get()->isEmpty())
                                    @foreach ($product->activeComments()->get() as $item)
                                        <section class="product-comment col-12">
                                            <section
                                                class="product-comment-header d-flex justify-content-between align-items-center">
                                                <div>
                                                    <section class="product-comment-date">
                                                        {{ convertToShamsi($item->created_at) }}
                                                    </section>
                                                    <section class="product-comment-title">
                                                        {{ $item->user->fullName }}
                                                    </section>
                                                </div>
                                                @auth
                                                    @if (auth()->user()->id == $item->author_id)
                                                        <div class="d-flex justify-content-center align-items-center mx-2">
                                                            <button class="btn btn-sm btn-outline-dark"><i
                                                                    class="fa fa-trash"></i>
                                                                حذف </button>
                                                        </div>
                                                    @endif
                                                @endauth
                                            </section>
                                            <section class="product-comment-body">
                                                {!! $item->body !!}
                                            </section>
                                        </section>


                                        @if (!$item->answers()->get()->isEmpty())
                                            @foreach ($item->answers()->get() as $answer)
                                                <section class="product-comment col-11">
                                                    <section
                                                        class="product-comment-header d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <section class="product-comment-date">
                                                                {{ convertToShamsi($answer->created_at) }}
                                                            </section>
                                                            <section class="product-comment-title">
                                                                {{ $answer->user->fullName }}
                                                            </section>
                                                        </div>
                                                    </section>
                                                    <section class="product-comment-body">
                                                        {!! $answer->body !!}
                                                    </section>

                                                </section>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @else
                                    <section
                                        class="col-12 d-flex justify-content-center align-content-center mt-4 text-black-50">
                                        <span><b>اولین کسی باشید که نظر خود را وارد میکنید
                                                !</b></span>
                                    </section>
                                @endif

                            </section>
                        </section>

                    </section>
                </section>
            </section>
        </section>
    </section>

    <!-- end description, features and comments -->
@endsection

@section('script')
    <script>
        
        build()

        $("#choose_color > input").click(function(e) {

            build();

        });

        $("#warranty").change(function(e) {

            build();

        });

        $('#plus').click(function() {

            number = parseInt($('#number').val());
            if (number < 5) {
                $("#number").val(number + 1)
            }

            build();
        });

        $('#mines').click(function() {

            number = parseInt($('#number').val());
            if (number > 1) {
                $("#number").val(number - 1)
            }

            build();
        });

        function build() {

            //get color and set name color to span

            $("#choose_color > input:first").attr("checked", true);
            const color = $("#choose_color > input:checked");
            $("#name_color").html("رنگ انتخاب شده :" + color.attr('title'));

            //get warranty selected

            const warranty = $("#warranty > option:selected");

            //get number of product

            price = {{ $final_price_discount ?? 0 }};

            number = $("#number").val();
            color_price = color.attr("data-increase") == undefined ? 0 : color.attr("data-increase");
            warranty_price = warranty.attr("data-increase") == undefined ? 0 : warranty.attr("data-increase");

            price_total = price + parseInt(color_price) + parseInt(warranty_price);
            final_price = price_total * parseInt(number);

            $("#final_price").html(convertToPersianAndPriceFormat(final_price));

        }

        function convertToPersianAndPriceFormat(number) {
            const persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",").split('').map(function(e) {
                return persianNumbers[+e] || e;
            }).join('');
        }
    </script>

    <script>
        
        $(".{{ $product->id }}").click(function(e) {
            e.preventDefault();
            ajax();
        });

        $(".{{ $product->id . '_heart' }}").click(function(e) {
            e.preventDefault();
            ajax();
        });


        $(".show-login").click(function(e) {

            $("#login-toast").css("display", "block");

            var toast = new bootstrap.Toast(document.getElementById('login-toast'))
            document.getElementById('login-toast').style.display = 'block';
            toast.show();

        });

        function ajax() {
            $.ajax({
                type: 'get',
                url: "{{ route('customer.product.change-status-favorite', $product->id) }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response["status"] == 1) {

                        $(".{{ $product->id }}").html(
                            "<i class='fa fa-trash text-danger'></i> حذف کردن از علاقه مندی ها");


                        $(".{{ $product->id . '_heart' }}").html(
                            '<a data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی"><i class="fa fa-heart product-add-to-favorite-active"></i></a>'
                        );
                    } else {

                        $(".{{ $product->id }}").html(
                            '<i class="fa fa-heart text-danger"></i> اضافه کردن به علاقه مندی ها'
                        );

                        $(".{{ $product->id . '_heart' }}").html(
                            '<a data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی"><i class="fa fa-heart"></i></a>'
                        );

                    }
                }
            });
        }
    </script>
@endsection
