@extends('layouts.app')

@section('content')
    <div class="container">
        <container-component :items="{{ json_encode($categories) }}"></container-component>
    </div>
@endsection
