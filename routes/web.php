<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MylistController;
use App\Http\Controllers\CardsController;


Route::get('/', [SiteController::class, 'welcome'])->name('welcome');
Route::get('/dashboard', [SiteController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

// AUTH ROUTES
// ===========
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest')->name('register');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest')->name('login');

// EDITOR ROUTES
// =============
Route::get('/user_dashboard', [UserController::class, 'dashboard'])->middleware(['auth'])->name('user_dashboard');
Route::post('/add_card', [CardsController::class, 'store'])->middleware(['auth'])->name('add_card');
Route::post('/edit_card/{id}', [CardsController::class, 'update'])->middleware(['auth'])->name('edit_card');
Route::get('/delete_card/{id}', [CardsController::class, 'destroy'])->middleware(['auth'])->name('delete_card');
Route::get('/delete_card_attachment/{id}', [CardsController::class, 'destroy_attachment'])->middleware(['auth'])->name('delete_card_attachment');
Route::post('/add_card_attachment/{id}', [CardsController::class, 'add_attachment'])->middleware(['auth'])->name('add_card_attachment');
Route::get('/complete_card/{id}', [CardsController::class, 'complete_card'])->middleware(['auth'])->name('complete_card');
Route::get('/incomplete_card/{id}', [CardsController::class, 'incomplete_card'])->middleware(['auth'])->name('incomplete_card');


// ADMIN ROUTES
// ============
Route::get('/admin_dashboard', [AdminController::class, 'dashboard'])->middleware(['auth'])->name('admin_dashboard');
Route::get('/admin_lists', [AdminController::class, 'lists'])->middleware(['auth'])->name('admin_lists');
Route::get('/admin_users', [AdminController::class, 'users'])->middleware(['auth'])->name('admin_users');
Route::post('/add_list', [MylistController::class, 'store'])->middleware(['auth'])->name('add_list');
Route::post('/edit_list/{id}', [MylistController::class, 'update'])->middleware(['auth'])->name('edit_list');
Route::get('/delete_list/{id}', [MylistController::class, 'destroy'])->middleware(['auth'])->name('delete_list');
Route::post('/add_user', [AdminController::class, 'add_user'])->middleware(['auth'])->name('add_user');
Route::get('/delete_user/{id}', [AdminController::class, 'delete_user'])->middleware(['auth'])->name('delete_user');
