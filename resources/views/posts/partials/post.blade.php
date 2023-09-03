{{--<div>{{ $key }}. {{ $post["title"] }}</div>--}}

@if($loop->even)
    <div>{{ $post->title }}</div>
@else
    <div style="background-color: silver">{{ $post->title }}</div>
@endif

<div>
    <form action="{{route("posts.destroy", ["post" => $post->id])}}" method="post">
        @csrf
        @method("delete")

        <input type="submit" value="Delete">
    </form>
</div>
