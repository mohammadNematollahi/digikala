<html lang="en">
<head>
    @include('admin.layouts.head-tag')
    @yield('head-tag')
</head>
<body>

    @include('admin.layouts.header')

    <section class="body-container">

        @include('admin.layouts.sidebar')


        <section id="main-body" class="main-body">

            @yield('content')

        </section>
    </section>

    
    @include('admin.alert.delete')
    @include('admin.alert.success')
    @include('admin.alert.error')
    @stack('script')
    
    @include('admin.layouts.script')
    @yield('script')

    
</body>
</html>