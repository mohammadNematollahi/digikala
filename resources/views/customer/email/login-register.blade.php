@extends('customer.layouts.app-simple')

@section('content')
    <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
        <section class="login-wrapper mb-5">
            <section class="login-logo">
                <img src="{{asset("customer-assets/images/logo/4.png")}}" alt="">
            </section>
            <section class="login-title">ورود / ثبت نام</section>
            <section class="login-info">کد شما برای ورود</section>
            <section class="login-input-text">
                <p class="text-center"><b>{{ $details['otp'] }}</b></p>
            </section>
        </section>
    </section>
@endsection
