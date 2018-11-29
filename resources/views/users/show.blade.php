@php
    $title = __('User') . ':' . $user->name;
@endphp
@extends('layouts.my')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    {{-- 編集・削除ボタン --}}
    <div>
        <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-primary">
            {{ __('Edit') }}
        </a>
        {{-- 削除ボタン --}}
        @component('components.btn-del')
            @slot('table', 'users')
            @slot('id', $user->id)
        @endcomponent
    </div>

    {{-- ユーザー1件の情報 --}}
    <dl class="row">
        <dt class="col-md-2">{{ __('ID') }}</dt>
        <dt class="col-md-10">{{ $user->id }}</dt>
        <dt class="col-md-2">{{ __('Name') }}</dt>
        <dt class="col-md-10">{{ $user->name }}</dt>
        <dt class="col-md-2">{{ __('E-Mail Address') }}</dt>
        <dt class="col-md-10">{{ $user->email }}</dt>
    </dl>
</div>

@endsection