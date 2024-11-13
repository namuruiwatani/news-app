@extends('layouts.admin')
<style>
    .page-container {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
    }
    
    h1 {
        color: #333;
        text-align: center;
    }
    
    .table {
        width: 75%;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }
    
    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    th {
        background-color: #483D8B;
        color: #fff;
    }
    
    tbody tr:hover {
        background-color: #1f1f1f;
    }
    
    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .btn-success {
        background-color: #008000;
        color: #fff;
    }
    
    .btn-success:hover {
        background-color: #483D8B;
    }
    
    .btn-danger {
        background-color: #1f1f1f;
        color: #fff;
    }
    
    .btn-danger:hover {
        background-color: #483D8B;
    }
    
    input[type="checkbox"] {
        transform: scale(1.5);
        margin: 0 5px;
    }
</style>
@section('content')
<h1>Users</h1>
<div class="page-container">
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Content Maker</th>
                <th>Admin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->trashed())
                        <span>N/A</span>
                    @else
                    <form action="{{ route('admin.users.toggle-role', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="content_maker" value="1">
                        <input type="checkbox" {{ $user->content_maker ? 'checked' : '' }} onclick="this.form.submit()">
                    </form>
                    @endif
                </td>
                <td>
                    @if($user->trashed())
                        <span>N/A</span>
                    @else
                    <form action="{{ route('admin.users.toggle-role', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="admin" value="1">
                        <input type="checkbox" {{ $user->admin ? 'checked' : '' }} onclick="this.form.submit()">
                    </form>
                    @endif
                </td>
                <td>
                    @if($user->trashed())
                    <form action="{{ route('admin.users.restore', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">Restore</button>
                    </form>
                    @else
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
