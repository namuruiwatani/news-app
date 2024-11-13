@extends('layouts.client')
<style>
    body {
        background-color: #121212;
        color: #ffffff;
        font-family: Arial, sans-serif;
    }

    h1 {
        color: #ff6f61;
        text-align: center;
        margin-top: 20px;
    }

    .news-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 20px auto;
        max-width: 800px;
    }

    .news-item {
        background-color: #1f1f1f;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        width: calc(100% - 20px);
    }

    .news-item h2 {
        color: #d4a9e0;
        margin-bottom: 10px;
    }

    .news-item p {
        color: #c0c0c0;
        margin-bottom: 15px;
    }

    .btn {
        background-color: #483d8b;
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        float: right;
    }

    .btn:hover {
        background-color: #8a2be2;
    }

    .pagination {
        margin: 20px 0;
        text-align: center;
    }

    .pagination ul {
        display: inline-block;
        padding: 0;
        margin: 0;
    }

    .pagination ul li {
        display: inline;
    }

    .pagination ul li a,
    .pagination ul li span {
        color: #333;
        float: left;
        padding: 6px 12px;
        text-decoration: none;
        border-radius: 4px;
        border: 1px solid #ddd;
        margin: 0 4px;
    }

    .pagination ul li.active span {
        background-color: #483d8b;
        color: #fff;
        border-color: #483d8b;
    }

    .pagination ul li a:hover {
        background-color: #35314c;
    }

    .filter-form {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .filter-form select {
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #b388ff;
        color: #ecf0f1;
        font-size: 16px;
        margin-right: 10px;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-image: url("data:image/svg+xml;utf8,<svg fill='%23ecf0f1' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
        background-repeat: no-repeat;
        background-position: right 10px center;
        cursor: pointer;
        width: 12%;
    }

    .filter-form select option {
        padding: 10px;
        background-color: #483d8b;
        color: #ecf0f1;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .filter-form select option:hover {
        background-color: #2c3e50;
    }

    .filter-form button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #b388ff;
        color: #ecf0f1;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .filter-form button:hover {
        background-color: #9b59b6;
    }
</style>

@section('content')
<h1>{{ __('messages.latest_news') }}</h1>

<form class="filter-form" action="{{ route('client.topics.index') }}" method="GET">
    <select name="category" id="category">
        <option value="">{{ __('messages.all_categories') }}</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <button type="submit">{{ __('messages.filter') }}</button>
</form>

<div class="news-list">
    @foreach($topics as $topic)
    <div class="news-item">
        <h2>{{ $topic->title }}</h2>
        <p>{{ $topic->content }}</p>
        <a href="{{ route('client.topics.show', $topic->id) }}" class="btn">{{ __('messages.read_more') }}</a>
    </div>
    @endforeach
</div>

<div class="pagination">
    <ul>
        @if ($topics->onFirstPage())
        <li class="disabled"><span>&laquo;</span></li>
        @else
        <li><a href="{{ $topics->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        @foreach ($topics->getUrlRange(1, $topics->lastPage()) as $page => $url)
        @if ($page == $topics->currentPage())
        <li class="active"><span>{{ $page }}</span></li>
        @else
        <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach

        @if ($topics->hasMorePages())
        <li><a href="{{ $topics->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
        <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
</div>
@endsection
