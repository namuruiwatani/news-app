@extends('layouts.content-maker')

<style>
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
    }

    .timestamp {
        color: #4b0082;
    }

    .comment {
        background-color: #444;
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .comment-content p {
        color: #fff;
    }

    .comment-info {
        display: flex;
        align-items: center;
    }

    .user-avatar {
        margin-right: 10px;
    }

    .user-info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        order: 1;
    }

    .comment-form {
        margin-top: 20px;
    }

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
        transition: all 0.3s ease-in-out;
        font-size: 1.2rem;
        font-weight: bold;
        font-family: Arial, sans-serif;
    }


    .comment-form input,
    .comment-form textarea {
        width: 100%;
        padding: 0.5rem;
        border-radius: 5px;
        border: 1px solid #8a2be2;
        background-color: #333;
        color: #fff;
        transition: all 0.3s ease-in-out;
        margin: 30px 0 0 0;
    }

    .comment-form input:focus,
    .comment-form textarea:focus {
        outline: none;
        border-color: #4b0082;
    }

    .comment-form input:focus+label,
    .comment-form textarea:focus+label,
    .comment-form input:not(:placeholder-shown)+label,
    .comment-form textarea:not(:placeholder-shown)+label {
        color: #4b0082;
    }

    .comment-form textarea {
        min-height: 100px;
    }

    .comment-form button {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 5px;
        background-color: #8a2be2;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .comment-form button:hover {
        background-color: #4b0082;
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
        <h1>{{ $topic->title }}</h1>
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
        <p>Likes: {{ $topic->likes_count }}</p>
        <p>Dislikes: {{ $topic->dislikes_count }}</p>
    </div>

    <!-- Форма для добавления нового комментария -->
    <form action="{{ route('content-maker.comments.store', $topic->id) }}" method="POST" class="comment-form">
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
                        <span class="role">Content Maker</span>
                        @elseif($comment->user->admin)
                        <span class="role">Admin</span>
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
                <span class="like-count" id="like-count-{{ $comment->id }}">like: {{ $comment->like_count }}</span>
                <span class="dislike-count" id="dislike-count-{{ $comment->id }}">Dislike: {{ $comment->dislike_count }}</span>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>

@endsection