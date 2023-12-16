<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout.source')
</head>

<body>
    <div id="app">
        @include('frontend.layout.header')
        <section>
            @yield('content')
        </section>
        @include('frontend.layout.footer')
    </div>
    @yield('js')
    @stack('jscustom')
</body>

</html>
