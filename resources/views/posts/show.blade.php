@php
    $title = $post->title;
@endphp

@extends('layouts.my')
@section('content')
<div class="container">

    {{-- 記事内容 --}}
    <dl class="row">
        <dt class="col-md-12">{{ __('Author') .': '}}
            <a href="{{ url('users/'.$post->user->id) }}">
                {{ $post->user->name }}
            </a>
        </dt>
        <dt class="col-md-12">{{ __('Created') .': '}}
            <time itemprop="dateCreated" datetime="{{ $post->created_at }}">
                {{ $post->created_at }}
            </time>
        </dt>
        <dt class="col-md-12">{{ __('Updated') .': '}}
            <time itemprop="dateMedified" datetime="{{ $post->updated_at }}">
                {{ $post->updated_at }}
            </time>
        </dt>
    </dl>
    <h2 id="post-title">{{ __('Title') . ': '. $title }}</h1>
    <hr>
    <div id="post-body">
        {{ $post->body }}
    </div>
    <hr>

    {{-- 編集・削除ボタン --}}
    @auth
        @can('edit', $post)
            <div class="edit">
                <a href="{{ url('posts/'.$post->id.'/edit') }}" class="btn btn-primary">
                    {{ __('Edit') }}
                </a>
                @component('components.btn-del')
                    @slot('controller', 'posts')
                    @slot('id', $post->id)
                    @slot('name', $post->title)
                @endcomponent
            </div>
        @endcan
    @endauth
</div>
@endsection
