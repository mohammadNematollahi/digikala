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
                                    <span>اطلاعات حساب</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->

                        <section class="d-flex justify-content-end my-4">
                            <a class="btn btn-link btn-sm text-info text-decoration-none mx-1" href="{{ route("profile.my-profile.edit") }}"><i
                                    class="fa fa-edit px-1"></i>ویرایش حساب</a>
                        </section>


                        <section class="row">
                            <section class="col-6 border-bottom mb-2 py-2">
                                <section class="field-title">نام</section>
                                <section class="field-value">{{ $user->first_name ??  "--" }}</section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">نام خانوادگی</section>
                                <section class="field-value">{{ $user->last_name ??  "--" }} </section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">شماره تلفن همراه</section>
                                <section class="field-value">{{ $user->phone ??  "--" }}</section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">ایمیل</section>
                                <section class="field-value">{{ $user->email ??  "--"  }}</section>
                            </section>

                            <section class="col-6 my-2 py-2">
                                <section class="field-title">کد ملی</section>
                                <section class="field-value">{{ $user->national_code }}</section>
                            </section>

                            <section class="col-6 my-2 py-2">
                                <section class="field-title">رمز عبور</section>
                                <section class="field-value"> --- </section>
                            </section>

                        </section>




                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection
