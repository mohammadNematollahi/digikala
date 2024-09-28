@extends('customer.layouts.app-simple')

@section('content')
    <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
        <section class="login-wrapper mb-5">
            <section class="login-logo">
                <img src="{{ asset('customer-assets/images/logo/4.png') }}" alt="">
            </section>
            <section class="login-title">ورود / ثبت نام</section>
            <section class="login-info">شماره موبایل یا پست الکترونیک خود را وارد کنید</section>

            <form action="{{ route('customer.create.otp.login-register') }}" method="POST">
                @csrf
                <section class="login-input-text">
                    <input type="text" name="input">

                    @error('input')
                        <div class="my-1">
                            <p class="text-danger">{{ $message }}</p>
                        </div>
                    @enderror

                </section>
                <button class="login-btn d-grid g-2 btn btn-danger col-12" type="submit">ورود به آمازون</button>
            </form>

            <section class="login-terms-and-conditions"><a href="#">شرایط و قوانین</a> را خوانده ام و پذیرفته ام
            </section>
        </section>
    </section>
@endsection
