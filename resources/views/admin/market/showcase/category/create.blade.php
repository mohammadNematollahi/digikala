@extends('admin.layouts.app')

@section('head-tag')
<link rel="stylesheet" href="{{ asset('admin-assets/select2/css/select2.min.css') }}">

    <title>دسته بندی</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">دسته بندی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد دسته بندی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد دسته بندی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.showcase.category.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.showcase.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name">نام دسته</label>
                                    <input type="text" class="form-control form-control-sm" name="name" id="name"
                                        value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="parent_id">منو والد</label>
                                    <select name="parent_id" id="parent_id" class="form-control form-control-sm">
                                        <option value="">دسته را انتخاب کنید</option>
                                        @foreach ($parent_menus as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('parent_id') == 0 ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('parent_id')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="tags">تگ ها</label>
                                    <input type="hidden" class="form-control form-control-sm" name="tags" id="tags"
                                        value="{{ old('tags') }}">
                                    <select class="select2 form-control form-control-sm" multiple id="select_tags"></select>
                                </div>
                                @error('tags')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="status">وضعیت پخش :</label>
                                    <select class="select2 form-control form-control-sm" id="status" name="status">
                                        <option value="0" {{old("status") == 0 ? "selected" : ""}}>غیرفعال</option>
                                        <option value="1" {{old("status") == 1 ? "selected" : ""}}>فعال</option>
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
                                    <label for="image">عکس :</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                                @error('image')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="show_in_menu">وضعیت نمایش در منو :</label>
                                    <select class="select2 form-control form-control-sm" id="show_in_menu" name="show_in_menu">
                                        <option value="0" {{old("show_in_menu") == 0 ? "selected" : ""}}>غیرفعال</option>
                                        <option value="1" {{old("show_in_menu") == 1 ? "selected" : ""}}>فعال</option>
                                    </select>
                                </div>
                                @error('show_in_menu')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="description">توضیحات :</label>
                                    <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
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
    </section>
@endsection


@section('script')
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description');
    </script>

    <script src="{{ asset('admin-assets/select2/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var tags_input = $('#tags');
            var select_tags = $('#select_tags');
            var default_tags = tags_input.val();
            var default_data = null;

            if (tags_input.val() !== null && tags_input.val().length > 0) {
                default_data = default_tags.split(',');
            }

            select_tags.select2({
                tags: true,
                data: default_data
            });
            select_tags.children('option').attr('selected', true).trigger('change');


            $("#form").click(function(event) {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    var selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource)
                }
            })
        })
    </script>
@endsection