<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PostController,
    UserController,
    ProfileController,
    RemoveMediaController,
    RoleAndPermissionController
};
use App\Http\Controllers\Download\MaterialController;
use App\Http\Controllers\Download\PublicInformationController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Information\AnnouncementController;
use App\Http\Controllers\Information\OtherCourseController;
use App\Http\Controllers\Information\ScholarshipController;
use App\Http\Controllers\Profile\EducationHistoryController;
use App\Http\Controllers\Profile\EmployeeController;
use App\Http\Controllers\Profile\EmployeeHistoryController;
use App\Http\Controllers\Profile\HistoricalController;
use App\Http\Controllers\Profile\JobandfuncController;
use App\Http\Controllers\Training\CalendarController;
use App\Http\Controllers\Training\CollaborationController;
use App\Http\Controllers\Training\ProfileTrainingController;
use App\Http\Controllers\WebSetting\HighlightController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/history', [HomeController::class, 'detailHistory'])->name('home.detail.history');
Route::get('/{category}/detail/{slug}', [HomeController::class, 'detail'])->name('home.detail');
Route::get('/profile', [HomeController::class, 'profile'])->name('home.profile');
Route::get('/profile/employees/{id}', [HomeController::class, 'getEmployeesDetail'])->name('employees.educations');


Route::get('/training', [HomeController::class, 'training'])->name('home.training');

Route::get('/documentation', [HomeController::class, 'documentation'])->name('home.documentation');

Route::get('/information', [HomeController::class, 'information'])->name('home.information');
Route::get('/information/scholarship/{id}', [HomeController::class, 'getScholarshipDetail'])->name('information.scholarship');

Route::get('/material', [HomeController::class, 'download'])->name('home.material');






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
        Route::resource('scholarships', ScholarshipController::class);
        Route::resource('courses', OtherCourseController::class);
        Route::resource('announcements', AnnouncementController::class);
        Route::resource('public-informations', PublicInformationController::class);
        Route::resource('materials', MaterialController::class);

        // Education History
        Route::get('/employees/{id}/educations', [EmployeeController::class, 'getEducationHistory'])->name('employees.educations');
        Route::post('/employees/{id}/educations/delete', [EducationHistoryController::class, 'destroy'])->name('educations.destroy');
        Route::post('/employees/{id}/educations', [EducationHistoryController::class, 'store'])->name('educations.store');        
        Route::get('/employees/{employeeId}/educations/{educationId}/edit', [EducationHistoryController::class, 'edit'])->name('educations.edit');
        Route::put('/employees/{id}/educations/{education_id}', [EducationHistoryController::class, 'update'])->name('employees.educations.update');
        
        // Employee History
        Route::get('/employees/{id}/history', [EmployeeController::class, 'getEmployeeHistory'])->name('employees.history');
        Route::post('/employees/{id}/history', [EmployeeHistoryController::class, 'store'])->name('employees.history.store');    
        Route::get('/employees/{employeeId}/history/{educationId}/edit', [EmployeeHistoryController::class, 'edit'])->name('employees.history.edit');
        Route::put('/employees/{id}/history/{education_id}', [EmployeeHistoryController::class, 'update'])->name('employees.educations.update');
        Route::post('/employees/{id}/history/delete', [EmployeeHistoryController::class, 'destroy'])->name('employees.history.destroy');

        Route::resource('calendars', CalendarController::class);
        Route::resource('profiletrainings', ProfileTrainingController::class);
        Route::resource('collaborations', CollaborationController::class);
        

    });




    // Highlights
    // Route::get('highlights', [App\Http\Controllers\WebSetting\HighlightController::class, 'index'])->name('highlights.index');
    // Route::get('highlights/{$id}', [App\Http\Controllers\WebSetting\HighlightController::class, 'show'])->name('highlights.show');
});

Route::middleware(['auth', 'permission:test view'])->get('/tests', function () {
    dd('This is just a test and an example for permission and sidebar menu. You can remove this line on web.php, config/permission.php and config/generator.php');
})->name('tests.index');
