<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Global Styles */
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #1a1a2e, #16213e);
      color: #fff;
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
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

    /* Checkbox */
    .form-check-input {
      background: rgba(255, 255, 255, 0.2);
      border: none;
    }

    .form-check-input:checked {
      background-color: #00b4db;
      border-color: #00b4db;
    }

    .form-check-label {
      color: #ddd;
    }

    /* Login Button */
    .btn-lux {
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

    .btn-lux:hover {
      background: linear-gradient(135deg, #00d2ff, #00b4db);
    }

    /* Forgot Password Link */
    .forgot-password {
      color: #00b4db;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .forgot-password:hover {
      color: #00d2ff;
    }

    /* Error Messages */
    .alert-danger {
      background: rgba(255, 0, 0, 0.2);
      border: 1px solid rgba(255, 0, 0, 0.5);
      border-radius: 10px;
      padding: 10px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <h3>Login</h3>
    <form method="POST" action="{{ route('pelanggan.login') }}">
      @csrf

      <!-- Error Messages -->
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="list-unstyled mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Email Address -->
      <div class="mb-3">
        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
      </div>

      <!-- Password -->
      <div class="mb-3">
        <input type="password" id="password" class="form-control" name="password" required placeholder="Enter your password">
      </div>

      <!-- Remember Me -->
      <div class="mt-3">
        <a href="{{ route('pelanggan.register') }}" class="forgot-password">Belum punya akun?</a>
      </div>

      <!-- Login Button -->
      <button type="submit" class="btn btn-lux">Login</button>

      <!-- Forgot Password -->
      @if (Route::has('password.request'))
        <div class="mt-3">
          <a href="{{ route('password.request') }}" class="forgot-password">Forgot your password?</a>
        </div>
      @endif
    </form>
  </div>
</body>
</html>
