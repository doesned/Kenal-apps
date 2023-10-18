<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>@yield('title')</title>
  </head>
  @yield('css')
<body class="bg-gray-100 p-6">
    @yield('content')
    @yield('js')
</body>
</html>