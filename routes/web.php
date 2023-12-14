<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CategoryProjectController;
use App\Http\Controllers\VinawebappController;

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
    Route::post('/change-status', [VinawebappController::class, 'changeStatus']);
    // start Category Project
    Route::prefix('category-project')->group(function () {
        Route::get('', [CategoryProjectController::class, 'showIndex'])->name('CategoryProject');
        Route::get('/create', function () {
            return Inertia::render('CategoryProject/Create');
        })->name('CategoryProjectCreate');
        Route::post('/create', [CategoryProjectController::class, 'create']);

        Route::get('/edit/{id}', [CategoryProjectController::class, 'showEdit'])->name('CategoryProjectEdit');
        Route::post('/edit/{id}', [CategoryProjectController::class, 'updateCategoryProject']);
    });
    // end Category Project
});
