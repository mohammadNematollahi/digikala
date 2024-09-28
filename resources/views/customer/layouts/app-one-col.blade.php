<html lang="en">

<head>
    @include('customer.layouts.head-tag')
    @yield('head-tag')
</head>

<body>

    @include('customer.layouts.header')

    <main id="main-body-one-col" class="main-body">
        @yield('content')
    </main>

    @include('customer.alert.success')
    @include('customer.alert.toast')
    @include('customer.layouts.footer')

    @stack('script')
    @include('customer.layouts.script')
    @yield('script')

</body>

</html>
