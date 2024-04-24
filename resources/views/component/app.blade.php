<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    @include('component.css')
    @include('component.js')
  </head>
  <body>
    @include('component.nav')

    @yield('content')
  </body>
</html>
