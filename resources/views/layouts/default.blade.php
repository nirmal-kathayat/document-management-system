<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin Dashboard</title>
  <!-- Favicon icon -->

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  @stack('style')
</head>

<body>
  <div class="main-wrapper flex">
    @include('layouts.sidebar')
    @yield('content')
  </div>


</body>

</html>