

<ul>
    <li>Name: {{ $user->name }}</li>
    <li>Email: {{ $user->email }}</li>
</ul>
<hr>
@php

    $request = session();
    dd($request);

@endphp