<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('landing-page');
})->name('landing');

Route::post('/login-temporary', function (Request $request) {
    $email = strtolower($request->input('email'));
    $password = $request->input('password');

    if ($email === 'vbat.admin@gmail.com' && $password === 'admin123') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->name('login.temp');

Route::post('/register-temporary', function (Request $request) {
    return redirect()->route('user.dashboard');
})->name('register.temp');

Route::post('/logout', function () {
    return redirect()->route('landing');
})->name('logout');

Route::get('/dashboard/user', function () {
    return view('user-dash'); 
})->name('user.dashboard');

/**
 * ADMIN PANEL ROUTES
 */
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () { 
        return view('admin.dashboard'); 
    })->name('admin.dashboard');

    Route::get('/profile', function () { 
        return view('admin.admin-profile'); 
    })->name('admin.profile');

    Route::get('/scenes', function () { 
        return view('admin.timeline-scenes'); 
    })->name('admin.scenes');

    Route::get('/resources', function () { 
        return view('admin.resources'); 
    })->name('admin.resources');

    Route::get('/editor', function () { 
        return view('admin.timeline-editor'); 
    })->name('admin.editor');

    // Added new Route for Quiz and Tasks
    Route::get('/quiz-task', function () { 
        return view('admin.quiz-task'); 
    })->name('admin.quiz-task');

    Route::get('/users', function () { 
        return view('admin.users'); 
    })->name('admin.users');

    Route::get('/settings', function () { 
        return view('admin.settings'); 
    })->name('admin.settings');
});