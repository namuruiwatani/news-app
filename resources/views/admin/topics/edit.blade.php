@extends('layouts.admin')

<style>
    .page-container {
        max-width: 800px;
        margin: 50px auto;
        background-color: #1f1f1f;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    h2 {
        color: #483D8B;
        text-align: center;
        margin-bottom: 30px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input[type="text"],
    textarea {
        width: calc(100% - 16px);
        border: 2px solid #483D8B;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 20px;
        font-size: 16px;
        color: #333;
        background: #1f1f1f;
    }

    input[type="text"]:focus,
    textarea:focus {
        outline: none;
        border-color: #8A2BE2;
    }

    select {
        width: calc(100% - 16px);
        padding: 12px;
        margin-bottom: 20px;
        border: 2px solid #483D8B;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
        color: #8A2BE2;
        background: #2e2e2e;
    }

    input[type="file"] {
        margin-top: 6px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #483D8B;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 12px 20px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #6A5ACD;
    }

    .form-control-file {
        display: block;
        font-size: 16px;
    }
</style>

@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-md-12">
            <h2>Edit Topic</h2>
            <form action="{{ route('admin.topics.update', $topic->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $topic->title }}" required style="color: #8A2BE2;">
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" class="form-control" required style="color: #8A2BE2;">{{ $topic->content }}</textarea>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $topic->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Tags</label>
                    <select name="tags[]" class="form-control" multiple>
                        @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection