@extends('admin.layouts.app')

@section('head-tag')
    <title>ایجاد کوپن تخفیف</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/datePicker/css/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">برند</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کوپن تخفیف</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد کوپن تخفیف
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.discount.copan.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.copan.store') }}" method="POST">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="code">کد کوپن</label>
                                    <input type="text" class="form-control form-control-sm" id="code"
                                        name="code" value="{{old("code")}}">
                                </div>
                                @error('code')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="type">نوع کوپن</label>
                                    <select name="type" id="type" class="form-control form-control-sm">
                                        <option value="0" {{ old('type') == 1 ? 'selected' : '' }}>عمومی</option>
                                        <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>خصوصی</option>
                                    </select>
                                </div>
                                @error('type')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="amount">مقدار تخفیف :</label>
                                    <input type="text" class="form-control form-control-sm" id="amount"
                                        name="amount" value="{{old("amount")}}">
                                </div>
                                @error('amount')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="amount_type">نوع اندازه گیری تخفیف :</label>
                                    <select name="amount_type" id="amount_type" class="form-control form-control-sm">
                                        <option value="0" {{ old('amount_type') == 0 ? 'selected' : '' }}>درصد</option>
                                        <option value="1" {{ old('amount_type') == 1 ? 'selected' : '' }}>تومان</option>
                                    </select>
                                </div>
                                @error('amount_type')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="discount_ceiling">حداکثر تخفیف</label>
                                    <input type="text" class="form-control form-control-sm" id="discount_ceiling"
                                        name="discount_ceiling" value="{{old("discount_ceiling")}}">
                                </div>
                                @error('discount_ceiling')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="user_id">کاربر :</label>
                                    <select name="user_id" id="user_id" class="form-control form-control-sm">
                                        <option value="">اگر کپن شما خصوصی بود یکی از این گزینه های را انتخاب کنید</option>
                                        @foreach ($users as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('user_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->id . ' : ' . $item->first_name . ' ' . $item->last_name ?? $item->id . ' : ' . $item->mobile }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('user_id')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="status">وضعیت پخش :</label>
                                    <select class="select2 form-control form-control-sm" id="status" name="status">
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>غیرفعال</option>
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>فعال</option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="start-date-view">تاریخ شروع</label>
                                    <input type="hidden" name="start_date" id="start-date" class="form-control">
                                    <input type="text" class="form-control form-control-sm" id="start-date-view"
                                        value="{{ old('start_date') }}">
                                </div>
                                @error('start_date')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="end-date-view">تاریخ پایان</label>
                                    <input type="hidden" name="end_date" id="end-date" class="form-control">
                                    <input type="text" class="form-control form-control-sm" id="end-date-view"
                                        value="{{ old('end_date') }}">
                                </div>
                                @error('end_date')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>


                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>
@endsection

@section('script')
    <script src="{{ asset('admin-assets/datePicker/js/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/datePicker/js/persian-datepicker.min.js') }}"></script>

    <script>
        $('#start-date-view').persianDatepicker({
            altField: '#start-date',
            timePicker: {
                enabled: true,
                meridiem: {
                    enabled: true
                }
            }
        });

        $('#end-date-view').persianDatepicker({
            altField: '#end-date',
            timePicker: {
                enabled: true,
                meridiem: {
                    enabled: true
                }
            }
        });
    </script>
@endsection
