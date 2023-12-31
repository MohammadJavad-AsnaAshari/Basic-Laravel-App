<h3>
    <a class="link-dark" style="text-decoration: none"
       href="{{route("posts.show", ["post" => $post->id])}}">{{ $post->title }}
    </a>
</h3>

@if($post->comments_count)
    <p>{{$post->comments_count}} comments</p>
@else
    <p>No comments yet!</p>
@endif

<div class="mb-3">
    <a class="btn btn-primary" href="{{route("posts.edit", ["post" => $post->id])}}">Edit</a>
    <form class="d-inline" action="{{route("posts.destroy", ["post" => $post->id])}}" method="post">
        @csrf
        @method("delete")

        <input class="btn btn-danger" type="submit" value="Delete">
    </form>
</div>
