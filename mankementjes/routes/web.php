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
    return view('home');
});

Route::get('mankementje/{id}', function ($id) {
    return view('mankementje', [
        'mankementje' => App\Models\Mankementje::findOrFail($id)
    ]);
});

Route::get('archief', function () {
    return view('archive');
});

Route::get('park/{park}', function ($park) {
    return view('park', [
        'park' => App\Models\Park::findOrFail($park)
    ]);
});

Route::post('mankementje/{id}/comment', function ($id) {
    if(Auth::guest()) {
        return redirect('/me/login');
    }
    
    \App\Models\Comment::create([
        'mankementje_id' => $id,
        'user_id' => Auth::user()->id,
        'content' => request('comment'),
        'date' => date('m/d/Y H:i:s')
    ]);

    return redirect("/mankementje/$id");
});

// User pages
Route::get('me', function () {
    if(Auth::guest()) {
        return redirect('/me/login');
    }
    
    return view('profile');
});

Route::get('me/login', function () {
    return view('login');
});

Route::post('me/login', 'App\Http\Controllers\LoginController@authenticate');

Route::get('me/logout', 'App\Http\Controllers\LoginController@logout');