@extends('customer.layouts.app-one-col')

@section('content')
    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                @include('customer.layouts.parties.filter-sidebar')
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                        <section class="filters mb-3">
                            <span class="d-inline-block border p-1 rounded bg-light">نتیجه جستجو برای : <span
                                    class="badge bg-info text-dark">{{ request()->get('q') }} </span></span>
                            <span class="d-inline-block border p-1 rounded bg-light">دسته : <span
                                    class="badge bg-info text-dark">{{ $category->name }}</span></span>
                            @if (request()->get('l_price'))
                                <span class="d-inline-block border p-1 rounded bg-light">قیمت از : <span
                                        class="badge bg-info text-dark">{{ request()->get('l_price') }}
                                        تومان</span></span>
                            @endif
                            @if (request()->get('h_price'))
                                <span class="d-inline-block border p-1 rounded bg-light">قیمت تا : <span
                                        class="badge bg-info text-dark">{{ request()->get('h_price') }}
                                        تومان</span></span>
                            @endif

                        </section>

                        <section class="sort">
                            <span>مرتب سازی بر اساس : </span>
                            <a class="btn btn-info btn-sm px-1 py-0" href="{{ request()->fullUrlWithQuery(['sort' => 1]) }}"
                                type="button">جدیدترین</a>
                            <a class="btn btn-light btn-sm px-1 py-0" type="button">محبوب ترین</a>
                            <a class="btn btn-light btn-sm px-1 py-0"
                                href="{{ request()->fullUrlWithQuery(['sort' => 3]) }}" type="button">گران ترین</a>
                            <a class="btn btn-light btn-sm px-1 py-0"
                                href="{{ request()->fullUrlWithQuery(['sort' => 4]) }}" type="button">ارزان ترین</a>
                            <a class="btn btn-light btn-sm px-1 py-0"
                                href="{{ request()->fullUrlWithQuery(['sort' => 5]) }}" type="button">پربازدیدترین</a>
                            <a class="btn btn-light btn-sm px-1 py-0"
                                href="{{ request()->fullUrlWithQuery(['sort' => 6]) }}" type="button">پرفروش ترین</a>
                        </section>


                        <section class="main-product-wrapper row my-4">


                            @foreach ($products as $item)
                                <section class="col-md-3 p-0">
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
                                                <section class="product-add-to-favorite" data-id="{{ $item->id }}"
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

                                        <a class="product-link" href="{{ route('customer.product.show', $item->slug) }}">
                                            <section class="product-image">
                                                <img class="" src="{{ asset($item->image) }}" alt="">
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
                            @endforeach


                            <section class="col-12">
                                <section class="my-4 d-flex justify-content-center">

                                    {{ $products->links() }}

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
