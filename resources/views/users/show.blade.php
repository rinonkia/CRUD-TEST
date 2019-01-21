@php
    $title = $user->name;
@endphp
@extends('layouts.my')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    {{-- 編集・削除ボタン --}}

    @can('edit', $user)
        <div>
            <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-primary">
                {{ __('Edit') }}
            </a>
            {{-- 削除ボタン --}}
            @component('components.btn-del')
                @slot('controller', 'users')
                @slot('id', $user->id)
                @slot('name', $user->name)
            @endcomponent
        </div>
    @endcan
    

    {{-- ユーザー1件の情報 --}}
    <dl class="row">
        <dt class="col-md-2">{{ __('ID') }}</dt>
        <dt class="col-md-10">{{ $user->id }}</dt>
        @if(Auth::id() == $user->id)
            <dt class="col-md-2">{{ __('E-Mail Address')}}</dt>
            <dt class="col-md-10">{{ $user->email }}</dt>
        @endif
    </dl>

    {{-- ユーザの記事一覧 --}}
    <h2>{{ __('Post') }}</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Body') }}</th>
                    <th class="th-created">{{ __('Created') }}</th>
                    <th class="th-updated">{{ __('Updated') }}</th>
                    
                    @can('edit', $user)
                        {{-- 記事の編集・削除ボタンのカラム --}}
                        <th></th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach($user->posts as $post)
                    <tr>
                        <td>
                            <a href="{{ url('posts/'. $post->id) }}">
                                {{ $post->title }}
                            </a>
                        </td>
                        <td>{{ $post->body }}</td>
                        <td class="td-created">{{ $post->created_at }}</td>
                        <td class="td-updated">{{ $post->updated_at }}</td>
                        @can('edit', $user)
                            <td nawrap>
                                <a href="{{ url('posts/'.$post->id.'/edit') }}" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </a>
                                @component('components.btn-del')
                                    @slot('controller', 'posts')
                                    @slot('id', $post->id)
                                    @slot('name', $post->title)
                                @endcomponent
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $user->posts->links() }}
</div>

@endsection