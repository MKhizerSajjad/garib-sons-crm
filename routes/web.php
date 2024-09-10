<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DependentController;
use App\Http\Controllers\PurchaseOrderController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('item', ItemController::class)->names('item');

    Route::get('get-subcategories', [DependentController::class, 'getSubcategories']);
    Route::get('get-items', [DependentController::class, 'getItems']);
    Route::get('get-subitems', [DependentController::class, 'getSubitems']);
    Route::get('get-agents', [DependentController::class, 'getAgents']);

    Route::prefix('po')->group(function () {
        Route::get('/', [PurchaseOrderController::class, 'index'])->name('po.index');
        Route::get('create', [PurchaseOrderController::class, 'create'])->name('po.create');
        Route::post('/store', [PurchaseOrderController::class, 'store'])->name('po.store');
        Route::get('{task}', [PurchaseOrderController::class, 'show'])->name('po.show');
        Route::get('{task}/edit', [PurchaseOrderController::class, 'edit'])->name('po.edit');
        Route::put('{task}/update', [PurchaseOrderController::class, 'update'])->name('po.update');
        Route::delete('{task}/delete', [PurchaseOrderController::class, 'destroy'])->name('po.destroy');
        Route::get('{task}/delete-media', [PurchaseOrderController::class, 'destroyMedia'])->name('po.destroyMedia');
        Route::get('{task}/invoice', [PurchaseOrderController::class, 'invoice'])->name('po.invoice');
    });
});
