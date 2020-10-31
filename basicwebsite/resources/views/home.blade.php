@extends('layouts.master')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1>Home</h1>

    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique quae ex voluptates omnis consectetur aliquam, iste ipsum quod nesciunt delectus quasi, dicta laboriosam accusantium molestias accusamus autem soluta dolor eaque!
    </p>

@endsection
@section('sidebar')
    
    @parent
    This is appended to the sidebar.

@endsection                                                             