@extends('layouts.admin')
<style>
    body {
        background-color: #0e1013;
        color: #ffffff;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    h1 {
        color: #8a2be2;
        text-align: center;
        margin-top: 20px;
    }

    div.profile-container {
        background-color: #1f1f1f;
        border-radius: 10px;
        padding: 20px;
        margin: 20px auto;
        max-width: 600px;
        text-align: center;
    }

    img.avatar {
        margin-bottom: 20px;
        border-radius: 24%;
        width: 250px;
        height: 250px;
        object-fit: cover;
    }

    form input[type='file'] {
        display: none;
    }

    form label {
        display: block;
        margin-bottom: 10px;
    }

    form input[type='text'],
    form input[type='password'] {
        background-color: #2e2e2e;
        border: none;
        border-radius: 5px;
        color: #ffffff;
        padding: 10px;
        margin-bottom: 15px;
        width: 100%;
    }

    form button {
        background-color: #483d8b;
        border: none;
        border-radius: 5px;
        color: #ffffff;
        padding: 10px 20px;
        margin-top: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form button:hover {
        background-color: #8a2be2;
    }

    p.email {
        color: #8a2be2;
        margin-top: 20px;
    }
</style>

@section('content')
<h1>Admin Profile</h1>
<div class="profile-container">
    <img class="avatar" src="{{ asset($user->avatar ?: 'storage/avatars/default-avatar.png') }}" alt="Avatar" width="150">
    @if (!$user->avatar)
    <p>No avatar found</p>
    @endif
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <input type="file" name="avatar" {{ $editing ? '' : ' disabled' }}>
        </div>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" {{ $editing ? '' : ' disabled' }}>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" {{ $editing ? '' : ' disabled' }}>
        </div>
        <div>
            <button type="button" onclick="toggleEditing()">Edit</button>
            <button type="submit" id="saveButton" style="display: none;">Save</button>
        </div>
    </form>
    <p class="email">Email: {{ $user->email }}</p>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>

<script>
    function toggleEditing() {
        document.querySelectorAll('input').forEach(input => input.disabled = !input.disabled);
        document.getElementById('saveButton').style.display = 'inline';
    }
</script>
@endsection