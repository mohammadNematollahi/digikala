@extends('admin.layouts.app')

@section('head-tag')
    <title>ایجاد کالا</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> گارانتی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        گارانتی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.showcase.warranty.index', $product->slug) }}"
                        class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <form action="{{ route('admin.market.showcase.warranty.store', $product->slug) }}" method="POST">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name">گارانتی :</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control form-control-sm">
                            </div>
                            @error('name')
                                <span class="mt-1" role="alert">
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="price_increase">میزان افزایش قیمت :</label>
                                <input type="text" name="price_increase" value="{{ old('price_increase') }}"
                                    class="form-control form-control-sm">
                            </div>
                            @error('price_increase')
                                <span class="mt-1" role="alert">
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                </span>
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
@endsection
