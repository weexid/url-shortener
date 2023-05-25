<?php

use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\ShortUserController;
use App\Http\Controllers\VisitorController;
use App\Models\ShortUrl;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// homepage
Route::get('/', [ShortUrlController::class, 'index'])->name('homepage');

// generate short url
Route::post('/short', [ShortUrlController::class, 'short'])->name('short.url');


// about page
Route::get('/about', function () {
    return view('pages.about.index');
})->name('about.page');


require __DIR__ . '/auth.php';

// redirect to original link
Route::get('/{code}', [ShortUrlController::class, 'show'])->name('short.show');

Route::middleware('auth')->group(function () {

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // detail short links
    Route::get('/short-url/{id}', [ShortUrlController::class, 'getShortDetail']);

    // visitor
    Route::get('/visitor/{id_link}', [VisitorController::class, 'show'])->name('show.visitor');

    // update route
    Route::put('/submit-edit/{id}', [ShortUrlController::class, 'submitEdit'])->name('submit-edit');

    // delete route
    Route::delete('/delete/{id}', [ShortUrlController::class, 'deleteShort'])->name('delete-short');
});
