<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <title>Admin</title>
</head>

<body>
  <section>
    <div class="login-form">
      <div class="logo">
        <img src="{{ asset('images/logo.svg') }}" style="width: 300px; height: 120px;" alt="logo">
        <h1>Document Management System</h1>
      </div>

      <form action="{{route('loginProcess')}}" method="post">
        @csrf
        <div class="form-container">
          <div class="name-input">
            <label for="username">Username</label>
            <input type="text" class="form-input-1" name="username" id="username">
          </div>
          @error('username')
          <span class="validation-error">
            {{$message}}
          </span>
          @enderror

          <div class="pass-input">
            <label for="password">Password</label>
            <input type="password" class="form-input-2" name="password" id="password">
          </div>

          @error('password')
          <span class="validation-error">
            {{$message}}
          </span>
          @enderror

          <div class="btn-input">
            <button class="btn-submit" type="submit">LOGIN</button>
            <a href="#">Forgot Password</a>
          </div>
        </div>

      </form>

    </div>
  </section>
</body>

</html>