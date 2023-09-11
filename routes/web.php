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
use App\Http\Controllers\PublicService\SopController;
use App\Http\Controllers\PublicService\WorkAccountabilityController;
use App\Http\Controllers\Remaja\Auth\AuthController;
use App\Http\Controllers\Remaja\Landing\HomeController as LandingHomeController;
use App\Http\Controllers\Remaja\Quiz\CategoryController;
use App\Http\Controllers\Remaja\Quiz\QuestionController;
use App\Http\Controllers\Remaja\Quiz\QuizController;
use App\Http\Controllers\Training\CalendarController;
use App\Http\Controllers\Training\CollaborationController;
use App\Http\Controllers\Training\ProfileTrainingController;
use App\Http\Controllers\Remaja\User\UserController as UserProfileController;
use App\Http\Controllers\WebSetting\HighlightController;
use App\Http\Livewire\Remaja\Landing\HomeLivewire;
use Illuminate\Support\Facades\Artisan;

Route::prefix('/')->middleware('maintenance')->group(function () {
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
});


Route::middleware(['auth', 'web', 'permission:dashboard-admin'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        // Route::get('/', fn () => view('dashboard'));
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        // Route::get('/maintenance', [DashboardController::class, 'maintenance'])->name('dashboard.maintenance');
        Route::post('/maintenance/update', [DashboardController::class, 'updateMaintenance'])->name('dashboard.maintenance.update');

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
        Route::resource('sops', SopController::class)->names('dashboard.sops');

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

        // Remaja
        // Route::get('/categories', [CategoryController::class, 'index'])->name('dashboard.categories.index');
        // Route::get('/categories/create', [CategoryController::class, 'create'])->name('dashboard.categories.create');
        // Route::post('/categories/store', [CategoryController::class, 'store'])->name('dashboard.categories.store');
        // Route::get('/categories/refresh', [CategoryController::class, 'index'])->name('dashboard.categories.refresh');
        Route::get('/categories/datatable', [CategoryController::class, 'getCategories'])->name('dashboard.categories.datatable');
        Route::resource('categories', CategoryController::class)->names('dashboard.categories');

        Route::get('/quiz/{id}/questions', [QuestionController::class, 'index'])->name('dashboard.questions');
        Route::get('/quiz/{id}/datatable', [QuestionController::class, 'getQuestion'])->name('dashboard.questions.datatable');
        Route::post('/quiz/{id}/store', [QuestionController::class, 'store'])->name('dashboard.questions.store');
        Route::get('/quiz/{id}/edit/{question_id}', [QuestionController::class, 'edit'])->name('dashboard.questions.edit');
        Route::put('/quiz/{id}/update/{question_id}', [QuestionController::class, 'update'])->name('dashboard.questions.update');
        Route::delete('/quiz/{id}/delete/{question_id}', [QuestionController::class, 'destroy'])->name('dashboard.questions.destroy');

        // Route::get('/quiz/{id}/questions/create', [QuestionController::class, 'create'])->name('dashboard.questions.create');
        Route::resource('quiz', QuizController::class)->names('dashboard.quizzes');
    });

    // Highlights
    // Route::get('highlights', [App\Http\Controllers\WebSetting\HighlightController::class, 'index'])->name('highlights.index');
    // Route::get('highlights/{$id}', [App\Http\Controllers\WebSetting\HighlightController::class, 'show'])->name('highlights.show');
});


// Menjadi Remaja
Route::prefix('remaja')->group(function () {

    Route::get('/', [LandingHomeController::class, 'index'])->name('user.index');
    Route::get('/list', [LandingHomeController::class, 'listGame'])->name('user.list');

    Route::middleware(['auth-user', 'role:User Remaja', 'permission:dashboard-user'])->group(function () {
        Route::get('/game/{slug_url}', [LandingHomeController::class, 'gameDetail'])->name('user.detail.game');
        Route::get('/game/{slug_url}/result', [LandingHomeController::class, 'gameResult'])->name('user.detail.result');
        Route::get('/game/{slug_url}/result/view', [LandingHomeController::class, 'gameResultView'])->name('user.detail.result.view');
        Route::get('/ranking', [LandingHomeController::class, 'ranking'])->name('user.detail.rangking');
        Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile');
        Route::get('/profile/{slug_rul}/certificate', [UserProfileController::class, 'myCertificate'])->name('user.profile.certificate');
        Route::get('/profile/{slug_rul}/certificate/print', [UserProfileController::class, 'myPrintCertificate'])->name('user.profile.certificate.print');

        // Edit Profile
        Route::get('/profile/edit', [UserProfileController::class, 'editProfile'])->name('user.profile.edit');
        Route::post('/profile/{id}/update', [UserProfileController::class, 'updateProfile'])->name('user.profile.update');
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

});


// Route::middleware('role:User Remaja')->group(function () {
//     Route::prefix('user')->group(function () {
//         Route::get('/', fn () => view('dashboard'));
//     });
// });


// Command
Route::get('/foo', function () {
    Artisan::call('storage:link');
});
