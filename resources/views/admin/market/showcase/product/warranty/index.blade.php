@extends('admin.layouts.app')

@section('head-tag')
    <title>گارانتی</title>
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
                    <a href="{{ route('admin.market.showcase.warranty.create', $product->slug) }}"
                        class="btn btn-info btn-sm">ایجاد گارانتی
                        جدید </a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.showcase.product.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>افزایش قیمت</th>
                                <th>محصول</th>
                                <th class="max-width-16-rem text-right"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $id = 1;
                            @endphp

                            @foreach ($product->warranties as $item)
                                <tr>
                                    <th>{{ $id }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->price_increase }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td class="width-16-rem text-left">
                                        <a href="{{ route('admin.market.showcase.warranty.edit', [$product->slug, $item->id]) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                        <form class="d-inline"
                                            action="{{ route('admin.market.showcase.warranty.destroy', [$product->slug, $item->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>
                                                حذف</button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $id++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </section>

            </section>
        </section>
    </section>
@endsection
