<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Livewire\Admin\CreateBrand;
use App\Http\Livewire\Admin\CreateProducts;
use App\Http\Livewire\Admin\CreateSubcategory;
use App\Http\Livewire\Admin\EditProducts;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\ShowProducts;



Route::get('/', ShowProducts::class)->name('admin.index');

Route::get('products/create', CreateProducts::class)->name('admin.products.create');

Route::get('products/{product}/edit', EditProducts::class)->name('admin.products.edit');

Route::post('products/{product}/filesEdit', [ProductController::class, 'filesEdit'])->name('admin.products.filesEdit');

Route::get('subcategories', CreateSubcategory::class)->name('admin.subcategories');

Route::get('brands', CreateBrand::class)->name('admin.brands');
