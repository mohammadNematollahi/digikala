@extends('admin.layouts.app')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/datePicker/css/persian-datepicker.min.css') }}">

    <title>ایجاد پست</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">پست</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">بروز رسانی پست</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد پست
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.article.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.article.update', $article->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="title">عنوان پست</label>
                                    <input type="text" class="form-control form-control-sm" id="title" name="title"
                                        value="{{ old('title', $article->title) }}">
                                </div>
                                @error('title')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="category_id">انتخاب دسته</label>
                                    <select name="category_id" id="category_id" class="form-control form-control-sm">
                                        <option>دسته را انتخاب کنید</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('category_id', $article->category_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="image">تصویر </label>
                                    <input type="file" class="form-control form-control-sm" name="image"
                                        id="image">
                                </div>
                                <div class="my-1">
                                    <img src="{{ asset($article->image) }}" alt="" width="200px"
                                        height="150px">
                                </div>
                                @error('image')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="published_at">تاریخ انتشار</label>
                                    <input type="hidden" class="alt-field-example-alt-field" name="published_at"
                                        value="{{ old('published_at', $article->published_at) }}" />
                                    <input type="text" class="form-control form-control-sm alt-field-example"
                                        id="published_at" value="{{ old('published_at', $article->published_at) }}">
                                </div>
                                @error('published_at')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="status">وضعیت پخش :</label>
                                    <select class="select2 form-control form-control-sm" id="status" name="status">
                                        <option value="0"
                                            {{ old('status', $article->status) == 0 ? 'selected' : '' }}>غیرفعال</option>
                                        <option value="1"
                                            {{ old('status', $article->status) == 1 ? 'selected' : '' }}>فعال</option>
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
                                    <label for="commentable">امکان درج کامنت :</label>
                                    <select class="select2 form-control form-control-sm" id="status" name="commentable">
                                        <option value="0"
                                            {{ old('commentable', $article->commentable) == 0 ? 'selected' : '' }}>
                                            غیرفعال
                                        </option>
                                        <option value="1"
                                            {{ old('commentable', $article->commentable) == 1 ? 'selected' : '' }}>فعال
                                        </option>
                                    </select>
                                </div>
                                @error('commentable')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="summary">خلاصه نویسی :</label>
                                    <input type="text" class="form-control form-control-sm" id="summary" name="summary"
                                        value="{{ old('summary', $article->summary) }}">
                                </div>
                                @error('summary')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="tags">تگ ها</label>
                                    <input type="hidden" class="form-control form-control-sm" name="tags"
                                        id="tags" value="{{ old('tags', $article->tags) }}">
                                    <select class="select2 form-control form-control-sm" multiple
                                        id="select_tags"></select>
                                </div>
                                @error('tags')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="body">توضیحات</label>
                                    <textarea name="body" id="body" class="form-control form-control-sm" rows="6">{{ old('body', $article->body) }}</textarea>
                                </div>
                                @error('body')
                                    <div class="mt-1">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </section>
                            <button type="submit" class="btn btn-primary btn-sm" id="form">ثبت</button>
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
        CKEDITOR.replace('body');
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

    <script src="{{ asset('admin-assets/datePicker/js/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/datePicker/js/persian-datepicker.min.js') }}"></script>

    <script>
        $('.alt-field-example').persianDatepicker({
            altField: '.alt-field-example-alt-field'
        });
    </script>
@endsection
