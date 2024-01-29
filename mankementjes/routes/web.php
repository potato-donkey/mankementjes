<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Delete comment
Route::get('mankementje/{id}/comment/{comment_id}/delete', function ($id, $comment_id) {
    if(Auth::guest()) {
        return redirect('/me/login');
    }
    
    $comment = \App\Models\Comment::findOrFail($comment_id);
    
    if(Auth::user()->id != $comment->user_id && Auth::user()->id != 0) {
        return redirect("/mankementje/$id");
    }
    
    $comment->delete();

    return redirect("/mankementje/$id");
});

Route::get('melden', function () {
    if(Auth::guest()) {
        return redirect('/me/login');
    }
    
    return view('new-mankement');
});

Route::post('melden', function () {
    if(Auth::guest()) {
        return redirect('/me/login');
    }
    
    $mankementje = \App\Models\Mankementje::create([
        'user_id' => Auth::user()->id,
        'title' => request('title'),
        'description' => request('description'),
        'date' => date('m/d/Y H:i:s'),
        'park' => request('park'),
        'location' => request('location'),
        'image' => '/assets/noimg.jpg',
        'status' => 'Open'
    ]);

    return redirect('/mankementje/' . $mankementje->id);
});

Route::get('mankementje/{id}/solve', function ($id) {
    if(Auth::guest()) {
        return redirect('/me/login');
    }
    
    $mankementje = \App\Models\Mankementje::findOrFail($id);
    
    if($mankementje->user_id != Auth::user()->id) {
        return redirect('/mankementje/' . $mankementje->id);
    }
    
    $mankementje->status = 'Opgelost';
    $mankementje->solve_date = date('m/d/Y H:i:s');
    $mankementje->save();

    return redirect('/');
});

// Park pages
Route::get('park/{park}', function ($park) {
    return view('park', [
        'park' => App\Models\Park::findOrFail($park)
    ]);
});

// User pages
Route::get('me', function () {
    if(Auth::guest()) {
        return redirect('/me/login');
    }
    
    return view('profile');
});

Route::get('me/login', function () {
    if(Auth::user()) {
        return redirect('/me');
    }
    
    return view('login');
});

Route::get('me/register', function () {
    if(Auth::user()) {
        return redirect('/me');
    }
    
    return view('register');
});

Route::post('me/login', 'App\Http\Controllers\LoginController@authenticate');

Route::post('me/register', 'App\Http\Controllers\LoginController@create');

Route::get('me/logout', 'App\Http\Controllers\LoginController@logout');

// Admin pages

Route::get('admin', function () {
    if(Auth::guest()) {
        return redirect('/me/login');
    }
    
    if(Auth::user()->id != 0) {
        return redirect('/');
    }
    
    return view('admin.dashboard');
});

Route::get('admin/mankementje/{id}/delete', function () {
    if(Auth::guest()) {
        return redirect('/me/login');
    }
    
    if(Auth::user()->id != 0) {
        return redirect('/');
    }
    
    $mankementje = \App\Models\Mankementje::findOrFail(request('id'));
    $mankementje->delete();

    return redirect('/admin');
});

// Misc pages

Route::get('privacy', function () {
    return view('privacy');
});