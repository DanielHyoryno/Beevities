<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Log In</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    * {
      box-sizing: border-box;
      font-family: 'Arial', sans-serif;
    }

    body {
      margin: 0;
      background: linear-gradient(to right, #eef2ff, #d9e0ff);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: fadeIn 0.7s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .container-box {
      display: flex;
      width: 1000px;
      max-width: 95%;
      height: 600px;
      background: #fff;
      border-radius: 40px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .left-side, .right-side {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px;
    }

    .left-side {
      background: linear-gradient(to bottom right, #2d5fff, #f0f4ff);
    }

    .left-side img {
      width: 80%;
      max-width: 350px;
      animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    .right-side form {
      width: 100%;
      max-width: 350px;
    }

    .right-side h2 {
      font-size: 40px;
      color: #2d5fff;
      font-weight: bold;
      margin-bottom: 30px;
      text-shadow: 1px 2px 4px rgba(0, 0, 0, 0.1);
      animation: fadeIn 1.2s ease-in-out;
    }

    .form-label {
      font-weight: 500;
      margin-bottom: 4px;
      color: #333;
    }

    .form-control {
      border-radius: 10px;
      padding: 12px 16px;
      transition: all 0.3s ease;
      border: 1px solid #ccc;
    }

    .form-control:focus {
      border-color: #3366ff;
      box-shadow: 0 0 5px rgba(51, 102, 255, 0.3);
    }

    .btn {
      padding: 10px 0;
      border-radius: 10px;
      font-weight: bold;
      transition: 0.3s ease;
    }

    .login-button {
      background-color: #2d5fff;
      color: white;
      border: none;
    }

    .login-button:hover {
      background-color: #004cd1;
      color: white;
      transform: scale(1.03);
    }

    .signup-button {
      background-color: #e0e7ff;
      color: #2d5fff;
      border: none;
    }

    .signup-button:hover {
      background-color: #c4d1ff;
      transform: scale(1.03);
    }

    .error-message {
      color: red;
      font-size: 12px;
      margin-top: 4px;
    }

    @media (max-width: 768px) {
      .container-box {
        flex-direction: column;
        height: auto;
      }

      .left-side {
        padding: 20px;
      }

      .right-side {
        padding: 30px;
      }
    }
  </style>
</head>
<body>
  <div class="container-box">
    <div class="left-side">
      <img src="https://pelajarinfo.id/wp-content/uploads/2023/11/001-BINUS-1536x864.png" alt="logo Binus">
    </div>

    <div class="right-side">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <h2>Log In</h2>

        @if(session('error'))
          <p class="error-message">{{ session('error') }}</p>
        @endif

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
          @error('email')
          <p class="error-message">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
          @error('password')
          <p class="error-message">{{ $message }}</p>
          @enderror
        </div>

        <div class="d-flex justify-content-between gap-3">
          <button type="submit" class="btn login-button w-50">Log In</button>
          <a href="{{ route('register') }}" class="btn signup-button w-50 text-center">Sign Up</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
