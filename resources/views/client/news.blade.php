@extends('layouts.client')

@section('content')
    <h1>Latest News</h1>

    <div class="news-list">
        @foreach($topics as $topic)
            <div class="news-item">
                <h2>{{ $topic->title }}</h2>
                <p>{{ $topic->content }}</p>
                <a href="{{ route('client.topics.show', $topic->id) }}" class="btn btn-primary">Read More</a>
            </div>
        @endforeach
    </div>
@endsection
