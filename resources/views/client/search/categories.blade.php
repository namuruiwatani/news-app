@extends('layouts.client')

@section('content')
    <div class="centered-content">
        <h1>{{ __('messages.search_categories') }}</h1>

        <form action="{{ route('client.search.categories.result') }}" method="GET" class="animated-form">
            <input type="text" name="search" placeholder="{{ __('messages.enter_category_name') }}" class="search-input">
            <button type="submit" class="search-button">{{ __('messages.search') }}</button>
        </form>
    </div>
@endsection


<style>
    .centered-content {
        text-align: center;
    }

    .search-input {
        padding: 10px;
        border: 2px solid #ababab;
        border-radius: 5px;
        background-color: #292929;
        color: #ffffff;
        font-size: 16px;
        width: 340px;
        margin-right: 10px;
    }

    .search-button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #5e5e5e;
        color: #ffffff;
        font-size: 16px;
        cursor: pointer;
    }

    .animated-form {
        animation-name: slideInDown;
        animation-duration: 1s;
    }

    @keyframes slideInDown {
        from {
            transform: translateY(-100%);
        }
        to {
            transform: translateY(0%);
        }
    }
</style>
