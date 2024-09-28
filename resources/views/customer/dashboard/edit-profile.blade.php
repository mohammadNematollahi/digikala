@extends('customer.layouts.app-one-col')

@section('content')
    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">

                @include('customer.layouts.parties.profile-sidebar')

                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <!-- start vontent header -->
                        <section class="content-header mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>بروز رسانی اطلاعات حساب</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->

                        <section class="d-flex justify-content-end my-4">
                            <a class="btn btn-link btn-sm text-info text-decoration-none mx-1" href="{{  url()->previous()  }}"><i
                                    class="fa fa-edit px-1"></i>بازگشت</a>
                        </section>


                        <form action="{{ route("profile.my-profile.update") }}" method="POST">
                            @csrf
                            @method('put')
                            <section class="row">
                                <section class="col-6 border-bottom mb-2 py-2">
                                    <section class="field-title">نام</section>
                                    <input class="form-control border-0 border-bottom" name="first_name" value="{{ old( "first_name" , $user->first_name) }}"></input>

                                    @error('first_name')
                                        <div class="col-12">
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </section>

                                <section class="col-6 border-bottom my-2 py-2">
                                    <section class="field-title">نام خانوادگی</section>
                                    <input class="form-control border-0 border-bottom" name="last_name" value="{{ old( "last_name" , $user->last_name) }}"></input>
                                    @error('last_name')
                                        <div class="col-12">
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </section>

                                <section class="col-6 border-bottom my-2 py-2">
                                    <section class="field-title">شماره تلفن همراه</section>
                                    <input class="form-control border-0 border-bottom" name="phone" value="{{ old( "phone" , $user->phone) }}"></input>
                                    @error('phone')
                                        <div class="col-12">
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </section>

                                <section class="col-6 border-bottom my-2 py-2">
                                    <section class="field-title">ایمیل</section>
                                    <input class="form-control border-0 border-bottom" name="email" value="{{ old( "email" , $user->email) }}"></input>
                                    @error('email')
                                        <div class="col-12">
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </section>

                                <section class="col-6 my-2 py-2">
                                    <section class="field-title">کد ملی</section>
                                    <input class="form-control border-0 border-bottom" name="national_code" value="{{ old( "national_code" , $user->national_code) }}"></input>
                                    @error('national_code')
                                    <div class="col-12">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                                </section>

                            </section>
                            <button class="btn-sm btn-success border-0">بروز رسانی اطلاعات</button>
                        </form>




                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection
