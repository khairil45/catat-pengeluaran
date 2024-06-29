<?php

use App\Models\Expense;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\SocialAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route untuk menampilkan halaman home
Route::get('/', function () {
    return view('index');
});

// Route untuk proses logout pengguna
Route::post('logout', [AuthController::class, 'destroy'])->middleware('auth');

Route::middleware(['guest', 'throttle: 10,1'])->group(function () {
    // Route untuk menampilkan halaman login admin
    Route::get('login-admin', [AuthController::class, 'index'])->name('admin.login');
    // Route untuk proses login admin
    Route::post('login-admin', [AuthController::class, 'store']);
    // Route untuk menampilkan halaman login user
    Route::get('login', [AuthController::class, 'create'])->name('user.login');
    // Route untuk pengalihan autentikasi sosial
    Route::get('/auth/redirect', [SocialAuthController::class, 'redirect'])->name('auth.redirect');
    // Route untuk menangani panggilan balik autentikasi Google
    Route::get('/auth/google/callback', [SocialAuthController::class, 'callback']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route untuk menampilkan dashboard admin
    Route::get('track-expenses/admin', [AdminController::class, 'index']);
    // Route untuk menampilkan daftar pengguna oleh admin
    Route::get('track-expenses/admin/users', [AdminController::class, 'users']);
    // Route untuk menghapus pengguna oleh admin
    Route::delete('track-expenses/admin/users/{slug}', [AdminController::class, 'destroy'])->name('admin.users.delete');
    // Route untuk menampilkan profil pengguna oleh admin
    Route::get('track-expenses/admin/users/{slug}', [AdminController::class, 'show'])->name('admin.users.show');
    // Route untuk menampilkan daftar kategori oleh admin
    Route::get('track-expenses/admin/categories', [CategoryController::class, 'index']);
    // Route untuk menampilkan halaman pembuatan kategori oleh admin
    Route::get('track-expenses/admin/categories/create', [CategoryController::class, 'create']);
    // Route untuk menyimpan kategori yang dibuat oleh admin
    Route::post('track-expenses/admin/categories', [CategoryController::class, 'store']);
    // Route untuk menampilkan halaman pengeditan kategori oleh admin
    Route::get('track-expenses/admin/categories/{slug}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    // Route untuk memperbarui kategori yang diedit oleh admin
    Route::patch('track-expenses/admin/categories/{slug}', [CategoryController::class, 'update'])->name('admin.categories.update');
    // Route untuk menghapus kategori oleh admin
    Route::delete('track-expenses/admin/categories/{slug}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    // Route untuk menampilkan dashboard pengguna
    Route::get('track-expenses', [UserController::class, 'dashboard']);
    // Route untuk menampilkan daftar expense pengguna
    Route::get('track-expenses/list', [ExpenseController::class, 'index']);
    // Route untuk menampilkan halaman pembuatan expense oleh pengguna
    Route::get('track-expenses/create', [ExpenseController::class, 'create']);
    // Route untuk menyimpan expense yang dibuat oleh pengguna
    Route::post('track-expenses', [ExpenseController::class, 'store']);
    // Route untuk menampilkan halaman pengeditan expense oleh pengguna
    Route::get('track-expenses/{slug}/edit', [ExpenseController::class, 'edit'])->name('track-expenses.edit');
    // Route untuk memperbarui expense yang diedit oleh pengguna
    Route::patch('track-expenses/{slug}', [ExpenseController::class, 'update'])->name('track-expenses.update');
    // Route untuk menampilkan profil pengguna
    Route::get('track-expenses/profil/{slug}', [UserController::class, 'show'])->name('user.profile');
    // Route untuk menghapus expense oleh pengguna
    Route::delete('track-expenses/expense/{slug}', [ExpenseController::class, 'destroy'])->name('track-expenses.deleteExpense');
    // Route untuk menghapus akun pengguna
    Route::delete('track-expenses/user/{slug}', [UserController::class, 'destroy'])->name('track-expenses.deleteUser');
});
