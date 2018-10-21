<html>
<head>

    @include('partials/defaultHead')

</head>
<body>

    @include('partials/defaultNavigation')

    @yield('content')

    @include('partials/footer')

    @include('partials/footerScripts')

</body>
</html>