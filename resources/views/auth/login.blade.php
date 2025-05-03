<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
        }

        .container {
            display: flex;
            width: 100%;
        }

        .left-side {
            flex: 1;
            background-size: cover;
        }

        .right-side {
            flex: 0.5;
            display: flex;
            margin-right: 50px;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-shadow: -5px 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 8px;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-side"></div>

        <div class="right-side">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h2>Login</h2>

                @if(session('error'))
                    <p class="error-message">{{ session('error') }}</p>
                @endif

                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div>
                    <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="Password" required>
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit">Login</button>
                <a href="{{ route('register') }}">Register</a>
            </form>
        </div>
    </div>
</body>
</html>
