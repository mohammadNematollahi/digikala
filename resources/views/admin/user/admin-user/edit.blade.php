@extends('admin.layouts.app')

@section('head-tag')
    <title>ایجاد کاربر ادمین</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">کاربران ادمین</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کاربر ادمین</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد کاربر ادمین
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.admin-user.update' , $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name">نام</label>
                                    <input type="text" class="form-control form-control-sm" name="first_name"
                                        id="name" value="{{ old('first_name', $user->first_name) }}">
                                </div>
                                @error('first_name')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="last_name">نام خانوادگی</label>
                                    <input type="text" class="form-control form-control-sm" name="last_name"
                                        id="last_name" value="{{ old('last_name', $user->last_name) }}">
                                </div>
                                @error('last_name')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="email">ایمیل</label>
                                    <input type="text" class="form-control form-control-sm" id="email" name="email"
                                        value="{{ old('email', $user->email) }}">
                                </div>
                                @error('email')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="mobile"> شماره موبایل</label>
                                    <input type="text" class="form-control form-control-sm" id="mobile" name="mobile"
                                        value="{{ old('mobile', $user->mobile) }}">
                                </div>
                                @error('mobile')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="national_code">کد ملی :</label>
                                    <input type="text" class="form-control form-control-sm" id="national_code"
                                        name="national_code" value="{{ old('national_code', $user->national_code) }}">
                                </div>
                                @error('national_code')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="password">کلمه عبور</label>
                                    <input type="password" class="form-control form-control-sm" id="password"
                                        name="password">
                                </div>
                                @error('password')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="confirm_password">تکرار کلمه عبور</label>
                                    <input type="password" class="form-control form-control-sm" id="confirm_password"
                                        name="confirm_password">
                                </div>
                                @error('confirm_password')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="avatar">پروفایل</label>
                                    <input type="file" class="form-control form-control-sm" id="avatar"
                                        name="avatar">
                                </div>
                                <div class="my-2">
                                    <img src="{{ asset($user->avatar) }}" alt="">
                                </div>
                                @error('avatar')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="status">وضعیت کاربر :</label>
                                    <select class="select2 form-control form-control-sm" id="status" name="status">
                                        <option value="0"
                                            {{ old('status', $user->status) == 0 ? 'selected' : '' }}>غیرفعال</option>
                                        <option value="1"
                                            {{ old('status', $user->status) == 1 ? 'selected' : '' }}>فعال</option>
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
                                    <label for="activation">فعال سازی کاربر :</label>
                                    <select class="select2 form-control form-control-sm" id="activation"
                                        name="activation">
                                        <option value="0"
                                            {{ old('activation', $user->activation) == 0 ? 'selected' : '' }}>غیرفعال
                                        </option>
                                        <option value="1"
                                            {{ old('activation', $user->activation) == 1 ? 'selected' : '' }}>فعال
                                        </option>
                                    </select>
                                </div>
                                @error('activation')
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
