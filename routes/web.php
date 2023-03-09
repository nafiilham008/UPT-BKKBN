<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PostController,
    UserController,
    ProfileController,
    RemoveMediaController,
    RoleAndPermissionController
};
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Profile\EmployeeController;
use App\Http\Controllers\Profile\HistoricalController;
use App\Http\Controllers\Profile\JobandfuncController;
use App\Http\Controllers\Profile\StructureController;
use App\Http\Controllers\WebSetting\HighlightController;
use App\Models\Profile\Historical;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/{category}/detail/{slug}', [HomeController::class, 'detail'])->name('home.detail');
Route::get('/profile', [HomeController::class, 'profile'])->name('home.profile');

Route::middleware(['auth', 'web'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', fn () => view('dashboard'));

        Route::get('/profile', ProfileController::class)->name('profile');

        Route::resource('users', UserController::class);
        Route::resource('roles', RoleAndPermissionController::class);

        Route::resource('posts', PostController::class);
        Route::resource('highlights', HighlightController::class);

        Route::resource('historicals', HistoricalController::class);
        Route::resource('jobandfuncs', JobandfuncController::class);
        Route::resource('employees', EmployeeController::class);
    });




    // Highlights
    // Route::get('highlights', [App\Http\Controllers\WebSetting\HighlightController::class, 'index'])->name('highlights.index');
    // Route::get('highlights/{$id}', [App\Http\Controllers\WebSetting\HighlightController::class, 'show'])->name('highlights.show');
});

Route::middleware(['auth', 'permission:test view'])->get('/tests', function () {
    dd('This is just a test and an example for permission and sidebar menu. You can remove this line on web.php, config/permission.php and config/generator.php');
})->name('tests.index');
