<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CategoryProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::post('/ckediter-uploads-file', [FileController::class, 'ckediterUploadsImage']);
    Route::prefix('category-project')->group(function () {
        Route::get('', function () {
            return Inertia::render('CategoryProject/Show');
        })->name('CategoryProject');

        Route::get('/create', function () {
            return Inertia::render('CategoryProject/Create');
        })->name('CategoryProjectCreate');

        Route::post('/create', [CategoryProjectController::class, 'create']);
    });
});
