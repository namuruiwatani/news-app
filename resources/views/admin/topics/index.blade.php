@extends('layouts.admin')

<style>
    .container {
        margin-top: 50px;
        text-align: center;
    }

    h2 {
        color: #b388ff;
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .btn-primary {
        background-color: #1f1f1f;
        border: none;
        color: white;
        padding: 12px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 18px;
        margin-bottom: 30px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .table {
        width: 75%;
        margin: 0 auto;
        border-collapse: collapse;
    }

    th {
        background-color: #333;
        color: white;
        font-weight: bold;
        padding: 18px 24px;
        text-align: left;
    }

    td {
        border-bottom: 1px solid #ddd;
        padding: 15px 24px;
        text-align: left;
    }

    .btn-group {
        display: flex;
    }

    .btn-primary:hover {
        background-color: #483D8B;
    }

    .btn-primary.btn-sm,
    .btn-danger.btn-sm {
        padding: 8px 16px;
        margin-right: 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-primary.btn-sm:hover{
        background-color: #483D8B;
    }

    .btn-danger.btn-sm {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        background: #1f1f1f;
        color: #fff;
    }

    .btn-danger.btn-sm:hover {
        background-color: #483D8B;
    }
</style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Topics</h2>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('admin.topics.create') }}" class="btn btn-primary mb-3">Add Topic</a>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topics as $topic)
                    <tr>
                        <td>{{ $topic->title }}</td>
                        <td>{{ $topic->category->name }}</td>
                        @if ($topic->user)
                        <td>{{ $topic->user->name }}</td>
                        @else
                        <td>User not available</td>
                        @endif
                        <td>{{ $topic->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.topics.show', $topic->id) }}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{ route('admin.topics.edit', $topic->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.topics.destroy', $topic->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this topic?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection