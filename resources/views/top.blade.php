@php
    $title = env('APP_NAME')
@endphp

@extends('layouts.my')
@section('title', $title)
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <p>
        {{ __('My practice for basic CRUD of Laravel 5.7 on Heroku') }}
    </p>
    <ul>
        <li>
            GitHub:
            <a href="https://github.com/rinonkia/CRUD-TEST" target="_blank">
                https://github.com/rinonkia/CRUD-TEST
            </a>
        </li>
        <li>
            Qiita:
            <a href="https://qiita.com/sutara79/items/ef30fcdfb7afcb2188ea" target="_blank">
                    Laravel 5.7で基本的なCRUDを作る
            </a>
        </li>
    </ul>
    <h2>{{ __('Feature') }}</h2>
    <ul>
        <li>{{ __('All visitors can read all posts.') }}</li>
        <li>{{ __('All visitors can read all users\' profile except email address.') }}</li>
        <li>{{ __('All visitors can sign up.') }}</li>
        <li>{{ __('Each the logged in user can post, edit and delete.') }}</li>
        <li>
            {{ __('The admin can edit and delete all users\' account and posts.') }}
            <ul>
                <li>
                    {{ __('User') }}:
                    <ul>
                        <li>id: 1</li>
                        <li>name: user001</li>
                        <li>email: user001@test.com</li>
                        <li>password: user001</li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    <h2>{{ __('Changes from Original Site')}}</h2>
    <ul>
        <li>{{ __('Made not to display user\'s mail address.')}}</li>
        <li>{{ __('Created style.css and make it more mobile-friendly.')}}</li>
    </ul>

</div>
@endsection
