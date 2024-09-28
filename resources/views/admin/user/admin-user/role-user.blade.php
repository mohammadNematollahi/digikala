@extends('admin.layouts.app')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/select2/css/select2.min.css') }}">
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

                <section class="d-flex justify-content-between align-items-center mt-4 ">
                    <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.admin-user.role-user.store' , $user->id) }}" method="POST">
                        @csrf
                        <section class="row">

                            <section class="col-12">
                                <section class="row border-top mt-3 py-3">

                                    <section class="col-12">
                                        <div class="form-group">
                                            <label for="role">نقش ها</label>
                                            <select class="select2 form-control form-control-sm" name="role_id[]" multiple
                                                id="select_role" dir="rtl">
                                                @foreach ($roles as $item)
                                                    <option value="{{ $item->id }}"
                                                        @foreach ($user->roles as $role)
                                                            @if ($item->id == $role->id)
                                                                selected
                                                            @endif @endforeach>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('role_id')
                                            <div class="mt-1 mx-2">
                                                <p class="text-danger">{{ $message }}</p>
                                            </div>
                                        @enderror
                                    </section>

                                </section>
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


@section('script')
    <script src="{{ asset('admin-assets/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#select_role').select2();
        });
    </script>
@endsection
