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

                        @php
                            $user = auth()->user();
                        @endphp

                        <section class="row mt-4" id="contents">

                            <form id="profile_completion"
                                action="{{ route('customer.sale-process.profile-completion.update') }}" method="post"
                                class="content-wrapper bg-white p-3 rounded-2 mb-4 col-9">
                                @csrf
                                @method('put')

                                <section class="payment-alert alert alert-primary d-flex align-items-center p-2"
                                    role="alert">
                                    <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                    <section>
                                        اطلاعات حساب کاربری خود را (فقط یک بار، برای همیشه) وارد کنید. از این پس کالاها برای
                                        شخصی با این مشخصات ارسال می شود.
                                    </section>
                                </section>

                                <section class="row pb-3">

                                    @if (empty($user->first_name))
                                        <section class="col-12 col-md-6 my-2">
                                            <div class="form-group">
                                                <label for="first_name">نام</label>
                                                <input type="text" class="form-control form-control-sm" name="first_name"
                                                    id="first_name" value="{{ old('first_name') }}">
                                            </div>
                                            @error('first_name')
                                                <div class="mt-1"><span class="text-danger">{{ $message }}</span></div>
                                            @enderror
                                        </section>
                                    @endif


                                    @if (empty($user->last_name))
                                        <section class="col-12 col-md-6 my-2">
                                            <div class="form-group">
                                                <label for="last_name">نام خانوادگی</label>
                                                <input type="text" class="form-control form-control-sm" name="last_name"
                                                    id="last_name" value="{{ old('last_name') }}">
                                            </div>
                                            @error('last_name')
                                                <div class="mt-1"><span class="text-danger">{{ $message }}</span></div>
                                            @enderror
                                        </section>
                                    @endif


                                    @if (empty($user->mobile))
                                        <section class="col-12 col-md-6 my-2">
                                            <div class="form-group">
                                                <label for="mobile">موبایل</label>
                                                <input type="text" class="form-control form-control-sm" name="mobile"
                                                    id="mobile" value="{{ old('mobile') }}">
                                            </div>
                                            @error('mobile')
                                                <div class="mt-1"><span class="text-danger">{{ $message }}</span></div>
                                            @enderror
                                        </section>
                                    @endif


                                    @if (empty($user->national_code))
                                        <section class="col-12 col-md-6 my-2">
                                            <div class="form-group">
                                                <label for="national_code">کد ملی</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="national_code" id="national_code"
                                                    value="{{ old('national_code') }}">
                                            </div>
                                            @error('national_code')
                                                <div class="mt-1"><span class="text-danger">{{ $message }}</span></div>
                                            @enderror
                                        </section>
                                    @endif

                                    @if (empty($user->email))
                                        <section class="col-12 col-md-6 my-2">
                                            <div class="form-group">
                                                <label for="email">ایمیل (اختیاری)</label>
                                                <input type="text" class="form-control form-control-sm" name="email"
                                                    id="email" value="{{ old('email') }}">
                                            </div>
                                            @error('email')
                                                <div class="mt-1"><span class="text-danger">{{ $message }}</span></div>
                                            @enderror
                                        </section>
                                    @endif



                                </section>
                            </form>

                            @php
                                $totalProductPrice = 0;
                                $totalProductDiscount = 0;
                            @endphp

                            @foreach ($carts as $item)
                                @php
                                    $totalProductPrice += $item->itemFinalProductPrice();
                                    $totalProductDiscount += $item->itemProductDiscount();
                                @endphp
                            @endforeach

                            <section class="col-3">
                                <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">قیمت کالاها ({{ persianNumber($carts->count()) }})</p>
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
                                            onclick="document.getElementById('profile_completion').submit()">تکمیل فرآیند
                                            خرید</a>
                                    </section>

                                </section>
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
