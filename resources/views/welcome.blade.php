<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartShoppers</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #fdfdfd;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('{{ asset('images/background.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        .card {
            background-color: #770434;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 40px 30px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .card h2 {
            color: #fff;
            margin-bottom: 20px;
            font-size: 30px;
        }

        .card a {
            display: inline-block;
            background-color: white;
            color: black;
            padding: 10px 25px;
            margin: 10px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .card a:hover {
            background-color: #e8e6e6;
        }
    </style>
</head>
<body style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('{{ asset('images/background.jpg') }}'); background-size: cover; background-position: center;" class="...">
    <div class="card">
        <h2>Welcome SmartShoppers</h2>
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        @endif
    </div>
</body>
</html>
