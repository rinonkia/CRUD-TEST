@php
    $title = __('Edit'). ':' .$user->name;
@endphp
@extends('layouts.my')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <form action="{{ url('users/'.$user->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-group @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name', $user->name) }}" required autofocus>
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>
        <button type="submit" name="submit" class="btn btn-primary">{{ __('Change') }}</button>
    </form>
</div>
@endsection