<?php

use App\UserPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['verify' => true]);
Route::get('profile', function () {
    return '<h1>This is profile page</h1>';
})->middleware('verified');

Auth::routes();
Route::get('/myconfess', 'HomeController@myConfess')->name('myconfess');

Route::get('/home', function () {
    if (Auth::check())
    {
        $allPosts=UserPost::with('user')->orderBy('created_at', 'DESC')->paginate(5); // will make infinite scroll
        return view('home', compact('allPosts'));
    }
    return view('welcome');
})->name('home');
Route::get('/', function (){
    return view('welcome');
});

Route::post('/lik','HomeController@test_like');
Route::post('storePosts','HomeController@storePosts');
Route::post('/postComment','HomeController@postComment');
Route::post('/comment/store', 'CommentController@store');
Route::post('/reply/store', 'CommentController@replyStore')->name('reply.add');
Route::any('/post/{num}', 'HomeController@postSearch');
Route::post('/deletePost','HomeController@deletePost');
