@extends('admin.layouts.app')

@section('head-tag')
    <title>کالاها</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کالاها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        کالاها
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.showcase.product-gallery.create', $product->slug) }}"
                        class="btn btn-info btn-sm">ایجاد کالای
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
                                <th>عکس</th>
                                <th>محصول</th>
                                <th class="max-width-16-rem text-right"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $id = 1;
                            @endphp

                            @foreach ($product->productGallery as $item)
                                <tr>
                                    <th>{{ $id }}</th>
                                    <td>
                                        <div>
                                            <img src="{{ asset($item->image) }}" alt="" width="100px"
                                                height="100px">
                                        </div>
                                    </td>
                                    <td>{{ $item->product->name }}</td>
                                    <td class="width-16-rem text-left">
                                        <form class="d-inline"
                                            action="{{ route('admin.market.showcase.product-gallery.destroy', [$item->id]) }}"
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
