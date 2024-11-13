<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
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
            color: #b388ff;
        }

        h1 {
            color: #b388ff;
            margin-bottom: 20px;
        }

        p {
            color: #ccc;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div>
        <nav>
            <ul>
                <li><a href="{{ route('admin.welcome') }}">Welcome</a></li>
                <li><a href="{{ route('admin.profile.show') }}">Profile</a></li>
                <li><a href="{{ route('admin.topics.index') }}">Topics</a></li>
                <li><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                <li><a href="{{ route('admin.tags.index') }}">Tags</a></li>
                <li><a href="{{ route('admin.users.index') }}">Users</a></li>
            </ul>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </div>
</body>
</html>
