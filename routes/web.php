<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EvaluationController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    Log::info('API');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class)->except(['index']);
    Route::get('/users/{id}/detail', [UserController::class, 'detail'])->name('users.detail');
    Route::post('/users/{id}/ticket', [UserController::class, 'gain_ticket'])->name('users.ticket');
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::get('/evaluations/', [EvaluationController::class, 'index'])->name('evaluations');
    Route::get('/evaluations/{id}', [EvaluationController::class, 'evaluate'])->name('evaluations.evaluate');
    Route::post('/evaluations/', [EvaluationController::class, 'store'])->name('evaluations.store');
});

require __DIR__ . '/auth.php';
