@extends('layouts.master')

@section('content')
    <h1>Contact</h1>
    {{ Form::open(['route' => 'messages.submit']) }}
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', '', ['class' => 'form-control mb-3', 'placeholder' => 'Enter Name']) }}
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('email', 'E-Mail Address') }}
            {{ Form::email('email', '', ['class' => 'form-control mb-3', 'placeholder' => 'Enter Email Address']) }}
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('message', 'Message') }}
            {{ Form::textarea('message', '', ['class' => 'form-control', 'placeholder' => 'Enter Message']) }}
        </div>
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection

