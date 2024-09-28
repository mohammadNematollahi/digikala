@extends('admin.layouts.app')

@section('head-tag')
    <title>ایجاد نقش</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">نقش ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد نقش</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد نقش
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.role.store') }}" method="POST">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="name">عنوان نقش</label>
                                    <input type="text" class="form-control form-control-sm" name="name" id="name"
                                        value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="description">توضیح نقش</label>
                                    <input type="text" class="form-control form-control-sm" id="description"
                                        name="description" value="{{ old('description') }}">
                                </div>
                                @error('description')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-2">
                                <button class="btn btn-primary btn-sm mt-md-4">ثبت</button>
                            </section>

                            <section class="col-12">
                                <section class="row border-top mt-3 py-3">

                                    <section class="col-md-4 d-flex justify-content-around">
                                        @foreach ($permissions as $item)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    name="permission_id[{{ $item->id }}]" id="{{ $item->name }}"
                                                    value="{{ $item->id }}"
                                                    @if (is_array(old('permission_id')) && in_array($item->id, old('permission_id'))) checked @endif>
                                                <label for="{{ $item->name }}"
                                                    class="form-check-label mr-3 mt-1">{{ $item->name }}</label>
                                            </div>
                                        @endforeach
                                    </section>

                                    @error('permission_id')
                                        <div class="mt-1 mx-2">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror

                                </section>
                            </section>

                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>
@endsection
