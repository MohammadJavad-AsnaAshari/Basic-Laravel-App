@extends('layouts.app')

@section("title", "Create The Post")

@section('content')
    <form action="{{route('posts.store')}}" method="Post">
        @csrf

        @include("posts.partials.form")
        <div class="d-grid">
            <input class="btn btn-primary" type="submit" value="Create">
        </div>
    </form>
@endsection
