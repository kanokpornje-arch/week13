<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClaimController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about', [
        'name' => 'Kanokporn Jeamthong',
        'date' => '5 กรกฎาคม 2026',
    ]);
})->name('about');

Route::get('/blog', function () {
    $blog = DB::table('blogs')
        ->where('status', true)
        ->orderByDesc('id')
        ->get();

    return view('blog', compact('blog'));
})->name('blog');

Route::get('/about2', [AdminController::class, 'about2'])->name('about2');

Route::get('/blog2', [AdminController::class, 'blog2'])->name('blog2');

Route::get('/form', [AdminController::class, 'form'])->name('form');

Route::post('/insert', [AdminController::class, 'insert'])->name('blog.store');

Route::get('/claim', [ClaimController::class, 'create'])->name('claim.create');

Route::post('/claim/store', [ClaimController::class, 'store'])
    ->name('claim.store');

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "เชื่อมต่อฐานข้อมูลสำเร็จ : " . DB::connection()->getDatabaseName();

    } catch (\Exception $e) {
        return "ไม่สามารถเชื่อมต่อฐานข้อมูลได้:" . $e->getMessage();

    }

});

Route::get('/delete/{id}', [AdminController::class, 'delete'])->name('delete');
Route::get('/change/{id}', [AdminController::class, 'change'])->name('change');
Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [AdminController::class, 'update'])->name('update');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
