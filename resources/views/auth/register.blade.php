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
      height: 600px;
      background: white;
      border-radius: 30px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
      overflow: hidden;
    }

    .left-side {
      flex: 1;
      background: linear-gradient(to bottom, #ffffff, #e5e5e5);
      padding: 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
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
    }

    label {
      font-size: 14px;
      margin-bottom: 5px;
      color: #333;
    }

    input {
      padding: 10px 15px;
      border: 1px solid #999;
      border-radius: 20px;
      margin-bottom: 15px;
      width: 100%;
      outline: none;
    }

    button[type="submit"] {
      background-color: #3366ff;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 20px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }

    button[type="submit"]:hover {
      background-color: #1f4ed1;
    }

    .login-btn {
      margin-top: 10px;
      background-color: #d4d7e2;
      color: #444;
      border: none;
      padding: 8px 16px;
      border-radius: 10px;
      font-size: 12px;
      cursor: pointer;
      align-self: flex-start;
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

    .error-message {
        color: red;
        font-size: 12px;
        margin: 2px 0 0 10px;
    }


  </style>
</head>
<body>
    <div class="container">
        <div class="left-side">
            <h2>Sign Up</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <label for="name">username</label>
                    <input type="text" name="name" required>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <label for="email">email</label>
                    <input type="email" name="email" required>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <label for="password">password</label>
                    <input type="password" name="password" required>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <input type="hidden" name="role" value="0">

                <label for="password_confirmation">konfirmasi password</label>
                    <input type="password" name="password_confirmation" required>
                @error('password_confirmation')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <!-- Nomor HP field inserted here -->
                <label for="number">nomor hp</label>
                    <input type="text" name="number" required>
                @error('number')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <button type="submit">Sign Up</button>
                <a href="{{ route('login') }}">Log In</a>
            </form>
        </div>
        <div class="right-side">
            <img src="https://pelajarinfo.id/wp-content/uploads/2023/11/001-BINUS-1536x864.png" alt="logo Binus">
        </div>
  </div>
</body>
</html>
