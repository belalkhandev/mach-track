<?php

use App\Http\Controllers\Admin\AcademicClassController;
use App\Http\Controllers\Admin\AcademicGroupController;
use App\Http\Controllers\Admin\AcademicPlanController;
use App\Http\Controllers\Admin\AcademicSectionController;
use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\BuildingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContactSettingController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeeController;
use App\Http\Controllers\Admin\FloorController;
use App\Http\Controllers\Admin\LeaderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\Admin\SmsController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TransportBillingController;
use App\Http\Controllers\Admin\TransportFeeController;
use App\Http\Controllers\Web\PaymentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\TransportPaymentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('login', function (){
   return redirect(route('login'));
});

Route::get('register', function (){
   return redirect(route('login'));
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('categories')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('category.index');
        Route::get('/create', [SettingsController::class, 'create'])->name('category.create');
        Route::post('/create', [SettingsController::class, 'store']);
        Route::get('/{categoryId}/edit', [SettingsController::class, 'edit'])->name('category.edit');
        Route::put('/{categoryId}/edit', [SettingsController::class, 'update']);
        Route::delete('/{categoryId}', [SettingsController::class, 'destroy'])->name('category.delete');
    });

    Route::prefix('brands')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('brand.index');
        Route::get('/create', [SettingsController::class, 'create'])->name('brand.create');
        Route::post('/create', [SettingsController::class, 'store']);
        Route::get('/{brandId}/edit', [SettingsController::class, 'edit'])->name('brand.edit');
        Route::put('/{brandId}/edit', [SettingsController::class, 'update']);
        Route::delete('/{brandId}', [SettingsController::class, 'destroy'])->name('brand.delete');
    });

    Route::prefix('models')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('model.index');
        Route::get('/create', [SettingsController::class, 'create'])->name('model.create');
        Route::post('/create', [SettingsController::class, 'store']);
        Route::get('/{modelId}/edit', [SettingsController::class, 'edit'])->name('model.edit');
        Route::put('/{modelId}/edit', [SettingsController::class, 'update']);
        Route::delete('/{modelId}', [SettingsController::class, 'destroy'])->name('model.delete');
    });

    Route::prefix('buildings')->group(function () {
        Route::get('/', [BuildingController::class, 'index'])->name('building.index');
        Route::get('/create', [BuildingController::class, 'create'])->name('building.create');
        Route::post('/create', [BuildingController::class, 'store']);
        Route::get('/{buildingId}/edit', [BuildingController::class, 'edit'])->name('building.edit');
        Route::put('/{buildingId}/edit', [BuildingController::class, 'update']);
        Route::delete('/{buildingId}', [BuildingController::class, 'destroy'])->name('building.delete');
    });

    Route::prefix('floors')->group(function () {
        Route::get('/', [FloorController::class, 'index'])->name('floor.index');
        Route::get('/create', [FloorController::class, 'create'])->name('floor.create');
        Route::post('/create', [FloorController::class, 'store']);
        Route::get('/{floorId}/edit', [FloorController::class, 'edit'])->name('floor.edit');
        Route::put('/{floorId}/edit', [FloorController::class, 'update']);
        Route::delete('/{floorId}', [FloorController::class, 'destroy'])->name('floor.delete');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
        Route::get('/create', [SettingsController::class, 'create'])->name('settings.create');
        Route::post('/create', [SettingsController::class, 'store']);
        Route::get('/{settingId}/edit', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::put('/{settingId}/edit', [SettingsController::class, 'update']);
        Route::delete('/{settingId}', [SettingsController::class, 'destroy'])->name('settings.delete');
    });

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
