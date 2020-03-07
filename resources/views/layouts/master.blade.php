<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')
@include('includes.header')

<body>
    <main class="py-4">
        <div id="app">
            @yield('content')
        </div>
    </main>
</body>

@include('includes.footer')
@include('includes.foot')

</html>