<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Livewire\Admin\CreateProducts;
use App\Http\Livewire\Admin\CreateProvincia;
use App\Http\Livewire\Admin\CreateSubcategory;
use App\Http\Livewire\Admin\EditOrder;
use App\Http\Livewire\Admin\EditOrders;
use App\Http\Livewire\Admin\EditProducts;
use App\Http\Livewire\Admin\EditProvincia;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\ShowProducts;
use App\Http\Livewire\Admin\Users;
use App\Http\Livewire\Admin\UsersCreate;
use App\Http\Livewire\Admin\UsersEdit;

Route::get('/', ShowProducts::class)->name('admin.index');

Route::get('products/create', CreateProducts::class)->name('admin.products.create');

Route::get('products/{product}/edit', EditProducts::class)->name('admin.products.edit');

Route::post('products/{product}/filesEdit', [ProductController::class, 'filesEdit'])->name('admin.products.filesEdit');

Route::get('subcategories', CreateSubcategory::class)->name('admin.subcategories');

Route::get('orders', EditOrders::class)->name('admin.orders');

Route::get('orders/{order}/edit', EditOrder::class)->name('admin.orders.edit');

Route::get('provincias', CreateProvincia::class)->name('admin.provincias');

Route::get('provincias/{provincia}/edit', EditProvincia::class)->name('admin.provincias.edit');

Route::get('users', Users::class)->name('admin.users');

Route::get('users/create', UsersCreate::class)->name('admin.users.create');

Route::get('users/{user}/edit', UsersEdit::class)->name('admin.users.edit');
