<?php

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

Route::get("/home", function () {
    return view("home.index");
})->name("home.index");

Route::get("/contact", function () {
    return view("home.contact");
})->name("home.contact");

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
    return view("posts.index", compact("posts"));
});

Route::get("/posts/{id}", function ($id) use ($posts) {
    abort_if(!isset($posts[$id]), 404);
    return view("posts.show", ["post" => $posts[$id]]);
})->name("posts.show");

Route::get("/recent-posts/{days_ago?}", function ($daysAgo = 20) {
    return "Posts from " . $daysAgo . " days ago";
})->name("posts.recent.index");

Route::get("/fun/response", function () use ($posts) {
    return response($posts, 201)
        ->header("Contenct-Type", "application/json")
        ->cookie("MY_COOKIE", "MJ", 60 * 60);
});
