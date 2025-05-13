<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
        }

        .container-box {
            max-width: 1000px;
            height: 600px;
            margin: 5vh auto;
            display: flex;
            border-radius: 30px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .left-side, .right-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .left-side {
            background: linear-gradient(to bottom right, #0057b7, #f2f2f2);
        }

        .left-side img {
            width: 80%;
            max-width: 350px;
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
            text-shadow: 1px 2px 3px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
        }

        .form-control {
            border-radius: 20px;
            padding: 10px 15px;
        }

        .login-button, .switch-link {
            margin-top: 10px;
            border-radius: 20px;
            padding: 10px;
            width: 100%;
            font-weight: bold;
        }

        .login-button {
            background-color: #2d5fff;
            color: white;
            border: none;
        }

        .login-button:hover {
            background-color: #004cd1;
        }

        .switch-link {
            background-color: #e0e7ff;
            color: #2d5fff;
            text-align: center;
            text-decoration: none;
            display: block;
        }

        .switch-link:hover {
            background-color: #c4d1ff;
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 2px;
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

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="d-flex justify-content-between gap-2 mt-3">
                    <button type="submit" class="login-button w-50">Log In</button>
                    <a href="{{ route('register') }}" class="switch-link w-50 text-center">Sign Up</a>
                </div>

            </form>
        </div>
    </div>
</body>
</html>
