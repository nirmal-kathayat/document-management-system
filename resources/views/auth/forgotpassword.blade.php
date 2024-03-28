<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{asset('css/reset.css')}}">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
  <title>Admin Login</title>
</head>

<body>
  <section>
    <div class="container">
      <div class="login-wrapper">
        <div class="logo">
          <img src="{{ asset('images/logo.svg') }}" style="width: 300px; height: 120px;" alt="logo">
          <h1>Document Management System</h1>
          <h2>Reset Password</h2>
        </div>
        <div class="login-form-wrapper">
          <form method="post" action="{{route('password.resetPassword')}}">
            @csrf
            <div class="form-group group-row align-center">
              <label style="width:35%;color:var(--textPrimary);font-weight:400">Email</label>
              <input type="text" name="email" class="grey-bg" value="{{$email}}" disabled>
            </div>
            <div class="form-group group-row align-center">
              <label style="width:35%;color:var(--textPrimary);font-weight:400">New Password</label>
              <input type="password" name="password" id="password" class="grey-bg">
            </div>

            @error('password')
            <span class="validation-error">{{$message}}</span>
            @enderror

            <div class="form-group group-row align-center">
              <label style="width:35%;color:var(--textPrimary);font-weight: 400">Password</label>
              <input type="password" name="confirm_password" class="grey-bg" id="confirm_password">
            </div>
            @error(' confirm_password') <span class="validation-error">{{$message}}</span>
            @enderror

            <div class="form-group group-column justify-center">
              <label style="width:25%"></label>
              <button class="login-btn" type="submit" id="submitBtn">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>


  <script>
    document.getElementById('submitBtn').addEventListener('click', function(event) {
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirm_password').value;
      const passwordInput = document.getElementById('password');
      const confirmPasswordInput = document.getElementById('confirm_password');
      passwordInput.classList.remove('error');
      confirmPasswordInput.classList.remove('error');
      const errorMessages = document.querySelectorAll('.validation-error');
      errorMessages.forEach(message => message.remove());

  
      if (password === '' || confirmPassword === '') {
        const message = document.createElement('span');
        message.classList.add('validation-error');
        message.textContent = 'Please enter both password and confirm password fields.';
        if (password === '') {
          passwordInput.classList.add('error');
          passwordInput.parentNode.appendChild(message);
        } else {
          confirmPasswordInput.classList.add('error');
          confirmPasswordInput.parentNode.appendChild(message);
        }
        event.preventDefault(); 
        return;
      }

      if (password !== confirmPassword) {
        const message = document.createElement('span');
        message.classList.add('validation-error');
        message.textContent = 'Password do not match.';
        confirmPasswordInput.classList.add('error');
        confirmPasswordInput.parentNode.appendChild(message);
        event.preventDefault();
        return;
      }

      if (password.length < 4) {
        const message = document.createElement('span');
        message.classList.add('validation-error');
        message.textContent = 'Password must be at least 4 characters long.';
        passwordInput.classList.add('error');
        passwordInput.parentNode.appendChild(message);
        event.preventDefault();
        return;
      }
    });
  </script>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="{{asset('js/main.js')}}"></script>

  @include('scripts.message')
  @stack('js')
</body>

</html>