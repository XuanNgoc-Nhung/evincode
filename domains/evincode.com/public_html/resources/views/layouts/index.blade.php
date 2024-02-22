<!doctype html>
<html lang="vi">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Tuanxinh.com">
    <base>
    @include('layouts.css')
    @yield('title')

</head>
<link rel="stylesheet" href="https://tuanxinh.com/css/style.css">
<body>
<div id="app" class="flex-wrapper">
    @include('layouts.header')
</div>
</body>
<main>
    <div class="body-main">
        @yield('content')
    </div>
</main>
@include('layouts.footer')
@include('layouts.js')
</html>
