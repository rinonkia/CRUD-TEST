@php
    $title =__('Post');
@endphp
@extends('layout.php')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Body') }}</th>
                    <th>{{ __('Created_at') }}</th>
                    <th>{{ __('Updated_at') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>
                        <a href="{{ url('posts/'.$posts->id) }}">{{ $post->title }}>
                        </td>
                        <td>{{ $post->body }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>
                     </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection