{{--<div>{{ $key }}. {{ $post["title"] }}</div>--}}

@if($loop->even)
    <div>{{ $post["title"] }}</div>
@else
    <div style="background-color: silver">{{ $post["title"] }}</div>
@endif
