<div class="form-group mb-3">
    <label class="form-label" for="title">Title</label>
    <input class="form-control" id="title" type="text" name="title"
           value="{{old('title', optional($post ?? null)->title)}}">
    @error("title")
    <div>{{$message}}</div>
    @enderror
</div>
<div class="form-group mb-3">
    <label class="form-label" for="content">Content</label>
    <textarea class="form-control" id="content" rows="5"
              name="content">{{old('content', optional($post ?? null)->content)}}</textarea>
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
