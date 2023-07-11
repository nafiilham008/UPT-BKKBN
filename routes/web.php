<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    KediklatanController,
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
use App\Http\Controllers\Information\ButtonBanner;
use App\Http\Controllers\Information\OtherCourseController;
use App\Http\Controllers\Information\ScholarshipController;
use App\Http\Controllers\Link\LinkController;
use App\Http\Controllers\Profile\EducationHistoryController;
use App\Http\Controllers\Profile\EmployeeController;
use App\Http\Controllers\Profile\EmployeeHistoryController;
use App\Http\Controllers\Profile\HistoricalController;
use App\Http\Controllers\Profile\JobandfuncController;
use App\Http\Controllers\Profile\StructureController;
use App\Http\Controllers\PublicService\ServiceInformationController;
use App\Http\Controllers\PublicService\WorkAccountabilityController;
use App\Http\Controllers\Remaja\Auth\AuthController;
use App\Http\Controllers\Training\CalendarController;
use App\Http\Controllers\Training\CollaborationController;
use App\Http\Controllers\Training\ProfileTrainingController;
use App\Http\Controllers\WebSetting\HighlightController;



Route::get('/login-user', function () {
    return view('remaja.auth-user.login');
});
Route::get('/register-user', function () {
    return view('remaja.auth-user.register');
});
Route::get('/forgot-password', function () {
    return view('remaja.auth-user.forgot-password');
});
Route::get('/change-password', function () {
    return view('remaja.auth-user.change-password');
});
Route::get('/code-verification', function () {
    return view('remaja.auth-user.code-verification');
});





Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/history', [HomeController::class, 'detailHistory'])->name('home.detail.history');
Route::get('/{category}/detail/{slug}', [HomeController::class, 'detail'])->name('home.detail');
Route::get('/profile', [HomeController::class, 'profile'])->name('home.profile');
Route::get('/profile/employees/{id}', [HomeController::class, 'getEmployeesDetail'])->name('employees.educations');


Route::get('/training', [HomeController::class, 'training'])->name('home.training');

Route::get('/documentation', [HomeController::class, 'documentation'])->name('home.documentation');

Route::get('/scholarship', [HomeController::class, 'scholarship'])->name('home.scholarship');
Route::get('/other-course', [HomeController::class, 'otherCourse'])->name('home.other.course');
Route::get('/information/scholarship/{id}', [HomeController::class, 'getScholarshipDetail'])->name('information.scholarship');

Route::get('/material', [HomeController::class, 'download'])->name('home.material');

Route::get('/public-information', [HomeController::class, 'publicService'])->name('home.public.information');

Route::get('/kediklatan', [HomeController::class, 'kediklatan'])->name('home.kediklatan');

Route::get('/tautan', [HomeController::class, 'tautan'])->name('home.tautan');

Route::get('/search', [HomeController::class, 'search'])->name('home.search');


Route::middleware(['auth', 'web'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        // Route::get('/', fn () => view('dashboard'));
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', ProfileController::class)->name('profile');

        Route::resource('users', UserController::class)->names('dashboard.users');
        Route::resource('roles', RoleAndPermissionController::class)->names('dashboard.roles');

        Route::resource('posts', PostController::class)->names('dashboard.posts');
        Route::resource('highlights', HighlightController::class)->names('dashboard.highlights');

        Route::resource('historicals', HistoricalController::class)->names('dashboard.historicals');
        Route::resource('jobandfuncs', JobandfuncController::class)->names('dashboard.jobandfuncs');
        Route::resource('employees', EmployeeController::class)->names('dashboard.employees');
        Route::resource('structures', StructureController::class)->names('dashboard.structures');
        Route::resource('scholarships', ScholarshipController::class)->names('dashboard.scholarships');
        Route::resource('courses', OtherCourseController::class)->names('dashboard.courses');
        Route::resource('announcements', AnnouncementController::class)->names('dashboard.announcements');
        Route::resource('public-informations', PublicInformationController::class)->names('dashboard.public-informations');
        Route::resource('materials', MaterialController::class)->names('dashboard.materials');

        // Education History
        Route::get('/employees/{id}/educations', [EmployeeController::class, 'getEducationHistory'])->name('dashboard.employees.educations');
        Route::post('/employees/{id}/educations/delete', [EducationHistoryController::class, 'destroy'])->name('dashboard.educations.destroy');
        Route::post('/employees/{id}/educations', [EducationHistoryController::class, 'store'])->name('dashboard.educations.store');
        Route::get('/employees/{employeeId}/educations/{educationId}/edit', [EducationHistoryController::class, 'edit'])->name('dashboard.educations.edit');
        Route::put('/employees/{id}/educations/{education_id}', [EducationHistoryController::class, 'update'])->name('dashboard.employees.educations.update');

        // Employee History
        Route::get('/employees/{id}/history', [EmployeeController::class, 'getEmployeeHistory'])->name('dashboard.employees.history');
        Route::post('/employees/{id}/history', [EmployeeHistoryController::class, 'store'])->name('dashboard.employees.history.store');
        Route::get('/employees/{employeeId}/history/{educationId}/edit', [EmployeeHistoryController::class, 'edit'])->name('dashboard.employees.history.edit');
        Route::put('/employees/{id}/history/{education_id}', [EmployeeHistoryController::class, 'update'])->name('dashboard.employees.educations.update');
        Route::post('/employees/{id}/history/delete', [EmployeeHistoryController::class, 'destroy'])->name('dashboard.employees.history.destroy');

        Route::resource('calendars', CalendarController::class)->names('dashboard.calendars');
        Route::resource('profiletrainings', ProfileTrainingController::class)->names('dashboard.profiletrainings');
        Route::resource('collaborations', CollaborationController::class)->names('dashboard.collaborations');
        // Route::resource('public-informations', PublicInformationController::class)->names('dashboard.posts');
        Route::resource('work-accountabilities', WorkAccountabilityController::class)->names('dashboard.work-accountabilities');
        Route::resource('button-banners', ButtonBanner::class)->names('dashboard.button-banners');
        Route::resource('service-informations', ServiceInformationController::class)->names('dashboard.service-informations');
        Route::resource('kediklatans', KediklatanController::class)->names('dashboard.kediklatans');
        Route::resource('links', LinkController::class)->names('dashboard.links');
    });

    // Highlights
    // Route::get('highlights', [App\Http\Controllers\WebSetting\HighlightController::class, 'index'])->name('highlights.index');
    // Route::get('highlights/{$id}', [App\Http\Controllers\WebSetting\HighlightController::class, 'show'])->name('highlights.show');
});


// Menjadi Remaja
Route::get('/test', function () {
    return view('remaja.front.index');
});
Route::get('/game', function () {
    return view('remaja.front.game');
});
Route::get('/nilai', function () {
    return view('remaja.front.nilai');
});
Route::middleware('guest')->group(function () {
    // Biasa
    Route::get('/user/log-in', [AuthController::class, 'indexLogin'])->name('remaja.login');
    Route::post('/user/log-in/callback', [AuthController::class, 'login'])->name('remaja.login.process');

    Route::get('/user/register', [AuthController::class, 'indexRegister'])->name('remaja.register');
    Route::post('/user/register/callback', [AuthController::class, 'register'])->name('remaja.register.process');

    Route::get('/user/verification/{code}', [AuthController::class, 'indexVerification'])->name('remaja.verification');
    Route::post('/user/verification/{code}/confirm', [AuthController::class, 'verificationProcess'])->name('remaja.verification.confirm');

    Route::get('/user/verification/{id}/resend', [AuthController::class, 'resendVerification'])->name('remaja.verification.resend');



    // Google
    Route::get('/user/login', [AuthController::class, 'redirectToGoogle'])->name('remaja.google.login');
    Route::get('/user/login/callback', [AuthController::class, 'handleGoogleCallback'])->name('remaja.google.callback');
   
});


Route::middleware('role:User Remaja')->group(function () {
    Route::prefix('user')->group(function () {
        // Route::get('/', fn () => view('dashboard'));
        Route::get('/', [HomeController::class, 'index'])->name('user.dashboard');
    });
});

// Route::middleware(['auth', 'permission:test view'])->get('/tests', function () {
//     dd('This is just a test and an example for permission and sidebar menu. You can remove this line on web.php, config/permission.php and config/generator.php');
// })->name('tests.index');
