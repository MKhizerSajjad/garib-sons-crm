<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CropItemController;
use App\Http\Controllers\DeductionSlabController;
use App\Http\Controllers\DependentController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\ArrivalInspectionController;
use App\Http\Controllers\ArrivalGatePassController;
use App\Http\Controllers\ArrivalWeighbridgeController;
use App\Models\ArrivalInspection;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('item', CropItemController::class)->names('item');

    Route::get('get-crop-items', [DependentController::class, 'getCropItems']);
    Route::get('get-crop-types', [DependentController::class, 'getCropTypes']);
    Route::get('get-subcategories', [DependentController::class, 'getSubcategories']);
    Route::get('get-items', [DependentController::class, 'getItems']);
    Route::get('get-subitems', [DependentController::class, 'getSubitems']);
    Route::get('get-agents', [DependentController::class, 'getAgents']);
    Route::get('get-po', [DependentController::class, 'getPO']);
    Route::get('get-inspections', [DependentController::class, 'getInspections']);
    Route::get('get-insp-details', [DependentController::class, 'getInspectionDetails']);
    Route::get('get-gate-passes', [DependentController::class, 'getGatePasses']);


    Route::resource('slab', DeductionSlabController::class)->names('slab');
    Route::resource('first-inspection', ArrivalInspectionController::class)->names('first-inspection');
    Route::resource('pass-in', ArrivalGatePassController::class)->names('pass-in');
    Route::resource('first-weighbridge', ArrivalWeighbridgeController::class)->names('first-weighbridge');
    Route::prefix('purchaseorder')->group(function () {
        Route::get('/', [PurchaseOrderController::class, 'index'])->name('purchaseorder.index');
        Route::get('create', [PurchaseOrderController::class, 'create'])->name('purchaseorder.create');
        Route::get('create1', [PurchaseOrderController::class, 'create1'])->name('purchaseorder.create1');
        Route::post('/store', [PurchaseOrderController::class, 'store'])->name('purchaseorder.store');
        Route::get('{task}', [PurchaseOrderController::class, 'show'])->name('purchaseorder.show');
        Route::get('{task}/edit', [PurchaseOrderController::class, 'edit'])->name('purchaseorder.edit');
        Route::put('{task}/update', [PurchaseOrderController::class, 'update'])->name('purchaseorder.update');
        Route::delete('{task}/delete', [PurchaseOrderController::class, 'destroy'])->name('purchaseorder.destroy');
        Route::get('{task}/delete-media', [PurchaseOrderController::class, 'destroyMedia'])->name('purchaseorder.destroyMedia');
        Route::get('{task}/invoice', [PurchaseOrderController::class, 'invoice'])->name('purchaseorder.invoice');
    });
});
