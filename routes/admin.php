<?php


use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BuildingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FloorController;
use App\Http\Controllers\Admin\MachineController;
use App\Http\Controllers\Admin\MachineModelController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use Illuminate\Support\Facades\Route;

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


    Route::prefix('machines/tracking')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('machine.tracking.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('machine.tracking.create');
        Route::post('/create', [CategoryController::class, 'store']);
        Route::get('/{machineTrackingId}/edit', [CategoryController::class, 'edit'])->name('machine.tracking.edit');
        Route::put('/{machineTrackingId}/edit', [CategoryController::class, 'update']);
        Route::delete('/{machineTrackingId}', [CategoryController::class, 'destroy'])->name('machine.tracking.delete');
    });

    Route::prefix('machines')->group(function () {
        Route::get('/', [MachineController::class, 'index'])->name('machine.index');
        Route::get('/show/{machineId}', [MachineController::class, 'show'])->name('machine.show');
        Route::get('/create', [MachineController::class, 'create'])->name('machine.create');
        Route::post('/create', [MachineController::class, 'store']);
        Route::get('/{machineId}/edit', [MachineController::class, 'edit'])->name('machine.edit');
        Route::put('/{machineId}/edit', [MachineController::class, 'update']);
        Route::delete('/{machineId}', [MachineController::class, 'destroy'])->name('machine.delete');
        Route::get('/export', [MachineController::class, 'export'])->name('machine.export');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/create', [CategoryController::class, 'store']);
        Route::get('/{categoryId}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/{categoryId}/edit', [CategoryController::class, 'update']);
        Route::delete('/{categoryId}', [CategoryController::class, 'destroy'])->name('category.delete');
    });

    Route::prefix('brands')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('brand.index');
        Route::get('/create', [BrandController::class, 'create'])->name('brand.create');
        Route::post('/create', [BrandController::class, 'store']);
        Route::get('/{brandId}/edit', [BrandController::class, 'edit'])->name('brand.edit');
        Route::put('/{brandId}/edit', [BrandController::class, 'update']);
        Route::delete('/{brandId}', [BrandController::class, 'destroy'])->name('brand.delete');
    });

    Route::prefix('models')->group(function () {
        Route::get('/', [MachineModelController::class, 'index'])->name('machine.model.index');
        Route::get('/create', [MachineModelController::class, 'create'])->name('machine.model.create');
        Route::post('/create', [MachineModelController::class, 'store']);
        Route::get('/{modelId}/edit', [MachineModelController::class, 'edit'])->name('machine.model.edit');
        Route::put('/{modelId}/edit', [MachineModelController::class, 'update']);
        Route::delete('/{modelId}', [MachineModelController::class, 'destroy'])->name('machine.model.delete');
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
