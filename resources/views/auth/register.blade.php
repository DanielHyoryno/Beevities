<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title>Sign Up</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Arial', sans-serif;
    }

    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f2f2f2;
    }

    .container {
      display: flex;
      width: 1000px;
      height: 620px;
      background: white;
      border-radius: 30px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
      overflow: hidden;
    }

    .left-side {
      width: auto;
      height: auto
      align-items: center;
      flex: 1;
      background: linear-gradient(to bottom, #ffffff, #e5e5e5);
      padding: 40px 50px;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
    }

    .left-side h2 {
      font-size: 48px;
      font-weight: bold;
      color: #3366ff;
      margin-bottom: 30px;
      text-shadow: 2px 4px 5px rgba(0, 0, 0, 0.2);
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    label {
      font-size: 14px;
      color: #333;
    }

    input {
      padding: 10px 15px;
      border: 1px solid #999;
      border-radius: 20px;
      outline: none;
    }

    .error-message {
      color: red;
      font-size: 12px;
      margin-left: 10px;
    }

    .button-group {
      display: flex;
      justify-content: space-between;
      gap: 20px;
      margin-top: 20px;
    }

    .btn {
      flex: 1;
      padding: 12px;
      font-size: 16px;
      font-weight: bold;
      border-radius: 20px;
      text-align: center;
      text-decoration: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn-signup {
      background-color: #3366ff;
      color: white;
      border: none;
    }

    .btn-signup:hover {
      background-color: #1f4ed1;
    }

    .btn-login {
      background-color: #e0e0e0;
      color: #333;
      border: none;
    }

    .btn-login:hover {
      background-color: #c0c0c0;
    }

    .right-side {
      flex: 1;
      background: linear-gradient(to bottom right, #2c52e2, #f0f0f0);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .right-side img {
      width: 80%;
      max-width: 350px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left-side">
      <h2>Sign Up</h2>
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name">Username</label>
        <input type="text" name="name" required>
        @error('name')
        <p class="error-message">{{ $message }}</p>
        @enderror

        <label for="email">Email</label>
        <input type="email" name="email" required>
        @error('email')
        <p class="error-message">{{ $message }}</p>
        @enderror

        <label for="password">Password</label>
        <input type="password" name="password" required>
        @error('password')
        <p class="error-message">{{ $message }}</p>
        @enderror

        <input type="hidden" name="role" value="0">

        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required>
        @error('password_confirmation')
        <p class="error-message">{{ $message }}</p>
        @enderror

        <label for="number">Nomor HP</label>
        <input type="text" name="number" required>
        @error('number')
        <p class="error-message">{{ $message }}</p>
        @enderror

        <div class="button-group">
          <button type="submit" class="btn btn-signup">Sign Up</button>
          <a href="{{ route('login') }}" class="btn btn-login">Log In</a>
        </div>
      </form>
    </div>
    <div class="right-side">
      <img src="https://pelajarinfo.id/wp-content/uploads/2023/11/001-BINUS-1536x864.png" alt="logo Binus">
    </div>
  </div>
</body>
</html>
