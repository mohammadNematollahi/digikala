@extends('admin.layouts.app')

@section('head-tag')
    <title>افزودن به فروش شگفت انگیز</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/datePicker/css/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">برند</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">افزودن به فروش شگفت انگیز</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        افزودن به فروش شگفت انگیز
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.discount.amazing-sale.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.amazing-sale.store') }}" method="POST">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="product_id">نام کالا :</label>
                                    <select class="select2 form-control form-control-sm" id="product_id" name="product_id">
                                        <option value="">انتخاب کنید</option>
                                        @foreach ($products as $item)
                                            <option value="{{$item->id}}" {{ old('product_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->id . ' ' . $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('product_id')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="percentage">درصد تخفیف</label>
                                    <input type="text" class="form-control form-control-sm" id="percentage"
                                        name="percentage" value="{{old("percentage")}}">
                                </div>
                                @error('percentage')
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
                                    <input type="hidden" name="start_date" id="start-date" class="form-control" value="{{ old('start_date') }}">
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
                                    <input type="hidden" name="end_date" id="end-date" class="form-control" value="{{ old('end_date') }}">
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
