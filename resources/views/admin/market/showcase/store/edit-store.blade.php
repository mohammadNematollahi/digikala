@extends('admin.layouts.app')

@section('head-tag')
    <title>اضافه کردن به انبار</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">انبار</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> اضافه کردن به انبار</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        اضافه کردن به انبار
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.showcase.store.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.showcase.store.edit-store.updateStore', $product->slug) }}"
                        method="POST">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="marketable_number">اصلاح تعداد در انبار :</label>
                                    <input type="text" class="form-control form-control-sm" id="marketable_number"
                                        name="marketable_number" value="{{ old('marketable_number'  , $product->marketable_number) }}">
                                </div>
                                @error('marketable_number')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="sold_number">تعداد فروخته شده :</label>
                                    <input type="text" class="form-control form-control-sm" id="sold_number"
                                        name="sold_number" value="{{ old('sold_number' , $product->sold_number) }}">
                                </div>
                                @error('sold_number')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="frozen_number">تعداد رزو شده :</label>
                                    <input type="text" class="form-control form-control-sm" id="frozen_number"
                                        name="frozen_number" value="{{ old('frozen_number' , $product->frozen_number) }}">
                                </div>
                                @error('frozen_number')
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
