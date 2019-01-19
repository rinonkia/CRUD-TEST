@php
    $title =__('Post');
@endphp
@extends('layouts.my')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('Author') }}</th>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Body') }}</th>
                    <th class="th-created">{{ __('Created') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>
                            <a href="{{ url('users/'.$post->user->id) }}">
                                {{ $post->user->name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ url('posts/'.$post->id) }}">
                                {{ $post->title }}
                            </a>
                        </td>
                        <td>{{ $post->body }}</td>
                        <td class="td-created">{{ $post->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $posts->links() }}
</div>
    
@endsection