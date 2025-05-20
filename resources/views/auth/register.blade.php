<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title>Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Arial', sans-serif;
    }

    body {
      height: 100vh;
      margin: 0;
      background: linear-gradient(to right, #eef2ff, #cfd9ff);
      display: flex;
      justify-content: center;
      align-items: center;
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .container-custom {
      display: flex;
      width: 1000px;
      max-width: 100%;
      border-radius: 30px;
      background: white;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      animation: fadeIn 1.2s ease-in-out;
    }

    .left-side, .right-side {
      padding: 40px 50px;
      flex: 1;
    }

    .left-side {
      background: #ffffff;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .left-side h2 {
      font-size: 42px;
      font-weight: bold;
      color: #2c52e2;
      margin-bottom: 25px;
      text-shadow: 1px 2px 4px rgba(0, 0, 0, 0.1);
    }

    form label {
      font-size: 14px;
      margin-bottom: 4px;
    }

    form input {
      border-radius: 20px;
      border: 1px solid #ccc;
      padding: 10px 15px;
      transition: all 0.3s ease;
    }

    form input:focus {
      border-color: #3366ff;
      box-shadow: 0 0 5px rgba(51, 102, 255, 0.3);
    }

    .error-message {
      color: red;
      font-size: 12px;
      margin-left: 5px;
    }

    .button-group {
      display: flex;
      gap: 15px;
      margin-top: 20px;
    }

    .btn-signup, .btn-login {
      flex: 1;
      border-radius: 20px;
      padding: 10px 0;
      font-weight: bold;
      transition: all 0.3s ease;
    }

    .btn-signup {
      background-color: #3366ff;
      color: white;
    }

    .btn-signup:hover {
      background-color: #264dbe;
      transform: scale(1.03);
    }

    .btn-login {
      background-color: #e0e0e0;
      color: #333;
    }

    .btn-login:hover {
      background-color: #c0c0c0;
      transform: scale(1.03);
    }

    .right-side {
      background: linear-gradient(to bottom right, #2c52e2, #f0f0f0);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .right-side img {
      width: 100%;
      max-width: 350px;
      animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    @media (max-width: 768px) {
      .container-custom {
        flex-direction: column;
        height: auto;
      }
      .right-side {
        padding: 30px;
      }
    }
  </style>
</head>
<body>
  <div class="container-custom">
    <div class="left-side">
      <h2>Sign Up</h2>
      <form method="POST" action="{{ route('register') }}">
  @csrf

  <div class="row mb-3">
    <div class="col">
      <label for="name" class="form-label">Username</label>
      <input type="text" name="name" class="form-control" required>
      @error('name')
      <div class="error-message">{{ $message }}</div>
      @enderror
    </div>

    <div class="col">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
      @error('email')
      <div class="error-message">{{ $message }}</div>
      @enderror
    </div>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" required>
    @error('password')
    <div class="error-message">{{ $message }}</div>
    @enderror
  </div>

  <input type="hidden" name="role" value="0">

  <div class="mb-3">
    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
    <input type="password" name="password_confirmation" class="form-control" required>
    @error('password_confirmation')
    <div class="error-message">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="number" class="form-label">Nomor HP</label>
    <input type="text" name="number" class="form-control" required>
    @error('number')
    <div class="error-message">{{ $message }}</div>
    @enderror
  </div>

  <div class="d-flex gap-3 mt-4">
    <button type="submit" class="btn btn-primary flex-fill">Sign Up</button>
    <a href="{{ route('login') }}" class="btn btn-light flex-fill">Log In</a>
  </div>
</form>

    </div>
    <div class="right-side">
      <img src="https://pelajarinfo.id/wp-content/uploads/2023/11/001-BINUS-1536x864.png" alt="logo Binus">
    </div>
  </div>
</body>
</html>
