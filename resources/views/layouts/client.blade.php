<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Client</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1a1a1a;
            color: #fff;
            margin: 0;
            padding: 0;
            
        }

        body::-webkit-scrollbar {
            display: none;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #121212;
            padding: 20px;
        }

        .logo {
            width: 50px;
            height: auto;
            border-radius: 10px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: baseline;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
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

        button {
            background-color: #b388ff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #7c4dff;
        }

        .language-btn {
            border: none;
            background: none;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
            padding: 5px 10px;
            transition: background-color 0.3s ease;
        }

        .language-btn.active {
            background-color: #ddd;
        }

        .language-btn i {
            margin-right: 5px;
        }
    </style>
</head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<body>
    <header>
        <img class="logo" src="{{ asset('site-logo/logo.jpg') }}" alt="Logo">
        <nav>
            <ul>
                <li><a href="{{ route('client.topics.index') }}">{{ __('messages.news') }}</a></li>
                <li><a href="{{ route('client.search.categories') }}">{{ __('messages.categories') }}</a></li>
                <li><a href="{{ route('client.search.topics') }}">{{ __('messages.topics') }}</a></li>
                <li><a href="{{ route('topics.favorites') }}">{{ __('messages.favorites') }}</a></li>
                <li><a href="{{ route('client.profile.show') }}">{{ __('messages.profile') }}</a></li>
                <form action="{{ route('locale.change') }}" method="POST">
                    @csrf
                    <button type="submit" name="locale" value="en" class="language-btn{{ app()->getLocale() == 'en' ? ' active' : '' }}">
                        🇺🇸 English
                    </button>
                    <button type="submit" name="locale" value="ru" class="language-btn{{ app()->getLocale() == 'ru' ? ' active' : '' }}">
                        🇷🇺 Русский
                    </button>
                    <button type="submit" name="locale" value="kz" class="language-btn{{ app()->getLocale() == 'kz' ? ' active' : '' }}">
                        🇰🇿 Қазақша
                    </button>
                </form>
            </ul>
        </nav>
    </header>

    <div class="container">
        @yield('content')
    </div>
</body>

</html>