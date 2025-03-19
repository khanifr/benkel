<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    /* Global Styles */
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #1a1a2e, #16213e);
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #fff;
    }
    /* Login Card */
    .login-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }
    /* Title */
    .login-card h3 {
      font-weight: 700;
      margin-bottom: 30px;
      font-size: 2.5rem;
      background: linear-gradient(135deg, #00b4db, #00d2ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    /* Input Fields */
    .form-control {
      background: rgba(255, 255, 255, 0.2);
      border: none;
      color: #fff;
      padding: 12px 15px;
      border-radius: 10px;
      font-size: 1rem;
      margin-bottom: 20px;
    }
    .form-control::placeholder {
      color: #e0e0e0;
    }
    .form-control:focus {
      background: rgba(255, 255, 255, 0.3);
      box-shadow: 0 0 8px rgba(0, 180, 219, 0.6);
    }
    /* Button */
    .btn-admin {
      background: linear-gradient(135deg, #00b4db, #00d2ff);
      border: none;
      padding: 12px;
      font-weight: bold;
      border-radius: 50px;
      font-size: 1rem;
      width: 100%;
      color: #fff;
      transition: background 0.3s ease;
    }
    .btn-admin:hover {
      background: linear-gradient(135deg, #00d2ff, #00b4db);
    }
    /* Link Register */
    .link-register {
      margin-top: 15px;
      display: block;
      color: #00b4db;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .link-register:hover {
      color: #00d2ff;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <!-- Session Status -->
    @if(session('status'))
      <div class="alert alert-success mb-4">
        {{ session('status') }}
      </div>
    @endif

    <h3>Login Admin</h3>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email Address -->
      <div class="mb-3">
        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
        @error('email')
          <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
      </div>

      <!-- Password -->
      <div class="mb-3">
        <input type="password" id="password" class="form-control" name="password" required placeholder="Enter your password">
        @error('password')
          <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
      </div>

      <!-- Remember Me -->
      <div class="mb-3 form-check text-start">
        <input type="checkbox" id="remember_me" class="form-check-input" name="remember">
        <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
      </div>

      <!-- Login Button -->
      <button type="submit" class="btn btn-admin">Log in</button>

      <!-- Register Link -->
      @if (Route::has('password.request'))
        <div class="mt-3">
          <a href="{{ route('register') }}" class="link-register">{{ __('Register') }}</a>
        </div>
      @endif
    </form>
  </div>
</body>
</html>
