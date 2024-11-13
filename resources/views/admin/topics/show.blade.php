@extends('layouts.admin')

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
        align-items: center;
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

    .btn-danger {
        margin: 5px;
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
        /* Абсидианновый */
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
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <h1>{{ $topic->title }}</h1>

                <div class="card-body">
                    <img class="topic-img" src="{{ asset('storage/' . $topic->img) }}" class="img-fluid mb-3" alt="{{ $topic->title }}">

                    <p>{{ $topic->content }}</p>
                    @if ($topic->tags->isNotEmpty())
                    <p>Tags:
                        @foreach ($topic->tags as $tag)
                        <span>{{ $tag->name }}</span>
                        @endforeach
                    </p>
                    @else
                    <p>No tags associated with this topic.</p>
                    @endif
                    <p>Category: {{ $topic->category->name }}</p>
                    <p>Author: {{ $topic->user ? $topic->user->name : 'User not available' }}</p>
                    <p>Created At: {{ $topic->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- здесь инпут чтобы отвечать на комментарии клиентов. -->

    <!-- список комментариев -->
    <!-- Форма для добавления нового комментария -->
    <form action="{{ route('admin.comments.store', $topic->id) }}" method="POST" class="comment-form">
        @csrf
        <div class="form-group">
            <input type="text" id="comment_content" name="content" required>
            <label for="comment_content">Add Comment:</label>
        </div>
        <button type="submit">Submit</button>
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
                        <span class="role">content maker</span>
                        @elseif($comment->user->admin)
                        <span class="role">admin</span>
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
                <p>original: {{ $comment->original_content }}</p>
            </div>
            <div class="comment-actions">
                @if (strpos($comment->content, '*') !== false)
                <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
                <form action="{{ route('admin.comments.reject', $comment->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
                @endif
                <span class="like-count" id="like-count-{{ $comment->id }}">like: {{ $comment->like_count }}</span>
                <span class="dislike-count" id="dislike-count-{{ $comment->id }}">Dislike: {{ $comment->dislike_count }}</span>
                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to delete this comment?')">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>

@endsection