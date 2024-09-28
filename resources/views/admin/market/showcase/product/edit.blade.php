@extends('admin.layouts.app')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/datePicker/css/persian-datepicker.min.css') }}">
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
                    <a href="{{ route('admin.market.showcase.product.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <form action="{{ route('admin.market.showcase.product.update', $product->slug) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name">نام کالا</label>
                                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                    class="form-control form-control-sm">
                            </div>
                            @error('name')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="category_id">انتخاب دسته</label>
                                <select name="category_id" id="" class="form-control form-control-sm">
                                    <option value="">دسته را انتخاب کنید</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            @if (old('category_id', $product->category_id) == $item->id) selected @endif>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            @error('category_id')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="brand_id">انتخاب برند</label>
                                <select name="brand_id" id="" class="form-control form-control-sm">
                                    <option value="">دسته را انتخاب کنید</option>
                                    @foreach ($brands as $item)
                                        <option value="{{ $item->id }}"
                                            @if (old('brand_id', $product->brand_id) == $item->id) selected @endif>
                                            {{ $item->original_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('brand_id')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="image">تصویر </label>
                                <input type="file" name="image" class="form-control form-control-sm">
                            </div>
                            <div class="my-1">
                                <img src="{{ asset($product->image) }}" alt="" width="150px" height="150px">
                            </div>
                            @error('image')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="weight">وزن</label>
                                <input type="text" name="weight" value="{{ old('weight', $product->weight) }}"
                                    class="form-control form-control-sm">
                            </div>
                            @error('weight')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="length">طول</label>
                                <input type="text" name="length" value="{{ old('length', $product->length) }}"
                                    class="form-control form-control-sm">
                            </div>
                            @error('length')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="width">عرض</label>
                                <input type="text" name="width" value="{{ old('width', $product->width) }}"
                                    class="form-control form-control-sm">
                            </div>
                            @error('width')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="height">ارتفاع</label>
                                <input type="text" name="height" value="{{ old('height', $product->height) }}"
                                    class="form-control form-control-sm">
                            </div>
                            @error('height')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>


                        <section class="col-12">
                            <div class="form-group">
                                <label for="price">قیمت کالا</label>
                                <input type="text" name="price" value="{{ old('price', $product->price) }}"
                                    class="form-control form-control-sm">
                            </div>
                            @error('price')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="introduction">توضیحات</label>
                                <textarea name="introduction" id="introduction" class="form-control form-control-sm" rows="6">{{ old('introduction', $product->introduction) }}</textarea>
                            </div>
                            @error('introduction')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="" class="form-control form-control-sm"
                                    id="status">
                                    <option value="0" @if (old('status', $product->status) == 0) selected @endif>غیرفعال
                                    </option>
                                    <option value="1" @if (old('status', $product->status) == 1) selected @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="marketable">قابل فروش بودن</label>
                                <select name="marketable" id="" class="form-control form-control-sm"
                                    id="marketable">
                                    <option value="0" @if (old('marketable', $product->marketable) == 0) selected @endif>غیرفعال
                                    </option>
                                    <option value="1" @if (old('marketable', $product->marketable) == 1) selected @endif>فعال</option>
                                </select>
                            </div>
                            @error('marketable')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="tags">تگ ها</label>
                                <input type="hidden" class="form-control form-control-sm" name="tags" id="tags"
                                    value="{{ old('tags', $product->tags) }}">
                                <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                </select>
                            </div>
                            @error('tags')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="published_at">تاریخ انتشار</label>
                                <input type="hidden" class="alt-field-example-alt-field" name="published_at"
                                    value="{{ old('published_at', $product->published_at) }}" />
                                <input type="text" class="form-control form-control-sm alt-field-example"
                                    id="published_at">
                            </div>
                            @error('published_at')
                                <div class="mt-1">
                                    <p class="text-danger">{{ $message }}</p>
                                </div>
                            @enderror
                        </section>


                        <section class="col-12 border-top border-bottom py-3 mb-3">


                            @foreach ($product->productMeta as $item)
                                <section class="row">
                                    <section class="col-6 col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="meta_key[{{ $item->id }}]"
                                                class="form-control form-control-sm" placeholder="ویژگی ..."
                                                value="{{ old("meta_key[$item->id]", $item->product_key) }}">
                                        </div>
                                    </section>

                                    <section class="col-6 col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="meta_value[{{ $item->id }}]"
                                                class="form-control form-control-sm" placeholder="مقدار ..."
                                                value="{{ old("meta_value[$item->id]", $item->product_value) }}">
                                        </div>
                                    </section>

                                </section>
                            @endforeach


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

@section('script')
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('introduction');
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
