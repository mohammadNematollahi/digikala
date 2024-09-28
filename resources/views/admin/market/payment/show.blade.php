@extends('admin.layouts.app')

@section('head-tag')
    <title>نمایش پرداخت</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">پرداخت ها</li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">نمایش پرداخت</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش پرداخت
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ url()->previous() }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                        {{ $payment->user->first_name . ' ' . $payment->user->last_name }} - {{ $payment->user_id }}
                    </section>
                    <section class="card-body d-flex justify-content-around align-items-center">
                        <div>
                            <span class="text-info"><b>کد تراکنش :</b></span>
                            <p>{{ $payment->paymentable->transaction_id ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-info"><b>بانک :</b></span>
                            <p>{{ $payment->paymentable->gateway ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-info"><b>به حساب :</b></span>
                            <p>{{ $payment->paymentable->cash_receiver ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-info"><b>وضعیت پرداخت :</b></span>
                            <p>
                                @if ($payment->status == 0)
                                    پرداخت نشده
                                @elseif($payment->status == 1)
                                    پرداخت شده
                                @elseif($payment->status == 2)
                                    باطل شده
                                @else
                                    بازگشت داده شده
                                @endif
                            </p>
                        </div>
                        <div>
                            <span class="text-info"><b>نوع پرداخت :</b></span>
                            <p>
                                @if ($payment->type == 0)
                                    آنلاین
                                @elseif($payment->type == 1)
                                    آفلاین
                                @else
                                    درب منزل
                                @endif
                            </p>
                        </div>
                        <div>
                            <span class="text-info"><b>مبلغ پرداختی :</b></span>
                            <p>{{ $payment->amount ?? '-' }}</p>
                        </div>
                    </section>
                </section>

            </section>
        </section>
    </section>
@endsection
