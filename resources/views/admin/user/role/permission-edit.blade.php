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
                    <form action="{{ route('admin.user.role.permission-update', $role->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="">عنوان نقش :</label>
                                    <p>{{ $role->name }}</p>
                                </div>
                            </section>

                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="description">توضیح نقش :</label>
                                    <p>{{ $role->description }}</p>
                                </div>
                            </section>

                            <section class="col-12 col-md-2">
                                <button class="btn btn-primary btn-sm mt-md-4">ثبت</button>
                            </section>

                            <section class="col-12 m-2 border-top"></section>

                            <section class="col-md-5 d-flex justify-content-around">

                                @foreach ($permissions as $key => $item)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="permission_id[{{ $item->id }}]"
                                            id="{{ $item->id }}" value="{{ $item->id }}"
                                            {{ is_array($permissionsId) && in_array($item->id, old('permission_id', $permissionsId)) ? 'checked' : '' }}>
                                        <label for="{{ $item->name }}"
                                            class="form-check-label mr-3 mt-1">{{ $item->name }}</label>
                                    </div>
                                @endforeach

                                @error('permission_id')
                                    <div class="mt-1 mx-2">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>
@endsection
