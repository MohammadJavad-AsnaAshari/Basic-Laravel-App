@extends('layouts.app')

@section("title", "Create The Post")

@section('content')
    <form action="{{route('posts.store')}}" method="Post">
        @csrf
        <div>
            <input type="text" name="title">
        </div>
        <div>
            <textarea name="content"></textarea>
        </div>
        <div>
            <input type="submit" value="Create">
        </div>
    </form>
@endsection
