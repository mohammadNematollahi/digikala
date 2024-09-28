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
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>تاریخچه سفارشات</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->


                        <section class="d-flex justify-content-center my-4">
                            <a class="btn btn-primary btn-sm mx-1" href="{{ route("profile.my-orders") }}">همه </a>
                            <a class="btn btn-info btn-sm mx-1" href="{{ route("profile.my-orders" , ["orderBy" => 0]) }}">پرداخت نشده </a>
                            <a class="btn btn-warning btn-sm mx-1" href="{{ route("profile.my-orders" , ["orderBy" => 1]) }}">در حال پردازش</a>
                            <a class="btn btn-success btn-sm mx-1" href="{{ route("profile.my-orders" , ["orderBy" => 0]) }}">تحویل شده</a>
                            <a class="btn btn-danger btn-sm mx-1" href="{{ route("profile.my-orders" , ["orderBy" => 0]) }}">مرجوعی</a>
                            <a class="btn btn-dark btn-sm mx-1" href="{{ route("profile.my-orders" , ["orderBy" => 0]) }}">لغو شده</a>
                        </section>


                        <!-- start content header -->
                        <section class="content-header mb-3">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title content-header-title-small">
                                    در انتظار پرداخت
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end content header -->


                        <section class="order-wrapper">

                            @foreach ($userOrders as $order)
                                <section class="order-item">
                                    <section class="d-flex justify-content-between">
                                        <section>
                                            <section class="order-item-date"><i class="fa fa-calendar-alt"></i>
                                                {{ convertToShamsi($order->created_at) }}
                                            </section>
                                            <section class="order-item-id"><i class="fa fa-id-card-alt"></i>کد سفارش :
                                                {{ $order->id }}
                                            </section>
                                            <section class="order-item-status"><i class="fa fa-clock"></i>
                                                {{ $order->paymentStatusValue }}
                                            </section>
                                            <section class="order-item-products">
                                                @foreach ($order->orderItems as $item)
                                                    <img src="{{ asset($item["product"]["image"]) }}" alt="" width="100px" height="100px">
                                                @endforeach
                                            </section>
                                        </section>
                                        <section class="order-item-link"><a href="#">پرداخت سفارش</a></section>
                                    </section>
                                </section>
                            @endforeach

                        </section>


                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection
