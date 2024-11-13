<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Content Maker</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: #fff;
        }

        nav {
            background-color: #1a1a1a;
            padding: 20px;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #b388ff; /* Изменение цвета при наведении */
        }
    </style>
</head>

<body>
    <div>
        <nav>
            <ul>
                <li><a href="{{ route('content-maker.welcome') }}">Welcome</a></li>
                <li><a href="{{ route('content-maker.profile.show') }}">Profile</a></li>
            </ul>
        </nav>
        @yield('content')
    </div>
</body>

</html>