<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout.source')
</head>

<body>
    <div id="app">
        <div class="bg-sg"></div>
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
