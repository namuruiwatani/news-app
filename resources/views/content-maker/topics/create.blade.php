@extends('layouts.content-maker')

@section('content')
<div class="centered-content">
    <h1>Create New Topic</h1>

    <form action="{{ route('content-maker.topics.store') }}" method="POST" enctype="multipart/form-data" class="animated-form">
        @csrf
        <div class="form-group">
            <label for="title" class="label">Title</label>
            <input type="text" name="title" class="form-control input" required>
        </div>
        <div class="form-group">
            <label for="category_id" class="label">Category</label>
            <select name="category_id" class="form-control select" required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="label">Tags</label>
            <select name="tags[]" class="form-control select" multiple>
                @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="img" class="label">Image</label>
            <input type="file" name="img" class="form-control-file input" required>
        </div>
        <div class="form-group">
            <label for="content" class="label">Content</label>
            <textarea name="content" class="form-control textarea" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary submit">Submit</button>
    </form>
</div>
@endsection

<style>
    .centered-content {
        text-align: center;
    }

    .animated-form {
        background-color: #3e416f;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        width: 40%;
        margin: auto;
    }

    .animated-form h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .label {
        color: #f3f3f3;
    }

    .input {
        background-color: #686c9e;
        color: #dcdcdc;
        border: none;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .select {
        background-color: #686c9e;
        color: #dcdcdc;
        border: none;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .form-control-file.input {
        color: #dcdcdc;
    }

    .textarea {
        background-color: #686c9e;
        color: #dcdcdc;
        border: none;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .submit {
        background-color: #dcdcdc;
        color: #2d3047;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
    }
</style>