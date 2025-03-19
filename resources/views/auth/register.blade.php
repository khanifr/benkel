<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
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
    /* Register Card */
    .register-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 500px;
      text-align: center;
    }
    /* Title */
    .register-card h3 {
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
      transition: all 0.3s ease;
    }
    .form-control::placeholder {
      color: #e0e0e0;
    }
    .form-control:focus {
      background: rgba(255, 255, 255, 0.3);
      box-shadow: 0 0 8px rgba(0, 180, 219, 0.6);
    }
    /* Button */
    .btn-register {
      background: linear-gradient(135deg, #00b4db, #00d2ff);
      border: none;
      padding: 12px;
      font-weight: bold;
      border-radius: 50px;
      font-size: 1rem;
      width: 100%;
      color: #fff;
      transition: background 0.3s ease;
      margin-top: 20px;
    }
    .btn-register:hover {
      background: linear-gradient(135deg, #00d2ff, #00b4db);
    }
    /* Link Login */
    .link-login {
      margin-top: 15px;
      display: block;
      color: #00b4db;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .link-login:hover {
      color: #00d2ff;
    }
    /* Error Alert */
    .alert-danger {
      background: rgba(255, 0, 0, 0.2);
      border: 1px solid rgba(255, 0, 0, 0.5);
      border-radius: 10px;
      padding: 10px;
      margin-bottom: 20px;
      text-align: left;
    }
  </style>
</head>
<body>
  <div class="register-card">
    <h3>Register</h3>
    
    <!-- Error Messages -->
    @if ($errors->any())
      <div class="alert alert-danger">
        <strong>Whoops! Something went wrong.</strong>
        <ul class="list-unstyled mt-2">
          @foreach ($errors->all() as $error)
            <li>- {{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('pelanggan.register') }}" enctype="multipart/form-data">
      @csrf
      <!-- KTP -->
      <div>
        <input type="text" id="ktp" class="form-control" name="ktp" value="{{ old('ktp') }}" required placeholder="Masukkan No. KTP">
      </div>
      <!-- Nama -->
      <div>
        <input type="text" id="nama" class="form-control" name="nama" value="{{ old('nama') }}" required placeholder="Masukkan Nama Lengkap">
      </div>
      <!-- Alamat -->
      <div>
        <input type="text" id="alamat" class="form-control" name="alamat" value="{{ old('alamat') }}" required placeholder="Masukkan Alamat Lengkap">
      </div>
      <!-- No HP -->
      <div>
        <input type="text" id="hp" class="form-control" name="hp" value="{{ old('hp') }}" required placeholder="Masukkan No. HP Aktif">
      </div>
      <!-- Email -->
      <div>
        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Masukkan Email Aktif">
      </div>
      <!-- Password -->
      <div>
        <input type="password" id="password" class="form-control" name="password" required placeholder="Masukkan Password">
      </div>
      <!-- Confirm Password -->
      <div>
        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required placeholder="Ulangi Password">
      </div>
      <!-- Optional: File Input untuk Foto Profil (dapat diaktifkan jika diperlukan) -->
      {{-- 
      <div>
        <input type="file" id="foto_profile" name="foto_profile" accept="image/*">
      </div>
      --}}
      <div class="text-start mt-2">
        <small class="d-block text-muted mt-2">
          <i class="bi bi-person-circle"></i> Sudah punya akun?  
          <a href="{{ route('pelanggan.login') }}" class="link-login text-primary fw-bold text-decoration-none ms-1">
            Masuk di sini
          </a>
        </small>        
      </div>
      <button type="submit" class="btn btn-register">Register</button>
    </form>
  </div>
</body>
</html>
