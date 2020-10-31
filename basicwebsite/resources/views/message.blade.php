@extends('layouts.master')

@section('content')

    <h1>Messages</h1>

    @foreach ($messages as $message)
        <ul class="list-group mb-3">
            <ul class="list-group-item">Name: {{ $message->name }}</ul>
            <ul class="list-group-item">Email: {{ $message->email }}</ul>
            <ul class="list-group-item">Message: {{ $message->message }}</ul>
        </ul>
    @endforeach

@endsection
@section('sidebar')
    
    @parent
    This is appended to the sidebar.

@endsection