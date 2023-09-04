@extends('layouts.app')

@section("title", "Update The Post")

@section('content')
    <form action="{{route('posts.update', ['post' => $post->id])}}" method="post">
        @csrf
        @method("put")

        @include("posts.partials.form")
        <div class="d-grid">
            <input class="btn btn-primary" type="submit" value="Update">
        </div>
    </form>
@endsection
