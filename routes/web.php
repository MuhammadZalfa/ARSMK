<?php
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BeritaController::class, 'showListBerita'])
    ->name('home');

Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

Route::post('/messages', [MessageController::class, 'store'])
    ->name('messages.store');

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware('admin')->group(function () {
    // Route untuk manajemen berita admin
    Route::get('/admin/berita', [BeritaController::class, 'index'])
        ->name('beritaAdmin');
    
    Route::get('/admin/berita/create', [BeritaController::class, 'create'])
        ->name('berita.create');
    
    Route::post('/admin/berita', [BeritaController::class, 'store'])
        ->name('berita.store');
    
    Route::get('/admin/berita/edit/{id}', [BeritaController::class, 'edit'])
    ->name('berita.edit');

    Route::put('/admin/berita/update/{id}', [BeritaController::class, 'update'])
    ->name('berita.update');
    
    Route::delete('/admin/berita/{id}', [BeritaController::class, 'destroy'])
        ->name('berita.destroy');

    Route::get('/admin', [BeritaController::class, 'dashboard'])
    ->name('admin');

    Route::get('/admin/pesan', [MessageController::class, 'index'])
    ->name('pesanAdmin');

        // In routes/web.php
    Route::get('/admin/pesan/{id}', [MessageController::class, 'show'])
    ->name('admin.pesan.show');
}); 