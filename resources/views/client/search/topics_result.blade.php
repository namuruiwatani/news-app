@extends('layouts.client')

@section('content')
    <div class="centered-content">
        <h1 class="cyber-title">{{ __('messages.search_results_topics') }}</h1>

        @foreach($topics as $topic)
            <div class="news-item animated-result">
                <h2>{{ $topic->title }}</h2>
                <a href="{{ route('client.topics.show', $topic->id) }}" class="cyber-btn">{{ __('messages.read_more') }}</a>
            </div>
        @endforeach
    </div>
@endsection

<style>
    .centered-content {
        text-align: center;
    }

    .cyber-title {
        font-size: 3rem;
        margin-bottom: 3rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #b388ff;
    }

    .news-item {
        background-color: #111;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 0 20px rgba(255, 0, 203, 0.2), 0 0px 40px rgba(32, 0, 255, 0.2), 0 0 80px rgba(32, 0, 255, 0.2);
        width: 40%;
        margin: auto;
    }

    .news-item h2 {
        color: #b388ff;
        margin-bottom: 30px;
    }

    .cyber-btn {
        background-color: #b388ff;
        color: #000;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .cyber-btn:hover {
        background-color: #b388ff;
    }

    .animated-result {
        animation-name: fadeInDown;
        animation-duration: 1s;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
