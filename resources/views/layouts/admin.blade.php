<html>
<head>

    <title>@lang('navigation.application_name')</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <script src="//code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
    <script src="/js/jquery.multi-select.js" type="text/javascript"></script>
    <script src="/js/admin-script.js?{{ time() }}"></script>

    <link href="/css/admin-style.css?{{ time() }}" rel="stylesheet">
    <link href="/css/multi-select.css" rel="stylesheet">
    <link href="/css/jquery-ui-bootstrap.css" rel="stylesheet">
</head>
<body>

@include('admin/navbar')
<br><br><br>
@yield('content')

</body>
</html>