@extends('layouts.client')
<style>
    .container {
        margin-top: 30px;
    }

    h1 {
        color: #eaeaea;
        text-align: center;
        margin-bottom: 30px;
        font-size: 2.5rem;
    }

    .table {
        width: 50%;
        margin-bottom: 1rem;
        color: #eaeaea;
        border-collapse: collapse;
        margin-left: auto;
        margin-right: auto;
    }

    .table th,
    .table td {
        padding: 1rem;
        text-align: left;
        vertical-align: top;
        border-top: 1px solid #eaeaea;
    }

    .table th {
        background-color: #4e4e50;
        color: #eaeaea;
        font-weight: bold;
    }

    .table td {
        background-color: #1f1f1f;
    }

    .table thead th {
        border-bottom: 2px solid #eaeaea;
    }

    .table tbody tr:hover {
        background-color: #3e3e50;
    }

    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.3rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .btn-danger {
        color: #fff;
        background-color: #ff4b5c;
        border-color: #ff4b5c;
    }

    .btn-danger:hover {
        color: #fff;
        background-color: #e60029;
        border-color: #e60029;
    }

    .btn-link {
        color: #4e4e50;
        background-color: transparent;
        border: none;
        padding: 0;
        text-decoration: none;
    }

    .btn-link:hover {
        color: #ff4b5c;
        text-decoration: underline;
    }

    .topic-link {
        color: #fff;
        text-decoration: none;
        transition: color 0.3s;
    }

    .topic-link:hover {
        color: #0056b3;
    }
</style>

@section('content')
<div class="container">
    <h1>{{ __('messages.favorite_topics') }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('messages.title') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($favorites as $topic)
            <tr>
                <td><a href="{{ route('client.topics.show', $topic->id) }}" class="topic-link">{{ $topic->title }}</a></td>
                <td>
                    <form action="{{ route('topics.toggleFavorite', $topic->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">{{ __('messages.remove') }}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection