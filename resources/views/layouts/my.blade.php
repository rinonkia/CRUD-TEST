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
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name') }}
                    </a>
                    <button class="navbar-toggler" type='button' data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        {{-- Navbarの左側 --}}
                        <ul class="navbar-nav mr-auto">
                            {{-- 記事とユーザーへのリング --}}
                            <li class="nav-item @if (my_is_current_controller('posts')) active @endif">
                                <a class="nav-link" href="{{ url('posts') }}">
                                    {{ __('Posts') }}
                                    @if (my_is_current_controller('posts'))
                                        <span class="sr-only">(current)</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item @if (my_is_current_controller('users')) active @endif">
                                <a class="nav-link" href="{{ url('users') }}">
                                    {{ __('Users') }}
                                    @if (my_is_current_controller('users'))
                                        <span class="sr-only">(current)</span>
                                    @endif
                                </a>
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
                                <li class="nav-item @if (my_is_current_controller('login', 'password')) active @endif">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        {{ __('Login') }}
                                        @if (my_is_current_controller('login', 'password'))
                                            <span class="sr-only">(current)</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="nav-item @if (my_is_current_controller('register')) active @endif">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        {{ __('Register') }}
                                        @if (my_is_current_controller('register'))
                                            <span class="sr-only">(current)</span>
                                        @endif
                                    </a>
                                </li>
                            @else
                                {{-- 「プロフィール」と「ログアウト」のドロップダウンメニュ --}}
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                                        <a class="dropdown-item" href="{{ url('users/'.auth()->user()->id) }}">
                                            {{ __('Profile') }} 
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            {{ __('Logout') }}
                                        </a>
                                    </div>
                                </li>
                            @endguest
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown-lang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('locale.'.App::getLocale()) }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-lang">
                                    @if (!App::isLocale('en'))
                                        <a class="dropdown-item" href="{{ my_locale_url('en') }}">
                                            {{ __('locale.en') }}
                                        </a>
                                    @endif
                                    @if (!App::isLocale('ja'))
                                        <a class="dropdown-item" href="{{ my_locale_url('ja') }}">
                                            {{ __('locale.ja') }}
                                        </a>
                                    @endif
                                </div>
                            </li>   
                        </ul>
                    </div>
                </div>
            </nav>
            @if (session('my_status'))
                <div class="container mt-2">
                    <div class="alert alert-success">
                        {{ session('my_status') }}
                    </div>
                </div>
            @endif

            <main class="py-4">
                @yield('content')
            </main>
        </div>

        {{-- JavaScript --}}
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>