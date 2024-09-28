@extends('customer.layouts.app-simple')

@section('content')
    <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
        <section class="login-wrapper mb-5">
            <section class="login-logo">
                <img src="{{ asset('customer-assets/images/logo/4.png') }}" alt="">
            </section>
            <section>
                <a href="{{ route('customer.login-register') }}" class="text-decoration-none"><i class="fa fa-angle-right"></i>
                    بازگشت </a>
            </section>
            <section class="login-title text-center">ورود / ثبت نام</section>
            <section class="login-info text-center">کد ارسال شده به {{ $token->input }} را وارد کنید</section>

            <form action="{{ route('customer.check.code.login-register') }}" method="POST">
                @csrf
                <section class="login-input-text">
                    <input type="text" class="text-center" name="otp_code">

                    @error('otp_code')
                        <div class="my-1">
                            <p class="text-danger">{{ $message }}</p>
                        </div>
                    @enderror

                </section>
                <button class="login-btn d-grid g-2 btn btn-danger col-12" type="submit">ارسال</button>
            </form>

            <section>
                <a href="{{ route("customer.new.code.login-register" , $token->id) }}" id="send-code" class="text-decoration-none d-none">ارسال مجدد کد</a>
                <span id="timer" class=""></span>
            </section>

        </section>
    </section>
@endsection

@section('script')
    @php
        $timer =
            ($token->created_at->getTimeStamp() - Illuminate\Support\Carbon::now()->subMinutes(5)->getTimeStamp()) *
            1000;
    @endphp

    <script>
        diff_time = new Date().getTime() + {{ $timer }};

        let x = setInterval(() => {

            let now = new Date().getTime();

            real_time = diff_time - now;

            var minutes = Math.floor((real_time % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((real_time % (1000 * 60)) / 1000);

            if (minutes == 0) {
                $("#timer").text('ارسال مجدد کد تایید تا ' + seconds);
            } else {
                $("#timer").text('ارسال مجدد کد تایید تا ' + minutes + ":" + seconds);
            }

            if (real_time <= 0) {
                clearInterval(x);
                $("#timer").addClass("d-none");
                $("#send-code").removeClass("d-none");
            }

        }, 1000);
    </script>

@endsection
