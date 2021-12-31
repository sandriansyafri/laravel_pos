
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | @yield('title')</title>
  @include('layouts.auth.part.style')
</head>
<body class="hold-transition register-page">
  @yield('content')
@include('layouts.auth.part.script')
</body>
</html>
