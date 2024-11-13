@extends('layouts.content-maker')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Topics</h2>
            <a href="{{ route('content-maker.topics.create') }}" class="btn btn-primary mb-3">Add Topic</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topics as $topic)
                    <tr>
                        <td>{{ $topic->title }}</td>
                        <td>{{ $topic->category->name }}</td>
                        <td>{{ $topic->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('content-maker.topics.show', $topic->id) }}" class="btn btn-sm btn-primary">View</a>
                            <a href="{{ route('content-maker.topics.edit', $topic->id) }}" class="btn btn-sm btn-success">Edit</a>
                            <form action="{{ route('content-maker.topics.destroy', $topic->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this topic?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
