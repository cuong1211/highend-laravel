<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout.source')
</head>

<body>
    @include('frontend.layout.header')
    <section>
        @yield('content')
    </section>
    @include('frontend.layout.footer')
    @yield('js')
    @stack('jscustom')
</body>

</html>
