@extends('customer.layouts.app-one-col')

@section('content')

    <!-- start slideshow -->
    <section class="container-xxl my-4">
        <section class="row">

            @if (!$banner_top_big->isEmpty())
                <section class="col-md-8 pe-1">
                    <section id="slideshow" class="owl-carousel owl-theme">
                        @foreach ($banner_top_big as $item)
                            <section class="item"><a class="w-100 d-block h-auto text-decoration-none" href="#"><img
                                        class="w-100 rounded-2 d-block h-auto" src={{ $item->image }} alt=""></a>
                            </section>
                        @endforeach
                    </section>
                </section>
            @endif

            @if ($banner_top_small_first || $banner_top_small_second)
                <section class="col-md-4 ps-1">
                    <section class="mb-2">
                        <a href="{{ $banner_top_small_first->url }}" class="d-block">
                            <img class="w-100 rounded-2" src="{{ asset($banner_top_small_first->image) }}" alt="">
                        </a>
                    </section>

                    <section class="mb-2">
                        <a href="{{ $banner_top_small_second->url }}" class="d-block">
                            <img class="w-100 rounded-2" src="{{ asset($banner_top_small_second->image) }}" alt="">
                        </a>
                    </section>
                </section>
            @endif

        </section>
    </section>
    <!-- end slideshow -->



    <!-- start product lazy load -->
    <section class="">
        <section class="container-xxl">
            <section class="row">
                <section class="col mb-3">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پربازدیدترین کالاها</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="#">مشاهده همه</a>
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

                                                    @auth
                                                        @if (auth()->user()->favorites()->find($item->id) == null)
                                                            <section class="product-add-to-favorite"
                                                                data-url="{{ route('customer.product.change-status-favorite', $item->id) }}"
                                                                data-id="{{ $item->id }}">
                                                                <a data-bs-toggle="tooltip" data-bs-placement="left"
                                                                    title="افزودن به علاقه مندی"><i class="fa fa-heart"></i>
                                                                </a>
                                                            </section>
                                                        @else
                                                            <section class="product-add-to-favorite"
                                                                data-id="{{ $item->id }}"
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
    <!-- end product lazy load -->



    <!-- start ads section -->

    <section class="mb-3">
        <section class="container-xxl">
            <!-- two column-->
            <section class="row">
                @if ($banner_middle_right)
                    <section class="col-12 col-md-6">
                        <a href="{{ $banner_middle_right->url }}" class="d-block">

                            <img class="d-block rounded-2 w-100" src="{{ $banner_middle_right->image }}" alt="">
                        </a>

                    </section>
                @endif
                @if ($banner_middle_left)
                    <section class="col-12 col-md-6">
                        <a href="{{ $banner_middle_left->url }}" class="d-block">

                            <img class="d-block rounded-2 w-100" src="{{ $banner_middle_left->image }}" alt="">
                        </a>

                    </section>
                @endif
            </section>

        </section>
    </section>

    <!-- end ads section -->


    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پیشنهاد آمازون به شما</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="#">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                @foreach ($last_products as $item)
                                    <section class="row">
                                        <section class="item">
                                            <section class="lazyload-item-wrapper">
                                                <section class="product">

                                                    @auth
                                                        @if (auth()->user()->favorites()->find($item->id) == null)
                                                            <section class="product-add-to-favorite"
                                                                data-id="{{ $item->id }}"
                                                                data-url="{{ route('customer.product.change-status-favorite', $item->id) }}">
                                                                <a data-bs-toggle="tooltip" data-bs-placement="left"
                                                                    title="افزودن به علاقه مندی"><i class="fa fa-heart"></i>
                                                                </a>
                                                            </section>
                                                        @else
                                                            <section class="product-add-to-favorite"
                                                                data-id="{{ $item->id }}"
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
    <!-- end product lazy load -->


    <!-- start ads section -->
    <section class="mb-3">
        <section class="container-xxl">
            <!-- one column -->
            @if ($banner_button)
                <section class="col">
                    <a href="{{ $banner_button->url }}" class="d-block">

                        <img class="d-block rounded-2 w-100" src="{{ $banner_button->image }}" alt="">
                    </a>

                </section>
            @endif

        </section>
    </section>
    <!-- end ads section -->



    <!-- start brand part-->
    @if (!$brands->isEmpty())
        <section class="brand-part mb-4 py-4">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex align-items-center">
                                <h2 class="content-header-title">
                                    <span>برندهای ویژه</span>
                                </h2>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="brands-wrapper py-4">
                            <section class="brands dark-owl-nav owl-carousel owl-theme">

                                @foreach ($brands as $item)
                                    <section class="item">
                                        <section class="brand-item">
                                            <a href="{{ $item->url }}"><img class="rounded-2"
                                                    src="{{ asset($item->logo) }}" alt=""></a>
                                        </section>
                                    </section>
                                @endforeach

                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    @endif
    <!-- end brand part-->

    <!-- end main one col -->
@endsection

@section('script')

    <script>
        $(".product-add-to-favorite").click(function(e) {
            e.preventDefault();
            const el = $(this);
            const el_id = $(el).attr("data-id");

            $.ajax({
                url: $(el).attr("data-url"),
                success: function(response) {
                    if (response["status"] == 1) {

                        $(`[data-id=${el_id}]`).html(
                            '<a data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی"><i class="fa fa-heart product-add-to-favorite-active"></i></a>'
                        );

                    } else {

                        $(`[data-id=${el_id}]`).html(
                            '<a data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی"><i class="fa fa-heart"></i></a>'
                        );

                    }
                }
            });
        });
    </script>

@endsection
