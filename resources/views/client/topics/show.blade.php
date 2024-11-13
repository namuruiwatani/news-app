@extends('layouts.client')

<style>
    /* Общие стили */
    body {
        background-color: #222;
        color: #fff;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .topic-details {
        background-color: #333;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .topic-img {
        border-radius: 10px;
        max-width: 40%;
        height: auto;
        margin-bottom: 20px;
    }

    .like-icon,
    .dislike-icon {
        cursor: pointer;
        margin-right: 10px;
    }

    .user-avatar {
        border-radius: 50%;
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin-right: 10px;
    }

    .username {
        color: #8400ff;
        /* Темно-фиолетовый */
    }

    .timestamp {
        color: #4b0082;
        /* Абсидианновый */
    }

    .comment {
        background-color: #444;
        /* Темно-синий */
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .comment-content p {
        color: #fff;
    }

    .comment-actions {
        display: flex;
        /* Размещение кнопок лайка и дизлайка на одной линии */
        align-items: center;
        /* Выравнивание по центру */
        margin-top: 10px;
    }

    .like-count,
    .dislike-count {
        color: #8a2be2;
        /* Темно-фиолетовый */
        margin-right: 5px;
    }

    .comment-info {
        display: flex;
        align-items: center;
    }

    .user-avatar {
        margin-right: 10px;
        /* Отступ между картинкой и информацией о пользователе */
    }

    .user-info {
        display: flex;
        flex-direction: column;
        /* Отображаем информацию о пользователе в столбец */
        align-items: flex-start;
        /* Выравниваем по левому краю */
        order: 1;
        /* Помещаем информацию о пользователе слева */
    }

    .comment-form {
        margin-top: 20px;
    }

    /* Стили для инпута добавления комментария */
    .comment-form .form-group {
        position: relative;
        margin-bottom: 1rem;
    }

    .comment-form label {
        position: absolute;
        top: 8%;
        left: 0.5rem;
        transform: translateY(-50%);
        color: #8a2be2;
        /* Темно-фиолетовый */
        transition: all 0.3s ease-in-out;
        font-size: 1.2rem;
        /* Увеличиваем размер шрифта */
        font-weight: bold;
        /* Делаем текст жирным */
        font-family: Arial, sans-serif;
        /* Используем другой шрифт */
    }


    .comment-form input,
    .comment-form textarea {
        width: 100%;
        padding: 0.5rem;
        border-radius: 5px;
        border: 1px solid #8a2be2;
        /* Темно-фиолетовый */
        background-color: #333;
        color: #fff;
        transition: all 0.3s ease-in-out;
        margin: 30px 0 0 0;
    }

    .comment-form input:focus,
    .comment-form textarea:focus {
        outline: none;
        border-color: #4b0082;
        /* Абсидианновый */
    }

    .comment-form input:focus+label,
    .comment-form textarea:focus+label,
    .comment-form input:not(:placeholder-shown)+label,
    .comment-form textarea:not(:placeholder-shown)+label {
        color: #4b0082;
        /* Абсидианновый */
    }

    .comment-form textarea {
        min-height: 100px;
    }

    .comment-form button {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 5px;
        background-color: #8a2be2;
        /* Темно-фиолетовый */
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .comment-form button:hover {
        background-color: #4b0082;
    }

    .favorite {
        float: right;
    }

    .user-role {
        display: flex;
    }

    .role {
        font-size: 12px;
        color: #ff1493;
        margin-left: 10px;
        padding: 5px 10px;
        border: 1px solid #ff1493;
        border-radius: 5px;
    }
</style>

@section('content')
<div class="container">
    <div class="topic-details">

        <div class="favorite">
            <form action="{{ route('topics.toggleFavorite', $topic->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link p-0 border-0" style="background: none;">
                    @if(auth()->user() && auth()->user()->favorites()->where('topic_id', $topic->id)->exists())
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="gold" viewBox="0 0 24 24" style="filter: drop-shadow(0 0 5px rgba(138, 43, 226, 0.5));">
                        <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                    </svg>
                    @else
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2" d="M11.083 5.104c.35-.8 1.485-.8 1.834 0l1.752 4.022a1 1 0 0 0 .84.597l4.463.342c.9.069 1.255 1.2.556 1.771l-3.33 2.723a1 1 0 0 0-.337 1.016l1.03 4.119c.214.858-.71 1.552-1.474 1.106l-3.913-2.281a1 1 0 0 0-1.008 0L7.583 20.8c-.764.446-1.688-.248-1.474-1.106l1.03-4.119A1 1 0 0 0 6.8 14.56l-3.33-2.723c-.698-.571-.342-1.702.557-1.771l4.462-.342a1 1 0 0 0 .84-.597l1.753-4.022Z" />
                    </svg>
                    @endif
                </button>
            </form>
        </div>
        <h1>{{ $topic->title }}</h1>
        <img class="topic-img" src="{{ asset('storage/' . $topic->img) }}" alt="{{ $topic->title }}">
        <p>{{ $topic->content }}</p>
        @if ($topic->tags->isNotEmpty())
        <p>{{ __('messages.tag') }}
            @foreach ($topic->tags as $tag)
            <span>{{ $tag->name }}</span>
            @endforeach
        </p>
        @else
        <p>{{ __('messages.no_tag') }}</p>
        @endif
        <p>{{ __('messages.category') }} {{ $topic->category->name }}</p>
        <p>{{ __('messages.author') }} {{ $topic->user ? $topic->user->name : __('user_not_available') }}</p>
        <p>{{ __('messages.created_at') }} {{ $topic->created_at->format('Y-m-d H:i:s') }}</p>
        <p>{{ __('messages.likes') }} {{ $topic->likes_count }}</p>
        <p>{{ __('messages.dislikes') }} {{ $topic->dislikes_count }}</p>

        <!-- Like and Dislike Icons for topic-->
        <div class="comment-actions">
            <form action="{{ route('client.topics.like', $topic->id) }}" method="POST" class="like-form">
                @csrf
                <button type="submit" class="like-icon">
                    <!-- SVG for like icon -->
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" style="transform: rotate(180deg);">
                        <path fill-rule="evenodd" d="M8.97 14.316H5.004c-.322 0-.64-.08-.925-.232a2.022 2.022 0 0 1-.717-.645 2.108 2.108 0 0 1-.242-1.883l2.36-7.201C5.769 3.54 5.96 3 7.365 3c2.072 0 4.276.678 6.156 1.256.473.145.925.284 1.35.404h.114v9.862a25.485 25.485 0 0 0-4.238 5.514c-.197.376-.516.67-.901.83a1.74 1.74 0 0 1-1.21.048 1.79 1.79 0 0 1-.96-.757 1.867 1.867 0 0 1-.269-1.211l1.562-4.63ZM19.822 14H17V6a2 2 0 1 1 4 0v6.823c0 .65-.527 1.177-1.177 1.177Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
            <form action="{{ route('client.topics.dislike', $topic->id) }}" method="POST" class="dislike-form">
                @csrf
                <button type="submit" class="dislike-icon">
                    <!-- SVG for dislike icon -->
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M8.97 14.316H5.004c-.322 0-.64-.08-.925-.232a2.022 2.022 0 0 1-.717-.645 2.108 2.108 0 0 1-.242-1.883l2.36-7.201C5.769 3.54 5.96 3 7.365 3c2.072 0 4.276.678 6.156 1.256.473.145.925.284 1.35.404h.114v9.862a25.485 25.485 0 0 0-4.238 5.514c-.197.376-.516.67-.901.83a1.74 1.74 0 0 1-1.21.048 1.79 1.79 0 0 1-.96-.757 1.867 1.867 0 0 1-.269-1.211l1.562-4.63ZM19.822 14H17V6a2 2 0 1 1 4 0v6.823c0 .65-.527 1.177-1.177 1.177Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Форма для добавления нового комментария -->
    <form action="{{ route('client.comments.store', $topic->id) }}" method="POST" class="comment-form">
        @csrf
        <div class="form-group">
            <input type="text" id="comment_content" name="content" required>
            <label for="comment_content">{{ __('messages.add_comment') }}</label>
        </div>
        <button type="submit">{{ __('messages.submit') }}</button>
    </form>

    <!-- Отображение существующих комментариев -->
    <div class="comments">
        @if($topic->comments)
        @foreach($topic->comments as $comment)
        <div class="comment">
            <div class="comment-info">
                <img class="user-avatar" src="{{ asset($comment->user->avatar) }}" alt="User Avatar">
                <div class="user-info">
                    <div class="user-role">
                        <span class="username">{{ $comment->user->name }}</span>
                        @if($comment->user->content_maker)
                        <span class="role">{{ __('messages.content_maker') }}</span>
                        @elseif($comment->user->admin)
                        <span class="role">{{ __('messages.admin') }}</span>
                        @endif
                    </div>
                    <span class="timestamp">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
            </div>
            <div class="comment-content">
                @if ($comment->approval_status == 'approved')
                <p>{{ $comment->original_content }}</p>
                @elseif ($comment->approval_status == 'rejected')
                <p>Comment rejected</p>
                @else
                <p>{{ $comment->content }}</p>
                @endif
            </div>
            <div class="comment-actions">
                @if(auth()->user() && $comment->user_id !== auth()->user()->id)
                <form action="{{ route('client.comments.like', $comment->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="like-icon">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" style="transform: rotate(180deg);">
                            <path fill-rule="evenodd" d="M8.97 14.316H5.004c-.322 0-.64-.08-.925-.232a2.022 2.022 0 0 1-.717-.645 2.108 2.108 0 0 1-.242-1.883l2.36-7.201C5.769 3.54 5.96 3 7.365 3c2.072 0 4.276.678 6.156 1.256.473.145.925.284 1.35.404h.114v9.862a25.485 25.485 0 0 0-4.238 5.514c-.197.376-.516.67-.901.83a1.74 1.74 0 0 1-1.21.048 1.79 1.79 0 0 1-.96-.757 1.867 1.867 0 0 1-.269-1.211l1.562-4.63ZM19.822 14H17V6a2 2 0 1 1 4 0v6.823c0 .65-.527 1.177-1.177 1.177Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
                <form action="{{ route('client.comments.dislike', $comment->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="dislike-icon">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M8.97 14.316H5.004c-.322 0-.64-.08-.925-.232a2.022 2.022 0 0 1-.717-.645 2.108 2.108 0 0 1-.242-1.883l2.36-7.201C5.769 3.54 5.96 3 7.365 3c2.072 0 4.276.678 6.156 1.256.473.145.925.284 1.35.404h.114v9.862a25.485 25.485 0 0 0-4.238 5.514c-.197.376-.516.67-.901.83a1.74 1.74 0 0 1-1.21.048 1.79 1.79 0 0 1-.96-.757 1.867 1.867 0 0 1-.269-1.211l1.562-4.63ZM19.822 14H17V6a2 2 0 1 1 4 0v6.823c0 .65-.527 1.177-1.177 1.177Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
                @endif
                <span class="like-count" id="like-count-{{ $comment->id }}">{{ __('messages.likes') }} {{ $comment->like_count }}</span>
                <span class="dislike-count" id="dislike-count-{{ $comment->id }}">{{ __('messages.dislikes') }} {{ $comment->dislike_count }}</span>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>

@endsection