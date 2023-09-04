<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Basic Laravel App - @yield("title")</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div>

    {{--    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm mb-3">--}}
    {{--        <h5 class="my-0 mr-md-auto font-weight-normal">Laravel App</h5>--}}
    {{--        <nav class="my-2 my-md-0 me-md-3">--}}
    {{--            <a class="p-2 text-dark" href="{{route('home.index')}}">Home</a>--}}
    {{--            <a class="p-2 text-dark" href="{{route('home.contact')}}">Contact</a>--}}
    {{--            <a class="p-2 text-dark" href="{{route('posts.index')}}">Blog Posts</a>--}}
    {{--            <a class="p-2 text-dark" href="{{route('posts.create')}}">Add Blog Post</a>--}}
    {{--        </nav>--}}
    {{--    </div>--}}

    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Laravel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('home.index')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home.contact')}}">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('posts.index')}}">Blog Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('posts.create')}}">Add Blog Post</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        @if(session("status"))
            <div style="background-color: orange; color: white">
                {{session("status")}}
            </div>
        @endif
        @yield("content")
    </div>
</div>
</body>
</html>
