<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/home", [HomeController::class, "home"])->name("home.index");

Route::get("/contact", [HomeController::class, "contact"])->name("home.contact");

$posts = [
    1 => [
        "title" => "Intro to Laravel",
        "content" => "This is a short intro to Laravel",
        "is_new" => true,
        "has_comments" => true
    ],
    2 => [
        "title" => "Intro to PHP",
        "content" => "This is a short intro to PHP",
        "is_new" => false,
        "has_comments" => true
    ],
    3 => [
        "title" => "Intro to SQL",
        "content" => "This is a short intro to SQL",
        "is_new" => false,
        "has_comments" => false
    ]
];

Route::get("/posts", function () use ($posts) {
//    dd(request()->all());
//    dd((int)request()->input("page", 2));
    dd((int)request()->query("page", 2));

    return view("posts.index", compact("posts"));
})->name("posts");

Route::get("/posts/{id}", function ($id) use ($posts) {
    abort_if(!isset($posts[$id]), 404);
    return view("posts.show", ["post" => $posts[$id]]);
})->name("posts.show");

Route::get("/recent-posts/{days_ago?}", function ($daysAgo = 20) {
    return "Posts from " . $daysAgo . " days ago";
})->name("posts.recent.index")->middleware("auth");

Route::prefix("/fun")->name("fun.")->group(function () use ($posts) {
    Route::get("/response", function () use ($posts) {
        return response($posts, 201)
            ->header("Content-Type", "application/json")
            ->cookie("MY_COOKIE", "MJ", 60 * 60);
    })->name("response");

    Route::get("/redirect", function () {
        return redirect("/");
    })->name("redirect");

    Route::get("/back", function () {
        return back();
    })->name("back");

    Route::get("/named-route", function () {
        return redirect()->route("posts.show", ["id" => 1]);
    })->name("named-route");

    Route::get("/away", function () {
        return redirect()->away("https://google.com");
    })->name("away");

    Route::get("/json", function () use ($posts) {
//    return response($posts, 200)->header("Content-Type", "application/json");
        return response()->json($posts);
    })->name("json");

    Route::get("/download", function () {
        return response()->download(public_path("laravelpro_logo.png"), "laravel.png");
    })->name("download");
});
