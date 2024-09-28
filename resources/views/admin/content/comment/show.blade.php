@extends('admin.layouts.app')

@section('head-tag')
    <title>نمایش نظر ها</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> نظرات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش نظر ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش نظر
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.comment.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                        {{$comment->user->first_name . " " . $comment->user->last_name}} - {{$comment->author_id}}
                    </section>
                    <section class="card-body">
                        <h5 class="card-title">عنوان پست : {{$comment->commentable->title}}</h5>
                        <p class="card-text">{{$comment->body}}</p>
                    </section>
                </section>

                <section>
                    <form action="{{route("admin.content.comment.response" , $comment->id)}}" method="POST">
                        @csrf
                        @method('post')
                        <section class="row">
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="body">پاسخ ادمین</label>
                                    <textarea class="form-control form-control-sm" rows="4" name="body" id="body"></textarea>
                                </div>
                                @error('body')
                                    <div class="mt-1">
                                        <p class="text-danger">{{$message}}</p>
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
