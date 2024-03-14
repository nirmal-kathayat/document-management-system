<!DOCTYPE html>
<html>
<head>
  <title>Document Management System-@yield('title')</title>
  <link rel="stylesheet" type="text/css" href="{{asset('css/reset.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
  
  @stack('style')
</head>
<body>
    <main class="main-section">
        @include('layouts.sidebar')
        <div class="main-content">
            @include('layouts.header')
            <div class="main-section-content">
                <div class="container">
                  @yield('content')
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
    @include('scripts.message')
    @stack('js')
</body>
</html>