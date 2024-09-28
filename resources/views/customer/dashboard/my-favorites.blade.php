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
                                    <span>لیست علاقه های من</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->


                        @foreach ($user_favorites as $item)
                            <section class="cart-item d-flex py-3" >
                                <section class="cart-img align-self-start flex-shrink-1"><img
                                        src="{{ asset($item->image) }}" alt=""></section>
                                <section class="align-self-start w-100">
                                    <p class="fw-bold">{{ $item->name }}</p>
                                    <p>
                                        @foreach ($item->showColores as $color)
                                            <span style="background-color: {{ $color->color }};"
                                                class="cart-product-selected-color me-1 border"></span>
                                            <span>{{ $color->color_name }}</span>
                                        @endforeach
                                    </p>
                                    @if (!$item->warranties->isEmpty())
                                        <p>
                                            <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i> <span>

                                                @foreach ($item->warranties as $warranty)
                                                    {{ $warranty->name . ' / ' }}
                                                @endforeach

                                            </span>
                                        </p>
                                    @endif
                                    <section>
                                        <button type="button" id="delete" class="btn-sm btn-danger border-0" data-route-delete="{{ route('customer.product.change-status-favorite', $item->id) }}"><i
                                                class="fa fa-trash-alt"></i> حذف از لیست علاقه ها</button>
                                    </section>
                                </section>
                                    <section class="align-self-end flex-shrink-1">
                                        <section>
                                            {{ $item->amazingSale()->first() ? priceFormat(final_price_discount($item->price, $item->amazingSale()->first()->percentage)) : priceFormat($item->price) }}
                                            تومان</section>
                                    </section>
                            </section>
                        @endforeach

                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection


@section('script')
    <script>

        $("#delete").click(function (e) {
            e.preventDefault();

            const url = $(this).attr("data-route-delete");
            console.log(url);
            $.ajax({
            type: 'get',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                location.reload(true)
            }
        });
        });
    </script>
@endsection
