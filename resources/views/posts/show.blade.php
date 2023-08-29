@extends("layouts.app")
@section("title", $post["title"])

@if($post["is_new"])
    <div>A new blog post! Using if</div>
@else
    <div>Blog post is old! using elseif/else</div>
@endif

@unless($post["is_new"])
    <div>It is an old post... using unless</div>
@endunless

@section("content")
    <h1>{{$post["title"]}}</h1>
    <p>{{$post["content"]}}</p>

    @isset($post["has_comments"])
        <div>The post has some comments... using isset</div>
    @endisset

    @empty($post["has_comments"])
        <div>The post has some comments... using empty</div>
    @endempty
@endsection
