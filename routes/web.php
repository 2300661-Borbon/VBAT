<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\VrController;

/*
|--------------------------------------------------------------------------
| Public & Guest Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing-page');
})->name('landing');

Route::get('/login', function () {
    return redirect()->route('landing');
})->name('login');

Route::get('/auth/callback', function () {
    return view('auth.callback');
})->name('auth.callback');

// Authentication Controller Group
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register')->name('register');
    Route::post('/password/update-custom', 'updatePassword')->name('password.update.custom');
    Route::post('/auth/google-session', 'handleGoogleSession')->name('auth.google-session');
    Route::match(['get', 'post'], '/logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Protected User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:web'])->group(function () {
    // User Dashboard
    Route::get('/dashboard/user', [QuizController::class, 'userDashboard'])->name('user.dashboard');

    // Virtual Reality Route
    Route::get('/vr/{scene}', [VrController::class, 'show'])->name('vr.show');

    // Quiz Result API (Used by Alpine.js fetch)
    Route::post('/quiz-results', [QuizController::class, 'storeResult'])->name('quiz.results.store');

    // Quiz Execution Routes (User Side)
    Route::prefix('quizzes')->name('quizzes.')->controller(QuizController::class)->group(function () {
        Route::get('/{quiz}', 'show')->name('show');
        Route::post('/{quiz}/submit', 'submit')->name('submit');
        Route::get('/{quiz}/results/{attempt?}', 'results')->name('results');
    });
});

/*
|--------------------------------------------------------------------------
| Admin-Only Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/users');
    Route::redirect('/dashboard', '/admin/users');

    Route::controller(AdminController::class)->group(function () {
        // User Management Routes
        Route::get('/users', 'index')->name('users');
        Route::put('/users/{user}/email', 'updateEmail')->name('users.updateEmail');
        Route::put('/users/{user}/password', 'resetPassword')->name('users.resetPassword');
        Route::delete('/users/{user}', 'deleteUser')->name('users.delete');

        // Quiz Management Routes
        Route::get('/quizzes', 'manageQuizzes')->name('quizzes');
        Route::post('/quizzes', 'storeQuiz')->name('quizzes.store');
        Route::put('/quizzes/{quiz}', 'updateQuiz')->name('quizzes.update');
        Route::delete('/quizzes/{quiz}', 'deleteQuiz')->name('quizzes.delete');
    });
});