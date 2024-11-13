<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #121212;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            text-align: center;
        }

        h1 {
            font-size: 4em;
            color: #ffffff;
            margin-bottom: 50px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        }

        .buttons {
            display: flex;
            gap: 30px;
        }

        .button {
            padding: 20px 40px;
            font-size: 1.5em;
            color: #fff;
            background-color: #b388ff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        .button:hover {
            background-color: #7c4dff;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
        }

        .button:active {
            transform: translateY(0);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <h1>Welcome</h1>
    <div class="buttons">
        <a href="{{ route('register') }}" class="button">Register</a>
        <a href="{{ route('login') }}" class="button">Login</a>
    </div>
</body>

</html>