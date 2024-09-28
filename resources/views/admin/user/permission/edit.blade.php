@extends('admin.layouts.app')

@section('head-tag')
    <title>بروز رسانی ذسترسی</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">نقش ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> بروزرسانی دسترسی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        بروزرسانی دسترسی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.permissions.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.permissions.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="name">عنوان نقش</label>
                                    <input type="text" class="form-control form-control-sm" name="name" id="name"
                                        value="{{ old('name', $permission->name) }}">
                                </div>
                            </section>

                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="description">توضیح نقش</label>
                                    <input type="text" class="form-control form-control-sm" id="description"
                                        name="description" value="{{ old('description', $permission->description) }}">
                                </div>
                            </section>

                            <section class="col-12 col-md-2">
                                <button class="btn btn-primary btn-sm mt-md-4">ثبت</button>
                            </section>

                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>
@endsection
