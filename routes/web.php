<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClaimController;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('index'))->name('home');

Route::get('/about', fn () => view('about', [
    'name' => 'Kanokporn Jeamthong',
    'date' => '5 กรกฎาคม 2026',
]))->name('about');

Route::get('/blog', function () {
    $blog = Blog::where('status', true)->latest()->get();

    return view('blog', compact('blog'));
})->name('blog');

Route::prefix('author')->name('author.')->group(function () {
    Route::get('/about', [AdminController::class, 'about2'])->name('about');
    Route::get('/blog', [AdminController::class, 'blog2'])->name('blog');
    Route::get('/create', [AdminController::class, 'form'])->name('create');
    Route::post('/insert', [AdminController::class, 'insert'])->name('store');
    Route::patch('/blog/{blog}', [AdminController::class, 'update'])->name('update');
    Route::get('/blog/{blog}/edit', [AdminController::class, 'edit'])->name('edit');
    Route::patch('/blog/{blog}/status', [AdminController::class, 'change'])->name('status');
    Route::delete('/blog/{blog}', [AdminController::class, 'delete'])->name('delete');
});

Route::get('/claim', [ClaimController::class, 'create'])->name('claim.create');
Route::post('/claim/store', [ClaimController::class, 'store'])->name('claim.store');

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();

        return 'เชื่อมต่อฐานข้อมูลสำเร็จ : '.DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return 'ไม่สามารถเชื่อมต่อฐานข้อมูลได้: '.$e->getMessage();
    }
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
