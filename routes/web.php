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
    return "Home Page";
})->name("home.index");

Route::get("/contact", function () {
    return "Contact Page";
})->name("home.contact");

Route::get("/posts/{id}", function ($id) {
    return "Blog post " . $id;
})->name("posts.show");

Route::get("/recent-posts/{days_ago?}", function ($daysAgo = 20) {
    return "Posts from " . $daysAgo . " days ago";
})->name("posts.recent.index");
