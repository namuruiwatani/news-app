@extends('layouts.admin')
<style>
    .page-container {
        margin-top: 50px;
        display: flex;
        justify-content: center;
        text-align: center;
    }

    .row {
        width: 55%;
    }

    h2 {
        color: #333;
    }

    label {
        color: #333;
    }

    input[type="text"] {
        border: 2px solid #483D8B;
        border-radius: 5px;
        padding: 10px;
        width: 100%;
        margin-bottom: 20px;
        font-size: 16px;
        color: #333;
        background: #1f1f1f;
    }

    input[type="text"]:focus {
        outline: none;
        border-color: #8A2BE2;
    }

    button[type="submit"] {
        background-color: #1f1f1f;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #483D8B;
    }

    .table {
        width: 100%;
        margin-top: 20px;
        text-align: center;
    }

    .table th {
        background-color: #333;
        color: #fff;
        padding: 10px;
    }

    .table td {
        background-color: #171717;
        color: #fff;
        padding: 10px;
    }

    .btn-danger {
        background-color: #DC143C;
        border-color: #DC143C;
    }
</style>

@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-md-6">
            <h2 style="color: #b388ff;">Add New Category</h2>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" style="color: #8A2BE2;">Category Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required style="color: #8A2BE2;margin-top: 10px;">
                </div>
                <button type="submit" class="btn btn-primary">Add Category</button>
            </form>
        </div>
        <div class="col-md-6">
            <h2 style="color: #b388ff;">Existing Categories</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
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