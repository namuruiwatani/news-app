@extends('layouts.content-maker')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #121212;
        color: #fff;
        margin: 0;
        padding: 0;
    }
    
    .container {
        width: 80%;
        margin: 0 auto;
        text-align: center;
        padding: 50px 0;
    }
    
    h1, h2 {
        color: #b388ff;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-align: left;
    }

    .list-group {
        list-style-type: none;
        padding: 0;
    }
    
    .list-group-item {
        background-color: #2e2e2e;
        border: 1px solid #b388ff;
        border-radius: 10px;
        margin-bottom: 20px;
        padding: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        transition: transform 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .list-group-item:hover {
        transform: scale(1.05);
    }
    
    .list-group-item a {
        color: #fff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .list-group-item a:hover {
        color: #ff69b4;
    }

    .btn {
        background-color: #b388ff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-left: 10px;
    }
    
    .btn-success {
        margin-left: 0;
    }
    
    .btn:hover {
        background-color: #483d8b;
    }

    .d-inline {
        margin-top: 40px;
    }
</style>


@section('content')
    <div class="container">
        <h1>Welcome Content Maker!</h1>
        <h2>News</h2>
        <ul class="list-group">
            @foreach($topics as $topic)
                <li class="list-group-item">
                    <a href="{{ route('content-maker.topics.show', $topic->id) }}">{{ $topic->title }}</a>
                    <div class="float-right">
                        <div class="btn-group">
                            <a href="{{ route('content-maker.topics.edit', $topic->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('content-maker.topics.destroy', $topic->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this topic?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <a href="{{ route('content-maker.topics.create') }}" class="btn btn-success mt-3">Add Topic</a>
    </div>
@endsection
