@extends('admin.layouts.app')

@section('head-tag')
    <title> ایجاد روش ارسال</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">روش های ارسال</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد روش ارسال</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد روش ارسال
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.delivery.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.delivery.store') }}" method="POST">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name">نام روش ارسال</label>
                                    <input type="text" class="form-control form-control-sm" id="name"
                                        name="name" value="{{ old("name") }}">
                                </div>
                                @error('name')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="amount">هزینه روش ارسال</label>
                                    <input type="text" id="amount" name="amount"
                                        class="form-control form-control-sm" value="{{ old("amount") }}">
                                </div>
                                @error('amount')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="delivery_time">زمان ارسال</label>
                                    <input type="text" class="form-control form-control-sm" id="delivery_time"
                                        name="delivery_time" value="{{ old("delivery_time") }}">
                                </div>
                                @error('delivery_time')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="delivery_time_unit">واحد زمان ارسال</label>
                                    <input type="text" class="form-control form-control-sm" id="delivery_time_unit"
                                        name="delivery_time_unit" value="{{ old("delivery_time_unit") }}">
                                </div>
                                @error('delivery_time_unit')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12">
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
