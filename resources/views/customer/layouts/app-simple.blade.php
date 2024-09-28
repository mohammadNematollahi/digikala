<html lang="en">
<head>
    @include('customer.layouts.head-tag')
    @yield('head-tag')
</head>
<body>


    <main id="main-body-one-col" class="main-body">
        @yield('content')
    </main>

    @stack('script')
    @include('customer.layouts.script')
    @yield('script')
    
</body>
</html>