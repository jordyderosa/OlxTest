<!DOCTYPE html>
<html>
  <head>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Upload File Page</title>
  </head>
  <body>
      <div class="container">
          @yield('content')
      </div>
  </body>
</html>
