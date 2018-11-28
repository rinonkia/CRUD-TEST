<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=divice-width, inisial-scale=1">

        {{-- CSRF トークン --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@if (! Request::is('/')){{ $title }} | @endif{{ env('APP_NAME')}}</title>

        {{-- CSS --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name') }}
                    </a>
                    <button class="navbar-toggle" type='button' data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                        <span class="navbar-toggle-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportContent">
                        {{-- Navbarの左側 --}}
                        <ul class="navbar-bav mr-auto">
                            {{-- 記事とユーザーへのリング --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('posts') }}">{{ __('Posts') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('users') }}">{{ __('Users') }}</a>
                            </li>
                        </ul>

                        {{-- Mavbarの右側 --}}
                        <ul class="navbar-nav ml-auto">
                            {{-- 投稿ボタン --}}
                            <li class="nav-item">
                                <a href="{{ url('posts/create') }} " id="new-post" class="btn btn-success">
                                    {{ __('New post')}}
                                </a>
                            </li>

                            {{-- 認証関連のリンク --}}
                            @guest
                                {{-- 「ログイン」と「ユーザー登録」へのリンク --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ ('__Login') }}</a>
                                </li>
                                <li class="nav-item">>
                                    <a class="nav-link" href="{{ route('register')}}">{{ ('__Register') }}</a>
                                </li>
                            @else
                                {{-- 「プロフィール」と「ログアウト」のドロップダウンメニュ --}}
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdown-user" data-target="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                                        <a class="dropdown-item" href="{{ url('users/'.auth()->user()->id) }}">
                                            {{ __('Profile') }} 
                                        </a>
                                        <a class="dropdown-item" href="{{ route('login') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ ('__Logout') }}
                                        </a>
                                        <form id="login-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf 
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>

        {{-- JavaScript --}}
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>