@extends('admin.layouts.app')

@section('head-tag')
    <title>بروز رسانی اطلاعیه پیامکی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/datePicker/css/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">اطلاعیه پیامکی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> بروز رسانی اطلاعیه پیامکی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        بروز رسانی اطلاعیه پیامکی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.notify.sms.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.notify.sms.update' , $SMS->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="title">عنوان پیامک</label>
                                    <input type="text" class="form-control form-control-sm" name="title"
                                        value="{{ old('title' , $SMS->title) }}" id="title">
                                </div>
                                @error('title')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="status">وضعیت پخش :</label>
                                    <select class="select2 form-control form-control-sm" id="status" name="status">
                                        <option value="0" {{ old('status' , $SMS->status) == 0 ? 'selected' : '' }}>غیرفعال</option>
                                        <option value="1" {{ old('status' , $SMS->status) == 1 ? 'selected' : '' }}>فعال</option>
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
                                    <label for="published_at">تاریخ انتشار</label>
                                    <input type="hidden" id="publishde_at" class="alt-field-example-alt-field"
                                        name="published_at" />
                                    <input type="text" class="form-control form-control-sm alt-field-example"
                                        id="published_at" value="{{ old('published_at' , $SMS->published_at) }}">
                                </div>
                                @error('published_at')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="body">متن پیامک</label>
                                    <textarea name="body" id="body" class="form-control form-control-sm" rows="6">{{ old('body' , $SMS->body) }}</textarea>
                                </div>
                                @error('body')
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
        $('.alt-field-example').persianDatepicker({
            altField: '.alt-field-example-alt-field',
            timePicker: {
                enabled: true,
                meridiem: {
                    enabled: true
                }
            }
        });
    </script>
@endsection
