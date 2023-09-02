@extends('layouts.app')

@section("title", "Create The Post")

@section('content')
    <form action="{{route('posts.store')}}" method="Post">
        @csrf

        <div>
            <input type="text" name="title" value="{{old('title')}}">
            @error("title")
                <div>{{$message}}</div>
            @enderror
        </div>
        <div>
            <textarea name="content"></textarea>
            @error("content")
                <div>{{$message}}</div>
            @enderror
        </div>
        @if($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>
            <input type="submit" value="Create">
        </div>
    </form>
@endsection
