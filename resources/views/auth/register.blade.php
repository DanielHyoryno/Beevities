<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
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
            width: 800px;
            height: 450px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .left-side {
            flex: 1;
            background: linear-gradient(to bottom right, #e0e0e0, #ffffff);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .left-side h2 {
            font-size: 36px;
            color: #2c52e2;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
        }

        .left-side h2::after {
            content: "🎲";
            font-size: 20px;
            margin-left: 10px;
        }

        .left-side form label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }

        .left-side form input {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 20px;
            border: 1px solid #ccc;
            width: 100%;
        }

        .left-side button {
            background-color: #2c52e2;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        .left-side button:hover {
            background-color: #2040c2;
        }

        .login-btn {
            position: absolute;
            top: 20px;
            right: -40px;
            transform: rotate(90deg);
            background-color: #2c52e2;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            cursor: pointer;
        }

        .right-side {
            flex: 1;
            background: linear-gradient(to bottom right, #2666cf, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .right-side img {
            width: 60%;
        }
    </style>
</head>
<body>
<div class="container">
        <div class="left-side">
            <a href="{{ route('login') }}">
                <button class="login-btn">log in</button>
            </a>
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

                <button type="submit">Sign Up</button>
            </form>
        </div>

        <div class="right-side">
            <img src="https://pelajarinfo.id/wp-content/uploads/2023/11/001-BINUS-1536x864.png" alt="logo Binus">
        </div>
    </div>
</body>
</html>