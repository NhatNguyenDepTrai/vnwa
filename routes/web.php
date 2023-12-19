<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CategoryProjectController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\VinawebappController;
use App\Http\Controllers\CompanyController;

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
    Route::post('/ckediter-uploads-file', [FileController::class, 'ckediterUploadsImage']);
    Route::post('/change-status', [VinawebappController::class, 'changeStatus']);
    Route::post('/change-highlight', [VinawebappController::class, 'changeHighlight']);
    Route::post('/delete-items', [VinawebappController::class, 'deleteItems']);
    Route::post('/restore-items', [VinawebappController::class, 'restoreItems']);
    Route::post('/change-ord', [VinawebappController::class, 'changeORD']);
    Route::post('/get-data-district/{id}', [VinawebappController::class, 'getDataDistrict']);
    Route::post('/get-data-ward/{id}', [VinawebappController::class, 'getDataWard']);
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    // start Company
    Route::prefix('company')->group(function () {
        Route::get('', [CompanyController::class, 'showCompany'])->name('Company');
        Route::post('', [CompanyController::class, 'UpdateCompany']);
    });
    // end Company

    // start Category Project
    Route::prefix('category-project')->group(function () {
        Route::get('', [CategoryProjectController::class, 'showIndex'])->name('CategoryProject');
        Route::post('load-data-table', [CategoryProjectController::class, 'loadDataTable']);

        Route::get('/trash', [CategoryProjectController::class, 'showTrash'])->name('CategoryProjectTrash');
        Route::get('/create', function () {
            return Inertia::render('CategoryProject/Create');
        })->name('CategoryProjectCreate');
        Route::post('/create', [CategoryProjectController::class, 'create']);

        Route::get('/edit/{id}', [CategoryProjectController::class, 'showEdit'])->name('CategoryProjectEdit');
        Route::post('/edit/{id}', [CategoryProjectController::class, 'updateCategoryProject']);
    });
    // end Category Project
    // start  Project
    Route::prefix('project')->group(function () {
        Route::get('', [ProjectController::class, 'showIndex'])->name('Project');
        Route::post('load-all-data-category-project', [ProjectController::class, 'loadAllDataCategoryProject']);
        Route::post('load-data-table', [ProjectController::class, 'loadDataTable']);
        Route::get('/trash', [ProjectController::class, 'showTrash'])->name('Project.trash');
        Route::get('create', [ProjectController::class, 'showCreate'])->name('Project.create');

        Route::post('/create', [ProjectController::class, 'create']);

        Route::get('/edit/{id}', [ProjectController::class, 'showEdit'])->name('Project.edit');
        Route::post('/edit/{id}', [ProjectController::class, 'UpdateProject']);
    });
    // end  Project
});
