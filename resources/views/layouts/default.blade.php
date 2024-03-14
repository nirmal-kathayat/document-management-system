<!DOCTYPE html>
<html>
<head>
  <title>Document Management System-@yield('title')</title>
  <link rel="stylesheet" type="text/css" href="{{asset('css/reset.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
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
</body>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
@stack('js')
</html>