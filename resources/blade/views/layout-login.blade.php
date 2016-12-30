<!DOCTYPE html>
<head>
    <title>{{{ $meta['title'] or '{missing:meta-title}' }}}</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="@yield('header-app-css', '/style/app.css')">

</head>
<body>
  <div class="container">
  @yield('placeholder')
  </div>

  <script type="text/javascript" src="/javascript/jquery.min.js"></script>
  <script type="text/javascript" src="/javascript/app.min.js"></script>
  @yield('lazyload')
</body>
