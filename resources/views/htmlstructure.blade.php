<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Pannel</title>
    @yield('linkscss')

</head>
<body>
    @yield('navbar')
    @yield('products')
    @yield('body')
    @yield('sidebar')
</body>
@vite('resources/js/app.js')

</html>