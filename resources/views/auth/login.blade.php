<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Log In</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: #f2f2f2;
        }

        .container {
            width: 90%;
            height: 90vh;
            margin: 3vh auto;
            display: flex;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            border-radius: 20px;
            overflow: hidden;
            background: white;
        }

        .left-side {
            flex: 1;
            background: linear-gradient(to bottom left, #0057b7, #f2f2f2);
            display: flex;
            justify-content: center;
            align-items: center;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }

        .left-side img {
            width: 60%;
        }

        .right-side {
            flex: 1;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        h2 {
            font-size: 36px;
            font-weight: bold;
            color: #2d5fff;
            text-align: right;
            margin-bottom: 40px;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.1);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input {
            padding: 12px;
            border-radius: 20px;
            border: 1px solid #ccc;
            outline: none;
        }

        label {
            font-size: 14px;
            color: #333;
            margin-left: 10px;
            align-self: flex-end;
        }

        .login-button {
            padding: 12px;
            background-color: #2d5fff;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-button:hover {
            background-color: #004cd1;
        }

        .signup-link {
            font-size: 12px;
            color: #2d5fff;
            text-decoration: none;
            margin-top: 10px;
            align-self: flex-start;
            padding: 5px 10px;
            border-radius: 10px;
            background-color: #cfd8ff;
        }

        .signup-link:hover {
            background-color: #b0c2ff;
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin: 5px 0 0 10px;
        }


    </style>
</head>
<body>
    <div class="container">
        <div class="right-side"></div>

        <div class="right-side">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h2>Log In</h2>

                @if(session('error'))
                    <p class="error-message">{{ session('error') }}</p>
                @endif

                <div>
                    <label for="email">email:</label>
                    <input type="email" name="email" placeholder="Email" required>
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password">password:</label>
                    <input type="password" name="password" placeholder="Password" required>
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit">Log In</button>
                <a href="{{ route('register') }}">Sign Up</a>
            </form>
        </div>
        <div class="left-side">
            <img src="https://pelajarinfo.id/wp-content/uploads/2023/11/001-BINUS-1536x864.png" alt="logo Binus">
        </div>
    </div>
</body>
</html>
