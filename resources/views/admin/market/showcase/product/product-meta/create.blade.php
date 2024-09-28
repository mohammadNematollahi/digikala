@extends('admin.layouts.app')

@section('head-tag')
    <title>ایجاد کالا</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">کالا </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کالا</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد کالا
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.showcase.product-meta.index' , $product->slug) }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <form action="{{ route('admin.market.showcase.product-meta.store' , $product->slug) }}" method="POST">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="product_key">قابلیت</label>
                                <input type="text" name="product_key" value="{{ old('product_key') }}"
                                    class="form-control form-control-sm">
                            </div>
                            @error('product_key')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="product_value">نام کالا</label>
                                <input type="text" name="product_value" value="{{ old('product_value') }}"
                                    class="form-control form-control-sm">
                            </div>
                            @error('product_value')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <button class="btn btn-primary btn-sm" id="form">ثبت</button>
                        </section>
                    </section>
                </form>

            </section>
        </section>
    </section>
@endsection